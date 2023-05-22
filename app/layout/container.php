<?php

namespace layout;

class Container{

    public static function is_visible_title_bar()
    {
        global $post;
        if ($post){
            return get_post_meta($post->ID, 'layout')[0]['container']['title_bar'];
        }
        return false;
    }

    public static function width_type()
    {
        global $post;
        if ($post){
            return get_post_meta($post->ID, 'layout')[0]['container']['width'];
        }
        return false;
    }

}