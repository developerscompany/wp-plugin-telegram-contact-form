jQuery(document).ready(function () {

    function getWatchedForms(){
        const checkboxes = jQuery('.rft-watch-checbox');
        let watchedForms = [];
        jQuery.each(checkboxes, function () {
            if ( jQuery(this).is(':checked') ){
                const formId = jQuery(this).attr('id').replace('rft-watch-', '');
                watchedForms.push( formId ); 
            }           
        });

        if ( watchedForms.length < 1 ) {
            watchedForms = 'none';
        }
       
        return watchedForms;
    }



    function getinputFormat(){       
        const inputs = jQuery('.rft-rename-group');
        let intputsData = [];
        jQuery.each(inputs, function () {
            const inputOptions = {
                id: jQuery(this)[0].id.replace('rft-input-id-', ''),
                emoji: jQuery(this).find('select').val(),
                original: jQuery(this).find('input[name="input_original_name"]')[0].value,
                replace: jQuery(this).find('input[name="input_replace_name"]')[0].value,
                bold: jQuery(this).find('input[name="rft-bold-format-value"]')[0].value,
                italic: jQuery(this).find('input[name="rft-italic-format-value"]')[0].value,
            }         
            intputsData.push(inputOptions);            
        });

        // console.log(intputsData);
        return intputsData;
    }

    // jQuery('.rft-submit1').click(function(e) {
    //     e.preventDefault();
    //     getinputFormat();
    // });


    function getIntegrations(){
        let integration = [];
        const checkboxes = jQuery('.rft-integration-checkbox');

        let default_emails = jQuery('#default_emails[name="use_integrations"]').is(':checked');      

        jQuery.each(checkboxes, function () {
            if ( jQuery(this).is(':checked') ){
                const integrationName = jQuery(this).attr('id').replace('rft-watch-', '');
                integration.push( integrationName ); 
            }           
        });

        // console.log(integration);

        if ( default_emails || integration.length < 1 ) {
            integration = 'none';
        }
       
        return integration;
    }
    
    function getPreventedEmails(){
        let preventedEmails = [];
       
        if ( jQuery('#wp_mail_prevent_email').is(':checked') ){
            preventedEmails.push( 'wp_mail' ); 
        }
        if ( jQuery('#wpcf7_prevent_email').is(':checked') ){
            preventedEmails.push( 'wpcf7' ); 
        }
        if ( jQuery('#wc_prevent_email').is(':checked') ){
            preventedEmails.push( 'wc' ); 
        }       
       
        return preventedEmails;
    }

    function show_notification( text, status ){
        const notice = jQuery('#tm-bot-notices');
        const responce = JSON.parse(text);

        notice.removeClass('error');
        notice.removeClass('success');

        if (status === "success"){
            notice.addClass('success');
        } else {
            notice.addClass('error');            
        }

        console.log(responce);

        notice.html( JSON.stringify( JSON.parse(text) ) );
        notice.fadeIn();
    }

 
    function displayNavLinks(){        
        let useIntegraions = jQuery( 'input#mod_emails').is(':checked');     
        if ( useIntegraions ) {
            const integrations = jQuery('.rft-integration-checkbox');
            jQuery('.form-group.integrations').fadeIn();
            jQuery('.integration-tab-link').hide();            
            jQuery.each(integrations, function () {                
                let tabLink = '.' + jQuery(this).attr('id') + '-mod';           
                if ( jQuery(this).is(':checked') ) {
                    jQuery( tabLink ).fadeIn();
                }                
           });
        } else {
            jQuery('.form-group.integrations').fadeOut();
            jQuery('.integration-tab-link').hide();
            jQuery('.integration-tab-link.default-mod').fadeIn();
        }

    }
    
    jQuery('input[name="use_integrations"]').on('change', displayNavLinks);
    jQuery('input.rft-integration-checkbox').on('change', displayNavLinks);


    jQuery('.rft-submit').click(function(e) {
        e.preventDefault();

        const button = jQuery(this);
        const watchedForms = getWatchedForms();
        const integrations = getIntegrations();
        const inputFormat = getinputFormat();
        const preventEmails = getPreventedEmails();

        const botToken = jQuery('#tm_bot_token').val();
        const chatId = jQuery('#tm_bot_chat_id').val();

        const beforeMsgTxt = jQuery('#tm_bot_msg_before').val();
        const botAddUrl = String( jQuery('#tm_bot_add_form_url').is(':checked') );

        const nonce = jQuery('input[name="rft_adm_nonce"]').val(); 

        button.addClass('disabled');
        button.text('Saving');

        let data = { 
            action: 'rft_save_settings_admin_page',
            watchedForms,    
            integrations,
            inputFormat,
            preventEmails,
            botToken,
            chatId,
            beforeMsgTxt,
            botAddUrl,
            nonce
        }

        console.log(data);

        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: data,   
            success: function( data ) {                
                button.removeClass('disabled');
                button.text('Save Settings'); 
                if(data === 'ok') {
                   window.location.reload();                             
                } else {
                   console.log(data);
                }
            },
            error: function( err ) {
               button.removeClass('disabled');
               button.text('Save Settings');
               console.log(err);
            }
        
        });
          
    });


    // testing bot settings
    jQuery('.tm_bot_test').click(function(e) {
        e.preventDefault();        
        const action = jQuery(this).attr('data-action');
        const botToken = jQuery('#tm_bot_token').val();
        const chatId = jQuery('#tm_bot_chat_id').val();
        let beforeMsgTxt = jQuery('#tm_bot_msg_before').val();

        let url = 'https://api.telegram.org/bot' + botToken + '/' + action;
        
        if ( action == 'sendMessage') {
            beforeMsgTxt = beforeMsgTxt.length == 0 ? 'Test message delivered, your setting are ok' : beforeMsgTxt;
            url += '?chat_id=' + chatId + '&text=' + beforeMsgTxt;           
        }
        console.log(url);

        let botReq = new XMLHttpRequest();
        botReq.open("GET", url, true);
        botReq.send();
        botReq.onreadystatechange = function() {
            if (botReq.readyState != 4) {
              return
            }          
            if (botReq.status === 200) {
                let msg = ('result', botReq.responseText);
                show_notification(msg, 'success');
            } else {
                let msg = ('err', botReq.responseText);
                show_notification(msg, 'error');
            }
          }
    });


    jQuery('.btn-format').click(function(e) {
        e.preventDefault();
        jQuery(this).toggleClass('selected');
        $val = jQuery(this).hasClass('selected') ? true : false;

        const inpGroup = jQuery(this).closest('.rft-rename-group');

        if ( jQuery(this).hasClass('rft-bold-format') ){
            inpGroup.find('input[name="rft-bold-format-value"]').val($val);            
        }
        if ( jQuery(this).hasClass('rft-italic-format') ){
            inpGroup.find('input[name="rft-italic-format-value"]').val($val);  
        }
        if ( jQuery(this).hasClass('rft-active-format') ){
            inpGroup.find('input[name="rft-active-format-value"]').val($val);  
        }
    });
    

    tabbis();  
    
    displayNavLinks();
   



});