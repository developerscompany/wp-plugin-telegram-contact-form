<div class="rft-plugin-tm">
    <div class="container">
        Integration

        <?php var_dump(RFT_Settings_Integrations::get()); ?>

        <div class="footer">
            <a href="<?= RFT_Admin_Pages::get_link(RFT_Admin_Pages_Bot::SLUG) ?>" class="btn rivo-rate"><?=  __('Preview step', RFT_TEXTDOMAIN) ?></a>
            <a href="<?= RFT_Admin_Pages::get_link(RFT_Admin_Pages_Notifications::SLUG) ?>" class="btn rivo-start"><?=  __('Save and continue', RFT_TEXTDOMAIN) ?></a>
        </div>
    </div>
</div>
