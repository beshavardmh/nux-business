<?php

namespace admin_menus;

class Post_Types
{

    private $default_args = array();

    public function __construct()
    {
        add_action('init', [$this, 'team']);

        add_action('init', [$this, 'faq']);

        $default_args = array(
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'Item'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        );

        $this->default_args = $default_args;
    }

    public function team()
    {
        $labels = array(
            'name' => 'اعضای تیم',
            'singular_name' => 'عضو',
            'menu_name' => 'اعضای تیم',
            'name_admin_bar' => 'عضو',
            'add_new' => 'افزودن عضو جدید',
            'add_new_item' => 'اضافه کردن عضو',
            'new_item' => 'جدید عضو',
            'edit_item' => 'ویرایش عضو',
            'view_item' => 'نمایش عضو',
            'all_items' => 'اعضای تیم',
            'search_items' => 'جستجوی اعضای تیم',
            'parent_item_colon' => 'والد اعضای تیم:',
            'not_found' => 'هیچ عضوی پیدا نشد!',
            'not_found_in_trash' => 'در زباله دان عضوی پیدا نشد!'
        );

        $args = array(
            'labels' => $labels,
            'rewrite' => array('slug' => 'nux-team'),
            'menu_icon' => 'dashicons-groups',
            'supports' => array('title', 'excerpt', 'thumbnail'),
        );

        register_post_type('nux-team', array_merge($this->default_args, $args));
    }

    public function faq()
    {
        $labels = array(
            'name' => 'سوالات متداول',
            'singular_name' => 'سوال',
            'menu_name' => 'سوالات متداول',
            'name_admin_bar' => 'سوال',
            'add_new' => 'افزودن سوال جدید',
            'add_new_item' => 'اضافه کردن سوال',
            'new_item' => 'جدید سوال',
            'edit_item' => 'ویرایش سوال',
            'view_item' => 'نمایش سوال',
            'all_items' => 'سوالات متداول',
            'search_items' => 'جستجوی سوالات متداول',
            'parent_item_colon' => 'والد سوالات متداول:',
            'not_found' => 'هیچ سوالی پیدا نشد!',
            'not_found_in_trash' => 'در زباله دان سوالی پیدا نشد!'
        );

        $args = array(
            'labels' => $labels,
            'rewrite' => array('slug' => 'nux-faq'),
            'menu_icon' => 'dashicons-format-status',
            'supports' => array('title', 'editor'),
        );

        register_post_type('nux-faq', array_merge($this->default_args, $args));
    }

}