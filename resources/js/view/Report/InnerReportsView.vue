<template>
  <v-container
      id="industry-report"
      fluid
      expert="section"
      pt-0
  >
    <v-card
        class="report-card"
    >
      <v-card-text>
        <h1>Внутренние отчеты</h1>
        <v-divider class="mt-3 mb-3"/>
        <v-expansion-panels
            v-model="panels"
            multiple
        >
          <v-expansion-panel>
            <v-expansion-panel-header class="inner-report-header">
              <v-row>
                <v-col cols="12">
                  <v-icon>{{ headers.socialEconomy.icon }}</v-icon>
                  <div class="pl-2 d-inline-block">{{ headers.socialEconomy.title }}</div>
                </v-col>
              </v-row>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-divider></v-divider>
              <v-list-item
                  v-for="item of reports.socialEconomy"
                  :key="item.title"
              >
                <v-list-item-content>
                  <v-row>
                    <v-col cols="12">
                      <v-icon>{{ item.icon }}</v-icon>
                      <div
                          class="pl-2 d-inline-block"
                      > {{ item.title }} </div>
                      <v-btn
                          small
                          class="ml-2 float-right"
                          outlined
                          color="primary"
                          @click="() => editCity(item.id)"
                      >
                        Показатели по городам
                      </v-btn>
                      <v-btn
                          v-if="item.id !== 1"
                          small
                          class="ml-2 float-right"
                          outlined
                          color="primary"
                          @click="() => editRegion(item.id)"
                      >
                        Показатели по районам
                      </v-btn>
                      <v-btn
                          v-if="item.link"
                          class="ml-2 float-right"
                          @click="() => routeTo(item.link)"
                          small
                          outlined
                          color="primary"
                      >
                        См. Отчет
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-list-item-content>
              </v-list-item>
            </v-expansion-panel-content>
          </v-expansion-panel>
          <v-expansion-panel>
            <v-expansion-panel-header class="inner-report-header">
              <v-row>
                <v-col cols="12">
                  <v-icon>{{ headers.planDevAlmaty.icon }}</v-icon>
                  <div class="pl-2 d-inline-block">{{ headers.planDevAlmaty.title }}</div>
                </v-col>
              </v-row>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-divider></v-divider>
              <v-list-item
                  v-for="item of reports.planDevAlmaty"
                  :key="item.title"
              >
                <v-list-item-content>
                  <v-row>
                    <v-col cols="12">
                      <v-icon>{{ item.icon }}</v-icon>
                      <div
                          class="pl-2 d-inline-block"
                      > {{ item.title }} </div>
                      <v-btn
                          small
                          class="ml-2 float-right"
                          outlined
                          color="primary"
                          @click="() => editCity(item.id)"
                      >
                        Показатели
                      </v-btn>
                      <v-btn
                          v-if="item.link"
                          class="float-right"
                          @click="() => routeTo(item.link)"
                          small
                          outlined
                          color="primary"
                      >
                        См. Отчет
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-list-item-content>
              </v-list-item>
            </v-expansion-panel-content>
          </v-expansion-panel>
          <v-expansion-panel>
            <v-expansion-panel-header class="inner-report-header">
              <v-row>
                <v-col cols="12">
                  <v-icon>{{ headers.govPrograms.icon }}</v-icon>
                  <div class="pl-2 d-inline-block">{{ headers.govPrograms.title }}</div>
                </v-col>
              </v-row>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <government-programs-reports-list-inner></government-programs-reports-list-inner>
            </v-expansion-panel-content>
          </v-expansion-panel>
