<?php

/**
 * Database Model
 */
class WPM_SEO_ArticlesGenerator_Database
{
	/**
	 * Get all generated posts status
	 */
	public function get_articles_results()
	{
		global $wpdb;

		// TODO: remove
		//$wpdb->query( "delete from {$wpdb->prefix}wpm_seo_articles_generator" );
		return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wpm_seo_articles_generator ORDER BY id DESC" );
	}

	/**
	 * Get new not imported articles
	 */
	public function get_not_imported_articles()
	{
		global $wpdb;

		return $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wpm_seo_articles_generator WHERE post_id='0'" );
	}

	/**
	 * Get Article by ID
	 */
	public function get_article_by_id($id)
	{
		global $wpdb;

		return $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wpm_seo_articles_generator WHERE id='{$id}'" );
	}

	/**
	 * Get count articles in queued generation
	 */
	public function get_queued_count()
	{
		global $wpdb;

		return $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}wpm_seo_articles_generator WHERE post_id='0'" );
	}

	/**
	 * Get count generated posts by 24 hours
	 */
	public function get_generated_24_hours_count()
	{
		global $wpdb;

		return $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}wpm_seo_articles_generator WHERE post_id!='0' AND HOUR(TIMEDIFF(NOW(), date_posted)) <= 24" );
	}

	/**
	 * Get count generated posts by all time
	 */
	public function get_generated_all_count()
	{
		global $wpdb;

		return $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}wpm_seo_articles_generator WHERE post_id!='0'" );
	}

	/**
	 * Insert items into table
	 */
	public function insert_article($article_name, $category)
	{
		global $wpdb;

		if( trim($article_name) == '' ){
			return null;
		}

		return $wpdb->insert("{$wpdb->prefix}wpm_seo_articles_generator", [
			'post_id' => 0,
			'category' => $category,
			'article_name' => stripslashes($article_name)
		]);
	}

	/**
	 * Update article by Title
	 */
	public function update_article($article_name, $article_content, $post_id, $date_posted, $errors = '')
	{
		global $wpdb;

		return $wpdb->update("{$wpdb->prefix}wpm_seo_articles_generator", [
			'post_id' => $post_id,
			'date_posted' => $date_posted,
			'article_content' => $article_content,
			'errors' => $errors
		], ['article_name' => stripslashes($article_name)]);
	}
}