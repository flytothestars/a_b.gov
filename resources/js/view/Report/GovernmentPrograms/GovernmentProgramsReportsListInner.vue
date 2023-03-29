<template>
  <div>
    <v-card>
      <v-card-actions>
        <v-col cols="3">
          <v-menu
              ref="menu"
              v-model="dateMenu"
              :close-on-content-click="false"
              transition="scale-transition"
              offset-y
              min-width="auto"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-text-field
                  v-model="selectedDate"
                  label="Дата"
                  prepend-icon="mdi-calendar"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                  :loading="loading"
                  :disabled="loading"
              ></v-text-field>
            </template>
            <v-date-picker
                v-model="selectedDate"
                no-title
                scrollable
            />
          </v-menu>
        </v-col>
      </v-card-actions>
      <v-card-text>
        <v-data-table
            v-if="reports"
            :headers="headers"
            :items="reports"
            :loading="loading"
            sort-by="name"
            class="elevation-1"
        >
          <template v-slot:item.name="{ item }">
            <v-icon>{{ getIconByType(item.type) }}</v-icon>
            <div class="pl-2 d-inline-block">{{ item.name }}</div>
          </template>
          <template v-slot:item.actions="{ item }">
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                    v-if="!item.exists && item.type !== 8"
                    small
                    class="mr-2"
                    outlined
                    color="primary"
                    @click="() =>importReport(item.type)"
                    :disabled="loadingFile"
                    v-bind="attrs"
                    v-on="on"
                >
                  <v-icon>
                    mdi-file-upload-outline
                  </v-icon>
                </v-btn>
              </template>
              <span>Импортировать</span>
            </v-tooltip>
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                    v-if="!item.exists && item.type === 8"
                    small
                    class="mr-2"
                    outlined
                    color="primary"
                    @click="() =>createReport(item.type)"
                    :disabled="loadingFile"
                    v-bind="attrs"
                    v-on="on"
                >
                  <v-icon>
                    mdi-plus
                  </v-icon>
                </v-btn>
              </template>
              <span>Создать</span>
            </v-tooltip>
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                    v-if="item.exists && item.status !== 3 && item.type !== 8"
                    small
                    class="mr-2"
                    outlined
                    color="primary"
                    @click="() => reImportReport(item.id)"
                    v-bind="attrs"
                    v-on="on"
                >
                  <v-icon>
                    mdi-reload
                  </v-icon>
                </v-btn>
              </template>
              <span>Загрузить заново</span>
            </v-tooltip>
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                    v-if="item.exists && item.status >= 3 && item.type !== 8"
                    small
                    class="mr-2"
                    outlined
                    color="primary"
                    @click="() => editReport(item.id)"
                    v-bind="attrs"
                    v-on="on"
                >
                  <v-icon>
                    mdi-pencil
                  </v-icon>
                </v-btn>
              </template>
              <span>Редактировать</span>
            </v-tooltip>
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                    v-if="item.exists && item.status >= 3 && item.type === 8 && item.childId"
                    small
                    class="mr-2"
                    outlined
                    color="primary"
                    @click="() => editChildRecord(item.id, item.childId)"
                    v-bind="attrs"
                    v-on="on"
                >
                  <v-icon>
                    mdi-pencil
                  </v-icon>
                </v-btn>
              </template>
              <span>Редактировать</span>
            </v-tooltip>
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                    v-if="item.exists && item.status >= 3"
                    small
                    class="mr-2"
                    outlined
                    color="primary"
                    @click="() => viewReport(item.id)"
                    v-bind="attrs"
                    v-on="on"
                >
                  <v-icon>
                    mdi-eye
                  </v-icon>
                </v-btn>
              </template>
              <span>Просмотреть</span>
            </v-tooltip>
          </template>
        </v-data-table>
      </v-card-text>
    </v-card>
    <template v-if="importPopup">
      <v-dialog
          v-model="importPopup"
          width="500"
      >
        <v-card>
          <v-card-title>
            <span>Выберите файл</span>
            <v-spacer></v-spacer>
            <v-btn
                icon
                @click="importPopup = false"
            >
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-card-title>
          <v-card-text class="mt-3">
            <v-form ref="importFileForm">
              <v-file-input
                  v-model="importFile"
                  label="Файл отчета"
                  small-chips
                  :accept="formAcceptFiles"
                  :error="isFieldFailed('file')"
                  :error-messages="getFieldFails('file')"
                  :disabled="loadingFile"
              ></v-file-input>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                x-large
                color="primary"
                @click="importReportAction"
                :disabled="!importFile || loadingFile"
                :loading="loadingFile"
            >
              Импортировать
            </v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </template>
    <template v-if="reImportPopup">
      <v-dialog
          v-model="reImportPopup"
          width="500"
      >
        <v-card>
          <v-card-title>
            <span>Выберите файл</span>
            <v-spacer></v-spacer>
            <v-btn
                icon
                @click="reImportPopup = false"
            >
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-card-title>
          <v-card-text class="mt-3">
            <v-form ref="importFileForm">
              <v-file-input
                  v-model="importFile"
                  label="Файл отчета"
                  small-chips
                  :accept="formAcceptFiles"
                  :error="isFieldFailed('file')"
                  :error-messages="getFieldFails('file')"
                  :disabled="loadingFile"
              ></v-file-input>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                x-large
                color="primary"
                @click="reImportReportAction"
                :disabled="!importFile || loadingFile"
                :loading="loadingFile"
            >
              Импортировать
            </v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </template>
  </div>
