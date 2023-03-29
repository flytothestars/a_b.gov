// require('./bootstrap');

import Vue from 'vue'
import App from './App.vue'
import VueLodash from 'vue-lodash'
import lodash from 'lodash'
import moment from "moment"

import store from './store'
import router from './router'
import vuetify from './plugins/vuetify' // path to vuetify export


import './plugins/base'

import DatetimePicker from 'vuetify-datetime-picker'
Vue.use(DatetimePicker)
import youtube from 'vue-youtube'
Vue.use(youtube)

Vue.prototype.$moment = moment

Vue.prototype.$langs = {
    default: 'ru',
    translationList: ['en', 'kk']
}

import "./plugins/vue_mixin"
import "./plugins/vue_filter"

let VueCookie = require('vue-cookie');
Vue.use(VueCookie);
Vue.use(VueLodash, {lodash: lodash})

import VueUUID from "vue-uuid";
Vue.use(VueUUID);

window.Vue = new Vue({
    vuetify,
    store,
    router,
    render: h => h(App),
    el: '#app'
}).$mount()

window.VueEvent = new class {
    constructor() {
        this.vue = new Vue()
    }

    fire(event, data = null) {
        this.vue.$emit(event, data)
    }

    listen(event, callback) {
        this.vue.$on(event, callback)
    }

    off(){
        this.vue.$off();
    }
}

if(window.Vue.$cookie.get('yupi_lang')){
    window.i18n.locale = window.Vue.$cookie.get('yupi_lang')
}

