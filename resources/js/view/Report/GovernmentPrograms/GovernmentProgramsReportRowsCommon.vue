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
        <h1>{{ reportName }}</h1>
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
      <v-card-actions>
        <v-row>
          <v-col cols="12">
            <v-btn
                class="ml-3"
                color="primary"
                @click="updateRatios"
                :loading="loading"
            >
              Сохранить
            </v-btn>
          </v-col>
        </v-row>
      </v-card-actions>
      <v-card-text>
        <v-row>
          <v-col
              v-for="item of ratios"
              :key="item.type"
              cols="12" sm="12" md="12" lg="12"
          >
            <v-text-field
                :label="item.title"
                v-model="ratiosData[item.type]"
                type="number"
                step="0.01"
            ></v-text-field>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import {
  actionType as reportActionType,
} from "../../../store/report/governmentProgramsReports";

export default {
  name: "GovernmentProgramsReportRowsCommon",
  props: {
    id: String,
    filterByStatus: String,
  },
  data() {
    return {
      loading: false,
      ratios: false,
      reportName: '',
      ratiosData: {},
    }
  },
  mounted() {
    this.loadRatios();
  },
  watch: {
    filterByStatus: {
      handler() {
        this.loadRatios();
      },
    }
  },
  methods: {
    back() {
      this.$router.push({name: 'GovernmentProgramsReports'});
    },
    loadRatios() {
      this.loading = true;
      this.$store.dispatch(reportActionType.getCommonRatios, {
        id: this.id,
      }).catch(() => {
        this.back();
      }).then((data) => {
        this.ratios = data.ratios;
        this.reportName = data.name;
        for (let ratio of this.ratios) {
          this.ratiosData[ratio.type] = ratio.value;
        }
      }).finally(() => {
        this.loading = false;
      });
    },
    updateRatios() {
      this.$store.dispatch(reportActionType.updateCommonRatios, {
        id: this.id,
        ratios: this.ratiosData,
      }).catch(() => {
        this.back();
      }).finally(() => {
        this.loading = false;
        this.loadRatios();
      });
    },
  },
}
</script>

<style scoped>

</style>
