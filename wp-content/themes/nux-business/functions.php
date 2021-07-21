<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

if (!session_id()) {
    session_start();
}

require 'app/core/autoloader.php';
require 'app/core/site_functions.php';

(new \core\Bootstrap());