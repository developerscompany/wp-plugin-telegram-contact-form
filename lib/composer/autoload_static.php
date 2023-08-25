<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc0bdd8978b83d4b304d72df9e5cd24c6
{
    public static $files = array (
        '44c2a8dfb833fa4ee330d18cab9b9b35' => __DIR__ . '/../..' . '/includes/class-main.php',
        '50b0226d6cdd59f733e27a27bde3c80e' => __DIR__ . '/../..' . '/includes/class-assets.php',
        'ae9e5054e737c1d1efa576358fc2d98e' => __DIR__ . '/../..' . '/includes/class-bot.php',
        '1fdb157d9142dec6b7f208eac8b9a081' => __DIR__ . '/../..' . '/includes/class-utilities.php',
        '3ce36da589ce853adec41930264bb3b7' => __DIR__ . '/../..' . '/includes/admin-pages/class-admin-pages.php',
        '4175608cc2fec2341dfc96e33945792d' => __DIR__ . '/../..' . '/includes/admin-pages/class-admin-pages-about.php',
        '480d5ea00b21994e0d3f701e4c067330' => __DIR__ . '/../..' . '/includes/admin-pages/class-admin-pages-bot.php',
        '01f10663cef4fca7a9d0e62612bec40d' => __DIR__ . '/../..' . '/includes/admin-pages/class-admin-pages-integrations.php',
        '0f29080c2540a64da23e748297b232cc' => __DIR__ . '/../..' . '/includes/admin-pages/class-admin-pages-notifications.php',
        'bdb18f5a08fc2f40f2d69de6028e4b03' => __DIR__ . '/../..' . '/includes/settings/class-settings.php',
        '50970396ab581e26b24c53bab0b8f930' => __DIR__ . '/../..' . '/includes/settings/class-settings-base.php',
        '5c92e2590db0f6c2c31995e87b1d411b' => __DIR__ . '/../..' . '/includes/settings/class-settings-bot.php',
        '9aebed1cef8637d24399f631f678feee' => __DIR__ . '/../..' . '/includes/settings/class-settings-integrations.php',
        '42f0d1c196d257af0441d6f35466ae8c' => __DIR__ . '/../..' . '/includes/settings/class-settings-notifications.php',
        '5b650bfcf37f497d21e2e96cf7cd115a' => __DIR__ . '/../..' . '/includes/integrations/class-integrations.php',
        '2bb04721e2d2c6696a0d18c80c77a6b8' => __DIR__ . '/../..' . '/includes/integrations/class-integrations-contact-form.php',
        '77376458edfbc3e5fa8b24d3b0604c39' => __DIR__ . '/../..' . '/includes/integrations/class-integrations-woocommerce.php',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitc0bdd8978b83d4b304d72df9e5cd24c6::$classMap;

        }, null, ClassLoader::class);
    }
}