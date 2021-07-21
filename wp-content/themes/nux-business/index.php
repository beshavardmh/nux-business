<?php
ob_start([Buffer_Controller::class, 'filters']);

get_header();

if ( have_posts() ) {
    nux_loop_template();
} else {
	get_template_part( 'templates/loop/404' );
}

get_footer();

ob_end_flush();