<div class="rivo-wts-plugin-tm">
    <div class="nav-container">
        <nav>
            <ul>
                <?php foreach (Rivo_WTS_Admin_Pages::nav() as $item): ?>
                    <li class="<?= implode(' ', $item['classes']) ?>">
                        <a href="<?= $item['link'] ?>"><?= $item['title'] ?> </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </nav>
    </div>
</div>
