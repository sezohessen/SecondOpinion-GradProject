/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 117);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/custom/todo/todo.js":
/*!*********************************************************!*\
  !*** ./resources/metronic/js/pages/custom/todo/todo.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval(" // Class definition\n\nvar KTAppTodo = function () {\n  // Private properties\n  var _asideEl;\n\n  var _listEl;\n\n  var _viewEl;\n\n  var _replyEl;\n\n  var _asideOffcanvas; // Private methods\n\n\n  var _initEditor = function _initEditor(form, editor) {\n    // init editor\n    var options = {\n      modules: {\n        toolbar: {}\n      },\n      placeholder: 'Type message...',\n      theme: 'snow'\n    };\n\n    if (!KTUtil.getById(editor)) {\n      return;\n    } // Init editor\n\n\n    var editor = new Quill('#' + editor, options); // Customize editor\n\n    var toolbar = KTUtil.find(form, '.ql-toolbar');\n    var editor = KTUtil.find(form, '.ql-editor');\n\n    if (toolbar) {\n      KTUtil.addClass(toolbar, 'px-5 border-top-0 border-left-0 border-right-0');\n    }\n\n    if (editor) {\n      KTUtil.addClass(editor, 'px-8');\n    }\n  };\n\n  var _initAttachments = function _initAttachments(elemId) {\n    if (!KTUtil.getById(elemId)) {\n      return;\n    }\n\n    var id = \"#\" + elemId;\n    var previewNode = $(id + \" .dropzone-item\");\n    previewNode.id = \"\";\n    var previewTemplate = previewNode.parent('.dropzone-items').html();\n    previewNode.remove();\n    var myDropzone = new Dropzone(id, {\n      // Make the whole body a dropzone\n      url: \"https://keenthemes.com/scripts/void.php\",\n      // Set the url for your upload script location\n      parallelUploads: 20,\n      maxFilesize: 1,\n      // Max filesize in MB\n      previewTemplate: previewTemplate,\n      previewsContainer: id + \" .dropzone-items\",\n      // Define the container to display the previews\n      clickable: id + \"_select\" // Define the element that should be used as click trigger to select files.\n\n    });\n    myDropzone.on(\"addedfile\", function (file) {\n      // Hookup the start button\n      $(document).find(id + ' .dropzone-item').css('display', '');\n    }); // Update the total progress bar\n\n    myDropzone.on(\"totaluploadprogress\", function (progress) {\n      document.querySelector(id + \" .progress-bar\").style.width = progress + \"%\";\n    });\n    myDropzone.on(\"sending\", function (file) {\n      // Show the total progress bar when upload starts\n      document.querySelector(id + \" .progress-bar\").style.opacity = \"1\";\n    }); // Hide the total progress bar when nothing's uploading anymore\n\n    myDropzone.on(\"complete\", function (progress) {\n      var thisProgressBar = id + \" .dz-complete\";\n      setTimeout(function () {\n        $(thisProgressBar + \" .progress-bar, \" + thisProgressBar + \" .progress\").css('opacity', '0');\n      }, 300);\n    });\n  }; // Public methods\n\n\n  return {\n    // Public functions\n    init: function init() {\n      // Init variables\n      _asideEl = KTUtil.getById('kt_todo_aside');\n      _listEl = KTUtil.getById('kt_todo_list');\n      _viewEl = KTUtil.getById('kt_todo_view');\n      _replyEl = KTUtil.getById('kt_todo_reply'); // Init handlers\n\n      KTAppTodo.initAside();\n      KTAppTodo.initList();\n      KTAppTodo.initView();\n      KTAppTodo.initReply();\n    },\n    initAside: function initAside() {\n      // Mobile offcanvas for mobile mode\n      _asideOffcanvas = new KTOffcanvas(_asideEl, {\n        overlay: true,\n        baseClass: 'offcanvas-mobile',\n        //closeBy: 'kt_todo_aside_close',\n        toggleBy: 'kt_subheader_mobile_toggle'\n      }); // View list\n\n      KTUtil.on(_asideEl, '.list-item[data-action=\"list\"]', 'click', function (e) {\n        var type = KTUtil.attr(this, 'data-type');\n        var listItemsEl = KTUtil.find(_listEl, '.kt-inbox__items');\n        var navItemEl = this.closest('.kt-nav__item');\n        var navItemActiveEl = KTUtil.find(_asideEl, '.kt-nav__item.kt-nav__item--active'); // demo loading\n\n        var loading = new KTDialog({\n          'type': 'loader',\n          'placement': 'top center',\n          'message': 'Loading ...'\n        });\n        loading.show();\n        setTimeout(function () {\n          loading.hide();\n          KTUtil.css(_listEl, 'display', 'flex'); // show list\n\n          KTUtil.css(_viewEl, 'display', 'none'); // hide view\n\n          KTUtil.addClass(navItemEl, 'kt-nav__item--active');\n          KTUtil.removeClass(navItemActiveEl, 'kt-nav__item--active');\n          KTUtil.attr(listItemsEl, 'data-type', type);\n        }, 600);\n      });\n    },\n    initList: function initList() {\n      // Group selection\n      KTUtil.on(_listEl, '[data-inbox=\"group-select\"] input', 'click', function () {\n        var messages = KTUtil.findAll(_listEl, '[data-inbox=\"message\"]');\n\n        for (var i = 0, j = messages.length; i < j; i++) {\n          var message = messages[i];\n          var checkbox = KTUtil.find(message, '.checkbox input');\n          checkbox.checked = this.checked;\n\n          if (this.checked) {\n            KTUtil.addClass(message, 'active');\n          } else {\n            KTUtil.removeClass(message, 'active');\n          }\n        }\n      }); // Individual selection\n\n      KTUtil.on(_listEl, '[data-inbox=\"message\"] [data-inbox=\"actions\"] .checkbox input', 'click', function () {\n        var item = this.closest('[data-inbox=\"message\"]');\n\n        if (item && this.checked) {\n          KTUtil.addClass(item, 'active');\n        } else {\n          KTUtil.removeClass(item, 'active');\n        }\n      });\n    },\n    initView: function initView() {\n      // Back to listing\n      KTUtil.on(_viewEl, '[data-inbox=\"back\"]', 'click', function () {\n        // demo loading\n        var loading = new KTDialog({\n          'type': 'loader',\n          'placement': 'top center',\n          'message': 'Loading ...'\n        });\n        loading.show();\n        setTimeout(function () {\n          loading.hide();\n          KTUtil.addClass(_listEl, 'd-block');\n          KTUtil.removeClass(_listEl, 'd-none');\n          KTUtil.addClass(_viewEl, 'd-none');\n          KTUtil.removeClass(_viewEl, 'd-block');\n        }, 700);\n      }); // Expand/Collapse reply\n\n      KTUtil.on(_viewEl, '[data-inbox=\"message\"]', 'click', function (e) {\n        var message = this.closest('[data-inbox=\"message\"]');\n        var dropdownToggleEl = KTUtil.find(this, '[data-toggle=\"dropdown\"]');\n        var toolbarEl = KTUtil.find(this, '[data-inbox=\"toolbar\"]'); // skip dropdown toggle click\n\n        if (e.target === dropdownToggleEl || dropdownToggleEl && dropdownToggleEl.contains(e.target) === true) {\n          return false;\n        } // skip group actions click\n\n\n        if (e.target === toolbarEl || toolbarEl && toolbarEl.contains(e.target) === true) {\n          return false;\n        }\n\n        if (KTUtil.hasClass(message, 'toggle-on')) {\n          KTUtil.addClass(message, 'toggle-off');\n          KTUtil.removeClass(message, 'toggle-on');\n        } else {\n          KTUtil.removeClass(message, 'toggle-off');\n          KTUtil.addClass(message, 'toggle-on');\n        }\n      });\n    },\n    initReply: function initReply() {\n      _initEditor(_replyEl, 'kt_todo_reply_editor');\n\n      _initAttachments('kt_todo_reply_attachments');\n    }\n  };\n}(); // Class Initialization\n\n\njQuery(document).ready(function () {\n  KTAppTodo.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3VzdG9tL3RvZG8vdG9kby5qcz83YTUxIl0sIm5hbWVzIjpbIktUQXBwVG9kbyIsIl9hc2lkZUVsIiwiX2xpc3RFbCIsIl92aWV3RWwiLCJfcmVwbHlFbCIsIl9hc2lkZU9mZmNhbnZhcyIsIl9pbml0RWRpdG9yIiwiZm9ybSIsImVkaXRvciIsIm9wdGlvbnMiLCJtb2R1bGVzIiwidG9vbGJhciIsInBsYWNlaG9sZGVyIiwidGhlbWUiLCJLVFV0aWwiLCJnZXRCeUlkIiwiUXVpbGwiLCJmaW5kIiwiYWRkQ2xhc3MiLCJfaW5pdEF0dGFjaG1lbnRzIiwiZWxlbUlkIiwiaWQiLCJwcmV2aWV3Tm9kZSIsIiQiLCJwcmV2aWV3VGVtcGxhdGUiLCJwYXJlbnQiLCJodG1sIiwicmVtb3ZlIiwibXlEcm9wem9uZSIsIkRyb3B6b25lIiwidXJsIiwicGFyYWxsZWxVcGxvYWRzIiwibWF4RmlsZXNpemUiLCJwcmV2aWV3c0NvbnRhaW5lciIsImNsaWNrYWJsZSIsIm9uIiwiZmlsZSIsImRvY3VtZW50IiwiY3NzIiwicHJvZ3Jlc3MiLCJxdWVyeVNlbGVjdG9yIiwic3R5bGUiLCJ3aWR0aCIsIm9wYWNpdHkiLCJ0aGlzUHJvZ3Jlc3NCYXIiLCJzZXRUaW1lb3V0IiwiaW5pdCIsImluaXRBc2lkZSIsImluaXRMaXN0IiwiaW5pdFZpZXciLCJpbml0UmVwbHkiLCJLVE9mZmNhbnZhcyIsIm92ZXJsYXkiLCJiYXNlQ2xhc3MiLCJ0b2dnbGVCeSIsImUiLCJ0eXBlIiwiYXR0ciIsImxpc3RJdGVtc0VsIiwibmF2SXRlbUVsIiwiY2xvc2VzdCIsIm5hdkl0ZW1BY3RpdmVFbCIsImxvYWRpbmciLCJLVERpYWxvZyIsInNob3ciLCJoaWRlIiwicmVtb3ZlQ2xhc3MiLCJtZXNzYWdlcyIsImZpbmRBbGwiLCJpIiwiaiIsImxlbmd0aCIsIm1lc3NhZ2UiLCJjaGVja2JveCIsImNoZWNrZWQiLCJpdGVtIiwiZHJvcGRvd25Ub2dnbGVFbCIsInRvb2xiYXJFbCIsInRhcmdldCIsImNvbnRhaW5zIiwiaGFzQ2xhc3MiLCJqUXVlcnkiLCJyZWFkeSJdLCJtYXBwaW5ncyI6IkNBRUE7O0FBQ0EsSUFBSUEsU0FBUyxHQUFHLFlBQVc7QUFDdkI7QUFDQSxNQUFJQyxRQUFKOztBQUNBLE1BQUlDLE9BQUo7O0FBQ0EsTUFBSUMsT0FBSjs7QUFDQSxNQUFJQyxRQUFKOztBQUNBLE1BQUlDLGVBQUosQ0FOdUIsQ0FRdkI7OztBQUNBLE1BQUlDLFdBQVcsR0FBRyxTQUFkQSxXQUFjLENBQVNDLElBQVQsRUFBZUMsTUFBZixFQUF1QjtBQUNyQztBQUNBLFFBQUlDLE9BQU8sR0FBRztBQUNWQyxhQUFPLEVBQUU7QUFDTEMsZUFBTyxFQUFFO0FBREosT0FEQztBQUlWQyxpQkFBVyxFQUFFLGlCQUpIO0FBS1ZDLFdBQUssRUFBRTtBQUxHLEtBQWQ7O0FBUUEsUUFBSSxDQUFDQyxNQUFNLENBQUNDLE9BQVAsQ0FBZVAsTUFBZixDQUFMLEVBQTZCO0FBQ3pCO0FBQ0gsS0Fab0MsQ0FjckM7OztBQUNBLFFBQUlBLE1BQU0sR0FBRyxJQUFJUSxLQUFKLENBQVUsTUFBTVIsTUFBaEIsRUFBd0JDLE9BQXhCLENBQWIsQ0FmcUMsQ0FpQnJDOztBQUNBLFFBQUlFLE9BQU8sR0FBR0csTUFBTSxDQUFDRyxJQUFQLENBQVlWLElBQVosRUFBa0IsYUFBbEIsQ0FBZDtBQUNBLFFBQUlDLE1BQU0sR0FBR00sTUFBTSxDQUFDRyxJQUFQLENBQVlWLElBQVosRUFBa0IsWUFBbEIsQ0FBYjs7QUFFQSxRQUFJSSxPQUFKLEVBQWE7QUFDVEcsWUFBTSxDQUFDSSxRQUFQLENBQWdCUCxPQUFoQixFQUF5QixnREFBekI7QUFDSDs7QUFFRCxRQUFJSCxNQUFKLEVBQVk7QUFDUk0sWUFBTSxDQUFDSSxRQUFQLENBQWdCVixNQUFoQixFQUF3QixNQUF4QjtBQUNIO0FBQ0osR0E1QkQ7O0FBOEJBLE1BQUlXLGdCQUFnQixHQUFHLFNBQW5CQSxnQkFBbUIsQ0FB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anMuanMiLCJzb3VyY2VzQ29udGVudCI6WyJcInVzZSBzdHJpY3RcIjtcclxuXHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIEtUQXBwVG9kbyA9IGZ1bmN0aW9uKCkge1xyXG4gICAgLy8gUHJpdmF0ZSBwcm9wZXJ0aWVzXHJcbiAgICB2YXIgX2FzaWRlRWw7XHJcbiAgICB2YXIgX2xpc3RFbDtcclxuICAgIHZhciBfdmlld0VsO1xyXG4gICAgdmFyIF9yZXBseUVsO1xyXG4gICAgdmFyIF9hc2lkZU9mZmNhbnZhcztcclxuXHJcbiAgICAvLyBQcml2YXRlIG1ldGhvZHNcclxuICAgIHZhciBfaW5pdEVkaXRvciA9IGZ1bmN0aW9uKGZvcm0sIGVkaXRvcikge1xyXG4gICAgICAgIC8vIGluaXQgZWRpdG9yXHJcbiAgICAgICAgdmFyIG9wdGlvbnMgPSB7XHJcbiAgICAgICAgICAgIG1vZHVsZXM6IHtcclxuICAgICAgICAgICAgICAgIHRvb2xiYXI6IHt9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHBsYWNlaG9sZGVyOiAnVHlwZSBtZXNzYWdlLi4uJyxcclxuICAgICAgICAgICAgdGhlbWU6ICdzbm93J1xyXG4gICAgICAgIH07XHJcblxyXG4gICAgICAgIGlmICghS1RVdGlsLmdldEJ5SWQoZWRpdG9yKSkge1xyXG4gICAgICAgICAgICByZXR1cm47XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICAvLyBJbml0IGVkaXRvclxyXG4gICAgICAgIHZhciBlZGl0b3IgPSBuZXcgUXVpbGwoJyMnICsgZWRpdG9yLCBvcHRpb25zKTtcclxuXHJcbiAgICAgICAgLy8gQ3VzdG9taXplIGVkaXRvclxyXG4gICAgICAgIHZhciB0b29sYmFyID0gS1RVdGlsLmZpbmQoZm9ybSwgJy5xbC10b29sYmFyJyk7XHJcbiAgICAgICAgdmFyIGVkaXRvciA9IEtUVXRpbC5maW5kKGZvcm0sICcucWwtZWRpdG9yJyk7XHJcblxyXG4gICAgICAgIGlmICh0b29sYmFyKSB7XHJcbiAgICAgICAgICAgIEtUVXRpbC5hZGRDbGFzcyh0b29sYmFyLCAncHgtNSBib3JkZXItdG9wLTAgYm9yZGVyLWxlZnQtMCBib3JkZXItcmlnaHQtMCcpO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgaWYgKGVkaXRvcikge1xyXG4gICAgICAgICAgICBLVFV0aWwuYWRkQ2xhc3MoZWRpdG9yLCAncHgtOCcpO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICB2YXIgX2luaXRBdHRhY2htZW50cyA9IGZ1bmN0aW9uKGVsZW1JZCkge1xyXG4gICAgICAgIGlmICghS1RVdGlsLmdldEJ5SWQoZWxlbUlkKSkge1xyXG4gICAgICAgICAgICByZXR1cm47XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICB2YXIgaWQgPSBcIiNcIiArIGVsZW1JZDtcclxuICAgICAgICB2YXIgcHJldmlld05vZGUgPSAkKGlkICsgXCIgLmRyb3B6b25lLWl0ZW1cIik7XHJcbiAgICAgICAgcHJldmlld05vZGUuaWQgPSBcIlwiO1xyXG4gICAgICAgIHZhciBwcmV2aWV3VGVtcGxhdGUgPSBwcmV2aWV3Tm9kZS5wYXJlbnQoJy5kcm9wem9uZS1pdGVtcycpLmh0bWwoKTtcclxuICAgICAgICBwcmV2aWV3Tm9kZS5yZW1vdmUoKTtcclxuXHJcbiAgICAgICAgdmFyIG15RHJvcHpvbmUgPSBuZXcgRHJvcHpvbmUoaWQsIHsgLy8gTWFrZSB0aGUgd2hvbGUgYm9keSBhIGRyb3B6b25lXHJcbiAgICAgICAgICAgIHVybDogXCJodHRwczovL2tlZW50aGVtZXMuY29tL3NjcmlwdHMvdm9pZC5waHBcIiwgLy8gU2V0IHRoZSB1cmwgZm9yIHlvdXIgdXBsb2FkIHNjcmlwdCBsb2NhdGlvblxyXG4gICAgICAgICAgICBwYXJhbGxlbFVwbG9hZHM6IDIwLFxyXG4gICAgICAgICAgICBtYXhGaWxlc2l6ZTogMSwgLy8gTWF4IGZpbGVzaXplIGluIE1CXHJcbiAgICAgICAgICAgIHByZXZpZXdUZW1wbGF0ZTogcHJldmlld1RlbXBsYXRlLFxyXG4gICAgICAgICAgICBwcmV2aWV3c0NvbnRhaW5lcjogaWQgKyBcIiAuZHJvcHpvbmUtaXRlbXNcIiwgLy8gRGVmaW5lIHRoZSBjb250YWluZXIgdG8gZGlzcGxheSB0aGUgcHJldmlld3NcclxuICAgICAgICAgICAgY2xpY2thYmxlOiBpZCArIFwiX3NlbGVjdFwiIC8vIERlZmluZSB0aGUgZWxlbWVudCB0aGF0IHNob3VsZCBiZSB1c2VkIGFzIGNsaWNrIHRyaWdnZXIgdG8gc2VsZWN0IGZpbGVzLlxyXG4gICAgICAgIH0pO1xyXG5cclxuICAgICAgICBteURyb3B6b25lLm9uKFwiYWRkZWRmaWxlXCIsIGZ1bmN0aW9uKGZpbGUpIHtcclxuICAgICAgICAgICAgLy8gSG9va3VwIHRoZSBzdGFydCBidXR0b25cclxuICAgICAgICAgICAgJChkb2N1bWVudCkuZmluZChpZCArICcgLmRyb3B6b25lLWl0ZW0nKS5jc3MoJ2Rpc3BsYXknLCAnJyk7XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIC8vIFVwZGF0ZSB0aGUgdG90YWwgcHJvZ3Jlc3MgYmFyXHJcbiAgICAgICAgbXlEcm9wem9uZS5vbihcInRvdGFsdXBsb2FkcHJvZ3Jlc3NcIiwgZnVuY3Rpb24ocHJvZ3Jlc3MpIHtcclxuICAgICAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcihpZCArIFwiIC5wcm9ncmVzcy1iYXJcIikuc3R5bGUud2lkdGggPSBwcm9ncmVzcyArIFwiJVwiO1xyXG4gICAgICAgIH0pO1xyXG5cclxuICAgICAgICBteURyb3B6b25lLm9uKFwic2VuZGluZ1wiLCBmdW5jdGlvbihmaWxlKSB7XHJcbiAgICAgICAgICAgIC8vIFNob3cgdGhlIHRvdGFsIHByb2dyZXNzIGJhciB3aGVuIHVwbG9hZCBzdGFydHNcclxuICAgICAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcihpZCArIFwiIC5wcm9ncmVzcy1iYXJcIikuc3R5bGUub3BhY2l0eSA9IFwiMVwiO1xyXG4gICAgICAgIH0pO1xyXG5cclxuICAgICAgICAvLyBIaWRlIHRoZSB0b3RhbCBwcm9ncmVzcyBiYXIgd2hlbiBub3RoaW5nJ3MgdXBsb2FkaW5nIGFueW1vcmVcclxuICAgICAgICBteURyb3B6b25lLm9uKFwiY29tcGxldGVcIiwgZnVuY3Rpb24ocHJvZ3Jlc3MpIHtcclxuICAgICAgICAgICAgdmFyIHRoaXNQcm9ncmVzc0JhciA9IGlkICsgXCIgLmR6LWNvbXBsZXRlXCI7XHJcbiAgICAgICAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICAgICAkKHRoaXNQcm9ncmVzc0JhciArIFwiIC5wcm9ncmVzcy1iYXIsIFwiICsgdGhpc1Byb2dyZXNzQmFyICsgXCIgLnByb2dyZXNzXCIpLmNzcygnb3BhY2l0eScsICcwJyk7XHJcbiAgICAgICAgICAgIH0sIDMwMClcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICAvLyBQdWJsaWMgbWV0aG9kc1xyXG4gICAgcmV0dXJuIHtcclxuICAgICAgICAvLyBQdWJsaWMgZnVuY3Rpb25zXHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIC8vIEluaXQgdmFyaWFibGVzXHJcbiAgICAgICAgICAgIF9hc2lkZUVsID0gS1RVdGlsLmdldEJ5SWQoJ2t0X3RvZG9fYXNpZGUnKTtcclxuICAgICAgICAgICAgX2xpc3RFbCA9IEtUVXRpbC5nZXRCeUlkKCdrdF90b2RvX2xpc3QnKTtcclxuICAgICAgICAgICAgX3ZpZXdFbCA9IEtUVXRpbC5nZXRCeUlkKCdrdF90b2RvX3ZpZXcnKTtcclxuICAgICAgICAgICAgX3JlcGx5RWwgPSBLVFV0aWwuZ2V0QnlJZCgna3RfdG9kb19yZXBseScpO1xyXG5cclxuICAgICAgICAgICAgLy8gSW5pdCBoYW5kbGVyc1xyXG4gICAgICAgICAgICBLVEFwcFRvZG8uaW5pdEFzaWRlKCk7XHJcbiAgICAgICAgICAgIEtUQXBwVG9kby5pbml0TGlzdCgpO1xyXG4gICAgICAgICAgICBLVEFwcFRvZG8uaW5pdFZpZXcoKTtcclxuICAgICAgICAgICAgS1RBcHBUb2RvLmluaXRSZXBseSgpO1xyXG4gICAgICAgIH0sXHJcblxyXG4gICAgICAgIGluaXRBc2lkZTogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIC8vIE1vYmlsZSBvZmZjYW52YXMgZm9yIG1vYmlsZSBtb2RlXHJcbiAgICAgICAgICAgIF9hc2lkZU9mZmNhbnZhcyA9IG5ldyBLVE9mZmNhbnZhcyhfYXNpZGVFbCwge1xyXG4gICAgICAgICAgICAgICAgb3ZlcmxheTogdHJ1ZSxcclxuICAgICAgICAgICAgICAgIGJhc2VDbGFzczogJ29mZmNhbnZhcy1tb2JpbGUnLFxyXG4gICAgICAgICAgICAgICAgLy9jbG9zZUJ5OiAna3RfdG9kb19hc2lkZV9jbG9zZScsXHJcbiAgICAgICAgICAgICAgICB0b2dnbGVCeTogJ2t0X3N1YmhlYWRlcl9tb2JpbGVfdG9nZ2xlJ1xyXG4gICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgIC8vIFZpZXcgbGlzdFxyXG4gICAgICAgICAgICBLVFV0aWwub24oX2FzaWRlRWwsICcubGlzdC1pdGVtW2RhdGEtYWN0aW9uPVwibGlzdFwiXScsICdjbGljaycsIGZ1bmN0aW9uKGUpIHtcclxuICAgICAgICAgICAgICAgIHZhciB0eXBlID0gS1RVdGlsLmF0dHIodGhpcywgJ2RhdGEtdHlwZScpO1xyXG4gICAgICAgICAgICAgICAgdmFyIGxpc3RJdGVtc0VsID0gS1RVdGlsLmZpbmQoX2xpc3RFbCwgJy5rdC1pbmJveF9faXRlbXMnKTtcclxuICAgICAgICAgICAgICAgIHZhciBuYXZJdGVtRWwgPSB0aGlzLmNsb3Nlc3QoJy5rdC1uYXZfX2l0ZW0nKTtcclxuICAgICAgICAgICAgICAgIHZhciBuYXZJdGVtQWN0aXZlRWwgPSBLVFV0aWwuZmluZChfYXNpZGVFbCwgJy5rdC1uYXZfX2l0ZW0ua3QtbmF2X19pdGVtLS1hY3RpdmUnKTtcclxuXHJcbiAgICAgICAgICAgICAgICAvLyBkZW1vIGxvYWRpbmdcclxuICAgICAgICAgICAgICAgIHZhciBsb2FkaW5nID0gbmV3IEtURGlhbG9nKHtcclxuICAgICAgICAgICAgICAgICAgICAndHlwZSc6ICdsb2FkZXInLFxyXG4gICAgICAgICAgICAgICAgICAgICdwbGFjZW1lbnQnOiAndG9wIGNlbnRlcicsXHJcbiAgICAgICAgICAgICAgICAgICAgJ21lc3NhZ2UnOiAnTG9hZGluZyAuLi4nXHJcbiAgICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgIGxvYWRpbmcuc2hvdygpO1xyXG5cclxuICAgICAgICAgICAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgbG9hZGluZy5oaWRlKCk7XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIEtUVXRpbC5jc3MoX2xpc3RFbCwgJ2Rpc3BsYXknLCAnZmxleCcpOyAvLyBzaG93IGxpc3RcclxuICAgICAgICAgICAgICAgICAgICBLVFV0aWwuY3NzKF92aWV3RWwsICdkaXNwbGF5JywgJ25vbmUnKTsgLy8gaGlkZSB2aWV3XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIEtUVXRpbC5hZGRDbGFzcyhuYXZJdGVtRWwsICdrdC1uYXZfX2l0ZW0tLWFjdGl2ZScpO1xyXG4gICAgICAgICAgICAgICAgICAgIEtUVXRpbC5yZW1vdmVDbGFzcyhuYXZJdGVtQWN0aXZlRWwsICdrdC1uYXZfX2l0ZW0tLWFjdGl2ZScpO1xyXG5cclxuICAgICAgICAgICAgICAgICAgICBLVFV0aWwuYXR0cihsaXN0SXRlbXNFbCwgJ2RhdGEtdHlwZScsIHR5cGUpO1xyXG4gICAgICAgICAgICAgICAgfSwgNjAwKTtcclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfSxcclxuXHJcbiAgICAgICAgaW5pdExpc3Q6IGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICAvLyBHcm91cCBzZWxlY3Rpb25cclxuICAgICAgICAgICAgS1RVdGlsLm9uKF9saXN0RWwsICdbZGF0YS1pbmJveD1cImdyb3VwLXNlbGVjdFwiXSBpbnB1dCcsICdjbGljaycsIGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICAgICAgdmFyIG1lc3NhZ2VzID0gS1RVdGlsLmZpbmRBbGwoX2xpc3RFbCwgJ1tkYXRhLWluYm94PVwibWVzc2FnZVwiXScpO1xyXG5cclxuICAgICAgICAgICAgICAgIGZvciAodmFyIGkgPSAwLCBqID0gbWVzc2FnZXMubGVuZ3RoOyBpIDwgajsgaSsrKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgdmFyIG1lc3NhZ2UgPSBtZXNzYWdlc1tpXTtcclxuICAgICAgICAgICAgICAgICAgICB2YXIgY2hlY2tib3ggPSBLVFV0aWwuZmluZChtZXNzYWdlLCAnLmNoZWNrYm94IGlucHV0Jyk7XHJcbiAgICAgICAgICAgICAgICAgICAgY2hlY2tib3guY2hlY2tlZCA9IHRoaXMuY2hlY2tlZDtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgaWYgKHRoaXMuY2hlY2tlZCkge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBLVFV0aWwuYWRkQ2xhc3MobWVzc2FnZSwgJ2FjdGl2ZScpO1xyXG4gICAgICAgICAgICAgICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIEtUVXRpbC5yZW1vdmVDbGFzcyhtZXNzYWdlLCAnYWN0aXZlJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgIC8vIEluZGl2aWR1YWwgc2VsZWN0aW9uXHJcbiAgICAgICAgICAgIEtUVXRpbC5vbihfbGlzdEVsLCAnW2RhdGEtaW5ib3g9XCJtZXNzYWdlXCJdIFtkYXRhLWluYm94PVwiYWN0aW9uc1wiXSAuY2hlY2tib3ggaW5wdXQnLCAnY2xpY2snLCBmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgIHZhciBpdGVtID0gdGhpcy5jbG9zZXN0KCdbZGF0YS1pbmJveD1cIm1lc3NhZ2VcIl0nKTtcclxuXHJcbiAgICAgICAgICAgICAgICBpZiAoaXRlbSAmJiB0aGlzLmNoZWNrZWQpIHtcclxuICAgICAgICAgICAgICAgICAgICBLVFV0aWwuYWRkQ2xhc3MoaXRlbSwgJ2FjdGl2ZScpO1xyXG4gICAgICAgICAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgICAgICAgICBLVFV0aWwucmVtb3ZlQ2xhc3MoaXRlbSwgJ2FjdGl2ZScpO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9LFxyXG5cclxuICAgICAgICBpbml0VmlldzogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIC8vIEJhY2sgdG8gbGlzdGluZ1xyXG4gICAgICAgICAgICBLVFV0aWwub24oX3ZpZXdFbCwgJ1tkYXRhLWluYm94PVwiYmFja1wiXScsICdjbGljaycsIGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICAgICAgICAgLy8gZGVtbyBsb2FkaW5nXHJcbiAgICAgICAgICAgICAgICB2YXIgbG9hZGluZyA9IG5ldyBLVERpYWxvZyh7XHJcbiAgICAgICAgICAgICAgICAgICAgJ3R5cGUnOiAnbG9hZGVyJyxcclxuICAgICAgICAgICAgICAgICAgICAncGxhY2VtZW50JzogJ3RvcCBjZW50ZXInLFxyXG4gICAgICAgICAgICAgICAgICAgICdtZXNzYWdlJzogJ0xvYWRpbmcgLi4uJ1xyXG4gICAgICAgICAgICAgICAgfSk7XHJcblxyXG4gICAgICAgICAgICAgICAgbG9hZGluZy5zaG93KCk7XHJcblxyXG4gICAgICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbigpIHtcclxuICAgICAgICAgICAgICAgICAgICBsb2FkaW5nLmhpZGUoKTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgS1RVdGlsLmFkZENsYXNzKF9saXN0RWwsICdkLWJsb2NrJyk7XHJcbiAgICAgICAgICAgICAgICAgICAgS1RVdGlsLnJlbW92ZUNsYXNzKF9saXN0RWwsICdkLW5vbmUnKTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgS1RVdGlsLmFkZENsYXNzKF92aWV3RWwsICdkLW5vbmUnKTtcclxuICAgICAgICAgICAgICAgICAgICBLVFV0aWwucmVtb3ZlQ2xhc3MoX3ZpZXdFbCwgJ2QtYmxvY2snKTtcclxuICAgICAgICAgICAgICAgIH0sIDcwMCk7XHJcbiAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgLy8gRXhwYW5kL0NvbGxhcHNlIHJlcGx5XHJcbiAgICAgICAgICAgIEtUVXRpbC5vbihfdmlld0VsLCAnW2RhdGEtaW5ib3g9XCJtZXNzYWdlXCJdJywgJ2NsaWNrJywgZnVuY3Rpb24oZSkge1xyXG4gICAgICAgICAgICAgICAgdmFyIG1lc3NhZ2UgPSB0aGlzLmNsb3Nlc3QoJ1tkYXRhLWluYm94PVwibWVzc2FnZVwiXScpO1xyXG5cclxuICAgICAgICAgICAgICAgIHZhciBkcm9wZG93blRvZ2dsZUVsID0gS1RVdGlsLmZpbmQodGhpcywgJ1tkYXRhLXRvZ2dsZT1cImRyb3Bkb3duXCJdJyk7XHJcbiAgICAgICAgICAgICAgICB2YXIgdG9vbGJhckVsID0gS1RVdGlsLmZpbmQodGhpcywgJ1tkYXRhLWluYm94PVwidG9vbGJhclwiXScpO1xyXG5cclxuICAgICAgICAgICAgICAgIC8vIHNraXAgZHJvcGRvd24gdG9nZ2xlIGNsaWNrXHJcbiAgICAgICAgICAgICAgICBpZiAoZS50YXJnZXQgPT09IGRyb3Bkb3duVG9nZ2xlRWwgfHwgKGRyb3Bkb3duVG9nZ2xlRWwgJiYgZHJvcGRvd25Ub2dnbGVFbC5jb250YWlucyhlLnRhcmdldCkgPT09IHRydWUpKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xyXG4gICAgICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgICAgIC8vIHNraXAgZ3JvdXAgYWN0aW9ucyBjbGlja1xyXG4gICAgICAgICAgICAgICAgaWYgKGUudGFyZ2V0ID09PSB0b29sYmFyRWwgfHwgKHRvb2xiYXJFbCAmJiB0b29sYmFyRWwuY29udGFpbnMoZS50YXJnZXQpID09PSB0cnVlKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTtcclxuICAgICAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgICAgICAgICBpZiAoS1RVdGlsLmhhc0NsYXNzKG1lc3NhZ2UsICd0b2dnbGUtb24nKSkge1xyXG4gICAgICAgICAgICAgICAgICAgIEtUVXRpbC5hZGRDbGFzcyhtZXNzYWdlLCAndG9nZ2xlLW9mZicpO1xyXG4gICAgICAgICAgICAgICAgICAgIEtUVXRpbC5yZW1vdmVDbGFzcyhtZXNzYWdlLCAndG9nZ2xlLW9uJyk7XHJcbiAgICAgICAgICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICAgICAgICAgIEtUVXRpbC5yZW1vdmVDbGFzcyhtZXNzYWdlLCAndG9nZ2xlLW9mZicpO1xyXG4gICAgICAgICAgICAgICAgICAgIEtUVXRpbC5hZGRDbGFzcyhtZXNzYWdlLCAndG9nZ2xlLW9uJyk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH0sXHJcblxyXG4gICAgICAgIGluaXRSZXBseTogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIF9pbml0RWRpdG9yKF9yZXBseUVsLCAna3RfdG9kb19yZXBseV9lZGl0b3InKTtcclxuICAgICAgICAgICAgX2luaXRBdHRhY2htZW50cygna3RfdG9kb19yZXBseV9hdHRhY2htZW50cycpO1xyXG4gICAgICAgIH1cclxuICAgIH07XHJcbn0oKTtcclxuXHJcbi8vIENsYXNzIEluaXRpYWxpemF0aW9uXHJcbmpRdWVyeShkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oKSB7XHJcbiAgICBLVEFwcFRvZG8uaW5pdCgpO1xyXG59KTtcclxuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/custom/todo/todo.js\n");

/***/ }),

/***/ 117:
/*!***************************************************************!*\
  !*** multi ./resources/metronic/js/pages/custom/todo/todo.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\3arabiat\resources\metronic\js\pages\custom\todo\todo.js */"./resources/metronic/js/pages/custom/todo/todo.js");


/***/ })

/******/ });