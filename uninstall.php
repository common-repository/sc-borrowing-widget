<?php

/**
 * Trigger this file on plugin uninstall
 * 
 * @package SC-BorrowingWidgetPlugin
 */

 if ( ! defined('WP_UNINSTALL_PLUGIN')) {
    die;
 }

 //Clear database stored data

//  $smartCredit = get_posts( array('post_type' => 'Smart Credit', 'numberposts' => -1));

//  foreach( $smartCredit as $data ){
//    wp_delete_post( $data -> ID, false);
//  }
//Access the database via SQL


global $wpdb; 
$wpdb -> query("DELETE FROM wp_posts WHERE post_type = 'Smart Credit");
$wpdb -> query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb -> query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");
