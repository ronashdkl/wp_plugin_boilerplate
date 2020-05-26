<?php
/**
 * @package RonashPlugin
 */

namespace Inc\base;



/**
 * Display plugin links
 */
class SettingLinks extends BaseController{
 
    public function register(){
      
        add_filter("plugin_action_links_".$this->plugin,[$this,'setting_links'],0);
    }

    function setting_links( $links ) {
        $links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=ronash_plugin') ) .'">Settings</a>';
       
        return $links;
     }
    
}