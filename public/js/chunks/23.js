(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[23],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/inventory/add/GodamsAdd.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/apps/inventory/add/GodamsAdd.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-perfect-scrollbar */ "./node_modules/vue-perfect-scrollbar/dist/index.js");
/* harmony import */ var vue_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vue_select__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue-select */ "./node_modules/vue-select/dist/vue-select.js");
/* harmony import */ var vue_select__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vue_select__WEBPACK_IMPORTED_MODULE_1__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: 'vx-archive',
  components: {
    'v-select': vue_select__WEBPACK_IMPORTED_MODULE_1___default.a,
    VuePerfectScrollbar: vue_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_0___default.a
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/inventory/add/GodamsAdd.vue?vue&type=template&id=34be0ac2&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/apps/inventory/add/GodamsAdd.vue?vue&type=template&id=34be0ac2& ***!
  \******************************************************************************************************************************************************************************************************************************/
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
  return _c("vx-card", [
    _c("div", { staticClass: "p-6" }, [
      _c("div", { staticClass: "vx-row mb-6" }, [
        _c(
          "div",
          { staticClass: "vx-col w-full" },
          [
            _c("vs-input", { staticClass: "w-full", attrs: { label: "عنوان" } })
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "vx-row mb-6" }, [
        _c(
          "div",
          { staticClass: "vx-col w-full" },
          [
            _c("vs-input", {
              staticClass: "w-full",
              attrs: { type: "text", label: "کود" }
            })
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "vx-row mb-6" }, [
        _c(
          "div",
          { staticClass: "vx-col w-full" },
          [
            _c("vs-input", { staticClass: "w-full", attrs: { label: "مسؤل" } })
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "vx-row mb-6" }, [
        _c(
          "div",
          { staticClass: "vx-col w-full" },
          [_c("vs-input", { staticClass: "w-full", attrs: { label: "آدرس" } })],
          1
        )
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "vx-row mb-6" }, [
        _c(
          "div",
          { staticClass: "vx-col w-full" },
          [
            _c("vs-input", { staticClass: "w-full", attrs: { label: "شماره" } })
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "vx-row mb-6" }, [
        _c(
          "div",
          { staticClass: "vx-col w-full" },
          [
            _c(
              "label",
              { staticClass: "vs-input--label", attrs: { for: "" } },
              [_vm._v("واحد ظرفیت")]
            ),
            _vm._v(" "),
            _c(
              "v-select",
              {
                attrs: {
                  "aria-placeholder": "",
                  label: "text",
                  options: _vm.itemType,
                  dir: _vm.$vs.rtl ? "rtl" : "ltr"
                }
              },
              [
                _c(
                  "span",
                  { attrs: { slot: "no-options" }, slot: "no-options" },
                  [_vm._v(_vm._s(_vm.$t("WhoopsNothinghere")))]
                )
              ]
            )
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "vx-row mb-6" }, [
        _c(
          "div",
          { staticClass: "vx-col w-full" },
          [
            _c("vs-input", { staticClass: "w-full", attrs: { label: "ظرفیت" } })
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "vx-row" }, [
        _c(
          "div",
          { staticClass: "vx-col w-full" },
          [
            _c("vs-button", { staticClass: "mr-3 mb-2" }, [_vm._v("ثبت")]),
            _vm._v(" "),
            _c(
              "vs-button",
              {
                staticClass: "mb-2",
                attrs: { color: "warning", type: "border" },
                on: {
                  click: function($event) {
                    _vm.input9 = _vm.input10 = _vm.input11 = _vm.input12 = ""
                    _vm.check3 = false
                  }
                }
              },
              [_vm._v("پاک کردن فرم")]
            )
          ],
          1
        )
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/src/views/apps/inventory/add/GodamsAdd.vue":
/*!*****************************************************************!*\
  !*** ./resources/js/src/views/apps/inventory/add/GodamsAdd.vue ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GodamsAdd_vue_vue_type_template_id_34be0ac2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GodamsAdd.vue?vue&type=template&id=34be0ac2& */ "./resources/js/src/views/apps/inventory/add/GodamsAdd.vue?vue&type=template&id=34be0ac2&");
/* harmony import */ var _GodamsAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GodamsAdd.vue?vue&type=script&lang=js& */ "./resources/js/src/views/apps/inventory/add/GodamsAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _GodamsAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GodamsAdd_vue_vue_type_template_id_34be0ac2___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GodamsAdd_vue_vue_type_template_id_34be0ac2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/apps/inventory/add/GodamsAdd.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/apps/inventory/add/GodamsAdd.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./resources/js/src/views/apps/inventory/add/GodamsAdd.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GodamsAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./GodamsAdd.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/inventory/add/GodamsAdd.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GodamsAdd_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/apps/inventory/add/GodamsAdd.vue?vue&type=template&id=34be0ac2&":
/*!************************************************************************************************!*\
  !*** ./resources/js/src/views/apps/inventory/add/GodamsAdd.vue?vue&type=template&id=34be0ac2& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GodamsAdd_vue_vue_type_template_id_34be0ac2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./GodamsAdd.vue?vue&type=template&id=34be0ac2& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/apps/inventory/add/GodamsAdd.vue?vue&type=template&id=34be0ac2&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GodamsAdd_vue_vue_type_template_id_34be0ac2___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GodamsAdd_vue_vue_type_template_id_34be0ac2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);