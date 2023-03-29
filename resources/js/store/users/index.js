import $axios from '../axios-instance.js';

const moduleName = 'Users'

export const mutationType = {
    retrieveUserListRequest: `[${moduleName}] retrieveUserListRequest`,
    retrieveUserListSuccess: `[${moduleName}] retrieveUserListSuccess`,
    retrieveUserListError: `[${moduleName}] retrieveUserListError`,

    updateUserSuccess: `[${moduleName}] updateUserSuccess`,
    createUserSuccess: `[${moduleName}] createUserSuccess`,
}

export const actionType = {
    retrieveUserList: `[${moduleName}] retrieveUserList`,
    storeUser: `[${moduleName}] storeUser`,
    deleteUser: `[${moduleName}] deleteUser`,
}

export const getterType = {
    getUserList: `[${moduleName}] getUserList`,
    totalUserList: `[${moduleName}] totalUserList`
}

export default {
    state: {
        userList: [],
        totalUser: 0,
        userListError: null,
        userListErrorCode: 0
    },
    mutations: {
        [mutationType.retrieveUserListRequest](state) {
            state.userList = []
            state.totalUser = 0
            state.userListError = null
            state.userListErrorCode = 0
        },
        [mutationType.retrieveUserListError](state, {errorCode, errorMessage}) {
            state.userList = []
            state.totalUser = 0
            state.userListError = errorMessage
            state.userListErrorCode = errorCode
        },
        [mutationType.retrieveUserListSuccess](state, obj) {
            state.userList = obj.data
            state.totalUser = obj.meta.total
            state.userListError = null
            state.userListErrorCode = 0
        },

        [mutationType.updateUserSuccess](state, payload) {
            let entity = state.userList.find(function (item) {
                return item.id === payload.id
            })

            Object.assign(entity, payload);
        },
        [mutationType.createUserSuccess](state, entity) {
            state.userList.push(entity)
        },
    },
    actions: {
        [actionType.retrieveUserList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`admin/users`, {params: payload})
                    .then(response => {
                        context.commit(mutationType.retrieveUserListSuccess, response.data)
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        context.commit(mutationType.retrieveUserListError, {
                            errorCode: error.response.status,
                            errorMessage: {message: error.response.data.message, data: error.response.data.errors}
                        })
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.storeUser](context, payload) {
            return new Promise((resolve, reject) => {
                if (payload.id) {
                    $axios
                        .put(`admin/users/${payload.id}`, payload)
                        .then(response => {
                            context.commit(mutationType.updateUserSuccess, response.data.data)
                            resolve(response.data.data)
                        })
                        .catch(error => {
                            context.commit(mutationType.retrieveUserListError, {
                                errorCode: error.response.status,
                                errorMessage: {message: error.response.data.message, data: error.response.data.errors}
                            })
                            console.log(error)
                            reject(error)
                        })
                } else {
                    $axios
                        .post(`admin/users`, payload)
                        .then(response => {
                            context.commit(mutationType.createUserSuccess, response.data.data)
                            resolve(response.data.data)
                        })
                        .catch(error => {
                            context.commit(mutationType.retrieveUserListError, {
                                errorCode: error.response.status,
                                errorMessage: {message: error.response.data.message, data: error.response.data.errors}
                            })
                            console.log(error)
                            reject(error)
                        })
                }
            })
        },
        [actionType.deleteUser](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .delete(`admin/users/${payload.id}`, payload)
                    .then(response => {
                        resolve()
                    })
                    .catch(error => {
                        context.commit(mutationType.retrieveUserListError, {
                            errorCode: error.response.status,
                            errorMessage: {message: error.response.data.message, data: error.response.data.errors}
                        })
                        console.log(error)
                        reject(error)
                    })
            })
        }
    },
    getters: {
        [getterType.getUserList]: (state) => {
            return state.userList;
        },
        [getterType.totalUserList]: (state) => {
            return state.totalUser;
        },
    },
    modules: {}
}
