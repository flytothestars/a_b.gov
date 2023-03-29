<template>
  <v-container id="service-list" fluid expert="section" pt-0>

    <div class="text-right justify-end d-flex mb-2">
      <v-text-field type="number" class="pt-0" v-model.number="searchValue" label="ИИН/БИН заявителя" height="38"
        :maxlength="limit" counter="12"></v-text-field>
      <v-btn class="px-0" color="primary" elevation="2" @click="filterApply">
        <v-icon>
          mdi-magnify
        </v-icon>
      </v-btn>
      <v-spacer></v-spacer>

      <!-- Button download -->
      <v-btn v-if="checkRole2()" class="mr-3" :loading="excelExportInProcess" :disabled="excelExportInProcess"
        @click="excelExport2">

        <v-icon right dark class="pr-3">
          mdi-microsoft-excel
        </v-icon>
        {{ $vuetify.lang.t('$vuetify.page.action.btnDownload2') }}
      </v-btn>
      <v-btn class="mr-3" :loading="excelExportInProcess" :disabled="excelExportInProcess" @click="excelExport">

        <v-icon right dark class="pr-3">
          mdi-microsoft-excel
        </v-icon>
        {{ $vuetify.lang.t('$vuetify.page.action.btnDownload') }}
      </v-btn>
      <appeals-side-filter v-if="availableFilters" @confirm="filterApply" @cancel="filterCancel"
        :available-filters="availableFilters" @click="this.showFilter = true">
      </appeals-side-filter>
    </div>

    <!--    <div class="text-right justify-end d-flex mb-2">-->
    <!--        <v-col cols="10"></v-col>-->
    <!--        <v-col-->
    <!--            class="d-flex"-->
    <!--            style="padding-right: 0;"-->
    <!--        >-->
    <!--            <v-btn-->
    <!--                v-if="canReassignCuratorForMultipleAppeal"-->
    <!--                :disabled="((ids.length === 0) ? true : false)"-->
    <!--                @click="dialog.reassign_distributor = true"-->
    <!--                small-->
    <!--            >-->
    <!--                Переназначить консультанта-->
    <!--            </v-btn>-->
    <!--        </v-col>-->
    <!--    </div>-->
    <template v-if="checkRole3()">
      <v-data-table :headers="headers" :items="appealsList" :options.sync="options"
        :server-items-length="totalAppealsCount" sort-by="name" :footer-props="{
          'items-per-page-options': [10, 20, 30]
        }" :loading="loading">
        <!--        <template v-slot:header.check="{ header }">-->
        <!--            <v-checkbox-->
        <!--                v-if="canReassignCuratorForMultipleAppeal"-->
        <!--                name="check_all"-->
        <!--                v-model="check_all"-->
        <!--                @change="selectAllCheckboxes()"-->
        <!--            >-->
        <!--                <template v-slot:label>-->
        <!--                    <span id="checkboxLabel">Выбрать все</span>-->
        <!--                </template>-->
        <!--            </v-checkbox>-->
        <!--        </template>-->

        <!--        <template v-slot:item.check="{ item }">-->
        <!--            <v-checkbox-->
        <!--                v-if="canReassignCuratorForMultipleAppeal"-->
        <!--                v-model="ids"-->
        <!--                :name="item.id"-->
        <!--                :value="item.id"-->
        <!--            ></v-checkbox>-->
        <!--        </template>-->

        <template v-slot:item.client_appeal_status="{ item }">
          <img src="/images/done.png" alt="Done"
            v-if="item.client_appeal_status.id === _clientAppealStatusEnum.Completed">
          <img src="/images/close.png" alt="close"
            v-else-if="item.client_appeal_status.id === _clientAppealStatusEnum.Rejected">
          <div v-else>{{ getClientStatus(item) }}</div>
        </template>
        <template v-slot:item.client="{ item }">
          {{ getName(item) }}
        </template>
        <template v-slot:item.appeal_status="{ item }">
          {{ getStatus(item) }}
        </template>
        <template v-slot:item.create_date="{ item }">
          {{ item.create_date | formatDateTime }}
        </template>
        <template v-slot:item.distributor="{ item }">
          {{ profileFio(item.distributor) }}
        </template>
        <template v-slot:item.executor="{ item }">
          {{ profileFio(item.executor) }}
        </template>
        <template v-slot:item.co_executor="{ item }">
          {{ profileFio(item.co_executor) }}
        </template>
        <template v-slot:item.UpiDistrictCurator="{ item }">
          {{ getUpiDistrictCurator(item) }}
        </template>
        <template v-slot:item.iin="{ item }">
          {{ getIINSecond(item) }}
        </template>
        <template v-slot:item.content="{ item }">
          {{ getContent(item) }}
        </template>
        <template v-slot:item.source="{ item }">
          {{ getSource(item) }}
        </template>
        <template v-slot:item.actions="{ item }">
          <v-btn small class="mr-2" @click="showCard(item)" outlined color="primary">
            Подробнее
          </v-btn>
        </template>
      </v-data-table>
    </template>
    <template v-else>
      <v-data-table :headers="headers" :items="appealsList" :options.sync="options"
        :server-items-length="totalAppealsCount" sort-by="name" :footer-props="{
          'items-per-page-options': [10, 20, 30]
        }" :loading="loading">
        <!--        <template v-slot:header.check="{ header }">-->
        <!--            <v-checkbox-->
        <!--                v-if="canReassignCuratorForMultipleAppeal"-->
        <!--                name="check_all"-->
        <!--                v-model="check_all"-->
        <!--                @change="selectAllCheckboxes()"-->
        <!--            >-->
        <!--                <template v-slot:label>-->
        <!--                    <span id="checkboxLabel">Выбрать все</span>-->
        <!--                </template>-->
        <!--            </v-checkbox>-->
        <!--        </template>-->

        <!--        <template v-slot:item.check="{ item }">-->
        <!--            <v-checkbox-->
        <!--                v-if="canReassignCuratorForMultipleAppeal"-->
        <!--                v-model="ids"-->
        <!--                :name="item.id"-->
        <!--                :value="item.id"-->
        <!--            ></v-checkbox>-->
        <!--        </template>-->

        <template v-slot:item.client_appeal_status="{ item }">
          <img src="/images/done.png" alt="Done"
            v-if="item.client_appeal_status.id === _clientAppealStatusEnum.Completed">
          <img src="/images/close.png" alt="close"
            v-else-if="item.client_appeal_status.id === _clientAppealStatusEnum.Rejected">
          <div v-else>{{ getClientStatus(item) }}</div>
        </template>
        <template v-slot:item.client="{ item }">
          {{ getName(item) }}
        </template>
        <template v-slot:item.appeal_status="{ item }">
          {{ getStatus(item) }}
        </template>
        <template v-slot:item.create_date="{ item }">
          {{ item.create_date | formatDateTime }}
        </template>
        <template v-slot:item.distributor="{ item }">
          {{ profileFio(item.distributor) }}
        </template>
        <template v-slot:item.executor="{ item }">
          {{ profileFio(item.executor) }}
        </template>
        <template v-slot:item.co_executor="{ item }">
          {{ profileFio(item.co_executor) }}
        </template>
        <template v-slot:item.UpiDistrictCurator="{ item }">
          {{ getUpiDistrictCurator(item) }}
        </template>
        <template v-slot:item.iin="{ item }">
          {{ getIIN(item) }}
        </template>
        <template v-slot:item.content="{ item }">
          {{ getContent(item) }}
        </template>
        <template v-slot:item.source="{ item }">
          {{ getSource(item) }}
        </template>
        <template v-slot:item.actions="{ item }">
          <v-btn small class="mr-2" @click="showCard(item)" outlined color="primary">
            Подробнее
          </v-btn>
        </template>
      </v-data-table>
    </template>



    <v-dialog v-model="dialog.reassign_distributor" width="500">
      <v-card>
        <v-card-title>
          <span>Переназначить консультанта</span>
          <v-spacer></v-spacer>
          <v-btn icon @click="dialog.reassign_distributor = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text class="mt-3">
          <v-form ref="reassignDistributorForm">
            <v-autocomplete v-model="actionData.distributor" :items="distributorList" item-text="fio" item-value="id"
              dense label="Консультант" return-object :rules="[fieldValidationRules.required(vue)]"></v-autocomplete>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn x-large color="primary" @click="applyAction">
            <v-icon class="mr-4">mdi-plus-circle</v-icon>
            Переназначить
          </v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import roleEnum from "../../enums/roleEnum"
