/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/admin.js":
/*!********************************!*\
  !*** ./assets/src/js/admin.js ***!
  \********************************/
/***/ (function() {

jQuery(document).ready(function () {
  function getWatchedForms() {
    var checkboxes = jQuery('.rivo-wts-watch-checbox');
    var watchedForms = [];
    jQuery.each(checkboxes, function () {
      if (jQuery(this).is(':checked')) {
        var formId = jQuery(this).attr('id').replace('rivo-wts-watch-', '');
        watchedForms.push(formId);
      }
    });
    if (watchedForms.length < 1) {
      watchedForms = 'none';
    }
    return watchedForms;
  }
  function getinputFormat() {
    var inputs = jQuery('.rivo-wts-rename-group');
    var intputsData = [];
    jQuery.each(inputs, function () {
      var inputOptions = {
        id: jQuery(this)[0].id.replace('rivo-wts-input-id-', ''),
        emoji: jQuery(this).find('select').val(),
        original: jQuery(this).find('input[name="input_original_name"]')[0].value,
        replace: jQuery(this).find('input[name="input_replace_name"]')[0].value,
        bold: jQuery(this).find('input[name="rivo-wts-bold-format-value"]')[0].value,
        italic: jQuery(this).find('input[name="rivo-wts-italic-format-value"]')[0].value
      };
      intputsData.push(inputOptions);
    });

    // console.log(intputsData);
    return intputsData;
  }

  // jQuery('.rivo-wts-submit1').click(function(e) {
  //     e.preventDefault();
  //     getinputFormat();
  // });

  function getIntegrations() {
    var integration = [];
    var checkboxes = jQuery('.rivo-wts-integration-checkbox');
    var default_emails = jQuery('#default_emails[name="use_integrations"]').is(':checked');
    jQuery.each(checkboxes, function () {
      if (jQuery(this).is(':checked')) {
        var integrationName = jQuery(this).attr('id').replace('rivo-wts-watch-', '');
        integration.push(integrationName);
      }
    });

    // console.log(integration);

    if (default_emails || integration.length < 1) {
      integration = 'none';
    }
    return integration;
  }
  function getPreventedEmails() {
    var preventedEmails = [];
    if (jQuery('#wp_mail_prevent_email').is(':checked')) {
      preventedEmails.push('wp_mail');
    }
    if (jQuery('#wpcf7_prevent_email').is(':checked')) {
      preventedEmails.push('wpcf7');
    }
    if (jQuery('#wc_prevent_email').is(':checked')) {
      preventedEmails.push('wc');
    }
    return preventedEmails;
  }
  function show_notification(text, status) {
    var notice = jQuery('#tm-bot-notices');
    var responce = JSON.parse(text);
    notice.removeClass('error');
    notice.removeClass('success');
    if (status === "success") {
      notice.addClass('success');
    } else {
      notice.addClass('error');
    }
    console.log(responce);
    notice.html(JSON.stringify(JSON.parse(text)));
    notice.fadeIn();
  }
  function displayNavLinks() {
    var useIntegraions = jQuery('input#mod_emails').is(':checked');
    if (useIntegraions) {
      var integrations = jQuery('.rivo-wts-integration-checkbox');
      jQuery('.form-group.integrations').fadeIn();
      jQuery('.integration-tab-link').hide();
      jQuery.each(integrations, function () {
        var tabLink = '.' + jQuery(this).attr('id') + '-mod';
        if (jQuery(this).is(':checked')) {
          jQuery(tabLink).fadeIn();
        }
      });
    } else {
      jQuery('.form-group.integrations').fadeOut();
      jQuery('.integration-tab-link').hide();
      jQuery('.integration-tab-link.default-mod').fadeIn();
    }
  }
  jQuery('input[name="use_integrations"]').on('change', displayNavLinks);
  jQuery('input.rivo-wts-integration-checkbox').on('change', displayNavLinks);
  jQuery('.rivo-wts-submit').click(function (e) {
    e.preventDefault();
    var button = jQuery(this);
    var watchedForms = getWatchedForms();
    var integrations = getIntegrations();
    var inputFormat = getinputFormat();
    var preventEmails = getPreventedEmails();
    var botToken = jQuery('#tm_bot_token').val();
    var chatId = jQuery('#tm_bot_chat_id').val();
    var beforeMsgTxt = jQuery('#tm_bot_msg_before').val();
    var botAddUrl = String(jQuery('#tm_bot_add_form_url').is(':checked'));
    var nonce = jQuery('input[name="rft_adm_nonce"]').val();
    button.addClass('disabled');
    button.text('Saving');
    var data = {
      action: 'rft_save_settings_admin_page',
      watchedForms: watchedForms,
      integrations: integrations,
      inputFormat: inputFormat,
      preventEmails: preventEmails,
      botToken: botToken,
      chatId: chatId,
      beforeMsgTxt: beforeMsgTxt,
      botAddUrl: botAddUrl,
      nonce: nonce
    };
    console.log(data);
    jQuery.ajax({
      url: frontend_ajax_object.ajaxurl,
      type: 'POST',
      data: data,
      success: function success(data) {
        button.removeClass('disabled');
        button.text('Save Settings');
        if (data === 'ok') {
          window.location.reload();
        } else {
          console.log(data);
        }
      },
      error: function error(err) {
        button.removeClass('disabled');
        button.text('Save Settings');
        console.log(err);
      }
    });
  });

  // testing bot settings
  jQuery('.tm_bot_test').click(function (e) {
    e.preventDefault();
    var action = jQuery(this).attr('data-action');
    var botToken = jQuery('#tm_bot_token').val();
    var chatId = jQuery('#tm_bot_chat_id').val();
    var beforeMsgTxt = jQuery('#tm_bot_msg_before').val();
    var url = 'https://api.telegram.org/bot' + botToken + '/' + action;
    if (action == 'sendMessage') {
      beforeMsgTxt = beforeMsgTxt.length == 0 ? 'Test message delivered, your setting are ok' : beforeMsgTxt;
      url += '?chat_id=' + chatId + '&text=' + beforeMsgTxt;
    }
    console.log(url);
    var botReq = new XMLHttpRequest();
    botReq.open("GET", url, true);
    botReq.send();
    botReq.onreadystatechange = function () {
      if (botReq.readyState != 4) {
        return;
      }
      if (botReq.status === 200) {
        var msg = ('result', botReq.responseText);
        show_notification(msg, 'success');
      } else {
        var _msg = ('err', botReq.responseText);
        show_notification(_msg, 'error');
      }
    };
  });
  jQuery("body").on("click", ".btn-format", function (e) {
    e.preventDefault();
    jQuery(this).toggleClass('selected');
    $val = jQuery(this).hasClass('selected') ? true : false;
    var inpGroup = jQuery(this).closest('.rivo-wts-rename-group');
    if (jQuery(this).hasClass('rivo-wts-bold-format')) {
      inpGroup.find('input[name="rivo-wts-bold-format-value"]').val($val);
    }
    if (jQuery(this).hasClass('rivo-wts-italic-format')) {
      inpGroup.find('input[name="rivo-wts-italic-format-value"]').val($val);
    }
    if (jQuery(this).hasClass('rivo-wts-active-format')) {
      inpGroup.find('input[name="rivo-wts-active-format-value"]').val($val);
    }
  });
  displayNavLinks();
});

/***/ }),

/***/ "./assets/src/scss/admin.scss":
/*!************************************!*\
  !*** ./assets/src/scss/admin.scss ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	!function() {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = function(result, chunkIds, fn, priority) {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var chunkIds = deferred[i][0];
/******/ 				var fn = deferred[i][1];
/******/ 				var priority = deferred[i][2];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every(function(key) { return __webpack_require__.O[key](chunkIds[j]); })) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	!function() {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/admin": 0,
/******/ 			"css/admin": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = function(chunkId) { return installedChunks[chunkId] === 0; };
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = function(parentChunkLoadingFunction, data) {
/******/ 			var chunkIds = data[0];
/******/ 			var moreModules = data[1];
/******/ 			var runtime = data[2];
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some(function(id) { return installedChunks[id] !== 0; })) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkGloria"] = self["webpackChunkGloria"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	}();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/admin"], function() { return __webpack_require__("./assets/src/js/admin.js"); })
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/admin"], function() { return __webpack_require__("./assets/src/scss/admin.scss"); })
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=admin.js.map