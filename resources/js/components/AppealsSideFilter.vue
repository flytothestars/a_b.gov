<template>
    <div class="appeals-side-filter">
        <side-filter v-model="filterDrawer" :filterData="filterData" @cancel="cancel" @confirm="confirm">
            <v-autocomplete v-if="availableFilters.includes(filterEnum.districtId)" v-model="filterData.district_id"
                :items="districtList" item-text="name" item-value="id" dense label="Район"></v-autocomplete>
            <v-autocomplete
                v-if="availableFilters.includes(filterEnum.appealStatusId) && filterByStatus != 'in_work' && this.filterByStatus != 'completed'"
                v-model="filterData.client_appeal_status_id" :items="clientAppealStatusList" item-text="name"
                item-value="id" class="mt-5" dense clearable label="Статус"></v-autocomplete>
            <template v-if="checkRole()">
                <v-autocomplete v-if="availableFilters.includes(filterEnum.appealStatusId)"
                    v-model="filterData.appeal_status_id" :items="appealStatusList" item-text="name" item-value="id"
                    class="mt-5" dense clearable label="Статус заявки"></v-autocomplete>
            </template>
            <!--            <v-autocomplete v-if="availableFilters.includes(filterEnum.appealResultTypeId)"-->
            <!--                            v-model="filterData.appeal_result_type_id"-->
            <!--                            :items="appealResultTypes"-->
            <!--                            item-text="name"-->
            <!--                            item-value="id"-->
            <!--                            class="mt-5"-->
            <!--                            dense-->
            <!--                            label="Основание"-->
            <!--            ></v-autocomplete>-->
            <!--            <v-autocomplete v-if="availableFilters.includes(filterEnum.executorId)"-->
            <!--                            v-model="filterData.executor_id"-->
            <!--                            :items="executorList"-->
            <!--                            item-text="user.name"-->
            <!--                            item-value="user.id"-->
            <!--                            class="mt-5"-->
            <!--                            dense-->
            <!--                            label="Исполнитель"-->
            <!--            ></v-autocomplete>-->
            <!--            <v-autocomplete v-if="availableFilters.includes(filterEnum.coExecutorId)"-->
            <!--                            v-model="filterData.co_executor_id"-->
            <!--                            :items="coExecutorList"-->
            <!--                            item-text="user.name"-->
            <!--                            item-value="user.id"-->
            <!--                            class="mt-5"-->
            <!--                            dense-->
            <!--                            label="Со-исполнитель"-->
            <!--            ></v-autocomplete>-->
            <v-autocomplete v-if="availableFilters.includes(filterEnum.categoryId)" v-model="filterData.category_id"
                :items="appealCategoryList" item-text="name" item-value="id" class="mt-5" dense multiple clearable chips
                label="Категория"></v-autocomplete>
            <v-autocomplete v-if="availableFilters.includes(filterEnum.lastCuratorDistrictId)"
                v-model="filterData.last_curator_district_id" :items="districtCuratorList" item-text="user.name"
                item-value="user.id" class="mt-5" dense label="Куратор района"></v-autocomplete>
            <v-autocomplete v-if="availableFilters.includes(filterEnum.lastCuratorUpiId)"
                v-model="filterData.last_curator_upi_id" :items="upiCuratorList" item-text="user.name"
                item-value="user.id" class="mt-5" dense label="Куратор УПиИ"></v-autocomplete>
            <v-autocomplete v-if="availableFilters.includes(filterEnum.distributorId)"
                v-model="filterData.distributor_id" :items="distributorList" item-text="user.name" item-value="user.id"
                class="mt-5" dense clearable label="Консультант"></v-autocomplete>

            <v-autocomplete v-if="availableFilters.includes(filterEnum.isInUpi)" v-model="filterData.isIn_Upi"
                :items="YesNo" item-text="name" item-value="value" class="mt-5" dense label="Направлено в УПиИ">
            </v-autocomplete>

            <v-autocomplete v-if="availableFilters.includes(filterEnum.sourceTypeId)"
                v-model="filterData.source_type_id" :items="sourceTypeList" item-text="name" item-value="id"
                class="mt-5" dense clearable label="Источник"></v-autocomplete>

            <v-row>
                <v-col cols="12" md="12">
                    <v-menu v-if="availableFilters.includes(filterEnum.startDate)" ref="start_date_menu"
                        v-model="start_date_menu" :close-on-content-click="false" transition="scale-transition" offset-y
                        max-width="290px" min-width="auto">
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field v-model="computedStartDate" label="Начиная с даты создания" readonly
                                prepend-icon="mdi-calendar" v-bind="attrs" v-on="on"></v-text-field>
                        </template>
                        <v-date-picker v-model="filterData.start_date" no-title @input="start_date_menu = false"
                            :min="availableDateFrom" :max="filterStartDateMax"></v-date-picker>
                    </v-menu>
                </v-col>
                <v-col cols="12" md="12">
                    <v-menu v-if="availableFilters.includes(filterEnum.endDate)" ref="end_date_menu"
                        v-model="end_date_menu" :close-on-content-click="false" transition="scale-transition" offset-y
                        max-width="290px" min-width="auto">
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field v-model="computedEndDate" label="Заканчивая до даты создания"
                                prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"></v-text-field>
                        </template>
                        <v-date-picker v-model="filterData.end_date" no-title @input="end_date_menu = false"
                            :min="filterEndDateMin" :max="filterEndDateMax"></v-date-picker>
                    </v-menu>
                </v-col>
                <template v-if="checkRole()">
                    <v-col cols="12" md="12">
                        <v-menu v-if="availableFilters.includes(filterEnum.startDateUpdated)" ref="start_date_updated"
                            v-model="start_date_updated" :close-on-content-click="false" transition="scale-transition"
                            offset-y max-width="290px" min-width="auto">
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field v-model="startDateUpdated" label="Начиная с даты обновления" readonly
                                    prepend-icon="mdi-calendar" v-bind="attrs" v-on="on"></v-text-field>
                            </template>
                            <v-date-picker v-model="filterData.start_date_updated" no-title
                                @input="start_date_updated = false" :min="filterStartDateUpdatedMin"
                                :max="filterStartDateUpdatedMax"></v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col cols="12" md="12">
                        <v-menu v-if="availableFilters.includes(filterEnum.endDateUpdated)" ref="end_date_updated"
                            v-model="end_date_updated" :close-on-content-click="false" transition="scale-transition"
                            offset-y max-width="290px" min-width="auto">
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field v-model="endDateUpdated" label="Заканчивая до даты обновления"
                                    prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"></v-text-field>
                            </template>
                            <v-date-picker v-model="filterData.end_date_updated" no-title
                                @input="end_date_updated = false" :min="filterEndDateUpdatedMin" :max="today">
                            </v-date-picker>
                        </v-menu>
                    </v-col>
                </template>
            </v-row>


        </side-filter>
        <v-btn v-if="availableFilters.length > 0" color="primary" outlined @click="filterDrawer = true">
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
import _filterEnum from "../enums/filterEnum";

