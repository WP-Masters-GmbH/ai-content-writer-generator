<div class="wpm-header-table">
	<div class="wpm-header-table-icon">
		<i class="fas fa-edit"></i>
	</div>
	<div class="wpm-header-table-title">AI Content Writer & Assistant - Add, View, Import Posts</div>
</div>
<div class="wpm-body-content">
	<div class="wpm-section-content">
		<div class="wpm-section-title">Add article titles to get AI Assistant Suggestions</div>
		<div class="wpm-section-body">
			<div class="wpm-section-body-list">
				<div class="wpm-section-body-list-block">
					<label for="language-generator">Language</label>
                    <select id="language-generator">
	                    <?php foreach($generator_languages as $item => $language) { ?>
                            <option value="<?php echo esc_attr($language); ?>" <?php if($item > 4) { echo esc_attr('disabled'); } ?>><?php echo esc_html($language); ?></option>
	                    <?php } ?>
                    </select>
				</div>
                <div class="wpm-section-body-list-block">
                    <label for="category-post">Posts Category</label>
                    <select id="category-post">
						<?php foreach($categories as $category) { ?>
                            <option value="<?php echo esc_attr($category->term_id); ?>"><?php echo esc_html($category->name); ?></option>
						<?php } ?>
                    </select>
                </div>
                <div class="wpm-section-body-list-block">
                </div>
                <div class="wpm-section-body-list-block full-width">
                    <label for="articles_list">Posts Titles (one per line) / Posts titles must be minimum 3 words length. Non-legal content titles will be ignored</label>
                    <textarea id="articles_list" rows="8"></textarea>
                </div>
			</div>
		</div>
		<div class="wpm-section-footer">
			<button class="wpm-button" id="wpm-send-articles-to-queue">Send to Assistant</button>
            <div class="wpm-ajax-error-message"></div>
		</div>
	</div>
	<div class="wpm-section-content">
        <div class="wpm-section-title">
            All Content Ideas (In Progress / Ready / Imported) &nbsp; &nbsp; &nbsp; &nbsp; <span><a href="javascript:void(0)" id="wpm-refresh-all-posts"><i class="fa-solid fa-refresh"></i> Refresh</a></span>
        </div>

        <p>Please note that AI writing takes time; let some time for topics to be processed.</p>

		<table class="wpm-status-table no-margin five-column" cellpadding="0" cellspacing="0">
			<thead>
			<tr>
				<th>Title</th>
                <th>Date Queued</th>
                <th>Category</th>
                <th>Status</th>
                <th>Date Posted</th>
			</tr>
			</thead>
		</table>
        <div class="wpm-table-scroller" id="queued_articles_table">
            <?php include(WPM_SEO_ARTICLES_GENERATOR_PLUGIN_DIR."/templates/ajax/queued_articles_table.php"); ?>
        </div>
        <?php if ( isset( $settings['activation_key'] ) && $settings['activation_key'] != 'FREE' ) { ?>
            <div class="wpm-section-footer" id="footer-import-posts">
                <button class="wpm-button" id="wpm-import-all-posts">Import All Posts</button>
                <div class="wpm-publication-status">
                    <select id="publish-status">
                        <option value="publish" selected>Publish Immediately</option>
                        <option value="draft">Keep in Draft status</option>
                    </select>
                </div>
                <div class="progress-info" id="import-all-posts" style="display: none;">
                    <div class="text-progress">Checked: <span></span></div>
                    <progress id="import-all-posts-progress" max="0" value="0"></progress>
                </div>
                <div class="wpm-ajax-error-message"></div>
            </div>
        <?php } ?>
	</div>
</div>

<div id="modal-content" class="modal">
    <div class="modal-title">Post Content</div>
    <div class="modal-content">
        <textarea id="wpm-content-here" cols="30" rows="10"></textarea>
    </div>
</div>