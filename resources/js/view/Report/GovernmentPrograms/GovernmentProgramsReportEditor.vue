<template>
  <v-container
      id="city-report-ratios"
      fluid
      expert="section"
      pt-0
  >
    <v-card>
      <v-card-actions>
        <v-btn
            text
            @click="back"
        >
          <v-icon class="mr-2">mdi-arrow-left</v-icon>
          Вернуться назад
        </v-btn>
        <v-btn
            class="ml-3"
            color="primary"
            @click="updateFields"
        >
          Сохранить
        </v-btn>
      </v-card-actions>
      <v-card-text>
        <v-row>
          <v-col
              v-for="item of fields"
              v-if="item.visible"
              :key="item.name"
              cols="6" sm="12" md="6" lg="6"
          >
            <div
                v-if="item.type === 'info'"
            >
              <span class="font-bold"> {{ item.title }}: </span>
              <span> {{ data[item.field] }} </span>
            </div>
            <v-text-field
                v-if="item.type === 'text'"
                v-model="data[item.field]"
                :label="item.title"
                :error="isFieldFailed(item.field)"
                :error-messages="getFieldFails(item.field)"
            ></v-text-field>
            <v-text-field
                v-if="item.type === 'int'"
                :label="item.title"
                v-model="data[item.field]"
                type="number"
                step="1"
                :error="isFieldFailed(item.field)"
                :error-messages="getFieldFails(item.field)"
            ></v-text-field>
            <v-text-field
                v-if="item.type === 'float'"
                :label="item.title"
                v-model="data[item.field]"
                type="number"
                step="0.01"
                :error="isFieldFailed(item.field)"
                :error-messages="getFieldFails(item.field)"
            ></v-text-field>
            <v-checkbox
                v-if="item.type === 'bool'"
                :label="item.title"
                v-model="data[item.field]"
            ></v-checkbox>
            <v-menu
                v-if="item.type === 'date'"
                ref="menu"
                v-model="dateMenu[item.field]"
                :close-on-content-click="false"
                transition="scale-transition"
                offset-y
                min-width="auto"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                    :label="item.title"
                    v-model="data[item.field]"
                    prepend-icon="mdi-calendar"
                    readonly
                    v-bind="attrs"
                    v-on="on"
                    :error="isFieldFailed(item.field)"
                    :error-messages="getFieldFails(item.field)"
                ></v-text-field>
              </template>
              <v-date-picker
                  v-model="data[item.field]"
                  no-title
                  scrollable
              />
            </v-menu>
            <v-autocomplete
                v-if="item.type === 'select'"
                :label="item.title"
                v-model="data[item.field]"
                :items="item.options"
                item-text="name"
                item-value="id"
                :error="isFieldFailed(item.field)"
                :error-messages="getFieldFails(item.field)"
            ></v-autocomplete>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import {
  actionType as reportActionType,
} from "../../../store/report/governmentProgramsReports";

export default {
  name: "GovernmentProgramsReportEditor",
  props: {
    parentId: String,
    id: String,
  },
  data() {
    return {
      loading: false,
      fields: null,
      data: null,
      fails: {},
      dateMenu: {},
    }
  },
  mounted() {
    this.loadFields();
  },
  methods: {
    back() {
      this.$router.go(-1);
    },
    loadFields() {
      this.loading = true
      this.$store.dispatch(reportActionType.fetchReportRow, {id: this.id, parentId: this.parentId})
          .then((response) => {
            this.fields = response.fields;
            this.data = response.data;
            this.fails = response.fails;
          })
          .catch((fail) => {
            console.dir(fail);
            this.back();
          })
          .finally(() => {
            this.loading = false;
          });
    },
    updateFields() {
      this.loading = true
      this.$store.dispatch(reportActionType.updateReportRow, this.data)
          .then(() => {
            this.loadFields();
          })
          .catch((error) => {
            if (error.status === 422) {
              this.fails = error.data.errors;
            }
          })
          .finally(() => {
            this.loading = false;
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
  },
}
</script>

<style scoped>

</style>
