<?php

namespace security;

use Site_Options;

class Limit_Login
{
    private $expiration = 1; // per minute

    private $try_time = 3;

    public function __construct()
    {
        $limit_login = Site_Options::get()['security']['limit_login'];
        if (intval($limit_login['enabled'])) {

            $this->expiration = !empty($limit_login['exp_time']) ? $limit_login['exp_time'] : $this->expiration;
            $this->try_time = !empty($limit_login['try_time']) ? $limit_login['try_time'] : $this->try_time;

            add_action('wp_login_failed', [$this, 'login_failed'], 10, 1);
            add_filter('authenticate', [$this, 'check_attempted_login'], 30, 3);
        }
    }

    function login_failed($username)
    {
        if (get_transient('attempted_login')) {
            $datas = get_transient('attempted_login');
            $datas['tried']++;

            if ($datas['tried'] <= $this->try_time) {
                set_transient('attempted_login', $datas, $this->expiration * MINUTE_IN_SECONDS);
            }
        } else {
            $datas = array(
                'tried' => 1
            );
            set_transient('attempted_login', $datas, $this->expiration * MINUTE_IN_SECONDS);
        }
    }

    function check_attempted_login($user, $username, $password)
    {
        if (get_transient('attempted_login')) {
            $datas = get_transient('attempted_login');

            if ($datas['tried'] >= $this->try_time) {
                $until = get_option('_transient_timeout_' . 'attempted_login');
                $time = $this->time_to_go($until);

                return new \WP_Error('too_many_tried', sprintf(__('<strong>خطا</strong>: شما بیش از حد اقدام به ورود کردید، لطفا %s دیگر دوباره تلاش کنید.'), $time));
            }
        }

        return $user;
    }

    function time_to_go($timestamp)
    {

        // converting the mysql timestamp to php time
        $periods = array(
            "ثانیه",
            "دقیقه",
            "ساعت",
            "روز",
            "هفته",
            "ماه",
            "سال"
        );
        $lengths = array(
            "60",
            "60",
            "24",
            "7",
            "4.35",
            "12"
        );
        $current_timestamp = time();
        $difference = abs($current_timestamp - ($timestamp + 2));
        for ($i = 0; $difference >= $lengths[$i] && $i < count($lengths) - 1; $i++) {
            $difference /= $lengths[$i];
        }
        $difference = floor($difference);
        if (isset($difference)) {
            if ($difference != 1) {
//                $periods[$i] .= "s";
            }
            $output = "$difference $periods[$i]";

            return $output;
        }
        return;
    }
}