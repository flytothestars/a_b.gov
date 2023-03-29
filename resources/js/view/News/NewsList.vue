<template>
  <v-container
      id="service-list"
      fluid
      expert="section"
      pt-0
  >
    <div class="text-right justify-end d-flex mb-8">
      <v-btn
          class="mr-3"
          @click="goToCreateNews"
          color="primary"
      >
        Добавить новость
      </v-btn>
      <news-side-filter
          @confirm="filterApply"
          @cancel="filterCancel"
      >
      </news-side-filter>
    </div>
    <v-data-table
        :headers="headers"
        :items="news"
        sort-by="create_date"
        :loading="loading"
    >
      <template v-slot:item.category="{ item }">
        {{ item.category.name }}
      </template>
      <template v-slot:item.actions="{ item }">
        <v-btn
            small
            class="mr-2"
            @click="() => goToNews(item.id)"
            outlined
            color="primary"
        >
          {{ $vuetify.lang.t('$vuetify.page.action.btnEdit') }}
        </v-btn>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
import NewsSideFilter from "../../components/news/NewsSideFilter";
import {
  actionType as newsActionType,
  getterType as newsGetterType,
} from "../../store/news";


export default {
  name: "NewsList",
  components: {NewsSideFilter},
  data() {
    return {
      actionStore: null,
      news: [],
      loading: false,
      headers: [
        {
          text: this.$vuetify.lang.t('$vuetify.page.news.date'),
          align: 'start',
          sortable: true,
          value: 'create_date',
        },
        {
          text: this.$vuetify.lang.t('$vuetify.page.news.category'),
          align: 'start',
          sortable: true,
          value: 'category',
        },
        {
          text: this.$vuetify.lang.t('$vuetify.page.news.header'),
          align: 'start',
          sortable: false,
          value: 'header',
        },
        {
          text: this.$vuetify.lang.t('$vuetify.page.action.titleAction'),
          value: 'actions',
          sortable: false
        },
      ],
    };
  },
  created() {
    this.actionStore = newsActionType;

    this.fetchNewsList();
  },
  computed: {},
  methods: {
    filterApply(filter) {
      this.fetchNewsList(filter);
    },
    filterCancel() {
      this.fetchNewsList();
    },
    fetchNewsList(filter) {
      this.loading = true;
      this.$store.dispatch(this.actionStore.newsList, filter || {}).then(() => {
        this.loading = false;
        this.news = this.$store.getters[newsGetterType.getNewsList];
      });
    },
    goToNews(id)
    {
      this.$router.push({name: 'NewsEditor', params: {id}})
    },
    goToCreateNews(id)
    {
      this.$router.push({name: 'NewsCreator', params: {id}})
    },
  },
}
</script>

<style scoped>

</style>
