<template>
    <v-container
        id="service-list"
        fluid
        expert="section"
        pt-0
    >
        <div class="text-right justify-end d-flex  mb-8">
          <v-spacer></v-spacer>
          <business-side-filter v-if="availableFilters"
                                @confirm="filterApply"
                                @cancel="filterCancel"
                                :available-filters="availableFilters"
          >
          </business-side-filter>
        </div>
        <v-data-table
            :headers="headers"
            :options.sync="options"
            :items="businessList"
            :server-items-length="totalBusinessCount"
            :loading="loading"
            sort-by="name"
            class="elevation-1"
        >
            <template v-slot:item.name="{ item }">
              <div class="business-chip-container">
                {{item.name}}
                <v-chip
                    v-if="item.appeals_count > 0"
                    small class="mr-3 business-chip">{{item.appeals_count}}
                </v-chip>
              </div>
            </template>
            <template v-slot:item.need_to_contact="{ item }">
                {{ getAnswerFromValue(item.need_to_contact) }}
            </template>
            <template v-slot:item.source="{ item }">
                {{ $vuetify.lang.t(`$vuetify.page.business.source.${item.source}`) }}
            </template>
            <template v-slot:item.last_call_date="{ item }">
                {{ item.last_call_date || $vuetify.lang.t('$vuetify.page.business.valueEmpty') }}
            </template>
            <template v-slot:item.distributor="{ item }">
                {{ profileFio(item.distributor) }}
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

import {
    actionType as businessActionType,
    getterType as businessGetterType
} from "../../store/business";
import BusinessSideFilter from "../../components/BusinessSideFilter";
import _availableFilters from "../../enums/availableFilters";

export default {
    name: "MyBusinessList",
    components: {BusinessSideFilter},
    created() {
        this.availableFilters = _availableFilters.find(item => item.roles.includes(this.currentRole) && item.pages.includes(this.$options.name))?.filters
        this.availableFilters.distributorId = undefined;
        this.getList()
    },
    computed: {
        businessList() {
            return this.$store.getters[businessGetterType.getDistributorBusinessList]
        },
        totalBusinessCount() {
            return this.$store.getters[businessGetterType.getTotalDistributorBusinessCount]
        },
        currentRole() {
            return this.$store.getters.userRoleList[0]
        },
    },
    data() {
        return {
            vue: this,
            options: {},
            headers: [
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.company'),
                    align: 'start',
                    sortable: true,
                    value: 'name',
                },
                {
                  text: this.$vuetify.lang.t('$vuetify.page.business.status'),
                  align: 'start',
                  sortable: true,
                  value: 'statusName',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.business.distributor'),
                    align: 'start',
                    sortable: true,
                    value: 'distributor',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.business.signboard'),
                    align: 'start',
                    sortable: true,
                    value: 'display_name',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.business.AddressLine'),
                    align: 'start',
                    sortable: true,
                    value: 'address_line',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.business.Source'),
                    align: 'start',
                    sortable: true,
                    value: 'source',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.business.numberOfEmployees'),
                    align: 'start',
                    sortable: true,
                    value: 'employee_count',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.business.NeedToContact'),
                    align: 'start',
                    sortable: true,
                    value: 'need_to_contact',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.business.lastCallDate'),
                    align: 'start',
                    sortable: true,
                    value: 'last_call_date',
                },
                {text: this.$vuetify.lang.t('$vuetify.page.action.titleAction'), value: 'actions', sortable: false},
            ],
            loading: false,
            availableFilters: null,
            filterData: {
                distributor_id: null,
                start_date: null,
                end_date: null,
                district_id: null,
                city_id: null,
                page: null,
                per_page: null
            },
        }
    },
    watch: {
        options: {
            handler() {
                this.getList()
            },
            deep: true,
        },
    },
    methods: {
        profileFio(profile) {
            return profile ? `${profile.last_name} ${profile.first_name}` : 'Нет'
        },
        showCard(item) {
            this.$router.push({name: 'BusinessCard', params: {id: item.id}})
        },
        getAnswerFromValue(value) {
            return value ? this.$vuetify.lang.t('$vuetify.page.action.btnYes') : this.$vuetify.lang.t('$vuetify.page.action.btnNo')
        },
        filterApply(data) {
            this.filterData = data
            this.getList()
        },
        filterCancel() {
            this.filterData = {
                page: 1,
                per_page: 15,
            };
            this.getList();
        },
        getList() {
            this.loading = true

            this.filterData.page = this.options.page
            this.filterData.per_page = this.options.itemsPerPage

            if(this.filterData.per_page){
              this.saveInUrl()
              this.$store.dispatch(businessActionType.distributorBusinessList, this.filterData).then(() => {
                  this.loading = false
              })
            }
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
    },
}
</script>

<style scoped>

</style>
