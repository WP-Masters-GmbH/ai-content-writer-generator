<?php
/*
 * Plugin Name: AI Content Writer & Generator
 * Plugin URI: https://wp-masters.com/products/ai-content-writer
 * Description: Generate and import content, get even more content ideas using the power of AI.
 * Author: WP-Masters
 * Text Domain: wpm-seo-articles-generator
 * Author URI: https://wp-masters.com/
 * Version: 1.0.1
 *
 * @author      WP-Masters
 * @version     v.1.0.1 (27/02/23)
 * @copyright   Copyright (c) 2023
*/

// Models
require_once('models/Helpers.php');
require_once('models/Database.php');
require_once('models/Settings.php');
require_once('models/MainController.php');

// Constants
define('WPM_SEO_ARTICLES_GENERATOR_ID', 'wpm_seo_articles_generator');
define('WPM_SEO_ARTICLES_GENERATOR_PLUGIN_PATH', plugins_url('', __FILE__));
define('WPM_SEO_ARTICLES_GENERATOR_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WPM_SEO_ARTICLES_GENERATOR_VERSION', '1.0.7');

// Include Classes
$WPM_Database = new WPM_SEO_ArticlesGenerator_Database();
$WPM_Helpers = new WPM_SEO_ArticlesGenerator_Helpers();
$WPM_Configuration = new WPM_SEO_ArticlesGenerator_Configuration();

// Main Functions Classes
$WPM_MainController = new WPM_SEO_ArticlesGenerator_MainController;

// Create DB Tables
function wpm_seo_articles_generator_create_plugin_tables()
{
	global $wpdb;

	$charset_collate = $wpdb->get_charset_collate();
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	require_once( ABSPATH . 'wp-admin/install-helper.php' );

	// Create table
	$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}wpm_seo_articles_generator (
         id INTEGER NOT NULL AUTO_INCREMENT,
         post_id INTEGER(10) NOT NULL,
         category INTEGER(10) NOT NULL,
         article_name VARCHAR(100) NOT NULL,
         article_content TEXT NOT NULL,
         errors TEXT NOT NULL,
         date_posted DATETIME,
         timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
         PRIMARY KEY (id)
        ) $charset_collate;";

	$wpdb->query( $sql );
}
register_activation_hook( __FILE__, 'wpm_seo_articles_generator_create_plugin_tables');