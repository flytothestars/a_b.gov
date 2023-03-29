import $axios from './axios-instance.js';
import {processFileFormErrors} from "../support/files";

const moduleName = 'Business'

export const mutationType = {
	businessContactsRequest: `[${moduleName} businessContactsRequest]`,
	businessContactsSuccess: `[${moduleName} businessContactsSuccess]`,
	businessContactsError: `[${moduleName} businessContactsError]`,
	businessPhotosRequest: `[${moduleName} businessPhotosRequest]`,
	businessPhotosSuccess: `[${moduleName} businessPhotosSuccess]`,
	businessPhotosError: `[${moduleName} businessPhotosError]`,
	businessListRequest: `[${moduleName} businessListRequest]`,
	businessListSuccess: `[${moduleName} businessListSuccess]`,
	businessListError: `[${moduleName} businessListError]`,
	businessRequest: `[${moduleName}] businessRequest`,
	businessSuccess: `[${moduleName}] businessSuccess`,
	businessError: `[${moduleName}] businessError`,
	distributorBusinessListRequest: `[${moduleName}] distributorBusinessListRequest`,
	distributorBusinessListSuccess: `[${moduleName}] distributorBusinessListSuccess`,
	distributorBusinessListError: `[${moduleName}] distributorBusinessListError`,
	distributorBusinessRequest: `[${moduleName}] distributorBusinessRequest`,
	distributorBusinessSuccess: `[${moduleName}] distributorBusinessSuccess`,
	distributorBusinessError: `[${moduleName}] distributorBusinessError`,
	businessCreateAccountError: `[${moduleName}] businessCreateAccountError`,
	businessNoHaveAppealError: `[${moduleName}] businessNoHaveAppealError`,
	businessSentToCorrectionError: `[${moduleName}] businessSentToCorrectionError`,
}

export const actionType = {
	businessContacts: `[${moduleName}] businessContact`,
	businessPhotos: `[${moduleName}] businessPhotos`,
	businessActivityType: `[${moduleName}] businessActivityType`,
	businessContactsClear: `[${moduleName}] businessContactsClear`,
	businessPhotosClear: `[${moduleName}] businessPhotosClear`,
	businessList: `[${moduleName}] businessList`,
	businessListClear: `[${moduleName}] businessListClear`,
	distributorBusinessList: `[${moduleName}] distributorBusinessList`,
	distributorBusinessLisClear: `[${moduleName}] distributorBusinessLisClear`,
	business: `[${moduleName}] business`,
	businessClear: `[${moduleName}] businessClear`,
	distributorBusiness: `[${moduleName}] distributorBusiness`,
	distributorBusinessClear: `[${moduleName}] distributorBusinessClear`,
	businessCreateAccount: `[${moduleName}] businessCreateAccount`,
	businessNoHaveAppeal: `[${moduleName}] businessNoHaveAppeal`,
	reassignDistributor: `[${moduleName}] reassignDistributor`,
	businessSentToCorrection: `[${moduleName}] businessSentToCorrection`,
}

export const getterType = {
	getBusinessContacts: `[${moduleName}] getBusinessContacts`,
	getBusinessPhotos: `[${moduleName}] getBusinessPhotos`,
	getBusinessList: `[${moduleName}] getBusinessList`,
	getTotalBusinessCount: `[${moduleName}] getTotalBusinessCount`,
	getBusiness: `[${moduleName}] getBusiness`,
	getDistributorBusiness: `[${moduleName}] getDistributorBusiness`,
	getDistributorBusinessList: `[${moduleName}] getDistributorBusinessList`,
	getTotalDistributorBusinessCount: `[${moduleName}] getTotalDistributorBusinessCount`,
}

