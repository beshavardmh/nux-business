<?php
namespace core;

class Init{
	public static function setup() {
		self::theme_supports();

		self::images_sizes();

		self::nav_menus();

		self::sidebars();

		add_filter( 'use_block_editor_for_post', '__return_false' );
	}

	public static function theme_supports() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}

    public static function images_sizes() {
	    add_image_size('nux_thumbnail', 450, 300, true);
    }

	public static function nav_menus() {
		register_nav_menus( array(
			'primary' => 'منوی اصلی',
		) );
	}

	public static function sidebars() {
		register_sidebar( array(
			'name'          => 'سایدبار میانی فوتر 1',
			'id'            => 'sidebar_middle_1',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="font-18">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => 'سایدبار میانی فوتر 2',
			'id'            => 'sidebar_middle_2',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
            'before_title'  => '<h2 class="font-18">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => 'سایدبار میانی فوتر 3',
			'id'            => 'sidebar_middle_3',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
            'before_title'  => '<h2 class="font-18">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => 'سایدبار انتهایی فوتر',
			'id'            => 'sidebar_bottom',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
		) );
	}
}