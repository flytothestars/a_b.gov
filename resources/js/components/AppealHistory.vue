<template>
  <div v-if="true">
    <v-row>
      <v-col cols="12">
        <v-btn color="primary" @click="showHistory = !showHistory">
          История обращений
          <template v-if="showHistory">
            <v-icon class="mr-3">mdi-menu-up</v-icon>
          </template>
          <template v-else>
            <v-icon class="mr-3">mdi-menu-down</v-icon>
          </template>
        </v-btn>
        <v-divider class="my-4"></v-divider>
      </v-col>
      <v-col cols="1" md="6" v-if="showHistory">
        <div>
          <table class="table">
            <thead>
              <tr>
                <th>Исполнитель</th>
                <th>Комментарие</th>
                <th>Время</th>
                <th>Статус</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in appealHistory" :key="item.id" color="primary" small>
                <td>{{ item.distributor ? item.distributor.first_name + ' ' + item.distributor.last_name : ' ' }} </td>
                <td>{{ item.comment ? item.comment : ' нет комментарии ' }}</td>
                <td>{{ item.created_at | formatDateTime2 }}</td>
                <td>{{ item.client_appeal_status.name }}</td>
              </tr>
            </tbody>

          </table>
        </div>
        <!-- <v-timeline align-top dense>
          <v-timeline-item v-for="(item, index) in appealHistory" :key="item.id" color="primary" small>
            <v-card elevation="0">
              <v-card-text>
                <label-with-data :label="getHistoryTitle(item, index)">
                  ({{ item.created_at | formatDateTime2 }}) {{ getHistorySubTitle(item) }}
                </label-with-data>
                <div v-if="item.comment">
                  <div>
                    <strong>Комментарий</strong>
                    <span class="float-right">{{ item.created_at | formatDateTime2 }}</span>
                  </div>
                  <div>
                    {{ item.comment }}
                  </div>
                </div>
                <div v-if="item.documents.length" class="mt-2">
                  <v-btn outlined @click="() => setDocuments(item)">Документы
                  </v-btn>
                </div>
              </v-card-text>
            </v-card>
          </v-timeline-item>
        </v-timeline> -->
      </v-col>
    </v-row>
    <template v-if="appealHistory">
      <v-dialog v-model="dialogShowFiles" width="500" @click:outside="unsetDocuments">
        <v-card>
          <v-card-title>
            <span>Документы</span>
            <v-spacer></v-spacer>
            <v-btn icon @click="unsetDocuments">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-card-title>
          <v-card-text>
            <v-list>

              <v-list-item v-for="file in dialogFiles" :key="file.id">
                <v-list-item-icon @click="() => openLink(file.link)">
                  <v-icon>mdi-download-box-outline</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>
                    <a :href="file.link" target="_blank"> {{ file.name }} </a>
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>

            </v-list>
          </v-card-text>
        </v-card>
      </v-dialog>
    </template>
  </div>
</template>

<script>
let appealActionType = {
  DataChanged: 'ecaf25f3-c98b-49b5-87af-5eba97d296d7',
  ExecutorAssigned: '5ac55ff5-0ccc-4c5e-8966-7b568ed83dc2',
  CoExecutorAssigned: '273e5685-ed77-476f-a7bf-b097bd7d0f08',
  DistributorAssigned: '9bdb4fbf-2c97-4b5e-8f5b-995411f269e9',
  Confirmed: '3874b48a-f95d-489d-9fba-fc2eaf115e79',
  Completed: 'a5881c96-0ca1-4376-acd3-c5e81503a725',
  Rejected: 'c470341c-8a6d-479f-a471-d55dbe1f30a9',
  Returned: 'cf238a8a-7189-4b55-9bed-388547c4b7e6',
  byQolday: '1c12f4ef-5530-4e35-b6a6-b267c3db3e4a',
  notByQolday: 'f2a7d913-8066-4a24-85b0-030bec7ac782',
  requiresClarification: '925adbc1-fc93-4b82-a85c-16916deab417',
  cantContact: '5cf7190e-4504-46a1-ab00-74980e847aee',
}
let appealStatus = {
  Pending: '1cf63f67-fe81-45fc-97f0-d335251f66f7',
  DistributorAssigned: '36d72113-ecd0-481b-954b-c5f62d0357af',
  InWork: '9454eb49-44c5-4c12-8316-a9650f203a8a',
  ExecutorAssigned: '0d0f4d3e-d36f-4d20-ba04-31df7cba9fdc',
  CoExecutorAssigned: 'c4c32c42-a651-4195-9a38-5b2c81456350',
  Confirmed: '1a2f5be3-b525-4856-aa10-1f6fe3580f73',
  Completed: 'f9840d9f-d405-4c17-9789-8d34b082ad06',
  Rejected: '21cbcd3d-b6b4-48f4-abbf-4929dde31706',
}

