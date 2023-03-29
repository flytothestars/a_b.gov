<template>
  <v-container
      id="report-list"
      fluid
      expert="section"
      pt-0
  >

    <v-data-table
        :headers="headers"
        :items="getTypes"
        :loading="loading"
        sort-by="name"
        class="elevation-1"
    >
      <template v-slot:item.actions="{ item }">
        <v-btn
            small
            class="mr-2"
            outlined
            color="primary"
            @click="() => editCity(item.id)"
        >
          Показатели по городам
        </v-btn>
        <v-btn
            small
            class="mr-2"
            outlined
            color="primary"
            @click="() => editRegion(item.id)"
        >
          Показатели по районам
        </v-btn>
        <v-btn
            small
            class="mr-2"
            outlined
            color="primary"
            @click="() => gotoReport(item.id)"
        >
          Отчет
        </v-btn>

      </template>
    </v-data-table>
  </v-container>
</template>

<script>

import {
  actionType as reportActionType,
  getterType as reportGetterType
} from "../../store/report";
import InvestmentsReport from "./InvestmentsReport";

const ReportTypes = {
  ReportTypeIndustry: {id: 1, component: 'IndustryReport',},
  ReportTypeTrade: {id: 2, component: 'TradeReport',},
  BusinessStatReport: {id: 3, component: 'BusinessStatReport',},
  ReportTypeInvestments: {id: 4, component: 'InvestmentsReport',},
  PRTReport: {id: 5, component: 'PRTReport',},
};

export default {
  name: "ReportList",
  created() {
    this.getList()
  },
  data() {
    return {
      loading: false,
    }
  },
  computed: {
    headers() {
      return [
        {
          text: this.$vuetify.lang.t('$vuetify.page.ReportList.title'),
          align: 'start',
          sortable: true,
          value: 'name',
        },
        {
          text: this.$vuetify.lang.t('$vuetify.page.action.titleAction'),
          value: 'actions', sortable: false
        },
      ];
    },
    getTypes() {
      return this.$store.getters[reportGetterType.getReportTypes];
    },
  },
  methods: {
    getList() {
      this.loading = true
      this.$store.dispatch(reportActionType.retrieveReportTypes).then(() => {
        this.loading = false
      })
    },
    editCity(id) {
      this.$router.push({name: 'CityReportEdit', params: {reportType: id}})
    },
    editRegion(id) {
      this.$router.push({name: 'DistrictReportEdit', params: {reportType: id}})
    },
    gotoReport(id) {
      const reportId = Object.keys(ReportTypes).reduce((acc, item) => {
        if (acc) {
          return acc;
        }
        return ReportTypes[item].id === id ? item : null;
      }, null)

      const route = ReportTypes[reportId].component;
      if (route) {
        this.$router.push({name: route});
      }
    },
  },
}
</script>

<style scoped>

</style>
