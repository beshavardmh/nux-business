<?php

class Customizer
{

    public function __construct()
    {
        add_action('customize_register', [$this, 'settings']);
    }

    public function settings($wp_customize)
    {
        $wp_customize->add_setting('nux_logo');

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'nux_logo',
            array(
                'label' => 'لوگو‌ی سایت',
                'section' => 'title_tagline',
                'settings' => 'nux_logo',
            )));
    }

}