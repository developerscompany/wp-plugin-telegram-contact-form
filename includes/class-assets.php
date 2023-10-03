<?php

class Rivo_WTS_Assets
{
    public static function init()
    {
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue']);
    }

    public static function enqueue()
    {
        wp_enqueue_style(Rivo_WTS_Main::PREFIX . 'style-admin', self::getUrlWithVersion('/css/admin.css'));
        wp_enqueue_script(Rivo_WTS_Main::PREFIX . 'script-admin', self::getUrlWithVersion('/js/admin.js'));
        wp_localize_script(Rivo_WTS_Main::PREFIX . 'script-admin', 'rivo_wts', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'i18n'    => Rivo_WTS_i18n::texts()

        ]);
    }

    public static function getUrlWithVersion($file = '')
    {
        $assetsMap = json_decode(file_get_contents(Rivo_WTS_PLUGIN_DIR . '/assets/dist/mix-manifest.json'), true);

        if (isset($assetsMap[$file])) {
            return sprintf('%s/assets/dist/%s', Rivo_WTS_URL, $assetsMap[$file]);
        }

        return $file;
    }
}