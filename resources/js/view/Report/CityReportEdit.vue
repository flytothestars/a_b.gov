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
                @click="updateRatios"
            >
              {{
                this.recordExists
                    ? this.$vuetify.lang.t('$vuetify.page.action.btnUpdate')
                    : this.$vuetify.lang.t('$vuetify.page.action.btnSave')
              }}
            </v-btn>
          </v-col>
        </v-row>
      </v-card-actions>
      <v-card-text>
        <v-form  ref="ratioForm">
          <v-row
              v-for="(list, group) in ratiosGroups"
              :key="group"
          >
            <v-col  cols="12" sm="12" md="12" lg="12">
              <h4>{{group}}</h4>
              <v-divider></v-divider>
            </v-col>
            <v-col
                v-for="(item, id) in list"
                :key="id"
                cols="6" sm="12" md="6" lg="4"
            >
              <v-text-field
                  :label="item.name"
                  :rules="[fieldValidationRules.floatNumberOptional(vue)]"
                  v-model="ratiosGroups[group][id].value"
                  type="number"
                  step="0.01"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row
              v-if="ratiosMonth && Object.keys(ratiosMonth).length"
          >
            <v-col  cols="12" sm="12" md="12" lg="12">
              <h4>Показатели по месяцам</h4>
              <v-divider></v-divider>
            </v-col>
          </v-row>
          <v-row
              v-if="ratiosMonth"
              v-for="(ratioMonth, indexMonth) in ratiosMonth"
              :key="indexMonth"
          >
            <v-col  cols="12" sm="12" md="12" lg="12">
              <v-divider></v-divider>
            </v-col>
            <v-col
                v-for="(ratio, date) in ratioMonth"
                :key="date"
                cols="6" sm="12" md="6" lg="3"
            >
              <v-text-field
                  :label="ratio.name"
                  :rules="[fieldValidationRules.floatNumberOptional(vue)]"
                  v-model="ratiosMonth[indexMonth][date].value"
                  type="number"
                  step="0.01"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row
              v-if="ratiosQuarter && Object.keys(ratiosQuarter).length"
          >
            <v-col  cols="12" sm="12" md="12" lg="12">
              <h4>Показатели по кварталам</h4>
              <v-divider></v-divider>
            </v-col>
          </v-row>
          <v-row
              v-if="ratiosQuarter"
              v-for="(ratioQuarter, indexQuarter) in ratiosQuarter"
              :key="indexQuarter"
          >
            <v-col  cols="12" sm="12" md="12" lg="12">
              <v-divider></v-divider>
            </v-col>
            <v-col
                v-for="(ratio, date) in ratioQuarter"
                :key="date"
                cols="6" sm="12" md="6" lg="3"
            >
              <v-text-field
                  :label="ratio.name"
                  :rules="[fieldValidationRules.floatNumberOptional(vue)]"
                  v-model="ratiosQuarter[indexQuarter][date].value"
                  type="number"
                  step="0.01"
              ></v-text-field>
            </v-col>
          </v-row>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import {
  actionType as reportActionType,
  getterType as reportGetterType,
  mutationType as reportMutationType,
} from "../../store/report";
import Dates from "./dates";

export default {
  name: "CityReportEdit",
  mixins: [Dates],
  props: {
    reportType: null,
  },
  data() {
    return {
      vue: this,
      loading: false,
      cityDisable: null,
      dateMenu: null,
      ratiosGroups: null,
      ratiosMonth: null,
      ratiosQuarter: null,
    }
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
    canLoadRatios() {
      return typeof this.selectedDate === 'string'
          && this.selectedCity
          && typeof this.selectedCity === 'object'
          && typeof this.selectedCity.id === 'string'
          && (
              typeof this.reportType === 'string'
              || typeof this.reportType === 'number'
          )
    },
    recordExists() {
      if (!Array.isArray(this.ratios)) {
        return false;
      }
      return this.ratiosGroups.reduce((acc, list) => {
        if (acc) {
          return acc;
        }
        let exists = false;
        for (index of Object.keys(list))
        {
          if(!exists)
          {
            exists = list[index].exists;
          }
        }
        return exists;
      }, false);
    }
  },
  methods: {
    back() {
      this.$router.go(-1)
    },
    loadRatios() {
      if (this.canLoadRatios) {
        this.$store.dispatch(reportActionType.retrieveCityRatios, {
          report_type_id: parseInt(this.reportType, 10),
          city_id: this.selectedCity.id,
          date: this.selectedDateFormat,
        }).then(() => {
          this.ratiosGroups = this.$store.getters[reportGetterType.getCityRatios];
          this.ratiosMonth = this.$store.getters[reportGetterType.getCityRatiosMonth];
          this.ratiosQuarter = this.$store.getters[reportGetterType.getCityRatiosQuarter];
        });
      }
    },
    updateRatios() {
      if (this.$refs.ratioForm.validate()) {

        const ratios = this.ratiosGroups;
        const ratiosMonth = this.ratiosMonth;
        const ratiosQuarter = this.ratiosQuarter;

        for (let group of Object.keys(ratios) ){
          for (let ratioIndex of Object.keys(ratios[group]) ){
            if(
                ratios[group][ratioIndex].value === ''
            )
            {
              ratios[group][ratioIndex].value = null;
            }
          }
        }

        this.$store.dispatch(reportActionType.updateCityRatios, {
          report_type_id: parseInt(this.reportType, 10),
          city_id: this.selectedCity.id,
          date: this.selectedDateFormat,
          ratios,
          ratiosMonth,
          ratiosQuarter,
        }).then(() => {
          this.ratios = this.$store.getters[reportGetterType.getCityRatios];
          this.ratiosMonth = this.$store.getters[reportGetterType.getCityRatiosMonth];
          this.ratiosQuarter = this.$store.getters[reportGetterType.getCityRatiosQuarter];
        });
      }
    }
  },
  watch: {
    selectedCity() {
      if (this.canLoadRatios) {
        this.loadRatios()
      }
    },
    selectedDate() {
      if (this.canLoadRatios) {
        this.loadRatios()
      }
    },
  }
}
</script>

<style scoped>

</style>
