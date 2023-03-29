<template>
    <v-container
        fluid
        tag="section"
    >
        <v-data-table
            :headers="headers"
            :items="userList"
            sort-by="name"
            class="elevation-1"
            :calculate-widths="true"
            :options.sync="options"
            :server-items-length="totalsList"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-spacer></v-spacer>
                    <v-btn
                        v-if="checkRole()"
                        class="mr-3"
                        :loading="excelExportInProcess"
                        :disabled="excelExportInProcess"
                        @click="excelExport3">
                        <v-icon
                            right
                            dark
                            class="pr-3"
                        >
                            mdi-microsoft-excel
                        </v-icon>
                        {{ $vuetify.lang.t('$vuetify.page.action.btnDownload3') }}
                    </v-btn>
                    <v-btn
                        v-if="checkRole()"
                        class="mr-3"
                        :loading="excelExportInProcess"
                        :disabled="excelExportInProcess"
                        @click="excelExport2">
                        <v-icon
                            right
                            dark
                            class="pr-3"
                        >
                            mdi-microsoft-excel
                        </v-icon>
                        {{ $vuetify.lang.t('$vuetify.page.action.btnDownload') }}
                    </v-btn>
                    <v-dialog
                        v-model="dialog"
                        max-width="800px"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                color="primary"
                                dark
                                class="mb-2"
                                v-bind="attrs"
                                v-on="on"
                            >
                                {{$vuetify.lang.t('$vuetify.page.action.btnAdd')}}
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="headline">{{ formTitle }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-form
                                    ref="form"
                                    v-model="valid"
                                    lazy-validation
                                >
                                    <v-container>
                                        <v-row>
                                            <v-col
                                                cols="12"
                                                md="6"
                                            >
                                                <v-text-field
                                                    v-model="editedItem.lastName"
                                                    outlined
                                                    dense
                                                    :label="$vuetify.lang.t('$vuetify.page.UserList.lastName')"
                                                    :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 50)]"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="editedItem.firstName"
                                                    outlined
                                                    dense
                                                    :label="$vuetify.lang.t('$vuetify.page.UserList.firstName')"
                                                    :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 50)]"
                                                ></v-text-field>
                                                <v-text-field
                                                    v-model="editedItem.secondName"
                                                    outlined
                                                    dense
                                                    :label="$vuetify.lang.t('$vuetify.page.UserList.secondName')"
                                                    :rules="[]"
                                                ></v-text-field>
                                                <v-autocomplete
                                                    v-model="editedItem.roleId"
                                                    outlined
                                                    :items="roleList"
                                                    item-text="name"
                                                    item-value="id"
                                                    dense
                                                    :label="$vuetify.lang.t('$vuetify.page.UserList.role')"
                                                ></v-autocomplete>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                md="6"
                                            >

                                                <v-text-field
                                                    v-model="editedItem.email"
                                                    outlined
                                                    dense
                                                    :label="$vuetify.lang.t('$vuetify.page.UserList.email')"
                                                    :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 255)]"
                                                ></v-text-field>

                                                <v-text-field
                                                    v-model="editedItem.phone"
                                                    outlined
                                                    dense
                                                    :label="$vuetify.lang.t('$vuetify.page.UserList.phone')"
                                                    :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 12)]"
                                                ></v-text-field>


                                                <v-autocomplete
                                                    v-model="editedItem.departmentId"
                                                    outlined
                                                    dense
                                                    :items="departmentSortedList"
                                                    item-text="fullName"
                                                    item-value="id"
                                                    :label="$vuetify.lang.t('$vuetify.page.UserList.department')"
                                                ></v-autocomplete>
                                                <v-text-field
                                                    v-model="editedItem.position"
                                                    outlined
                                                    dense
                                                    :label="$vuetify.lang.t('$vuetify.page.UserList.position')"
                                                    :rules="[fieldValidationRules.maxLength(vue, 1024)]"
                                                ></v-text-field>
                                            </v-col>
                                        </v-row>
                                        <v-divider></v-divider>
                                        <v-row v-if="!isEdit">
                                            <v-col
                                                cols="12"
                                                md="6"
                                            >
                                                <v-text-field
                                                    v-model="editedItem.password"
                                                    outlined
                                                    dense
                                                    type="password"
                                                    :label="$vuetify.lang.t('$vuetify.page.UserList.password')"
                                                    :rules="[fieldValidationRules.required(vue), fieldValidationRules.newPassword(vue)]"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col
                                                cols="12"
                                                md="6"
                                            >
                                                <v-text-field
                                                    v-model="editedItem.password_confirmation"
                                                    outlined
                                                    dense
                                                    type="password"
                                                    :label="$vuetify.lang.t('$vuetify.page.UserList.password_confirmation')"
                                                    :rules="[fieldValidationRules.required(vue), fieldValidationRules.newPassword(vue)]"
                                                ></v-text-field>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-form>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="close"
                                >
                                    {{$vuetify.lang.t('$vuetify.page.action.btnCancel')}}
                                </v-btn>
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="save"
                                    :loading="axiosLoading" :disabled="!valid"
                                >
                                    {{$vuetify.lang.t('$vuetify.page.action.btnSave')}}
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="570px">
                        <v-card>
                            <v-card-title class="headline">{{$vuetify.lang.t('$vuetify.page.all.deleteMsg')}}
                            </v-card-title>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="closeDelete">
                                    {{$vuetify.lang.t('$vuetify.page.action.btnCancel')}}
                                </v-btn>
                                <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                                       :loading="axiosLoading">
                                    {{$vuetify.lang.t('$vuetify.page.action.btnYes')}}
                                </v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.role="{ item }">
                {{item.roles[0].name}}
            </template>
            <template v-slot:item.department="{ item }">
                {{departmentName(item.department)}}
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    class="mr-3"
                    color="primary"
                    small
                    @click="editItem(item)"
                >
                    mdi-pen
                </v-icon>
                <v-icon
                    color="red"
                    small
                    @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
            <template v-slot:no-data>
                Нет данных
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
import {actionType as userActionType, getterType as userGetterType} from "../../store/users";
import {actionType as dictionaryActionType, getterType as dictionaryGetterType} from "../../store/dictionary/dictionary";
import roleEnum from "../../enums/roleEnum";
import {
    actionType as executorAppealsActionType,
    getterType as executorAppealsGetterType
} from "../../store/appeals/executorAppeals";
import {
    actionType as headAppealsActionType,
    getterType as headAppealsGetterType
} from "../../store/appeals/headAppeals";

