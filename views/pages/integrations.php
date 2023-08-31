<?php $integrations_settings = Rivo_WTS_Settings_Integrations::get(); ?>
<?php //Rivo_WTS_Settings_Integrations::set(['type'=>'plugin-integration', 'plugins' => ['rtf-cf7', 'rtf-woocommerce'] ]); ?>
<?php
    $cf7_check = in_array(Rivo_WTS_Settings_Integrations::PLUGIN_CONTACT_FORM, $integrations_settings['plugins']);
    $woocommerce_check = in_array(Rivo_WTS_Settings_Integrations::PLUGIN_WOOCOMMERCE, $integrations_settings['plugins']);

    $all_mails_check = $integrations_settings['type'] === Rivo_WTS_Settings_Integrations::TYPE_ALL_EMAILS;
    $plugins_check   = $integrations_settings['type'] === Rivo_WTS_Settings_Integrations::TYPE_PLUGINS
?>
<div class="rivo-wts-plugin-tm">
    <div class="container">
        <h1>Choose integrations</h1>

       <div class="content">
           <div class="type-integration">
               <div class="integration">
                   <input type="radio" id="<?= Rivo_WTS_Settings_Integrations::TYPE_ALL_EMAILS ?>"
                          name="integration_type"
                          value="<?= Rivo_WTS_Settings_Integrations::TYPE_ALL_EMAILS ?>"
                       <?php echo $all_mails_check ? 'checked' : '' ?>
                   >
                   <label for="<?= Rivo_WTS_Settings_Integrations::TYPE_ALL_EMAILS ?>">
                       All WordPress Emails
                       <span class="integration-desc">Send telegram notice when any kind of wordpress email is sent.</span>
                   </label>
               </div>

               <div class="integration">
                   <input type="radio" id="radio_<?= Rivo_WTS_Settings_Integrations::TYPE_PLUGINS ?>"
                          name="integration_type"
                          value="<?= Rivo_WTS_Settings_Integrations::TYPE_PLUGINS ?>"
                       <?php echo $plugins_check ? 'checked' : '' ?>
                   >
                   <label for="radio_<?= Rivo_WTS_Settings_Integrations::TYPE_PLUGINS ?>">
                       Select Forms Integrations
                       <span class="integration-desc">Send telegram notice when any kind of wordpress email is sent.</span>
                   </label>
               </div>
           </div>

           <div class="plugin-integration" style="<?php echo $integrations_settings['type']=== Rivo_WTS_Settings_Integrations::TYPE_PLUGINS ? "display:block" : "display:none"?>">
               <div class="single-integration">
                   <input type="checkbox" id="<?= Rivo_WTS_Settings_Integrations::PLUGIN_CONTACT_FORM ?>"
                          name="plugin_integration" <?php echo $cf7_check ? "checked" : "" ?>
                          value="<?= Rivo_WTS_Settings_Integrations::PLUGIN_CONTACT_FORM ?>"
                   />
                   <label for="<?= Rivo_WTS_Settings_Integrations::PLUGIN_CONTACT_FORM ?>">Contact Form 7
                       <span>Send message to telegram each time a choosen Contact-Form-7 in submitted</span>
                   </label>
               </div>

               <div class="single-integration">
                   <input type="checkbox" id="<?= Rivo_WTS_Settings_Integrations::PLUGIN_WOOCOMMERCE ?>"
                          name="plugin_integration" <?php echo $woocommerce_check ? "checked" : "" ?>
                          value="<?= Rivo_WTS_Settings_Integrations::PLUGIN_WOOCOMMERCE ?>"
                   />
                   <label for="<?= Rivo_WTS_Settings_Integrations::PLUGIN_WOOCOMMERCE ?>">Woocommerce
                       <span>Send message to telegram each time a WooCommerce order is submitted</span>
                   </label>
               </div>
           </div>

           <div class="message-field error-field"></div>
       </div>

<!--        --><?php //var_dump(Rivo_WTS_Settings_Integrations::get()); ?>

        <div class="footer">
            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Bot::SLUG) ?>" class="btn rivo-rate"><?=  __('Preview step', Rivo_WTS_TEXTDOMAIN) ?></a>
            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Notifications::SLUG) ?>" id="third_step_button" class="btn rivo-start"><?=  __('Save and continue', Rivo_WTS_TEXTDOMAIN) ?></a>
        </div>
    </div>
</div>
