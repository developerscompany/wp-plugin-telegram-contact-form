<div class="rft-plugin-tm">
    <div class="nav-container">
        <nav>

            <a href="<?= RFT_Admin_Pages::get_link(RFT_Admin_Pages_About::SLUG) ?>"
                <?= RFT_Admin_Pages::get_current() == RFT_Admin_Pages_About::SLUG ? 'class="active"' : '' ?>
            >
                <span>1</span> <?= __(RFT_Admin_Pages_About::TITLE, RFT_TEXTDOMAIN) ?>
            </a>

            <a href="<?= RFT_Admin_Pages::get_link(RFT_Admin_Pages_Bot::SLUG) ?>"
                <?= RFT_Admin_Pages::get_current() == RFT_Admin_Pages_Bot::SLUG ? 'class="active"' : '' ?>
            >
                <span>2</span> <?= __(RFT_Admin_Pages_Bot::TITLE, RFT_TEXTDOMAIN) ?>
            </a>

            <a href="<?= RFT_Admin_Pages::get_link(RFT_Admin_Pages_Integrations::SLUG) ?>"
                <?= RFT_Admin_Pages::get_current() == RFT_Admin_Pages_Integrations::SLUG ? 'class="active"' : '' ?>
            >
                <span>3</span> <?= __(RFT_Admin_Pages_Integrations::TITLE, RFT_TEXTDOMAIN) ?>
            </a>

            <a href="<?= RFT_Admin_Pages::get_link(RFT_Admin_Pages_Notifications::SLUG) ?>"
                <?= RFT_Admin_Pages::get_current() == RFT_Admin_Pages_Notifications::SLUG ? 'class="active"' : '' ?>
            >
                <span>4</span> <?= __(RFT_Admin_Pages_Notifications::TITLE, RFT_TEXTDOMAIN) ?>
            </a>

        </nav>
    </div>
</div>
