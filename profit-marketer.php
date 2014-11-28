<?php

/*
Plugin Name:       Profit Marketer
Plugin URI:        https://www.profitmarketer.com
Description:       A plugin to automatically update Profit Marketer plugins and themes
Version:           2.8.1.18
Author:            Profit Marketer
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Profit Marketer Plugin URI: https://github.com/DivaMedia/profit-marketer
Profit Marketer Branch:     profitmarketer
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Load main class
if ( ! class_exists( 'ProfitMarketer_Updater' ) ) {
	require_once 'includes/class-github-updater.php';
	require_once('includes/class-github-api.php');
	require_once('includes/class-plugin-updater.php');
	require_once('includes/class-theme-updater.php');
	
	// Add a menu so we know PM is installed
	function profitmarketer_add_menu() {
		add_menu_page( 'Profit Marketer', 'Profit Marketer', 'manage_options', '#', '', 'dashicons-star-filled' );
	}
	add_action('admin_menu', 'profitmarketer_add_menu', 10);

	// Add our news feed to the WP Admin dashboard
	add_action('wp_dashboard_setup', 'profitmarketer_dashboard_widget');  
	function profitmarketer_dashboard_widget() {  
	    global $wp_meta_boxes;   
		add_meta_box('profitmarketer_dashboard_custom_feed', 'The Latest from Profit Marketer', 'profitmarketer_dashboard_custom_feed_output', 'dashboard', 'side', 'high'); 
	}  
	function profitmarketer_dashboard_custom_feed_output() {  
	     echo '<div class="rss-widget">';  
	     wp_widget_rss_output(array(  
	          'url' => 'http://www.profitmarketer.com/feed',  //put your feed URL here  
	          'title' => 'The Latest from Profit Marketer',  
	          'items' => 5, //how many posts to show  
	          'show_summary' => 1,  
	          'show_author' => 0,  
	          'show_date' => 0  
	     ));  
	     echo "</div>";  
	} 
}

// Instantiate class ProfitMarketer_Updater
new ProfitMarketer_Updater;

/**
 * Calls ProfitMarketer_Updater::init() in init hook so other remote upgrader apps like
 * InfiniteWP, ManageWP, MainWP, and iThemes Sync will load and use all
 * of ProfitMarketer_Updater's methods, especially renaming.
 */
add_action( 'init', array( 'ProfitMarketer_Updater', 'init' ) );
