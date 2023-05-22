<?php

namespace security;

use Site_Options;

class Custom_Admin_Slug
{
    public $wpadmin_slug;

    public $is_active = 0;

    const COOKIE_NUX_WPADMIN = 'valid_login_slug';

    public function __construct()
    {
        $this->wpadmin_slug = !empty(Site_Options::get()['security']['login_url']['path']) ? Site_Options::get()['security']['login_url']['path'] : 0;
        $this->is_active = !empty(Site_Options::get()['security']['login_url']['path']) ? 1 : 0;

        add_filter('generate_rewrite_rules', array($this, 'rewrite_admin_slug'));
        add_action('admin_init', array($this, 'set_admin_slug'));
        add_action('login_init', array($this, 'login'));
    }

    function rewrite_admin_slug()
    {
        if ($this->wpadmin_slug && $this->is_active) {
            add_rewrite_rule("{$this->wpadmin_slug}/?$", 'wp-login.php', 'top');
        }
    }

    function set_admin_slug()
    {
        if ($this->wpadmin_slug) {
            $this->rewrite_admin_slug();
        }
        flush_rewrite_rules();
    }

    function login()
    {
        // are we in the right place?
        if (in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) && $this->wpadmin_slug) {
            // check if our plugin have wrote necesery line to .htaccess
            // sometimes WP doesn't write correctly so we don't want to disable login in that case
            $htaccess = implode('', file(ABSPATH . '.htaccess'));

            if ($htaccess && preg_match('/RewriteRule \^' . $this->wpadmin_slug . '\/\?\$/', $htaccess)) {
                $this->validate_login();
            }
        }
    }

    function validate_login()
    {
        $url = $this->get_current_url();
        $query_arr = $url['query_arr'];

        if ("/wp-login.php?loggedout=true" === $url['path'] . "?" . $url['query_string']) {
            wp_redirect(home_url());
            exit();
        } else if (isset($query_arr['action']) && $query_arr['action'] == 'logout') {
            $this->clear_auth_cookie();
        } else if (isset($query_arr['action']) && in_array($query_arr['action'], array('lostpassword', 'postpass', 'resetpass', 'rp'))) {
            // let user to this pages
        } else if (trim($url['path'], '/') == $this->wpadmin_slug) {
            $this->set_auth_cookie();
        } else if ($this->validate_auth_cookie()) {
            // we're on default url, redirect to our
            wp_redirect($this->wpadmin_slug);
        } else {
            wp_redirect(home_url());
            exit();
        }
    }

    function set_auth_cookie()
    {
        setcookie(self::COOKIE_NUX_WPADMIN, 1, 0, COOKIEPATH, COOKIE_DOMAIN);
    }

    function validate_auth_cookie()
    {
        return isset($_COOKIE[self::COOKIE_NUX_WPADMIN]);
    }

    function clear_auth_cookie()
    {
        unset($_COOKIE[self::COOKIE_NUX_WPADMIN]);
        setcookie(self::COOKIE_NUX_WPADMIN, '', time() - YEAR_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);
    }

    function get_current_url()
    {
        // extract query string into array
        parse_str($_SERVER['QUERY_STRING'], $query_arr);

        list($path, $arguments) = explode("?", $_SERVER['REQUEST_URI']);

        $url = array();
        $url['scheme'] = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off" ? "https" : "http";
        $url['domain'] = $_SERVER['HTTP_HOST'];
        $url['port'] = isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] ? $_SERVER["SERVER_PORT"] : "";
        $url['query_string'] = $_SERVER['QUERY_STRING'];
        $url['query_arr'] = $query_arr;
        $url['rewrite_base'] = ($host = explode($url['scheme'] . "://" . $_SERVER['HTTP_HOST'], get_bloginfo('url'))) ? preg_replace("/^\//", "", implode("", $host)) : "";
        $url['path'] = $url['rewrite_base'] ? implode("", explode("/" . $url['rewrite_base'], $path)) : $path;
        $url['filename'] = $url['rewrite_base'] ? implode("", explode("/" . $url['rewrite_base'], $_SERVER["SCRIPT_NAME"])) : $_SERVER["SCRIPT_NAME"];

        if ($url['path'] == $url['filename']) {
            $url['path'] = '/';
        }

        $url['filename'] = ltrim($url['filename'], '/');

        return $url;
    }
}