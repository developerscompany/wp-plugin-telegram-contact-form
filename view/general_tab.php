<div id="general-tab" class="tab-pane" role="tabpanel">
            
    <div id="general-tab-wrapper">              
        
        <div class="tab-header">
            <h2><?php esc_html_e('About the plugin', 'rivoforms'); ?></h2>          
        </div>

        <div class="rft-inner-tab-content">

            <div id="general-about" class="tab-pane-inner" role="tabpanel"> 
                
                <form class="rft-form" >
                    <p class="description"><?php esc_html_e('Comming Soon', 'rivoforms'); ?></p>
                    <pre>get_settings
                        <?php var_dump( self::$settings->get_settings() ); ?>
                    </pre>
                    <pre>get_wpcf7_settings
                        <?php var_dump( self::$settings->get_wpcf7_settings() ); ?>
                    </pre>
                    <pre>get_wc_settings
                        <?php var_dump( self::$settings->get_wc_settings() ); ?>
                    </pre>
                    <pre>get_wp_mail_settings
                        <?php var_dump( self::$settings->get_wp_mail_settings() ); ?>
                    </pre>
                    <pre>get_input_settings
                        <?php var_dump( self::$settings->get_input_settings() ); ?>
                    </pre>
                </form>
            </div>

        </div>
        
    </div>
</div>