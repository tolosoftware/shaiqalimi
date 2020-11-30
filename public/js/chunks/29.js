(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[29],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/ProjectView.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/apps/projects/ProjectView.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      // init values
      announce: [],
      org: [],
      selectedAnnounce: null,
      selectedOrg: null,
      project: null,
      statusFa: {
        on_hold: "درجریان",
        delivered: "تکمیل",
        canceled: "نا موفق"
      }
    };
  },
  created: function created() {
    this.getProject();
  },
  methods: {
    setAnnounceId: function setAnnounceId(arr) {
      //  trigger a mutation, or dispatch an action  
      this.selectedAnnounce = arr;
    },
    setOrganizationId: function setOrganizationId(arr) {
      //  trigger a mutation, or dispatch an action  
      this.selectedOrg = arr;
    },
    getAnnounces: function getAnnounces() {
      var _this = this;

      console.log(this.project.announce_id);

      if (this.project.announce_id) {
        this.axios.get('/api/announcement/' + this.project.announce_id).then(function (response) {
          _this.announce = response.data; // Finish the Progress Bar

          _this.$vs.loading.close();

          _this.$Progress.set(100);
        });
      } else {
        // Finish the Progress Bar
        this.$vs.loading.close();
        this.$Progress.set(100);
      }
    },
    getOrganizations: function getOrganizations() {
      var _this2 = this;

      console.log(this.project.organization_id);

      if (this.project.organization_id) {
        this.axios.get('/api/organization/' + this.project.organization_id).then(function (response) {
          _this2.org = response.data;

          _this2.getAnnounces();
        });
      } else {
        this.getAnnounces();
      }
    },
    getProject: function getProject() {
      var _this3 = this;

      // Start the Progress Bar
      this.$Progress.start();
      this.$vs.loading({
        type: 'border',
        color: '#432e81'
      });
      this.axios.get('/api/project/' + this.$route.params.id).then(function (response) {
        _this3.project = response.data;

        _this3.getOrganizations();
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/ProjectView.vue?vue&type=template&id=5f1637e8&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/apps/projects/ProjectView.vue?vue&type=template&id=5f1637e8& ***!
  \***************************************************************************************************************************************************************************************************************************/
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
  return _c("div", [
    _c(
      "div",
      { staticClass: "vx-row" },
      [
        _vm.project != null
          ? _c(
              "vx-card",
              [
                _c("div", { staticClass: "vx-row" }, [
                  _c("div", { staticClass: "vx-col w-1/2" }, [
                    _c("h3", [
                      _vm._v("معلومات پروژه " + _vm._s(_vm.project.title))
                    ])
                  ])
                ]),
                _vm._v(" "),
                _c("vs-divider", { staticClass: "my-6" }),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "vx-col lg:w-1/2 w-full" },
                  [
                    _c(
                      "vs-table",
                      {
                        staticClass:
                          "table-striped vs-table vs-table--tbody-table",
                        attrs: { stripe: "", data: [1] }
                      },
                      [
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("title")))]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [_vm._v(_vm._s(_vm.project.title))])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("s_number")))]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [_vm._v(_vm._s(_vm.project.s_number))])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("issue_date")))]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [
                              _vm._v(_vm._s(_vm.project.issue_date))
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("issue_address")))]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [
                              _vm._v(_vm._s(_vm.project.issue_address))
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("type")))]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [_vm._v(_vm._s(_vm.project.type))])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("auth_number")))]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [
                              _vm._v(_vm._s(_vm.project.auth_number))
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("duration")) + " ماه")]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [_vm._v(_vm._s(_vm.project.duration))])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("price")) + " افغانی")]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [_vm._v(_vm._s(_vm.project.price))])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("offer_date")))]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [
                              _vm._v(_vm._s(_vm.project.offer_date))
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("close_date")))]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [
                              _vm._v(_vm._s(_vm.project.close_date))
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("source_address")))]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [
                              _vm._v(_vm._s(_vm.project.source_address))
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [
                                _vm._v(
                                  _vm._s(_vm.$t("offer_price")) + " افغانی"
                                )
                              ]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [
                              _vm._v(_vm._s(_vm.project.offer_price))
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [
                                _vm._v(
                                  _vm._s(_vm.$t("project_price")) + " افغانی"
                                )
                              ]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [
                              _vm._v(_vm._s(_vm.project.project_price))
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("announce_id")))]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [
                              _vm._v(
                                _vm._s(_vm.announce ? _vm.announce.title : "")
                              )
                            ])
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-tr",
                          [
                            _c(
                              "vs-td",
                              { staticClass: "font-semibold pr-10" },
                              [_vm._v(_vm._s(_vm.$t("organization_id")))]
                            ),
                            _vm._v(" "),
                            _c("vs-td", [
                              _vm._v(_vm._s(_vm.org ? _vm.org.title : ""))
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
          : _vm._e()
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/src/views/apps/projects/ProjectView.vue":
/*!**************************************************************!*\
  !*** ./resources/js/src/views/apps/projects/ProjectView.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProjectView_vue_vue_type_template_id_5f1637e8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProjectView.vue?vue&type=template&id=5f1637e8& */ "./resources/js/src/views/apps/projects/ProjectView.vue?vue&type=template&id=5f1637e8&");
/* harmony import */ var _ProjectView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProjectView.vue?vue&type=script&lang=js& */ "./resources/js/src/views/apps/projects/ProjectView.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProjectView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProjectView_vue_vue_type_template_id_5f1637e8___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProjectView_vue_vue_type_template_id_5f1637e8___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/apps/projects/ProjectView.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/apps/projects/ProjectView.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/src/views/apps/projects/ProjectView.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProjectView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProjectView.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/ProjectView.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProjectView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/apps/projects/ProjectView.vue?vue&type=template&id=5f1637e8&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/src/views/apps/projects/ProjectView.vue?vue&type=template&id=5f1637e8& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProjectView_vue_vue_type_template_id_5f1637e8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProjectView.vue?vue&type=template&id=5f1637e8& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/ProjectView.vue?vue&type=template&id=5f1637e8&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProjectView_vue_vue_type_template_id_5f1637e8___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProjectView_vue_vue_type_template_id_5f1637e8___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);