<template>
  <div class="ma-3">
    <v-card v-if="businessId">
      <v-card-actions>
        <v-btn
            text
            @click="goToBusiness"
        >
          <v-icon class="mr-2">mdi-arrow-left</v-icon>
          Вернуться назад
        </v-btn>
      </v-card-actions>
      <v-card-text>
        <form class="appeals-create__form" @submit="createAppeal">
          <v-select
              :items="categoryList"
              label="Категория"
              item-text="name"
              item-value="id"
              v-model="appeal.category_id"
              :error="isFieldFailed('category_id')"
              :error-messages="getFieldFails('category_id')"
          />
          <v-textarea
              label="Содержание"
              v-model="appeal.content"
              cols="30"
              rows="20"
              :error="isFieldFailed('content')"
              :error-messages="getFieldFails('content')"
              :rules="[fieldValidationRules.required(vue), fieldValidationRules.minLength(vue, 10)]"
          />
          <v-file-input
              label="Прикрепить документы"
              v-model="appeal.files"
              chips
              multiple
              :error="isFieldFailed('files')"
              :error-messages="getFieldFails('files')"
          ></v-file-input>
          <v-divider class="mb-5 mt-5"/>
          <v-btn
              color="primary"
              small
              type="submit"
          >
            Создать
          </v-btn>
        </form>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import {actionType as businessActionType} from "../../store/business";
import {actionType as distributorAppealsActionType} from "../../store/appeals/distributorAppeals";
import roleEnum from "../../enums/roleEnum";
import {actionType as executorAppealsActionType} from "../../store/appeals/executorAppeals";
import {actionType as coExecutorAppealsActionType} from "../../store/appeals/coExecutorAppeals";
import {actionType as upiCuratorAppealsActionType} from "../../store/appeals/upiCuratorAppeals";
import {actionType as districtCuratorAppealsActionType} from "../../store/appeals/districtCuratorAppeals";
import {actionType as dictionaryActionType} from "../../store/dictionary/dictionary";
import {getterType as dictionaryGettersType} from "../../store/dictionary/dictionary";
import {acceptableFiles} from "../../support/files";

export default {
  name: "BusinessAppealCard",
  props: {
    businessId: String
  },
  data() {
    return {
      vue: this,
      actionStore: null,
      categoryList: [],
      appeal: {
        business_id: this.businessId,
        type_id: null,
        category_id: null,
        content: null,
        files: null,
      },
      fails: {
        category_id: [],
        content: [],
        files: [],
      }
    }
  },
  created() {
    if (this.currentRole === roleEnum.Distributor) {
      this.actionStore = distributorAppealsActionType;
    } else {
      this.$router.push({name: 'Home'});
    }
    this.loadAppealCategoryList();

  },
  methods: {
    goToBusiness() {
        this.$router.push({name: 'BusinessCard', params: {id: this.businessId}})
    },
    resetFails() {
      this.fails = {
        category_id: [],
        content: [],
        files: [],
      };
    },
    loadAppealCategoryList() {
      return new Promise((resolve, reject) => {
        this.$store.dispatch(dictionaryActionType.appealCategoryDictionaryList).then((data) => {
          const appealCategoryList = this.$store.getters[dictionaryGettersType.getAppealCategoryDictionaryList];
          this.categoryList = appealCategoryList;
          this.appeal.category_id = appealCategoryList.slice(0, 1)[0].id;
          resolve()
        });
      })
    },
    getFieldFails(field) {
      if (this.fails[field] && this.fails[field].length) {
        return this.fails[field].slice(0, 1)[0];
      }
      return "";
    },
    isFieldFailed(field) {
      return this.getFieldFails(field).length > 0;
    },
    createAppeal(event) {
      event.preventDefault();
      this.resetFails();
      return new Promise((resolve, reject) => {
        this.$store.dispatch(this.actionStore.createNewBusinessAppeal, this.appeal).then((response) => {
          if (response.fails) {
            this.fails = response.fails;
          } else if(response.data.id)
          {
            this.$router.push({name: 'BusinessCard', params: {id: this.businessId}})
          }
          resolve()
        });
      })
    }
  },
  computed: {
    formAcceptFiles() {
      return acceptableFiles.join(', ');
    },
    formFilled() {
      const {
        appeal: {
          parent_appeal_id,
          category_id,
          content,
        }
      } = this;
      return parent_appeal_id && category_id && content;
    },
    currentRole() {
      return this.$store.getters.userRoleList[0]
    },
  },
}
</script>

<style scoped>

</style>
