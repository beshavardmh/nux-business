<?php

namespace optimize;

use optimize\assets_compress\Assets_Compress;

class Init{

    public function __construct()
    {
        (new Cache_Controller());
        (new Minify_Html());
        (new Assets_Compress());
        (new Lazyload_Images());
        (new Assets_Preload());
    }

}