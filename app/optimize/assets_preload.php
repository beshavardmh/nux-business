<?php

namespace optimize;

use Site_Options;

class Assets_Preload
{

    private $styles = array();

    private $scripts = array();

    private $images = array();

    private $videos = array();

    private $fonts = array();

    public function __construct()
    {
        $preloads = Site_Options::get()['optimization']['preloads'];
        if ($preloads && !current_user_can('manage_options')) {

            $this->styles = !empty($preloads['styles']) ? $preloads['styles'] : array();
            $this->scripts = !empty($preloads['scripts']) ? $preloads['scripts'] : array();
            $this->images = !empty($preloads['images']) ? $preloads['images'] : array();
            $this->videos = !empty($preloads['videos']) ? $preloads['videos'] : array();
            $this->fonts = !empty($preloads['fonts']) ? $preloads['fonts'] : array();

            if (!empty($this->styles) ||
                !empty($this->scripts) ||
                !empty($this->images) ||
                !empty($this->videos) ||
                !empty($this->fonts)) {
                add_action('wp_head', [$this, 'preloads'], 1);
            }

        }
    }

    public function preloads()
    {

        if (!empty($this->fonts)) {
            foreach ($this->fonts as $font) {
                ?>
                <link rel="preload" as="font" href="<?php echo esc_url($font); ?>"  type="font/woff" crossorigin>
                <?php
            }
        }

        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                ?>
                <link rel="preload" as="image" href="<?php echo esc_url($image); ?>">
                <?php
            }
        }

        if (!empty($this->videos)) {
            foreach ($this->videos as $video) {
                ?>
                <link rel="preload" as="video" href="<?php echo esc_url($video); ?>" type="video/mp4">
                <?php
            }
        }

        if (!empty($this->scripts)) {
            foreach ($this->scripts as $script) {
                ?>
                <link rel="preload" as="script" href="<?php echo esc_url($script); ?>" importance="high">>
                <?php
            }
        }

        if (!empty($this->styles)) {
            foreach ($this->styles as $style) {
                ?>
                <link rel="preload" as="style" href="<?php echo esc_url($style); ?>">
                <?php
            }
        }
    }

}