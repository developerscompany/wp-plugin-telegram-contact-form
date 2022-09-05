<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function rft_wpcf7_before_send_mail (&$WPCF7_ContactForm) {

    // Our code will go here
    if ($WPCF7_ContactForm->posted_data['radiobuttonname'] == "Yes") {        
    
    }
    
    
    // Changing email recipient dynamically depending on code
    $WPCF7_ContactForm->mail['recipient'] = "John ";
    
    // Skip mail
    $wpcf7_data->skip_mail = true;
    
    
    // Redirecting someone to a different page
    $wpcf7_data->additional_settings = "on_sent_ok: \"location.replace(https://wbcomdesigns.com//provider/'); \"";
    
    // Adding more text in the sent email
    $wpcf7_data->mail['body'] .= '';
    
    
    // Get page from which form was submitted
    $pagesubmitted = $_SERVER['HTTP_REFERER'];
    
    }
    
    add_action("wpcf7_before_send_mail", "rwpcf7_before_send_mail");