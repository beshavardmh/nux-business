<?php

namespace optimize\assets_compress;

class Filterable_Scripts extends \WP_Scripts {
    function localize($handle, $object_name, $l10n)
    {
        $l10n = apply_filters('nux_localize_scripts', $l10n, $handle, $object_name);
        return parent::localize($handle, $object_name, $l10n);
    }
}