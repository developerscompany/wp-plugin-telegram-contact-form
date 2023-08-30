jQuery(document).ready(function($) {
    const pluginIntegrationBlock = $('.plugin-integration');
    const nextStepButton = $('#third_step_button');

    $("body").on("change", "input[name='integration_type']", function() {
        const integrationType = $(this).val();
        if(integrationType === 'forms'){
            pluginIntegrationBlock.css('display', 'block');
            // nextStepButton.addClass('isDisabled');
            $("input[name='plugin_integration']").each(function () {
                if(this.checked){
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

    $("body").on("change", "input[name='plugin_integration']", function() {
        $("input[name='plugin_integration']").each(function () {
            if(this.checked){
                nextStepButton.removeClass('isDisabled');
                $('.message-field').html('');
                return false;
            } else {
                nextStepButton.addClass('isDisabled');
                $('.message-field').html('Select plugin, please');
            }
        });
    });

    $("body").on("click", "#third_step_button", function(e) {
        if($(this).hasClass('isDisabled')){
            e.preventDefault();
        } else {
            const integrationType = $('input[name="integration_type"]:checked').attr('id');
            const pluginsList = [];

            if(integrationType === 'forms'){
                $('input[name="plugin_integration"]:checked').each(function () {
                    const sThisVal = $(this).attr('id');
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
                    plugins_list: pluginsList,
                },
                success: function (data) {
                    let json = JSON.parse(data);
                },
                error : function(error){ console.log(error) }
            });
        }
    })
});