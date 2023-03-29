<template>
    <v-container
        id="service-list"
        fluid
        tag="section"
        pt-0
    >
        <v-data-table
            :headers="headers"
            :items="tagsList"
            :options.sync="options"
            sort-by="name"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-select
                        outlined
                        dense
                        :hide-details="true"
                        :label="$vuetify.lang.t('$vuetify.page.project.name')"
                        :items="projectList"
                        v-model="selectedProject"
                        item-value="id"
                        item-text="name"
                        @change="getData"
                    ></v-select>
                    <v-spacer></v-spacer>


                    <v-btn
                        v-if="selectedProject"
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
                        max-width="500px"
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
                                                cols="12"
                                            >
                                                <r-l-input-multi-lang
                                                    entityName="tag"
                                                    fieldName="name"
                                                    :entity="editedItem"
                                                ></r-l-input-multi-lang>
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
import {getterType as tagsGetterType, actionType as tagsActionType} from "../../store/dictionary/tags";
import {getterType as dictionaryGetterType, actionType as dictionaryActionType} from "../../store/dictionary/dictionary";
import RLInputMultiLang from "../../components/translation/RLInputMultiLang";

export default {
    name: "tags",
    components: {RLInputMultiLang},
    created() {
        this.$store.dispatch(dictionaryActionType.retrieveProjectDictionaryList)
    },
    watch: {
        options: {
            handler() {
                this.getData()
            },
            deep: true,
        },
    },
    computed: {
        ...mapState(['barColor', 'barImage']),
        tagsList() {
            return this.$store.getters[tagsGetterType.getList]
        },
        projectList() {
            return this.$store.getters[dictionaryGetterType.getProjectDictionaryList]
        },
        formTitle() {
            return this.editedIndex === -1
                ? this.$vuetify.lang.t('$vuetify.page.action.formAddTitle', this.$vuetify.lang.t('$vuetify.page.tag.crudName'))
                : this.$vuetify.lang.t('$vuetify.page.action.formEditTitle', this.$vuetify.lang.t('$vuetify.page.tag.crudName'))
        },
        formError() {
            return this.$store.getters.error
        }
    },
    data() {
        return {
            options: {},
            selectedProject: null,
            dialogDelete: false,
            dialog: false,
            valid: !this.formError,
            vue: this,
            key: 0,
            headers: [
                {
                    text: this.$vuetify.lang.t('$vuetify.page.tag.name'),
                    align: 'start',
                    sortable: true,
                    value: 'name',
                },
                {text: this.$vuetify.lang.t('$vuetify.page.action.titleAction'), value: 'actions', sortable: false},
            ],
            editedIndex: -1,
            editedItem: {
                id: null,
                name: null,
            },
            defaultItem: {
                id: null,
                name: null,
            },
        }
    },
    methods: {
        getData() {
            this.$store.dispatch(tagsActionType.retrieveList, {
                project_id: this.selectedProject,
                per_page: this.options.itemsPerPage,
                page: this.options.page,
                sortBy: this.options.sortBy,
                sortDesc: this.options.sortDesc
            })
        },
        addItem(){
            this.key += 1;
            this.editedItem.isUpdate = false
            this.dialog = true

        },
        editItem(item) {
            this.editedIndex = this.tagsList.indexOf(item)
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
            this.editedIndex = this.tagsList.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },
        deleteItemConfirm() {
            let entity = this.tagsList[this.editedIndex]

            this.$store.dispatch(tagsActionType.delete, {project: this.selectedProject, id: entity.id}).then(() => this.closeDelete())
        },
        save() {
            if (this.$refs.form.validate()) {
                if (!this.editedItem.id) {
                    this.editedItem.id = this.$uuid.v4()
                    this.editedItem.isUpdate = false
                }
                this.editedItem.project = this.selectedProject
                this.$store.dispatch(tagsActionType.set, this.editedItem).then(() => this.close())
            }
        },
    }
}
</script>

<style scoped>

</style>
