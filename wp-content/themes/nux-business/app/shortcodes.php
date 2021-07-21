<?php

class Shortcodes{
	public function __construct() {
		add_shortcode( 'nux_homepage', [$this, 'home_cb'] );
		add_shortcode( 'nux_about', [$this, 'about_cb'] );
		add_shortcode( 'nux_contact', [$this, 'contact_cb'] );
		add_shortcode( 'nux_blog', [$this, 'blog_cb'] );
		add_shortcode( 'nux_solutions', [$this, 'solutions_cb'] );
		add_shortcode( 'nux_experts', [$this, 'experts_cb'] );
	}

	public function home_cb($atts, $content = '') {
		ob_start();
		get_template_part( 'templates/shortcodes/homepage', null,
			compact('atts', 'content') );
		return ob_get_clean();
	}

	public function about_cb($atts, $content = '') {
		ob_start();
		get_template_part( 'templates/shortcodes/about', null,
			compact('atts', 'content') );
		return ob_get_clean();
	}

	public function contact_cb($atts, $content = '') {
		ob_start();
		get_template_part( 'templates/shortcodes/contact', null,
			compact('atts', 'content') );
		return ob_get_clean();
	}

	public function blog_cb($atts, $content = '') {
		ob_start();
		get_template_part( 'templates/shortcodes/blog', null,
			compact('atts', 'content') );
		return ob_get_clean();
	}

	public function solutions_cb($atts, $content = '') {
		ob_start();
		get_template_part( 'templates/shortcodes/solutions', null,
			compact('atts', 'content') );
		return ob_get_clean();
	}

	public function experts_cb($atts, $content = '') {
		ob_start();
		get_template_part( 'templates/shortcodes/experts', null,
			compact('atts', 'content') );
		return ob_get_clean();
	}
}

//array(
//	'layout' => [
//		'header' => [
//			'show' => 1,
//			'sticky' => 1,
//			'transparent' => 1,
//			'title_bar' => 1,
//		],
//		'container' => 'fluid / wide',
//		'footer' => [
//			'middle' => 1,
//			'bottom' => 1,
//		]
//	]
//);