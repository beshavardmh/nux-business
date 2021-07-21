<?php

class Site_Options
{
    const OPTIONS_NAME = 'nux_options';

    public static $options;

    public function __construct()
    {
        add_action('init', [$this, 'register']);
    }

    public function register()
    {
        if (!self::get()) {
            self::$options = array(
                'optimization' => [
                    'cache' => [
                        'enabled_cached' => 0,
                        'has_exception' => 0,
                        'exception_type' => 'accept',
                        'exceptions' => [],
                        'cache_exp_time' => 60,
                    ],
                    'preloads' => [
                        'fonts' => [],
                        'images' => [],
                        'videos' => [],
                        'scripts' => [],
                        'styles' => [],
                    ],
                    'lazyload' => [
                        'enabled' => 0,
                    ],
                    'compress' => [
                        'minify_combine_css' => 0,
                        'minify_combine_js' => 0,
                        'minify_html' => 0,
                    ]
                ],
                'security' => [
                    'limit_login' => [
                        'enabled' => 0,
                        'exp_time' => 2,
                        'try_time' => 3,
                    ],
                    'login_url' => [
                        'path' => '',
                    ],
                    'two_step_auth' => [
                        'enabled' => 0,
                    ],
                    'blacklist_ip' => [],
                    'logs' => '',
                ],
            );
            self::set(self::$options);
        }
        self::$options = self::get();
    }

    public static function get()
    {
        return get_theme_mod(self::OPTIONS_NAME);
    }

    public static function set($options)
    {
        set_theme_mod(self::OPTIONS_NAME, $options);
    }

    public static function form_controller()
    {

        // optimization - form posted
        if (isset($_POST['submit_nux_optimization_cache'])) {
            $_POST['optimization']['cache']['exceptions'] = array_map('trim', array_values(explode(',', $_POST['optimization']['cache']['exceptions'])));
            $_POST['optimization']['cache']['exceptions'] = array_filter($_POST['optimization']['cache']['exceptions'], function ($value) {
                return !is_null($value) && $value !== '';
            });
            self::$options['optimization']['cache'] = $_POST['optimization']['cache'];
            self::set(self::$options);
            add_action('admin_notices', function () {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p>تغییرات با موفقیت ذخیره شد.</p>
                </div>
                <?php
            });
        }

        if (isset($_POST['submit_nux_optimization_preloads'])) {
            foreach ($_POST['optimization']['preloads'] as $key => $value) {
                $_POST['optimization']['preloads'][$key] = array_map('trim', array_values(explode(',', $_POST['optimization']['preloads'][$key])));
                $_POST['optimization']['preloads'][$key] = array_filter($_POST['optimization']['preloads'][$key], function ($value) {
                    return !is_null($value) && $value !== '';
                });
            }
            self::$options['optimization']['preloads'] = $_POST['optimization']['preloads'];
            self::set(self::$options);
            add_action('admin_notices', function () {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p>تغییرات با موفقیت ذخیره شد.</p>
                </div>
                <?php
            });
        }

        if (isset($_POST['submit_nux_optimization_lazyload'])) {
            self::$options['optimization']['lazyload'] = $_POST['optimization']['lazyload'];
            self::set(self::$options);
            add_action('admin_notices', function () {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p>تغییرات با موفقیت ذخیره شد.</p>
                </div>
                <?php
            });
        }

        if (isset($_POST['submit_nux_optimization_compress'])) {
            self::$options['optimization']['compress'] = $_POST['optimization']['compress'];
            self::set(self::$options);
            add_action('admin_notices', function () {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p>تغییرات با موفقیت ذخیره شد.</p>
                </div>
                <?php
            });
        }

        // security - form posted
        if (isset($_POST['submit_nux_security_login'])) {
            $_POST['security']['blacklist_ip'] = array_map('trim', array_values(explode(',', $_POST['security']['blacklist_ip'])));
            $_POST['security']['blacklist_ip'] = array_filter($_POST['security']['blacklist_ip'], function ($value) {
                return !is_null($value) && $value !== '';
            });
            $_POST['security']['login_url']['path'] = !empty($_POST['security']['login_url']['path']) ? trim(sanitize_key($_POST['security']['login_url']['path'])) : '';
            $_POST['security']['logs'] = !empty($_POST['security']['logs']) ? stripslashes($_POST['security']['logs']) : '';
            self::$options['security'] = $_POST['security'];
            self::set(self::$options);
            add_action('admin_notices', function () {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p>تغییرات با موفقیت ذخیره شد.</p>
                </div>
                <?php
            });
        }

        if (isset($_POST['submit_nux_security_database'])) {
            $result = \security\Change_Tables_Prefix::run($_POST['security_change_prefix']);
            if ($result) {
                add_action('admin_notices', function () {
                    ?>
                    <div class="notice notice-success is-dismissible">
                        <p>تغییرات با موفقیت ذخیره شد.</p>
                    </div>
                    <?php
                });
            } else {
                add_action('admin_notices', function () {
                    ?>
                    <div class="notice notice-error is-dismissible">
                        <p>خطا در انجام عملیات!</p>
                    </div>
                    <?php
                });
            }
        }

    }
}