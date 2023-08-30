/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************!*\
  !*** ./assets/src/js/admin-integrations.js ***!
  \*********************************************/
jQuery(document).ready(function ($) {
  var pluginIntegrationBlock = $('.plugin-integration');
  var nextStepButton = $('#third_step_button');
  $("body").on("change", "input[name='integration_type']", function () {
    var integrationType = $(this).val();
    if (integrationType === 'forms') {
      pluginIntegrationBlock.css('display', 'block');
      // nextStepButton.addClass('isDisabled');
      $("input[name='plugin_integration']").each(function () {
        if (this.checked) {
          nextStepButton.removeClass('isDisabled');
          return false;
        } else {
          nextStepButton.addClass('isDisabled');
          $('.message-field').html('Select plugin, please');
          return false;
        }
      });
    } else {
      pluginIntegrationBlock.css('display', 'none');
      nextStepButton.removeClass('isDisabled');
      $('.message-field').html('');
    }
  });
  $("body").on("change", "input[name='plugin_integration']", function () {
    $("input[name='plugin_integration']").each(function () {
      if (this.checked) {
        nextStepButton.removeClass('isDisabled');
        $('.message-field').html('');
        return false;
      } else {
        nextStepButton.addClass('isDisabled');
        $('.message-field').html('Select plugin, please');
      }
    });
  });
  $("body").on("click", "#third_step_button", function (e) {
    if ($(this).hasClass('isDisabled')) {
      e.preventDefault();
    } else {
      var integrationType = $('input[name="integration_type"]:checked').attr('id');
      var pluginsList = [];
      if (integrationType === 'forms') {
        $('input[name="plugin_integration"]:checked').each(function () {
          var sThisVal = $(this).attr('id');
          pluginsList.push(sThisVal);
        });
      }
      jQuery.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {
          action: 'third_step_save',
          contentType: "application/json; charset=utf-8",
          integration_type: integrationType,
          plugins_list: pluginsList
        },
        success: function success(data) {
          var json = JSON.parse(data);
        },
        error: function error(_error) {
          console.log(_error);
        }
      });
    }
  });
});
/******/ })()
;
//# sourceMappingURL=admin-integrations.js.map