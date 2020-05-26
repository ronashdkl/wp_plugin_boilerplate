<?php

/**
 * @package RonashPlugin
 */

 namespace Inc\base;

 class Activate {

    public static function activate(){
        flush_rewrite_rules();
        if(get_option('ronash_plugin')){
            return;
        }
        $default = [];
        update_option('ronash_plugin',$default);
    }

 }