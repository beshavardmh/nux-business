<?php

class Autoloader {
	public function __construct() {
		spl_autoload_register( array( $this, '__autoload' ) );
	}

	public function __autoload( $className ) {
		$className = str_replace( "\\", DIRECTORY_SEPARATOR, strtolower( $className ) );
		$file      = get_template_directory() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $className . ".php";

		if ( is_file( $file ) && file_exists( $file ) && is_readable( $file ) ) {
			require_once $file;
		}
	}
}

new Autoloader();