import $axios from './axios-instance.js';
import moment from "moment";

export default {
    state: {
        contentList: null,
        contentCard: null,
        contentSelectedProject: null
    },
    mutations: {
        retrieveContentSelectedProject(state, payload) {
            state.contentSelectedProject = payload
        },
        retrieveContentList(state, payload) {
            state.contentList = payload
        },
        insertContent(state, entity) {
            if(!entity.parent_id) {
                state.contentList.data.push(entity)
            } else {
                let _entity = state.contentList.data.find(function (item) {
                    return item.id === entity.parent_id
                })
                _entity.children.push({'id': entity.id, 'language': entity.language})
            }
        },
        updateContent(state, payload) {
            let entity = state.contentList.data.find(function (item) {
                return item.id === payload.id
            })

            Object.assign(entity, payload);
        },
        deleteContent(state, entity) {
            let entityIndex = state.contentList.data.findIndex(function (item) {
                return item.id === entity
            })
            if (entityIndex > -1) {
                state.contentList.data.splice(entityIndex, 1)
            }
        },
        publishContentList(state, payload) {
            let entity = state.contentList.data.find(function (item) {
                return item.id === payload.id
            })

            if(entity){
                entity.is_published = payload.publishState
            }
        },
        publishContentCard(state, payload) {
            if(state.contentCard){
                state.contentCard.is_published = payload.publishState
            }
        },
        retrieveContentCard(state, payload) {
            state.contentCard = payload
            state.contentCard.start_date = this._vm.$moment(state.contentCard.start_date).format('DD.MM.YYYY HH:mm:ss')
        },
        insertContentExpertComment(state, entity) {
            state.contentCard.expert_comments.push(entity)
        },
        updateContentExpertComment(state, payload) {
            let entity = state.contentCard.expert_comments.find(function (item) {
                return item.id === payload.id
            })

            Object.assign(entity, payload);
        },
        deleteContentExpertComment(state, entity) {
            let entityIndex = state.contentCard.expert_comments.findIndex(function (item) {
                return item.id === entity
            })
            if (entityIndex > -1) {
                state.contentCard.expert_comments.splice(entityIndex, 1)
            }
        },

        insertContentVideo(state, entity) {
            if(!state.contentCard.video){
                state.contentCard.video = []
            }
            state.contentCard.video.push(entity)
        },
        updateContentVideo(state, payload) {
            let entity = state.contentCard.video.find(function (item) {
                return item.id === payload.id
            })

            Object.assign(entity, payload);
        },
        deleteContentVideo(state, entity) {
            let entityIndex = state.contentCard.video.findIndex(function (item) {
                return item.id === entity
            })
            if (entityIndex > -1) {
                state.contentCard.video.splice(entityIndex, 1)
            }
        },

        insertContentImage(state, entity) {
            state.contentCard.images = entity
        },
        deleteContentImage(state, entity) {
            let entityIndex = state.contentCard.images.findIndex(function (item) {
                return item.id === entity
            })
            if (entityIndex > -1) {
                state.contentCard.images.splice(entityIndex, 1)
            }
        },
        setMainContentImage(state, id){
            state.contentCard.images.forEach(item => item.is_main = item.id === id)
        },
        setContentSlider(state, payload) {
            let entity = state.contentCard.sliders.find(function (item) {
                return item.id === payload.id
            })
            if(entity) {
                Object.assign(entity, payload);
            } else {
                state.contentCard.sliders.push(payload)
            }
        },
        deleteContentSlider(state, entity) {
            let entityIndex = state.contentCard.sliders.findIndex(function (item) {
                return item.id === entity
            })
            if (entityIndex > -1) {
                state.contentCard.sliders.splice(entityIndex, 1)
            }
        }
    },
    actions: {
        retrieveContentSelectedProject(context, payload) {
            return new Promise((resolve, reject) => {
                context.commit('retrieveContentSelectedProject', payload)
                resolve()
            })
        },
        retrieveContentList(context, payload) {
            return new Promise((resolve, reject) => {
                if(!payload){
                    context.commit('retrieveContentList', null)

                    resolve()
                } else {
                    $axios
                        .get(`contents`, {
                            params: {
                                project_id: payload.project_id,
                                per_page: payload.options.itemsPerPage,
                                page: payload.options.page,
                                search: payload.search
                            }
                        })
                        .then(response => {
                            context.commit('retrieveContentList', response.data)

                            resolve(response.data)
                        })
                        .catch(error => {
                            console.log(error)
                            reject(error)
                        })
                }
            })
        },
        setContent(context, payload) {
            return new Promise((resolve, reject) => {
                if (!payload.isUpdate) { //insert
                    try {
                        $axios
                            .post(`contents`, {
                                id: payload.id,
                                header: payload.header,
                                lead: payload.lead,
                                text: payload.text,
                                start_date: payload.start_date,
                                project_id: payload.project_id,
                                language: payload.language,
                                country_id: payload.country_id,
                                content_type_id: payload.content_type_id,
                                parent_id: payload.parent_id,
                            })
                            .then((response) => {
                                context.commit('insertContent', response.data.data)
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
                            .put(`contents/${payload.id}`, {
                                id: payload.id,
                                header: payload.header,
                                lead: payload.lead,
                                text: payload.text,
                                start_date: payload.start_date,
                                project_id: payload.project_id,
                                language: payload.language,
                                country_id: payload.country_id,
                                content_type_id: payload.content_type_id,
                            })
                            .then((response) => {
                                context.commit('updateContent', response.data.data)
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
        deleteContent(context, payload) {
            return new Promise((resolve, reject) => {
                try {
                    $axios
                        .delete(`contents/${payload.id}`)
                        .then(() => {
                            context.commit(`deleteContent`, payload.id)
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
        publishContent(context, payload){
            return new Promise((resolve, reject) => {
                $axios
                    .post(`contents/${payload}/publish`)
                    .then((response) => {
                        context.commit('publishContentList', {
                            id: payload,
                            publishState: true
                        })
                        resolve()
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        unpublishContent(context, payload){
            return new Promise((resolve, reject) => {
                $axios
                    .post(`contents/${payload}/unpublish`)
                    .then((response) => {
                        context.commit('publishContentList', {
                            id: payload,
                            publishState: false
                        })
                        resolve()
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        retrieveContentCard(context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`contents/${payload}`)
                    .then(response => {
                        context.commit('retrieveContentCard', response.data.data)
                        resolve()
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        updateContentCard(context, payload) {
            return new Promise((resolve, reject) => {
                try {
                    $axios
                        .put(`contents/${payload.id}`, {
                            id: payload.id,
                            header: payload.header,
                            lead: payload.lead,
                            text: payload.text,
                            start_date: payload.start_date,
                            project_id: payload.project_id,
                            language: payload.language,
                            country_id: payload.country_id,
                            content_type_id: payload.content_type_id,
                        })
                        .then((response) => {
                            context.commit('retrieveContentCard', response.data.data)
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
        publishContentCard(context, payload){
            return new Promise((resolve, reject) => {
                $axios
                    .post(`contents/${payload}/publish`)
                    .then((response) => {
                        context.commit('publishContentCard', {
                            id: payload,
                            publishState: true
                        })
                        resolve()
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        unpublishContentCard(context, payload){
            return new Promise((resolve, reject) => {
                $axios
                    .post(`contents/${payload}/unpublish`)
                    .then((response) => {
                        context.commit('publishContentCard', {
                            id: payload,
                            publishState: false
                        })
                        resolve()
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        addContentTag(context, payload) {
            return new Promise((resolve, reject) => {
                // let tagList = this.getters.contentCard.tags.map(function (item) {
                //     return item.name
                // })
                // tagList = tagList.concat(payload.tags);
                $axios
                    .put(`contents/${payload.id}`, {
                        id: payload.id,
                        // tags: tagList
                        tags: payload.tags
                    })
                    .then(response => {
                        context.commit('retrieveContentCard', response.data.data)

                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        deleteContentTag(context, payload) {
            return new Promise((resolve, reject) => {
                let removingTag = payload.tagId
                let tagList = this.getters.contentCard.tags.map(function (item) {
                    if (item.id !== removingTag)
                        return item.name
                })
                $axios
                    .put(`contents/${payload.id}`, {
                        id: payload.id,
                        tags: tagList
                    })
                    .then(response => {
                        context.commit('retrieveContentCard', response.data.data)

                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        setContentExpertComment(context, payload) {
            return new Promise((resolve, reject) => {
                if (!payload.isUpdate) { //insert
                    try {
                        $axios
                            .post(`contents/${payload.content_id}/expert_comments`, {
                                id: payload.id,
                                content_id: payload.content_id,
                                expert_id: payload.expert_id,
                                text: payload.text
                            })
                            .then((response) => {
                                context.commit('insertContentExpertComment', response.data.data)
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
                            .put(`contents/${payload.content_id}/expert_comments/${payload.id}`, {
                                id: payload.id,
                                text: payload.text
                            })
                            .then((response) => {
                                context.commit('updateContentExpertComment', response.data.data)
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
        deleteContentExpertComment(context, payload) {
            return new Promise((resolve, reject) => {
                try {
                    $axios
                        .delete(`contents/${payload.content_id}/expert_comments/${payload.id}`)
                        .then(() => {
                            context.commit(`deleteContentExpertComment`, payload.id)
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
        setContentVideo(context, payload) {
            return new Promise((resolve, reject) => {
                if (!payload.isUpdate) { //insert
                    try {
                        $axios
                            .post(`contents/${payload.content_id}/videos`, {
                                id: payload.id,
                                content_id: payload.content_id,
                                url: payload.url
                            })
                            .then((response) => {
                                context.commit('insertContentVideo', response.data.data)
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
                            .put(`contents/${payload.content_id}/videos/${payload.id}`, {
                                id: payload.id,
                                url: payload.url
                            })
                            .then((response) => {
                                context.commit('updateContentVideo', response.data.data)
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
        deleteContentVideo(context, payload) {
            return new Promise((resolve, reject) => {
                try {
                    $axios
                        .delete(`contents/${payload.content_id}/videos/${payload.id}`)
                        .then(() => {
                            context.commit(`deleteContentVideo`, payload.id)
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
        setContentImage(context, payload) {
            return new Promise((resolve, reject) => {
                try {
                    $axios
                        .post(`contents/${payload.content_id}/images`, {
                            medias: payload.medias
                        })
                        .then((response) => {
                            context.commit('insertContentImage', response.data.data)
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
        deleteContentImage(context, payload) {
            return new Promise((resolve, reject) => {
                try {
                    $axios
                        .delete(`contents/${payload.content_id}/images/${payload.id}`)
                        .then(() => {
                            context.commit(`deleteContentImage`, payload.id)
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
        setMainContentImage(context, payload) {
            return new Promise((resolve, reject) => {
                try {
                    $axios
                        .put(`contents/${payload.content_id}/images/${payload.id}`, {
                            id: payload.id,
                            is_main: true
                        })
                        .then(() => {
                            context.commit(`setMainContentImage`, payload.id)
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
        setContentSlider(context, payload) {
            return new Promise((resolve, reject) => {
                try {
                    $axios
                        .post(`contents/${payload.content_id}/sliders`, payload)
                        .then((response) => {
                            context.commit('setContentSlider', response.data.data)
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
        deleteContentSlider(context, payload) {
            return new Promise((resolve, reject) => {
                try {
                    $axios
                        .delete(`contents/${payload.content_id}/sliders/${payload.id}`)
                        .then(() => {
                            context.commit(`deleteContentSlider`, payload.id)
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
        contentSelectedProject(state) {
            return state.contentSelectedProject
        },
        contentList(state) {
            return state.contentList ? (state.contentList.data ?? []) : []
        },
        contentListMeta(state) {
            return state.contentList ? state.contentList.meta : null
        },
        contentCard(state) {
            return state.contentCard
        }
    }
}
