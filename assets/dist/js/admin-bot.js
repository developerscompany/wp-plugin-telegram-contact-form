/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./assets/src/js/admin-bot.js ***!
  \************************************/
jQuery(document).ready(function ($) {
  var buttonNext = $("#second_step_button");
  if ($("#tm_bot_token").val().length < 25) {
    $('.aply-tocken-button').prop("disabled", true);
  } else {
    $('.aply-tocken-button').prop("disabled", false);
  }
  $("#tm_bot_token").on('keyup', function () {
    var messageField = $('.message-field');
    var inputField = $('#tm_bot_token');
    if ($("#tm_bot_token").val().length < 25) {
      messageField.text('Please, enter a valid token');
      messageField.removeClass('apply-field');
      messageField.addClass('error-field');
      inputField.addClass('input-error');
      buttonNext.addClass('isDisabled');
      $('.aply-tocken-button').prop("disabled", true);
    } else {
      messageField.text('');
      messageField.removeClass('error-field');
      inputField.removeClass('input-error');
      $('.aply-tocken-button').prop("disabled", false);
    }
  });
  $(".aply-tocken-button").on('click', function () {
    jQuery.ajax({
      url: '/wp-admin/admin-ajax.php',
      type: 'POST',
      data: {
        action: 'token_apply',
        contentType: "application/json; charset=utf-8",
        token_id: $("#tm_bot_token").val()
      },
      success: function success(data) {
        var messageField = $('.message-field');
        var json = JSON.parse(data);
        // console.log(json['chats_list']);
        if (json['request'] === 'token_successfull') {
          messageField.text('Token successfully saved');
          messageField.addClass('apply-field');
          // console.log(json['request_chat_list']);
          if (json['request_chat_list'] === 'true') {
            $('.chats-list').html(json['chats_list']);
            buttonNext.addClass('isDisabled');
          } else {
            $('.chats-list').html('');
            buttonNext.removeClass('isDisabled');
          }
        } else {
          messageField.text('Token error');
          messageField.removeClass('apply-field');
          messageField.addClass('error-field');
          buttonNext.addClass('isDisabled');
          $('.chats-list').html('');
        }
      },
      error: function error(_error) {
        console.log(_error);
      }
    });
  });
  $("body").on("change", "input[name='fav_language']", function () {
    // console.log($('input[name="fav_language"]:checked').attr('id'));
    $("#second_step_button").removeClass('isDisabled');
  });
  if ($('input[name="fav_language"]:checked').length === 0) {
    $("#second_step_button").addClass('isDisabled');
  }
  $("body").on("click", "#second_step_button", function (e) {
    if ($(this).hasClass('isDisabled')) {
      e.preventDefault();
    } else {
      var chatId = $('input[name="fav_language"]:checked').attr('id');
      var tokenId = $("#tm_bot_token").val();
      jQuery.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {
          action: 'second_step_save',
          contentType: "application/json; charset=utf-8",
          chat_id: chatId,
          token_id: tokenId
        },
        success: function success(data) {
          var messageField = $('.message-field');
          var buttonNext = $(".second-step-button");
          var json = JSON.parse(data);
        },
        error: function error(_error2) {
          console.log(_error2);
        }
      });
    }
  });
});
/******/ })()
;
//# sourceMappingURL=admin-bot.js.map