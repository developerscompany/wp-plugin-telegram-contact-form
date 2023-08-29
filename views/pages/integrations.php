<?php $integrations_settings = RFT_Settings_Integrations::get(); ?>
<?php //RFT_Settings_Integrations::set(['type'=>'plugin-integration', 'plugins' => ['rtf-cf7', 'rtf-woocommerce'] ]); ?>
<?php
    $cf7_check = in_array('rtf-cf7', $integrations_settings['plugins']);
    $woocommerce_check = in_array('rtf-woocommerce', $integrations_settings['plugins']);
?>
<div class="rft-plugin-tm">
    <div class="container">
        <h1>Choose integrations</h1>

       <div class="content">
           <div class="type-integration">
               <div class="integration">
                   <input type="radio" id="all-emails" name="integration_type" value="all-emails" <?php echo $integrations_settings['type'] == 'all-emails' ? "checked": ""?>>
                   <label for="all-emails">
                       All WordPress Emails
                       <span class="integration-desc">Send telegram notice when any kind of wordpress email is sent.</span>
                   </label>
               </div>

               <div class="integration">
                   <input type="radio" id="plugin-integration" name="integration_type" value="plugin-integration" <?php echo $integrations_settings['type'] == 'plugin-integration' ? "checked": ""?>>
                   <label for="plugin-integration">
                       Select Forms Integrations
                       <span class="integration-desc">Send telegram notice when any kind of wordpress email is sent.</span>
                   </label>
               </div>
           </div>

           <div class="plugin-integration" style="<?php echo $integrations_settings['type']==='plugin-integration' ? "display:block" : "display:none"?>">
               <div class="single-integration">
                   <input type="checkbox" id="rtf-cf7" name="plugin_integration" <?php echo $cf7_check ? "checked" : ""?>/>
                   <label for="rtf-cf7">Contact Form 7
                       <span>Send message to telegram each time a choosen Contact-Form-7 in submitted</span>
                   </label>
               </div>

               <div class="single-integration">
                   <input type="checkbox" id="rtf-woocommerce" name="plugin_integration" <?php echo $woocommerce_check ? "checked" : ""?>/>
                   <label for="rtf-woocommerce">Woocommerce
                       <span>Send message to telegram each time a WooCommerce order is submitted</span>
                   </label>
               </div>
           </div>

           <div class="message-field error-field"></div>
       </div>

<!--        --><?php //var_dump(RFT_Settings_Integrations::get()); ?>

        <div class="footer">
            <a href="<?= RFT_Admin_Pages::get_link(RFT_Admin_Pages_Bot::SLUG) ?>" class="btn rivo-rate"><?=  __('Preview step', RFT_TEXTDOMAIN) ?></a>
            <a href="<?= RFT_Admin_Pages::get_link(RFT_Admin_Pages_Notifications::SLUG) ?>" id="third_step_button" class="btn rivo-start"><?=  __('Save and continue', RFT_TEXTDOMAIN) ?></a>
        </div>
    </div>
</div>