export default {
	state: {
		businessContacts: [],
		businessContactsError: null,
		businessContactsErrorCode: 0,
		businessPhotos: [],
		businessPhotosError: null,
		businessPhotosErrorCode: 0,
		businessList: [],
		businessListError: null,
		businessListErrorCode: 0,
		totalBusinessCount: 0,
		distributorBusinessList: [],
		distributorBusinessListError: null,
		distributorBusinessListErrorCode: 0,
		business: [],
		businessError: null,
		businessErrorCode: 0,
		distributorBusiness: [],
		distributorBusinessError: null,
		distributorBusinessErrorCode: 0,
		totalDistributorBusinessCount: 0,
		businessAccountError: null,
		businessAccountErrorCode: 0,
		businessNoHaveAppealError: null,
		businessNoHaveAppealErrorCode: 0,
		businessSentToCorrectionError: null,
		businessSentToCorrectionErrorCode: 0,
	},
	mutations: {
		[mutationType.businessContactsRequest](state) {
			state.businessContacts = []
			state.businessContactsError = null
			state.businessContactsErrorCode = 0
		},
		[mutationType.businessContactsError](state, {errorCode, errorMessage}) {
			state.businessContacts = []
			state.businessContactsError = errorMessage
			state.businessContactsErrorCode = errorCode
		},
		[mutationType.businessContactsSuccess](state, obj) {
			state.businessContacts = obj
			state.businessContactsError = null
			state.businessContactsErrorCode = 0
		},
		[mutationType.businessPhotosRequest](state) {
			state.businessPhotos = []
			state.businessPhotosError = null
			state.businessPhotosErrorCode = 0
		},
		[mutationType.businessPhotosError](state, {errorCode, errorMessage}) {
			state.businessPhotos = []
			state.businessPhotosError = errorMessage
			state.businessPhotosErrorCode = errorCode
		},
		[mutationType.businessPhotosSuccess](state, obj) {
			state.businessPhotos = obj
			state.businessPhotosError = null
			state.businessPhotosErrorCode = 0
		},
		[mutationType.businessListRequest](state) {
			state.businessList = []
			state.totalBusinessCount = 0
			state.businessListError = null
			state.businessListErrorCode = 0
		},
		[mutationType.businessListError](state, {errorCode, errorMessage}) {
			state.businessList = []
			state.totalBusinessCount = 0
			state.businessListError = errorMessage
			state.businessListErrorCode = errorCode
		},
		[mutationType.businessListSuccess](state, obj) {
			state.businessList = obj.data
			state.totalBusinessCount = obj.meta.total

			state.distributorBusinessListError = null
			state.distributorBusinessListErrorCode = 0

			state.businessListError = null
			state.businessListErrorCode = 0
		},
		[mutationType.distributorBusinessListRequest](state) {
			state.distributorBusinessList = []
			state.totalDistributorBusinessCount = 0
			state.distributorBusinessListError = null
			state.distributorBusinessListErrorCode = 0
		},
		[mutationType.distributorBusinessListError](state, {errorCode, errorMessage}) {
			state.distributorBusinessList = []
			state.totalDistributorBusinessCount = 0
			state.distributorBusinessListError = errorMessage
			state.distributorBusinessListErrorCode = errorCode
		},
		[mutationType.distributorBusinessListSuccess](state, obj) {
			state.distributorBusinessList = obj.data
			state.totalDistributorBusinessCount = obj.meta.total
			state.distributorBusinessListError = null
			state.distributorBusinessListErrorCode = 0
		},
		[mutationType.businessRequest](state) {
			state.business = []
			state.businessError = null
			state.businessErrorCode = 0
		},
		[mutationType.businessError](state, {errorCode, errorMessage}) {
			state.business = []
			state.businessError = errorMessage
			state.businessErrorCode = errorCode
		},
		[mutationType.businessSuccess](state, obj) {
			state.business = obj
			state.businessError = null
			state.businessErrorCode = 0
		},
		[mutationType.distributorBusinessRequest](state) {
			state.distributorBusiness = []
			state.distributorBusinessError = null
			state.distributorBusinessErrorCode = 0
		},
		[mutationType.distributorBusinessError](state, {errorCode, errorMessage}) {
			state.distributorBusiness = []
			state.distributorBusinessError = errorMessage
			state.distributorBusinessErrorCode = errorCode
		},
		[mutationType.distributorBusinessSuccess](state, obj) {
			state.distributorBusiness = obj
			state.distributorBusinessError = null
			state.distributorBusinessErrorCode = 0
		},
		[mutationType.businessCreateAccountError](state, {errorCode, errorMessage}) {
			state.businessAccountError = errorMessage
			state.businessAccountErrorCode = errorCode
		},
		[mutationType.businessNoHaveAppealError](state, {errorCode, errorMessage}) {
			state.businessNoHaveAppealError = errorMessage
			state.businessNoHaveAppealErrorCode = errorCode
		},
		[mutationType.businessSentToCorrectionError](state, {errorCode, errorMessage}) {
			state.businessSentToCorrectionError = errorMessage
			state.businessSentToCorrectionErrorCode = errorCode
		},
	},
	actions: {
		[actionType.businessContacts](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.businessContactsRequest)
				$axios
					.get(`business/${payload.business_id}/contacts`)
					.then(response => {
						context.commit(mutationType.businessContactsSuccess, response.data.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.businessContactsError, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		}, [actionType.businessActivityType](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.get(`business/${payload.business_id}/activityType`)
					.then(response => {
						resolve(response.data.data)
					})
					.catch(error => {
						reject(error)
					})
			})
		},
		[actionType.businessContactsClear](context) {
			context.commit(mutationType.businessContactsSuccess, [])
		},
		[actionType.distributorBusiness](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.distributorBusinessRequest)
				$axios
					.get(`distributor/business/${payload.id}`)
					.then(response => {
						context.commit(mutationType.distributorBusinessSuccess, response.data.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.distributorBusinessError, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.distributorBusinessClear](context) {
			context.commit(mutationType.distributorBusinessSuccess, [])
		},
		[actionType.business](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.businessRequest)
				$axios
					.get(`business/${payload.id}`)
					.then(response => {
						context.commit(mutationType.businessSuccess, response.data.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.businessError, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.businessClear](context) {
			context.commit(mutationType.businessSuccess, [])
		},
		[actionType.businessList](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.businessListRequest)
				$axios
					.get(`businessList`, {params: payload})
					.then(response => {
						context.commit(mutationType.businessListSuccess, response.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.businessListError, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.businessListClear](context) {
			context.commit(mutationType.businessListSuccess, [])
		},
		[actionType.distributorBusinessList](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.distributorBusinessListRequest)
				$axios
					.get(`distributor/businessList`, {params: payload})
					.then(response => {
						context.commit(mutationType.distributorBusinessListSuccess, response.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.distributorBusinessListError, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.distributorBusinessLisClear](context) {
			context.commit(mutationType.distributorBusinessListSuccess, [])
		},
		[actionType.businessPhotos](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.businessPhotosRequest)
				$axios
					.get(`business/${payload.business_id}/photos`)
					.then(response => {
						context.commit(mutationType.businessPhotosSuccess, response.data.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.businessPhotosError, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.businessPhotosClear](context) {
			context.commit(mutationType.businessPhotosSuccess, [])
		},
		[actionType.businessCreateAccount](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.post(`distributor/business/create-account`, payload)
					.then(response => {
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.businessCreateAccountError, {
							errorCode: error.data.status,
							errorMessage: {message: error.data.message, data: error.data.errors}
						})
						processFileFormErrors(payload, error, resolve, reject)
					})
			})
		},
		[actionType.businessNoHaveAppeal](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.post(`distributor/business/${payload.id}/no-appeals`)
					.then(response => {
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.businessNoHaveAppealError, {
							errorCode: error.data.status,
							errorMessage: {message: error.data.message, data: error.data.errors}
						});
						reject(error)
					})
			})
		},
		[actionType.reassignDistributor](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.post(`head/business/${payload.id}/reassign-distributor`, payload)
					.then(response => {
						resolve(response.data)
					})
					.catch(error => {
						console.log(error)
						reject(error)
					})
			})
		},
		[actionType.businessSentToCorrection](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.post(`distributor/business/${payload.id}/sent-to-correction`)
					.then(response => {
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.businessSentToCorrectionError, {
							errorCode: error.data.status,
							errorMessage: {message: error.data.message, data: error.data.errors}
						});
						reject(error)
					})
			})
		},
	},
	getters: {
		[getterType.getBusinessContacts]: (state) => {
			return state.businessContacts
		},
		[getterType.getBusinessPhotos]: (state) => {
			return state.businessPhotos
		},
		[getterType.getBusiness]: (state) => {
			return state.business
		},
		[getterType.getDistributorBusiness]: (state) => {
			return state.distributorBusiness
		},
		[getterType.getDistributorBusinessList]: (state) => {
			return state.distributorBusinessList
		},
		[getterType.getBusinessList]: (state) => {
			return state.businessList
		},
		[getterType.getTotalBusinessCount]: (state) => {
			return state.totalBusinessCount
		},
		[getterType.getTotalDistributorBusinessCount]: (state) => {
			return state.totalDistributorBusinessCount
		},
	},
}
