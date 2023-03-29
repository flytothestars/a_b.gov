import $axios from '../axios-instance.js';

export const moduleName = 'tag'

export const mutationType = {
    retrieveList: `[${moduleName}] retrieveList`,
    insert: `[${moduleName}] insert`,
    update: `[${moduleName}] update`,
    delete: `[${moduleName}] delete`,
}

export const actionType = {
    retrieveList: `[${moduleName}] retrieveList`,
    clearList: `[${moduleName}] clearList`,
    set: `[${moduleName}] set`,
    delete: `[${moduleName}] delete`,
}

export const getterType = {
    getList: `[${moduleName}] getList`,
}

export default {
    state: {
        list: []
    },
    mutations: {
        [mutationType.retrieveList](state, payload) {
            state.list = payload
        },
        [mutationType.insert](state, entity) {
            state.list.push(entity)
        },
        [mutationType.update](state, payload) {
            let entity = state.list.find(function (item) {
                return item.id === payload.id
            })

            Object.assign(entity, payload);
        },
        [mutationType.delete](state, entity) {
            let entityIndex = state.list.findIndex(function (item) {
                return item.id === entity
            })
            if (entityIndex > -1) {
                state.list.splice(entityIndex, 1)
            }
        }
    },
    actions: {
        [actionType.retrieveList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`projects/${payload.project}/tags`, {
                        params: payload
                    })
                    .then(response => {
                        context.commit(mutationType.retrieveList, response.data.data)

                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.clearList](context, payload) {
            return new Promise((resolve, reject) => {
                context.commit(mutationType.retrieveList, [])
                resolve()
            })
        },
        [actionType.set](context, payload) {
            return new Promise((resolve, reject) => {
                if (!payload.isUpdate) { //insert
                    try {
                        $axios
                            .post(`projects/${payload.project}/tags`, {
                                id: payload.id,
                                name: payload.name,
                                translations: payload.translations
                            })
                            .then(() => {
                                context.commit(mutationType.insert, payload)
                                resolve()
                            })
                            .catch(error => {
                                console.log(error)
                                reject(error)
                            })
                    } catch (error) {
                        console.log(error)
                        reject(error)
                    }
                } else { //update
                    try {
                        $axios
                            .put(`projects/${payload.project}/tags/${payload.id}`, {
                                id: payload.id,
                                name: payload.name,
                                translations: payload.translations
                            })
                            .then(() => {
                                context.commit(mutationType.update, payload)
                                resolve()
                            })
                            .catch(error => {
                                console.log(error)
                                reject(error)
                            })
                    } catch (error) {
                        console.log(error)
                        reject(error)
                    }
                }
            })
        },
        [actionType.delete](context, payload) {
            return new Promise((resolve, reject) => {
                try {
                    $axios
                        .delete(`projects/${payload.project}/tags/${payload.id}`)
                        .then(() => {
                            context.commit(mutationType.delete, payload.id)
                            resolve()
                        })
                        .catch(error => {
                            console.log(error)
                            reject(error)
                        })
                } catch (error) {
                    console.log(error)
                    reject(error)
                }
            })
        },
    },
    getters: {
        [getterType.getList](state) {
            return state.list
        }
    }
}