</template>

<script>
import {
  actionType as reportActionType
} from "../../../store/report/governmentProgramsReports";

const acceptableFiles = [
  'application/csv',
  'application/excel',
  'application/vnd.ms-excel',
  'application/vnd.msexcel',
  'text/anytext',
  'text/plain',
  'text/x-c',
  'text/comma-separated-values',
  'inode/x-empty',
  'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
];

export default {
  name: "GovernmentProgramsReportsListInner",
  data() {
    return {
      vue: this,
      loading: false,
      loadingFile: false,
      cityDisable: null,
      dateMenu: null,
      reports: null,
      selectedDate: null,
      importPopup: false,
      reImportPopup: false,
      importFile: null,
      importType: null,
      importId: null,
      fails: {
        file: null,
      }
    }
  },
  mounted() {
    this.selectedDate = (new Date().toISOString().split('T')[0]);
    this.loadReports();
  },
  computed: {
    headers() {
      return [
        {
          text: this.$vuetify.lang.t('$vuetify.page.ReportList.title'),
          align: 'start',
          sortable: true,
          value: 'name',
        },
        {
          text: this.$vuetify.lang.t('$vuetify.page.all.state'),
          align: 'start',
          sortable: true,
          value: 'statusName',
        },
        {
          text: this.$vuetify.lang.t('$vuetify.page.report.lastError'),
          align: 'start',
          sortable: true,
          value: 'lastError',
        },
        {
          text: this.$vuetify.lang.t('$vuetify.page.action.titleAction'),
          value: 'actions', sortable: false
        },
      ];
    },
    formAcceptFiles() {
      return acceptableFiles.join(', ');
    },
  },
  methods: {
    importReport(type) {
      this.importPopup = true;
      this.importType = type;
    },
    importReportAction() {
      this.loadingFile = true;
      this.$store.dispatch(reportActionType.importFile, {
        file: this.importFile,
        type: this.importType,
        date: this.selectedDate,
      }).then((response) => {
        this.reports = response;
        this.importPopup = false;
        this.importType = null;
        this.importFile = null;
        this.loadReports();
      }).catch((error) => {
        if (error.status === 422) {
          this.fails = error.data.errors;
        }
      }).finally(() => {
        this.loadingFile = false;
      });
    },
    reImportReport(id) {
      this.reImportPopup = true;
      this.importId = id;
    },
    reImportReportAction() {
      this.loadingFile = true;
      this.$store.dispatch(reportActionType.reImportFile, {
        file: this.importFile,
        id: this.importId,
      }).then((response) => {
        this.reports = response;
        this.reImportPopup = false;
        this.importId = null;
        this.importFile = null;
        this.loadReports();
      }).catch((error) => {
        if (error.status === 422) {
          this.fails = error.data.errors;
        }
      }).finally(() => {
        this.loadingFile = false;
      });
    },
    editReport(id) {
      this.$router.push({name: 'GovernmentProgramsReportRows.failed', params: {id}})
    },
    editChildRecord(parentId, childId) {
      this.$router.push({name: 'GovernmentProgramsReportEditor', params: {id: childId.toString(), parentId}});
    },
    viewReport(id) {
      this.$router.push({name: 'GovernmentProgramsReportView', params: {parentId: id}})
    },
    createReport(type) {
      this.$store.dispatch(reportActionType.createReport, {
        type,
        date: this.selectedDate,
      }).then(() => {
        this.loadReports();
      });
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
    loadReports() {
      if (this.selectedDate) {
        this.loading = true;
        this.$store.dispatch(reportActionType.retrieveReportsList, {
          date: this.selectedDate
        }).then((response) => {
          this.reports = response;
        }).finally(() => {
          this.loading = false;
        });
      }
    },
    getIconByType(type) {

      switch (parseInt(type, 10)) {
        case 1: {
          return '$vuetify.icons.ReportDKBIcon'
        }
        case 2: {
          return '$vuetify.icons.ReportDKBIcon'
        }
        case 3: {
          return '$vuetify.icons.ReportSimpleThingsIcon'
        }
        case 4: {
          return '$vuetify.icons.ReportZhibekZholyIcon'
        }
        case 5: {
          return '$vuetify.icons.ReportEnbekIcon'
        }
        case 6: {
          return '$vuetify.icons.ReportAlmatyFinanceIcon'
        }
        case 7: {
          return '$vuetify.icons.ReportAlmatyFinanceIcon'
        }
        case 8: {
          return '$vuetify.icons.ReportQoldauIcon'
        }
        default: {
          return 'mdi-newspaper';
        }
      }
    }
  },
  watch: {
    selectedDate() {
      this.loadReports();
    },
    importFile() {
      this.$refs.importFileForm.validate();
    }
  },
}
</script>

<style scoped>

</style>
