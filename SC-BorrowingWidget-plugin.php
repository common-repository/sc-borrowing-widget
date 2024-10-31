<?php
/**
* @package SC-BorrowingWidgetPlugin
*/

/*
Plugin Name: SC-Borrowing Widget
Plugin URI: http://lbw-573624847.eu-central-1.elb.amazonaws.com/plugins/
Description: The Borrowing Widget allows the user to borrow stablecoin or Ethereum directly via their Metamask wallet or WalletConnect without intermediaries.
Version: 1.0.4
Author: Smart Credit
Author URI: http://smartcredit.io/
License: GPLv2 or later 
Text Domain : sc-borrowing-widget
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

defined( 'ABSPATH' ) or die( 'You can\t access this file!' );

class BorrowingWidgetPlugin {

    public $plugin;
    

    function __construct(){
        $this -> plugin = plugin_basename(__FILE__);
        add_action('wp_enqueue_scripts', array($this, 'add_borrowing_widget_script'));
        add_shortcode('borrowing-widget', array($this, 'add_borrowing_widget_element'));
    }

    function add_borrowing_widget_script() {
        wp_register_script('borrowing-widget', plugins_url('borrowing-widget.js', __FILE__));
        wp_enqueue_script('borrowing-widget');
    }

    function add_borrowing_widget_element( $atts) {
        $a = shortcode_atts(array(
            'referral' => 'referral',
            'width' => 'width',
            'height' => 'height'
        ), $atts );
        return '<borrowing-widget width="' . esc_attr($a['width']) . '" referral="' . esc_attr($a['referral']) . '" height="' . esc_attr($a['height']) . '" ></<borrowing-widget>';
    }
    
    function activate() {
        //flush rewrite rules refreshing database everytime plugin is activated
        flush_rewrite_rules();
    }

    function deactivate(){
        //flush rewrite rules, refreshing database everytime plugin is deactivated
        flush_rewrite_rules();
    }
}
plugins_url('/assets/SMARTCREDIT-LOGO.jpg', __FILE__);

if ( class_exists( 'BorrowingWidgetPlugin' )){
    $BorrowingWidgetPlugin = new BorrowingWidgetPlugin();
}

//activation
register_activation_hook( __FILE__, array( $BorrowingWidgetPlugin, 'activate'));

//deactivation
register_deactivation_hook( __FILE__, array( $BorrowingWidgetPlugin, 'deactivate'));