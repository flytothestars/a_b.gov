<template>
    <v-container
        id="service-list"
        fluid
        expert="section"
        pt-0
    >
        <div class="text-right justify-end d-flex  mb-8">
            <v-text-field
                type="number"
                class="pt-0"
                v-model.number="searchValue"
                label="ИИН/БИН заявителя"
                height="38"
                :maxlength="limit"
                counter="12"
            ></v-text-field>
            <v-btn
                class="px-0"
                color="primary"
                elevation="2"
                @click="filterApply"
            >
                <v-icon>
                    mdi-magnify
                </v-icon>
            </v-btn>
            <v-spacer></v-spacer>
            <v-btn
                class="mr-3"
                :loading="excelExportInProcess"
                :disabled="excelExportInProcess"
                @click="excelExport">

                <v-icon
                    right
                    dark
                    class="pr-3"
                >
                    mdi-microsoft-excel
                </v-icon>
                {{ $vuetify.lang.t('$vuetify.page.action.btnDownload') }}
            </v-btn>
            <appeals-side-filter
                v-if="availableFilters"
                @confirm="filterApply"
                @cancel="filterCancel"
                :available-filters="availableFilters"
                :filterByStatus="filterByStatus"
                :flow-type="filterFlowType"
            >
            </appeals-side-filter>
        </div>
        <v-data-table
            :headers="headers"
            :items="appealsList || []"
            :options.sync="options"
            :server-items-length="totalAppealsCount"
            sort-by="name"
            class="elevation-1"
            :footer-props="{
                'items-per-page-options': [10, 20, 30]
            }"
            :loading="loading"
        >
            <template v-slot:item.client_appeal_status="{ item }">
                <img src="/images/done.png"
                     alt="Done"
                     v-if="item.client_appeal_status.id === _clientAppealStatusEnum.Completed"
                >
                <img src="/images/close.png"
                     alt="close"
                     v-else-if="item.client_appeal_status.id === _clientAppealStatusEnum.Rejected"
                >
                <div v-else>{{ getClientStatus(item) }} {{ getStatus(item) }}</div>
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
            <template v-if="currentRole==='Manager'" v-slot:item.distributor="{ item }">
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
                <v-btn
                    small
                    class="mr-2"
                    @click="showCard(item)"
                    outlined
                    color="primary"
                >
                    Подробнее
                </v-btn>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
import roleEnum from "../../enums/roleEnum";
import clientAppealStatusEnum from "../../enums/clientAppealStatusEnum";
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
import _availableFilters from "../../enums/availableFilters";
import flowTypeEnum from "../../enums/flowTypeEnum";


