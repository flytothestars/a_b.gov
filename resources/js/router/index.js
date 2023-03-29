import Vue from 'vue'
import VueRouter from 'vue-router'
import AuthGuard from './auth-guard'
import Login from '../view/Auth/Login'

import Home from '../view/Home'
import UserList from "../view/Users/UserList";
import AppealsSandbox from "../view/Appeals/AppealsSandbox";
import MyAppeals from "../view/Appeals/MyAppeals";
import IEAppList from "../view/IEManager/index";
import AppealCard from "../view/Appeals/AppealCard";
import BusinessList from "../view/Business/BusinessList";
import BusinessCard from "../view/Business/BusinessCard";
import ChildAppealCard from "../view/Appeals/ChildAppealCard";
import MyBusinessList from "../view/Business/MyBusinessList";
import BusinessAppealCard from "../view/Appeals/BusinessAppealCard";
import ReportList from "../view/Report/ReportList";
import CityReportEdit from "../view/Report/CityReportEdit";
import DistrictReportEdit from "../view/Report/DistrictReportEdit";
import InvestmentsReport from "../view/Report/InvestmentsReport";
import IndustryReport from "../view/Report/IndustryReport";
import TradeReport from "../view/Report/TradeReport";
import ReportForm from "../view/Report/ReportForm";
import PRTReport from "../view/Report/PRTReport";
import NewsList from "../view/News/NewsList";
import NewsEditor from "../view/News/NewsEditor";
import NewsCreator from "../view/News/NewsCreator";
import GovernmentProgramsReportsList from "../view/Report/GovernmentPrograms/GovernmentProgramsReportsList";
import GovernmentProgramsReportRows from "../view/Report/GovernmentPrograms/GovernmentProgramsReportRows";
import GovernmentProgramsReportRowsCommon from "../view/Report/GovernmentPrograms/GovernmentProgramsReportRowsCommon";
import GovernmentProgramsReportEditor from "../view/Report/GovernmentPrograms/GovernmentProgramsReportEditor";
import GovernmentProgramsReportView from "../view/Report/GovernmentPrograms/GovernmentProgramsReportView";
import TestBPMN from "../view/Camunda/TestBPMN";
import ClientSettings from "../view/Camunda/ClientSettings";
import BusinessStatReport from "../view/Report/BusinessStatReport";
import InnerReportsView from "../view/Report/InnerReportsView";
import AppealsTest from "../view/Camunda/AppealsTest";
import CreativeAnalytics from "../view/Report/CreativeAnalytics";
import PromzoneAnalytics from "../view/Report/PromzoneAnalytics";
import MIOActualisation from "../view/Report/MIOActualisation";
import MIOIndustries from "../view/Report/MIOIndustries";
import ConsultationNeeds from "../view/Report/ConsultationNeeds";
import UsersReport from "../view/Report/UsersReport";
import ProfileAdmin from "../view/Auth/ProfileAdmin";

Vue.use(VueRouter)

