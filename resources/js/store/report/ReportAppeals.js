import $axios from "../axios-instance";

const moduleName = "ReportAppeals";

export const mutationType = {
    setCurrentDate: `[${moduleName}] setCurrentDate`,
    setEndCurrentDate: `[${moduleName}] setEndCurrentDate`
};

export const actionType = {
    excelExport: `[${moduleName}] excelExport`,
    exportDistrStatic: `[${moduleName}] exportDistrStatic`,
    allStatistics: `[${moduleName}] allStatistics`,
    fetchReportData: `[${moduleName}] fetchReportData`
};

export const getterType = {
    getCurrentDate: `[${moduleName}] getCurrentDate`,
    getEndCurrentDate: `[${moduleName}] getEndCurrentDate`
};

export default {
    state: {
        currentDate: null,
        currentEndDate: null
    },
    mutations: {
        [mutationType.setCurrentDate](state, data) {
            state.currentDate = data;
        },
        [mutationType.setEndCurrentDate](state, data) {
            state.currentEndDate = data;
        }
    },
    actions: {
        [actionType.excelExport](context, payload) {
            console.log("actionsStore");
            return new Promise((resolve, reject) => {
                $axios
                    .get(`reportBusiness`, {
                        responseType: "arraybuffer",
                        params: payload
                    })
                    .then(response => {
                        resolve(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                        reject(error);
                    });
            });
        },
        [actionType.exportDistrStatic](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`reportStatByDistrict`, {
                        responseType: "arraybuffer",
                        params: payload
                    })
                    .then(response => {
                        resolve(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                        reject(error);
                    });
            });
        },
        [actionType.allStatistics](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .get(`reportBusiness`, {
                        params: payload
                    })
                    .then(response => {
                        resolve(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                        reject(error);
                    });
            });
        },
        [actionType.fetchReportData](context, payload) {
            return new Promise((resolve, reject) => {
                $axios
                    .post(`reportBusiness/appeals-report`, payload)
                    .then(response => {
                        console.log(response.data);
                        resolve(response.data);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        }
    },
    getters: {
        [getterType.getCurrentDate]: state => {
            return state.currentDate;
        },
        [getterType.getEndCurrentDate]: state => {
            return state.currentEndDate;
        }
    },
    modules: {}
};
