import $axios from '../axios-instance.js';
import {makeFilesFormDateFormJson, processFileFormErrors} from "../../support/files";

const moduleName = 'UpiCuratorAppeal'

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
    getToWork: `[${moduleName}] getToWork`,
    backToWork: `[${moduleName}] backToWork`,
    assignExecutor: `[${moduleName}] assignExecutor`,
    assignCoExecutor: `[${moduleName}] assignCoExecutor`,
    assignCurator: `[${moduleName}] assignCurator`,
    complete: `[${moduleName}] complete`,
    reject: `[${moduleName}] reject`,
    excelExport: `[${moduleName}] excelExport`,
    excelExportMyAppeals: `[${moduleName}] excelExportMyAppeals`,
    reassignDistributorMultiple: `[${moduleName}] reassignDistributorMultiple`,
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
        [actionType.reassignDistributorMultiple](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .post(`upiCurator/appeals/reassign-distributor`, payload)
                    .then(response => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveAllAppealList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`upiCurator/appeals`, {params: payload})
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
                    .get(`upiCurator/appeals/indexByAuthUser`, {params: payload})
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
                    .get(`upiCurator/appeals/${payload.id}`)
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
                    .put(`upiCurator/appeals/${payload.id}/backToWork/`)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.assignExecutor](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .put(`upiCurator/appeals/${payload.id}/assignExecutor/`, payload)
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
                    .put(`upiCurator/appeals/${payload.id}/complete/`, payload)
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
            const formData = makeFilesFormDateFormJson(payload);

            return new Promise((resolve, reject) => {
                $axios
                    .post(`upiCurator/appeals/${payload.id}/reject/`, formData)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => processFileFormErrors(payload, error, resolve, reject))
            })
        },
        [actionType.excelExport](context, payload) {

            return new Promise((resolve, reject) => {
                $axios
                    .get(`upiCurator/appeals/exportToExcel`, {responseType: "arraybuffer", params: payload})
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
                    .get(`upiCurator/appeals/exportToExcelByAuthUser`, {responseType: "arraybuffer", params: payload})
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
