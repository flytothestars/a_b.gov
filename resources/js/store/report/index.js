import $axios from "../axios-instance";
import ReportAppeals from "./ReportAppeals";


const moduleName = 'Report'

export const mutationType = {
    retrieveReportTypes: `[${moduleName}] retrieveReportTypes`,
    retrieveCitiesList: `[${moduleName}] retrieveCitiesList`,
    retrieveDistrictsList: `[${moduleName}] retrieveDistrictsList`,
    retrieveCityRatios: `[${moduleName}] retrieveCityRatios`,
	retrieveCityRatiosMonth: `[${moduleName}] retrieveCityRatiosMonth`,
	retrieveCityRatiosQuarter: `[${moduleName}] retrieveCityRatiosQuarter`,
    retrieveRegionRatios: `[${moduleName}] retrieveRegionRatios`,
    setCurrentCity: `[${moduleName}] setCurrentCity`,
    setCurrentDate: `[${moduleName}] setCurrentDate`,
    setCurrentDistrict: `[${moduleName}] setCurrentDistrict`
};

export const actionType = {
    retrieveReportTypes: `[${moduleName}] retrieveReportTypes`,
    retrieveCitiesList: `[${moduleName}] retrieveCitiesList`,
    retrieveDistrictsList: `[${moduleName}] retrieveDistrictsList`,
    retrieveCityRatios: `[${moduleName}] retrieveCityRatios`,
    retrieveRegionRatios: `[${moduleName}] retrieveRegionRatios`,
    updateCityRatios: `[${moduleName}] updateCityRatios`,
    updateDistrictRatios: `[${moduleName}] updateDistrictRatios`,
	fetchInvestmentsReportData: `[${moduleName}] fetchInvestmentsReportData`,
    ecxelExport: `[${moduleName}] ecxelExport`,
	fetchIndustryReportData: `[${moduleName}] fetchIndustryReportData`,
	fetchTradeReportData: `[${moduleName}] fetchTradeReportData`,
	fetchPRTReportData: `[${moduleName}] fetchPRTReportData`,
	fetchBusinessStatReportData: `[${moduleName}] fetchBusinessStatReportData`,
	fetchUsersReportData: `[${moduleName}] fetchUsersReportData`,
}

export const getterType = {
    getReportTypes: `[${moduleName}] getReportTypes`,
    getCurrentCity: `[${moduleName}] getCurrentCity`,
    getCitiesList: `[${moduleName}] getCitiesList`,
    getCurrentRegion: `[${moduleName}] getCurrentRegion`,
    getDistrictsList: `[${moduleName}] getDistrictsList`,
    getCurrentDate: `[${moduleName}] getCurrentDate`,
    getCityRatios: `[${moduleName}] getCityRatios`,
    getCityRatiosMonth: `[${moduleName}] getCityRatiosMonth`,
    getCityRatiosQuarter: `[${moduleName}] getCityRatiosQuarter`,
    getRegionsRatios: `[${moduleName}] getRegionsRatios`
};

