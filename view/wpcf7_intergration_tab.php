<div id="integrations-wpcf7-tab" class="tab-pane" role="tabpanel">
    <div id="integrations-general-tab-wrapper">
        
        <div class="tab-header">
            <h2><?php esc_html_e('Contact Form 7 settings', 'rivoforms'); ?></h2>                   
        </div>

        <div id="integr-wpcf7" class="tab-pane-inner" role="tabpanel">
            <?php
            if( in_array( 'wpcf7', self::$settings->get_active_mods() ) ) {            
            
            $wpcf = RFT_WPCF7::get_instance( self::$settings );
            $wpcf_forms = $wpcf->get_registered_forms();
            ?>

                <form class="rft-form rft-watch-forms">

                <?php if (  count( $wpcf->get_registered_forms() ) > 0 ) { ?>                

                    <h4>Choose forms to watch</h4>    

                    <p class="description">Telegram message will be send only when selected forms are submited</p>
                    <div class="form-group">
                        <?php foreach ($wpcf_forms as $form) { 
                            if (in_array( $form['id'], $wpcf->get_used_forms() )){
                                $checked = "checked";
                            } else {
                                $checked = "";
                            }                           
                            ?>
                            <div class="rft-input-group">
                                <input 
                                type="checkbox" 
                                class="rft-watch-checbox" 
                                value="<?php echo $form['id']; ?>" 
                                id="rft-watch-<?php echo $form['id']; ?>" 
                                name="rft-watch-<?php echo $form['id']; ?>" 
                                <?php echo $checked; ?>
                                >

                                <label for="rft-watch-<?php echo $form['id']; ?>">
                                    <?php echo $form['title'] . ' (id: ' . $form['id'] . ')'; ?>
                                </label>
                            </div>
                        <?php } ?>
                    </div>                 

                <?php } else { ?>
                    <strong>
                        YOU DON'T HAVE ANY ACTIVE CONTACT-FORM-7 FORMS 
                    </strong>
                <?php } ?>

                    <h4><?php esc_html_e('Prevent emails', 'rivoforms'); ?></h4>
                    <p class="description"><?php esc_html_e('Send only to telegram', 'rivoforms'); ?></p>
                    <div class="form-group">
                        <div class="rft-input-group"> 
                            <?php $wpcf7_prevent_email = self::$wpcf7_settings['prevent_email'] == "true" ? 'checked' : ''; ?>
                            <input type="checkbox" class="" id="wpcf7_prevent_email" name="wpcf7_prevent_email" <?php echo $wpcf7_prevent_email; ?> >
                            <label for="wpcf7_prevent_email"><?php esc_html_e('Prevent emails', 'rivoforms'); ?></label>
                        </div> 
                    </div>

                    <div class="rft-submit-wrap">
                        <button class="rft-submit button button-primary" style="margin-right:6px">Save Settings</button>
                    </div>
                    
                </form>
            
        <?php } ?>
        </div>
    </div>
</div>