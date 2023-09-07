<?php
$bot_settings = Rivo_WTS_Settings_Bot::get();
$integrations_settings = Rivo_WTS_Settings_Integrations::get();
$form_settings = Rivo_WTS_Settings_Notifications::get();
$icon_check = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_703_206)">
<path d="M7 13.12L10.5088 16L17 8" stroke="#23B73D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<circle cx="12" cy="12" r="11" stroke="#23B73D" stroke-width="1.5"/>
</g>
<defs>
<clipPath id="clip0_703_206">
<rect width="24" height="24" fill="white"/>
</clipPath>
</defs>
</svg>';
?>
<div class="rivo-wts-plugin-tm">
    <div class="nav-container">
        <nav>

            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_About::SLUG) ?>"
                <?= Rivo_WTS_Admin_Pages::get_current() == Rivo_WTS_Admin_Pages_About::SLUG ? 'class="active"' : '' ?>
            >
                <span><?php echo $icon_check; ?></span> <?= __(Rivo_WTS_Admin_Pages_About::TITLE, Rivo_WTS_TEXTDOMAIN) ?>
            </a>

            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Bot::SLUG) ?>"
                <?= Rivo_WTS_Admin_Pages::get_current() == Rivo_WTS_Admin_Pages_Bot::SLUG ? 'class="active"' : '' ?>
            >
                <span>
                   <?php echo empty($bot_settings) ? '2' : $icon_check;?>
                </span> <?= __(Rivo_WTS_Admin_Pages_Bot::TITLE, Rivo_WTS_TEXTDOMAIN) ?>
            </a>

            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Integrations::SLUG) ?>"
                <?= Rivo_WTS_Admin_Pages::get_current() == Rivo_WTS_Admin_Pages_Integrations::SLUG ? 'class="active"' : '' ?>
            >
                <span>
                    <?php echo empty($integrations_settings) ? '3' : $icon_check;?>
                </span> <?= __(Rivo_WTS_Admin_Pages_Integrations::TITLE, Rivo_WTS_TEXTDOMAIN) ?>
            </a>

            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Notifications::SLUG) ?>"
                <?= Rivo_WTS_Admin_Pages::get_current() == Rivo_WTS_Admin_Pages_Notifications::SLUG ? 'class="active"' : '' ?>
            >
                <span>
                    <?php echo empty($form_settings['forms']) ? '4' : $icon_check;?>
                </span> <?= __(Rivo_WTS_Admin_Pages_Notifications::TITLE, Rivo_WTS_TEXTDOMAIN) ?>
            </a>

        </nav>
    </div>
</div>
