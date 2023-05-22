<?php

namespace nav_menu;

use Walker_Nav_Menu;

class Mobile extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $title = $item->title;
        $permalink = $item->url;
        $classes = $item->classes;
        $active = '';

        if (in_array('current-menu-item', $item->classes)) {
            $active = 'active ';
        }

        if ($depth == 0) {
            $output .= "<li class='py-3" . implode(" ", $classes) . "'>";

            $output .= '<a class="'. $active .'" href="' . $permalink . '">';

            $output .= $title;

            $output .= '</a>';
        }

    }
}