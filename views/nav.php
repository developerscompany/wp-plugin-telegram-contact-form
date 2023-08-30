<div class="rivo-wts-plugin-tm">
    <div class="nav-container">
        <nav>

            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_About::SLUG) ?>"
                <?= Rivo_WTS_Admin_Pages::get_current() == Rivo_WTS_Admin_Pages_About::SLUG ? 'class="active"' : '' ?>
            >
                <span>1</span> <?= __(Rivo_WTS_Admin_Pages_About::TITLE, Rivo_WTS_TEXTDOMAIN) ?>
            </a>

            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Bot::SLUG) ?>"
                <?= Rivo_WTS_Admin_Pages::get_current() == Rivo_WTS_Admin_Pages_Bot::SLUG ? 'class="active"' : '' ?>
            >
                <span>2</span> <?= __(Rivo_WTS_Admin_Pages_Bot::TITLE, Rivo_WTS_TEXTDOMAIN) ?>
            </a>

            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Integrations::SLUG) ?>"
                <?= Rivo_WTS_Admin_Pages::get_current() == Rivo_WTS_Admin_Pages_Integrations::SLUG ? 'class="active"' : '' ?>
            >
                <span>3</span> <?= __(Rivo_WTS_Admin_Pages_Integrations::TITLE, Rivo_WTS_TEXTDOMAIN) ?>
            </a>

            <a href="<?= Rivo_WTS_Admin_Pages::get_link(Rivo_WTS_Admin_Pages_Notifications::SLUG) ?>"
                <?= Rivo_WTS_Admin_Pages::get_current() == Rivo_WTS_Admin_Pages_Notifications::SLUG ? 'class="active"' : '' ?>
            >
                <span>4</span> <?= __(Rivo_WTS_Admin_Pages_Notifications::TITLE, Rivo_WTS_TEXTDOMAIN) ?>
            </a>

        </nav>
    </div>
</div>
