<?php

/**
 * @package RonashPlugin
 */

 namespace Inc\base;

 class Activate {

    public static function activate(){
        flush_rewrite_rules();
    }

 }