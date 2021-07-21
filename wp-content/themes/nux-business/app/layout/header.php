<?php

namespace layout;

class Header{

    public static function is_visible()
    {
        global $post;
        if ($post){
            $layout_meta = get_post_meta($post->ID, 'layout');
            return $layout_meta ? $layout_meta[0]['header']['visible'] : true;
        }
        return false;
    }

    public static function is_sticky()
    {
        global $post;
        if ($post){
            return get_post_meta($post->ID, 'layout')[0]['header']['sticky'];
        }
        return false;
    }

    public static function is_transparent()
    {
        global $post;
        if ($post){
            return get_post_meta($post->ID, 'layout')[0]['header']['transparent'];
        }
        return false;
    }

}