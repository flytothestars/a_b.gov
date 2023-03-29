import axios from 'axios'
import store from './index'
import router from "../router/index";

const $axios = axios.create({
    baseURL: '/api/',
    timeout: 1000000000,
})

$axios.defaults.timeout = 1000000000;

$axios.interceptors.request.use(
    config => {
        store.dispatch('clearError')

        const token = store.getters.token

        if (token) {
            config.headers.Authorization = `Bearer ${token}`
        }

        store.dispatch('setLoading', true)
        return config
    },
    error => {
        store.dispatch('setLoading', false)
        store.dispatch('setError', error.response.data.message)

        return Promise.reject(error)
    })

$axios.interceptors.response.use(
    response => {
        store.dispatch('setLoading', false)
        return response
    },
    error => {
        if (typeof error.response === 'undefined') {
            // alert('A network error occurred. ' +
            //     'This could be a CORS issue or a dropped internet connection. ' +
            //     'It is not possible for us to know.')

            return Promise.reject(error.response)
        }

        if (error.response.status === 401 && error.response.config && !error.response.config.__isRetryRequest && error.response.data.message != 'Invalid Credentials') {
            store.dispatch('logoff').then(() => {
                router.push({ name: 'Login' })
            })
        }

        store.dispatch('setLoading', false)
        if (error.response) {
            if (error.response.data.errors) {
                store.dispatch('setError', error.response.data.errors)
            }
            if (error.response.data.message) {
                store.dispatch('setError', error.response.data.message)
            }

        } else {
            store.dispatch('setError', 'Something went wrong')
        }
        return Promise.reject(error.response)
    })

export default $axios
