import $axios from '../axios-instance.js';

export const moduleName = 'dictionary'

export const mutationType = {
    retrieveDistrictDictionaryList: `[${moduleName}] retrieveDistrictDictionaryList`,
    appealStatusDictionaryList: `[${moduleName}] appealStatusDictionaryList`,
    appealCategoryDictionaryList: `[${moduleName}] appealCategoryDictionaryList`,
    appealSourceTypeDictionaryList: `[${moduleName}] appealSourceTypeDictionaryList`,
    retrieveExecutorDictionaryList: `[${moduleName}] retrieveExecutorDictionaryList`,
    retrieveDistributorDictionaryList: `[${moduleName}] retrieveDistributorDictionaryList`,
    retrieveExecutorUPIDictionaryList: `[${moduleName}] retrieveExecutorUPIDictionaryList`,
    retrieveCoExecutorDictionaryList: `[${moduleName}] retrieveCoExecutorDictionaryList`,
    retrieveUpiCuratorDictionaryList: `[${moduleName}] retrieveUpiCuratorDictionaryList`,
    retrieveDistrictCuratorDictionaryList: `[${moduleName}] retrieveDistrictCuratorDictionaryList`,
    retrieveIndustryDictionaryList: `[${moduleName}] retrieveIndustryDictionaryList`,
    retrieveRoleDictionaryList: `[${moduleName}] retrieveRoleDictionaryList`,
    retrieveDepartmentDictionaryList: `[${moduleName}] retrieveDepartmentDictionaryList`,
    retrieveBusinessStatusesList: `[${moduleName}] retrieveBusinessStatusesList`,
    retrieveServiceCategoryList: `[${moduleName}] retrieveServiceCategoryList`,
}

export const actionType = {
    retrieveDistrictDictionaryList: `[${moduleName}] retrieveDistrictDictionaryList`,
    appealStatusDictionaryList: `[${moduleName}] appealStatusDictionaryList`,
    appealCategoryDictionaryList: `[${moduleName}] appealCategoryDictionaryList`,
    appealSourceTypeDictionaryList: `[${moduleName}] appealSourceTypeDictionaryList`,
    retrieveExecutorDictionaryList: `[${moduleName}] retrieveExecutorDictionaryList`,
    retrieveDistributorDictionaryList: `[${moduleName}] retrieveDistributorDictionaryList`,
    retrieveExecutorUPIDictionaryList: `[${moduleName}] retrieveExecutorUPIDictionaryList`,
    retrieveCoExecutorDictionaryList: `[${moduleName}] retrieveCoExecutorDictionaryList`,
    retrieveCoExecutorDictionaryListByDepartment: `[${moduleName}] retrieveCoExecutorDictionaryListByDepartment`,
    retrieveAppealResultTypeList: `[${moduleName}] retrieveAppealResultTypeList`,
    retrieveAppealResultTypesAllList: `[${moduleName}] retrieveAppealResultTypesAllList`,
    retrieveUpiCuratorDictionaryList: `[${moduleName}] retrieveUpiCuratorDictionaryList`,
    retrieveDistrictCuratorDictionaryList: `[${moduleName}] retrieveDistrictCuratorDictionaryList`,
    retrieveIndustryDictionaryList: `[${moduleName}] retrieveIndustryDictionaryList`,
    retrieveRoleDictionaryList: `[${moduleName}] retrieveRoleDictionaryList`,
    retrieveDepartmentDictionaryList: `[${moduleName}] retrieveDepartmentDictionaryList`,
    retrieveBusinessStatusesList: `[${moduleName}] retrieveBusinessStatusesList`,
    retrieveServiceCategoryList: `[${moduleName}] retrieveServiceCategoryList`,
}

