(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_core_Drawer_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/Drawer.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/Drawer.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../enums/roleEnum */ "./resources/js/enums/roleEnum.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
// Utilities


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "DashboardCoreDrawer",
  props: {
    expandOnHover: {
      type: Boolean,
      "default": true
    }
  },
  data: function data() {
    return {
      mini: undefined,
      items: [{
        icon: "mdi-newspaper",
        title: "Список пользователей",
        roles: ["Administrator"],
        to: {
          name: "UserList"
        }
      }, {
        icon: "mdi-newspaper",
        title: "Новости",
        roles: ["Administrator", "PressSecretary"],
        to: {
          name: "NewsList"
        }
      }, {
        icon: 'mdi-sitemap',
        title: 'BPMN',
        roles: [_enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Administrator],
        group: '',
        children: [{
          icon: 'mdi-cog-outline',
          title: 'Настройки клиента',
          roles: [_enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Administrator],
          to: {
            name: 'Camunda.ClientSettings'
          }
        }, {
          icon: 'mdi-cog-outline',
          title: 'Тестирование заявки',
          roles: [_enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Administrator],
          to: {
            name: 'Camunda.AppealsTest'
          }
        }]
      }, {
        icon: "mdi-newspaper",
        title: "Все заявки",
        roles: [_enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Distributor, _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Head, _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.UpiCurator, _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.DivisionCurator, _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.UpiHead, _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Executor],
        to: {
          name: "AppealsSandbox"
        }
      }, // {
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
        roles: [_enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.CoExecutor, _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.DistrictCurator],
        to: {
          name: "MyAppeals"
        }
      }, {
        icon: "mdi-newspaper",
        title: "Мои заявки",
        roles: [_enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Distributor, // roleEnum.Executor,
        // roleEnum.UpiCurator,
        _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.DivisionCurator],
        group: "",
        children: [// {
        //     icon: "mdi-graph-outline",
        //     title: "Требует назначения",
        //     roles: [roleEnum.UpiCurator],
        //     to: { name: "MyAppeals.toWork" }
        // },
        {
          icon: "mdi-account-group-outline",
          title: "В работе",
          roles: [// roleEnum.UpiCurator,
          _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Distributor, // roleEnum.Executor,
          _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.DivisionCurator],
          to: {
            name: "MyAppeals.inWork"
          }
        }, {
          icon: "mdi-account-group-outline",
          title: "Исполненные",
          roles: [_enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Distributor, // roleEnum.UpiCurator,
          // roleEnum.Executor,
          _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.DivisionCurator],
          to: {
            name: "MyAppeals.completed"
          }
        } // {
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
      }, // {
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
        roles: [// Временно
          // roleEnum.Distributor,
          // roleEnum.Head,
          // roleEnum.Executor,
          // roleEnum.CoExecutor,
          // roleEnum.DistrictCurator,
          // roleEnum.UpiCurator,
          // roleEnum.DivisionCurator,
          // roleEnum.UpiHead
        ],
        children: [{
          icon: "mdi-newspaper",
          title: "Без заявки",
          roles: [// Временно
            // roleEnum.Distributor,
            // roleEnum.Head,
            // roleEnum.Executor,
            // roleEnum.CoExecutor,
            // roleEnum.DistrictCurator,
            // roleEnum.UpiCurator,
            // roleEnum.DivisionCurator,
            // roleEnum.UpiHead
          ],
          to: {
            name: "Business.no-appeal"
          }
        }, {
          icon: "mdi-newspaper",
          title: "С заявками",
          roles: [// roleEnum.Distributor,
            // roleEnum.Head,
            // roleEnum.Executor,
            // roleEnum.CoExecutor,
            // roleEnum.DistrictCurator,
            // roleEnum.UpiCurator,
            // roleEnum.DivisionCurator,
            // roleEnum.UpiHead
          ],
          to: {
            name: "Business.appeal"
          }
        }]
      }, // {
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
        roles: [_enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Administrator, _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Head // roleEnum.UpiCurator
        ],
        children: [{
          icon: '$vuetify.icons.reportsInner',
          title: 'Актуализация бизнеса',
          roles: [_enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Administrator, _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Head],
          to: {
            name: "MIOActualisation"
          }
        }, {
          icon: '$vuetify.icons.reportsInner',
          title: 'Потребности в консультации',
          roles: [_enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Administrator, _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Head],
          to: {
            name: "ConsultationNeeds"
          }
        }, {
          icon: '$vuetify.icons.reportsInner',
          title: 'Отрасли',
          roles: [_enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Administrator, _enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Head],
          to: {
            name: "MIOIndustries"
          }
        }, //   {
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
          roles: [_enums_roleEnum__WEBPACK_IMPORTED_MODULE_0__.default.Administrator],
          to: {
            name: "UsersReport"
          }
        }]
      }]
    };
  },
  computed: _objectSpread(_objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapState)(["barColor", "barImage"])), {}, {
    drawer: {
      get: function get() {
        return this.$store.state.drawer;
      },
      set: function set(val) {
        this.$store.commit("SET_DRAWER", val);
      }
    },
    computedItems: function computedItems() {
      // return this.items.filter((item) => !item.roles || ).map(this.mapItem)
      return this.items.map(this.mapItem).filter(function (item) {
        return item.title;
      });
    },
    profile: function profile() {
      return {
        avatar: true,
        title: this.$vuetify.lang.t("$vuetify.companyName")
      };
    },
    userProfile: function userProfile() {
      return this.$store.getters.user;
    }
  }),
  methods: {
    log: function log(v) {
      console.log(v);
      this.$emit('drawerUpdate', v);
    },
    mapItem: function mapItem(item) {
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
    _mapItem: function _mapItem(item) {
      return _objectSpread(_objectSpread({}, item), {}, {
        children: item.children ? item.children.map(this.mapItem) : undefined,
        title: this.$vuetify.lang.t(item.title)
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[3]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/Drawer.vue?vue&type=style&index=0&lang=sass&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[3]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/Drawer.vue?vue&type=style&index=0&lang=sass& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, ".companyName {\n  line-height: initial !important;\n}\n#core-navigation-drawer .v-list-group__header.v-list-item--active:before {\n  opacity: 0.24;\n}\n#core-navigation-drawer .v-list-item__icon--text, #core-navigation-drawer .v-list-item__icon:first-child {\n  justify-content: center;\n  text-align: center;\n  width: 20px;\n}\n.v-application--is-ltr #core-navigation-drawer .v-list-item__icon--text, .v-application--is-ltr #core-navigation-drawer .v-list-item__icon:first-child {\n  margin-right: 24px;\n  margin-left: 12px !important;\n}\n.v-application--is-rtl #core-navigation-drawer .v-list-item__icon--text, .v-application--is-rtl #core-navigation-drawer .v-list-item__icon:first-child {\n  margin-left: 24px;\n  margin-right: 12px !important;\n}\n#core-navigation-drawer .v-list--dense .v-list-item__icon--text, #core-navigation-drawer .v-list--dense .v-list-item__icon:first-child {\n  margin-top: 10px;\n}\n.v-application--is-ltr #core-navigation-drawer .v-list-group--sub-group .v-list-item {\n  padding-left: 8px;\n}\n.v-application--is-rtl #core-navigation-drawer .v-list-group--sub-group .v-list-item {\n  padding-right: 8px;\n}\n.v-application--is-ltr #core-navigation-drawer .v-list-group--sub-group .v-list-group__header {\n  padding-right: 0;\n}\n.v-application--is-rtl #core-navigation-drawer .v-list-group--sub-group .v-list-group__header {\n  padding-right: 0;\n}\n#core-navigation-drawer .v-list-group--sub-group .v-list-group__header .v-list-item__icon--text {\n  margin-top: 19px;\n  order: 0;\n}\n#core-navigation-drawer .v-list-group--sub-group .v-list-group__header .v-list-group__header__prepend-icon {\n  order: 2;\n}\n.v-application--is-ltr #core-navigation-drawer .v-list-group--sub-group .v-list-group__header .v-list-group__header__prepend-icon {\n  margin-right: 8px;\n}\n.v-application--is-rtl #core-navigation-drawer .v-list-group--sub-group .v-list-group__header .v-list-group__header__prepend-icon {\n  margin-left: 8px;\n}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[3]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/Drawer.vue?vue&type=style&index=0&lang=sass&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[3]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/Drawer.vue?vue&type=style&index=0&lang=sass& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_16_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_16_0_rules_0_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_16_0_rules_0_use_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Drawer_vue_vue_type_style_index_0_lang_sass___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[3]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Drawer.vue?vue&type=style&index=0&lang=sass& */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[3]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/Drawer.vue?vue&type=style&index=0&lang=sass&");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_16_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_16_0_rules_0_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_16_0_rules_0_use_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Drawer_vue_vue_type_style_index_0_lang_sass___WEBPACK_IMPORTED_MODULE_1__.default, options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_16_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_16_0_rules_0_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_16_0_rules_0_use_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Drawer_vue_vue_type_style_index_0_lang_sass___WEBPACK_IMPORTED_MODULE_1__.default.locals || {});

/***/ }),

/***/ "./resources/js/components/core/Drawer.vue":
/*!*************************************************!*\
  !*** ./resources/js/components/core/Drawer.vue ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Drawer_vue_vue_type_template_id_0ad89ff4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Drawer.vue?vue&type=template&id=0ad89ff4& */ "./resources/js/components/core/Drawer.vue?vue&type=template&id=0ad89ff4&");
