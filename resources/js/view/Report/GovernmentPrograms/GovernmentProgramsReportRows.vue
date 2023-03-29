<template>
  <v-container
      id="city-report-ratios"
      fluid
      expert="section"
      pt-0
  >
    <v-card>
      <v-card-actions>
        <v-btn
            text
            @click="back"
        >
          <v-icon class="mr-2">mdi-arrow-left</v-icon>
          Вернуться назад
        </v-btn>
      </v-card-actions>
      <v-card-text>
        <h1>{{reportName}}</h1>
      </v-card-text>
      <v-card-actions>
        <v-tabs>
          <v-tab
              :to="{'name': 'GovernmentProgramsReportRows.failed', params: {id}}"
          >Требуют редактирования
          </v-tab>
          <v-tab
              :to="{'name': 'GovernmentProgramsReportRows.success', params: {id}}"
          >Обработаны успешно
          </v-tab>
          <v-tab
              :to="{'name': 'GovernmentProgramsReportRows.common', params: {id}}"
          >Общие показатели
          </v-tab>
        </v-tabs>
      </v-card-actions>
      <v-card-text>
        <v-data-table
            v-if="rows"
            :headers="headers"
            :items="rows"
            :loading="loading"
            class="elevation-1"
        >
          <template v-slot:item.last_fail_comment="{ item }">
            <div v-html="item.last_fail_comment" ></div>
          </template>
          <template v-slot:item.actions="{ item }">
            <v-btn
                small
                class="mr-2"
                outlined
                color="primary"
                @click="() => editRecord(item.id, item.report_id)"
            >
              Редактировать
            </v-btn>
          </template>
        </v-data-table>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import {
  actionType as reportActionType,
  getterType as reportGetterType,
} from "../../../store/report/governmentProgramsReports";

export default {
  name: "GovernmentProgramsReportRows",
  props: {
    id: String,
    filterByStatus: String,
  },
  data() {
    return {
      loading: false,
    }
  },
  computed: {
    headers() {
      return this.$store.getters[reportGetterType.getReportHeaders];
    },
    reportName() {
      return this.$store.getters[reportGetterType.getReportName];
    },
    rows() {
      return this.$store.getters[reportGetterType.getReportRows];
    },
  },
  mounted() {
    this.loadRecords();
  },
  watch: {
    filterByStatus: {
      handler() {
        this.loadRecords();
      },
    }
  },
  methods: {
    back() {
      this.$router.push({name: 'InnerReportsView'});
    },
    loadRecords() {
      this.loading = true;
      this.$store.dispatch(reportActionType.fetchReportRows, {
        id: this.id,
        filter: this.filterByStatus,
      }).catch(() => {
        this.back();
      }).finally(() => {
        this.loading = false;
      });
    },
    editRecord(id, parentId) {
      this.$router.push({name: 'GovernmentProgramsReportEditor', params: {id: id.toString(), parentId}});
    },
  },
}
</script>

<style scoped>

</style>
