<template>
    <v-app>
        <v-main class="pt-0">
            <v-container fluid>
                <v-row>
                    <v-col
                        cols="6"
                        md="6"
                    >
                        <v-text-field
                            v-model="userProfile.lastName"
                            dense
                            class="text-start"
                            :label="$vuetify.lang.t('$vuetify.page.UserList.lastName')"
                            :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 50)]"
                        ></v-text-field>
                        <v-text-field
                            v-model="userProfile.firstName"
                            dense
                            class="mt-4 pt-2 text-start"
                            :label="$vuetify.lang.t('$vuetify.page.UserList.firstName')"
                            :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 50)]"
                        ></v-text-field>
                    </v-col>
                    <v-col
                        cols="6"
                        md="6"
                    >
                        <v-text-field
                            v-model="userProfile.secondName"
                            dense
                            :label="$vuetify.lang.t('$vuetify.page.UserList.secondName')"
                            :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 50)]"
                        ></v-text-field>
                    </v-col>
                    <v-col
                        cols="6"
                        md="6"
                    >
                        <v-text-field
                            v-model="userProfile.department.fullName"
                            dense
                            :label="$vuetify.lang.t('$vuetify.page.UserList.department')"
                            :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 50)]"
                        ></v-text-field>
<!--                        <v-autocomplete-->
<!--                        v-model="name == userProfile.roles[0].name"-->
<!--                        dense-->
<!--                        :items="roleList"-->
<!--                        item-text="name"-->
<!--                        item-value="id"-->
<!--                        :label="$vuetify.lang.t('$vuetify.page.UserList.role')"-->
<!--                        ></v-autocomplete>-->

                    </v-col>
                    <v-col
                        cols="6"
                        md="6"
                    >
                        <v-text-field
                            v-model="userProfile.phone"
                            dense
                            :label="$vuetify.lang.t('$vuetify.page.UserList.phone')"
                            :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 50)]"
                        ></v-text-field>
                    </v-col>
                    <v-col
                        cols="6"
                        md="6"
                    >
                        <v-text-field
                            v-model="userProfile.position"
                            dense
                            :label="$vuetify.lang.t('$vuetify.page.UserList.position')"
                            :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 50)]"
                        ></v-text-field>
                    </v-col>
                    <v-col
                        cols="6"
                        md="6"
                    >
                        <v-text-field
                            v-model="userProfile.email"
                            dense
                            :label="$vuetify.lang.t('$vuetify.page.UserList.email')"
                            :rules="[fieldValidationRules.required(vue), fieldValidationRules.maxLength(vue, 50)]"
                        ></v-text-field>
                    </v-col>
<!--                    <v-col-->
<!--                        cols="6"-->
<!--                        md="6"-->
<!--                    >-->
<!--                        <v-text-field-->
<!--                            v-model="userProfile.roles[0].name"-->
<!--                            dense-->
<!--                            :label="$vuetify.lang.t('$vuetify.page.UserList.role')"-->
<!--                        ></v-text-field>-->
<!--                    </v-col>-->
                </v-row>
            </v-container>
        </v-main>
<!--        <v-card-->
<!--            max-width="100%"-->
<!--            class="mx-auto"-->
<!--        >-->
<!--            <v-list two-line>-->
<!--                <v-list-item>-->
<!--                    <v-list-item-icon>-->
<!--                        <v-icon color="indigo">-->
<!--                            mdi-phone-->
<!--                        </v-icon>-->
<!--                    </v-list-item-icon>-->

<!--                    <v-list-item-content>-->
<!--                        <v-list-item-subtitle>Номер телефона:</v-list-item-subtitle>-->
<!--                        <v-list-item-title>{{ userProfile.phone }}</v-list-item-title>-->
<!--                    </v-list-item-content>-->

<!--                    <v-list-item-icon>-->
<!--                        <v-icon>mdi-message-text</v-icon>-->
<!--                    </v-list-item-icon>-->
<!--                </v-list-item>-->

<!--                <v-list-item>-->
<!--                    <v-list-item-action></v-list-item-action>-->

<!--                    <v-list-item-content>-->
<!--                        <v-list-item-title>(323) 555-6789</v-list-item-title>-->
<!--                        <v-list-item-subtitle>Work</v-list-item-subtitle>-->
<!--                    </v-list-item-content>-->

<!--                    <v-list-item-icon>-->
<!--                        <v-icon>mdi-message-text</v-icon>-->
<!--                    </v-list-item-icon>-->
<!--                </v-list-item>-->

<!--                <v-divider inset></v-divider>-->

<!--                <v-list-item>-->
<!--                    <v-list-item-icon>-->
<!--                        <v-icon color="indigo">-->
<!--                            mdi-email-->
<!--                        </v-icon>-->
<!--                    </v-list-item-icon>-->

<!--                    <v-list-item-content>-->
<!--                        <v-list-item-title>aliconnors@example.com</v-list-item-title>-->
<!--                        <v-list-item-subtitle>Personal</v-list-item-subtitle>-->
<!--                    </v-list-item-content>-->
<!--                </v-list-item>-->

<!--                <v-list-item>-->
<!--                    <v-list-item-action></v-list-item-action>-->

<!--                    <v-list-item-content>-->
<!--                        <v-list-item-title>ali_connors@example.com</v-list-item-title>-->
<!--                        <v-list-item-subtitle>Work</v-list-item-subtitle>-->
<!--                    </v-list-item-content>-->
<!--                </v-list-item>-->

<!--                <v-divider inset></v-divider>-->

<!--                <v-list-item>-->
<!--                    <v-list-item-icon>-->
<!--                        <v-icon color="indigo">-->
<!--                            mdi-map-marker-->
<!--                        </v-icon>-->
<!--                    </v-list-item-icon>-->

<!--                    <v-list-item-content>-->
<!--                        <v-list-item-title>1400 Main Street</v-list-item-title>-->
<!--                        <v-list-item-subtitle>Orlando, FL 79938</v-list-item-subtitle>-->
<!--                    </v-list-item-content>-->
<!--                </v-list-item>-->
<!--            </v-list>-->
<!--        </v-card>-->
    </v-app>

</template>

<script>
import {
    actionType as dictionaryActionType,
    getterType as dictionaryGetterType
} from "../../store/dictionary/dictionary";
import {actionType as userActionType, getterType as userGetterType} from "../../store/users";

export default {
    name: "ProfileAdmin",
    created() {
        this.$store.dispatch(dictionaryActionType.retrieveRoleDictionaryList)
        this.$store.dispatch(dictionaryActionType.retrieveDepartmentDictionaryList)
    },
    computed: {
        userProfile(){
            return this.$store.getters.user
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
        getList() {
            this.$store.dispatch(userActionType.retrieveUserList, {
                per_page: this.options.itemsPerPage,
                page: this.options.page
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
