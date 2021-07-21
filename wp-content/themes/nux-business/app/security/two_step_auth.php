<?php

namespace security;

use Site_Options;

class Two_Step_Auth
{
    private $enabled = false;

    public static $user_login_codes;

    private $two_step_auth_slug = 'two-step-auth';
    private $two_step_auth_query_var = 'nux_two_step_auth';

    public function __construct()
    {
        $this->enabled = Site_Options::get()['security']['two_step_auth']['enabled'];
        if (is_site_on_locahost()) {
            $this->enabled = false;
        }

        if (!isset($_SESSION['is_user_verified'])){
            $_SESSION['is_user_verified'] = false;
        }

        if ($this->enabled && !$_SESSION['is_user_verified']) {
            $this->create_db_option();
            $this->validation();
        }
    }

    public function create_db_option()
    {
        $login_codes = get_option('_nux_login_codes');
        if (!$login_codes) {
            update_option('_nux_login_codes', serialize(array()));
        }
    }

    public function get_user_login_code()
    {
        $login_codes = get_option('_nux_login_codes');
        $login_codes = unserialize($login_codes);

        $user_id = get_current_user_id();

        return $login_codes[$user_id];
    }

    public function create_user_login_code()
    {
        $login_codes = get_option('_nux_login_codes');
        $login_codes = unserialize($login_codes);

        $user_id = get_current_user_id();

        if (!isset($login_codes[$user_id])) {
            $code = rand(100000, 999999);
            $login_codes[$user_id]['code'] = $code;
            $login_codes[$user_id]['verify'] = 0;
            $login_codes[$user_id]['mail_sent'] = 0;
        }

        self::$user_login_codes = $login_codes[$user_id];

        update_option('_nux_login_codes', serialize($login_codes));
    }

    public function create_user_login_code_property(array $properties = array())
    {
        $login_codes = get_option('_nux_login_codes');
        $login_codes = unserialize($login_codes);

        $user_id = get_current_user_id();

        foreach ($properties as $property => $value) {
            switch ($property) {
                case 'code':
                    $login_codes[$user_id]['code'] = $value;
                case 'verify':
                    $login_codes[$user_id]['verify'] = $value;
                case 'mail_sent':
                    $login_codes[$user_id]['mail_sent'] = $value;
            }
        }

        self::$user_login_codes = $login_codes[$user_id];

        update_option('_nux_login_codes', serialize($login_codes));
    }

    public function remove_user_verified()
    {
        $login_codes = get_option('_nux_login_codes');
        $login_codes = unserialize($login_codes);

        $user_id = get_current_user_id();

        unset($login_codes[$user_id]);

        update_option('_nux_login_codes', serialize($login_codes));
    }

    public function generate_template()
    {
        add_filter('generate_rewrite_rules', function ($wp_rewrite) {
            $wp_rewrite->rules = array_merge(
                ["$this->two_step_auth_slug/?$" => "index.php?{$this->two_step_auth_query_var}=1"],
                $wp_rewrite->rules
            );
        });
        add_filter('query_vars', function ($query_vars) {
            $query_vars[] = $this->two_step_auth_query_var;
            return $query_vars;
        });
        add_action('template_redirect', function () {
            $custom = intval(get_query_var($this->two_step_auth_query_var));
            if ($custom) {
                get_template_part('templates/two-step-auth');
                die;
            }
        });
    }

    public function is_user_verify()
    {
        $user_login_code = $this->get_user_login_code();
        return $user_login_code['verify'] == 1;
    }

    public function send_login_code()
    {
        $user_login_code = $this->get_user_login_code()['code'];
        $user_info = get_userdata(get_current_user_id());
        $user_email = $user_info->user_email;
        $admin_email = get_bloginfo('admin_email');

        $mail_to = $user_email;
        $mail_subject = 'کد تایید ورود به ' . get_bloginfo('name');
        $mail_message = 'کد تایید ورود شما: ' . $user_login_code;
        $mail_headers = array("Content-Type: text/html; charset=UTF-8", "From: $admin_email");

        $mail_sent = $this->get_user_login_code()['mail_sent'];

        $uri = $_SERVER['REQUEST_URI'];
        if (strpos($uri, $this->two_step_auth_slug) && !$mail_sent) {
            $sent = wp_mail($mail_to, $mail_subject, $mail_message, $mail_headers);
        } else {
            $sent = false;
        }

        $_SESSION['mail_sent_msg'] = $sent ? 'کد ورود به ایمیل شما ارسال شد.' : 'خطا در ارسال ایمیل';
        $_SESSION['mail_sent_status'] = $sent ? 1 : 0;

        if ($sent) {
            $this->create_user_login_code_property(['mail_sent' => 1]);
        }
    }

    public function validation()
    {
        if (is_user_logged_in()) {

            if (!$this->is_user_verify()) {

                $this->generate_template();
                flush_rewrite_rules();
                $this->create_user_login_code();

                $mail_sent = $this->get_user_login_code()['mail_sent'];
                if (!$mail_sent) $this->send_login_code();

                $this->request_controller();

                $uri = $_SERVER['REQUEST_URI'];
                if (!strpos($uri, $this->two_step_auth_slug) && is_admin()) {
                    wp_redirect(get_site_url() . "/$this->two_step_auth_slug");
                    die;
                }

            }
            else{

                $this->remove_user_verified();
                flush_rewrite_rules();
                $_SESSION['is_user_verified'] = true;

                wp_redirect(admin_url());
                die;

            }

        }
    }

    public function run_ajax()
    {
        add_action("wp_ajax_check_verified_user_ajax", [$this, 'check_verified_user_ajax']);
        add_action("wp_ajax_nopriv_check_verified_user_ajax", [$this, 'check_verified_user_ajax']);

        add_action("wp_ajax_resend_verify_code_ajax", [$this, 'resend_verify_code_ajax']);
        add_action("wp_ajax_nopriv_resend_verify_code_ajax", [$this, 'resend_verify_code_ajax']);
    }

    public function request_controller()
    {
        if (isset($_REQUEST['nux_check_user_verified'])) {
            $user_login_code = $this->get_user_login_code()['code'];
            if ($_REQUEST['login_code'] == $user_login_code) {
                $this->create_user_login_code_property(['verify' => 1]);
                $_SESSION['user_verify_msg'] = 'احراز هویت شما موفقیت آمیز بود.';
                $this->validation();
            } else {
                $_SESSION['user_verify_msg'] = 'کد وارد شده صحیح نیست!';
                wp_redirect(admin_url());
                die;
            }
        }

        if (isset($_REQUEST['nux_resend_verify_code'])) {
            $this->create_user_login_code_property(['mail_sent' => 0]);
            $this->send_login_code();
            wp_redirect(admin_url());
            die;
        }
    }
}