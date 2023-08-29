jQuery(document).ready(function($) {
    const buttonNext = $("#second_step_button");

    if($("#tm_bot_token").val().length < 25){
        $('.aply-tocken-button').prop("disabled", true);
    } else {
        $('.aply-tocken-button').prop("disabled", false);
    }

    $("#tm_bot_token").on('keyup', function (){
        const messageField = $('.message-field');
        const inputField = $('#tm_bot_token');
       if($("#tm_bot_token").val().length < 25){
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

    $(".aply-tocken-button").on('click', function (){
        jQuery.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'token_apply',
                contentType: "application/json; charset=utf-8",
                token_id: $("#tm_bot_token").val(),
            },
            success: function (data) {
                const messageField = $('.message-field');
                let json = JSON.parse(data);
                // console.log(json['chats_list']);
                if(json['request'] === 'token_successfull'){
                    messageField.text('Token successfully saved');
                    messageField.addClass('apply-field');
                    // console.log(json['request_chat_list']);
                    if(json['request_chat_list'] === 'true'){
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
            error : function(error){ console.log(error) }
        });
    });

    $("body").on("change", "input[name='single_chat_id']", function() {
        // console.log($('input[name="single_chat_id"]:checked').attr('id'));
        $("#second_step_button").removeClass('isDisabled');
    });

    if($('input[name="single_chat_id"]:checked').length === 0){
        $("#second_step_button").addClass('isDisabled');
    }

    $("body").on("click", "#second_step_button", function(e) {
        if($(this).hasClass('isDisabled')){
            e.preventDefault();
        } else {
            const chatId = $('input[name="single_chat_id"]:checked').attr('id');
            const tokenId = $("#tm_bot_token").val();

            jQuery.ajax({
                url: '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: {
                    action: 'second_step_save',
                    contentType: "application/json; charset=utf-8",
                    chat_id: chatId,
                    token_id: tokenId,
                },
                success: function (data) {
                    const messageField = $('.message-field');
                    const buttonNext = $(".second-step-button");
                    let json = JSON.parse(data);

                },
                error : function(error){ console.log(error) }
            });
        }
    })

});