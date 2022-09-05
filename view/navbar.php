<ul class="nav rft-menu-tabs-list" data-tabs>
    <li><a href="#general-tab">
        <?php _e('Wellcome', 'rivoforms'); ?>
    </a></li>
    <li><a href="#integrations-tab">
        <?php _e('Integrations', 'rivoforms'); ?>
    </a></li>

    <li class="child integration-tab-link default-mod" <?php if(self::$settings->get_settings()['no_integrations'] != 'true'){ echo ' style="display:none;"'; } ?> >
        <a href="#integrations-general-tab">
            <?php _e('Wordpress Default', 'rivoforms'); ?>
        </a>
    </li>
    <li class="child integration-tab-link wpcf7-mod" <?php if(self::$settings->get_settings()['no_integrations'] == 'true'){ echo ' style="display:none;"'; } ?> >
        <a href="#integrations-wpcf7-tab">
         <?php _e('Contact Form 7', 'rivoforms'); ?>
        </a>
    </li>
    <li class="child integration-tab-link wc-mod" <?php if(self::$settings->get_settings()['no_integrations'] == 'true'){ echo ' style="display:none;"'; } ?> >
        <a href="#integrations-wc-tab">
            <?php _e('Woocommerce', 'rivoforms'); ?>
        </a>
    </li>

    <li><a href="#telegram-tab">
        <?php _e('Telegram Settings', 'rivoforms'); ?>
    </a></li>
    <li><a href="#message-tab">
        <?php _e('Message Options', 'rivoforms'); ?>
    </a></li>
    
</ul>