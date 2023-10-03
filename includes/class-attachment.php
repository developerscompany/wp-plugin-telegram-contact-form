<?php

class Rivo_WTS_Attachment
{
    const TMP_UPLOADS_DIR = 'rivo_wts_uploads';

    public static function send($attachment_id)
    {
        if($attachment_id &&
            !is_wp_error($attachment_id) &&
            $attachment_data = self::get_attachment_url_mime($attachment_id)
        ) {
            Rivo_WTS_Bot::send($attachment_data['url'], [], $attachment_data['type']);
        }
    }

    public static function get_attachment_url_mime($post_ID)
    {
        $attachment = get_post($post_ID);

        if (!$attachment) {
            return null;
        }

        $type = 'document';
        $url  = wp_get_attachment_url($attachment->ID);

        wp_attachment_is('audio', $attachment) && $type = 'audio';
        wp_attachment_is('image', $attachment) && $type = 'image';
        wp_attachment_is('video', $attachment) && $type = 'video';

        return compact('url', 'type');
    }

    public static function get_uploads_dir()
    {
        $upload_dir    = wp_upload_dir();
        $target_folder = sprintf('%s/%s/', $upload_dir['basedir'], self::TMP_UPLOADS_DIR);
        wp_mkdir_p($target_folder);

        return $target_folder;
    }

    public static function copy_to_uploads_dir($original_file_path)
    {
        try {
            $target_folder    = self::get_uploads_dir();
            $file_name        = wp_unique_filename($target_folder, basename($original_file_path));
            $target_file_path = $target_folder . $file_name;

            copy($original_file_path, $target_file_path);

            $file_data = wp_check_filetype($target_file_path);

            $attachment = [
                'post_mime_type' => $file_data['type'],
                'post_title'     => basename($target_file_path),
                'post_content'   => '',
                'post_status'    => 'inherit'
            ];

            return wp_insert_attachment($attachment, $target_file_path);
        } catch (Exception $e) {

        }

        return null;
    }
}