import {
  actionType as headAppealsActionType,
  getterType as headAppealsGetterType
} from "../../store/appeals/headAppeals";
import {
  actionType as distributorAppealsActionType,
  getterType as distributorAppealsGetterType
} from "../../store/appeals/distributorAppeals";
import {
  actionType as executorAppealsActionType,
  getterType as executorAppealsGetterType
} from "../../store/appeals/executorAppeals";
import {
  actionType as coExecutorAppealsActionType,
  getterType as coExecutorAppealsGetterType
} from "../../store/appeals/coExecutorAppeals";
import SideFilter from "../../components/SideFilter";
import AppealsSideFilter from "../../components/AppealsSideFilter";
import {
  actionType as upiCuratorAppealsActionType,
  getterType as upiCuratorAppealsGetterType
} from "../../store/appeals/upiCuratorAppeals";
import {
  actionType as districtCuratorAppealsActionType,
  getterType as districtCuratorAppealsGetterType
} from "../../store/appeals/districtCuratorAppeals";
import {
  actionType as divisionCuratorAppealsActionType,
  getterType as divisionCuratorAppealsGetterType
} from "../../store/appeals/divisionCuratorAppeals";
import {
  actionType as upiHeadAppealsActionType,
  getterType as upiHeadAppealsGetterType
} from "../../store/appeals/upiHeadAppeals";
import {
  actionType as iemanagerAppealsActionType,
  getterType as iemanagerAppealsGetterType
} from "../../store/appeals/iemanagerAppeals";

