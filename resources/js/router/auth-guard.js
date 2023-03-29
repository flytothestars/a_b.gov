import store from '../store'

export default function (to, from, next){
    if(store.getters.user){
        next()
    } else {
        store.dispatch('setError', 'Please login')
        next({name:'Login'})
    }
}
