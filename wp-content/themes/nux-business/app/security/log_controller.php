<?php

namespace security;

use Site_Options;

class Log_Controller
{
    public $logs;

    public $site_options = array();

    public function __construct()
    {
        $this->blacklist_controller();
        $this->update_logs();
    }

    public function blacklist_controller()
    {
        $blacklist_ip = Site_Options::get()['security']['blacklist_ip'];
        if (!empty($blacklist_ip)) {
            foreach ($blacklist_ip as $ip) {
                if (get_the_user_ip() == $ip) {
                    $uri = $_SERVER['REQUEST_URI'];
                    if (!strpos($uri, '403-forbidden')) {
                        wp_redirect(get_site_url() . '/403-forbidden');
                        die;
                    }
                }
            }
        }
    }

    public function update_logs()
    {
        $this->logs = Site_Options::get()['security']['logs'];
        $this->site_options = Site_Options::get();

        add_action('wp_login', function ($user_login, $user) {
            $user_ip = get_the_user_ip();
            $this->logs = "User ip '$user_ip' logged in. \n" . $this->logs;
            $this->site_options['security']['logs'] = $this->logs;
            Site_Options::set($this->site_options);
        }, 10, 2);

        add_action('wp_logout', function ($user_id) {
            $user_ip = get_the_user_ip();
            $this->logs = "User ip '$user_ip' logged out. \n" . $this->logs;
            $this->site_options['security']['logs'] = $this->logs;
            Site_Options::set($this->site_options);
        }, 10);
    }
}