import LabelWithData from "./LabelWithData"
import { actionType as appealsActionType } from "../store/appeals"

export default {
  name: "AppealHistory",
  components: { LabelWithData },
  props: {
    appealId: String
  },
  created() {
    this.refreshHistory()
  },
  data() {
    return {
      showHistory: false,
      appealHistory: null,
      dialogFiles: null,
      dialogShowFiles: null,
    }
  },
  methods: {
    openLink(link) {
      window.open(link, '_blank');
    },
    setDocuments(item) {
      this.dialogFiles = item.documents.map((item) => ({
        name: item.document.description,
        link: item.document.link,
        id: item.document.id
      }));
      this.dialogShowFiles = true;
    },
    unsetDocuments() {
      this.dialogFiles = null;
      this.dialogShowFiles = null;
    },
    refreshHistory() {
      this.$store.dispatch(appealsActionType.retrieveAppealHistory, { id: this.appealId }).then((data) => {
        this.appealHistory = data
      })
    },
    getHistoryTitle(item, index) {
      if (index === 0 && item.appeal_action_type.id === appealActionType.DataChanged && item.appeal_status.id === appealStatus.Pending)
        return 'Получено:'
      else
        return `Этап ${index}:`
    },
    getHistorySubTitle(item) {
      console.log('appealActionType', item.appeal_action_type.id)
      switch (item.appeal_status.id) {
        case appealActionType.byQolday: {
          return `Консультация оказана по продукту Qolday`
        }
        case appealActionType.notByQolday: {
          return `Консультация оказана не по продукту Qolday`
        }
        case appealActionType.requiresClarification: {
          return `Требует уточнения`
        }
      }
      switch (item.appeal_action_type.id) {
        case appealActionType.DataChanged: {
          if (item.appeal_status.id === appealStatus.Pending) {
            return ''
          } else {
            return ''
          }
        }
        case appealActionType.ExecutorAssigned: {
          if (item.created_by.id === item.executor.id) {
            return `${item.created_by?.fio} взял(а) в работу`
          }
          return `${item.created_by?.fio} передал(а) на исполнение ${item.executor.fio}`
        }
        case appealActionType.CoExecutorAssigned: {
          return `${item.created_by?.fio} передал(а) на соисполнение ${item.co_executor.fio}`
        }
        case appealActionType.DistributorAssigned: {
          return `${item.distributor?.fio} взял(а) в работу`
        }
        case appealActionType.Confirmed: {
          return `${item.created_by?.fio} подтвердил(а)`
        }
        case appealActionType.Completed: {
          return `${item.created_by?.fio} исполнил(а)`
        }
        case appealActionType.Rejected: {
          return `${item.created_by?.fio} отклонил(а)`
        }
        case appealActionType.Returned: {
          return `${item.created_by?.fio} вернул(а) на доработку`
        }
        case appealActionType.byQolday: {
          return `Консультация оказана по продукту Qolday`
        }
        case appealActionType.notByQolday: {
          return `Консультация оказана не по продукту Qolday`
        }
        case appealActionType.requiresClarification: {
          return `Требует уточнения`
        }
        case appealActionType.cantContact: {
          return 'Не дозвонились'
        }
      }
    }
  }
}
</script>

<style scoped>
.table {
  table-layout: fixed;
  width: 1200px;
  margin-bottom: 20px;
}

.table th {
  font-weight: bold;
  padding: 5px;
  background: #efefef;
}

.table td {
  padding: 5px 10px;
  border: 1px solid #eee;
  text-align: left;
}

.table tbody tr:nth-child(odd) {
  background: #fff;
}

.table tbody tr:nth-child(even) {
  background: #F7F7F7;
}
</style>
