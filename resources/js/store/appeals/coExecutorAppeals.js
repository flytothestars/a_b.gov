import $axios from '../axios-instance.js';
import {makeFilesFormDateFormJson, processFileFormErrors} from "../../support/files";

const moduleName = 'CoExecutorAppeal'

export const mutationType = {
}

export const actionType = {
    retrieveAllAppealList: `[${moduleName}] retrieveAllAppealList`,
    retrieveMyAppealList: `[${moduleName}] retrieveMyAppealList`,
    retrieveMyList: `[${moduleName}] retrieveMyList`,
    retrieveAppeal: `[${moduleName}] retrieveAppeal`,
    getToWork: `[${moduleName}] getToWork`,
    assignExecutor: `[${moduleName}] assignExecutor`,
    assignCoExecutor: `[${moduleName}] assignCoExecutor`,
    complete: `[${moduleName}] complete`,
    reject: `[${moduleName}] reject`,
    excelExport: `[${moduleName}] excelExport`,
    excelExportMyAppeals: `[${moduleName}] excelExportMyAppeals`
}

export const getterType = {
}

export default {
    state: {
    },
    mutations: {
    },
    actions: {
        [actionType.retrieveAllAppealList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`coexecutor/appeals`)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveMyAppealList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`coexecutor/appeals/indexByAuthUser`, {params: payload})
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
                    .get(`coexecutor/appeals/${payload.id}`)
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
                    .put(`coexecutor/appeals/${payload.id}/getToWork/`)
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
                    .post(`coexecutor/appeals/${payload.id}/complete/`, formData)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => processFileFormErrors(payload, error, resolve, reject))
            })
        },
        [actionType.reject](context, payload) {
            const formData = makeFilesFormDateFormJson(payload);

            return new Promise((resolve, reject) => {
                $axios
                    .post(`coexecutor/appeals/${payload.id}/reject/`, formData)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => processFileFormErrors(payload, error, resolve, reject))
            })
        },
        [actionType.excelExport](context, payload) {

            return new Promise((resolve, reject) => {
                $axios
                    .get(`coexecutor/appeals/exportToExcel`, {responseType: "arraybuffer", params: payload})
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
                    .get(`coexecutor/appeals/exportToExcelByAuthUser`, {responseType: "arraybuffer", params: payload})
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
    },
}
