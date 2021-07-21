<?php

namespace security;

class Init{
    public function __construct()
    {
        (new Limit_Login());
        (new Custom_Admin_Slug());
        (new Two_Step_Auth());
        (new Log_Controller());
        (new DB_Backup());
    }
}