<!--          <v-expansion-panel>-->
<!--            <v-expansion-panel-header class="inner-report-header">-->
<!--              <v-row>-->
<!--                <v-col cols="12">-->
<!--                  <v-icon>{{ headers.creditInfo.icon }}</v-icon>-->
<!--                  <div class="pl-2 d-inline-block">{{ headers.creditInfo.title }}</div>-->
<!--                </v-col>-->
<!--              </v-row>-->
<!--            </v-expansion-panel-header>-->
<!--            <v-expansion-panel-content>-->
<!--              <v-divider></v-divider>-->
<!--              <v-list-item-->
<!--                  v-for="item of reports.creditInfo"-->
<!--                  :key="item.title"-->
<!--              >-->
<!--                <v-list-item-content>-->
<!--                  <v-row>-->
<!--                    <v-col cols="12">-->
<!--                      <v-icon>{{ item.icon }}</v-icon>-->
<!--                      <div-->
<!--                          class="pl-2 d-inline-block"-->
<!--                      > {{ item.title }} </div>-->
<!--                      <v-btn-->
<!--                          v-if="item.link"-->
<!--                          class="float-right"-->
<!--                          @click="() => routeTo(item.link)"-->
<!--                          small-->
<!--                          outlined-->
<!--                          color="primary"-->
<!--                      >-->
<!--                        См. Отчет-->
<!--                      </v-btn>-->
<!--                    </v-col>-->
<!--                  </v-row>-->
<!--                </v-list-item-content>-->
<!--              </v-list-item>-->
<!--            </v-expansion-panel-content>-->
<!--          </v-expansion-panel>-->
<!--          <v-expansion-panel>-->
<!--            <v-expansion-panel-header class="inner-report-header">-->
<!--              <v-row>-->
<!--                <v-col cols="12">-->
<!--                  <v-icon>{{ headers.taxes.icon }}</v-icon>-->
<!--                  <div class="pl-2 d-inline-block">{{ headers.taxes.title }}</div>-->
<!--                </v-col>-->
<!--              </v-row>-->
<!--            </v-expansion-panel-header>-->
<!--            <v-expansion-panel-content>-->
<!--            </v-expansion-panel-content>-->
<!--          </v-expansion-panel>-->
<!--          <v-expansion-panel>-->
<!--            <v-expansion-panel-header class="inner-report-header">-->
<!--              <v-row>-->
<!--                <v-col cols="12">-->
<!--                  <v-icon>{{ headers.workPlaces.icon }}</v-icon>-->
<!--                  <div class="pl-2 d-inline-block">{{ headers.workPlaces.title }}</div>-->
<!--                </v-col>-->
<!--              </v-row>-->
<!--            </v-expansion-panel-header>-->
<!--            <v-expansion-panel-content>-->
<!--            </v-expansion-panel-content>-->
<!--          </v-expansion-panel>-->
        </v-expansion-panels>

      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import GovernmentProgramsReportsListInner from "./GovernmentPrograms/GovernmentProgramsReportsListInner";
export default {
  name: "InnerReportsView",
  components: {GovernmentProgramsReportsListInner},
  data() {
    return {
      panels: [0],
      headers: {
        socialEconomy: {
          title: 'Социально-экономическое развитие',
          icon: '$vuetify.icons.ReportsInnerSocialEconomyIcon'
        },
        planDevAlmaty: {
          title: 'Отчеты по Плану развития г.Алматы',
          icon: '$vuetify.icons.ReportGrowthPlanIcon'
        },
        govPrograms: {
          title: 'Государственные программы',
          icon: '$vuetify.icons.ReportGovernmentProgramsIcon'
        },
        creditInfo: {
          title: 'Информация по кредитованию',
          icon: '$vuetify.icons.ReportLoanInfoIcon'
        },
        taxes: {
          title: 'Налоги',
          icon: '$vuetify.icons.ReportTaxesIcon'
        },
        workPlaces: {
          title: 'Рабочие места',
          icon: '$vuetify.icons.ReportWorkPlacesIcon'
        },
      },
      reports: {
        socialEconomy: [
          {
            id: 3,
            icon: '$vuetify.icons.ReportInnerBusinessStatIcon',
            title: 'Статистика предприятий',
            link: {
              component: 'BusinessStatReport',
            },
          }, {
            id: 1,
            icon: '$vuetify.icons.ReportIndustryIcon',
            title: 'Промышленность',
            link: {
              component: 'IndustryReport',
            },
          },
          {
            id: 4,
            icon: '$vuetify.icons.ReportInvestIcon',
            title: 'Инвестиции',
            link: {
              component: 'InvestmentsReport',
            },
          },
          {
            id: 2,
            icon: '$vuetify.icons.ReportTradeIcon',
            title: 'Торговля',
            link: {
              component: 'TradeReport',
            },
          },
        ],
        planDevAlmaty: [
          {
            id: 5,
            icon: '$vuetify.icons.ReportGrowthPlanIcon',
            title: 'ПРТ',
            link: {
              component: 'PRTReport',
            },
          },
        ],
        creditInfo: [
          {
            icon: '$vuetify.icons.ReportLoanInfoIcon',
            title: 'Кредитование',
          },
          {
            icon: '$vuetify.icons.ReportLoanSmallBusinessIcon',
            title: 'Кредитование МБ',
          },
          {
            icon: '$vuetify.icons.ReportLoanPersonalIcon',
            title: 'Потребительское кредитование',
          },
        ],
      },
    };
  },
  methods: {
    routeTo(route) {
      if (route.component) {
        this.$router.push({name: route.component});
      }
    },
    editCity(id) {
      this.$router.push({name: 'CityReportEdit', params: {reportType: id}})
    },
    editRegion(id) {
      this.$router.push({name: 'DistrictReportEdit', params: {reportType: id}})
    },
  }

}
</script>

<style scoped>

</style>