export const getterType = {
    getDistrictDictionaryList: `[${moduleName}] getDistrictDictionaryList`,
    getAppealStatusDictionaryList: `[${moduleName}] getAppealStatusDictionaryList`,
    getAppealCategoryDictionaryList: `[${moduleName}] getAppealCategoryDictionaryList`,
    getExecutorDictionaryList: `[${moduleName}] getExecutorDictionaryList`,
    getDistributorDictionaryList: `[${moduleName}] getDistributorDictionaryList`,
    getExecutorUPIDictionaryList: `[${moduleName}] getExecutorUPIDictionaryList`,
    getCoExecutorDictionaryList: `[${moduleName}] getCoExecutorDictionaryList`,
    getUpiCuratorDictionaryList: `[${moduleName}] getUpiCuratorDictionaryList`,
    getDistrictCuratorDictionaryList: `[${moduleName}] getDistrictCuratorDictionaryList`,
    getIndustryDictionaryList: `[${moduleName}] getIndustryDictionaryList`,
    getRoleDictionaryList: `[${moduleName}] getRoleDictionaryList`,
    getDepartmentDictionaryList: `[${moduleName}] getDepartmentDictionaryList`,
    getBusinessStatusesList: `[${moduleName}] getBusinessStatusesList`,
    getServiceCategoryList: `[${moduleName}] getServiceCategoryList`
}