export default {
    name: "MyAppeals",
    components: {AppealsSideFilter},
    created() {
        this.chooseStore()
        this.getFromUrl()
        this.availableFilters = _availableFilters.find(item => item.roles.includes(this.currentRole) && (item.pages.includes(this.filterByStatus) || item.pages.includes(this.$options.name)))?.filters
    },
    props: {
        filterByStatus: String
    },
    computed: {
        // appealsList() {
        //     if(this.getterStore) {
        //         return this.$store.getters[this.getterStore.retrieveMyAppealList]
        //     } else {
        //         return []
        //     }
        // },
        currentRole() {
            return this.$store.getters.userRoleList[0]
        },
        _clientAppealStatusEnum() {
            return clientAppealStatusEnum
        },
        filterFlowType(){
            if(['qolday.in_work', 'qolday.completed'].includes(this.filterByStatus)){
                return flowTypeEnum.Qoldau
            }
            if(['upi.in_work', 'upi.completed'].includes(this.filterByStatus)){
                return flowTypeEnum.Upi
            }
            return null
        }
    },
    data() {
        return {
            limit:12,
            number: 0,
            searchValueClone: 'a',
            // rules: {
            //     counter: this.counter.counter >= 12 || 'ИИН/БИН не должен быть больше 12 цифр!',
            // },
            vue: this,
            editItem: null,
            excelExportInProcess: false,
            actionStore: null,
            loading: false,
            appealsList: [],
            options: {},
            totalAppealsCount: 0,
            availableFilters: null,
            clientAppealStatusPropEnum: {
                in_work: clientAppealStatusEnum.InWork,
                completed: clientAppealStatusEnum.Completed
            },
            filterData: {
                district_id: null,
                appeal_status_id: null,
                client_appeal_status_id: null,
                appeal_result_type_id: null,
                category_id: null,
                source_type_id: null,
                start_date: null,
                end_date: null,
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
                //     text: this.$vuetify.lang.t('$vuetify.page.appeal.appealsApplication'),
                //     align: 'start',
                //     sortable: true,
                //     value: 'client_appeal_status',
                // },
                // {
                //     text: this.$vuetify.lang.t('$vuetify.page.appeal.appealNumber'),
                //     align: 'start',
                //     sortable: true,
                //     value: 'appeal_no',
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
                    // style: "white-space: nowrap;"
                },
                // {
                //     text: this.$vuetify.lang.t('$vuetify.page.appeal.content'),
                //     align: 'start',
                //     sortable: true,
                //     value: 'content',
                // },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.status'),
                    align: 'start',
                    sortable: false,
                    value: 'client_appeal_status',
                },
                // {
                //     text: this.$vuetify.lang.t('$vuetify.page.appeal.distributor'),
                //     align: 'start',
                //     sortable: true,
                //     value: 'distributor',
                // },
                // {
                //     text: this.$vuetify.lang.t('$vuetify.page.appeal.executor'),
                //     align: 'start',
                //     sortable: true,
                //     value: 'executor',
                // },
                // {
                //     text: this.$vuetify.lang.t('$vuetify.page.appeal.coExecutor'),
                //     align: 'start',
                //     sortable: true,
                //     value: 'co_executor',
                // },
                // {
                //     text: this.$vuetify.lang.t('$vuetify.page.appeal.upiDistrictCurator'),
                //     align: 'start',
                //     sortable: true,
                //     value: 'UpiDistrictCurator',
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
                {text: this.$vuetify.lang.t('$vuetify.page.action.titleAction'), value: 'actions', sortable: false},
            ],
            searchValue: ""
        }
    },
    watch: {
        searchValue(){
                if (this.searchValue == "" && this.searchValueClone != 'a') {
                    this.getList()
                    this.searchValueClone = "a"
                }
            },
        options: {
            handler() {
                if (this.actionStore) {
                    this.getList()
                }
            },
            deep: true,
        },
        filterByStatus: {
            handler() {
                if (this.actionStore) {
                    this.getList()
                    this.availableFilters = _availableFilters.find(item => item.roles.includes(this.currentRole) && (item.pages.includes(this.filterByStatus) || item.pages.includes(this.$options.name)))?.filters
                }
            },
        }
    },
    methods: {
        chooseStore() {
            switch (this.currentRole) {
                case roleEnum.Head: {
                    this.actionStore = headAppealsActionType
                    this.getterStore = headAppealsGetterType
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
        },
        showCard(item) {
            this.$router.push({name: 'AppealCard', params: {id: item.id}})
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
        shortContent(content) {
            return content.substring(0, 100)
        },
        getIIN(item) {
            return item.business != null && item.business.organization != null ? item.business.organization.iin : ''
        },
        getContent(item) {
            return item.content === "" ? "" : this.shortContent(item.content)
        },
        getClientStatus(item) {
            return item.client_appeal_status?.name ? item.client_appeal_status?.name : 'На распределении'
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
            this.$store.dispatch(this.actionStore.retrieveMyAppealList, Object.assign({}, this.filterData, {client_appeal_status_id: this.clientAppealStatusPropEnum[this.filterByStatus]})).then((response) => {
                this.appealsList = response.data
                this.totalAppealsCount = response.meta?.total
                this.loading = false
            })
        },
        filterApply(data) {
            this.filterData = data
            this.getList()
        },
        getStatus(item) {
            if (item.appeal_status?.id === '0d0f4d3e-d36f-4d20-ba04-31df7cba9fdc') {
                return `(${item.appeal_status?.name})`
            }
            return ''
            // return item.appeal_status?.name ? item.appeal_status?.name : 'На распределении'
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
            this.$store.dispatch(this.actionStore.retrieveMyAppealList, Object.assign({}, this.filterData, {client_appeal_status_id: this.clientAppealStatusPropEnum[this.filterByStatus]})).then((responce) => {
                console.log('responce', responce)
                this.appealsList = responce.data
                this.loading = false
            })
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
            let filter = Object.assign({}, this.filterData, {appeal_status: this.filterByStatus})
            filter.per_page = null
            filter.page = null
            this.$store.dispatch(this.actionStore.excelExportMyAppeals, filter).then((response) => {
                let link = document.createElement("a");
                let blob = new Blob([response], {type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});
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
    }
}
</script>

<style scoped>
.v-data-table > .v-data-table__wrapper > table > thead > tr > td {
    white-space: nowrap;
}
</style>
