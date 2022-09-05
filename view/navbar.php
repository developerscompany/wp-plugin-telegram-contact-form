<ul class="nav rft-menu-tabs-list" data-tabs>
    <li><a href="#general-tab">
        <?php esc_html_e('Wellcome', 'rivoforms'); ?>
    </a></li>
    <li><a href="#integrations-tab">
        <?php esc_html_e('Integrations', 'rivoforms'); ?>
    </a></li>

    <li class="child integration-tab-link default-mod" <?php if(self::$settings->get_settings()['no_integrations'] != 'true'){ echo ' style="display:none;"'; } ?> >
        <a href="#integrations-general-tab">
            <?php esc_html_e('Wordpress Default', 'rivoforms'); ?>
        </a>
    </li>
    <li class="child integration-tab-link wpcf7-mod" <?php if(self::$settings->get_settings()['no_integrations'] == 'true'){ echo ' style="display:none;"'; } ?> >
        <a href="#integrations-wpcf7-tab">
         <?php esc_html_e('Contact Form 7', 'rivoforms'); ?>
        </a>
    </li>
    <li class="child integration-tab-link wc-mod" <?php if(self::$settings->get_settings()['no_integrations'] == 'true'){ echo ' style="display:none;"'; } ?> >
        <a href="#integrations-wc-tab">
            <?php esc_html_e('Woocommerce', 'rivoforms'); ?>
        </a>
    </li>

    <li><a href="#telegram-tab">
        <?php esc_html_e('Telegram Settings', 'rivoforms'); ?>
    </a></li>
    <li><a href="#message-tab">
        <?php esc_html_e('Message Options', 'rivoforms'); ?>
    </a></li>
    
</ul>