/* harmony import */ var _Drawer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Drawer.vue?vue&type=script&lang=js& */ "./resources/js/components/core/Drawer.vue?vue&type=script&lang=js&");
/* harmony import */ var _Drawer_vue_vue_type_style_index_0_lang_sass___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Drawer.vue?vue&type=style&index=0&lang=sass& */ "./resources/js/components/core/Drawer.vue?vue&type=style&index=0&lang=sass&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");



;


/* normalize component */

var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__.default)(
  _Drawer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _Drawer_vue_vue_type_template_id_0ad89ff4___WEBPACK_IMPORTED_MODULE_0__.render,
  _Drawer_vue_vue_type_template_id_0ad89ff4___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/core/Drawer.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/core/Drawer.vue?vue&type=script&lang=js&":
/*!**************************************************************************!*\
  !*** ./resources/js/components/core/Drawer.vue?vue&type=script&lang=js& ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Drawer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Drawer.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/Drawer.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Drawer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/components/core/Drawer.vue?vue&type=style&index=0&lang=sass&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/core/Drawer.vue?vue&type=style&index=0&lang=sass& ***!
  \***********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_16_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_16_0_rules_0_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_16_0_rules_0_use_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Drawer_vue_vue_type_style_index_0_lang_sass___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[3]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Drawer.vue?vue&type=style&index=0&lang=sass& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-16[0].rules[0].use[3]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/Drawer.vue?vue&type=style&index=0&lang=sass&");


/***/ }),

