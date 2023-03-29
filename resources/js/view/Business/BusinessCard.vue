<template>
    <div class="ma-3">
        <v-card v-if="business">
            <v-card-actions>
                <v-btn
                    text
                    @click="back"
                >
                    <v-icon class="mr-2">mdi-arrow-left</v-icon>
                    Вернуться назад
                </v-btn>
            </v-card-actions>
            <v-card-text>
                <v-tabs
                    v-model="tab"
                >
                    <v-tab>{{ $vuetify.lang.t('$vuetify.page.appeal.card.tabs.general') }}</v-tab>
                    <v-tab>{{ $vuetify.lang.t('$vuetify.page.appeal.card.tabs.photo') }}</v-tab>
                    <v-tab>{{ $vuetify.lang.t('$vuetify.page.appeal.card.tabs.appeals') }}</v-tab>
                </v-tabs>
                <v-tabs-items v-model="tab">
                    <v-tab-item>
                        <v-card
                            flat
                        >
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" md="6">
                                        <label-with-data :label="$vuetify.lang.t('$vuetify.page.business.signboard')">
                                            {{ business.displayName }}
                                        </label-with-data>

                                        <label-with-data :label="$vuetify.lang.t('$vuetify.page.appeal.company')">
                                            {{ business.name }}
                                        </label-with-data>
                                        <label-with-data :label="$vuetify.lang.t('$vuetify.page.appeal.bin')">
                                            <template v-if="business.organization">
                                                {{ business.organization.iin }}
                                            </template>
                                            <template v-else>
                                                Нет
                                            </template>
                                        </label-with-data>
                                        <label-with-data :label="$vuetify.lang.t('$vuetify.page.business.working_type')">
                                            <template v-if="business.working_type">
                                                {{ business.working_type.name }}
                                            </template>
                                            <template v-else>
                                                Не выбран
                                            </template>
                                        </label-with-data>
                                        <label-with-data :label="$vuetify.lang.t('$vuetify.page.business.AddressLine')">
                                            {{ business.address_line }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.AddressStringFromStat')">
                                            <span v-if="business.district">{{ business.district.name }}</span>
                                            <span v-else>-</span>
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.appeal.industry')"
                                        >
                                            <template v-if="businessActivityType">
                                                {{ businessActivityType.name }}
                                            </template>
                                            <template v-else>
                                                Не выбран
                                            </template>
                                        </label-with-data>
                                        <label-with-data :label="$vuetify.lang.t('$vuetify.page.appeal.contacts')">
                                            <div v-for="contact in businessContacts" :key="contact.id">+{{
                                                    contact.phone_number
                                                }}
                                            </div>
                                        </label-with-data>
                                        <label-with-data :label="$vuetify.lang.t('$vuetify.page.appeal.distributor')">
                                            {{ profileFio(business.distributor) }}
                                        </label-with-data>
                                    </v-col>
                                    <v-col cols="12" md="6">
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.numberOfEmployees')">
                                            {{ business.employee_count }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.AvailabilityOfKKM')">
                                            {{ getAnswerFromValue(business.has_cash_register) }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.NumberOfCashDesks')">
                                            {{ business.cash_register_count }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.POSTerminalAvailability')">
                                            {{ getAnswerFromValue(business.has_payment_terminal) }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.NeedToContact')">
                                            {{ getAnswerFromValue(business.need_to_contact) }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.RefusalToProvideIINBIN')">
                                            {{ getAnswerFromValue(business.refused_to_provide_identification_number) }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.IINNotFoundInBNS')">
                                            {{ getAnswerFromValue(business.identification_number_not_found_in_stat) }}
                                        </label-with-data>
                                        <label-with-data
                                            :label="$vuetify.lang.t('$vuetify.page.business.lastCallDate')">
                                            {{
                                                business.last_call_date ||
                                                $vuetify.lang.t('$vuetify.page.business.valueEmpty')
                                            }}
                                        </label-with-data>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item
                    >
                        <v-card
                            flat
                            class="mt-4"
                        >
                            <pseudo-photo-carousel
                                v-if="businessPhotos"
                                :value="businessPhotos">
                            </pseudo-photo-carousel>
                        </v-card>
                    </v-tab-item>
                    <v-tab-item
                    >
                        <v-card
                            flat
                        >
                            <v-data-table
                                :headers="headersAppeals"
                                :items="business.appeals_list"
                                :options.sync="optionsAppeals"
                                sort-by="name"
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
                                    <div v-else></div>
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
                                        @click="showAppealCard(item)"
                                        outlined
                                        color="primary"
                                    >
                                        Подробнее
                                    </v-btn>
                                </template>
                            </v-data-table>
                        </v-card>
                    </v-tab-item>
                </v-tabs-items>
            </v-card-text>
            <v-card-actions
                v-if="isDistributor"
            >
                <v-row>
                    <v-col cols="12" class="mb-3 ml-3">
                        <v-btn
                            v-if="!hasAccount"
                            small
                            color="primary"
                            @click="dialog.create_account = true"
                        >
                            Создать аккаунт
                        </v-btn>
                        <v-btn
                            v-if="hasAccount"
                            small
                            color="primary"
                            @click="createNewAppeal"
                        >
                            Создать обращение
                        </v-btn>
                        <v-btn
                            small
                            color="primary"
                            @click="noHaveAppeals"
                        >
                            Нет обращений
                        </v-btn>
                        <v-btn
                            v-if="canSentToCorrection"
                            small
                            color="primary"
                            @click="sentToCorrection"
                        >
                            На корректировку
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card-actions>
            <v-card-actions
                v-if="canReAssignDistributor || canSentToCorrection"
            >
                <v-row>
                    <v-col cols="12" class="mb-3 ml-3">
                        <v-btn
                            v-if="canReAssignDistributor"
                            @click="dialog.reassign_distributor = true"
                            small
                            class="mr-2"
                        >
                            Переназначить консультанта
                        </v-btn>
                        <v-btn
                            v-if="canSentToCorrection"
                            small
                            color="primary"
                            @click="sentToCorrection"
                        >
                            На корректировку
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card-actions>
        </v-card>
        <template v-if="business">
            <v-dialog
                v-model="dialog.create_account"
                @click:outside="closeDialog"
                width="500"
            >
                <v-card>
                    <v-card-title>
                        <span>Создать аккаунт</span>
                        <v-spacer></v-spacer>
                        <v-btn
                            icon
                            @click="closeDialog"
                        >
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="accountActionform">
                            <v-text-field
                                v-model="actionData.phone"
                                outlined
                                dense
                                :label="$vuetify.lang.t('$vuetify.page.UserList.phone')"
                                :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 12), fieldValidationRules.phone(vue)]"
                                placeholder="+70000000000"
                                :error="isFieldFailed('phone')"
                                :error-messages="getFieldFails('phone')"
                            ></v-text-field>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            x-large
                            color="primary"
                            @click="createAccount"
                        >
                            Создать аккаунт
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog
                v-if="canReAssignDistributor"
                v-model="dialog.reassign_distributor"
                width="500"
            >
                <v-card>
                    <v-card-title>
                        <span>Переназначить консультанта</span>
                        <v-spacer></v-spacer>
                        <v-btn
                            icon
                            @click="dialog.reassign_distributor = false"
                        >
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-card-title>
                    <v-card-text class="mt-3">
                        <v-form ref="reassignDistributorForm">
                            <v-autocomplete
                                v-model="actionData.distributor"
                                :items="distributorList"
                                item-text="fio"
                                item-value="id"
                                dense
                                label="Консультант"
                                return-object
                                :rules="[fieldValidationRules.required(vue)]"
                            ></v-autocomplete>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            x-large
                            color="primary"
                            @click="reAssignDistributor"
                        >
                            <v-icon class="mr-4">mdi-plus-circle</v-icon>
                            Переназначить
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </template>
    </div>
</template>

<script>


import LabelWithData from "../../components/LabelWithData";
import {actionType as businessActionType, getterType as businessGetterType} from "../../store/business";
import PseudoPhotoCarousel from "../../components/PseudoPhotoCarousel";
import roleEnum from "../../enums/roleEnum";
import {
    actionType as dictionaryActionType,
    getterType as dictionaryGetterType
} from "../../store/dictionary/dictionary";
import clientAppealStatusEnum from "../../enums/clientAppealStatusEnum";

export default {
    name: "BusinessCard",
    components: {PseudoPhotoCarousel, LabelWithData},
    props: {
        id: String
    },
    created() {
        this.loadCard();
        if (this.currentRole === roleEnum.Head) {
            this.$store.dispatch(dictionaryActionType.retrieveDistributorDictionaryList);
        }
    },
    data() {
        return {
            vue: this,
            tab: null,
            business: null,
            dialog: {
                create_account: null,
                reassign_distributor: null,
            },
            actionData: {
                phone: null,
                reassign_distributor: null,
            },
            fails: {
                id: null,
                phone: null,
            },
            businessActivityType: null,
            optionsAppeals: {},
            headersAppeals: [
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.appealsApplication'),
                    align: 'start',
                    sortable: true,
                    value: 'client_appeal_status',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.appealNumber'),
                    align: 'start',
                    sortable: true,
                    value: 'appeal_no',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.client'),
                    align: 'start',
                    sortable: true,
                    value: 'client',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.content'),
                    align: 'start',
                    sortable: true,
                    value: 'content',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.status'),
                    align: 'start',
                    sortable: true,
                    value: 'appeal_status',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.category'),
                    align: 'start',
                    sortable: true,
                    value: 'category.name',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.distributor'),
                    align: 'start',
                    sortable: true,
                    value: 'distributor',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.executor'),
                    align: 'start',
                    sortable: true,
                    value: 'executor',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.coExecutor'),
                    align: 'start',
                    sortable: true,
                    value: 'co_executor',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.upiDistrictCurator'),
                    align: 'start',
                    sortable: true,
                    value: 'UpiDistrictCurator',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.source'),
                    align: 'start',
                    sortable: true,
                    value: 'source',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.appeal.createDate'),
                    align: 'start',
                    sortable: true,
                    value: 'create_date',
                },
                {text: this.$vuetify.lang.t('$vuetify.page.action.titleAction'), value: 'actions', sortable: false},
            ]
        }
    },
    computed: {
        _clientAppealStatusEnum() {
            return clientAppealStatusEnum
        },
        businessPhotos() {
            return this.$store.getters[businessGetterType.getBusinessPhotos]
        },
        businessContacts() {
            return this.$store.getters[businessGetterType.getBusinessContacts]
        },
        currentRole() {
            return this.$store.getters.userRoleList[0]
        },
        currentUser() {
            return this.$store.getters.user
        },
        isDistributor() {
            return [roleEnum.Distributor].includes(this.currentRole)
                && this.business?.distributor_id === this.currentUser.id;
        },
        canSentToCorrection() {
            return [roleEnum.Distributor].includes(this.currentRole)
                && this.business?.status !== 'UPDATE_REQUIRED';
        },
        isDistributorRole() {
            return [roleEnum.Distributor].includes(this.currentRole)
        },
        hasAccount() {
            return this.business?.organization?.profile?.user?.id;
        },
        canReAssignDistributor() {
            return [roleEnum.Head].includes(this.currentRole);
        },
        distributorList() {
            return this.$store.getters[dictionaryGetterType.getDistributorDictionaryList]
        },
    },
    methods: {
        loadCard() {
            return new Promise((resolve, reject) => {
                const action = this.isDistributorRole
                    ? businessActionType.distributorBusiness
                    : businessActionType.business;

                this.$store.dispatch(action, {id: this.id}).then((data) => {
                    this.business = data
                    if (this.business) {
                        this.$store.dispatch(businessActionType.businessContacts, {business_id: this.business.id})
                        this.$store.dispatch(businessActionType.businessPhotos, {business_id: this.business.id})
                        this.$store.dispatch(businessActionType.businessActivityType, {business_id: this.business.id}).then((response) => {
                            this.businessActivityType = response[0]
                        })
                    }
                    resolve()
                })
            })
        },
        getAnswerFromValue(value) {
            return value ? this.$vuetify.lang.t('$vuetify.page.action.btnYes') : this.$vuetify.lang.t('$vuetify.page.action.btnNo')
        },
        back() {
            // this.$router.push({name: 'Business'})
            this.$router.go(-1)
        },
        createAccount() {
            if (this.$refs.accountActionform.validate()) {
                return new Promise((resolve, reject) => {
                    this.$store.dispatch(businessActionType.businessCreateAccount, {
                        id: this.business.id,
                        phone: this.actionData.phone
                    }).then((response) => {
                        if (response.fails) {
                            this.fails = response.fails;
                            resolve()
                        } else {
                            this.loadCard()
                            this.dialog.create_account = false
                            resolve()
                        }
                    })
                })
            }
        },
        noHaveAppeals() {
            return new Promise((resolve, reject) => {
                this.$store.dispatch(businessActionType.businessNoHaveAppeal, {
                    id: this.business.id,
                }).then(() => {
                    this.loadCard()
                    resolve()
                })
            })
        },
        sentToCorrection() {
            return new Promise((resolve, reject) => {
                this.$store.dispatch(businessActionType.businessSentToCorrection, {
                    id: this.business.id,
                }).then(() => {
                    this.loadCard()
                    resolve()
                })
            })
        },
        closeDialog() {
            this.dialog.create_account = false;
            this.dialog.reassign_distributor = false;

            this.actionData.phone = null;
            this.actionData.reassign_distributor = null;
        },
        getFieldFails(field) {
            if (this.fails[field] && this.fails[field].length) {
                return this.fails[field].slice(0, 1)[0];
            }
            return "";
        },
        resetFails() {
            this.fails = {
                files: [],
            };
        },
        isFieldFailed(field) {
            return this.getFieldFails(field).length > 0;
        },
        createNewAppeal() {
            this.$router.push({name: 'BusinessAppealCard', params: {businessId: this.business.id}})
        },
        reAssignDistributor() {
            new Promise((resolve, reject) => {
                if (this.$refs.reassignDistributorForm.validate()) {
                    this.$store.dispatch(businessActionType.reassignDistributor, {
                        id: this.id,
                        distributor_id: this.actionData.distributor.user.id,
                    }).then(() => {
                        this.loadCard()
                        this.dialog.reassign_distributor = false
                        resolve()
                    })
                }
            });
        },
        showAppealCard(item) {
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
        getContent(item) {
            return item.content === "" ? item.category.name : this.shortContent(item.content)
        },
        getSource(item) {
            return item.appeal_source_type?.name ? item.appeal_source_type.name : 'Нет'
        },
        getStatus(item) {
            return item.appeal_status?.name ? item.appeal_status?.name : 'На распределении'
        },
        getUpiDistrictCurator(item) {
            let upi = item.upi_curator ? item.upi_curator.fio : 'Нет'
            let district = item.district_curator ? item.district_curator.fio : 'Нет'
            return `${upi} / ${district}`
        },
    },
    destroyed() {
        this.$store.dispatch(businessActionType.businessContactsClear, {business_id: this.business.id})
        this.$store.dispatch(businessActionType.businessPhotosClear, {business_id: this.business.id})
    }
}
</script>

<style scoped>

</style>
