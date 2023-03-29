import headAppeals from './headAppeals'
import upiHeadAppeals from './upiHeadAppeals'
import distributorAppeals from './distributorAppeals'
import executorAppeals from './executorAppeals'
import coExecutorAppeals from './coExecutorAppeals'
import districtCuratorAppeals from './districtCuratorAppeals'
import upiCuratorAppeals from './upiCuratorAppeals'
import divisionCuratorAppeals from './divisionCuratorAppeals'
import iemanagerAppeals from './iemanagerAppeals'
import $axios from "../axios-instance";

const moduleName = 'Appeal'

export const mutationType = {
    appealHistorySuccess: `[${moduleName} appealHistorySuccess]`,
}

export const actionType = {
    retrieveAppealHistory: `[${moduleName}] retrieveAppealHistory`,
}

export const getterType = {
    getAppealHistory: `[${moduleName}] getAppealHistory`,
}

export default {
    state: {
        appealHistoryList: null
    },
    mutations: {
        [mutationType.appealHistorySuccess](state, obj) {
            state.appealHistoryList = obj
        },
    },
    actions: {
        [actionType.retrieveAppealHistory](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`/appeals/${payload.id}/history/`)
                    .then(response => {
                        context.commit(mutationType.appealHistorySuccess, response.data.data)
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
    },
    getters: {
        [getterType.getAppealHistory]: (state) => {
            return state.appealHistoryList
        },
    },
    modules: {
        upiHeadAppeals,
        headAppeals,
        distributorAppeals,
        executorAppeals,
        coExecutorAppeals,
        districtCuratorAppeals,
        upiCuratorAppeals,
        divisionCuratorAppeals,
        iemanagerAppeals
    }
}
