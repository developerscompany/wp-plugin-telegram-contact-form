<div class="rft-plugin-tm">
    <div class="container">
        Bot

        <?php var_dump(RFT_Settings_Bot::get()); ?>

        <div class="footer">
            <a href="<?= RFT_Admin_Pages::get_link(RFT_Admin_Pages_About::SLUG) ?>" class="btn"><?=  __('Previous Step', RFT_TEXTDOMAIN) ?></a>
            <a href="<?= RFT_Admin_Pages::get_link(RFT_Admin_Pages_Integrations::SLUG) ?>" class="btn"><?=  __('Save and continue', RFT_TEXTDOMAIN) ?></a>
        </div>
    </div>
</div>
