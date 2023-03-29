<template>
  <v-container
      id="service-list"
      fluid
      expert="section"
      pt-0
  >
    <v-row>
      <v-col cols="12">
        <v-btn
            text
            @click="back"
        >
          <v-icon class="mr-2">mdi-arrow-left</v-icon>
          Вернуться назад
        </v-btn>
        <v-btn
            class="float-right"
            @click="storeNews"
            color="primary"
            :disabled="loading"
            :loading="loading"
        >
          Сохранить
        </v-btn>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="1" sm="4" md="4" lg="3">
        <v-switch
            v-model="isPublished"
            label="Новость опубликована"
            :disabled="loading"
        ></v-switch>
      </v-col>
      <v-col cols="1" sm="4" md="4" lg="3">
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
                class="mt-5"
                v-model="createDate"
                label="Дата публикации"
                prepend-icon="mdi-calendar"
                readonly
                v-bind="attrs"
                v-on="on"
                :disabled="loading"
                :error="isFieldFailed('createDate')"
                :error-messages="getFieldFails('createDate')"
            ></v-text-field>
          </template>
          <v-date-picker
              v-model="createDate"
              no-title
              scrollable
          />
        </v-menu>
      </v-col>
      <v-col cols="2" sm="4" md="4" lg="3">
        <v-file-input
            class="mt-5"
            label="Изображение"
            v-model="newsFile"
            accept="image/*"
            :disabled="loading"
            :error="isFieldFailed('file')"
            :error-messages="getFieldFails('file')"
        ></v-file-input>
      </v-col>
      <v-col cols="2" sm="4" md="4" lg="3">
        <v-autocomplete
            class="news-bar-pad"
            v-model="categoryId"
            :items="newsCategoryList"
            item-text="name"
            item-value="id"
            dense
            label="Категория"
            :disabled="loading"
            :error="isFieldFailed('categoryId')"
            :error-messages="getFieldFails('categoryId')"
        ></v-autocomplete>
      </v-col>
    </v-row>
    <v-tabs
        v-model="currentLanguage"
    >
      <v-tab key="ru">Русский</v-tab>
      <v-tab key="kk">Казахский</v-tab>
    </v-tabs>

    <div
        v-if="getSelectedLanguage === 'ru'"
        class="pt-5"
    >
      <v-text-field
          v-model="newsRuHeader"
          label="Заголовок"
          :disabled="loading"
          :error="isFieldFailed('headerRu')"
          :error-messages="getFieldFails('headerRu')"
      ></v-text-field>
      <v-text-field
          v-model="newsRuLead"
          label="Аннотация"
          :disabled="loading"
          :error="isFieldFailed('leadRu')"
          :error-messages="getFieldFails('leadRu')"
      ></v-text-field>
      <div class="mt-3">
        <label>
          Содержание статьи
        </label>
      </div>
      <div>
        <span
            v-if="isFieldFailed('contentRu')"
            class="error--text"
        >
          {{ getFieldFails('contentRu') }}
        </span>
      </div>
      <editor
          :key="newsRuEditorUuid"
          :api-key="tinyMceConfig.apiKey"
          :init="tinyMceConfig.newsInit"
          v-model="newsRuContent"
          model-events="change keydown blur focus paste"
          :disabled="loading"
      ></editor>
    </div>
    <div
        v-if="getSelectedLanguage === 'kk'"
        class="pt-5"
    >
      <v-text-field
          v-model="newsKkHeader"
          label="Заголовок"
          :disabled="loading"
          :error="isFieldFailed('headerKk')"
          :error-messages="getFieldFails('headerKk')"
      ></v-text-field>
      <v-text-field
          v-model="newsKkLead"
          label="Аннотация"
          :disabled="loading"
          :error="isFieldFailed('leadKk')"
          :error-messages="getFieldFails('leadKk')"
      ></v-text-field>
      <div class="mt-3">
        <label>
          Содержание статьи
        </label>
      </div>
      <div>
        <span
            v-if="isFieldFailed('contentKk')"
            class="error--text"
        >
          {{ getFieldFails('contentKk') }}
        </span>
      </div>
      <editor
          :key="newsKkEditorUuid"
          :api-key="tinyMceConfig.apiKey"
          :init="tinyMceConfig.newsInit"
          v-model="newsKkContent"
          model-events="change keydown blur focus paste"
          :disabled="loading"
      ></editor>
    </div>
  </v-container>
</template>

<script>

import Editor from '@tinymce/tinymce-vue'
import config from "../../tiny-mce-config";
import moment from 'moment'
import {actionType as newsActionType, getterType as newsGetterType} from "../../store/news";