export default {
    name: "UserList",
    created() {
        this.$store.dispatch(dictionaryActionType.retrieveRoleDictionaryList)
        this.$store.dispatch(dictionaryActionType.retrieveDepartmentDictionaryList)
        switch (this.currentRole) {
            case roleEnum.Administrator: {
                this.actionStore = executorAppealsActionType
                this.getterStore = executorAppealsGetterType
                break
            }
        }
    },
    computed: {
        currentRole() {
            return this.$store.getters.userRoleList[0]
        },
        userList() {
            return this.$store.getters[userGetterType.getUserList]
        },
        totalsList() {
            return this.$store.getters[userGetterType.totalUserList]
        },
        roleList() {
            return this.$store.getters[dictionaryGetterType.getRoleDictionaryList]
        },
        departmentList() {
            return this.$store.getters[dictionaryGetterType.getDepartmentDictionaryList]
        },
        departmentSortedList(){
            return this.departmentList.sort(function (a, b) {
                if (a.fullName > b.fullName) {
                    return 1;
                }
                if (a.fullName < b.fullName) {
                    return -1;
                }
                // a должно быть равным b
                return 0;
            })
        },
        formTitle() {
            return this.editedIndex === -1
                ? this.$vuetify.lang.t('$vuetify.page.action.formAddTitle', this.$vuetify.lang.t('$vuetify.page.UserList.crudName'))
                : this.$vuetify.lang.t('$vuetify.page.action.formEditTitle', this.$vuetify.lang.t('$vuetify.page.UserList.crudName'))
        },
        formError() {
            return this.$store.getters.error
        },
        translationIndex() {
            let index = this.editedItem.translations.findIndex(item => item.language === 'kk')
            if (index === -1) {
                this.editedItem.translations.push(this.defaultItem.translations[0])
            }
            index = this.editedItem.translations.findIndex(item => item.language === 'kk')
            return index === -1 ? 0 : index
        },
        editedItemTranslation() {
            if (this.editedItem.translations.length === 0) {
                this.editedItem.translations = this.defaultItem.translations
            }

            return this.editedItem.translations[this.translationIndex].content
        }
    },
    data() {
        return {
            dialog: false,
            dialogDelete: false,
            valid: !this.formError,
            vue: this,
            options: {},
            excelExportInProcess: false,
            headers: [
                {
                    text: this.$vuetify.lang.t('$vuetify.page.UserList.username'),
                    align: 'start',
                    sortable: true,
                    value: 'name',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.UserList.phone'),
                    align: 'start',
                    sortable: true,
                    value: 'phone',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.UserList.email'),
                    align: 'start',
                    sortable: true,
                    value: 'email',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.UserList.role'),
                    align: 'start',
                    sortable: true,
                    value: 'role',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.UserList.department'),
                    align: 'start',
                    sortable: true,
                    value: 'department',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.UserList.position'),
                    align: 'start',
                    sortable: true,
                    value: 'position',
                },
                {text: this.$vuetify.lang.t('$vuetify.page.action.titleAction'), value: 'actions', sortable: false},
            ],
            isEdit: false,
            editedIndex: -1,
            editedItem: {
                id: null,
                lastName: null,
                firstName: null,
                secondName: null,
                roleId: null,
                email: null,
                phone: null,
                departmentId: null,
                position: null,
                password: null,
                password_confirmation: null,
            },
            defaultItem: {
                id: null,
                lastName: null,
                firstName: null,
                secondName: null,
                roleId: null,
                email: null,
                phone: null,
                departmentId: null,
                position: null,
                password: null,
                password_confirmation: null,
            },
        }
    },
    methods: {
        checkRole() {
            if (this.currentRole === roleEnum.Administrator) {
                return true
            } else {
                return false
            }
        },
        getList() {
            this.$store.dispatch(userActionType.retrieveUserList, {
                per_page: this.options.itemsPerPage,
                page: this.options.page
            })
        },
        excelExport2() {
            this.excelExportInProcess = true
            let filter = Object.assign({}, this.filterData);
            filter.per_page = null
            filter.page = null
            this.$store.dispatch(this.actionStore.excelExport2, filter).then((response) => {
                let link = document.createElement("a");
                let blob = new Blob([response], {type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});
                link.href = window.URL.createObjectURL(blob)
                link.download = 'Обращения';
                link.click();
                this.excelExportInProcess = false;
            })
        },
        excelExport3() {
            this.excelExportInProcess = true
            let filter = Object.assign({}, this.filterData);
            filter.per_page = null
            filter.page = null
            this.$store.dispatch(this.actionStore.excelExport3, filter).then((response) => {
                let link = document.createElement("a");
                let blob = new Blob([response], {type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'});
                link.href = window.URL.createObjectURL(blob)
                link.download = 'Обращения';
                link.click();
                this.excelExportInProcess = false;
            })
        },
        editItem(item) {
            this.isEdit = true
            this.editedIndex = this.userList.indexOf(item)

            this.editedItem = Object.assign({}, item)
            this.editedItem.roleId = item.roles[0].id
            this.editedItem.departmentId = item.department?.id
            this.dialog = true
        },
        deleteItem(item) {
            this.isEdit = false
            this.editedIndex = this.userList.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            let entity = this.userList[this.editedIndex]

            this.$store.dispatch(userActionType.deleteUser, {id: entity.id}).then(() => {
                this.closeDelete()
                this.getList()
            })
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
                this.$refs.form.reset()
            })
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },
        save() {
            if (this.$refs.form.validate()) {
                this.$store.dispatch(userActionType.storeUser, this.editedItem).then(() => this.close())
            }
        },
        departmentName(department) {
            return department !== null ? department.name : "-"
        }
    },
    watch: {
        options: {
            handler() {
                this.getList()
            },
            deep: true,
        },
        dialog(val) {
            val || this.close()
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },
}
</script>

<style scoped>

</style>