/***/ "./resources/js/components/core/Drawer.vue?vue&type=template&id=0ad89ff4&":
/*!********************************************************************************!*\
  !*** ./resources/js/components/core/Drawer.vue?vue&type=template&id=0ad89ff4& ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Drawer_vue_vue_type_template_id_0ad89ff4___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Drawer_vue_vue_type_template_id_0ad89ff4___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Drawer_vue_vue_type_template_id_0ad89ff4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Drawer.vue?vue&type=template&id=0ad89ff4& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/Drawer.vue?vue&type=template&id=0ad89ff4&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/Drawer.vue?vue&type=template&id=0ad89ff4&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/core/Drawer.vue?vue&type=template&id=0ad89ff4& ***!
  \***********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-navigation-drawer",
    _vm._b(
      {
        attrs: {
          id: "core-navigation-drawer",
          dark:
            _vm.barColor !== "rgba(228, 226, 226, 1), rgba(255, 255, 255, 0.7)",
          "expand-on-hover": "",
          color: "#1E3057",
          right: _vm.$vuetify.rtl,
          src: _vm.barImage,
          "mobile-breakpoint": "960",
          app: "",
          width: "260",
          "mini-variant": _vm.mini
        },
        on: {
          "update:miniVariant": function($event) {
            _vm.mini = $event
          },
          "update:mini-variant": [
            function($event) {
              _vm.mini = $event
            },
            _vm.log
          ]
        },
        scopedSlots: _vm._u([
          {
            key: "img",
            fn: function(props) {
              return [_c("v-img", _vm._b({}, "v-img", props, false))]
            }
          },
          {
            key: "activator",
            fn: function(ref) {
              var on = ref.on
              return [
                _c(
                  "div",
                  _vm._g(
                    { staticClass: "top-line__profile", attrs: { dense: "" } },
                    on
                  ),
                  [
                    _c("div", { staticClass: "profile__info" }, [
                      _c("span", { staticClass: "profile__info-name" }, [
                        _vm._v(
                          _vm._s(
                            _vm.userProfile.firstName +
                              " " +
                              _vm.userProfile.lastName
                          )
                        )
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "profile__info-img" }, [
                        _c("img", {
                          attrs: {
                            src: "/images/avatar.png",
                            alt: "Proifle name"
                          }
                        })
                      ])
                    ])
                  ]
                )
              ]
            }
          }
        ]),
        model: {
          value: _vm.drawer,
          callback: function($$v) {
            _vm.drawer = $$v
          },
          expression: "drawer"
        }
      },
      "v-navigation-drawer",
      _vm.$attrs,
      false
    ),
    [
      _vm._v(" "),
      _c("v-divider", { staticClass: "mb-1" }),
      _vm._v(" "),
      _c(
        "v-list",
        { staticClass: "pl-0", attrs: { dense: "", nav: "" } },
        [
          _c(
            "v-list-item",
            [
              _c(
                "v-list-item-content",
                {
                  staticClass: "py-5 d-flex justify-center",
                  staticStyle: { "white-space": "break-spaces" }
                },
                [
                  _c("v-img", {
                    attrs: {
                      src: "/images/light-logo.svg",
                      "max-width": "165",
                      contain: ""
                    }
                  })
                ],
                1
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c("v-divider", { staticClass: "mb-2" }),
      _vm._v(" "),
      _vm._v(" "),
      _c(
        "v-list",
        { staticClass: "pl-0", attrs: { expand: "", nav: "" } },
        [
          _c("div"),
          _vm._v(" "),
          _vm._l(_vm.computedItems, function(item, i) {
            return [
              item.children
                ? _c("base-item-group", {
                    key: "group-" + i,
                    staticStyle: { "white-space": "break-spaces" },
                    attrs: { item: item }
                  })
                : _c("base-item", { key: "item-" + i, attrs: { item: item } })
            ]
          }),
          _vm._v(" "),
          _c("div")
        ],
        2
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);