export default {
  name: "NewsCreator",
  data() {
    return {
      fails: {
        file: null,
        createDate: null,
        categoryId: null,
        headerRu: null,
        leadRu: null,
        contentRu: null,
        headerKk: null,
        leadKk: null,
        contentKk: null,
      },
      newsCategoryList: [],
      categoryId: null,
      currentLanguage: 'ru',
      createDate: null,
      dateMenu: false,
      isPublished: null,
      newsFile: null,
      newsRuEditorUuid: null,
      newsRuHeader: null,
      newsRuLead: null,
      newsRuContent: null,
      newsKkEditorUuid: null,
      newsKkHeader: null,
      newsKkLead: null,
      newsKkContent: null,
      loading: false,
    }
  },
  components: {
    Editor,
  },
  mounted() {
    this.createDate = moment().format('YYYY-MM-DD');
    this.$store.dispatch(newsActionType.newsCategoryList).then(() => {
      this.newsCategoryList = this.$store.getters[newsGetterType.getNewsCategoryList];
    });

    this.newsRuEditorUuid = this.$uuid.v4();
    this.newsKkEditorUuid = this.$uuid.v4();
  },
  computed: {
    tinyMceConfig() {
      return config;
    },
    getSelectedLanguage() {
      return this.currentLanguage === 0 ? 'ru' : 'kk';
    }
  },
  methods: {
    back() {
      this.$router.push({name: 'NewsList'})
    },
    setLanguage(lang) {
      this.currentLanguage = lang;
    },
    storeNews() {
      this.loading = true;

      const data = {
        file: this.newsFile,
        isPublished: this.isPublished ? 1 : 0,
        createDate: this.createDate,
        categoryId: this.categoryId,
        headerRu: this.newsRuHeader,
        leadRu: this.newsRuLead,
        contentRu: this.newsRuContent,
        headerKk: this.newsKkHeader,
        leadKk: this.newsKkLead,
        contentKk: this.newsKkContent,
      };
      this.$store.dispatch(newsActionType.createNews, data)
          .then((response) => {
            this.$router.push({name: 'NewsEditor', params: {id: response.id}});
          })
          .catch(response => {
            if (response.status === 422) {
              this.fails = response.data.errors;
              if (
                  !this.fails.leadRu
                  && !this.fails.contentRu
                  && !this.fails.headerRu
                  && (
                      this.fails.leadKk
                      || this.fails.headerKk
                      || this.fails.contentKk
                  )
              ) {
                this.currentLanguage = 1;
              }
              if (
                  !this.fails.leadKk
                  && !this.fails.headerKk
                  && !this.fails.contentKk
                  && (
                      this.fails.leadRu
                      || this.fails.contentRu
                      || this.fails.headerRu
                  )
              ) {
                this.currentLanguage = 0;
              }
            }
          })
          .finally(() => {
            this.loading = false;
          });
    },
    getFieldFails(field) {
      if (this.fails[field] && this.fails[field].length) {
        return this.fails[field].slice(0, 1)[0];
      }
      return "";
    },
    resetFieldFail(field) {
      const fails = this.fails;
      if (fails[field] && fails[field].length) {
        fails[field] = null;
        this.fails = fails;
      }
    },
    resetFails() {
      this.fails = {
        file: null,
        createDate: null,
        categoryId: null,
        headerRu: null,
        leadRu: null,
        contentRu: null,
        headerKk: null,
        leadKk: null,
        contentKk: null,
      };
    },
    isFieldFailed(field) {
      return this.getFieldFails(field).length > 0;
    },
  },
  watch: {
    currentLanguage() {
      this.newsRuEditorUuid = this.$uuid.v4();
      this.newsKkEditorUuid = this.$uuid.v4();
    },
    categoryId() {
      this.resetFieldFail('categoryId')
    },
    newsFile() {
      this.resetFieldFail('file')
    },
    createDate() {
      this.resetFieldFail('createDate')
    },
    newsRuHeader() {
      this.resetFieldFail('headerRu')
    },
    newsRuLead() {
      this.resetFieldFail('leadRu')
    },
    newsRuContent() {
      this.resetFieldFail('contentRu')
    },
    newsKkHeader() {
      this.resetFieldFail('headerKk')
    },
    newsKkLead() {
      this.resetFieldFail('leadKk')
    },
    newsKkContent() {
      this.resetFieldFail('contentKk')
    },
  }
}
</script>

<style scoped>

</style>