export default {
    name: "AppealsSideFilter",
    components: { SideFilter },
    props: {
        availableFilters: Array,
        flowType: String,
        filterByStatus: String
    },
    mounted() {
        this.$store.dispatch(dictionaryActionType.retrieveDistrictDictionaryList);
        this.$store.dispatch(dictionaryActionType.retrieveRoleDictionaryList);
        this.$store.dispatch(dictionaryActionType.retrieveDistributorDictionaryList);
        this.$store.dispatch(dictionaryActionType.retrieveExecutorDictionaryList);
        this.$store.dispatch(dictionaryActionType.retrieveExecutorUPIDictionaryList);
        this.$store.dispatch(dictionaryActionType.retrieveCoExecutorDictionaryList);
        this.$store.dispatch(dictionaryActionType.retrieveDistrictCuratorDictionaryList);
        this.$store.dispatch(dictionaryActionType.retrieveUpiCuratorDictionaryList);
        this.$store.dispatch(dictionaryActionType.retrieveAppealResultTypesAllList).then((response) => {
            this.appealResultTypes = response
        })
        this.$store.dispatch(dictionaryActionType.appealStatusDictionaryList);
        this.$store.dispatch(dictionaryActionType.appealCategoryDictionaryList);
        this.$store.dispatch(dictionaryActionType.appealSourceTypeDictionaryList).then((response) => {
            this.sourceTypeList = response
        })
    },
    data() {
        return {
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
                isIn_Upi: null,
                last_curator_district_id: null,
                last_curator_upi_id: null,
            },
            filterDrawer: false,
            sourceTypeList: [],
            appealResultTypes: [],
            start_date_menu: false,
            end_date_menu: false,
            start_date_updated: false,
            end_date_updated: false,
            isSavedParams: false,
            availableAppealStatusesInwork: [
                '0d0f4d3e-d36f-4d20-ba04-31df7cba9fdc'
            ],
            availableAppealStatusesCompleted: [
                '08992438-a890-4a12-8850-d536f326bd9f',
                '23dcd77e-6a53-4562-a175-9f35f7696906',
                '107ad887-047c-405d-916e-3d2e3517a17d',
            ],
            availableAppealStatusesAll: [
                '08992438-a890-4a12-8850-d536f326bd9f',
                '23dcd77e-6a53-4562-a175-9f35f7696906',
                '107ad887-047c-405d-916e-3d2e3517a17d',
                '0d0f4d3e-d36f-4d20-ba04-31df7cba9fdc'
            ],
            availableClientAppealStatusInWork: [
                '9454eb49-44c5-4c12-8316-a9650f203a8a',
            ],
            availableClientAppealStatusCompleted: [
                'f9840d9f-d405-4c17-9789-8d34b082ad06',
            ],
            availableClientAppealStatusAll: [
                '9454eb49-44c5-4c12-8316-a9650f203a8a',
                'f9840d9f-d405-4c17-9789-8d34b082ad06',
            ],
            YesNo: [
                { value: '1', name: "Да" },
                { value: '0', name: "Нет" }
            ],
            today: moment().format('YYYY-MM-DD'),
            availableDateFrom: '2018-01-01'
        }
    },
    created() {
        this.getFromUrl()
    },
    computed: {
        currentRole() {
            return this.$store.getters.userRoleList[0]
        },
        filterEnum() {
            return _filterEnum
        },
        districtList() {
            return this.$store.getters[dictionaryGetterType.getDistrictDictionaryList].sort((a, b) => {
                if (a.name < b.name)
                    return -1;
                if (a.name > b.name)
                    return 1;
                return 0;
            }).filter(item => item.id !== '7171580e-4aee-4e50-9af2-4bad7234a35a')
        },
        appealStatusList() {
            if (this.filterByStatus == 'in_work') {
                return this.$store.getters[dictionaryGetterType.getAppealStatusDictionaryList]?.filter(c => c.id === '0d0f4d3e-d36f-4d20-ba04-31df7cba9fdc')
            } else if (this.filterByStatus == 'completed') {
                return this.$store.getters[dictionaryGetterType.getAppealStatusDictionaryList]?.filter(c => this.availableAppealStatusesCompleted.includes(c.id))
            }
            else {
                if (this.filterData.client_appeal_status_id == '9454eb49-44c5-4c12-8316-a9650f203a8a') {
                    return this.$store.getters[dictionaryGetterType.getAppealStatusDictionaryList]?.filter(c => this.availableAppealStatusesInwork.includes(c.id))
                } if (this.filterData.client_appeal_status_id == 'f9840d9f-d405-4c17-9789-8d34b082ad06') {
                    return this.$store.getters[dictionaryGetterType.getAppealStatusDictionaryList]?.filter(c => this.availableAppealStatusesCompleted.includes(c.id))
                }
                return this.$store.getters[dictionaryGetterType.getAppealStatusDictionaryList]?.filter(c => this.availableAppealStatusesAll.includes(c.id))
            }
        },
        clientAppealStatusList() {
            //'08992438-a890-4a12-8850-d536f326bd9f',
            // '23dcd77e-6a53-4562-a175-9f35f7696906',
            // '107ad887-047c-405d-916e-3d2e3517a17d',
            if (this.filterData.appeal_status_id == '0d0f4d3e-d36f-4d20-ba04-31df7cba9fdc') {
                return this.$store.getters[dictionaryGetterType.getAppealStatusDictionaryList]?.filter(c => this.availableClientAppealStatusInWork.includes(c.id))
            } if (this.filterData.appeal_status_id == null) {
                return this.$store.getters[dictionaryGetterType.getAppealStatusDictionaryList]?.filter(c => this.availableClientAppealStatusAll.includes(c.id))
            }
            return this.$store.getters[dictionaryGetterType.getAppealStatusDictionaryList]?.filter(c => this.availableClientAppealStatusCompleted.includes(c.id))
        },
        appealCategoryList() {
            return this.$store.getters[dictionaryGetterType.getAppealCategoryDictionaryList]
        },
        computedStartDate() {
            return this.filterData.start_date ? moment(this.filterData.start_date).format('DD/MM/YYYY') : ''
        },
        computedEndDate() {
            return this.filterData.end_date ? moment(this.filterData.end_date).format('DD/MM/YYYY') : ''
        },
        startDateUpdated() {
            return this.filterData.start_date_updated ? moment(this.filterData.start_date_updated).format('DD/MM/YYYY') : ''
        },
        endDateUpdated() {
            return this.filterData.end_date_updated ? moment(this.filterData.end_date_updated).format('DD/MM/YYYY') : ''
        },
        filterStartDateMin() {
            return this.today
        },
        filterStartDateMax() {
            if (this.filterData.end_date) {
                return this.filterData.end_date
            } else if (this.filterData.start_date_updated) {
                return this.filterData.start_date_updated
            } else if (this.filterData.end_date_updated) {
                return this.filterData.end_date_updated
            } else {
                return this.today
            }
        },
        filterEndDateMin() {
            return this.filterData.start_date ? this.filterData.start_date : this.availableDateFrom
        },
        filterEndDateMax() {
            return this.filterData.end_date_updated ? this.filterData.end_date_updated : this.today;
        },
        filterStartDateUpdatedMin() {
            return this.filterData.start_date ? this.filterData.start_date : this.availableDateFrom
        },
        filterStartDateUpdatedMax() {
            return this.filterData.end_date_updated ? this.filterData.end_date_updated : this.today
        },
        filterEndDateUpdatedMin() {
            return this.filterData.start_date_updated ? this.filterData.start_date_updated : this.availableDateFrom
        },
        executorList() {
            switch (this.flowType) {
                case flowTypeEnum.Qoldau: {
                    return [
                        ...this.$store.getters[dictionaryGetterType.getExecutorDictionaryList]
                    ]
                }
                case flowTypeEnum.Upi: {
                    return [
                        ...this.$store.getters[dictionaryGetterType.getExecutorUPIDictionaryList]
                    ]
                }
                default:
                    return [
                        ...this.$store.getters[dictionaryGetterType.getExecutorDictionaryList],
                        ...this.$store.getters[dictionaryGetterType.getExecutorUPIDictionaryList]
                    ];
            }
        },
        distributorList() {
            return this.$store.getters[dictionaryGetterType.getDistributorDictionaryList]
        },
        districtCuratorList() {
            return this.$store.getters[dictionaryGetterType.getDistrictCuratorDictionaryList]
        },
        upiCuratorList() {
            return this.$store.getters[dictionaryGetterType.getUpiCuratorDictionaryList]
        },
        coExecutorList() {
            return this.$store.getters[dictionaryGetterType.getCoExecutorDictionaryList]
        },
    },
    methods: {
        checkRole() {
            if (this.currentRole === roleEnum.IEManager) {
                return false
            } else {
                return true
            }
        },
        cancel() {
            this.filterData = {
                district_id: null,
                appeal_status_id: null,
                client_appeal_status_id: null,
                category_id: null,
                source_type_id: null,
                start_date: null,
                end_date: null
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
