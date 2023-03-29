import Vue from "vue";
import Vuex from "vuex";

import shared from "./shared";
import loggedUser from "./loggedUser";
import dictionary from "./dictionary/dictionary";
import appeals from "./appeals";
import users from "./users";
import business from "./business";
import news from "./news";
import report from "./report";
import camunda from "./camunda";
import governmentProgramsReports from "./report/governmentProgramsReports";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        barColor: "rgba(0, 0, 0, .8), rgba(0, 0, 0, .8)",
        barImage: "",
        drawer: null
    },
    mutations: {
        SET_BAR_IMAGE(state, payload) {
            state.barImage = payload;
        },
        SET_DRAWER(state, payload) {
            state.drawer = payload;
        }
    },
    modules: {
        shared,
        loggedUser,
        dictionary,
        appeals,
        business,
        users,
        report,
        camunda,
        governmentProgramsReports,
        news,
    }
});
