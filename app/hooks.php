<?php

class Hooks
{
    public function __construct()
    {
        add_filter('upload_mimes', [$this, 'mime_types']);

        add_filter('pre_get_document_title', [$this, 'set_title_page']);
    }

    public function mime_types($mimes)
    {
        $mimes['webp'] = 'image/webp';
        return $mimes;
    }

    public function set_title_page($title)
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (is_404() && strpos($uri, '403-forbidden')) {
            return 'محدودیت دسترسی - ' . get_bloginfo('name');
        }
        return $title;
    }
}