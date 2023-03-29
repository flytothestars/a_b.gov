<template>
  <div class="news-side-filter">
    <side-filter
        v-model="filterDrawer"
        @cancel="cancel"
        @confirm="confirm"
    >
      <v-autocomplete
          v-model="filterData.category_id"
          :items="newsCategoryList"
          item-text="name"
          item-value="id"
          dense
          label="Категория"
      ></v-autocomplete>
      <v-autocomplete
          v-model="filterData.is_published"
          :items="publishList"
          item-text="name"
          item-value="id"
          class="mt-5"
          dense
          label="Статус публикации"
      ></v-autocomplete>
      <v-menu
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
      <v-menu
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
    <v-btn
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
  actionType as newsActionType,
  getterType as newsGetterType,
} from "../../store/news";
import SideFilter from "./../SideFilter";

export default {
  name: "NewsSideFilter",
  components: {SideFilter},
  mounted() {
    this.$store.dispatch(newsActionType.newsCategoryList).then(() => {
      this.newsCategoryList = this.$store.getters[newsGetterType.getNewsCategoryList];
    });
  },
  data() {
    return {
      filterData: {
        category_id: null,
        is_published: null,
        start_date: null,
        end_date: null,
      },
      filterDrawer: false,
      newsCategoryList: [],
      start_date_menu: false,
      end_date_menu: false,
    }
  },
  computed: {
    publishList() {
      return [
        { id: 0, name:  this.$vuetify.lang.t('$vuetify.page.news.unpublished') },
        { id: 1, name:  this.$vuetify.lang.t('$vuetify.page.news.published') },
      ];
    },
    computedStartDate() {
      return this.filterData.start_date ? moment(this.filterData.start_date).format('DD/MM/YYYY') : ''
    },
    computedEndDate() {
      return this.filterData.end_date ? moment(this.filterData.end_date).format('DD/MM/YYYY') : ''
    },
  },
  methods: {
    cancel() {
      this.filterData = {
        category_id: null,
        is_published: null,
        start_date: null,
        end_date: null,
      }
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

  }
}
</script>

<style scoped>

</style>
