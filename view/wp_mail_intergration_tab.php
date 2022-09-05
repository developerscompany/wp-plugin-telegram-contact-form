<div id="integrations-general-tab" class="tab-pane" role="tabpanel">
    <div id="integrations-general-tab-wrapper">
        
        <div class="tab-header">
            <h2><?php esc_html_e('Wordpress Emails', 'rivoforms'); ?></h2>                   
        </div>

        <div id="integr-default" class="tab-pane-inner">                        
            <form  class="rft-form">
                
                <h4><?php esc_html_e('Prevent emails', 'rivoforms'); ?></h4>
                <p class="description"><?php esc_html_e('Send only to telegram', 'rivoforms'); ?></p>
                <div class="form-group">
                    <div class="rft-input-group"> 
                        <?php $wp_mail_prevent_email = self::$wp_mail_settings['prevent_email'] == "true" ? 'checked' : ''; ?>
                        <input type="checkbox" class="" id="wp_mail_prevent_email" name="wp_mail_prevent_email" <?php echo $wp_mail_prevent_email; ?> >
                        <label for="wp_mail_prevent_email"><?php esc_html_e('Prevent emails', 'rivoforms'); ?></label>
                    </div> 
                </div>

                <p class="description">Comming Soon</p>                
                <pre>
                    <?php var_dump( self::$settings->get_active_mods() ); ?>
                </pre>

                <div class="rft-submit-wrap">
                    <button class="rft-submit button button-primary" style="margin-right:6px">Save Settings</button>
                </div>
            </form>
        </div>

    </div>
</div>