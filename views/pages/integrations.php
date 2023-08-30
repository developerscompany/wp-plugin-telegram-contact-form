<?php $integrations_settings = RFT_Settings_Integrations::get(); ?>
<?php //RFT_Settings_Integrations::set(['type'=>'plugin-integration', 'plugins' => ['rtf-cf7', 'rtf-woocommerce'] ]); ?>
<?php
    $cf7_check = in_array(RFT_Settings_Integrations::PLUGIN_CONTACT_FORM, $integrations_settings['plugins']);
    $woocommerce_check = in_array(RFT_Settings_Integrations::PLUGIN_WOOCOMMERCE, $integrations_settings['plugins']);
?>
<div class="rft-plugin-tm">
    <div class="container">
        <h1>Choose integrations</h1>

       <div class="content">
           <div class="type-integration">
               <div class="integration">
                   <input type="radio" id="<?php echo RFT_Settings_Integrations::TYPE_ALL_EMAILS; ?>" name="integration_type" value="<?php echo RFT_Settings_Integrations::TYPE_ALL_EMAILS; ?>" <?php echo $integrations_settings['type'] == RFT_Settings_Integrations::TYPE_ALL_EMAILS ? "checked": ""?>>
                   <label for="<?php echo RFT_Settings_Integrations::TYPE_ALL_EMAILS; ?>">
                       All WordPress Emails
                       <span class="integration-desc">Send telegram notice when any kind of wordpress email is sent.</span>
                   </label>
               </div>

               <div class="integration">
                   <input type="radio" id="<?php echo RFT_Settings_Integrations::TYPE_FORMS; ?>" name="integration_type" value="<?php echo RFT_Settings_Integrations::TYPE_FORMS; ?>" <?php echo $integrations_settings['type'] == RFT_Settings_Integrations::TYPE_FORMS ? "checked": ""?>>
                   <label for="<?php echo RFT_Settings_Integrations::TYPE_FORMS; ?>">
                       Select Forms Integrations
                       <span class="integration-desc">Send telegram notice when any kind of wordpress email is sent.</span>
                   </label>
               </div>
           </div>

           <div class="plugin-integration" style="<?php echo $integrations_settings['type'] === RFT_Settings_Integrations::TYPE_FORMS ? "display:block" : "display:none"?>">
               <div class="single-integration">
                   <input type="checkbox" id="<?php echo RFT_Settings_Integrations::PLUGIN_CONTACT_FORM; ?>" name="plugin_integration" <?php echo $cf7_check ? "checked" : ""?>/>
                   <label for="<?php echo RFT_Settings_Integrations::PLUGIN_CONTACT_FORM; ?>">Contact Form 7
                       <span>Send message to telegram each time a choosen Contact-Form-7 in submitted</span>
                   </label>
               </div>

               <div class="single-integration">
                   <input type="checkbox" id="<?php echo RFT_Settings_Integrations::PLUGIN_WOOCOMMERCE; ?>" name="plugin_integration" <?php echo $woocommerce_check ? "checked" : ""?>/>
                   <label for="<?php echo RFT_Settings_Integrations::PLUGIN_WOOCOMMERCE; ?>">Woocommerce
                       <span>Send message to telegram each time a WooCommerce order is submitted</span>
                   </label>
               </div>
           </div>

           <div class="message-field error-field"></div>
       </div>

        <?php var_dump(RFT_Settings_Integrations::get()); ?>

        <div class="footer">
            <a href="<?= RFT_Admin_Pages::get_link(RFT_Admin_Pages_Bot::SLUG) ?>" class="btn rivo-rate"><?=  __('Preview step', RFT_TEXTDOMAIN) ?></a>
            <a href="<?= RFT_Admin_Pages::get_link(RFT_Admin_Pages_Notifications::SLUG) ?>" id="third_step_button" class="btn rivo-start"><?=  __('Save and continue', RFT_TEXTDOMAIN) ?></a>
        </div>
    </div>
</div>
