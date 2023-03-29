import $axios from "../axios-instance";
import {makeFilesFormDateFormJson} from "../../support/files";

const moduleName = 'GovernmentProgramsReports';

export const mutationType = {
	setReportRows: `[${moduleName}] setReportRows`,
	clearReportRows: `[${moduleName}] clearReportRows`,
};

export const actionType = {
	retrieveReportsList: `[${moduleName}] retrieveReportsList`,
	importFile: `[${moduleName}] importFile`,
	reImportFile: `[${moduleName}] reImportFile`,
	fetchReportRows: `[${moduleName}] fetchReportRows`,
	fetchReportRow: `[${moduleName}] fetchReportRow`,
	fetchReport: `[${moduleName}] fetchReport`,
	updateReportRow: `[${moduleName}] updateReportRow`,
	createReport: `[${moduleName}] createReport`,
	getCommonRatios: `[${moduleName}] getCommonRatios`,
	updateCommonRatios: `[${moduleName}] updateCommonRatios`,
};

export const getterType = {
	getReportRows: `[${moduleName}] getReportRows`,
	getReportHeaders: `[${moduleName}] getReportHeaders`,
	getReportName: `[${moduleName}] getReportName`,
};

export default {
	state: {
		reportRows: null,
		reportHeaders: null,
		reportName: null,
	},
	mutations: {
		[mutationType.clearReportRows](state) {
			state.reportRows = null;
			state.reportHeaders = null;
		},
		[mutationType.setReportRows](state, data) {
			state.reportRows = data.rows;
			state.reportHeaders = data.headers;
			state.reportName = data.name;
		},
	},
	actions: {
		[actionType.retrieveReportsList](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.post(`government-reports/list`, payload)
					.then(response => {
						resolve(response.data.data);
					})
					.catch(error => {
						reject(error);
					});
			});
		},
		[actionType.importFile](context, payload) {
			const formData = makeFilesFormDateFormJson(payload);

			return new Promise((resolve, reject) => {
				$axios
					.post(`government-reports/import`, formData)
					.then(response => {
						resolve(response.data.data);
					})
					.catch(error => {
						reject(error);
					});
			});
		},
		[actionType.reImportFile](context, payload) {
			const formData = makeFilesFormDateFormJson(payload);

			return new Promise((resolve, reject) => {
				$axios
					.post(`government-reports/re-import`, formData)
					.then(response => {
						resolve(response.data.data);
					})
					.catch(error => {
						reject(error);
					});
			});
		},
		[actionType.fetchReportRows](context, payload) {
			const formData = makeFilesFormDateFormJson(payload);
			context.commit(mutationType.clearReportRows);
			return new Promise((resolve, reject) => {
				$axios
					.post(`government-reports/get-report-rows`, formData)
					.then(response => {
						context.commit(mutationType.setReportRows, response.data);
						resolve(response.data.data);
					})
					.catch(error => {
						reject(error);
					});
			});
		},
		[actionType.fetchReportRow](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.get(`government-reports/get-report-row/${payload.parentId}/${payload.id}`)
					.then(response => {
						resolve(response.data);
					})
					.catch(error => {
						reject(error);
					});
			});
		},
		[actionType.fetchReport](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.get(`government-reports/get-report/${payload.parentId}`)
					.then(response => {
						resolve(response.data);
					})
					.catch(error => {
						reject(error);
					});
			});
		},
		[actionType.updateReportRow](context, payload) {
			const formData = makeFilesFormDateFormJson(payload);
			return new Promise((resolve, reject) => {
				$axios
					.post(`government-reports/update-report-row`, formData)
					.then(response => {
						resolve(response.data.data);
					})
					.catch(error => {
						reject(error);
					});
			});
		},
		[actionType.createReport](context, payload) {
			const formData = makeFilesFormDateFormJson(payload);
			return new Promise((resolve, reject) => {
				$axios
					.post(`government-reports/create-report`, formData)
					.then(response => {
						resolve(response.data.data);
					})
					.catch(error => {
						reject(error);
					});
			});
		},
		[actionType.getCommonRatios](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.get(`government-reports/get-common-ratios/${payload.id}`)
					.then(response => {
						resolve(response.data);
					})
					.catch(error => {
						reject(error);
					});
			});
		},
		[actionType.updateCommonRatios](context, payload) {
			return new Promise((resolve, reject) => {
				$axios
					.post(`government-reports/update-common-ratios/${payload.id}`, payload)
					.then(response => {
						resolve(response.data);
					})
					.catch(error => {
						reject(error);
					});
			});
		},
	},
	getters: {
		[getterType.getReportRows]: state => {
			return state.reportRows;
		},
		[getterType.getReportHeaders]: state => {
			return state.reportHeaders;
		},
		[getterType.getReportName]: state => {
			return state.reportName;
		},
	},
	modules: {}
};
