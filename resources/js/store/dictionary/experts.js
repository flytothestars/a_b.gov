import $axios from '../axios-instance.js';

export const moduleName = 'expert'

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
                    .get(`experts`)
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
                try {
                    let formData = new FormData()
                    if (payload.photo) {
                        formData.append('photo', payload.photo)
                    }
                    if(payload.id) {
                        formData.append('id', payload.id)
                    }
                    formData.append('first_name', payload.first_name)
                    formData.append('last_name', payload.last_name)
                    formData.append('position', payload.position)

                    let url = `experts`
                    if(payload.isUpdate) {
                        formData.append('_method', 'PUT')
                        url += `/${payload.id}`
                    }

                    formData.append('translations', JSON.stringify(payload.translations.map(item => {
                            return {
                                language: item.language,
                                content: item.content
                            }
                        })
                    ))

                    $axios
                        .post(url, formData)
                        .then(response => {
                            if(!payload.isUpdate) {
                                context.commit(mutationType.insert, response.data.data)
                            } else {
                                context.commit(mutationType.update, response.data.data)
                            }
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
        [actionType.delete](context, payload) {
            return new Promise((resolve, reject) => {
                try {
                    $axios
                        .delete(`experts/${payload.id}`)
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
