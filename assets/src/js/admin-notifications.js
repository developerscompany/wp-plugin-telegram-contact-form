document.addEventListener('DOMContentLoaded', () => {
    // alert('notifications');
})

jQuery(document).ready(function($) {
    const selectGlobalForm =  $('.select-global-form select');
    selectGlobalForm.on('focus', function(e) {
        $(this).parent().addClass('active');
    });
    selectGlobalForm.on('blur', function(e) {
        $(this).parent().removeClass('active');
    });

    $("body").on("click", "#delete-group", function(e) {
        $(this).parent('.rivo-wts-rename-group').remove();
    });

    $("body").on("click", "#add-new-input-field", function(e) {

        console.log('777777777');

        jQuery.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'add_new_modify_input',
                contentType: "application/json; charset=utf-8",
            },
            success: function (data) {
                const parentField = $('.modify-inputs');
                let json = JSON.parse(data);

                console.log(json)

                parentField.append(json.field_info);
            },
            error : function(error){ console.log(error) }
        });

    })

    $("body").on("click", "#four_step_button", function(e) {
        const formName = $('#global-form').find(":selected").val();
        const formMessageBefore = $('#form_message_before_successful').val();
        const formMessageAfter = $('#form_message_after_successful').val();
        const addFormUrl = $("input[name='submition_url']");
        let addFormUrlCheck;
        if(addFormUrl.is(":checked")){
            addFormUrlCheck = 'true';
        } else {
            addFormUrlCheck = 'false';
        }
        let data_information = {};

        let dara_attributes = {'text_before' : formMessageBefore, 'replaces' : '', 'text_after': formMessageAfter, 'add_url': addFormUrlCheck};
        let replacesArray = [];
        $(".rivo-wts-rename-group").each(function() {
            const textBefore = $(this).find('#input_original_name').val();
            const textAfter = $(this).find('#input_replace_name').val();
            const formIcon = $(this).find('#selected_icon').find(":selected").val();
            let mapReplaces = new Map([]);

            // let infoObject = [textBefore, textAfter];

            mapReplaces.set('text_before', textBefore);
            mapReplaces.set('text_after', textAfter);
            console.log($(this).find('#input_original_name').val());
            console.log($(this).find('#input_replace_name').val());

            if($(this).find('#rivo_wts_bold_format').hasClass('selected')){
                // infoObject.push('true');
                mapReplaces.set('bold','true');
            } else {
                // infoObject.push('false');
                mapReplaces.set('bold','false');
            }

            if($(this).find('#rivo_wts_italic_format').hasClass('selected')){
                // infoObject.push('true');
                mapReplaces.set('italic','true');
            } else {
                // infoObject.push('false');
                mapReplaces.set('italic','false');
            }

            mapReplaces.set('icon', formIcon);


            // dara_attributes.replaces = infoObject;
            // Object.assign(dara_attributes.replaces, infoObject);
            replacesArray.push(Object.fromEntries(mapReplaces));
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
                form_info: data_information,
            },
            success: function (data) {
                let json = JSON.parse(data);
                console.log(json.field_info);
            },
            error : function(error){ console.log(error) }
        });
    })

    $("body").on("change", "#global-form", function(e) {
        console.log($(this).val());
    });
});