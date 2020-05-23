<?php
/**
 * @package RonashPlugin
 */

namespace Inc\base;



class Enqueue extends BaseController{
 
    public function register(){
        add_action('admin_enqueue_scripts',[$this,'enqueue']);
    }

    function enqueue(){
        wp_enqueue_style('mypluginstyle',$this->plugin_url.'assets/mystyle.css');
        wp_enqueue_script('mypluginstyle',$this->plugin_url.'assets/myscript.js');
        }
}