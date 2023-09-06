/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************!*\
  !*** ./assets/src/js/admin-notifications.js ***!
  \**********************************************/
document.addEventListener('DOMContentLoaded', function () {
  // alert('notifications');
});
jQuery(document).ready(function ($) {
  var selectGlobalForm = $('.select-global-form select');
  selectGlobalForm.on('focus', function (e) {
    $(this).parent().addClass('active');
  });
  selectGlobalForm.on('blur', function (e) {
    $(this).parent().removeClass('active');
  });
  $("body").on("click", "#delete-group", function (e) {
    $(this).parent('.rivo-wts-rename-group').remove();
  });
  $('select#selected_icon').selectric();
  var counter = 0;
  $("body").on("click", "#add-new-input-field", function (e) {
    counter++;
    var selectedId = 'selected_icon' + counter;
    var parentField = $('.modify-inputs');
    var cloned = $(".rivo-wts-rename-group:first").clone().removeClass('rivo-wts-rename-group-hidden').appendTo(parentField);
    cloned.find('select').attr('id', selectedId);
    cloned.find('select').removeClass('form-option-cloned');
    $("select#".concat(selectedId)).selectric();
    console.log('Click');

    // jQuery.ajax({
    //     url: '/wp-admin/admin-ajax.php',
    //     type: 'POST',
    //     data: {
    //         action: 'add_new_modify_input',
    //         contentType: "application/json; charset=utf-8",
    //     },
    //     success: function (data) {
    //         const parentField = $('.modify-inputs');
    //         let json = JSON.parse(data);
    //         console.log(json)
    //         parentField.append(json.field_info);
    //     },
    //     error : function(error){ console.log(error) }
    // });

    // $(".rivo-wts-rename-group").clone().appendTo(parentField);
  });

  $("body").on("click", "#four_step_button", function (e) {
    var formName = $('#global-form').find(":selected").val();
    var formMessageBefore = $('#form_message_before_successful').val();
    var formMessageAfter = $('#form_message_after_successful').val();
    var addFormUrl = $("input[name='submition_url']");
    var addFormUrlCheck;
    if (addFormUrl.is(":checked")) {
      addFormUrlCheck = 'true';
    } else {
      addFormUrlCheck = 'false';
    }
    var data_information = {};
    var dara_attributes = {
      'text_before': formMessageBefore,
      'replaces': '',
      'text_after': formMessageAfter,
      'add_url': addFormUrlCheck
    };
    var replacesArray = [];
    $(".rivo-wts-rename-group").each(function () {
      if (!$(this).hasClass('rivo-wts-rename-group-hidden')) {
        var textBefore = $(this).find('#input_original_name').val();
        var textAfter = $(this).find('#input_replace_name').val();
        var formIcon = $(this).find('.form-options').find(":selected").val();
        var mapReplaces = new Map([]);

        // let infoObject = [textBefore, textAfter];

        mapReplaces.set('text_before', textBefore);
        mapReplaces.set('text_after', textAfter);
        console.log($(this).find('#input_original_name').val());
        console.log($(this).find('#input_replace_name').val());
        if ($(this).find('#rivo_wts_bold_format').hasClass('selected')) {
          // infoObject.push('true');
          mapReplaces.set('bold', 'true');
        } else {
          // infoObject.push('false');
          mapReplaces.set('bold', 'false');
        }
        if ($(this).find('#rivo_wts_italic_format').hasClass('selected')) {
          // infoObject.push('true');
          mapReplaces.set('italic', 'true');
        } else {
          // infoObject.push('false');
          mapReplaces.set('italic', 'false');
        }
        mapReplaces.set('icon', formIcon);

        // dara_attributes.replaces = infoObject;
        // Object.assign(dara_attributes.replaces, infoObject);
        replacesArray.push(Object.fromEntries(mapReplaces));
      }
    });
    dara_attributes.replaces = replacesArray;
    data_information = dara_attributes;
    console.log(data_information);
    jQuery.ajax({
      url: '/wp-admin/admin-ajax.php',
      type: 'POST',
      data: {
        action: 'four_step_save',
        contentType: "application/json; charset=utf-8",
        form_name: formName,
        form_info: data_information
      },
      success: function success(data) {
        var json = JSON.parse(data);
        console.log(json.field_info);
      },
      error: function error(_error) {
        console.log(_error);
      }
    });
  });
  $("body").on("change", "#global-form", function (e) {
    var preloader = $('div.preloader');
    console.log($(this).val());
    var globalFormSettings = $('.global-form-settings');
    preloader.removeClass('preloader-hidden');
    jQuery.ajax({
      url: '/wp-admin/admin-ajax.php',
      type: 'POST',
      data: {
        action: 'select_another_form',
        contentType: "application/json; charset=utf-8",
        form_name: $(this).val()
      },
      success: function success(data) {
        var json = JSON.parse(data);
        // console.log(json.form_info);
        globalFormSettings.html(json.form_info);
        console.log('Adding HTML');
        $('select#selected_icon').selectric();
        preloader.addClass('preloader-hidden');
      },
      error: function error(_error2) {
        console.log(_error2);
      }
    });
  });
});
/******/ })()
;
//# sourceMappingURL=admin-notifications.js.map