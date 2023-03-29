<template>
  <div class="business-side-filter">
    <side-filter
        v-model="filterDrawer"
        @cancel="cancel"
        @confirm="confirm"
    >
      <v-autocomplete v-if="availableFilters.includes(filterEnum.cityId)"
          v-model="cityId"
          :items="getCitiesList"
          item-text="name"
          item-value="id"
          class="mt-5"
          dense
          label="Город"
      ></v-autocomplete>
      <v-autocomplete v-if="availableFilters.includes(filterEnum.districtId)"
          v-model="filterData.district_id"
          :items="getDistrictsList"
          item-text="name"
          item-value="id"
          class="mt-5"
          :disabled="!cityId"
          dense
          label="Район"
      ></v-autocomplete>
      <v-autocomplete v-if="availableFilters.includes(filterEnum.distributorId)"
          v-model="filterData.distributor_id"
          :items="distributorList"
          item-text="user.name"
          item-value="user.id"
          class="mt-5"
          dense
          label="Консультант"
      ></v-autocomplete>
      <v-autocomplete v-if="availableFilters.includes(filterEnum.status)"
          v-model="filterData.status"
          :items="businessStatuses"
          item-text="name"
          item-value="id"
          class="mt-5"
          dense
          label="Статус"
      ></v-autocomplete>
      <v-menu  v-if="availableFilters.includes(filterEnum.startDate)"
          ref="start_date_menu"
          v-model="start_date_menu"
          :close-on-content-click="false"
          transition="scale-transition"
          offset-y
          max-width="290px"
          min-width="auto"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
              v-model="computedStartDate"
              label="Начиная с"
              readonly
              prepend-icon="mdi-calendar"
              v-bind="attrs"
              v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
            v-model="filterData.start_date"
            no-title
            @input="start_date_menu = false"
        ></v-date-picker>
      </v-menu>
      <v-menu  v-if="availableFilters.includes(filterEnum.endDate)"
          ref="end_date_menu"
          v-model="end_date_menu"
          :close-on-content-click="false"
          transition="scale-transition"
          offset-y
          max-width="290px"
          min-width="auto"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
              v-model="computedEndDate"
              label="Заканчивая"
              prepend-icon="mdi-calendar"
              readonly
              v-bind="attrs"
              v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker
            v-model="filterData.end_date"
            no-title
            @input="end_date_menu = false"
        ></v-date-picker>
      </v-menu>
    </side-filter>
    <v-btn v-if="availableFilters.length > 0"
        color="primary"
        outlined
        @click="filterDrawer = true"
    >
      <v-icon class="mr-2" dense> mdi-filter-variant</v-icon>
      {{ $vuetify.lang.t('$vuetify.page.action.filter') }}
    </v-btn>
  </div>
</template>

<script>

import moment from 'moment'
import {
  actionType as dictionaryActionType,
  getterType as dictionaryGetterType
} from "../store/dictionary/dictionary";
import SideFilter from "./SideFilter";
import roleEnum from "../enums/roleEnum";
import flowTypeEnum from "../enums/flowTypeEnum";
import {
  actionType as reportActionType,
  getterType as reportGetterType,
  mutationType as reportMutationType
} from "../store/report";
import _filterEnum from "../enums/filterEnum";

export default {
  name: "BusinessSideFilter",
  components: {SideFilter},
  props: {
    availableFilters: Array
  },
  mounted() {
    this.$store.dispatch(dictionaryActionType.retrieveDistrictDictionaryList);
    this.$store.dispatch(dictionaryActionType.retrieveDistributorDictionaryList);
    this.$store.dispatch(dictionaryActionType.retrieveBusinessStatusesList);
    this.$store.dispatch(reportActionType.retrieveCitiesList).then(() => {
      const defaultCity = this.getCitiesList.reduce(
          item => item.id === '25c728b6-f78e-4fbf-9128-c7bca032874f' ? item : null
      );
      if (defaultCity) {
          this.cityId = defaultCity.id
        this.$store.commit(reportMutationType.setCurrentCity, defaultCity);
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
  },
  data() {
    return {
      cityId: null,
      filterData: {
        city_id: null,
        district_id: null,
        start_date: null,
        end_date: null,
        distributor_id: null,
        page: null,
        status: null,
        per_page: null
      },
      filterDrawer: false,
      start_date_menu: false,
      end_date_menu: false,
      isSavedParams: false,
    }
  },
  created() {
    this.getFromUrl();
  },
  computed: {
    filterEnum() {
      return _filterEnum
    },
    distributorList() {
      return this.$store.getters[dictionaryGetterType.getDistributorDictionaryList]
    },
    computedStartDate() {
      return this.filterData.start_date ? moment(this.filterData.start_date).format('DD/MM/YYYY') : ''
    },
    computedEndDate() {
      return this.filterData.end_date ? moment(this.filterData.end_date).format('DD/MM/YYYY') : ''
    },
    getCitiesList() {
      return this.$store.getters[reportGetterType.getCitiesList];
    },
    getDistrictsList() {
      return this.$store.getters[reportGetterType.getDistrictsList];
    },
    businessStatuses() {
      return this.$store.getters[dictionaryGetterType.getBusinessStatusesList]
    },
  },
  watch: {
    cityId(value, oldValue)
    {
      if(value !== oldValue)
      {
        this.filterData.city_id = value;
        this.$store.dispatch(reportActionType.retrieveDistrictsList, {city_id: value})
      }
    }
  },
  methods: {
    cancel() {
      this.filterData = {
        district_id: null,
        start_date: null,
        end_date: null,
        distributor_id: null,
        page: null,
        status: null,
        per_page: null
      }
      window.history.pushState(null, null, '?')
      this.$emit('cancel')
    },
    confirm() {
      this.$emit('confirm', this.filterData)
    },
    formatDate(date) {
      if (!date) return null

      const [year, month, day] = date.split('-')
      return `${month}/${day}/${year}`
    },
    parseDate(date) {
      if (!date) return null

      const [month, day, year] = date.split('/')
      return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
    },
    getFromUrl() {
      let url = new URL(window.location.href)
      let item
      for (let key in this.filterData) {
        item = url.searchParams.get(key);
        if (item) {
          this.filterData[key] = item
        }
      }
    },

  }
}
</script>

<style scoped>

</style>
