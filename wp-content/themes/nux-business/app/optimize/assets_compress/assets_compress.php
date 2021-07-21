<?php

namespace optimize\assets_compress;

use Site_Options;

class Assets_Compress
{
    public $destination_dir;
    
    public $destination_url;

    private $enabled_compress_css;
    private $enabled_compress_js;

    public function __construct()
    {
        if (!(current_user_can('manage_options'))) {
            
            $this->destination_dir = get_template_directory() . '/assets/compress/';
            $this->destination_url = get_template_directory_uri() . '/assets/compress/';

            $this->enabled_compress_css = !empty(Site_Options::get()['optimization']['compress']['minify_combine_css']) ? 1 : 0;
            $this->enabled_compress_js = !empty(Site_Options::get()['optimization']['compress']['minify_combine_js']) ? 1 : 0;

            add_action('init', function () {
                $GLOBALS['wp_scripts'] = new Filterable_Scripts();
            });

            add_filter('nux_localize_scripts', [$this, 'set_queue_localized_scripts'], 10, 3);

            add_action('wp_enqueue_scripts', [$this, 'nux_print_scripts_styles'], 99995);
            
            add_action('wp_enqueue_scripts', [$this, 'nux_deregister_scripts_styles'], 99996);

            add_action('wp_enqueue_scripts', [$this, 'nux_enqueue_bundles'], 99997);

        }
    }

    function set_queue_localized_scripts($l10n, $handle, $object_name){
        global $wp_scripts;
        if (in_array($handle, $wp_scripts->queue)) {
            $GLOBALS['localize_scripts'][] = compact('handle', 'object_name', 'l10n');
        }
        return $l10n;
    }

    function nux_print_scripts_styles()
    {
        $result = [];
        $result['scripts'] = [];
        $result['styles'] = [];
        $wp_scripts = wp_scripts();
        $wp_styles = wp_styles();

        if ($this->enabled_compress_js){
            $jquery_scripts = array('jquery-core', 'jquery-migrate');
            foreach ($jquery_scripts as $script) {
                $result['scripts'][] = $wp_scripts->registered[$script]->src;
            }
            foreach ($wp_scripts->queue as $script) :
                $result['scripts'][] = $wp_scripts->registered[$script]->src;
            endforeach;
        }

        if ($this->enabled_compress_css) {
            foreach ($wp_styles->queue as $style) :
                $result['styles'][] = $wp_styles->registered[$style]->src;
            endforeach;
        }

        $GLOBALS['nux_assets'] = $result;
    }

    function nux_deregister_scripts_styles()
    {
        $wp_scripts = wp_scripts();
        $wp_styles = wp_styles();

        if ($this->enabled_compress_js) {
            foreach ($wp_scripts->registered as $wp_script) {
                wp_deregister_script($wp_script->handle);
            }
        }

        if ($this->enabled_compress_css) {
            foreach ($wp_styles->registered as $wp_style) {
                wp_deregister_style($wp_style->handle);
            }
        }
    }

    function nux_enqueue_bundles()
    {
        global $nux_assets;

        require_once 'assets_compress.php';

        if ($this->enabled_compress_css) {
            wp_enqueue_style('bundle', $this->comp_css($nux_assets['styles'], 'bundle.min.css', true));
        }

        if ($this->enabled_compress_js) {
            wp_enqueue_script('bundle', $this->comp_js($nux_assets['scripts'], 'bundle.min.js', true), null, null, 'true');

            if (!empty($GLOBALS['localize_scripts'])) {
                foreach ($GLOBALS['localize_scripts'] as $localize_script) {
                    wp_localize_script('bundle', $localize_script['object_name'], $localize_script['l10n']);
                }
            }
        }
    }

    public function comp_js($array_files, $dest_file_name, $return_url = false)
    {
        $content = "";
        foreach ($array_files as $file) {
            $search = 'http';
            if (!preg_match("/{$search}/i", $file)) {
                $file = home_url() . $file;
            }
            $content .= file_get_contents($file);
        }

        $content = $this->minify_js($content);

        if (!is_dir($this->destination_dir)) {
            mkdir($this->destination_dir);
        }

        $new_file = fopen($this->destination_dir . $dest_file_name, "w");
        fwrite($new_file, $content); //write to destination
        fclose($new_file);
        if ($return_url){
            return $this->destination_url . $dest_file_name;
        }
        return '<script src="' . $this->destination_url . $dest_file_name . '"></script>';

    }

    public function comp_css($array_files, $dest_file_name, $return_url = false)
    {

        $content = "";
        foreach ($array_files as $file) {
            $search = 'http';
            if (!preg_match("/{$search}/i", $file)) {
                $file = home_url() . $file;
            }
            $content .= file_get_contents($file);
        }

        $content = $this->minify_css($content);

        if (!is_dir($this->destination_dir)) {
            mkdir($this->destination_dir);
        }

        $new_file = fopen($this->destination_dir . $dest_file_name, "w");
        fwrite($new_file, $content);
        fclose($new_file);
        if ($return_url){
            return $this->destination_url . $dest_file_name;
        }
        return '<link rel="stylesheet" href="' . $this->destination_url . $dest_file_name . '" type="text/css" media="all">';

    }

    private function minify_css($content)
    {
        $content = preg_replace('/\/\*((?!\*\/).)*\*\//', '', $content); // negative look ahead
        $content = preg_replace('/\s{2,}/', ' ', $content);
        $content = preg_replace('/\s*([:;{}])\s*/', '$1', $content);
        $content = preg_replace('/;}/', '}', $content);
        return $content;
    }

    private function minify_js($content)
    {
        $content = JShrink_Minifier::minify($content);
        return $content;
    }
    
}