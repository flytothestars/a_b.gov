<template>
    <v-container id="region-report-ratios" fluid expert="section" pt-0>
        <v-card>
            <v-card-actions>
                <v-row class="pb-5 pl-5">
                    <v-col cols="2">
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
                                    label="Дата начала"
                                    prepend-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                v-model="selectedDate"
                                no-title
                                scrollable
                                @input="dateMenu = false"
                            />
                        </v-menu>
                    </v-col>
                    <v-col cols="2">
                        <v-menu
                            ref="menu"
                            v-model="dateMenu2"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    v-model="selectedEndDate"
                                    label="Дата окончания"
                                    prepend-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                v-model="selectedEndDate"
                                no-title
                                scrollable
                                @input="dateMenu2 = false"
                            />
                        </v-menu>
                    </v-col>
                    <v-col cols="2"
                        ><v-autocomplete
                            v-model="selectedReport"
                            :items="reportTypes"
                            item-text="name"
                            item-value="id"
                            class="mt-5"
                            dense
                            label="Отчет"
                        ></v-autocomplete>
                    </v-col>
                    <v-col cols="1">
                        <v-btn
                            class="mt-3"
                            color="primary"
                            :loading="excelExportInProcess"
                            :disabled="excelExportInProcess"
                            @click="excelExport"
                        >
                            {{
                                this.$vuetify.lang.t(
                                    "$vuetify.page.action.btnSave"
                                )
                            }}
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card-actions>
        </v-card>

        <v-card class="mt-10">
            <v-card-actions>
                <v-row class="pb-5 pl-5">
                    <v-col cols="2">
                        <v-menu
                            ref="menu"
                            v-model="dateMenu3"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    v-model="selectedDate"
                                    label="Дата начала"
                                    prepend-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                v-model="selectedDate"
                                no-title
                                scrollable
                                @input="dateMenu3 = false"
                            />
                        </v-menu>
                    </v-col>
                    <v-col cols="2">
                        <v-menu
                            ref="menu"
                            v-model="dateMenu4"
                            :close-on-content-click="false"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field
                                    v-model="selectedEndDate"
                                    label="Дата окончания"
                                    prepend-icon="mdi-calendar"
                                    readonly
                                    v-bind="attrs"
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-date-picker
                                v-model="selectedEndDate"
                                no-title
                                scrollable
                                @input="dateMenu4 = false"
                            />
                        </v-menu>
                    </v-col>

                    <v-col cols="1">
                        <v-btn
                            class="mt-3"
                            color="primary"
                            @click="getAllStatistics()"
                        >
                            {{
                                this.$vuetify.lang.t(
                                    "$vuetify.page.action.btnSave"
                                )
                            }}
                        </v-btn>
                    </v-col>
                    <v-card-text>
                        <v-tabs v-model="tab">
                            <v-tab>Отчет по обращениям</v-tab>
                            <v-tab>Дашборд</v-tab>
                        </v-tabs>
                        <v-tabs-items v-model="tab">
                            <v-tab-item>
                                <v-col cols="12">
                                    <h4>Общая статистика</h4>
                                    <v-data-table
                                        :headers="headers"
                                        :items="all_statistics"
                                        class="elevation-1"
                                    >
                                    </v-data-table>
                                </v-col>

                                <v-divider></v-divider>

                                <v-col cols="12">
                                    <h4>Общая статистика по районам Алматы</h4>
                                    <v-data-table
                                        :headers="headers2"
                                        :items="all_statistics2"
                                        class="elevation-1"
                                    >
                                    </v-data-table>
                                </v-col>

                                <v-divider></v-divider>

                                <v-col cols="12">
                                    <h4>
                                        Общая статистика потребностей по
                                        категориям
                                    </h4>
                                    <v-data-table
                                        :headers="headers3"
                                        :items="all_statistics3"
                                        class="elevation-1"
                                    >
                                    </v-data-table>
                                </v-col>

                                <v-divider></v-divider>

                                <v-col cols="12">
                                    <h4>
                                        Общая статистика потребностей по районам
                                        Алматы
                                    </h4>
                                    <v-data-table
                                        :headers="headers4"
                                        :items="all_statistics4"
                                        class="elevation-1"
                                    >
                                    </v-data-table>
                                </v-col>

                                <v-divider></v-divider>

                                <v-col cols="12">
                                    <h4>
                                        Общая статистика потребностей по
                                        категориям и отраслям
                                    </h4>
                                    <v-data-table
                                        :headers="headers5"
                                        :items="all_statistics5"
                                        style="width: 1460px;"
                                        class="elevation-1"
                                    >
                                    </v-data-table>
                                </v-col>
                            </v-tab-item>
                            <v-tab-item>
                                <v-card flat class="mt-4">
                                    <report-viewer-component
                                        report-file="/reports/prt/Otchet.mrt"
                                        :data="data"
                                        data-source="Otchet"
                                    />
                                </v-card>
                            </v-tab-item>
                        </v-tabs-items>
                    </v-card-text>
                </v-row>
            </v-card-actions>
        </v-card>

        <v-overlay :value="overlay">
            <v-progress-circular indeterminate size="64"></v-progress-circular>
        </v-overlay>
    </v-container>
