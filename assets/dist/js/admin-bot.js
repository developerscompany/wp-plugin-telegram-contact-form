jQuery(document).ready((function(e){var t=e("#second_step_button");e("#tm_bot_token").val().length<25?e(".aply-tocken-button").prop("disabled",!0):e(".aply-tocken-button").prop("disabled",!1),e("#tm_bot_token").on("keyup",(function(){var s=e(".message-field"),a=e("#tm_bot_token");e("#tm_bot_token").val().length<25?(s.text("Please, enter a valid token"),s.removeClass("apply-field"),s.addClass("error-field"),a.addClass("input-error"),t.addClass("isDisabled"),e(".aply-tocken-button").prop("disabled",!0)):(s.text(""),s.removeClass("error-field"),a.removeClass("input-error"),e(".aply-tocken-button").prop("disabled",!1))})),e(".aply-tocken-button").on("click",(function(){jQuery.ajax({url:"/wp-admin/admin-ajax.php",type:"POST",data:{action:"token_apply",contentType:"application/json; charset=utf-8",token_id:e("#tm_bot_token").val()},success:function(s){var a=e(".message-field"),n=JSON.parse(s);"token_successfull"===n.request?(a.text("Token successfully saved"),a.addClass("apply-field"),"true"===n.request_chat_list?(e(".chats-list").html(n.chats_list),t.addClass("isDisabled")):(e(".chats-list").html(""),t.removeClass("isDisabled"))):(a.text("Token error"),a.removeClass("apply-field"),a.addClass("error-field"),t.addClass("isDisabled"),e(".chats-list").html(""))},error:function(e){console.log(e)}})})),e("body").on("change","input[name='single_chat_id']",(function(){e("#second_step_button").removeClass("isDisabled")})),0===e('input[name="single_chat_id"]:checked').length&&e("#second_step_button").addClass("isDisabled"),e("body").on("click","#second_step_button",(function(t){if(e(this).hasClass("isDisabled"))t.preventDefault();else{var s=e('input[name="single_chat_id"]:checked').attr("id"),a=e("#tm_bot_token").val();jQuery.ajax({url:"/wp-admin/admin-ajax.php",type:"POST",data:{action:"second_step_save",contentType:"application/json; charset=utf-8",chat_id:s,token_id:a},success:function(t){e(".message-field"),e(".second-step-button"),JSON.parse(t)},error:function(e){console.log(e)}})}}))}));