import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader

import Vue from 'vue'
import Vuetify from 'vuetify'
import VueI18n from 'vue-i18n'
import 'vuetify/dist/vuetify.min.css'
import colors from 'vuetify/lib/util/colors'

import en from '../messages/en'
import ru from '../messages/ru'
import kk from '../messages/kk'
import SvgIcons from "./svg-icons";

Vue.use(Vuetify)
Vue.use(VueI18n)

// Create VueI18n instance with options
const i18n = new VueI18n({
    locale: 'ru', // set locale
    messages: {ru, en}, // set locale messages
})

const theme = {
    primary: '#6389df',
    secondary: '#2196F3',
    accent: '#4078e4',
    info: '#00CAE3',
    background: '#00CAE3'
}

const opts = {
    lang: {
        t: (key, ...params) => i18n.t(key, params),
        locales: {ru, en, kk},
        current: 'ru',
    },
    icons: {
        iconfont: 'mdi', // default - only for display purposes
        values: {
            ...SvgIcons
        }
    },
    theme: {
        themes: {
            dark: theme,
            light: theme,
        },
    },
}

export default new Vuetify(opts)

window.i18n = i18n
//i18n.locale = document.getElementsByTagName('html')[0].getAttribute('lang')
