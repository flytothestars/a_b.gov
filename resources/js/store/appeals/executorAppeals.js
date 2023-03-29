import $axios from '../axios-instance.js';
import {makeFilesFormDateFormJson, processFileFormErrors} from "../../support/files";

const moduleName = 'ExecutorAppeal'

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
    assignCoExecutor: `[${moduleName}] assignCoExecutor`,
    complete: `[${moduleName}] complete`,
    reject: `[${moduleName}] reject`,
    excelExport: `[${moduleName}] excelExport`,
    excelExport2: `[${moduleName}] excelExport2`,
    excelExport3: `[${moduleName}] excelExport3`,
    excelExportMyAppeals: `[${moduleName}] excelExportMyAppeals`,
    consultationProvidedQolday: `[${moduleName}] consultationProvidedQolday`,
    consultationProvidedNotQolday: `[${moduleName}] consultationProvidedNotQolday`,
    cantContact: `[${moduleName}] cantContact`,
    requiresClarification: `[${moduleName}] requiresClarification`,
    backToWork: `[${moduleName}] backToWork`,
    editCategory: `[${moduleName}] editCategory`,
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
        [mutationType.retrieveAllAppealListError](state, {errorCode, errorMessage}) {
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
                    .get(`executor/appeals`, {params: payload})
                    .then(response => {
                        context.commit(mutationType.retrieveAllAppealListSuccess, response.data)
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        context.commit(mutationType.retrieveAllAppealListError, {
                            errorCode: error.response.status,
                            errorMessage: {message: error.response.data.message, data: error.response.data.errors}
                        })
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveMyAppealList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`executor/appeals/indexByAuthUser`, {params: payload})
                    .then(response => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.consultationProvidedQolday](context, payload) {
            return new Promise((resolve, reject) => {
                console.log('payload', payload)
                $axios
                    .put(`executor/appeals/${payload.id}/byProduct/`, payload)
                    .then(response => resolve(response.data.data))
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.consultationProvidedNotQolday](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .put(`executor/appeals/${payload.id}/notByProduct/`, payload)
                    .then(response => resolve(response.data.data))
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.requiresClarification](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .put(`executor/appeals/${payload.id}/requiresClarification/`, payload)
                    .then(response => resolve(response.data.data))
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.backToWork](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .put(`executor/appeals/${payload.id}/backToWork/`)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.cantContact](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .put(`executor/appeals/${payload.id}/cantContact/`)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.editCategory](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .post(`executor/appeals/${payload.id}/edit-category`, payload)
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
                    .get(`executor/appeals/${payload.id}`)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },

        [actionType.getToWork](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .put(`executor/appeals/${payload.id}/getToWork/`)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.assignCoExecutor](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .put(`executor/appeals/${payload.id}/assignCoExecutor/`, payload)
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
            const formData = makeFilesFormDateFormJson(payload);

            return new Promise((resolve, reject) => {
                $axios
                    .post(`executor/appeals/${payload.id}/complete/`, formData)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => processFileFormErrors(payload, error, resolve, reject))
            });
        },
        [actionType.reject](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .put(`executor/appeals/${payload.id}/reject/`, payload)
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
                    .get(`executor/appeals/exportToExcel`, {responseType: "arraybuffer", params: payload})
                    .then(response => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.excelExport2](context, payload) {

            return new Promise((resolve, reject) => {
                $axios
                    .get(`admin/appeals/exportToExcel2`, {responseType: "arraybuffer", params: payload})
                    .then(response => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.excelExport3](context, payload) {

            return new Promise((resolve, reject) => {
                $axios
                    .get(`admin/appeals/exportToExcel3`, {responseType: "arraybuffer", params: payload})
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
                    .get(`executor/appeals/exportToExcelByAuthUser`, {responseType: "arraybuffer", params: payload})
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
