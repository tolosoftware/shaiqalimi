(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[22],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _DataViewSidebar_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./DataViewSidebar.vue */ "./resources/js/src/views/apps/projects/DataViewSidebar.vue");
/* harmony import */ var _data_list_moduleDataList_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./data-list/moduleDataList.js */ "./resources/js/src/views/apps/projects/data-list/moduleDataList.js");
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


/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'vx-project-featured',
  methods: {
    createNewProject: function createNewProject() {
      this.$router.push('/projects/add').catch(function () {});
    }
  },
  mounted: function mounted() {
    this.isMounted = false;
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/Project.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/apps/projects/Project.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_apexcharts__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-apexcharts */ "./node_modules/vue-apexcharts/dist/vue-apexcharts.js");
/* harmony import */ var vue_apexcharts__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_apexcharts__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _ProjectList_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProjectList.vue */ "./resources/js/src/views/apps/projects/ProjectList.vue");
/* harmony import */ var _FeaturedProjectInfo_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./FeaturedProjectInfo.vue */ "./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue");
/* harmony import */ var _components_statistics_cards_StatisticsCardLine_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @/components/statistics-cards/StatisticsCardLine.vue */ "./resources/js/src/components/statistics-cards/StatisticsCardLine.vue");
/* harmony import */ var _js_analyticsDataProject_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./js/analyticsDataProject.js */ "./resources/js/src/views/apps/projects/js/analyticsDataProject.js");
/* harmony import */ var _components_ChangeTimeDurationDropdown_vue__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @/components/ChangeTimeDurationDropdown.vue */ "./resources/js/src/components/ChangeTimeDurationDropdown.vue");
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






