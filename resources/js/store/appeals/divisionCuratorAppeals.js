import $axios from '../axios-instance.js';

const moduleName = 'DivisionCurator'

export const mutationType = {
    retrieveAllAppealListRequest: `[${moduleName}] retrieveAllAppealListRequest`,
    retrieveAllAppealListSuccess: `[${moduleName}] retrieveAllAppealListSuccess`,
    retrieveAllAppealListError: `[${moduleName}] retrieveAllAppealListError`,
}

export const actionType = {
    retrieveAllAppealList: `[${moduleName}] retrieveAllAppealList`,
    retrieveMyAppealList: `[${moduleName}] retrieveMyAppealList`,
    retrieveMyList: `[${moduleName}] retrieveMyList`,
    retrieveAppeal: `[${moduleName}] retrieveAppeal`,

    backToWork: `[${moduleName}] backToWork`,
    complete: `[${moduleName}] complete`,
    reject: `[${moduleName}] reject`,
    excelExport: `[${moduleName}] excelExport`,
    excelExportMyAppeals: `[${moduleName}] excelExportMyAppeals`
}

export const getterType = {
    getAppealList: `[${moduleName}] getAppealList`,
    getTotalAppealCount: `[${moduleName}] getTotalAppealCount`,
}

export default {
    state: {
        appealList: [],
        totalAppealCount: 0,
        appealListError: null,
        appealListErrorCode: 0
    },
    mutations: {
        [mutationType.retrieveAllAppealListRequest](state) {
            state.appealList = []
            state.totalAppealCount = 0
            state.appealListError = null
            state.appealListErrorCode = 0
        },
        [mutationType.retrieveAllAppealListError](state, {errorCode, errorMessage}){
            state.appealList = []
            state.totalAppealCount = 0
            state.appealListError = errorMessage
            state.appealListErrorCode = errorCode
        },
        [mutationType.retrieveAllAppealListSuccess](state, obj) {
            state.appealList = obj.data
            state.totalAppealCount = obj.meta?.total
            state.appealListError = null
            state.appealListErrorCode = 0
        }
    },
    actions: {
        [actionType.retrieveAllAppealList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`divisionCurator/appeals`, {params: payload})
                    .then(response => {
                        context.commit(mutationType.retrieveAllAppealListSuccess, response.data)
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        context.commit(mutationType.retrieveAllAppealListError, {
                            errorCode: error.response.status,
                            errorMessage: {message: error.response.data.message, data: error.response.data.errors}
                        } )
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveMyAppealList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`divisionCurator/appeals/indexByAuthUser`, {params: payload})
                    .then(response => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveAppeal](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`divisionCurator/appeals/${payload.id}`)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },

        [actionType.backToWork](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .put(`divisionCurator/appeals/${payload.id}/backToWork/`)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.complete](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .put(`divisionCurator/appeals/${payload.id}/complete/`, payload)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.reject](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .put(`divisionCurator/appeals/${payload.id}/reject/`, payload)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.excelExport](context, payload) {

            return new Promise((resolve, reject) => {
                $axios
                    .get(`divisionCurator/appeals/exportAppeals`, payload)
                    .then(response => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.excelExportMyAppeals](context, payload) {

            return new Promise((resolve, reject) => {
                $axios
                    .get(`divisionCurator/appeals/exportToExcelByAuthUser`, payload)
                    .then(response => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
    },
    getters: {
        [getterType.getAppealList]: (state) => {
            return state.appealList;
        },
        [getterType.getTotalAppealCount]: (state) => {
            return state.totalAppealCount;
        },
    },
}
