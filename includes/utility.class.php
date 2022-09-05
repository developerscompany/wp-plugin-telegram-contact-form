<?php
if ( ! defined( 'ABSPATH' ) ) exit;

abstract class RFT_Utility
{

    public static function clean_input_string( $string ){
        return str_replace(['/', '\\'], '', $string);
    }



}