export default {
	state: {
		reportTypes: [],
		citiesList: [],
		districtsList: [],
		currentCity: null,
		currentRegion: null,
		currentDate: null,
		cityRatios: null,
		cityRatiosMonth: null,
		cityRatiosQuarter: null,
		regionRatios: null,
	},
	mutations: {
		[mutationType.retrieveReportTypes](state, data) {
			state.reportTypes = data
		},
		[mutationType.retrieveCitiesList](state, data) {
			state.citiesList = data
		},
		[mutationType.setCurrentCity](state, data) {
			state.currentCity = data
		},
		[mutationType.setCurrentDistrict](state, data) {
			state.currentRegion = data
		},
		[mutationType.setCurrentDate](state, data) {
			state.currentDate = data
		},
		[mutationType.retrieveCityRatios](state, data) {
			state.cityRatios = data
		},
		[mutationType.retrieveCityRatiosMonth](state, data) {
			state.cityRatiosMonth = data
		},
		[mutationType.retrieveCityRatiosQuarter](state, data) {
			state.cityRatiosQuarter = data
		},
		[mutationType.retrieveRegionRatios](state, data) {
			state.regionRatios = data
		},
		[mutationType.retrieveDistrictsList](state, data) {
			state.districtsList = data
		},
	},
	actions: {
		[actionType.retrieveReportTypes](context) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.retrieveReportTypes)
				$axios
					.get(`reports/types`)
					.then(response => {
						context.commit(mutationType.retrieveReportTypes, response.data.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.retrieveReportTypes, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.retrieveCitiesList](context) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.retrieveCitiesList)
				$axios
					.get(`reports/citiesList`)
					.then(response => {
						context.commit(mutationType.retrieveCitiesList, response.data.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.retrieveCitiesList, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.retrieveDistrictsList](context, payload) {
			return new Promise((resolve, reject) => {
				const city_id = payload?.city_id || context.getters[getterType.getCurrentCity];
				context.commit(mutationType.retrieveDistrictsList)
				$axios
					.get(`reports/districts-list/${city_id}`)
					.then(response => {
						context.commit(mutationType.retrieveDistrictsList, response.data.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.retrieveDistrictsList, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.retrieveCityRatios](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.retrieveCityRatios)
				$axios
					.post(`reports/city-ratios`, payload)
					.then(response => {
						context.commit(mutationType.retrieveCityRatios, response.data.cityRatios)
						context.commit(mutationType.retrieveCityRatiosQuarter, response.data.cityRatiosMonth)
						context.commit(mutationType.retrieveCityRatiosMonth, response.data.cityRatiosQuarter)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.retrieveCityRatios, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.retrieveRegionRatios](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.retrieveRegionRatios)
				$axios
					.post(`reports/district-ratios`, payload)
					.then(response => {
						context.commit(mutationType.retrieveRegionRatios, response.data.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.retrieveRegionRatios, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.updateCityRatios](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.retrieveCityRatios)
				$axios
					.post(`reports/update-city-ratios`, payload)
					.then(response => {
						context.commit(mutationType.retrieveCityRatios, response.data.cityRatios)
						context.commit(mutationType.retrieveCityRatiosQuarter, response.data.cityRatiosQuarter)
						context.commit(mutationType.retrieveCityRatiosMonth, response.data.cityRatiosMonth)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.retrieveCityRatios, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.updateDistrictRatios](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.retrieveRegionRatios)
				$axios
					.post(`reports/update-region-ratios`, payload)
					.then(response => {
						context.commit(mutationType.retrieveRegionRatios, response.data.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.retrieveRegionRatios, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.fetchInvestmentsReportData](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.post(`reports/investment-report`, payload)
					.then(response => {
						resolve(response.data.data)
					})
					.catch(error => {
						reject(error)
					})
			})
		},
		[actionType.fetchIndustryReportData](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.post(`reports/industry-report`, payload)
					.then(response => {
						resolve(response.data.data)
					})
					.catch(error => {
						reject(error)
					})
			})
		},
		[actionType.fetchTradeReportData](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.post(`reports/trade-report`, payload)
					.then(response => {
						resolve(response.data.data)
					})
					.catch(error => {
						reject(error)
					})
			})
		},
		[actionType.fetchPRTReportData](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.post(`reports/prt-report`, payload)
					.then(response => {
						resolve(response.data.data)
					})
					.catch(error => {
						reject(error)
					})
			})
		},
		[actionType.fetchBusinessStatReportData](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.post(`reports/report-business-stat`, payload)
					.then(response => {
						resolve(response.data.data)
					})
					.catch(error => {
						reject(error)
					})
			})
		},
		[actionType.fetchUsersReportData](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.post(`reports/users-report`, payload)
					.then(response => {
						resolve(response.data)
					})
					.catch(error => {
						reject(error)
					})
			})
		},
	},
	getters: {
		[getterType.getReportTypes]: (state) => {
			return state.reportTypes
		},
		[getterType.getCitiesList]: (state) => {
			return state.citiesList
		},
		[getterType.getCurrentCity]: (state) => {
			return state.currentCity
		},
		[getterType.getCurrentRegion]: (state) => {
			return state.currentRegion
		},
		[getterType.getCurrentDate]: (state) => {
			return state.currentDate
		},
		[getterType.getCityRatios]: (state) => {
			return state.cityRatios
		},
		[getterType.getCityRatiosMonth]: (state) => {
			return state.cityRatiosMonth
		},
		[getterType.getCityRatiosQuarter]: (state) => {
			return state.cityRatiosQuarter
		},
		[getterType.getRegionsRatios]: (state) => {
			return state.regionRatios
		},
		[getterType.getDistrictsList]: (state) => {
			return state.districtsList
		},
	},
	modules: {
        ReportAppeals
    }
}
