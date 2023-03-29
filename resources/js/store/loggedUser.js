import VueJwtDecode from 'vue-jwt-decode';
import $axios from './axios-instance.js';
// import permissionShift from './permissionShift'

function parseLoggedUserFnc(){
    if(localStorage.getItem('logged_user')){
        let result = null
        try {
            result = JSON.parse(localStorage.getItem('logged_user'))
        } catch (e) {
            result = null
        }

        return result
    }
    return null
}

export default {
  state: {
    token: localStorage.getItem("access_token") || null,
    user: parseLoggedUserFnc(),
    profile: null
  },
  mutations: {
    retrieveToken(state, payload) {
      state.token = payload.token;
      state.user = payload.user;
    },
    destroyToken(state) {
      state.token = null;
      state.user = null
    },
    retrieveProfile(state, profile){
      state.profile = profile;
    },
  },
  actions: {
    logoff(context) {
      if (context.getters.loggedIn) {
        localStorage.removeItem("access_token")
        localStorage.removeItem("logged_user")
        context.commit("destroyToken")
        context.dispatch('setLoading', false)
      }
    },
    login(context, credentials) {
      return new Promise((resolve, reject) => {
        $axios
          .post("login", credentials)
          .then(response => {
            const token = response.data.access_token
            const user = response.data.user
            // const user = response.data.user

            localStorage.setItem("access_token", token)
            localStorage.setItem('logged_user', JSON.stringify(user))

            context.commit("retrieveToken", {token, user})

            resolve(response)
          })
          .catch(error => {
            console.log(error)
            reject(error)
          })
      })
    },
    retrieveProfile(context){
      $axios.get('/userProfile')
          .then(response => {
            context.commit('retrieveProfile', response.data)
          })
          .catch(error => {
            console.log(error)
          })
    },
    changePassword(context, newPassword){
      //todo
      $axios
          .post("/todo", {
            password: newPassword
          })
          .catch(error => {
            console.log(error);
          });
    },
    retrieveRegister(context, newUser){
      $axios
          .post("/auth/register", newUser)
          .catch(error => {
            console.log(error);
          });
    },
    retrieveVerifyEmail(context, verifyData){
      $axios
          .post("auth/verifyemail", verifyData)
          .catch(error => {
            console.log(error);
          });
    }
  },
  getters: {
    loggedIn(state) {
      return state.token !== null && state.user !== null
    },
    user(state) {
      return state.user
    },
    userRoleList(state){
      return VueJwtDecode.decode(state.token).scopes;
    },
    hasRole: state => role => {
      let BreakException = {};
      let roleList = VueJwtDecode.decode(state.token).scopes;
      if(!Array.isArray(roleList)){
        roleList = new Array(roleList)
      }

      if(Array.isArray(role)){
        let result = false
        try {
          roleList.forEach(item => {
            if(role.includes(item)){
              result = true
              throw BreakException;
            }
          })
        } catch (e) {
          if (e !== BreakException) throw e;
        }

        return result
      } else {
        return roleList.includes(role)
      }
    },
    profile(state){
      return state.profile
    },

    isPermissionExist: state => /*permissionTag =>*/ {
      if(state.token == null){
        return false;
      }
      // let permissionValue = VueJwtDecode.decode(state.token).permission_value;
      // permissionValue = (permissionValue >>> 0).toString(2).padStart(64, '0');
      // // let shiftNo = permissionShift[permissionTag]
      // let shiftNo = undefined
      // return shiftNo !== undefined ? permissionValue[shiftNo] === '1' : false;

      return false;
    },
    token(state) {
      return state.token
    }
  }
};