export default {
    state: {
        districtDictionaryList: null,
        executorDictionaryList: null,
        distributorDictionaryList: null,
        executorUPIDictionaryList: null,
        coExecutorDictionaryList: null,
        upiCuratorDictionaryList: null,
        districtCuratorDictionaryList: null,
        appealStatusDictionaryList: null,
        appealCategoryDictionaryList: null,
        appealIndustryDictionaryList: null,
        appealRoleDictionaryList: null,
        appealDepartmentDictionaryList: null,
        businessStatusesList: null,
        serviceCategoryList: null,
    },
    mutations: {
        [mutationType.retrieveDistrictDictionaryList](state, payload) {
            state.districtDictionaryList = payload
        },
        [mutationType.appealStatusDictionaryList](state, payload) {
            state.appealStatusDictionaryList = payload
        },
        [mutationType.appealCategoryDictionaryList](state, payload) {
            state.appealCategoryDictionaryList = payload
        },
        [mutationType.retrieveExecutorDictionaryList](state, payload) {
            state.executorDictionaryList = payload
        },
        [mutationType.retrieveDistributorDictionaryList](state, payload) {
            state.distributorDictionaryList = payload
        },
        [mutationType.retrieveExecutorUPIDictionaryList](state, payload) {
            state.executorUPIDictionaryList = payload
        },
        [mutationType.retrieveCoExecutorDictionaryList](state, payload) {
            state.coExecutorDictionaryList = payload
        },
        [mutationType.retrieveUpiCuratorDictionaryList](state, payload) {
            state.upiCuratorDictionaryList = payload
        },
        [mutationType.retrieveDistrictCuratorDictionaryList](state, payload) {
            state.districtCuratorDictionaryList = payload
        },
        [mutationType.retrieveIndustryDictionaryList](state, payload) {
            state.appealIndustryDictionaryList = payload
        },
        [mutationType.retrieveRoleDictionaryList](state, payload) {
            state.appealRoleDictionaryList = payload
        },
        [mutationType.retrieveDepartmentDictionaryList](state, payload) {
            state.appealDepartmentDictionaryList = payload
        },
        [mutationType.retrieveBusinessStatusesList](state, payload) {
            state.businessStatusesList = payload
        },
        [mutationType.retrieveServiceCategoryList](state, payload) {
            state.serviceCategoryList = payload
        },
    },
    actions: {
        [actionType.retrieveDistrictDictionaryList](context) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/district')
                    .then(response => {
                        context.commit(mutationType.retrieveDistrictDictionaryList, response.data)
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveServiceCategoryList](context) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/serviceCategories')
                    .then(response => {
                        context.commit(mutationType.retrieveServiceCategoryList, response.data)
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.appealSourceTypeDictionaryList](context) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/appealSource')
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.appealStatusDictionaryList](context) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/appealStatus')
                    .then(response => {
                        context.commit(mutationType.appealStatusDictionaryList, response.data)
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.appealCategoryDictionaryList](context) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/serviceGroup')
                    .then(response => {
                        context.commit(mutationType.appealCategoryDictionaryList, response.data)
                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveExecutorDictionaryList](context) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/user/executorList')
                    .then(response => {
                        context.commit(mutationType.retrieveExecutorDictionaryList, response.data)

                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveDistributorDictionaryList](context) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/user/distributorList')
                    .then(response => {
                        context.commit(mutationType.retrieveDistributorDictionaryList, response.data)

                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveExecutorUPIDictionaryList](context) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/user/executorUPIList')
                    .then(response => {
                        context.commit(mutationType.retrieveExecutorUPIDictionaryList, response.data)

                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveCoExecutorDictionaryListByDepartment](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`dictionary/user/coExecutorList/${payload?.department_id}`)
                    .then(response => {
                        context.commit(mutationType.retrieveCoExecutorDictionaryList, response.data)

                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveCoExecutorDictionaryList](context) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`dictionary/user/coExecutorList/`)
                    .then(response => {
                        context.commit(mutationType.retrieveCoExecutorDictionaryList, response.data)

                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveUpiCuratorDictionaryList](context) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/user/upiCuratorList')
                    .then(response => {
                        context.commit(mutationType.retrieveUpiCuratorDictionaryList, response.data)

                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveDistrictCuratorDictionaryList](context) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/user/districtCuratorList')
                    .then(response => {
                        context.commit(mutationType.retrieveDistrictCuratorDictionaryList, response.data)

                        resolve(response.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveAppealResultTypeList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/appealResultTypes', {
                        params: {
                            appeal_id: payload.appeal_id,
                            to_appeal_status_id: payload.to_appeal_status_id
                        }
                    })
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveAppealResultTypesAllList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/appealResultTypesAll')
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveIndustryDictionaryList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/industries').then(response => {
                        context.commit(mutationType.retrieveIndustryDictionaryList, response.data)
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveRoleDictionaryList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/roles').then(response => {
                        context.commit(mutationType.retrieveRoleDictionaryList, response.data)
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveDepartmentDictionaryList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/departments').then(response => {
                        context.commit(mutationType.retrieveDepartmentDictionaryList, response.data)
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        console.log(error)
                        reject(error)
                    })
            })
        },
        [actionType.retrieveBusinessStatusesList](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get('dictionary/businessStatuses').then(response => {
                        context.commit(mutationType.retrieveBusinessStatusesList, response.data)
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
        [getterType.getDistrictDictionaryList](state) {
            return state.districtDictionaryList ? state.districtDictionaryList.data : []
        },
        [getterType.getAppealStatusDictionaryList](state) {
            return state.appealStatusDictionaryList ? state.appealStatusDictionaryList.data : []
        },
        [getterType.getAppealCategoryDictionaryList](state) {
            return state.appealCategoryDictionaryList 
                ? state.appealCategoryDictionaryList.data
                    .filter(c => c.id !== '0a9ef160-d7b3-4ccf-825d-aa96ea751501'  && c.id !== '8988c6a5-4bec-498d-9b76-98df6167035f') 
                : []
        },
        [getterType.getExecutorDictionaryList](state) {
            return state.executorDictionaryList ? state.executorDictionaryList.data : []
        },
        [getterType.getDistributorDictionaryList](state) {
            return state.distributorDictionaryList ? state.distributorDictionaryList.data : []
        },
        [getterType.getExecutorUPIDictionaryList](state) {
            return state.executorUPIDictionaryList ? state.executorUPIDictionaryList.data : []
        },
        [getterType.getCoExecutorDictionaryList](state) {
            return state.coExecutorDictionaryList ? state.coExecutorDictionaryList.data : []
        },
        [getterType.getUpiCuratorDictionaryList](state) {
            return state.upiCuratorDictionaryList ? state.upiCuratorDictionaryList.data : []
        },
        [getterType.getDistrictCuratorDictionaryList](state) {
            return state.districtCuratorDictionaryList ? state.districtCuratorDictionaryList.data : []
        },
        [getterType.getIndustryDictionaryList](state) {
            return state.appealIndustryDictionaryList ? state.appealIndustryDictionaryList.data : []
        },
        [getterType.getRoleDictionaryList](state) {
            return state.appealRoleDictionaryList ? state.appealRoleDictionaryList.data : []
        },
        [getterType.getDepartmentDictionaryList](state) {
            return state.appealDepartmentDictionaryList ? state.appealDepartmentDictionaryList.data : []
        },
        [getterType.getBusinessStatusesList](state) {
            return state.businessStatusesList ? state.businessStatusesList : []
        },
    }
}
