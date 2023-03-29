<template>
  <v-container
      id="prt-report"
      fluid
      expert="section"
      pt-0
  >
    <v-card
        class="report-card"
    >
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
        <h1 class="text-center mb-2">{{reportName}}</h1>
        <v-row>
          <v-col
              cols="12"
              class="d-flex justify-center"
          >
            <v-progress-circular
                size="100"
                v-if="loading"
                indeterminate
                color="primary"
            />
          </v-col>
        </v-row>
        <report-viewer-component
            v-if="!loading && reportData"
            :report-file="reportFile"
            :data="reportData"
            :data-source="reportDataSource"
        />
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import ReportViewerComponent from "../../../components/report/ReportViewerComponent";
import {
  actionType as reportActionType,
} from "../../../store/report/governmentProgramsReports";

export default {
  name: "GovernmentProgramsReportView",
  components: {ReportViewerComponent},
  props: {
    parentId: String,
  },
  data() {
    return {
      loading: null,
      reportData: null,
      reportDataSource: null,
      reportFile: null,
      reportName: null,
    }
  },
  mounted() {
    this.loadReport();
  },
  methods: {
    back() {
      this.$router.go(-1);
    },
    loadReport() {
      this.loading = true
      this.$store.dispatch(reportActionType.fetchReport, {id: this.id, parentId: this.parentId})
          .then((response) => {
            this.reportData = response.reportData;
            this.reportDataSource = response.reportDataSource;
            this.reportFile = response.reportFile;
            this.reportName = response.reportName;
          })
          .catch((fail) => {
            console.dir(fail);
            this.back();
          })
          .finally(() => {
            this.loading = false;
          });
    }
  },
}
</script>

<style scoped>

</style>
