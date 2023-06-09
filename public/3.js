(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[3],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/core/AppBar.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/core/AppBar.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuetify_lib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuetify/lib */ "./node_modules/vuetify/lib/index.js");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

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
// Components
 // Utilities


/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'DashboardCoreAppBar',
  components: {
    AppBarItem: {
      render: function render(h) {
        var _this = this;

        return h(vuetify_lib__WEBPACK_IMPORTED_MODULE_0__["VHover"], {
          scopedSlots: {
            "default": function _default(_ref) {
              var hover = _ref.hover;
              return h(vuetify_lib__WEBPACK_IMPORTED_MODULE_0__["VListItem"], {
                attrs: _this.$attrs,
                "class": {
                  'black--text': !hover,
                  'white--text secondary elevation-12': hover
                },
                props: _objectSpread({
                  activeClass: '',
                  dark: hover,
                  link: true
                }, _this.$attrs)
              }, _this.$slots["default"]);
            }
          }
        });
      }
    }
  },
  props: {
    value: {
      type: Boolean,
      "default": false
    }
  },
  data: function data() {
    return {
      notifications: []
    };
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapState"])(['drawer'])),
  methods: _objectSpread(_objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapMutations"])({
    setDrawer: 'SET_DRAWER'
  })), {}, {
    logout: function logout() {
      var _this2 = this;

      this.$store.dispatch('logoff').then(function () {
        _this2.$router.push({
          name: 'Login'
        });
      });
    },
    changeLanguage: function changeLanguage(lang) {
      this.$cookie.set('kazmyaso_lang', lang);
      this.$router.go(0);
    }
  })
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/core/AppBar.vue?vue&type=template&id=10e278c7&":
/*!**************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/core/AppBar.vue?vue&type=template&id=10e278c7& ***!
  \**************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-app-bar",
    {
      attrs: {
        id: "app-bar",
        absolute: "",
        app: "",
        color: "transparent",
        flat: "",
        height: "75"
      }
    },
    [
      _c(
        "v-btn",
        {
          staticClass: "mr-3",
          attrs: { elevation: "1", fab: "", small: "" },
          on: {
            click: function($event) {
              return _vm.setDrawer(!_vm.drawer)
            }
          }
        },
        [
          _vm.value
            ? _c("v-icon", [_vm._v("\n        mdi-view-quilt\n      ")])
            : _c("v-icon", [_vm._v("\n        mdi-dots-vertical\n      ")])
        ],
        1
      ),
      _vm._v(" "),
      _c("v-toolbar-title", {
        staticClass: "hidden-sm-and-down font-weight-light",
        domProps: {
          textContent: _vm._s(
            _vm.$vuetify.lang.t("$vuetify.page." + _vm.$route.name + ".name")
          )
        }
      }),
      _vm._v(" "),
      _c("v-spacer"),
      _vm._v(" "),
      _c(
        "v-menu",
        {
          attrs: {
            bottom: "",
            left: "",
            "offset-y": "",
            origin: "top right",
            transition: "scale-transition"
          },
          scopedSlots: _vm._u([
            {
              key: "activator",
              fn: function(ref) {
                var attrs = ref.attrs
                var on = ref.on
                return [
                  _c(
                    "v-btn",
                    _vm._g(
                      _vm._b(
                        {
                          staticClass: "ml-2",
                          attrs: { "min-width": "0", text: "" }
                        },
                        "v-btn",
                        attrs,
                        false
                      ),
                      on
                    ),
                    [
                      _vm.notifications.length > 0
                        ? _c(
                            "v-badge",
                            {
                              attrs: {
                                color: "red",
                                overlap: "",
                                bordered: ""
                              },
                              scopedSlots: _vm._u(
                                [
                                  {
                                    key: "badge",
                                    fn: function() {
                                      return [
                                        _c("span", [
                                          _vm._v(
                                            _vm._s(_vm.notifications.length)
                                          )
                                        ])
                                      ]
                                    },
                                    proxy: true
                                  }
                                ],
                                null,
                                true
                              )
                            },
                            [_vm._v(" "), _c("v-icon", [_vm._v("mdi-bell")])],
                            1
                          )
                        : _vm._e()
                    ],
                    1
                  )
                ]
              }
            }
          ])
        },
        [
          _vm._v(" "),
          _c("v-list", { attrs: { tile: false, nav: "" } }, [
            _c(
              "div",
              _vm._l(_vm.notifications, function(n, i) {
                return _c(
                  "app-bar-item",
                  { key: "item-" + i },
                  [
                    _c("v-list-item-title", {
                      domProps: { textContent: _vm._s(n) }
                    })
                  ],
                  1
                )
              }),
              1
            )
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "v-menu",
        {
          attrs: {
            bottom: "",
            left: "",
            "offset-y": "",
            "open-on-hover": "",
            origin: "top right",
            transition: "scale-transition"
          },
          scopedSlots: _vm._u([
            {
              key: "activator",
              fn: function(ref) {
                var attrs = ref.attrs
                var on = ref.on
                return [
                  _c(
                    "v-btn",
                    _vm._g(
                      _vm._b({ attrs: { text: "" } }, "v-btn", attrs, false),
                      on
                    ),
                    [
                      _c("v-icon", [
                        _vm._v(
                          "\n                      mdi-translate\n                  "
                        )
                      ]),
                      _vm._v(" "),
                      _c("v-icon", { attrs: { small: "" } }, [
                        _vm._v(
                          "\n                      mdi-chevron-down\n                  "
                        )
                      ])
                    ],
                    1
                  )
                ]
              }
            }
          ])
        },
        [
          _vm._v(" "),
          _c(
            "v-list",
            { attrs: { nav: "", dense: "" } },
            [
              _c(
                "v-list-item",
                {
                  on: {
                    click: function($event) {
                      return _vm.changeLanguage("kk")
                    }
                  }
                },
                [_c("v-list-item-title", [_vm._v("Қазақ")])],
                1
              ),
              _vm._v(" "),
              _c(
                "v-list-item",
                {
                  on: {
                    click: function($event) {
                      return _vm.changeLanguage("ru")
                    }
                  }
                },
                [_c("v-list-item-title", [_vm._v("Русский")])],
                1
              ),
              _vm._v(" "),
              _c(
                "v-list-item",
                {
                  on: {
                    click: function($event) {
                      return _vm.changeLanguage("en")
                    }
                  }
                },
                [_c("v-list-item-title", [_vm._v("English")])],
                1
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "v-menu",
        {
          scopedSlots: _vm._u([
            {
              key: "activator",
              fn: function(ref) {
                var on = ref.on
                return [
                  _c(
                    "v-btn",
                    _vm._g({ attrs: { text: "", dense: "" } }, on),
                    [_c("v-icon", [_vm._v("mdi-cog-outline")])],
                    1
                  )
                ]
              }
            }
          ])
        },
        [
          _vm._v(" "),
          _c(
            "v-list",
            { attrs: { dense: "" } },
            [
              _c("v-divider"),
              _vm._v(" "),
              _c(
                "v-list-item",
                { on: { click: _vm.logout } },
                [
                  _c(
                    "v-list-item-content",
                    [
                      _c("v-list-item-title", [
                        _vm._v(
                          _vm._s(_vm.$vuetify.lang.t("$vuetify.menu.logout"))
                        )
                      ])
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/core/AppBar.vue":
/*!*************************************************!*\
  !*** ./resources/js/components/core/AppBar.vue ***!
  \*************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AppBar_vue_vue_type_template_id_10e278c7___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AppBar.vue?vue&type=template&id=10e278c7& */ "./resources/js/components/core/AppBar.vue?vue&type=template&id=10e278c7&");
/* harmony import */ var _AppBar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AppBar.vue?vue&type=script&lang=js& */ "./resources/js/components/core/AppBar.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AppBar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AppBar_vue_vue_type_template_id_10e278c7___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AppBar_vue_vue_type_template_id_10e278c7___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/core/AppBar.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/core/AppBar.vue?vue&type=script&lang=js&":
/*!**************************************************************************!*\
  !*** ./resources/js/components/core/AppBar.vue?vue&type=script&lang=js& ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AppBar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./AppBar.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/core/AppBar.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AppBar_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/core/AppBar.vue?vue&type=template&id=10e278c7&":
/*!********************************************************************************!*\
  !*** ./resources/js/components/core/AppBar.vue?vue&type=template&id=10e278c7& ***!
  \********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AppBar_vue_vue_type_template_id_10e278c7___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./AppBar.vue?vue&type=template&id=10e278c7& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/core/AppBar.vue?vue&type=template&id=10e278c7&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AppBar_vue_vue_type_template_id_10e278c7___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AppBar_vue_vue_type_template_id_10e278c7___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);