import clientAppealStatusEnum from "../../enums/clientAppealStatusEnum";
import _availableFilters from "../../enums/availableFilters";
import { getterType as dictionaryGetterType } from "../../store/dictionary/dictionary";
import appealStatusEnum from "../../enums/appealStatusEnum";
let actionEnum = {
  create: 0,
  edit: 1,
  set_executor: 2,
  set_coExecutor: 3,
  return_for_revision: 4,
  complete: 5,
  reject: 6,
  confirm: 7,
  set_curator: 8,
  division_department_confirm: 9,
  edit_category: 10,
  reassign_distributor: 11,
  cant_contact: 12
}

export default {
  name: "AppealsSandbox",
  components: { AppealsSideFilter, SideFilter },
  created() {
    switch (this.currentRole) {
      case roleEnum.Administrator: {
        this.$router.push({ name: 'UserList' })
        break
      }
      case roleEnum.Head: {
        this.actionStore = headAppealsActionType
        this.getterStore = headAppealsGetterType
        break
      }
      case roleEnum.IEManager: {
        this.actionStore = iemanagerAppealsActionType
        this.getterStore = iemanagerAppealsGetterType
        break
      }
      case roleEnum.Distributor: {
        this.actionStore = distributorAppealsActionType
        this.getterStore = distributorAppealsGetterType
        break
      }
      case roleEnum.Executor: {
        this.actionStore = executorAppealsActionType
        this.getterStore = executorAppealsGetterType
        break
      }
      case roleEnum.CoExecutor: {
        this.actionStore = coExecutorAppealsActionType
        this.getterStore = coExecutorAppealsGetterType
        break
      }
      case roleEnum.UpiCurator: {
        this.actionStore = upiCuratorAppealsActionType
        this.getterStore = upiCuratorAppealsGetterType
        break
      }
      case roleEnum.DistrictCurator: {
        this.actionStore = districtCuratorAppealsActionType
        this.getterStore = districtCuratorAppealsGetterType
        break
      }
      case roleEnum.DivisionCurator: {
        this.actionStore = divisionCuratorAppealsActionType
        this.getterStore = divisionCuratorAppealsGetterType
        break
      }
      case roleEnum.UpiHead: {
        this.actionStore = upiHeadAppealsActionType
        this.getterStore = upiHeadAppealsGetterType
        break
      }
    }

    this.availableFilters = _availableFilters.find(item => item.roles.includes(this.currentRole) && item.pages.includes(this.$options.name))?.filters

    if (this.actionStore) {
      this.getFromUrl()
    }
  },
  computed: {
    appealsList() {
      return this.$store.getters[this.getterStore.getAppealList]
    },
    totalAppealsCount() {
      return this.$store.getters[this.getterStore.getTotalAppealCount]
    },
    currentRole() {
      return this.$store.getters.userRoleList[0]
    },
    _clientAppealStatusEnum() {
      return clientAppealStatusEnum
    },
    distributorList() {
      return this.$store.getters[dictionaryGetterType.getDistributorDictionaryList]
    },
    // canReassignCuratorForMultipleAppeal(){
    //   return (this.currentRole === roleEnum.UpiCurator);
    // }
  },
  data() {
    return {
      limit: 12,
      number: 0,
      searchValueClone: 'a',
      numberRule: val => {
        if (val.length >= 12) return 'ИИН/БИН должен быть не больше 12 цифр!'
        return true
      },
      vue: this,
      ids: [],
      options: {},
      action: null,
      check_all: false,
      editItem: null,
      excelExportInProcess: false,
      actionStore: null,
      getterStore: null,
      loading: false,
      availableFilters: null,
      filterData: {
        district_id: null,
        appeal_status_id: null,
        client_appeal_status_id: null,
        appeal_result_type_id: null,
        category_id: null,
        source_type_id: null,
        start_date: null,
        end_date: null,
        start_date_updated: null,
        end_date_updated: null,
        executor_id: null,
        co_executor_id: null,
        distributor_id: null,
        last_curator_district_id: null,
        last_curator_upi_id: null,
        page: null,
        per_page: null
      },
      headers: [
        // {
        //   text: 'Выбор',
        //   align: 'start',
        //   sortable: false,
        //   value: 'check',
        // },
        // {
        //     text: this.$vuetify.lang.t('$vuetify.page.appeal.appealsApplication'),
        //     align: 'start',
        //     sortable: true,
        //     value: 'client_appeal_status',
        // },
        // {
        //   text: this.$vuetify.lang.t('$vuetify.page.appeal.appealNumber'),
        //   align: 'start',
        //   sortable: true,
        //   value: 'appeal_no',
        // },
        {
          text: this.$vuetify.lang.t('$vuetify.page.appeal.client'),
          align: 'start',
          sortable: false,
          value: 'client',
        },
        {
          text: this.$vuetify.lang.t('$vuetify.page.appeal.iin'),
          align: 'start',
          sortable: false,
          value: 'iin',
        },
        {
          text: this.$vuetify.lang.t('$vuetify.page.appeal.category'),
          align: 'start',
          sortable: false,
          value: 'category.name',
        },
        // {
        //   text: this.$vuetify.lang.t('$vuetify.page.appeal.content'),
        //   align: 'start',
        //   sortable: true,
        //   value: 'content',
        // },
        {
          text: this.$vuetify.lang.t('$vuetify.page.appeal.status'),
          align: 'start',
          sortable: false,
          value: 'client_appeal_status',
        },
        {
          text: this.$vuetify.lang.t('$vuetify.page.appeal.distributor'),
          align: 'start',
          sortable: false,
          value: 'distributor',
        },
        // {
        //   text: this.$vuetify.lang.t('$vuetify.page.appeal.executor'),
        //   align: 'start',
        //   sortable: true,
        //   value: 'executor',
        // },
        // {
        //   text: this.$vuetify.lang.t('$vuetify.page.appeal.coExecutor'),
        //   align: 'start',
        //   sortable: true,
        //   value: 'co_executor',
        // },
        // {
        //   text: this.$vuetify.lang.t('$vuetify.page.appeal.upiDistrictCurator'),
        //   align: 'start',
        //   sortable: true,
        //   value: 'UpiDistrictCurator',
        // },
        {
          text: this.$vuetify.lang.t('$vuetify.page.appeal.source'),
          align: 'start',
          sortable: false,
          value: 'source',
        },
        {
          text: this.$vuetify.lang.t('$vuetify.page.appeal.createDate'),
          align: 'start',
          sortable: false,
          value: 'create_date',
        },
        { text: this.$vuetify.lang.t('$vuetify.page.action.titleAction'), value: 'actions', sortable: false },
      ],
      filterDrawer: false,
      showFilter: false,
      searchValue: "",
      dialog: {
        /*complete: false,
        reject: false,
        set_executor: false,
        set_coExecutor: false,
        confirm: false,
        set_curator: false,
        edit_category: false,*/
        reassign_distributor: false,
      },
      actionData: {
        /*comment: null,
        executor: null,*/
        distributor: null,
        /*coExecutor: null,
        curatorUpi: null,
        curatorDistrict: null,
        district: null,
        appealResultType: null,
        category: null,
        industry: null,
        files: null,
        phone: null,*/
      },
    }
  },
  watch: {
    searchValue() {
      if (this.searchValue == "" && this.searchValueClone != 'a') {
        this.getList()
        this.searchValueClone = "a"
      }
    },
    options: {
      handler() {
        this.getList()
      },
      deep: true,
    },
  },
  methods: {
    checkRole() {
      if (this.currentRole === roleEnum.Executor) {
        return true
      } else {
        return false
      }
    },
    checkRole2() {
      if (this.currentRole === roleEnum.Administrator) {
        return true
      } else {
        return false
      }
    },
    checkRole3() {
      if (this.currentRole === roleEnum.IEManager) {
        return true
      } else {
        return false
      }
    },
    showCard(item) {
      this.$router.push({ name: 'AppealCard', params: { id: item.id } })
    },

    profileFio(profile) {
      return profile ? `${profile.last_name} ${profile.first_name}` : 'Нет'
    },
    getName(profile) {
      let fio = ""
      if (profile.client) {
        if (profile.client.organization) {
          fio += profile.client.organization.name
        } else {
          if (profile.client.last_name) {
            fio += profile.client.last_name + ' '
          }
          if (profile.client.first_name) {
            fio += profile.client.first_name
          }
          if (fio === "" && profile.client.company_name) {
            fio += profile.client.company_name
          }
        }
        if ((fio === "" || fio === 'null') && profile?.client?.user?.name) {
          fio = profile.client.user.name
        }
        if ((fio === "" || fio === 'null') && profile?.client?.user?.phone) {
          fio = profile.client.user.phone
        }
      } else if (profile.business) {
        if (profile.business.name) {
          fio += profile.business.name
        } else {
          fio += profile.business.display_name
        }
      }
      return fio
    },

    getApplication(item) {
      return item.client_appeal_status.name === clientAppealStatusEnum.InWork
    },
    shortContent(content) {
      return content.substring(0, 100)
    },
    getIIN(item) {
      return item.business != null && item.business.organization != null ? item.business.organization.iin : ''
    },
    getIINSecond(item) {
      return item.client.iin ? item.client.iin : ''
    },
    getContent(item) {
      return item.content === "" ? "" : this.shortContent(item.content)
    },
    getList() {
      if (this.searchValue === "") {
        delete this.filterData.iin
        this.filterData.page = this.options.page
      } else {
        this.filterData.iin = this.searchValue
        this.options.page = 1
        this.filterData.page = this.options.page
      }

      this.filterData.page = this.options.page
      this.filterData.per_page = this.options.itemsPerPage
      this.searchValueClone = JSON.parse(JSON.stringify(this.searchValue))
      this.saveInUrl()

      this.loading = true
      this.$store.dispatch(this.actionStore.retrieveAllAppealList, this.filterData).then(() => {
        this.loading = false
      })
    },
    filterApply(data) {
      this.filterData = data
      this.getList()
    },
    filterCancel() {
      if (this.searchValue === "")
        this.filterData = {
          page: 1
        }
      else
        this.filterData = {
          iin: this.searchValue,
          page: 1
        }
      this.$store.dispatch(this.actionStore.retrieveAllAppealList, this.filterData)
    },
    getStatus(item) {
      return item.appeal_status?.name ? item.appeal_status?.name : 'На распределении'
    },
    getClientStatus(item) {
      return item.client_appeal_status?.name ? item.client_appeal_status?.name : 'На распределении'
    },
    getSource(item) {
      return item.appeal_source_type?.name ? item.appeal_source_type.name : 'Нет'
    },
    getUpiDistrictCurator(item) {
      let upi = item.upi_curator ? item.upi_curator.fio : 'Нет'
      let district = item.district_curator ? item.district_curator.fio : 'Нет'
      return `${upi} / ${district}`
    },
    excelExport() {
      this.excelExportInProcess = true
      let filter = Object.assign({}, this.filterData);
      filter.per_page = null
      filter.page = null
      this.$store.dispatch(this.actionStore.excelExport, filter).then((response) => {
        let link = document.createElement("a");
        let blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        link.href = window.URL.createObjectURL(blob)
        link.download = 'Обращения';
        link.click();
        this.excelExportInProcess = false;
      })
    },
    excelExport2() {
      this.excelExportInProcess = true
      let filter = Object.assign({}, this.filterData);
      filter.per_page = null
      filter.page = null
      this.$store.dispatch(this.actionStore.excelExport2, filter).then((response) => {
        let link = document.createElement("a");
        let blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        link.href = window.URL.createObjectURL(blob)
        link.download = 'Обращения';
        link.click();
        this.excelExportInProcess = false;
      })
    },
    saveInUrl() {
      let url = new URL(window.location.href)
      for (let key in this.filterData) {
        if (this.filterData[key]) {
          url.searchParams.set(key, this.filterData[key])
        }
      }
      window.history.replaceState(null, null, url.search)
    },
    getFromUrl() {
      let url = new URL(window.location.href)
      let item
      for (let key in this.filterData) {
        item = url.searchParams.get(key);
        if (item) {
          this.filterData[key] = item
          if (key === "page")
            this.options.page = parseInt(item)
          if (key === "per_page")
            this.options.itemsPerPage = parseInt(item)
        }
      }
    },
    applyAction() {
      new Promise((resolve, reject) => {
        if (this.$refs.reassignDistributorForm.validate()) {
          this.$store.dispatch(this.actionStore.reassignDistributorMultiple, {
            id: this.ids,
            distributor_id: this.actionData.distributor.user.id,
          }).then(() => {
            this.getList();
            this.ids = [];
            this.check_all = false;
            this.actionData.distributor = null;
            this.dialog.reassign_distributor = false;
            resolve()
          })
        }
      }).then(() => {
        //this.$refs.appealHistory.refreshHistory()
      })
    },
    selectAllCheckboxes() {
      if (this.check_all) {
        let selected = [];
        this.appealsList.map(function (val, key) {
          selected.push(val.id);
        });
        this.ids = selected;
      } else {
        this.ids = []
      }
    }
  }
}
</script>

<style scoped>
#checkboxLabel {
  color: #2196F3 !important;
  font-size: 0.75rem;
  line-height: 12px;
  text-align: center;
}
</style>
