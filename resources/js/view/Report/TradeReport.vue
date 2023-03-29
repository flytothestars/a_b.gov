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
        <v-btn
            text
            @click="back"
        >
          <v-icon class="mr-2">mdi-arrow-left</v-icon>
          Вернуться назад
        </v-btn>
      </v-card-actions>
      <v-card-actions>
        <v-row
            class="pb-5 pl-5"
        >
          <v-col cols="3">
            <v-autocomplete
                class="pt-5"
                v-model="selectedCity"
                :items="getCitiesList"
                item-text="name"
                item-value="id"
                dense
                label="Город"
                :disabled="cityDisable"
            ></v-autocomplete>
          </v-col>
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
                    v-model="selectedDateStr"
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
                  type="month"
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
            <h1>{{ $vuetify.lang.t('$vuetify.page.TradeReport.title') }}</h1>
          </v-col>
        </v-row>
        <report-viewer-component
            report-file="/reports/prt/Torgovlya.mrt"
            :data="data"
            data-source="Torgovlya"
        />
      </v-card-text>
    </v-card>
  </v-container>

</template>

<script>
import ReportViewerComponent from "../../components/report/ReportViewerComponent";
import {
  actionType as reportActionType,
  getterType as reportGetterType,
  mutationType as reportMutationType,
} from "../../store/report";
import Dates from "./dates";

export default {
  name: "TradeReport",
  components: {ReportViewerComponent},
  mixins: [Dates],
  data() {
    return {
      data: [],
      loading: false,
      cityDisable: null,
      dateMenu: null,
    };
  },

  created() {
    this.loading = true
    this.$store.dispatch(reportActionType.retrieveCitiesList).then(() => {
      const defaultCity = this.getCitiesList.reduce(
          item => item.id === '25c728b6-f78e-4fbf-9128-c7bca032874f' ? item : null
      );
      if (defaultCity) {
        this.$store.commit(reportMutationType.setCurrentCity, defaultCity);
        this.cityDisable = true;
      }
    })
    if (!this.selectedDate) {
      this.$store.commit(reportMutationType.setCurrentDate, new Date().toISOString().split('T')[0]);
    }
  },
  computed: {
    getCitiesList() {
      return this.$store.getters[reportGetterType.getCitiesList];
    },
    selectedCity: {
      get() {
        return this.$store.getters[reportGetterType.getCurrentCity];
      },
      set(city) {
        this.$store.commit(reportMutationType.setCurrentCity, city);
      },
    },
  },
  methods: {
    back() {
      this.$router.push({name: 'InnerReportsView'})
    },
    loadReportDataSet() {
      if (this.selectedCity && this.selectedDate) {
        this.$store.dispatch(reportActionType.fetchTradeReportData, {
          city_id: this.selectedCity.id,
          date: this.selectedDateFormat,
        }).then((data) => {
          this.data = data;
        })
      }
    }
  },
  watch: {
    selectedCity() {
      this.loadReportDataSet()
    },
    selectedDate() {
      this.loadReportDataSet()
    },
  },
}
</script>

<style scoped>

</style>