/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      salesBarSession: {
        series: [{
          name: 'Sessions',
          data: [75, 125, 225, 175, 125, 75, 25]
        }],
        analyticsData: {
          session: 2700,
          comparison: {
            str: 'Last 7 Days',
            result: +5.2
          }
        }
      },
      sessionDataTime: 'lastWeek',
      todoToday: {},
      analyticsData: _js_analyticsDataProject_js__WEBPACK_IMPORTED_MODULE_4__["default"]
    };
  },
  components: {
    VueApexCharts: vue_apexcharts__WEBPACK_IMPORTED_MODULE_0___default.a,
    StatisticsCardLine: _components_statistics_cards_StatisticsCardLine_vue__WEBPACK_IMPORTED_MODULE_3__["default"],
    ChangeTimeDurationDropdown: _components_ChangeTimeDurationDropdown_vue__WEBPACK_IMPORTED_MODULE_5__["default"],
    ProjectList: _ProjectList_vue__WEBPACK_IMPORTED_MODULE_1__["default"],
    FeaturedProjectInfo: _FeaturedProjectInfo_vue__WEBPACK_IMPORTED_MODULE_2__["default"]
  },
  created: function created() {
    console.log(this.analyticsData);
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/Project.vue?vue&type=style&index=0&lang=scss&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/apps/projects/Project.vue?vue&type=style&index=0&lang=scss& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "#demo-card-analytics .tasks-today-container .tasks-today__task {\n  transition: background 0.15s ease-out;\n}\n#demo-card-analytics .tasks-today-container .tasks-today__task .tasks-today__actions {\n  display: none;\n}\n[dir] #demo-card-analytics .tasks-today-container .tasks-today__task:hover {\n  background: rgba(var(--vs-primary), 0.04);\n}\n#demo-card-analytics .tasks-today-container .tasks-today__task:hover .tasks-today__actions {\n  display: flex;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/Project.vue?vue&type=style&index=0&lang=scss&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/apps/projects/Project.vue?vue&type=style&index=0&lang=scss& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../../node_modules/css-loader!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/lib??ref--8-2!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Project.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/Project.vue?vue&type=style&index=0&lang=scss&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue?vue&type=template&id=58669d87&":
/*!***********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue?vue&type=template&id=58669d87& ***!
  \***********************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "vx-col w-full" }, [
    _c("div", { staticClass: "vx-row" }, [
      _c("div", { staticClass: "vx-col w-full md:w-1/4 mb-base" }, [
        _c(
          "button",
          {
            staticClass: "shadow-md w-full lg:mt-0 mt-1 cbig-btn c-button",
            attrs: { title: "افزودن پروژه جدید" },
            on: { click: _vm.createNewProject }
          },
          [
            _c(
              "svg",
              {
                attrs: {
                  width: "10em",
                  height: "10em",
                  xmlns: "http://www.w3.org/2000/svg",
                  viewBox: "0 0 512 512"
                }
              },
              [
                _c("path", {
                  attrs: {
                    d:
                      "M320 336c0 8.84-7.16 16-16 16h-96c-8.84 0-16-7.16-16-16v-48H0v144c0 25.6 22.4 48 48 48h416c25.6 0 48-22.4 48-48V288H320v48zm144-208h-80V80c0-25.6-22.4-48-48-48H176c-25.6 0-48 22.4-48 48v48H48c-25.6 0-48 22.4-48 48v80h512v-80c0-25.6-22.4-48-48-48zm-144 0H192V96h128v32z"
                  }
                })
              ]
            )
          ]
        )
      ]),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-1/4 mb-base" },
        [
          _c(
            "vx-card",
            { attrs: { title: "آخرین پروژه ها" } },
            [
              _c(
                "template",
                { slot: "actions" },
                [
                  _c("feather-icon", {
                    attrs: {
                      icon: "HelpCircleIcon",
                      svgClasses: "w-6 h-6 text-grey"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c("div", { staticClass: "mt-base" }, [
                _c(
                  "div",
                  { staticClass: "mt-4" },
                  [
                    _c("div", { staticClass: "flex justify-between" }, [
                      _c("div", { staticClass: "flex flex-col" }, [
                        _c("span", { staticClass: "mb-1" }, [_vm._v("دیزل")]),
                        _vm._v(" "),
                        _c("h4", [_vm._v("۷۴%")])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "flex flex-col text-right" }, [
                        _c("span", { staticClass: "flex -mr-1" }, [
                          _c("span", { staticClass: "mr-1" }, [
                            _vm._v("زمان ورود")
                          ])
                        ]),
                        _vm._v(" "),
                        _c("span", { staticClass: "text-grey" }, [
                          _vm._v("۲۲:۳۴")
                        ])
                      ])
                    ]),
                    _vm._v(" "),
                    _c("vs-progress", {
                      attrs: { percent: 74, color: "success" }
                    })
                  ],
                  1
                )
              ])
            ],
            2
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-1/4 mb-base" },
        [
          _c(
            "vx-card",
            { attrs: { title: "تانگ تیل" } },
            [
              _c(
                "template",
                { slot: "actions" },
                [
                  _c("feather-icon", {
                    attrs: {
                      icon: "HelpCircleIcon",
                      svgClasses: "w-6 h-6 text-grey"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c("div", { staticClass: "mt-base" }, [
                _c(
                  "div",
                  { staticClass: "mt-4" },
                  [
                    _c("div", { staticClass: "flex justify-between" }, [
                      _c("div", { staticClass: "flex flex-col" }, [
                        _c("span", { staticClass: "mb-1" }, [_vm._v("گاز")]),
                        _vm._v(" "),
                        _c("h4", [_vm._v("۴۴%")])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "flex flex-col text-right" }, [
                        _c("span", { staticClass: "flex -mr-1" }, [
                          _c("span", { staticClass: "mr-1" }, [
                            _vm._v("زمان ورود")
                          ])
                        ]),
                        _vm._v(" "),
                        _c("span", { staticClass: "text-grey" }, [
                          _vm._v("۱۲:۳۴")
                        ])
                      ])
                    ]),
                    _vm._v(" "),
                    _c("vs-progress", {
                      attrs: { percent: 44, color: "success" }
                    })
                  ],
                  1
                )
              ])
            ],
            2
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-1/4 mb-base" },
        [
          _c(
            "vx-card",
            { attrs: { title: "انتقالات امروز" } },
            [
              _c(
                "template",
                { slot: "actions" },
                [
                  _c("feather-icon", {
                    attrs: {
                      icon: "HelpCircleIcon",
                      svgClasses: "w-6 h-6 text-grey"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c("div", { staticClass: "mt-base" }, [
                _c(
                  "div",
                  { staticClass: "mt-4" },
                  [
                    _c("div", { staticClass: "flex justify-between" }, [
                      _c("div", { staticClass: "flex flex-col" }, [
                        _c("span", { staticClass: "mb-1" }, [
                          _vm._v("موبلایل")
                        ]),
                        _vm._v(" "),
                        _c("h4", [_vm._v("۸۴%")])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "flex flex-col text-right" }, [
                        _c("span", { staticClass: "flex -mr-1" }, [
                          _c("span", { staticClass: "mr-1" }, [
                            _vm._v("زمان ورود")
                          ])
                        ]),
                        _vm._v(" "),
                        _c("span", { staticClass: "text-grey" }, [
                          _vm._v("۰۸:۳۴")
                        ])
                      ])
                    ]),
                    _vm._v(" "),
                    _c("vs-progress", { attrs: { percent: 84 } })
                  ],
                  1
                )
              ])
            ],
            2
          )
        ],
        1
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/Project.vue?vue&type=template&id=d931e172&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/apps/projects/Project.vue?vue&type=template&id=d931e172& ***!
  \***********************************************************************************************************************************************************************************************************************/
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
    "div",
    { staticClass: "vx-row" },
    [
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-1/2 mb-base" },
        [
          _c(
            "vx-card",
            [
              _c(
                "div",
                { staticClass: "vx-row flex-col-reverse lg:flex-row" },
                [
                  _vm.salesBarSession.analyticsData
                    ? _c(
                        "div",
                        {
                          staticClass:
                            "vx-col w-full lg:w-1/2 xl:w-1/2 flex flex-col justify-between"
                        },
                        [
                          _c("div", [
                            _c("h2", { staticClass: "mb-1 font-bold" }, [
                              _vm._v("اعلانات")
                            ])
                          ]),
                          _vm._v(" "),
                          _c(
                            "router-link",
                            { attrs: { to: "advertisment" } },
                            [
                              _c(
                                "vs-button",
                                {
                                  staticClass: "shadow-md w-full lg:mt-0 mt-4",
                                  attrs: {
                                    "icon-pack": "feather",
                                    icon: "icon-chevrons-left",
                                    "icon-after": ""
                                  }
                                },
                                [_vm._v("ثبت اعلان جدید")]
                              )
                            ],
                            1
                          )
                        ],
                        1
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass:
                        "vx-col w-full lg:w-1/2 xl:w-1/2 flex flex-col lg:mb-0 mb-base"
                    },
                    [
                      _c("change-time-duration-dropdown", {
                        staticClass: "self-end"
                      }),
                      _vm._v(" "),
                      _vm.salesBarSession.series
                        ? _c("vue-apex-charts", {
                            attrs: {
                              type: "bar",
                              height: "200",
                              options: _vm.analyticsData.salesBar.chartOptions,
                              series: _vm.salesBarSession.series
                            }
                          })
                        : _vm._e()
                    ],
                    1
                  )
                ]
              ),
              _vm._v(" "),
              _c("vs-divider", { staticClass: "my-6" }),
              _vm._v(" "),
              _c("div", { staticClass: "vx-row" }, [
                _c(
                  "div",
                  { staticClass: "vx-col w-1/2 mb-3" },
                  [
                    _c("small", [_vm._v("همه اعلانات: ۳۲۷")]),
                    _vm._v(" "),
                    _c("vs-progress", {
                      staticClass: "block mt-1",
                      attrs: { percent: 50, color: "primary" }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "vx-col w-1/2 mb-3" },
                  [
                    _c("small", [_vm._v("علانات موجود: ۷۳")]),
                    _vm._v(" "),
                    _c("vs-progress", {
                      staticClass: "block mt-1",
                      attrs: { percent: 90, color: "success" }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "vx-col w-1/2 mb-3" },
                  [
                    _c("small", [_vm._v("اعلانات جدید: ۱۰۰")]),
                    _vm._v(" "),
                    _c("vs-progress", {
                      staticClass: "block mt-1",
                      attrs: { percent: 60, color: "warning" }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "vx-col w-1/2 mb-3" },
                  [
                    _c("small", [_vm._v("افزایش یافته: ۷۸%")]),
                    _vm._v(" "),
                    _c("vs-progress", {
                      staticClass: "block mt-1",
                      attrs: { percent: 70, color: "danger" }
                    })
                  ],
                  1
                )
              ])
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-1/2 mb-base" },
        [
          _c(
            "vx-card",
            [
              _c(
                "div",
                { staticClass: "vx-row flex-col-reverse lg:flex-row" },
                [
                  _vm.salesBarSession.analyticsData
                    ? _c(
                        "div",
                        {
                          staticClass:
                            "vx-col w-full lg:w-1/2 xl:w-1/2 flex flex-col justify-between"
                        },
                        [
                          _c("div", [
                            _c("h2", { staticClass: "mb-1 font-bold" }, [
                              _vm._v("پیشنهادات")
                            ])
                          ])
                        ]
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass:
                        "vx-col w-full lg:w-1/2 xl:w-1/2 flex flex-col lg:mb-0 mb-base"
                    },
                    [
                      _c("change-time-duration-dropdown", {
                        staticClass: "self-end"
                      }),
                      _vm._v(" "),
                      _vm.salesBarSession.series
                        ? _c("vue-apex-charts", {
                            attrs: {
                              type: "bar",
                              height: "200",
                              options: _vm.analyticsData.salesBar.chartOptions,
                              series: _vm.salesBarSession.series
                            }
                          })
                        : _vm._e()
                    ],
                    1
                  )
                ]
              ),
              _vm._v(" "),
              _c("vs-divider", { staticClass: "my-6" }),
              _vm._v(" "),
              _c("div", { staticClass: "vx-row" }, [
                _c(
                  "div",
                  { staticClass: "vx-col w-1/2 mb-3" },
                  [
                    _c("small", [_vm._v("همه پشنهادات: ۳۴۲")]),
                    _vm._v(" "),
                    _c("vs-progress", {
                      staticClass: "block mt-1",
                      attrs: { percent: 50, color: "primary" }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "vx-col w-1/2 mb-3" },
                  [
                    _c("small", [_vm._v("پیشنهاد جدید: ۱۰۰")]),
                    _vm._v(" "),
                    _c("vs-progress", {
                      staticClass: "block mt-1",
                      attrs: { percent: 60, color: "warning" }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "vx-col w-1/2 mb-3" },
                  [
                    _c("small", [_vm._v("پشنهادات این ماه: ۸")]),
                    _vm._v(" "),
                    _c("vs-progress", {
                      staticClass: "block mt-1",
                      attrs: { percent: 70, color: "danger" }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "vx-col w-1/2 mb-3" },
                  [
                    _c(
                      "router-link",
                      { attrs: { to: "proposal" } },
                      [
                        _c(
                          "vs-button",
                          {
                            staticClass: "shadow-md w-full lg:mt-0 mt-1",
                            attrs: {
                              "icon-pack": "feather",
                              icon: "icon-chevrons-left",
                              "icon-after": ""
                            }
                          },
                          [_vm._v("ثبت پیشنهاد جدید")]
                        )
                      ],
                      1
                    )
                  ],
                  1
                )
              ])
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c("FeaturedProjectInfo"),
      _vm._v(" "),
      _c("ProjectList")
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue":
/*!**********************************************************************!*\
  !*** ./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _FeaturedProjectInfo_vue_vue_type_template_id_58669d87___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./FeaturedProjectInfo.vue?vue&type=template&id=58669d87& */ "./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue?vue&type=template&id=58669d87&");
/* harmony import */ var _FeaturedProjectInfo_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./FeaturedProjectInfo.vue?vue&type=script&lang=js& */ "./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _FeaturedProjectInfo_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _FeaturedProjectInfo_vue_vue_type_template_id_58669d87___WEBPACK_IMPORTED_MODULE_0__["render"],
  _FeaturedProjectInfo_vue_vue_type_template_id_58669d87___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/apps/projects/FeaturedProjectInfo.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_FeaturedProjectInfo_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./FeaturedProjectInfo.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_FeaturedProjectInfo_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue?vue&type=template&id=58669d87&":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue?vue&type=template&id=58669d87& ***!
  \*****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FeaturedProjectInfo_vue_vue_type_template_id_58669d87___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./FeaturedProjectInfo.vue?vue&type=template&id=58669d87& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/FeaturedProjectInfo.vue?vue&type=template&id=58669d87&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FeaturedProjectInfo_vue_vue_type_template_id_58669d87___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_FeaturedProjectInfo_vue_vue_type_template_id_58669d87___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/src/views/apps/projects/Project.vue":
/*!**********************************************************!*\
  !*** ./resources/js/src/views/apps/projects/Project.vue ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Project_vue_vue_type_template_id_d931e172___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Project.vue?vue&type=template&id=d931e172& */ "./resources/js/src/views/apps/projects/Project.vue?vue&type=template&id=d931e172&");
/* harmony import */ var _Project_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Project.vue?vue&type=script&lang=js& */ "./resources/js/src/views/apps/projects/Project.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Project_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Project.vue?vue&type=style&index=0&lang=scss& */ "./resources/js/src/views/apps/projects/Project.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Project_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Project_vue_vue_type_template_id_d931e172___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Project_vue_vue_type_template_id_d931e172___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/apps/projects/Project.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/apps/projects/Project.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/js/src/views/apps/projects/Project.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Project_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Project.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/Project.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Project_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/apps/projects/Project.vue?vue&type=style&index=0&lang=scss&":
/*!********************************************************************************************!*\
  !*** ./resources/js/src/views/apps/projects/Project.vue?vue&type=style&index=0&lang=scss& ***!
  \********************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Project_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader!../../../../../../node_modules/css-loader!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/lib??ref--8-2!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Project.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/Project.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Project_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Project_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Project_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Project_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_Project_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/src/views/apps/projects/Project.vue?vue&type=template&id=d931e172&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/src/views/apps/projects/Project.vue?vue&type=template&id=d931e172& ***!
  \*****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Project_vue_vue_type_template_id_d931e172___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Project.vue?vue&type=template&id=d931e172& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/projects/Project.vue?vue&type=template&id=d931e172&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Project_vue_vue_type_template_id_d931e172___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Project_vue_vue_type_template_id_d931e172___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/src/views/apps/projects/js/analyticsDataProject.js":
/*!*************************************************************************!*\
  !*** ./resources/js/src/views/apps/projects/js/analyticsDataProject.js ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/*=========================================================================================
  File Name: analyticsData.vue
  Description: Data shown by charts
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
/* harmony default export */ __webpack_exports__["default"] = ({
  // LINE CHART
  siteTraffic: {
    series: [{
      name: 'Traffic Rate',
      data: [150, 200, 125, 225, 200, 250]
    }],
    chartOptions: {
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
      chart: {
        type: 'line',
        dropShadow: {
          enabled: true,
          top: 5,
          left: 0,
          blur: 4,
          opacity: 0.10
        },
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      stroke: {
        width: 5,
        curve: 'smooth'
      },
      xaxis: {
        type: 'numeric'
      },
      colors: ['#7367F0'],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          gradientToColors: ['#A9A2F6'],
          shadeIntensity: 1,
          type: 'horizontal',
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100, 100, 100]
        }
      },
      markers: {
        size: 0,
        hover: {
          size: 5
        }
      },
      tooltip: {
        x: {
          show: false
        }
      }
    }
  },
  activeUsers: {
    series: [{
      name: 'Active Users',
      data: [750, 1000, 900, 1250, 1000, 1200, 1100]
    }],
    chartOptions: {
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
      chart: {
        type: 'line',
        dropShadow: {
          enabled: true,
          top: 5,
          left: 0,
          blur: 4,
          opacity: 0.10
        },
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      stroke: {
        width: 5,
        curve: 'smooth'
      },
      xaxis: {
        type: 'numeric'
      },
      colors: ['#28C76F'],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          gradientToColors: ['#55DD92'],
          shadeIntensity: 1,
          type: 'horizontal',
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 75, 100, 100]
        }
      },
      markers: {
        size: 0,
        hover: {
          size: 5
        }
      },
      tooltip: {
        x: {
          show: false
        }
      }
    }
  },
  newsletter: {
    series: [{
      name: 'Newsletter',
      data: [365, 390, 365, 400, 375, 400]
    }],
    chartOptions: {
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
      chart: {
        type: 'line',
        dropShadow: {
          enabled: true,
          top: 5,
          left: 0,
          blur: 4,
          opacity: 0.10
        },
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      stroke: {
        width: 5,
        curve: 'smooth'
      },
      xaxis: {
        type: 'numeric'
      },
      colors: ['#FF9F43'],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          gradientToColors: ['#ffc085'],
          shadeIntensity: 1,
          type: 'horizontal',
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 75, 100, 100]
        }
      },
      markers: {
        size: 0,
        hover: {
          size: 5
        }
      },
      tooltip: {
        x: {
          show: false
        }
      }
    }
  },
  revenueComparisonLine: {
    // series: [{
    //         name: "This Month",
    //         data: [45000, 47000, 44800, 47500, 45500, 48000, 46500, 48600]
    //     },
    //     {
    //         name: "Last Month",
    //         data: [46000, 48000, 45500, 46600, 44500, 46500, 45000, 47000]
    //     }
    // ],
    chartOptions: {
      chart: {
        toolbar: {
          show: false
        },
        dropShadow: {
          enabled: true,
          top: 5,
          left: 0,
          blur: 4,
          opacity: 0.10
        }
      },
      stroke: {
        curve: 'smooth',
        dashArray: [0, 8],
        width: [4, 2]
      },
      grid: {
        borderColor: '#e7e7e7'
      },
      legend: {
        show: false
      },
      colors: ['#F97794', '#b8c2cc'],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          inverseColors: false,
          gradientToColors: ['#7367F0', '#b8c2cc'],
          shadeIntensity: 1,
          type: 'horizontal',
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100, 100, 100]
        }
      },
      markers: {
        size: 0,
        hover: {
          size: 5
        }
      },
      xaxis: {
        labels: {
          style: {
            cssClass: 'text-grey fill-current'
          }
        },
        axisTicks: {
          show: false
        },
        categories: ['01', '05', '09', '13', '17', '21', '26', '31'],
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        tickAmount: 5,
        labels: {
          style: {
            cssClass: 'text-grey fill-current'
          },
          formatter: function formatter(val) {
            return val > 999 ? "".concat((val / 1000).toFixed(1), "k") : val;
          }
        }
      },
      tooltip: {
        x: {
          show: false
        }
      }
    }
  },
  // LINE AREA CHART
  subscribersGained: {
    series: [{
      name: 'Subscribers',
      data: [28, 40, 36, 52, 38, 60, 55]
    }],
    chartOptions: {
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
      chart: {
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 2.5
      },
      fill: {
        type: 'gradient',
        gradient: {
          shadeIntensity: 0.9,
          opacityFrom: 0.7,
          opacityTo: 0.5,
          stops: [0, 80, 100]
        }
      },
      xaxis: {
        type: 'numeric',
        lines: {
          show: false
        },
        axisBorder: {
          show: false
        },
        labels: {
          show: false
        }
      },
      yaxis: [{
        y: 0,
        offsetX: 0,
        offsetY: 0,
        padding: {
          left: 0,
          right: 0
        }
      }],
      tooltip: {
        x: {
          show: false
        }
      }
    }
  },
  quarterlySales: {
    series: [{
      name: 'Sales',
      data: [10, 15, 7, 12, 3, 16]
    }],
    chartOptions: {
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
      chart: {
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 2.5
      },
      fill: {
        type: 'gradient',
        gradient: {
          shadeIntensity: 0.9,
          opacityFrom: 0.7,
          opacityTo: 0.5,
          stops: [0, 80, 100]
        }
      },
      xaxis: {
        type: 'numeric',
        lines: {
          show: false
        },
        axisBorder: {
          show: false
        },
        labels: {
          show: false
        }
      },
      yaxis: [{
        y: 0,
        offsetX: 0,
        offsetY: 0,
        padding: {
          left: 0,
          right: 0
        }
      }],
      tooltip: {
        x: {
          show: false
        }
      }
    }
  },
  revenueGenerated: {
    series: [{
      name: 'Revenue',
      data: [350, 275, 400, 300, 350, 300, 450]
    }],
    chartOptions: {
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
      chart: {
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 2.5
      },
      fill: {
        type: 'gradient',
        gradient: {
          shadeIntensity: 0.9,
          opacityFrom: 0.7,
          opacityTo: 0.5,
          stops: [0, 80, 100]
        }
      },
      xaxis: {
        type: 'numeric',
        lines: {
          show: false
        },
        axisBorder: {
          show: false
        },
        labels: {
          show: false
        }
      },
      yaxis: [{
        y: 0,
        offsetX: 0,
        offsetY: 0,
        padding: {
          left: 0,
          right: 0
        }
      }],
      tooltip: {
        x: {
          show: false
        }
      }
    }
  },
  ordersRecevied: {
    series: [{
      name: 'Orders',
      data: [10, 15, 8, 15, 7, 12, 8]
    }],
    chartOptions: {
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
      chart: {
        toolbar: {
          show: false
        },
        sparkline: {
          enabled: true
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 2.5
      },
      fill: {
        type: 'gradient',
        gradient: {
          shadeIntensity: 0.9,
          opacityFrom: 0.7,
          opacityTo: 0.5,
          stops: [0, 80, 100]
        }
      },
      xaxis: {
        type: 'numeric',
        lines: {
          show: false
        },
        axisBorder: {
          show: false
        },
        labels: {
          show: false
        }
      },
      yaxis: [{
        y: 0,
        offsetX: 0,
        offsetY: 0,
        padding: {
          left: 0,
          right: 0
        }
      }],
      tooltip: {
        x: {
          show: false
        }
      }
    }
  },
  // BAR CHART
  salesBar: {
    // series: [{
    //     name: 'Sessions',
    //     data: [75, 125, 225, 175, 125, 75, 25]
    // }],
    chartOptions: {
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      },
      chart: {
        type: 'bar',
        sparkline: {
          enabled: true
        },
        toolbar: {
          show: false
        }
      },
      states: {
        hover: {
          filter: 'none'
        }
      },
      colors: ['rgba(115,103,240,0.15)', 'rgba(115,103,240,0.15)', '#7367f0', 'rgba(115,103,240,0.15)', 'rgba(115,103,240,0.15)', 'rgba(115,103,240,0.15)'],
      plotOptions: {
        bar: {
          columnWidth: '45%',
          distributed: true,
          endingShape: 'rounded' // Deprecated
          // borderRadius: '20px', // Coming Soon

        }
      },
      tooltip: {
        x: {
          show: false
        }
      }
    }
  },
  // RADIAL BAR
  goalOverviewRadialBar: {
    // series: [83],
    chartOptions: {
      plotOptions: {
        radialBar: {
          size: 110,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: '77%'
          },
          track: {
            background: '#bfc5cc',
            strokeWidth: '50%'
          },
          dataLabels: {
            name: {
              show: false
            },
            value: {
              offsetY: 18,
              color: '#99a2ac',
              fontSize: '4rem'
            }
          }
        }
      },
      colors: ['#00db89'],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          type: 'horizontal',
          shadeIntensity: 0.5,
          gradientToColors: ['#00b5b5'],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100]
        }
      },
      stroke: {
        lineCap: 'round'
      },
      chart: {
        sparkline: {
          enabled: true
        },
        dropShadow: {
          enabled: true,
          blur: 3,
          left: 1,
          top: 1,
          opacity: 0.1
        }
      }
    }
  },
  supportTrackerRadialBar: {
    // chartData: {
    //     totalTickets: 163,
    //     openTickets: 103,
    //     lastResponse: '1d',
    // },
    // series: [83],
    chartOptions: {
      plotOptions: {
        radialBar: {
          size: 158,
          offsetY: -30,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: '65%'
          },
          track: {
            background: 'rgba(0,0,0,0)',
            strokeWidth: '100%'
          },
          dataLabels: {
            value: {
              offsetY: 30,
              color: '#99a2ac',
              fontSize: '2rem'
            }
          }
        }
      },
      colors: ['#EA5455'],
      fill: {
        type: 'gradient',
        gradient: {
          // enabled: true,
          shade: 'dark',
          type: 'horizontal',
          shadeIntensity: 0.5,
          gradientToColors: ['#7367F0'],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100]
        }
      },
      stroke: {
        dashArray: 8
      },
      chart: {
        sparkline: {}
      },
      labels: ['Completed Tickets']
    }
  },
  // RADAR
  statisticsRadar: {
    // series: [{
    //     name: 'Visits',
    //     data: [90, 50, 86, 40, 100, 20],
    // }, {
    //     name: 'Sales',
    //     data: [70, 75, 70, 76, 20, 85],
    // }],
    chartOptions: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      dataLabels: {
        style: {
          colors: ['#b9c3cd', '#b9c3cd', '#b9c3cd', '#b9c3cd', '#b9c3cd', '#b9c3cd']
        }
      },
      yaxis: {
        show: false
      },
      grid: {
        show: false
      },
      legend: {
        show: false
      },
      chart: {
        dropShadow: {
          enabled: true,
          blur: 8,
          left: 1,
          top: 1,
          opacity: 0.2
        },
        toolbar: {
          show: false
        }
      },
      stroke: {
        width: 0
      },
      colors: ['#9f8ed7', '#1edec5'],
      plotOptions: {
        radar: {
          polygons: {
            strokeColors: ['#e8e8e8', 'transparent', 'transparent', 'transparent', 'transparent', 'transparent'],
            connectorColors: 'transparent'
          }
        }
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          gradientToColors: ['#8e9ad6', '#1fcadb'],
          shadeIntensity: 1,
          type: 'horizontal',
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100, 100, 100]
        }
      },
      markers: {
        size: 0
      }
    }
  },
  // SessionsByDevice
  sessionsByDeviceDonut: {
    // analyticsData: [
    //     { device: 'Dekstop', icon: 'MonitorIcon', color: 'primary', sessionsPercentgae: 58.6, comparedResultPercentage: 2 },
    //     { device: 'Mobile', icon: 'SmartphoneIcon', color: 'warning', sessionsPercentgae: 34.9, comparedResultPercentage: 8 },
    //     { device: 'Tablet', icon: 'TabletIcon', color: 'danger', sessionsPercentgae: 6.5, comparedResultPercentage: -5 },
    // ],
    // comparedResult: [2, -3, 8],
    // series: [58.6, 34.9, 6.5],
    chartOptions: {
      labels: ['Desktop', 'Mobile', 'Tablet'],
      dataLabels: {
        enabled: false
      },
      legend: {
        show: false
      },
      chart: {
        offsetY: 30,
        type: 'donut',
        toolbar: {
          show: false
        }
      },
      stroke: {
        width: 0
      },
      colors: ['#7961F9', '#FF9F43', '#EA5455'],
      fill: {
        type: 'gradient',
        gradient: {
          gradientToColors: ['#9c8cfc', '#FFC085', '#f29292']
        }
      }
    }
  },
  // Product Orders
  productOrdersRadialBar: {
    // analyticsData: [
    //     { 'orderType': 'Finished', 'counts': 23043, color: 'primary' },
    //     { 'orderType': 'Pending', 'counts': 14658, color: 'warning' },
    //     { 'orderType': 'Rejected ', 'counts': 4758, color: 'danger' },
    // ],
    // series: [70, 52, 26],
    chartOptions: {
      labels: ['Finished', 'Pending', 'Rejected'],
      plotOptions: {
        radialBar: {
          size: 165,
          offsetY: -5,
          hollow: {
            size: '20%'
          },
          track: {
            background: '#ebebeb',
            strokeWidth: '100%',
            margin: 15
          },
          dataLabels: {
            show: true,
            name: {
              fontSize: '18px'
            },
            value: {
              fontSize: '16px',
              color: '#636a71',
              offsetY: 11
            },
            total: {
              show: true,
              label: 'Total',
              formatter: function formatter() {
                return 42459;
              }
            }
          }
        }
      },
      responsive: [{
        breakpoint: 576,
        options: {
          plotOptions: {
            radialBar: {
              size: 150,
              hollow: {
                size: '20%'
              },
              track: {
                background: '#ebebeb',
                strokeWidth: '100%',
                margin: 15
              }
            }
          }
        }
      }],
      colors: ['#7961F9', '#FF9F43', '#EA5455'],
      fill: {
        type: 'gradient',
        gradient: {
          // enabled: true,
          shade: 'dark',
          type: 'vertical',
          shadeIntensity: 0.5,
          gradientToColors: ['#9c8cfc', '#FFC085', '#f29292'],
          inverseColors: false,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100]
        }
      },
      stroke: {
        lineCap: 'round'
      },
      chart: {
        height: 355,
        dropShadow: {
          enabled: true,
          blur: 3,
          left: 1,
          top: 1,
          opacity: 0.1
        }
      }
    }
  },
  // Customers
  customersPie: {
    // analyticsData: [
    //     { 'customerType': 'New', 'counts': 890, color: 'primary' },
    //     { 'customerType': 'Returning', 'counts': 258, color: 'warning' },
    //     { 'customerType': 'Referrals ', 'counts': 149, color: 'danger' },
    // ],
    // series: [690, 258, 149],
    chartOptions: {
      labels: ['New', 'Returning', 'Referrals'],
      dataLabels: {
        enabled: false
      },
      legend: {
        show: false
      },
      chart: {
        type: 'pie',
        offsetY: 0,
        dropShadow: {
          enabled: false,
          blur: 5,
          left: 1,
          top: 1,
          opacity: 0.2
        },
        toolbar: {
          show: false
        }
      },
      stroke: {
        width: 5
      },
      colors: ['#7961F9', '#FF9F43', '#EA5455'],
      fill: {
        type: 'gradient',
        gradient: {
          gradientToColors: ['#9c8cfc', '#FFC085', '#f29292']
        }
      }
    }
  },
  // Sales monthly
  salesLine: {
    // series: [{
    //     name: "Sales",
    //     data: [140, 180, 150, 205, 160, 295, 125, 255, 205, 305, 240, 295]
    // }],
    chartOptions: {
      chart: {
        toolbar: {
          show: false
        },
        dropShadow: {
          enabled: true,
          top: 20,
          left: 2,
          blur: 6,
          opacity: 0.20
        }
      },
      stroke: {
        curve: 'smooth',
        width: 4
      },
      grid: {
        borderColor: '#ebebeb'
      },
      legend: {
        show: false
      },
      colors: ['#df87f2'],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          inverseColors: false,
          gradientToColors: ['#7367F0'],
          shadeIntensity: 1,
          type: 'horizontal',
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100, 100, 100]
        }
      },
      markers: {
        size: 0,
        hover: {
          size: 5
        }
      },
      xaxis: {
        labels: {
          style: {
            cssClass: 'text-grey fill-current'
          }
        },
        axisTicks: {
          show: false
        },
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        tickAmount: 5,
        labels: {
          style: {
            cssClass: 'text-grey fill-current'
          },
          formatter: function formatter(val) {
            return val > 999 ? "".concat((val / 1000).toFixed(1), "k") : val;
          }
        }
      },
      tooltip: {
        x: {
          show: false
        }
      }
    }
  },
  // ClientRetention Bar Chart
  clientRetentionBar: {
    // series: [{
    //     name: 'New Clients',
    //     data: [175, 125, 225, 175, 160, 189, 206, 134, 159, 216, 148, 123]
    // }, {
    //     name: 'Retained Clients',
    //     data: [-144, -155, -141, -167, -122, -143, -158, -107, -126, -131, -140, -137]
    // }],
    chartOptions: {
      grid: {
        borderColor: '#ebebeb',
        padding: {
          left: 0,
          right: 0
        }
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      chart: {
        stacked: true,
        type: 'bar',
        toolbar: {
          show: false
        }
      },
      colors: ['#7367F0', '#EA5455'],
      plotOptions: {
        bar: {
          columnWidth: '10%'
        }
      },
      xaxis: {
        labels: {
          style: {
            cssClass: 'text-grey fill-current'
          }
        },
        axisTicks: {
          show: false
        },
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        tickAmount: 5,
        labels: {
          style: {
            cssClass: 'text-grey fill-current'
          }
        }
      },
      tooltip: {
        x: {
          show: false
        }
      }
    }
  },
  // OTHER
  browserAnalytics: [{
    id: 1,
    name: 'Google Chrome',
    ratio: 73,
    time: 'Mon Dec 10 2018 07:46:05 GMT+0000 (GMT)',
    comparedResult: '800'
  }, {
    id: 3,
    name: 'Opera',
    ratio: 8,
    time: 'Mon Dec 10 2018 07:46:05 GMT+0000 (GMT)',
    comparedResult: '-200'
  }, {
    id: 2,
    name: 'Firefox',
    ratio: 19,
    time: 'Mon Dec 10 2018 07:46:05 GMT+0000 (GMT)',
    comparedResult: '100'
  }, {
    id: 4,
    name: 'Internet Explorer',
    ratio: 27,
    time: 'Mon Dec 10 2018 07:46:05 GMT+0000 (GMT)',
    comparedResult: '-450'
  }]
});

/***/ })

}]);