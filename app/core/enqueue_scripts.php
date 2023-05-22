<?php

namespace core;

class Enqueue_Scripts
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'wp_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
    }

    public function wp_scripts()
    {
//	    css
        wp_enqueue_style('nux-bootstrap',
            get_template_directory_uri() . '/assets/css/bootstrap-customize.min.css', array());

        wp_enqueue_style('nux-fontawesome',
            get_template_directory_uri() . '/assets/css/fontawesome.css', array());

        wp_enqueue_style('nux-aos',
            get_template_directory_uri() . '/assets/css/aos.css', array());

        wp_enqueue_style('nux-app',
            get_template_directory_uri() . '/assets/css/app.css', array());

//		js
        wp_enqueue_script('nux-bootstrap',
            get_template_directory_uri() . '/assets/js/bootstrap-customize.min.js',
            array('jquery'), false, true);

        wp_enqueue_script('nux-aos',
            get_template_directory_uri() . '/assets/js/aos.js',
            array('jquery'), false, true);

        wp_enqueue_script('nux-lazysizes',
            get_template_directory_uri() . '/assets/js/lazysizes.min.js',
            array('jquery'), false, true);

        wp_enqueue_script('nux-app',
            get_template_directory_uri() . '/assets/js/app.js',
            array('jquery'), false, true);

        wp_localize_script('nux-app', 'nux_ajax',
            array('ajax_url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax_nonce')));

        do_action('nux_localize_wp_script');
    }

    public function admin_scripts($hook)
    {
        wp_enqueue_style('nux-uikit',
            get_template_directory_uri() . '/assets/css/uikit.min.css', array());

        wp_enqueue_style('nux-app-admin',
            get_template_directory_uri() . '/assets/css/app-admin.css', array());

        wp_enqueue_script('nux-uikit', get_template_directory_uri() . '/assets/js/uikit.min.js',
            array('jquery'), false, true);

        wp_enqueue_script('app-admin', get_template_directory_uri() . '/assets/js/app-admin.js',
            array('jquery'), false, true);

        wp_localize_script('app-admin', 'nux_ajax',
            array('ajax_url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ajax_nonce')));

        do_action('nux_localize_admin_script');
    }
}