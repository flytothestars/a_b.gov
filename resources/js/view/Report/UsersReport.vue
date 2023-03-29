<template>
  <v-container
      id="trade-report"
      fluid
      expert="section"
      pt-0
  >
    <v-card
        class="report-card"
    >
      <v-card-actions>
        <v-row
            class="pb-5 pl-5"
        >
          <v-col cols="3">
            <v-menu
                ref="menu"
                v-model="dateMenu"
                :close-on-content-click="false"
                transition="scale-transition"
                offset-y
                min-width="auto"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                    v-model="selectedDate"
                    label="Дата"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker
                  v-model="selectedDate"
                  no-title
                  scrollable
              />
            </v-menu>
          </v-col>
          <v-col cols="3">
            <v-btn
                class="mt-3"
                color="primary"
                @click="loadReportDataSet"
            >
              Обновить
            </v-btn>
          </v-col>
        </v-row>
      </v-card-actions>
      <v-card-text
          v-if="data"
      >
        <v-row
            class="pb-5 pl-5"
        >
          <v-col cols="12">
            <h1>{{ $vuetify.lang.t('$vuetify.page.UsersReport.title') }}</h1>
          </v-col>
        </v-row>
        <report-viewer-component
            report-file="/reports/UserReport.mrt"
            :data="data"
            data-source="JSON"
        />
      </v-card-text>
    </v-card>
  </v-container>

</template>

<script>
import ReportViewerComponent from "../../components/report/ReportViewerComponent";
import {
  actionType as reportActionType,
} from "../../store/report";

export default {
  name: "UsersReport",
  components: {ReportViewerComponent},
  data() {
    return {
      data: [],
      date: null,
      loading: false,
      dateMenu: null,
    };
  },

  created() {
    this.loading = true
    if (!this.date) {
      this.date = new Date().toISOString().split('T')[0];
    }
  },
  computed: {
    selectedDate: {
      get() {
        return this.date;
      },
      set(date) {
        this.date = date;
      },
    },
  },
  methods: {
    loadReportDataSet() {
      if (this.date) {
        this.$store.dispatch(reportActionType.fetchUsersReportData, {
          date: this.date,
        }).then((data) => {
          this.data = data;
        })
      }
    }
  },
  watch: {
    selectedDate() {
      this.loadReportDataSet()
    },
  },
}
</script>

<style scoped>

</style>
