<?php

/**
 * Plugin Configuration
 */
class WPM_SEO_ArticlesGenerator_Configuration
{
	public $settings;

	/**
	 * Initialize functions
	 */
	public function __construct()
	{
		// Init Functions
		add_action('init', [$this, 'save_settings']);
		add_action('init', [$this, 'load_settings']);

		// Include Styles and Scripts
		add_action('admin_enqueue_scripts', [$this, 'admin_scripts_and_styles'], 99);
		add_action('wp_enqueue_scripts', [$this, 'include_scripts_and_styles'], 99);

		// Admin menu
		add_action('admin_menu', [$this, 'register_menu']);
	}

	/**
	 * Save Core Settings to Option
	 */
	public function save_settings()
	{
		$WPM_Helpers = new WPM_SEO_ArticlesGenerator_Helpers();

		if(isset($_POST[WPM_SEO_ARTICLES_GENERATOR_ID]) && is_array($_POST[WPM_SEO_ARTICLES_GENERATOR_ID])) {
			$data = $WPM_Helpers->sanitize_array($_POST[WPM_SEO_ARTICLES_GENERATOR_ID]);
			update_option(WPM_SEO_ARTICLES_GENERATOR_ID, serialize($data));
		}
	}

	/**
	 * Load Saved Settings
	 */
	public function load_settings()
	{
		$this->settings = unserialize(get_option(WPM_SEO_ARTICLES_GENERATOR_ID));
	}

	/**
	 * Include Scripts And Styles on Admin Pages
	 */
	public function admin_scripts_and_styles()
	{
		// Admin Styles
		$register_admin_styles = [
			[
				'name' => 'font-awesome',
				'url' => 'libs/font-awesome/all.min.css'
			],
			[
				'name' => 'modal',
				'url' => 'libs/jquery-modal/jquery.modal.min.css'
			],
			[
				'name' => 'admin',
				'url' => 'assets/css/admin.css'
			] // Main Style
		];

		// Register styles
		foreach($register_admin_styles as $style) {
			wp_enqueue_style(WPM_SEO_ARTICLES_GENERATOR_ID."-{$style['name']}", WPM_SEO_ARTICLES_GENERATOR_PLUGIN_PATH."/{$style['url']}");
		}

		// Admin Scripts
		$register_admin_scripts = [
			[
				'name' => 'font-awesome',
				'url' => 'libs/font-awesome/all.min.js'
			],
			[
				'name' => 'modal',
				'url' => 'libs/jquery-modal/jquery.modal.min.js'
			],
			[
				'name' => 'admin',
				'url' => 'assets/js/admin.js'
			] // Main Script
		];

		// Register Scripts
		foreach($register_admin_scripts as $script) {
			wp_enqueue_script(WPM_SEO_ARTICLES_GENERATOR_ID."-{$script['name']}", WPM_SEO_ARTICLES_GENERATOR_PLUGIN_PATH."/{$script['url']}");
		}

		add_thickbox();

		// Add variables to Main Script
		wp_localize_script(WPM_SEO_ARTICLES_GENERATOR_ID.'-admin', 'settings', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce(WPM_SEO_ARTICLES_GENERATOR_ID)
		));
	}

	/**
	 * Include Scripts And Styles on FrontEnd
	 */
	public function include_scripts_and_styles()
	{
		// Frontend Styles
		$register_frontend_styles = [
			[
				'name' => 'font-awesome',
				'url' => 'libs/font-awesome/all.min.css'
			],
			[
				'name' => 'frontend',
				'url' => 'assets/css/frontend.css'
			] // Main Style
		];
		
		// Register styles
		foreach($register_frontend_styles as $style) {
			wp_enqueue_style(WPM_SEO_ARTICLES_GENERATOR_ID."-{$style['name']}", WPM_SEO_ARTICLES_GENERATOR_PLUGIN_PATH."/{$style['url']}", false, WPM_SEO_ARTICLES_GENERATOR_VERSION, 'all');
		}

		// Frontend Scripts
		$register_frontend_scripts = [
			[
				'name' => 'font-awesome',
				'url' => 'libs/font-awesome/all.min.js'
			],
			[
				'name' => 'frontend',
				'url' => 'assets/js/frontend.js'
			] // Main Script
		];

		// Register Scripts
		foreach($register_frontend_scripts as $script) {
			wp_enqueue_script(WPM_SEO_ARTICLES_GENERATOR_ID."-{$script['name']}", WPM_SEO_ARTICLES_GENERATOR_PLUGIN_PATH."/{$script['url']}", array('jquery'), WPM_SEO_ARTICLES_GENERATOR_VERSION, 'all');
		}

		// Add variables to Main Script
		wp_localize_script(WPM_SEO_ARTICLES_GENERATOR_ID.'-frontend', 'settings', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce(WPM_SEO_ARTICLES_GENERATOR_ID)
		));
	}

	/**
	 * Add Settings to Admin Menu
	 */
	public function register_menu()
	{
		global $wp_version, $wpdb;

		// Include classes
		$WPM_Database = new WPM_SEO_ArticlesGenerator_Database();

		// Select languages
		$generator_languages = ["English (US)","German", "Italian", "Portuguese", "Dutch", "French (under development)","Spanish (under development)","German (under development)"];

		// Get Saved Settings
		$queued_articles = $WPM_Database->get_articles_results();
		$settings = $this->settings;

		$args = array("hide_empty" => 0,
		              "type"      => "post",
		              "orderby"   => "name",
		              "order"     => "ASC" );
		$categories = get_categories($args);
		$top_level_exists = menu_page_url( 'wp-masters-plugins', false );

		// Generator Stats
		$still_queued = $WPM_Database->get_queued_count();
		$generated_hours = $WPM_Database->get_generated_24_hours_count();
		$generated_all = $WPM_Database->get_generated_all_count();

		// Register Admin Menu
		$admin_menu = [
			[
				'title' => 'SEO Articles Generator',
				'name' => 'Articles Generator',
				'slug_url' => 'settings',
				'template' => 'settings/settings.php'
			], // Main menu
		];

		// Add Admin Menu
		foreach($admin_menu as $item => $menu_item) {

			// Check if Top level menu is created
			if(!$top_level_exists) {
				add_menu_page('AI Content Writer', 'AI Content Writer', 'edit_others_posts', 'wp-masters-plugins', array(), WPM_SEO_ARTICLES_GENERATOR_PLUGIN_PATH.'/assets/img/logo-sm-white.png');
			}

			// Fix Slug menu if Top leven menu is not exists
			if(!$top_level_exists && $item == 0) {
				$slug_menu = 'wp-masters-plugins';
			} else {
				$slug_menu = "wp-masters-plugins_{$menu_item['slug_url']}";
			}

			// Create Submenu
			add_submenu_page('wp-masters-plugins', $menu_item['title'], $menu_item['name'], 'manage_options', $slug_menu, function () use ($generated_all, $generated_hours, $still_queued, $settings, $queued_articles, $categories, $wp_version, $wpdb, $menu_item, $generator_languages)
			{
				include(WPM_SEO_ARTICLES_GENERATOR_PLUGIN_DIR."/templates/admin/{$menu_item['template']}");
			});
		}
	}
}