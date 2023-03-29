import Vue from 'vue';

import moment from 'moment'
import {getterType as reportGetterType, mutationType as reportMutationType} from "../../store/report";
moment.locale('ru');

const Dates = {
	computed: {
		selectedDateStr: {
			get() {
				const date = this.$store.getters[reportGetterType.getCurrentDate];
				if (date) {
					let newDate = moment(date).format('MMMM YYYY');
					return newDate.charAt(0).toUpperCase() + newDate.slice(1);
				}
				return date;
			},
			set(date) {
				let newDate = moment(date, 'MMMM YYYY').format('YYYY-MM');
				newDate = `${date}-01`;
				this.$store.commit(reportMutationType.setCurrentDate, newDate);
			},
		},
		selectedDate: {
			get() {
				const date = this.$store.getters[reportGetterType.getCurrentDate];
				if (date) {
					return date.split('-').slice(0, 2).join('-');
				}
				return date;
			},
			set(date) {
				const newDate = `${date}-01`;
				this.$store.commit(reportMutationType.setCurrentDate, newDate);
			},
		},
		selectedDateFormat() {
			return  this.$store.getters[reportGetterType.getCurrentDate];
		}
	},
};

export default Dates;
