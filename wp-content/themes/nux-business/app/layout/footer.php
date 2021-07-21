<?php

namespace layout;

class Footer
{

    public static function is_visible_middle_section()
    {
        global $post;
        if ($post) {
            $layout_meta = get_post_meta($post->ID, 'layout');
            return $layout_meta ? $layout_meta[0]['footer']['middle'] : true;
        }
        return false;
    }

    public static function is_visible_bottom_section()
    {
        global $post;
        if ($post) {
            $layout_meta = get_post_meta($post->ID, 'layout');
            return $layout_meta ? $layout_meta[0]['footer']['bottom'] : true;
        }
        return false;
    }

}