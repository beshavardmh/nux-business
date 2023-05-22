<?php

namespace core;

class Bootstrap{

    public function __construct()
    {
        add_action('after_setup_theme', [\core\Init::class, 'setup']);

        (new \core\Enqueue_Scripts());

        (new \Hooks());

        (new \Shortcodes());

        (new \admin_menus\Post_Types());

        (new \admin_menus\Meta_Boxes());

        (new \admin_menus\Admin_Menus());

        (new \Customizer());

        (new \Site_Options());

        (new \optimize\Init());

        (new \security\Init());
    }

}