<div id="integrations-tab" class="tab-pane" role="tabpanel">
    <div id="integrations-tab-wrapper">

        <div class="tab-header">
            <h2><?php _e('Choose integrations', 'rivoforms'); ?></h2>          
        </div>
    
        <div class="rft-inner-tab-content" >

            <div id="general-default" class="tab-pane-inner-inner">                                    
                
                <form  class="rft-form">

                    <div class="form-group">
                        <?php
                        $default_emails_checked = self::$settings->get_option('no_integrations') ? "checked" : " ";
                        $mod_emails_checked = $default_emails_checked === "checked" ? " " : "checked";                           
                        ?>
                        <div class="rft-input-group">
                            <input type="radio" id="default_emails" name="use_integrations" value="false" <?php echo $default_emails_checked; ?>>
                            <label for="default_emails">
                                <?php _e('All WordPress Emails', 'rivoforms'); ?>
                            </label>
                            <p class="description">Send telegram notice when any kind of wordpress email is sent.</p>
                        </div>
                        <div class="rft-input-group">
                            <input type="radio" id="mod_emails"
                            name="use_integrations" value="true" <?php echo $mod_emails_checked; ?> >
                            <label for="mod_emails">
                                <?php _e('Select Form Integrations', 'rivoforms'); ?>
                            </label>
                            <p class="description">Send telegram notice only for selected integrations.</p>
                        </div>
                    </div>

                    <div class="form-group integrations d-none">
                        <?php
                        foreach (self::$settings->get_mods_list() as $mod_name) {
                            $checked = self::$settings->mod_is_active($mod_name) ? 'checked' : '';                                                               
                            $label = self::$settings->get_mod_settings($mod_name)['display_name'];
                            $description = self::$settings->get_mod_settings($mod_name)['description'];;
                            ?>
                        <div class="rft-input-group">
                            <input type="checkbox" 
                            class="rft-integration-checkbox <?php echo $disabled; ?>" 
                            value="<?php echo $mod_name; ?>" 
                            id="<?php echo $mod_name; ?>" 
                            name="<?php echo $mod_name; ?>" 
                            <?php echo $checked; ?> 
                            >
                            <label for="<?php echo $mod_name; ?>"><?php echo $label; ?></label>
                            <p class="description"><?php echo $description; ?></p>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="rft-submit-wrap">
                        <button class="rft-submit button button-primary" style="margin-right:6px">Save Settings</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>