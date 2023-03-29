<template>
    <v-container
        id="service-list"
        fluid
        expert="section"
        pt-0
    >
        <v-data-table
            :headers="headers"
            :items="expertList"
            sort-by="name"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-spacer></v-spacer>
                    <v-btn
                        color="primary"
                        dark
                        class="mb-2"
                        v-on:click="addItem"
                    >
                        {{ $vuetify.lang.t('$vuetify.page.action.btnAdd') }}
                    </v-btn>
                    <v-dialog
                        :key="key"
                        v-model="dialog"
                        max-width="800px"
                        @click:outside="close"
                    >
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
                                                cols="6"
                                            >
                                                <r-l-input-multi-lang
                                                    entityName="experts"
                                                    fieldName="first_name"
                                                    :entity="editedItem"
                                                    :rules="[fieldValidationRules.required(vue)]"
                                                ></r-l-input-multi-lang>
                                            </v-col>
                                            <v-col
                                                cols="6"
                                            >
                                                <r-l-input-multi-lang
                                                    entityName="experts"
                                                    fieldName="last_name"
                                                    :entity="editedItem"
                                                    :rules="[fieldValidationRules.required(vue)]"
                                                ></r-l-input-multi-lang>
                                            </v-col>
                                        </v-row>

                                        <v-row>
                                            <v-col
                                                cols="6"
                                            >
                                                <r-l-input-multi-lang
                                                    entityName="experts"
                                                    fieldName="position"
                                                    :entity="editedItem"
                                                    :rules="[fieldValidationRules.required(vue)]"
                                                ></r-l-input-multi-lang>
                                            </v-col>
                                            <v-col
                                                cols="6"
                                            >
                                                <v-file-input
                                                    v-model="editedItem.photo"
                                                    accept="image/*"
                                                    :label="$vuetify.lang.t('$vuetify.page.experts.photo')"
                                                    :rules="[fieldValidationRules.required(vue)]"
                                                ></v-file-input>
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
                                    {{ $vuetify.lang.t('$vuetify.page.action.btnCancel') }}
                                </v-btn>
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="save"
                                    :loading="axiosLoading" :disabled="!valid"
                                >
                                    {{ $vuetify.lang.t('$vuetify.page.action.btnSave') }}
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title class="headline">
                                {{ $vuetify.lang.t('$vuetify.page.all.deleteMsg') }}
                            </v-card-title>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="closeDelete">
                                    {{ $vuetify.lang.t('$vuetify.page.action.btnCancel') }}
                                </v-btn>
                                <v-btn color="blue darken-1" text @click="deleteItemConfirm" :loading="axiosLoading">
                                    {{ $vuetify.lang.t('$vuetify.page.action.btnYes') }}
                                </v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.photo="{ item }">
                <div class="pa-2">
                    <v-img v-if="itemImage(item)"
                           contain
                           max-height="50"
                           max-width="150"
                           :src="itemImage(item)"
                    >
                    </v-img>
                </div>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
import {
    mapState,
} from 'vuex'
import {getterType as tagsGetterType, actionType as tagsActionType} from "../../store/dictionary/experts";
import RLInputMultiLang from "../../components/translation/RLInputMultiLang";

export default {
    name: "expert",
    components: {RLInputMultiLang},
    created() {
        this.$store.dispatch(tagsActionType.retrieveList)
    },
    computed: {
        ...mapState(['barColor', 'barImage']),
        expertList() {
            return this.$store.getters[tagsGetterType.getList]
        },
        formTitle() {
            return this.editedIndex === -1
                ? this.$vuetify.lang.t('$vuetify.page.action.formAddTitle', this.$vuetify.lang.t('$vuetify.page.experts.crudName'))
                : this.$vuetify.lang.t('$vuetify.page.action.formEditTitle', this.$vuetify.lang.t('$vuetify.page.experts.crudName'))
        },
        formError() {
            return this.$store.getters.error
        }
    },
    data() {
        return {
            dialogDelete: false,
            dialog: false,
            valid: !this.formError,
            vue: this,
            key: 0,
            headers: [
                {
                    text: this.$vuetify.lang.t('$vuetify.page.experts.first_name'),
                    align: 'start',
                    sortable: true,
                    value: 'first_name',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.experts.last_name'),
                    align: 'start',
                    sortable: true,
                    value: 'last_name',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.experts.position'),
                    align: 'start',
                    sortable: true,
                    value: 'position',
                },
                {
                    text: this.$vuetify.lang.t('$vuetify.page.experts.photo'),
                    align: 'start',
                    sortable: true,
                    value: 'photo',
                },
                {text: this.$vuetify.lang.t('$vuetify.page.action.titleAction'), value: 'actions', sortable: false},
            ],
            editedIndex: -1,
            editedItem: {
                id: null,
                first_name: null,
                last_name: null,
                position: null,
                photo: null
            },
            defaultItem: {
                id: null,
                first_name: null,
                last_name: null,
                position: null,
                photo: null
            },
        }
    },
    methods: {
        addItem(){
            this.key += 1;
            this.editedItem.isUpdate = false
            this.dialog = true
        },
        editItem(item) {
            this.editedIndex = this.expertList.indexOf(item)
            this.key += 1
            this.editedItem = Object.assign({}, item)
            this.editedItem.isUpdate = true
            this.dialog = true
        },
        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },
        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },
        deleteItem(item) {
            this.editedIndex = this.expertList.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },
        deleteItemConfirm() {
            let entity = this.expertList[this.editedIndex]

            this.$store.dispatch(tagsActionType.delete, {id: entity.id}).then(() => this.closeDelete())
        },
        save() {
            if (this.$refs.form.validate()) {
                if (!this.editedItem.id) {
                    this.editedItem.id = this.$uuid.v4()
                    this.editedItem.isUpdate = false
                }
                this.$store.dispatch(tagsActionType.set, this.editedItem).then(() => this.close())
            }
        },
        itemImage(item){
            if (item.photo_path) {
                return '/storage/' + item.photo_path
            } else {
                return null
            }
        }
    }
}
</script>

<style scoped>

</style>
