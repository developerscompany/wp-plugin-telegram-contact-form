<div id="integrations-wc-tab" class="tab-pane" role="tabpanel">
    <div id="integrations-general-tab-wrapper">
        
        <div class="tab-header">
            <h2><?php esc_html_e('Woocommerce Emails Notifications', 'rivoforms'); ?> </h2>               
        </div>

        <div id="integr-default" class="tab-pane-inner">                        
            <form  class="rft-form">

                <h4><?php esc_html_e('Prevent emails', 'rivoforms'); ?></h4>
                <p class="description"><?php esc_html_e('Send only to telegram', 'rivoforms'); ?></p>
                <div class="form-group">
                    <div class="rft-input-group"> 
                        <?php $wc_prevent_email = self::$wc_settings['prevent_email'] == "true" ? 'checked' : ''; ?>
                        <input type="checkbox" class="" id="wc_prevent_email" name="wc_prevent_email" <?php echo $wc_prevent_email; ?> >
                        <label for="wc_prevent_email"><?php esc_html_e('Prevent emails', 'rivoforms'); ?></label>
                    </div> 
                </div>

                <p class="description">Comming Soon</p>
                <div class="rft-submit-wrap">
                    <button class="rft-submit button button-primary" style="margin-right:6px">Save Settings</button>
                </div>
            </form>
        </div>
        
    </div>
</div>