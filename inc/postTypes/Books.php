<?php
/**
 * @package RonashPlugin
 */

namespace Inc\postTypes;

/**
 * Display plugin links
 */
class Books{
 
    public function register(){
        add_action('init',[$this,'book_post_type']); 
       
    }
    function book_post_type(){
        register_post_type('book',['public'=>true,'label'=>'Books' ]);
    }
    
}