<table class="wpm-status-table five-column" cellpadding="0" cellspacing="0">
    <tbody>
	<?php
	$settings = unserialize(get_option(WPM_SEO_ARTICLES_GENERATOR_ID));

	// TODO: move to constant
	$domain_salt = get_option( 'wpm_ai_domain_salt' );

    if(!empty($queued_articles)) {
		foreach($queued_articles as $article) {
			$category = get_the_category_by_ID($article->category);

			if($article->post_id == 0 && isset($article->article_content)) {
				$tmp_body = 0;
				$tmp_url = 'https://ai.wp-masters.com?rand='.rand().time().'&status='.base64_encode($article->article_name).'&domain_salt='.$domain_salt;

				$tmp_response = wp_remote_get( $tmp_url );
				if ( is_array( $tmp_response ) && ! is_wp_error( $tmp_response ) ) {
					$tmp_headers = $tmp_response['headers']; // array of http header lines
					$tmp_body    = $tmp_response['body']; // use the content
				} else {
				    var_dump($tmp_response); die;
                }
			} else {
				$tmp_body = 1;
			}

			$not_published_yet = ($tmp_body == '1' && $article->post_id == 0);
			$is_published = (isset($article->post_id) && $article->post_id > 0);

			?>
            <tr>
                <td><?php echo esc_html( $article->article_name ); ?></td>
                <td><?php
					if ( get_option( 'date_format' ) ) {
						echo esc_html( date( get_option( 'date_format' ), strtotime( $article->timestamp ) ) );
					} else {
						echo esc_html( date( 'Y-m-d H:i:s', strtotime( $article->timestamp ) ) );
					}
					?></td>
                <td><?php if ( is_string( $category ) ) {
						echo esc_html( $category );
					} else {
						echo esc_html( 'Not found' );
					} ?></td>
                <td class="<?php if ( $not_published_yet ) {
					echo esc_attr( 'double-btns' );
				} ?>"><?php if ( $tmp_body == '1' && isset( $article->article_content ) && $article->article_content != '' ) { ?>
                        <a class="wpm-button-black" href="<?php if ( $article->post_id == 0 ) { ?>javascript:tb_show('<?php echo esc_js( $article->article_name ); ?>', 'https://ai.wp-masters.com?domain_salt=<?php echo esc_attr( $domain_salt ); ?>&view_article=<?php echo esc_attr( base64_encode( $article->article_name ) ); ?>&activation_key=<?php if ( isset( $settings['activation_key'] ) ) {
						echo esc_attr( $settings['activation_key'] );
					} else {
						echo esc_attr( 'FREE' );
					} ?>');<?php } else {
						echo esc_attr( get_permalink( $article->post_id ) );
					} ?>"><?php if ( $is_published ) { ?>View Post<?php } else { ?>Preview Content<?php } ?></a>
						<?php if ( $not_published_yet ) { ?>
                            <a class="wpm-button-black wpm-click-remove" href="<?php echo esc_attr( get_home_url() . "?import_ai_post={$article->id}" ); ?>" target="_blank">Import Post</a>
						<?php } ?><?php } elseif ( isset( $article->errors ) && $article->errors != '' ) { ?>Error Occured<?php } else {
						echo esc_html( "In Progress" );
					} ?></td>
                <td><?php if ( $article->date_posted != '' && strtotime( $article->date_posted ) > 0 ) {
						if ( get_option( 'date_format' ) ) {
							echo esc_html( date( get_option( 'date_format' ), strtotime( $article->date_posted ) ) );
						} else {
							echo esc_html( date( 'Y-m-d H:i:s', strtotime( $article->date_posted ) ) );
						}
					} else {
						echo esc_html( 'Not posted yet' );
					} ?></td>
            </tr>
		<?php }} else { ?>
        <tr>
            <td>No articles sent to Assistant yet</td>
        </tr>
	<?php } ?>
    </tbody>
</table>