<?php

/*
Plugin Name:       Profit Marketer
Plugin URI:        https://www.profitmarketer.com
Description:       A plugin to automatically update Profit Marketer plugins and themes
Version:           2.8.1.13
Author:            Profit Marketer
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Profit Marketer Plugin URI: https://github.com/DivaMedia/profit-marketer
Profit Marketer Branch:     develop
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Load main class
if ( ! class_exists( 'ProfitMarketer_Updater' ) ) {
	require_once 'includes/class-github-updater.php';
	require_once('includes/class-github-api.php');
	require_once('includes/class-bitbucket-api.php');
	require_once('includes/class-plugin-updater.php');
	require_once('includes/class-theme-updater.php');
}

// Instantiate class ProfitMarketer_Updater
new ProfitMarketer_Updater;

/**
 * Calls ProfitMarketer_Updater::init() in init hook so other remote upgrader apps like
 * InfiniteWP, ManageWP, MainWP, and iThemes Sync will load and use all
 * of ProfitMarketer_Updater's methods, especially renaming.
 */
add_action( 'init', array( 'ProfitMarketer_Updater', 'init' ) );
