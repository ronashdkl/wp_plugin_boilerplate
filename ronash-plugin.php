<?php
/**
 * @package RonashDhakal
 */

use Inc\base\Activate;
use Inc\base\Deactivate;
use Inc\Init;
/** 
 Plugin Name: Ronash Plugin
 Plugin Uri: http://ronash.com.np
 Description: My first custom plugin
 Version :1.0.0
 Author: Ronash Dhakal
 License: GPLv2 later
*/

defined('ABSPATH') or die('Not found!');


if(file_exists(dirname(__FILE__)."/vendor/autoload.php")){
    require_once dirname(__FILE__)."/vendor/autoload.php";
}

if(!function_exists('add_action'))exit;


/**
 * active function
 *
 * @return void
 */
function active_plugin(){
    Activate::activate();
}
register_activation_hook(__FILE__,'active_plugin');

/**
 * Deactive function
 *
 * @return void
 */
function deactive_plugin(){
    Deactivate::deactivate();
}
register_deactivation_hook(__FILE__,'deactive_plugin');



if(class_exists("Inc\\Init")){
    Init::registerServices();
  }


