import $axios from '../axios-instance.js';

const moduleName = 'Camunda'

export const mutationType = {}

export const actionType = {
    getClientSettings: `[${moduleName}] getClientSettings`,
    storeClientSettings: `[${moduleName}] storeClientSettings`,
    getBpmnDiagramXml: `[${moduleName}] getBpmnDiagramXml`,
    getBpmnHistory: `[${moduleName}] getBpmnHistory`,
    getTask: `[${moduleName}] getTask`,

    startProcess: `[${moduleName}] startProcess`,
}

export const getterType = {}

export default {
    state: {},
    mutations: {},
    actions: {
        [actionType.getClientSettings](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`camunda/client_settings`)
                    .then(response => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.storeClientSettings](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .put(`camunda/client_settings`, payload)
                    .then(response => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.getBpmnDiagramXml](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`camunda/bpmn_diagram_xml`)
                    .then(response => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.getBpmnHistory](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`camunda/bpmn_history/${payload.id}`)
                    .then(response => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.startProcess](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`camunda/test_start/${payload.id}`)
                    .then(response => {
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.getTask](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`camunda/getAvailableTask`, {
                        params: {
                            processDefinitionKey: payload.processDefinitionKey,
                            candidateGroup: payload.candidateGroup,
                            user: payload.user,
                            businessKey: payload.businessKey,
                        }
                    })
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
    modules: {}
}
