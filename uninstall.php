<?php

/**
 * trigger tihs file on plugin uninstall
 * @package RonashPlugiin
 */

 if(!defined('WP_UNINSTALL_PLUGIN')) die;

 //clear db stored data

 global $wpdb;
 $wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'book'" );
 $wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id from wp_post)" );
 $wpdb->query( "DELETE FROM wp_term_relationship WHERE object_id NOT IN (SELECT id from wp_post)" );


//  $books = get_posts([
//      'post_type'=>'book',
//      'numberpost'=>-1
//  ]);

//  foreach($books as $book){
//      wp_delete_post($book->ID,true);
//  }