const routes = [
	{
		path: '/admin/',
		name: 'Home',
		component: Home,
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/login',
		name: 'Login',
		component: Login
	},
	{
		path: '/admin/users',
		name: 'UserList',
		component: UserList,
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/appeals_sandbox',
		name: 'AppealsSandbox',
		component: AppealsSandbox,
		beforeEnter: AuthGuard,
	},
	// {
	// 	path: '/admin/my_appeals',
	// 	name: 'MyAppeals',
	// 	component: MyAppeals,
	// 	beforeEnter: AuthGuard,
	// },
	{
		path: '/admin/my_appeals/to_work',
		name: 'MyAppeals.toWork',
		component: MyAppeals,
		beforeEnter: AuthGuard,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'to_work' }),
	},
	{
		path: '/admin/my_appeals/in_work',
		name: 'MyAppeals.inWork',
		component: MyAppeals,
		beforeEnter: AuthGuard,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'in_work' }),
	},
	{
		path: '/admin/my_appeals/completed',
		name: 'MyAppeals.completed',
		component: MyAppeals,
		beforeEnter: AuthGuard,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'completed' }),
	}, {
		path: '/admin/my_appeals/business/correction',
		name: 'MyAppeals.business.correction',
		component: MyAppeals,
		beforeEnter: AuthGuard,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'business.correction' }),
	},
	{
		path: '/admin/my_appeals/upi/in_work',
		name: 'MyAppeals.UPI.inWork',
		component: MyAppeals,
		beforeEnter: AuthGuard,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'upi.in_work' }),
	},
	{
		path: '/admin/my_appeals/upi/completed',
		name: 'MyAppeals.UPI.completed',
		component: MyAppeals,
		beforeEnter: AuthGuard,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'upi.completed' }),
	},
	{
		path: '/admin/my_appeals/qolday/in_work',
		name: 'MyAppeals.Qolday.inWork',
		component: MyAppeals,
		beforeEnter: AuthGuard,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'qolday.in_work' }),
	},
	{
		path: '/admin/my_appeals/qolday/completed',
		name: 'MyAppeals.Qolday.completed',
		component: MyAppeals,
		beforeEnter: AuthGuard,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'qolday.completed' }),
	},
	{
		path: '/admin/my_appeals/confirmation',
		name: 'MyAppeals.confirmation',
		component: MyAppeals,
		beforeEnter: AuthGuard,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'confirmation' }),
	},
	{
		path: '/admin/my_appeals/distributor_assigned',
		name: 'MyAppeals.distributor_assigned',
		component: MyAppeals,
		beforeEnter: AuthGuard,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'distributor_assigned' }),
	},
	{
		path: '/admin/business/appeal',
		name: 'Business.appeal',
		component: BusinessList,
		beforeEnter: AuthGuard,
		props: route => Object.assign({}, route.query, route.params, { filterByAppeals: 'has' }),
	},
	{
		path: '/admin/business/no-appeal',
		name: 'Business.no-appeal',
		component: BusinessList,
		beforeEnter: AuthGuard,
		props: route => Object.assign({}, route.query, route.params, { filterByAppeals: 'has-not' }),
	},
	{
		path: '/admin/my_business',
		name: 'MyBusinessList',
		component: MyBusinessList,
		beforeEnter: AuthGuard,
	},

	{
		path: '/admin/business/:id',
		name: 'BusinessCard',
		component: BusinessCard,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},

	{
		path: '/admin/appeal/:id',
		name: 'AppealCard',
		component: AppealCard,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},

	{
		path: '/admin/create-child-appeal/:parentId',
		name: 'ChildAppealCard',
		component: ChildAppealCard,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/create-business-appeal/:businessId',
		name: 'BusinessAppealCard',
		component: BusinessAppealCard,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/inner',
		name: 'InnerReportsView',
		component: InnerReportsView,
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/consultation',
		name: 'ConsultationNeeds',
		component: ConsultationNeeds,
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/actualisation',
		name: 'MIOActualisation',
		component: MIOActualisation,
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/creative-analytics',
		name: 'CreativeAnalytics',
		component: CreativeAnalytics,
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/promzone-analytics',
		name: 'PromzoneAnalytics',
		component: PromzoneAnalytics,
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/industries',
		name: 'MIOIndustries',
		component: MIOIndustries,
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/list',
		name: 'ReportList',
		component: ReportList,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/city/:reportType',
		name: 'CityReportEdit',
		component: CityReportEdit,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/region/:reportType',
		name: 'DistrictReportEdit',
		component: DistrictReportEdit,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/investments',
		name: 'InvestmentsReport',
		component: InvestmentsReport,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/business-stat',
		name: 'BusinessStatReport',
		component: BusinessStatReport,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: "/admin/report/districts",
		name: "ReportForm",
		component: ReportForm,
		beforeEnter: AuthGuard
	},
	{
		path: "/admin/report/government-programs",
		name: "GovernmentProgramsReports",
		component: GovernmentProgramsReportsList,
		beforeEnter: AuthGuard
	},
	{
		path: "/admin/report/government-programs/report/failed/:id",
		name: "GovernmentProgramsReportRows.failed",
		component: GovernmentProgramsReportRows,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'failed' }),
		beforeEnter: AuthGuard
	},
	{
		path: "/admin/report/government-programs/report/processed/:id",
		name: "GovernmentProgramsReportRows.success",
		component: GovernmentProgramsReportRows,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'processed' }),
		beforeEnter: AuthGuard
	},
	{
		path: "/admin/report/government-programs/report/common/:id",
		name: "GovernmentProgramsReportRows.common",
		component: GovernmentProgramsReportRowsCommon,
		props: route => Object.assign({}, route.query, route.params, { filterByStatus: 'common' }),
		beforeEnter: AuthGuard
	},
	{
		path: "/admin/report/government-programs/report/editor/:parentId/:id",
		name: "GovernmentProgramsReportEditor",
		component: GovernmentProgramsReportEditor,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard
	},
	{
		path: "/admin/report/government-programs/report/view/:parentId",
		name: "GovernmentProgramsReportView",
		component: GovernmentProgramsReportView,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard
	},
	{
		path: '/admin/reports/industry',
		name: 'IndustryReport',
		component: IndustryReport,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/trade',
		name: 'TradeReport',
		component: TradeReport,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/prt',
		name: 'PRTReport',
		component: PRTReport,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/reports/users',
		name: 'UsersReport',
		component: UsersReport,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/news',
		name: 'NewsList',
		component: NewsList,
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/news/edit/:id',
		name: 'NewsEditor',
		component: NewsEditor,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/news/create',
		name: 'NewsCreator',
		component: NewsCreator,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/profile',
		name: 'ProfileAdmin',
		component: ProfileAdmin,
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/camunda/test',
		name: 'TestBPMN',
		component: TestBPMN,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/camunda/appeals_test',
		name: 'Camunda.AppealsTest',
		component: AppealsTest,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},
	{
		path: '/admin/camunda/client_setting',
		name: 'Camunda.ClientSettings',
		component: ClientSettings,
		props: route => Object.assign({}, route.query, route.params),
		beforeEnter: AuthGuard,
	},

]

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes
})

export default router
