<?php

class Buffer_Controller{
    public static function filters($buffer)
    {
        return apply_filters('nux_buffer_filter', $buffer);
    }
}