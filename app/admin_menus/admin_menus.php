<?php

namespace admin_menus;

class Admin_Menus{

    public function __construct()
    {
        add_action( 'admin_menu', [$this, 'optimize_menu'] );
        add_action( 'admin_menu', [$this, 'security_menu'] );
    }

    public function optimize_menu()
    {
        add_menu_page( 'بهینه سازی سایت',
            'NUX Optimize',
            'manage_options',
            'nux-optimize',
            [$this, 'render_optimize_menu'],
            'dashicons-superhero'
        );
    }

    public function render_optimize_menu()
    {
        get_template_part('templates/admin_menus/optimize');
    }


    public function security_menu()
    {
        add_menu_page( 'امنیت سایت',
            'NUX Security',
            'manage_options',
            'nux-security',
            [$this, 'render_security_menu'],
            'dashicons-privacy'
        );
    }

    public function render_security_menu()
    {
        get_template_part('templates/admin_menus/security');
    }

}