</template>

<script>
import ReportViewerComponent from "../../components/report/ReportViewerComponent";
import {
    actionType as reportActionType,
    getterType as reportGetterType,
    mutationType as reportMutationType
} from "../../store/report/ReportAppeals";

export default {
    name: "RegionReportEdit",
    components: { ReportViewerComponent },
    props: {
        reportType: null
    },
    data() {
        return {
            data: null,
            tab: null,
            dateMenu: null,
            dateMenu2: null,
            dateMenu3: null,
            dateMenu4: null,
            excelExportInProcess: false,
            overlay: false,
            filter: {
                startDate: null,
                endDate: null,
                returnDataWithoutExcel: false
            },
            reportTypes: [
                { id: 1, name: "Отчет по бизнесу" },
                { id: 2, name: "Статистика обращений по районам" }
            ],
            typeValue: null,
            exportAction: null,
            all_statistics: [],
            all_statistics2: [],
            all_statistics3: [],
            all_statistics4: [],
            all_statistics5: [],
            headers: [
                { text: "Общая статистика по районам", value: "header" },
                { text: "Всего", value: "all_data" },
                { text: "УПиИ", value: "upi" },
                { text: "QOLDAY", value: "qolday" }
            ],
            headers2: [
                { text: "Общая статистика по районам", value: "header" },
                { text: "Всего", value: "all" },
                { text: "Алатауский", value: "Алатауский" },
                { text: "Алмалинский", value: "Алмалинский" },
                { text: "Ауэзовский", value: "Ауэзовский" },
                { text: "Бостандыкский", value: "Бостандыкский" },
                { text: "Жетысуский", value: "Жетысуский" },
                { text: "Медеуский", value: "Медеуский" },
                { text: "Наурызбайский", value: "Наурызбайский" },
                { text: "Турксибский", value: "Турксибский" }
                // { text: 'Вне города', value: 'Вне города' },
            ],
            headers3: [
                { text: "Общая статистика", value: "header" },
                { text: "Всего", value: "all" },
                { text: "Финансирование", value: "Финансирование" },
                { text: "Земельные отношения", value: "Земельные отношения" },
                { text: "Строительство", value: "Строительство" },
                {
                    text: "Консультации и сопровождение",
                    value: "Консультации и сопровождение"
                },
                {
                    text: "Лицензии и другие разрешения",
                    value: "Лицензии и другие разрешения"
                },
                { text: "Инженерные сети", value: "Инженерные сети" },
                {
                    text: "Коммунальная инфраструктура",
                    value: "Коммунальная инфраструктура"
                },
                {
                    text:
                        "Привлечение работников за счет государственных программ",
                    value: "Привлечение работников за счет го"
                },
                { text: "Другое", value: "Другое" }
            ],
            headers4: [
                { text: "Общая статистика по районам", value: "name" },
                { text: "Всего", value: "all" },
                { text: "Алатауский", value: "Алатауский" },
                { text: "Алмалинский", value: "Алмалинский" },
                { text: "Ауэзовский", value: "Ауэзовский" },
                { text: "Бостандыкский", value: "Бостандыкский" },
                { text: "Жетысуский", value: "Жетысуский" },
                { text: "Медеуский", value: "Медеуский" },
                { text: "Наурызбайский", value: "Наурызбайский" },
                { text: "Турксибский", value: "Турксибский" }
                // { text: 'Вне города', value: 'Вне города' },
            ],
            headers5: [
                { text: "Категория потребностей", value: "name" },
                { text: "Всего", value: "all" },
                { text: "Торговля", value: "Торговля" },
                { text: "Услуги", value: "Услуги" },
                {
                    text: "Рестораны, кафе, столовые, бары",
                    value: "Рестораны, кафе, столовые, бары"
                },
                { text: "Здравоохранение", value: "Здравоохранение" },
                { text: "Образование", value: "Образование" },
                { text: "Гостиницы", value: "Гостиницы" },
                { text: "Недвижимость", value: "Недвижимость" },
                { text: "Производство", value: "Производство" },
                { text: "Развлечение и отдых", value: "Развлечение и отдых" },
                {
                    text: "Телекоммуникации и ИТ",
                    value: "Телекоммуникации и ИТ"
                },
                { text: "Финансы", value: "Финансы" },
                {
                    text: "Транспорт и складирование",
                    value: "Транспорт и складирование"
                },
                { text: "Строительство", value: "Строительство" },
                { text: "Другое", value: "Другое" }
            ]
        };
    },
    created() {
        if (!this.selectedDate) {
            this.$store.commit(
                reportMutationType.setCurrentDate,
                new Date().toISOString().split("T")[0]
            );
        }
        if (!this.selectedEndDate) {
            this.$store.commit(
                reportMutationType.setEndCurrentDate,
                new Date().toISOString().split("T")[0]
            );
        }
    },
    computed: {
        selectedDate: {
            get() {
                return this.$store.getters[reportGetterType.getCurrentDate];
            },
            set(date) {
                this.$store.commit(reportMutationType.setCurrentDate, date);
            }
        },
        selectedEndDate: {
            get() {
                return this.$store.getters[reportGetterType.getEndCurrentDate];
            },
            set(date) {
                this.$store.commit(reportMutationType.setEndCurrentDate, date);
            }
        },
        selectedReport: {
            get() {
                return this.typeValue;
            },
            set(newValue) {
                console.log("computed");
                console.log(newValue);
                switch (newValue) {
                    case 1: {
                        this.exportAction = reportActionType.excelExport;
                        break;
                    }
                    case 2: {
                        this.exportAction = reportActionType.exportDistrStatic;
                        break;
                    }
                }
                this.typeValue = newValue;
            }
        }
    },

    methods: {
        back() {
            this.$router.push({ name: "ReportList" });
        },
        excelExport() {
            this.excelExportInProcess = true;

            this.filter.startDate = this.selectedDate;

            this.filter.endDate = this.selectedEndDate;
            console.log(this.filter);
            console.log(this.typeValue);
            this.$store
                .dispatch(this.exportAction, this.filter)
                .then(response => {
                    let link = document.createElement("a");
                    let blob = new Blob([response], {
                        type:
                            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                    });
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "Отчет";
                    link.click();
                    this.excelExportInProcess = false;
                });
        },
        getAllStatistics() {
            this.overlay = true;
            this.all_statistics = [];
            this.all_statistics2 = [];
            this.all_statistics4 = [];
            this.all_statistics5 = [];
            this.filter.startDate = this.selectedDate;
            this.filter.endDate = this.selectedEndDate;
            this.filter.returnDataWithoutExcel = true;
            this.exportAction = reportActionType.allStatistics;
            this.$store
                .dispatch(this.exportAction, this.filter)
                .then(response => {
                    console.log(response);

                    this.overlay = false;
                    this.all_statistics = response[0];
                    this.all_statistics2 = response[1];
                    this.all_statistics3 = response[2];
                    this.all_statistics4 = response[3];
                    this.all_statistics5 = response[4];
                    this.loadReportDataSet();
                });
        },
        loadReportDataSet() {
            if (this.selectedDate) {
                this.$store
                    .dispatch(reportActionType.fetchReportData, {
                        startDate: this.selectedDate,
                        endDate: this.selectedEndDate
                    })
                    .then(data => {
                        this.data = data;
                        console.log(data);
                    });
            }
        }
    },
    watch: {}
};
</script>

<style scoped></style>
