import Vue from "vue";
import moment from "moment";

Vue.filter('formatDateTime', function (value) {
    if (value) {
        return moment(String(value)).format('DD.MM.YYYY HH:mm')
    }
})
Vue.filter('formatDateTime2', function (value) {
    if (value) {
        return moment(String(value)).format('DD.MM.YYYY, HH:mm')
    }
})
Vue.filter('formatDate', function (value) {
    if (value) {
        return moment(String(value)).format('DD.MM.YYYY')
    }
})
Vue.filter('formatTime', function (value) {
    if (value) {
        return moment(String(value), 'HH:mm:ss').format('HH:mm')
    }
})
