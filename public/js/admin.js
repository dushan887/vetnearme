webpackJsonp([1],{

/***/ 11:
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ 15:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(16);


/***/ }),

/***/ 16:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__components_Service_vue__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__components_Service_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__components_Service_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__components_Modal_vue__ = __webpack_require__(40);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__components_Modal_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__components_Modal_vue__);


window.Event = new __WEBPACK_IMPORTED_MODULE_0_vue___default.a();

window.axios = __webpack_require__(5);

var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {

    window.axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

var Form = __webpack_require__(61);

// Components



var adminVue = new __WEBPACK_IMPORTED_MODULE_0_vue___default.a({
    el: '#admin-app',
    mixins: [Form],
    components: {
        adminService: __WEBPACK_IMPORTED_MODULE_1__components_Service_vue___default.a,
        adminModal: __WEBPACK_IMPORTED_MODULE_2__components_Modal_vue___default.a
    },
    mounted: function mounted() {
        Event.$on('form:errors:show', function (form, errors) {
            Form.showErrors(form, errors);
        });
    }
});

/***/ }),

/***/ 37:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(11)
/* script */
var __vue_script__ = __webpack_require__(38)
/* template */
var __vue_template__ = __webpack_require__(39)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/admin/components/Service.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1cca1b8e", Component.options)
  } else {
    hotAPI.reload("data-v-1cca1b8e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 38:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
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
            services: []
        };
    },

    methods: {
        getAll: function getAll() {
            var _this = this;

            axios.get('/admin/services/all', {}).then(function (response) {
                _this.services = response.data;
            });
        },
        openModal: function openModal() {
            axios.get('/admin/services/create', {}).then(function (response) {
                Event.$emit('modal:show', response.data);
            });
        },
        save: function save() {
            var _this2 = this;

            var form = $('#service-store');

            axios.post('/admin/services/store', {
                name: form.find('#name').val()
            }).then(function (response) {

                var service = response.data;

                _this2.services.unshift({ 'id': service.id, 'name': service.name });

                Event.$emit('modal:hide');
            }).catch(function (error) {
                Event.$emit('form:errors:show', form, error.response.data.errors);
            });
        }
    },
    mounted: function mounted() {
        var _this3 = this;

        this.getAll();

        Event.$on('service:save', function () {
            _this3.save();
        });
    }
});

/***/ }),

/***/ 39:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("h1", [_vm._v("Services (" + _vm._s(_vm.services.length) + ")")]),
      _vm._v(" "),
      _c("div", { staticClass: "services-actions" }, [
        _c(
          "button",
          {
            staticClass: "btn btn-primary",
            attrs: { type: "button" },
            on: { click: _vm.openModal }
          },
          [_vm._v("Add Service")]
        )
      ]),
      _vm._v(" "),
      _vm._l(_vm.services, function(service, index) {
        return _c("div", { key: service.id, staticClass: "services" }, [
          _c("p", [_vm._v(_vm._s(service.name))])
        ])
      })
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-1cca1b8e", module.exports)
  }
}

/***/ }),

/***/ 40:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(11)
/* script */
var __vue_script__ = __webpack_require__(41)
/* template */
var __vue_template__ = __webpack_require__(42)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/admin/components/Modal.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-33c86074", Component.options)
  } else {
    hotAPI.reload("data-v-33c86074", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 41:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
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
    methods: {
        test: function test() {
            alert(1);
        }
    },
    data: function data() {
        return {
            body: ''
        };
    },
    mounted: function mounted() {
        var _this = this;

        var mainModal = $('#main-modal');

        Event.$on('modal:show', function (html) {
            _this.body = html;
            mainModal.modal('show');
        });

        Event.$on('modal:hide', function () {
            mainModal.modal('hide');
        });
    }
});

/***/ }),

/***/ 42:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "modal fade",
      attrs: { tabindex: "-1", role: "dialog", id: "main-modal" }
    },
    [
      _c("div", { staticClass: "modal-dialog", attrs: { role: "document" } }, [
        _c("div", { staticClass: "modal-content" }, [
          _c("span", { domProps: { innerHTML: _vm._s(_vm.body) } })
        ])
      ])
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-33c86074", module.exports)
  }
}

/***/ }),

/***/ 61:
/***/ (function(module, exports) {

var Form = {
    showErrors: function showErrors(form, errors) {

        this.removeErrors(form);

        for (var error in errors) {

            var errorMessages = errors[error];
            var errorGroup = $('div[data-group=' + error + ']');

            errorGroup.addClass('has-error');

            for (index in errorMessages) {
                errorGroup.append('<span class="help-block">' + errorMessages[index] + '</span>');
            }
        }
    },
    removeErrors: function removeErrors(form) {

        var oldErrors = form.find('.has-error');

        oldErrors.find('span.help-block').remove();
        oldErrors.removeClass('has-error');
    }
};

module.exports = Form;

/***/ })

},[15]);