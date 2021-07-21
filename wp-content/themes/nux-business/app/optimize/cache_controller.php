<?php

namespace optimize;

use Site_Options;

class Cache_Controller
{

    private $enabled = 0;

    private $cache_ext = '.html';

    private $cache_time = 10; // per minute

    private $cache_folder = 'cache/';

    private $dynamic_url = '';

    private $cache_file = '';

    private $has_exception = 0;

    private $exception_type;

    private $accept_pages = array();

    private $ignore_pages = array();

    private $ignore = false;

    public function __construct()
    {
        $cache_options = Site_Options::get()['optimization']['cache'];

        $this->cache_ext = '.html';

        $this->cache_time = !empty($cache_options['cache_exp_time']) ? $cache_options['cache_exp_time'] * 60 : $this->cache_time * 60;

        $this->cache_folder = get_template_directory() . '/templates/cache/';

        $this->dynamic_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $this->cache_file = $this->cache_folder . md5($this->dynamic_url) . $this->cache_ext;

        if ($cache_options && intval($cache_options['enabled_cached']) && !current_user_can('manage_options')) {
            $this->has_exception = !empty($cache_options['has_exception']) ? $cache_options['has_exception'] : 0;

            $this->exception_type = $cache_options['exception_type'] == 'accept' ? 'accept' : 'ignore';

            if ($this->exception_type == 'accept') {
                $this->accept_pages = !empty($cache_options['exceptions']) ? $cache_options['exceptions'] : array();
            }

            if ($this->exception_type == 'ignore') {
                $this->ignore_pages = !empty($cache_options['exceptions']) ? $cache_options['exceptions'] : array();
            }

            foreach ($this->ignore_pages as $ignore_page) {
                if (preg_match("#^$ignore_page#i", $this->dynamic_url)) {
                    $this->ignore = true;
                    break;
                }
            }

            if (!empty($this->accept_pages)) {
                foreach ($this->accept_pages as $accept_page) {
                    if (!preg_match("#^$accept_page#i", $this->dynamic_url)) {
                        $this->ignore = true;
                    } else {
                        $this->ignore = false;
                    }
                }
            }

            add_filter('nux_buffer_filter', [$this, 'create']);
            add_filter('nux_buffer_filter', [$this, 'read']);
        }

        add_action("wp_ajax_remove_all_caches_ajax", [$this, 'remove_all_caches_ajax']);
        add_action("wp_ajax_nopriv_remove_all_caches_ajax", [$this, 'remove_all_caches_ajax']);
    }

    public function read($buffer)
    {
        if (!$this->ignore && file_exists($this->cache_file) && time() - $this->cache_time < filemtime($this->cache_file)) {
            $buffer = file_get_contents($this->cache_file) . '<!-- Page cached. -->';
        }
        return $buffer;
    }

    public function create($buffer)
    {
        if (!is_dir($this->cache_folder)) {
            mkdir($this->cache_folder);
        }
        if (!$this->ignore) {
            if (file_exists($this->cache_file)) {
                if (time() - $this->cache_time >= filemtime($this->cache_file)){
                    $fp = fopen($this->cache_file, 'w');
                    fwrite($fp, $buffer);
                    fclose($fp);
                }
            } else {
                $fp = fopen($this->cache_file, 'w');
                fwrite($fp, $buffer);
                fclose($fp);
            }
        }
        return $buffer;
    }

    public function remove_all_caches_ajax()
    {
        $nonce = $_POST['nonce'];
        if (!wp_verify_nonce($nonce, 'ajax_nonce')) {
            die('Nonce value cannot be verified.');
        }

        $data = [
            'msg' => '',
        ];

        $result = [];
        $files = glob($this->cache_folder . '*'); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                $result[] = unlink($file) ? 1 : 0; // delete file
            }
        }
        $result = in_array(0, $result) ? 0 : 1;

        if (!$result) {
            $data['msg'] = 'خطا در انجام عملیات!';
            wp_send_json_error($data);
        } else {
            $data['msg'] = 'کش ها با موفقیت پاک شدند.';
            wp_send_json_success($data);
        }
    }

}