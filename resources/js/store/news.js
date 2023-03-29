import $axios from './axios-instance.js';
import {makeFilesFormDateFormJson} from "../support/files";

const moduleName = 'News';


export const mutationType = {
	newsCategoryListRequest: `[${moduleName} newsCategoryListRequest]`,
	newsCategoryListRequestError: `[${moduleName} newsCategoryListRequestError]`,
	newsListRequest: `[${moduleName} newsListRequest]`,
	newsListRequestError: `[${moduleName} newsListRequestError]`,
	loadNewsRequest: `[${moduleName} loadNewsRequest]`,
	loadNewsRequestError: `[${moduleName} loadNewsRequestError]`,
};

export const actionType = {
	newsCategoryList: `[${moduleName}] newsCategoryList`,
	newsCategoryListError: `[${moduleName}] newsCategoryListError`,
	newsList: `[${moduleName}] newsList`,
	newsListError: `[${moduleName}] newsListError`,
	loadNews: `[${moduleName}] loadNews`,
	storeNews: `[${moduleName}] storeNews`,
	createNews: `[${moduleName}] createNews`,
};


export const getterType = {
	getNewsCategoryList: `[${moduleName}] getNewsCategoryList`,
	getNewsList: `[${moduleName}] getNewsList`,
	getNewsListError: `[${moduleName}] getNewsListError`,
	getNews: `[${moduleName}] getNews`,
};


export default {
	state: {
		newsCategoryList: [],
		businessListError: null,
		businessListErrorCode: null,
		newsList: null,
		newsListError: null,
		newsListErrorCode: null,
		news: null,
		newsError: null,
		newsErrorCode: null,
	},
	mutations: {
		[mutationType.newsCategoryListRequest](state, payload) {
			state.newsCategoryList = payload;
		},
		[mutationType.newsCategoryListRequestError](state, {errorCode, errorMessage}) {
			state.businessList = []
			state.businessListError = errorMessage
			state.businessListErrorCode = errorCode
		},
		[mutationType.newsListRequest](state, payload) {
			state.newsList = payload;
		},
		[mutationType.newsListRequestError](state, {errorCode, errorMessage}) {
			state.newsList = []
			state.newsListError = errorMessage
			state.newsListErrorCode = errorCode
		},
		[mutationType.loadNewsRequest](state, payload) {
			state.news = payload;
		},
		[mutationType.loadNewsRequestError](state, {errorCode, errorMessage}) {
			state.news = null;
			state.newsError = errorMessage;
			state.newsErrorCode = errorCode;
		},
	},
	actions: {
		[actionType.newsCategoryList](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.newsCategoryListRequest)
				$axios
					.get(`dictionary/news-categories`)
					.then(response => {
						context.commit(mutationType.newsCategoryListRequest, response.data.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.newsCategoryListRequestError, {
							errorCode: error.response.status,
							errorMessage: {message: error.response.data.message, data: error.response.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.newsList](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.newsListRequest)
				$axios
					.get(`admin/news`, {params: payload || {}})
					.then(response => {
						context.commit(mutationType.newsListRequest, response.data.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.newsListRequestError, {
							errorCode: error.data.status,
							errorMessage: {message: error.data.message, data: error.data.errors}
						})
						reject(error)
					})
			})
		},
		[actionType.loadNews](context, payload) {
			return new Promise((resolve, reject) => {
				context.commit(mutationType.newsListRequest)
				$axios
					.get(`admin/news/${payload.id}`)
					.then(response => {
						context.commit(mutationType.loadNewsRequest, response.data.data)
						resolve(response.data.data)
					})
					.catch(error => {
						context.commit(mutationType.loadNewsRequestError, {
							errorCode: error.status,
							errorMessage: {message: error.data.message, data: error.data.errors || null}
						})
						reject(error)
					})
			})
		},
		[actionType.storeNews](context, payload) {
			return new Promise((resolve, reject) => {
				const formData = makeFilesFormDateFormJson(payload);
				$axios
					.post(`admin/news/${payload.id}`, formData)
					.then(response => {
						resolve(response.data.data)
					})
					.catch(error => {
						reject(error)
					})
			})
		},
		[actionType.createNews](context, payload) {
			return new Promise((resolve, reject) => {
				const formData = makeFilesFormDateFormJson(payload);
				$axios
					.post(`admin/news`, formData)
					.then(response => {
						resolve(response.data.data)
					})
					.catch(error => {
						reject(error)
					})
			})
		},
	},
	getters: {
		[getterType.getNewsCategoryList]: (state) => {
			return state.newsCategoryList;
		},
		[getterType.getNewsList]: (state) => {
			return state.newsList;
		},
		[getterType.getNews]: (state) => {
			return state.news;
		},
	},
};
