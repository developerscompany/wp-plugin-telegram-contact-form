!function(){var e,t={796:function(){jQuery(document).ready((function(){function e(e,t){var r=jQuery("#tm-bot-notices"),n=JSON.parse(e);r.removeClass("error"),r.removeClass("success"),"success"===t?r.addClass("success"):r.addClass("error"),console.log(n),r.html(JSON.stringify(JSON.parse(e))),r.fadeIn()}function t(){if(jQuery("input#mod_emails").is(":checked")){var e=jQuery(".rft-integration-checkbox");jQuery(".form-group.integrations").fadeIn(),jQuery(".integration-tab-link").hide(),jQuery.each(e,(function(){var e="."+jQuery(this).attr("id")+"-mod";jQuery(this).is(":checked")&&jQuery(e).fadeIn()}))}else jQuery(".form-group.integrations").fadeOut(),jQuery(".integration-tab-link").hide(),jQuery(".integration-tab-link.default-mod").fadeIn()}jQuery('input[name="use_integrations"]').on("change",t),jQuery("input.rft-integration-checkbox").on("change",t),jQuery(".rft-submit").click((function(e){e.preventDefault();var t,r,n,a,i,o,u=jQuery(this),s=function(){var e=jQuery(".rft-watch-checbox"),t=[];return jQuery.each(e,(function(){if(jQuery(this).is(":checked")){var e=jQuery(this).attr("id").replace("rft-watch-","");t.push(e)}})),t.length<1&&(t="none"),t}(),c=(t=[],r=jQuery(".rft-integration-checkbox"),n=jQuery('#default_emails[name="use_integrations"]').is(":checked"),jQuery.each(r,(function(){if(jQuery(this).is(":checked")){var e=jQuery(this).attr("id").replace("rft-watch-","");t.push(e)}})),(n||t.length<1)&&(t="none"),t),l=(a=jQuery(".rft-rename-group"),i=[],jQuery.each(a,(function(){var e={id:jQuery(this)[0].id.replace("rft-input-id-",""),emoji:jQuery(this).find("select").val(),original:jQuery(this).find('input[name="input_original_name"]')[0].value,replace:jQuery(this).find('input[name="input_replace_name"]')[0].value,bold:jQuery(this).find('input[name="rft-bold-format-value"]')[0].value,italic:jQuery(this).find('input[name="rft-italic-format-value"]')[0].value};i.push(e)})),i),f=(o=[],jQuery("#wp_mail_prevent_email").is(":checked")&&o.push("wp_mail"),jQuery("#wpcf7_prevent_email").is(":checked")&&o.push("wpcf7"),jQuery("#wc_prevent_email").is(":checked")&&o.push("wc"),o),d=jQuery("#tm_bot_token").val(),h=jQuery("#tm_bot_chat_id").val(),v=jQuery("#tm_bot_msg_before").val(),m=String(jQuery("#tm_bot_add_form_url").is(":checked")),y=jQuery('input[name="rft_adm_nonce"]').val();u.addClass("disabled"),u.text("Saving");var p={action:"rft_save_settings_admin_page",watchedForms:s,integrations:c,inputFormat:l,preventEmails:f,botToken:d,chatId:h,beforeMsgTxt:v,botAddUrl:m,nonce:y};console.log(p),jQuery.ajax({url:frontend_ajax_object.ajaxurl,type:"POST",data:p,success:function(e){u.removeClass("disabled"),u.text("Save Settings"),"ok"===e?window.location.reload():console.log(e)},error:function(e){u.removeClass("disabled"),u.text("Save Settings"),console.log(e)}})})),jQuery(".tm_bot_test").click((function(t){t.preventDefault();var r=jQuery(this).attr("data-action"),n=jQuery("#tm_bot_token").val(),a=jQuery("#tm_bot_chat_id").val(),i=jQuery("#tm_bot_msg_before").val(),o="https://api.telegram.org/bot"+n+"/"+r;"sendMessage"==r&&(o+="?chat_id="+a+"&text="+(i=0==i.length?"Test message delivered, your setting are ok":i)),console.log(o);var u=new XMLHttpRequest;u.open("GET",o,!0),u.send(),u.onreadystatechange=function(){4==u.readyState&&(200===u.status?e(u.responseText,"success"):e(u.responseText,"error"))}})),jQuery(".btn-format").click((function(e){e.preventDefault(),jQuery(this).toggleClass("selected"),$val=!!jQuery(this).hasClass("selected");var t=jQuery(this).closest(".rft-rename-group");jQuery(this).hasClass("rft-bold-format")&&t.find('input[name="rft-bold-format-value"]').val($val),jQuery(this).hasClass("rft-italic-format")&&t.find('input[name="rft-italic-format-value"]').val($val),jQuery(this).hasClass("rft-active-format")&&t.find('input[name="rft-active-format-value"]').val($val)})),t()}))},152:function(){}},r={};function n(e){var a=r[e];if(void 0!==a)return a.exports;var i=r[e]={exports:{}};return t[e](i,i.exports,n),i.exports}n.m=t,e=[],n.O=function(t,r,a,i){if(!r){var o=1/0;for(l=0;l<e.length;l++){r=e[l][0],a=e[l][1],i=e[l][2];for(var u=!0,s=0;s<r.length;s++)(!1&i||o>=i)&&Object.keys(n.O).every((function(e){return n.O[e](r[s])}))?r.splice(s--,1):(u=!1,i<o&&(o=i));if(u){e.splice(l--,1);var c=a();void 0!==c&&(t=c)}}return t}i=i||0;for(var l=e.length;l>0&&e[l-1][2]>i;l--)e[l]=e[l-1];e[l]=[r,a,i]},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={467:0,703:0};n.O.j=function(t){return 0===e[t]};var t=function(t,r){var a,i,o=r[0],u=r[1],s=r[2],c=0;if(o.some((function(t){return 0!==e[t]}))){for(a in u)n.o(u,a)&&(n.m[a]=u[a]);if(s)var l=s(n)}for(t&&t(r);c<o.length;c++)i=o[c],n.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return n.O(l)},r=self.webpackChunkGloria=self.webpackChunkGloria||[];r.forEach(t.bind(null,0)),r.push=t.bind(null,r.push.bind(r))}(),n.O(void 0,[703],(function(){return n(796)}));var a=n.O(void 0,[703],(function(){return n(152)}));a=n.O(a)}();