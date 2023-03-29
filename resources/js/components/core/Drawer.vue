<template>
    <v-navigation-drawer id="core-navigation-drawer" v-model="drawer"
        :dark="barColor !== 'rgba(228, 226, 226, 1), rgba(255, 255, 255, 0.7)'" expand-on-hover color="#1E3057"
        :right="$vuetify.rtl" :src="barImage" mobile-breakpoint="960" app width="260" v-bind="$attrs"
        :mini-variant.sync="mini" @update:mini-variant="log">
        <template v-slot:img="props">
            <v-img v-bind="props" />
        </template>

        <v-divider class="mb-1" />

        <v-list dense nav class="pl-0">
            <v-list-item>
                <v-list-item-content class="py-5 d-flex justify-center" style="white-space: break-spaces">
                    <v-img src="/images/light-logo.svg" max-width="165" contain />
                </v-list-item-content>
            </v-list-item>
        </v-list>

        <v-divider class="mb-2" />


        <template class="top-line__right" v-slot:activator="{ on }">
            <div class="top-line__profile" dense v-on="on">
                <div class="profile__info">
                    <span class="profile__info-name">{{ userProfile.firstName + ' ' + userProfile.lastName }}</span>
                    <div class="profile__info-img">
                        <img src="/images/avatar.png" alt="Proifle name" />
                    </div>
                </div>
            </div>
        </template>

        <v-list expand nav class="pl-0">
            <!-- Style cascading bug  -->
            <!-- https://github.com/vuetifyjs/vuetify/pull/8574 -->
            <div />

            <template v-for="(item, i) in computedItems">
                <base-item-group v-if="item.children" :key="`group-${i}`" :item="item"
                    style="white-space: break-spaces;">
                    <!--  -->
                </base-item-group>

                <base-item v-else :key="`item-${i}`" :item="item" />
            </template>

            <!-- Style cascading bug  -->
            <!-- https://github.com/vuetifyjs/vuetify/pull/8574 -->
            <div />
        </v-list>
    </v-navigation-drawer>
</template>

<script>
// Utilities
import { mapState } from "vuex";
import roleEnum from "../../enums/roleEnum";

