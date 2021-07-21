<?php

namespace optimize;

use Site_Options;

class Lazyload_Images
{

    private $lazyload_class = 'lazyload';

    public function __construct()
    {
        $lazyload_enabled = Site_Options::get()['optimization']['lazyload']['enabled'];
        if ($lazyload_enabled && !current_user_can('manage_options')){
            add_filter('nux_buffer_filter', [$this, 'run']);
        }
    }

    public function run($buffer)
    {
        preg_match_all('/<img[^>]+>/i', $buffer, $images);
        foreach ($images[0] as $image) {
            $secureImg = str_replace('src', 'data-src', $image);
            if (strpos($secureImg, 'class')) {
                $secureImg = preg_replace('/class="(.*?)"/s', "class=\"$this->lazyload_class $1\"", $secureImg);
            } else {
                $secureImg = preg_replace('/(<img\b[^><]*)>/i', "$1 class=\"$this->lazyload_class\">", $secureImg);
            }

            $buffer = str_replace($image, $secureImg, $buffer);
        }
        return $buffer;
    }

}