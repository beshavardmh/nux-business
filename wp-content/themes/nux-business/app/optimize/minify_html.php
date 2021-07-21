<?php

namespace optimize;

use Site_Options;

class Minify_Html{
    public function __construct()
    {
        $minify_html = Site_Options::get()['optimization']['compress']['minify_html'];
        if ($minify_html && !current_user_can('manage_options')){
            add_filter('nux_buffer_filter', [$this, 'sanitize_output']);
        }
    }

    public function sanitize_output($buffer)
    {
        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );
        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );
        $buffer = preg_replace($search, $replace, $buffer);
        return $buffer;
    }
}