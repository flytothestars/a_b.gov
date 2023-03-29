<template>
  <v-container
      id="region-report-ratios"
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
            <v-autocomplete
                class="pt-5"
                v-model="selectedDistrict"
                :items="getDistrictsList"
                item-text="name"
                item-value="id"
                dense
                label="Район"
                :disabled="regionDisable"
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
        <v-form ref="ratioForm">
          <v-row>
            <v-col cols="6">
              <v-text-field
                  v-for="(item, index) in ratios"
                  :key="index"
                  :label="item.name"
                  :rules="[fieldValidationRules.required(vue), fieldValidationRules.onlyFloatNumber(vue)]"
                  v-model="ratios[index].value"
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
  name: "DistrictReportEdit",
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
      ratios: null,
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
        this.$store.dispatch(reportActionType.retrieveDistrictsList, {city_id: defaultCity.id}).then(() => {
          if (!this.selectedDistrict) {
            const defaultDistrict = this.getDistrictsList[0];
            if (defaultDistrict) {
              this.$store.commit(reportMutationType.setCurrentDistrict, defaultDistrict)
            }
          }
        })
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
    getDistrictsList() {
      return this.$store.getters[reportGetterType.getDistrictsList];
    },
    selectedCity: {
      get() {
        const date = this.$store.getters[reportGetterType.getCurrentDate];
        if (date) {
          return date.split('-').slice(0, 2).join('-');
        }
        return date;
      },
      set(city) {
        this.$store.commit(reportMutationType.setCurrentCity, city);
      },
    },
    selectedDistrict: {
      get() {
        return this.$store.getters[reportGetterType.getCurrentRegion];
      },
      set(regionId) {
        const region = this.getDistrictsList.reduce(
            (acc,item) => item && item.id === regionId ? item : acc, null
        );
        this.$store.commit(reportMutationType.setCurrentDistrict, region);
      },
    },
    canLoadRatios() {
      return typeof this.selectedDate === 'string'
          && this.selectedCity
          && this.selectedDistrict
          && typeof this.selectedCity === 'object'
          && typeof this.selectedDistrict === 'object'
          && typeof this.selectedCity.id === 'string'
          && typeof this.selectedDistrict.id === 'string'
          && (
              typeof this.reportType === 'string'
              || typeof this.reportType === 'number'
          )
    },
    recordExists() {
      if (!Array.isArray(this.ratios)) {
        return false;
      }
      return this.ratios.reduce((acc, item) => {
        if (acc) {
          return acc;
        }
        return item.exists && item.exists !== 0;
      }, false);
    },
    regionDisable() {
      return !Array.isArray(this.getCitiesList) || this.getCitiesList.length === 0;
    }
  },
  methods: {
    back() {
      this.$router.go(-1)
    },
    loadRatios() {
      if (this.canLoadRatios) {
        this.$store.dispatch(reportActionType.retrieveRegionRatios, {
          report_type_id: parseInt(this.reportType, 10),
          city_id: this.selectedCity.id,
          district_id: this.selectedDistrict.id,
          date: this.selectedDateFormat,
        }).then(() => {
          this.ratios = this.$store.getters[reportGetterType.getRegionsRatios];
        });
      }
    },
    updateRatios() {
      if (this.$refs.ratioForm.validate()) {
        this.$store.dispatch(reportActionType.updateDistrictRatios, {
          report_type_id: parseInt(this.reportType, 10),
          city_id: this.selectedCity.id,
          district_id: this.selectedDistrict.id,
          date: this.selectedDateFormat,
          ratios: this.ratios,
        }).then((ratios) => {
          this.ratios = ratios;
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
    selectedDistrict() {
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