export default {
    name: "DashboardCoreDrawer",

    props: {
        expandOnHover: {
            type: Boolean,
            default: true
        }
    },

    data: () => ({
        mini: undefined,
        items: [
            {
                icon: "mdi-newspaper",
                title: "Список пользователей",
                roles: ["Administrator"],
                to: { name: "UserList" }
            },
            {
                icon: "mdi-newspaper",
                title: "Новости",
                roles: ["Administrator", "PressSecretary"],
                to: { name: "NewsList" }
            },
            {
                icon: 'mdi-sitemap',
                title: 'BPMN',
                roles: [roleEnum.Administrator],
                group: '',
                children: [
                    {
                        icon: 'mdi-cog-outline',
                        title: 'Настройки клиента',
                        roles: [roleEnum.Administrator],
                        to: { name: 'Camunda.ClientSettings' },
                    },
                    {
                        icon: 'mdi-cog-outline',
                        title: 'Тестирование заявки',
                        roles: [roleEnum.Administrator],
                        to: { name: 'Camunda.AppealsTest' },
                    },
                ]
            },
            {
                icon: "mdi-newspaper",
                title: "Все заявки",
                roles: [
                    roleEnum.Distributor,
                    roleEnum.Head,
                    roleEnum.UpiCurator,
                    roleEnum.DivisionCurator,
                    roleEnum.UpiHead,
                    roleEnum.Executor
                ],
                to: { name: "AppealsSandbox" }
            },
            // {
            //     icon: "mdi-newspaper",
            //     title: "УПиИ",
            //     roles: [roleEnum.UpiHead],
            //     group: "",
            //     children: [
            //         {
            //             icon: "mdi-account-group-outline",
            //             title: "В работе",
            //             roles: [roleEnum.UpiHead],
            //             to: { name: "MyAppeals.UPI.inWork" }
            //         },
            //         {
            //             icon: "mdi-account-group-outline",
            //             title: "Исполненные",
            //             roles: [roleEnum.UpiHead],
            //             to: { name: "MyAppeals.UPI.completed" }
            //         }
            //     ]
            // },
            // {
            //     icon: "mdi-newspaper",
            //     title: "Qolday",
            //     roles: [roleEnum.UpiHead],
            //     group: "",
            //     children: [
            //         {
            //             icon: "mdi-account-group-outline",
            //             title: "В работе",
            //             roles: [roleEnum.UpiHead],
            //             to: { name: "MyAppeals.Qolday.inWork" }
            //         },
            //         {
            //             icon: "mdi-account-group-outline",
            //             title: "Исполненные",
            //             roles: [roleEnum.UpiHead],
            //             to: { name: "MyAppeals.Qolday.completed" }
            //         }
            //     ]
            // },
            {
                icon: "mdi-newspaper",
                title: "Мои заявки",
                roles: [roleEnum.CoExecutor, roleEnum.DistrictCurator],
                to: { name: "MyAppeals" }
            },
            {
                icon: "mdi-newspaper",
                title: "Мои заявки",
                roles: [
                    roleEnum.Distributor,
                    // roleEnum.Executor,
                    // roleEnum.UpiCurator,
                    roleEnum.DivisionCurator
                ],
                group: "",
                children: [
                    // {
                    //     icon: "mdi-graph-outline",
                    //     title: "Требует назначения",
                    //     roles: [roleEnum.UpiCurator],
                    //     to: { name: "MyAppeals.toWork" }
                    // },
                    {
                        icon: "mdi-account-group-outline",
                        title: "В работе",
                        roles: [
                            // roleEnum.UpiCurator,
                            roleEnum.Distributor,
                            // roleEnum.Executor,
                            roleEnum.DivisionCurator
                        ],
                        to: { name: "MyAppeals.inWork" }
                    },
                    {
                        icon: "mdi-account-group-outline",
                        title: "Исполненные",
                        roles: [
                            roleEnum.Distributor,
                            // roleEnum.UpiCurator,
                            // roleEnum.Executor,
                            roleEnum.DivisionCurator
                        ],
                        to: { name: "MyAppeals.completed" }
                    },
                    // {
                    //     icon: "mdi-account-group-outline",
                    //     title: "На подтверждение",
                    //     roles: [
                    //         roleEnum.Distributor,
                    //         roleEnum.UpiCurator,
                    //         roleEnum.DivisionCurator
                    //     ],
                    //     to: { name: "MyAppeals.confirmation" }
                    // },
                    // {
                    //     icon: "mdi-account-group-outline",
                    //     title: "На распределении",
                    //     roles: [roleEnum.Distributor],
                    //     to: { name: "MyAppeals.distributor_assigned" }
                    // },
                    // {
                    //     icon: "mdi-account-group-outline",
                    //     title: "На коррекции",
                    //     roles: [roleEnum.Distributor],
                    //     to: { name: "MyAppeals.business.correction" }
                    // }
                ]
            },
            // {
            //     icon: "mdi-newspaper",
            //     title: "Qolday",
            //     roles: [roleEnum.Head],
            //     group: "",
            //     children: [
            //         {
            //             icon: "mdi-account-group-outline",
            //             title: "В работе",
            //             roles: [roleEnum.Head],
            //             to: { name: "MyAppeals.inWork" }
            //         },
            //         {
            //             icon: "mdi-account-group-outline",
            //             title: "Исполненные",
            //             roles: [roleEnum.Head],
            //             to: { name: "MyAppeals.completed" }
            //         }
            //     ]
            // },
            {
                icon: "mdi-newspaper",
                title: "Бизнес",
                roles: [
                    // Временно
                    // roleEnum.Distributor,
                    // roleEnum.Head,
                    // roleEnum.Executor,
                    // roleEnum.CoExecutor,
                    // roleEnum.DistrictCurator,
                    // roleEnum.UpiCurator,
                    // roleEnum.DivisionCurator,
                    // roleEnum.UpiHead
                ],
                children: [
                    {
                        icon: "mdi-newspaper",
                        title: "Без заявки",
                        roles: [
                            // Временно
                            // roleEnum.Distributor,
                            // roleEnum.Head,
                            // roleEnum.Executor,
                            // roleEnum.CoExecutor,
                            // roleEnum.DistrictCurator,
                            // roleEnum.UpiCurator,
                            // roleEnum.DivisionCurator,
                            // roleEnum.UpiHead
                        ],
                        to: { name: "Business.no-appeal" }
                    },
                    {
                        icon: "mdi-newspaper",
                        title: "С заявками",
                        roles: [
                            // roleEnum.Distributor,
                            // roleEnum.Head,
                            // roleEnum.Executor,
                            // roleEnum.CoExecutor,
                            // roleEnum.DistrictCurator,
                            // roleEnum.UpiCurator,
                            // roleEnum.DivisionCurator,
                            // roleEnum.UpiHead
                        ],
                        to: { name: "Business.appeal" }
                    }
                ]
            },
            // {
            //     icon: "mdi-newspaper",
            //     title: "Мой бизнес",
            //     roles: [roleEnum.Distributor],
            //     to: { name: "MyBusinessList" }
            // },
            // {
            //     icon: 'mdi-newspaper',
            //     title: 'Отчеты внешние',
            //     roles: [roleEnum.Administrator],
            //     to: {name : 'ReportList'},
            // },
            {
                icon: "$vuetify.icons.reports",
                title: "Аналитика",
                roles: [
                    roleEnum.Administrator,
                    roleEnum.Head,
                    // roleEnum.UpiCurator
                ],
                children: [
                    {
                        icon: '$vuetify.icons.reportsInner',
                        title: 'Актуализация бизнеса',
                        roles: [
                            roleEnum.Administrator,
                            roleEnum.Head,
                        ],
                        to: { name: "MIOActualisation" }
                    },
                    {
                        icon: '$vuetify.icons.reportsInner',
                        title: 'Креативная индустрия',
                        roles: [
                            roleEnum.Administrator,
                            roleEnum.Head,
                        ],
                        to: { name: "CreativeAnalytics" }
                    },
                    {
                        icon: '$vuetify.icons.reportsInner',
                        title: 'Обрабатывающая промышленность',
                        roles: [
                            roleEnum.Administrator,
                            roleEnum.Head,
                        ],
                        to: { name: "PromzoneAnalytics" }
                    },
                    {
                        icon: '$vuetify.icons.reportsInner',
                        title: 'Потребности в консультации',
                        roles: [
                            roleEnum.Administrator,
                            roleEnum.Head,
                        ],
                        to: { name: "ConsultationNeeds" }
                    },
                    {
                        icon: '$vuetify.icons.reportsInner',
                        title: 'Отрасли',
                        roles: [
                            roleEnum.Administrator,
                            roleEnum.Head,
                        ],
                        to: { name: "MIOIndustries" }
                    },
                    //   {
                    //     icon: 'mdi-chart-areaspline',
                    //     title: 'Обращения',
                    //     roles: [
                    //       roleEnum.Administrator,
                    //       roleEnum.Head,
                    //       roleEnum.UpiCurator,
                    //     ],
                    //       to: { name: "ReportForm" }
                    //   },
                    {
                        icon: 'mdi-account-group',
                        title: 'Пользователи',
                        roles: [
                            roleEnum.Administrator,
                        ],
                        to: { name: "UsersReport" }
                    },
                ]
            }
        ]
    }),

    computed: {
        ...mapState(["barColor", "barImage"]),
        drawer: {
            get() {
                return this.$store.state.drawer;
            },
            set(val) {
                this.$store.commit("SET_DRAWER", val);
            }
        },
        computedItems() {
            // return this.items.filter((item) => !item.roles || ).map(this.mapItem)
            return this.items.map(this.mapItem).filter(item => item.title);
        },
        profile() {
            return {
                avatar: true,
                title: this.$vuetify.lang.t("$vuetify.companyName")
            };
        },
        userProfile() {
            return this.$store.getters.user
        }

    },

    methods: {
        log(v) {
            console.log(v);
            this.$emit('drawerUpdate', v);
        },
        mapItem(item) {
            if (item.roles) {
                if (this.$store.getters.hasRole(item.roles)) {
                    return this._mapItem(item);
                } else {
                    return [];
                }
            } else {
                return this._mapItem(item);
            }
        },
        _mapItem(item) {
            return {
                ...item,
                children: item.children
                    ? item.children.map(this.mapItem)
                    : undefined,
                title: this.$vuetify.lang.t(item.title)
            };
        }
    }
};
</script>

<style lang="sass">
@import '~vuetify/src/styles/tools/_rtl.sass'

.companyName
    line-height: initial !important

#core-navigation-drawer
    .v-list-group__header.v-list-item--active:before
        opacity: .24

    .v-list-item
        &__icon--text,
        &__icon:first-child
            justify-content: center
            text-align: center
            width: 20px

            +ltr()
                margin-right: 24px
                margin-left: 12px !important

            +rtl()
                margin-left: 24px
                margin-right: 12px !important

    .v-list--dense
        .v-list-item
            &__icon--text,
            &__icon:first-child
                margin-top: 10px

    .v-list-group--sub-group
        .v-list-item
            +ltr()
                padding-left: 8px

            +rtl()
                padding-right: 8px

        .v-list-group__header
            +ltr()
                padding-right: 0

            +rtl()
                padding-right: 0

            .v-list-item__icon--text
                margin-top: 19px
                order: 0

            .v-list-group__header__prepend-icon
                order: 2

                +ltr()
                    margin-right: 8px

                +rtl()
                    margin-left: 8px
</style>
