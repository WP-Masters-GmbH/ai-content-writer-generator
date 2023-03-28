<?php

/**
 * Posts Model
 */
class WPM_SEO_ArticlesGenerator_Helpers
{
	/**
	 * Sanitize Array Data
	 */
	public function sanitize_array($data)
	{
		$filtered = $data;
		foreach($data as $key => $value) {
			if(is_array($value)) {
				$filtered[$key] = $this->sanitize_array($value);
			} else {
				$filtered[$key] = sanitize_text_field($value);
			}
		}

		return $filtered;
	}
}