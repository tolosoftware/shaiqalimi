(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[73],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_apexcharts__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-apexcharts */ "./node_modules/vue-apexcharts/dist/vue-apexcharts.js");
/* harmony import */ var vue_apexcharts__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_apexcharts__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_statistics_cards_StatisticsCardLine_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @/components/statistics-cards/StatisticsCardLine.vue */ "./resources/js/src/components/statistics-cards/StatisticsCardLine.vue");
/* harmony import */ var _analyticsData_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./analyticsData.js */ "./resources/js/src/views/ui-elements/card/analyticsData.js");
/* harmony import */ var _components_ChangeTimeDurationDropdown_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @/components/ChangeTimeDurationDropdown.vue */ "./resources/js/src/components/ChangeTimeDurationDropdown.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
      sessionsData: {},
      productsOrder: {},
      customersData: {},
      salesRadar: {},
      supportTracker: {},
      revenueComparisonLine: {},
      goalOverview: {},
      salesBarSession: {},
      sessionDataTime: 'lastWeek',
      todoToday: {},
      salesLine: {},
      funding: {},
      browserStatistics: [],
      clientRetentionBar: {},
      analyticsData: _analyticsData_js__WEBPACK_IMPORTED_MODULE_2__["default"]
    };
  },
  components: {
    VueApexCharts: vue_apexcharts__WEBPACK_IMPORTED_MODULE_0___default.a,
    StatisticsCardLine: _components_statistics_cards_StatisticsCardLine_vue__WEBPACK_IMPORTED_MODULE_1__["default"],
    ChangeTimeDurationDropdown: _components_ChangeTimeDurationDropdown_vue__WEBPACK_IMPORTED_MODULE_3__["default"]
  },
  created: function created() {
    var _this = this;

    // Sessions By Device
    this.$http.get('/api/card/card-analytics/session-by-device').then(function (response) {
      _this.sessionsData = response.data;
    }).catch(function (error) {
      console.log(error);
    }); // Products Order

    this.$http.get('/api/card/card-analytics/products-orders').then(function (response) {
      _this.productsOrder = response.data;
    }).catch(function (error) {
      console.log(error);
    }); // Customers

    this.$http.get('/api/card/card-analytics/customers').then(function (response) {
      _this.customersData = response.data;
    }).catch(function (error) {
      console.log(error);
    }); // Sales Radar

    this.$http.get('/api/card/card-analytics/sales/radar').then(function (response) {
      _this.salesRadar = response.data;
    }).catch(function (error) {
      console.log(error);
    }); // Support Tracker

    this.$http.get('/api/card/card-analytics/support-tracker').then(function (response) {
      _this.supportTracker = response.data;
    }).catch(function (error) {
      console.log(error);
    }); // Revenue Comparison

    this.$http.get('/api/card/card-analytics/revenue-comparison').then(function (response) {
      _this.revenueComparisonLine = response.data;
    }).catch(function (error) {
      console.log(error);
    }); // Goal Overview

    this.$http.get('/api/card/card-analytics/goal-overview').then(function (response) {
      _this.goalOverview = response.data;
    }).catch(function (error) {
      console.log(error);
    }); // Sales bar

    this.$http.get('/api/card/card-analytics/sales/bar').then(function (response) {
      _this.salesBarSession = response.data;
    }).catch(function (error) {
      console.log(error);
    }); // Todo

    this.$http.get('/api/card/card-analytics/todo/today').then(function (response) {
      _this.todoToday = response.data;
    }).catch(function (error) {
      console.log(error);
    }); // Funding

    this.$http.get('/api/card/card-analytics/funding').then(function (response) {
      _this.funding = response.data;
    }).catch(function (error) {
      console.log(error);
    }); // Sales line

    this.$http.get('/api/card/card-analytics/sales/line').then(function (response) {
      _this.salesLine = response.data;
    }).catch(function (error) {
      console.log(error);
    }); // Browser Analytics

    this.$http.get('/api/card/card-analytics/browser-analytics').then(function (response) {
      _this.browserStatistics = response.data;
    }).catch(function (error) {
      console.log(error);
    }); // Client Retention

    this.$http.get('/api/card/card-analytics/client-retention').then(function (response) {
      _this.clientRetentionBar = response.data;
    }).catch(function (error) {
      console.log(error);
    });
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=style&index=0&lang=scss&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=style&index=0&lang=scss& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "#demo-card-analytics .tasks-today-container .tasks-today__task {\n  transition: background 0.15s ease-out;\n}\n#demo-card-analytics .tasks-today-container .tasks-today__task .tasks-today__actions {\n  display: none;\n}\n[dir] #demo-card-analytics .tasks-today-container .tasks-today__task:hover {\n  background: rgba(var(--vs-primary), 0.04);\n}\n#demo-card-analytics .tasks-today-container .tasks-today__task:hover .tasks-today__actions {\n  display: flex;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=style&index=0&lang=scss&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib??ref--8-2!./node_modules/sass-loader/dist/cjs.js??ref--8-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=style&index=0&lang=scss& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../../node_modules/css-loader!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/lib??ref--8-2!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./CardAnalytics.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=style&index=0&lang=scss&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=template&id=9eb39740&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=template&id=9eb39740& ***!
  \********************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { attrs: { id: "demo-card-analytics" } }, [
    _c("div", { staticClass: "vx-row" }, [
      _c(
        "div",
        { staticClass: "vx-col w-full lg:w-1/3 mb-base" },
        [
          _c(
            "vx-card",
            { attrs: { title: "Sessions By Device" } },
            [
              _c(
                "template",
                { slot: "actions" },
                [_c("change-time-duration-dropdown")],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                { attrs: { slot: "no-body" }, slot: "no-body" },
                [
                  _c("vue-apex-charts", {
                    staticClass: "mb-12 mt-4",
                    attrs: {
                      type: "donut",
                      height: "340",
                      options:
                        _vm.analyticsData.sessionsByDeviceDonut.chartOptions,
                      series: _vm.sessionsData.series
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "ul",
                _vm._l(_vm.sessionsData.analyticsData, function(deviceData) {
                  return _c(
                    "li",
                    { key: deviceData.device, staticClass: "flex mb-3" },
                    [
                      _c("feather-icon", {
                        attrs: {
                          icon: deviceData.icon,
                          svgClasses: [
                            "h-5 w-5 stroke-current text-" + deviceData.color
                          ]
                        }
                      }),
                      _vm._v(" "),
                      _c(
                        "span",
                        { staticClass: "ml-2 inline-block font-semibold" },
                        [_vm._v(_vm._s(deviceData.device))]
                      ),
                      _vm._v(" "),
                      _c("span", { staticClass: "mx-2" }, [_vm._v("-")]),
                      _vm._v(" "),
                      _c("span", { staticClass: "mr-4" }, [
                        _vm._v(_vm._s(deviceData.sessionsPercentage) + "%")
                      ]),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "ml-auto flex -mr-1" },
                        [
                          _c("span", { staticClass: "mr-1" }, [
                            _vm._v(
                              _vm._s(deviceData.comparedResultPercentage) + "%"
                            )
                          ]),
                          _vm._v(" "),
                          _c("feather-icon", {
                            attrs: {
                              icon:
                                deviceData.comparedResultPercentage < 0
                                  ? "ArrowDownIcon"
                                  : "ArrowUpIcon",
                              svgClasses: [
                                deviceData.comparedResultPercentage < 0
                                  ? "text-danger"
                                  : "text-success",
                                "stroke-current h-4 w-4 mb-1 mr-1"
                              ]
                            }
                          })
                        ],
                        1
                      )
                    ],
                    1
                  )
                }),
                0
              )
            ],
            2
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "vx-col w-full lg:w-1/3 mb-base" },
        [
          _c(
            "vx-card",
            { attrs: { title: "Product Orders" } },
            [
              _c(
                "template",
                { slot: "actions" },
                [_c("change-time-duration-dropdown")],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                { attrs: { slot: "no-body" }, slot: "no-body" },
                [
                  _c("vue-apex-charts", {
                    attrs: {
                      type: "radialBar",
                      height: "420",
                      options:
                        _vm.analyticsData.productOrdersRadialBar.chartOptions,
                      series: _vm.productsOrder.series
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "ul",
                _vm._l(_vm.productsOrder.analyticsData, function(orderData) {
                  return _c(
                    "li",
                    {
                      key: orderData.orderType,
                      staticClass: "flex mb-3 justify-between"
                    },
                    [
                      _c("span", { staticClass: "flex items-center" }, [
                        _c("span", {
                          staticClass:
                            "inline-block h-4 w-4 rounded-full mr-2 bg-white border-3 border-solid",
                          class: "border-" + orderData.color
                        }),
                        _vm._v(" "),
                        _c("span", { staticClass: "font-semibold" }, [
                          _vm._v(_vm._s(orderData.orderType))
                        ])
                      ]),
                      _vm._v(" "),
                      _c("span", [_vm._v(_vm._s(orderData.counts))])
                    ]
                  )
                }),
                0
              )
            ],
            2
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "vx-col w-full lg:w-1/3 mb-base" },
        [
          _c(
            "vx-card",
            { attrs: { title: "Customers" } },
            [
              _c(
                "template",
                { slot: "actions" },
                [_c("change-time-duration-dropdown")],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                { attrs: { slot: "no-body" }, slot: "no-body" },
                [
                  _c("vue-apex-charts", {
                    staticClass: "my-12",
                    attrs: {
                      type: "pie",
                      height: "334",
                      options: _vm.analyticsData.customersPie.chartOptions,
                      series: _vm.customersData.series
                    }
                  }),
                  _vm._v(" "),
                  _c(
                    "ul",
                    { staticClass: "mb-1" },
                    _vm._l(_vm.customersData.analyticsData, function(
                      customerData
                    ) {
                      return _c(
                        "li",
                        {
                          key: customerData.customerType,
                          staticClass:
                            "flex justify-between py-3 px-6 border d-theme-border-grey-light border-solid border-r-0 border-l-0 border-b-0"
                        },
                        [
                          _c("span", { staticClass: "flex items-center" }, [
                            _c("span", {
                              staticClass:
                                "inline-block h-3 w-3 rounded-full mr-2",
                              class: "bg-" + customerData.color
                            }),
                            _vm._v(" "),
                            _c("span", { staticClass: "font-semibold" }, [
                              _vm._v(_vm._s(customerData.customerType))
                            ])
                          ]),
                          _vm._v(" "),
                          _c("span", [_vm._v(_vm._s(customerData.counts))])
                        ]
                      )
                    }),
                    0
                  )
                ],
                1
              )
            ],
            2
          )
        ],
        1
      )
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "vx-row" }, [
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-base" },
        [
          _c(
            "vx-card",
            { attrs: { title: "Sales", subtitle: "Last 6 Months" } },
            [
              _c(
                "template",
                { slot: "actions" },
                [
                  _c("feather-icon", {
                    attrs: {
                      icon: "MoreVerticalIcon",
                      svgClasses: "w-6 h-6 text-grey"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c("div", { staticClass: "flex" }, [
                _c("span", { staticClass: "flex items-center" }, [
                  _c("div", {
                    staticClass: "h-3 w-3 rounded-full mr-2 bg-primary"
                  }),
                  _c("span", [_vm._v("Sales")])
                ]),
                _vm._v(" "),
                _c("span", { staticClass: "flex items-center ml-5" }, [
                  _c("div", {
                    staticClass: "h-3 w-3 rounded-full mr-2 bg-success"
                  }),
                  _c("span", [_vm._v("Visits")])
                ])
              ]),
              _vm._v(" "),
              _c(
                "div",
                { attrs: { slot: "no-body-bottom" }, slot: "no-body-bottom" },
                [
                  _c("vue-apex-charts", {
                    attrs: {
                      type: "radar",
                      options: _vm.analyticsData.statisticsRadar.chartOptions,
                      series: _vm.salesRadar.series
                    }
                  })
                ],
                1
              )
            ],
            2
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-base" },
        [
          _c(
            "vx-card",
            { attrs: { title: "Support Tracker" } },
            [
              _c(
                "template",
                { slot: "actions" },
                [_c("change-time-duration-dropdown")],
                1
              ),
              _vm._v(" "),
              _vm.supportTracker.analyticsData
                ? _c("div", { attrs: { slot: "no-body" }, slot: "no-body" }, [
                    _c("div", { staticClass: "vx-row text-center" }, [
                      _c(
                        "div",
                        {
                          staticClass:
                            "vx-col w-full lg:w-1/5 md:w-full sm:w-1/5 flex flex-col justify-between mb-4 lg:order-first md:order-last sm:order-first order-last"
                        },
                        [
                          _c(
                            "div",
                            {
                              staticClass:
                                "lg:ml-6 lg:mt-6 md:mt-0 md:ml-0 sm:ml-6 sm:mt-6"
                            },
                            [
                              _c("h1", { staticClass: "font-bold text-5xl" }, [
                                _vm._v(
                                  _vm._s(
                                    _vm.supportTracker.analyticsData.openTickets
                                  )
                                )
                              ]),
                              _vm._v(" "),
                              _c("small", [_vm._v("Tickets")])
                            ]
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass:
                            "vx-col w-full lg:w-4/5 md:w-full sm:w-4/5 justify-center mx-auto lg:mt-0 md:mt-6 sm:mt-0 mt-6"
                        },
                        [
                          _c("vue-apex-charts", {
                            attrs: {
                              type: "radialBar",
                              height: "385",
                              options:
                                _vm.analyticsData.supportTrackerRadialBar
                                  .chartOptions,
                              series: _vm.supportTracker.series
                            }
                          })
                        ],
                        1
                      )
                    ]),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass:
                          "flex flex-row justify-between px-8 pb-4 mt-2"
                      },
                      _vm._l(_vm.supportTracker.analyticsData.meta, function(
                        val,
                        key
                      ) {
                        return _c(
                          "p",
                          { key: key, staticClass: "text-center" },
                          [
                            _c("span", { staticClass: "block" }, [
                              _vm._v(_vm._s(key))
                            ]),
                            _vm._v(" "),
                            _c(
                              "span",
                              { staticClass: "text-2xl font-semibold" },
                              [_vm._v(_vm._s(val))]
                            )
                          ]
                        )
                      }),
                      0
                    )
                  ])
                : _vm._e()
            ],
            2
          )
        ],
        1
      )
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "vx-row" }, [
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-2/3 mb-base" },
        [
          _c(
            "vx-card",
            { attrs: { title: "Revenue" } },
            [
              _c(
                "template",
                { slot: "actions" },
                [
                  _c("feather-icon", {
                    attrs: {
                      icon: "SettingsIcon",
                      svgClasses: "w-6 h-6 text-grey"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass: "p-6 pb-0",
                  attrs: { slot: "no-body" },
                  slot: "no-body"
                },
                [
                  _vm.revenueComparisonLine.analyticsData
                    ? _c("div", { staticClass: "flex" }, [
                        _c("div", { staticClass: "mr-6" }, [
                          _c("p", { staticClass: "mb-1 font-semibold" }, [
                            _vm._v("This Month")
                          ]),
                          _vm._v(" "),
                          _c("p", { staticClass: "text-3xl text-success" }, [
                            _c("sup", { staticClass: "text-base mr-1" }, [
                              _vm._v("$")
                            ]),
                            _vm._v(
                              _vm._s(
                                _vm.revenueComparisonLine.analyticsData.thisMonth.toLocaleString()
                              )
                            )
                          ])
                        ]),
                        _vm._v(" "),
                        _c("div", [
                          _c("p", { staticClass: "mb-1 font-semibold" }, [
                            _vm._v("Last Month")
                          ]),
                          _vm._v(" "),
                          _c("p", { staticClass: "text-3xl" }, [
                            _c("sup", { staticClass: "text-base mr-1" }, [
                              _vm._v("$")
                            ]),
                            _vm._v(
                              _vm._s(
                                _vm.revenueComparisonLine.analyticsData.lastMonth.toLocaleString()
                              )
                            )
                          ])
                        ])
                      ])
                    : _vm._e(),
                  _vm._v(" "),
                  _c("vue-apex-charts", {
                    attrs: {
                      type: "line",
                      height: "266",
                      options:
                        _vm.analyticsData.revenueComparisonLine.chartOptions,
                      series: _vm.revenueComparisonLine.series
                    }
                  })
                ],
                1
              )
            ],
            2
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-1/3 mb-base" },
        [
          _c(
            "vx-card",
            { attrs: { title: "Goal Overview" } },
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
              _c("template", { slot: "no-body" }, [
                _c(
                  "div",
                  { staticClass: "mt-10" },
                  [
                    _c("vue-apex-charts", {
                      attrs: {
                        type: "radialBar",
                        height: "240",
                        options:
                          _vm.analyticsData.goalOverviewRadialBar.chartOptions,
                        series: _vm.goalOverview.series
                      }
                    })
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _vm.goalOverview.analyticsData
                ? _c(
                    "div",
                    {
                      staticClass: "flex justify-between text-center mt-4",
                      attrs: { slot: "no-body-bottom" },
                      slot: "no-body-bottom"
                    },
                    [
                      _c(
                        "div",
                        {
                          staticClass:
                            "w-1/2 border border-solid d-theme-border-grey-light border-r-0 border-b-0 border-l-0"
                        },
                        [
                          _c("p", { staticClass: "mt-4" }, [
                            _vm._v("Completed")
                          ]),
                          _vm._v(" "),
                          _c(
                            "p",
                            { staticClass: "mb-4 text-3xl font-semibold" },
                            [
                              _vm._v(
                                _vm._s(
                                  _vm.goalOverview.analyticsData.completed.toLocaleString()
                                )
                              )
                            ]
                          )
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass:
                            "w-1/2 border border-solid d-theme-border-grey-light border-r-0 border-b-0"
                        },
                        [
                          _c("p", { staticClass: "mt-4" }, [
                            _vm._v("In Progress")
                          ]),
                          _vm._v(" "),
                          _c(
                            "p",
                            { staticClass: "mb-4 text-3xl font-semibold" },
                            [
                              _vm._v(
                                _vm._s(
                                  _vm.goalOverview.analyticsData.inProgress.toLocaleString()
                                )
                              )
                            ]
                          )
                        ]
                      )
                    ]
                  )
                : _vm._e()
            ],
            2
          )
        ],
        1
      )
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "vx-row" }, [
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
                              _vm._v(
                                _vm._s(
                                  _vm._f("k_formatter")(
                                    _vm.salesBarSession.analyticsData.session
                                  )
                                )
                              )
                            ]),
                            _vm._v(" "),
                            _c("span", { staticClass: "font-medium" }, [
                              _vm._v("Avg Sessions")
                            ]),
                            _vm._v(" "),
                            _c(
                              "p",
                              { staticClass: "mt-2 text-xl font-medium" },
                              [
                                _c(
                                  "span",
                                  {
                                    class:
                                      _vm.salesBarSession.analyticsData
                                        .comparison.result >= 0
                                        ? "text-success"
                                        : "text-danger"
                                  },
                                  [
                                    _vm.salesBarSession.analyticsData.comparison
                                      .result > 0
                                      ? _c("span", [_vm._v("+")])
                                      : _vm._e(),
                                    _vm._v(" "),
                                    _c("span", [
                                      _vm._v(
                                        _vm._s(
                                          _vm.salesBarSession.analyticsData
                                            .comparison.result
                                        )
                                      )
                                    ])
                                  ]
                                ),
                                _vm._v(" "),
                                _c("span", [_vm._v(" vs ")]),
                                _vm._v(" "),
                                _c("span", [
                                  _vm._v(
                                    _vm._s(
                                      _vm.salesBarSession.analyticsData
                                        .comparison.str
                                    )
                                  )
                                ])
                              ]
                            )
                          ]),
                          _vm._v(" "),
                          _c(
                            "vs-button",
                            {
                              staticClass: "shadow-md w-full lg:mt-0 mt-4",
                              attrs: {
                                "icon-pack": "feather",
                                icon: "icon-chevrons-right",
                                "icon-after": ""
                              }
                            },
                            [_vm._v("View Details")]
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
                    _c("small", [_vm._v("Goal: $100000")]),
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
                    _c("small", [_vm._v("Users: 100K")]),
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
                    _c("small", [_vm._v("Retention: 90%")]),
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
                    _c("small", [_vm._v("Duration: 1yr")]),
                    _vm._v(" "),
                    _c("vs-progress", {
                      staticClass: "block mt-1",
                      attrs: { percent: 90, color: "success" }
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
            { staticClass: "overflow-hidden" },
            [
              _c("template", { slot: "no-body" }, [
                _c(
                  "div",
                  {
                    staticClass:
                      "flex justify-between items-center p-6 border border-solid d-theme-border-grey-light border-r-0 border-l-0 border-t-0"
                  },
                  [
                    _c(
                      "div",
                      [
                        _c("p", [
                          _c("span", { staticClass: "font-semibold" }, [
                            _vm._v(
                              _vm._s(_vm.todoToday.numComletedTasks) +
                                " task completed"
                            )
                          ]),
                          _vm._v(" out of " + _vm._s(_vm.todoToday.totalTasks))
                        ]),
                        _vm._v(" "),
                        _c("vs-progress", {
                          attrs: { percent: 20, color: "primary" }
                        })
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c("span", [_vm._v(_vm._s(_vm.todoToday.date))])
                  ]
                ),
                _vm._v(" "),
                _c(
                  "ul",
                  { staticClass: "tasks-today-container" },
                  _vm._l(_vm.todoToday.tasksToday, function(todo) {
                    return _c(
                      "li",
                      {
                        key: todo.id,
                        staticClass: "px-6 py-4 tasks-today__task"
                      },
                      [
                        _c("div", { staticClass: "vx-row" }, [
                          _c(
                            "div",
                            { staticClass: "vx-col w-full sm:w-auto" },
                            [
                              _c(
                                "p",
                                { staticClass: "font-semibold text-lg" },
                                [_vm._v(_vm._s(todo.task))]
                              ),
                              _vm._v(" "),
                              _c("small", [_vm._v(_vm._s(todo.date))])
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            {
                              staticClass:
                                "tasks-today__actions vx-col w-full sm:w-auto ml-auto mt-2 sm:mt-0"
                            },
                            [
                              _c("vs-button", {
                                attrs: {
                                  radius: "",
                                  color: "primary",
                                  type: "border",
                                  "icon-pack": "feather",
                                  icon: "icon-check",
                                  size: "small"
                                }
                              }),
                              _vm._v(" "),
                              _c("vs-button", {
                                staticClass: "ml-3",
                                attrs: {
                                  radius: "",
                                  color: "primary",
                                  type: "border",
                                  "icon-pack": "feather",
                                  icon: "icon-edit-2",
                                  size: "small"
                                }
                              }),
                              _vm._v(" "),
                              _c("vs-button", {
                                staticClass: "ml-3",
                                attrs: {
                                  radius: "",
                                  color: "primary",
                                  type: "border",
                                  "icon-pack": "feather",
                                  icon: "icon-trash",
                                  size: "small"
                                }
                              })
                            ],
                            1
                          )
                        ])
                      ]
                    )
                  }),
                  0
                )
              ])
            ],
            2
          )
        ],
        1
      )
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "vx-row" }, [
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-2/3 lg:w-3/4" },
        [
          _c(
            "vx-card",
            { staticClass: "mb-base", attrs: { title: "Sales" } },
            [
              _c(
                "template",
                { slot: "actions" },
                [
                  _c("feather-icon", {
                    attrs: {
                      icon: "SettingsIcon",
                      svgClasses: "w-6 h-6 text-grey"
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass: "p-6 pb-0",
                  attrs: { slot: "no-body" },
                  slot: "no-body"
                },
                [
                  _c("vue-apex-charts", {
                    attrs: {
                      type: "line",
                      height: "266",
                      options: _vm.analyticsData.salesLine.chartOptions,
                      series: _vm.salesLine.series
                    }
                  })
                ],
                1
              )
            ],
            2
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-1/3 lg:w-1/4 xl:w-1/4" },
        [
          _c(
            "vx-card",
            [
              Object.entries(_vm.funding).length
                ? _c("template", { slot: "no-body" }, [
                    _c(
                      "div",
                      { staticClass: "p-8 clearfix" },
                      [
                        _c("div", [
                          _c("h1", [
                            _c("sup", { staticClass: "text-lg" }, [
                              _vm._v("$")
                            ]),
                            _vm._v(" "),
                            _c("span", [
                              _vm._v(
                                _vm._s(_vm.funding.currBalance.toLocaleString())
                              )
                            ])
                          ]),
                          _vm._v(" "),
                          _c("small", [
                            _c("span", { staticClass: "text-grey" }, [
                              _vm._v("Deposits: ")
                            ]),
                            _vm._v(" "),
                            _c("span", [_vm._v("$")]),
                            _vm._v(" "),
                            _c("span", [
                              _vm._v(
                                _vm._s(_vm.funding.depostis.toLocaleString())
                              )
                            ])
                          ])
                        ]),
                        _vm._v(" "),
                        _c(
                          "p",
                          {
                            staticClass: "mt-2 mb-8 text-xl font-medium",
                            class:
                              _vm.funding.comparison.resultPerc >= 0
                                ? "text-success"
                                : "text-danger"
                          },
                          [
                            _vm.funding.comparison.resultPerc > 0
                              ? _c("span", [_vm._v("+")])
                              : _vm._e(),
                            _vm._v(" "),
                            _c("span", [
                              _vm._v(
                                _vm._s(_vm.funding.comparison.resultPerc) + "%"
                              )
                            ]),
                            _vm._v(" "),
                            _c("span", { staticClass: "ml-1" }, [
                              _vm._v(
                                "($" +
                                  _vm._s(_vm.funding.comparison.pastData) +
                                  ")"
                              )
                            ])
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "vs-button",
                          {
                            staticClass: "shadow-md w-full",
                            attrs: {
                              "icon-pack": "feather",
                              icon: "icon-chevrons-right",
                              "icon-after": ""
                            }
                          },
                          [_vm._v("Add Funds")]
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass:
                          "p-8 border d-theme-border-grey-light border-solid border-r-0 border-l-0 border-b-0"
                      },
                      [
                        _c(
                          "div",
                          { staticClass: "mb-4" },
                          [
                            _c("small", [
                              _vm._v(
                                "Earned: $" +
                                  _vm._s(_vm.funding.meta.earned.val)
                              )
                            ]),
                            _vm._v(" "),
                            _c("vs-progress", {
                              attrs: {
                                percent: _vm.funding.meta.earned.progress,
                                color: "success"
                              }
                            })
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          [
                            _c("small", [
                              _vm._v(
                                "Duration: " +
                                  _vm._s(_vm.funding.meta.duration.val)
                              )
                            ]),
                            _vm._v(" "),
                            _c("vs-progress", {
                              attrs: {
                                percent: _vm.funding.meta.duration.progress,
                                color: "warning"
                              }
                            })
                          ],
                          1
                        )
                      ]
                    )
                  ])
                : _vm._e()
            ],
            2
          )
        ],
        1
      )
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "vx-row" }, [
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-1/3 lg:w-1/3 xl:w-1/3" },
        [
          _c(
            "vx-card",
            { staticClass: "mt-base", attrs: { title: "Browser Statistics" } },
            _vm._l(_vm.browserStatistics, function(browser, index) {
              return _c(
                "div",
                { key: browser.id, class: { "mt-4": index } },
                [
                  _c("div", { staticClass: "flex justify-between" }, [
                    _c("div", { staticClass: "flex flex-col" }, [
                      _c("span", { staticClass: "mb-1" }, [
                        _vm._v(_vm._s(browser.name))
                      ]),
                      _vm._v(" "),
                      _c("h4", [_vm._v(_vm._s(browser.ratio) + "%")])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "flex flex-col text-right" }, [
                      _c(
                        "span",
                        { staticClass: "flex -mr-1" },
                        [
                          _c("span", { staticClass: "mr-1" }, [
                            _vm._v(_vm._s(browser.comparedResult))
                          ]),
                          _vm._v(" "),
                          _c("feather-icon", {
                            attrs: {
                              icon:
                                browser.comparedResult < 0
                                  ? "ArrowDownIcon"
                                  : "ArrowUpIcon",
                              svgClasses: [
                                browser.comparedResult < 0
                                  ? "text-danger"
                                  : "text-success",
                                "stroke-current h-4 w-4 mb-1 mr-1"
                              ]
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("span", { staticClass: "text-grey" }, [
                        _vm._v(_vm._s(_vm._f("time")(browser.time, true)))
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c("vs-progress", { attrs: { percent: browser.ratio } })
                ],
                1
              )
            }),
            0
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "vx-col w-full md:w-2/3" },
        [
          _c(
            "vx-card",
            { staticClass: "mt-base", attrs: { title: "Client Retention" } },
            [
              _c("div", { staticClass: "flex items-center mb-3" }, [
                _c("span", { staticClass: "flex items-center" }, [
                  _c("div", {
                    staticClass: "h-3 w-3 rounded-full mr-1 bg-warning"
                  }),
                  _c("span", [_vm._v("New Clients")])
                ]),
                _vm._v(" "),
                _c("span", { staticClass: "flex items-center ml-4" }, [
                  _c("div", {
                    staticClass: "h-3 w-3 rounded-full mr-1 bg-danger"
                  }),
                  _c("span", [_vm._v("Retained Clients")])
                ])
              ]),
              _vm._v(" "),
              _c("vue-apex-charts", {
                attrs: {
                  type: "bar",
                  height: "266",
                  options: _vm.analyticsData.clientRetentionBar.chartOptions,
                  series: _vm.clientRetentionBar.series
                }
              })
            ],
            1
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

/***/ "./resources/js/src/views/ui-elements/card/CardAnalytics.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/src/views/ui-elements/card/CardAnalytics.vue ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CardAnalytics_vue_vue_type_template_id_9eb39740___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CardAnalytics.vue?vue&type=template&id=9eb39740& */ "./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=template&id=9eb39740&");
/* harmony import */ var _CardAnalytics_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CardAnalytics.vue?vue&type=script&lang=js& */ "./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _CardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./CardAnalytics.vue?vue&type=style&index=0&lang=scss& */ "./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _CardAnalytics_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CardAnalytics_vue_vue_type_template_id_9eb39740___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CardAnalytics_vue_vue_type_template_id_9eb39740___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/ui-elements/card/CardAnalytics.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CardAnalytics_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./CardAnalytics.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CardAnalytics_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=style&index=0&lang=scss&":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=style&index=0&lang=scss& ***!
  \*****************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_CardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/style-loader!../../../../../../node_modules/css-loader!../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../node_modules/postcss-loader/lib??ref--8-2!../../../../../../node_modules/sass-loader/dist/cjs.js??ref--8-3!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./CardAnalytics.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_CardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_CardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_CardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_CardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_8_2_node_modules_sass_loader_dist_cjs_js_ref_8_3_node_modules_vue_loader_lib_index_js_vue_loader_options_CardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=template&id=9eb39740&":
/*!**************************************************************************************************!*\
  !*** ./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=template&id=9eb39740& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CardAnalytics_vue_vue_type_template_id_9eb39740___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./CardAnalytics.vue?vue&type=template&id=9eb39740& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/ui-elements/card/CardAnalytics.vue?vue&type=template&id=9eb39740&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CardAnalytics_vue_vue_type_template_id_9eb39740___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CardAnalytics_vue_vue_type_template_id_9eb39740___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/src/views/ui-elements/card/analyticsData.js":
/*!******************************************************************!*\
  !*** ./resources/js/src/views/ui-elements/card/analyticsData.js ***!
  \******************************************************************/
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