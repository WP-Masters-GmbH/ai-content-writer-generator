<div class="wpm-header-table">
	<div class="wpm-header-table-icon">
		<i class="fa-solid fa-house-user"></i>
	</div>
	<div class="wpm-header-table-title">AI Content Writer & Assistant - Dashboard</div>
</div>
<div class="wpm-body-content">
	<div class="wpm-section-content">
		<div class="wpm-section-body">
			<div class="wpm-section-body-list">
				<div class="wpm-section-body-list-block no-margin-bottom">
                    <div class="wpm-section-title">LICENSE: <span class="<?php if(isset($settings['activation_key'])) {echo esc_attr('activated'); } ?>" id="wpm-key-status"><?php if(isset($settings['activation_key'])) {echo esc_html('Activated'); } else { echo esc_html('Deactivated'); } ?></span> <small>(<span id="wpm-points-counter"><?php if(isset($settings['points'])) {echo esc_html($settings['points']); } else { echo esc_html(0); } ?></span> Articles Left)</small></div>
					<label for="activation_key">License Key</label>
					<input type="text" id="activation_key" placeholder="FREE" value="<?php if(isset($settings['activation_key'])) { echo esc_attr($settings['activation_key']); } else { echo esc_attr('FREE'); } ?>">
                    <div class="wpm-section-footer">
                        <button class="wpm-button" id="wpm-activate-plugin">Activate Key</button>
                        <div class="wpm-ajax-error-message"></div>
                    </div>
                    <p>With "FREE" license code, one article per day can be generated. You might buy some additional packages as well.</p>
				</div>
                <div class="wpm-section-body-list-block two-width">
                    <div class="wpm-section-title">Quick Stats</div>
                    <table class="wpm-status-table two-column wpm-stats-table" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td>Articles Queued (in progress):</td>
                                <td><?php echo esc_html($still_queued); ?> posts</td>
                            </tr>
                            <tr>
                                <td>Articles Generated (24h):</td>
                                <td><?php echo esc_html($generated_hours); ?> posts</td>
                            </tr>
                            <tr>
                                <td>Articles Generated (all time):</td>
                                <td><?php echo esc_html($generated_all); ?> posts</td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="wpm-button wpm-trigger-click" data-trigger="wpm-trigger-generate-table">Go to Assistant page</button>
                </div>
			</div>
		</div>
	</div>
    <div class="wpm-section-content">
        <div class="wpm-section-title">Additional Packages</div>
        <div class="wpm-section-body">
            <p>In case you need more content ideas, you can buy additional articles packages on our website.</p>
            <div class="wpm-section-body-list">
                <div class="wpm-section-body-list-block">
                    <div class="wpm-section-body-list-block-gray">
                        <div class="wpm-section-body-list-block-gray-title">100 Articles</div>
                        <div class="wpm-section-body-list-block-gray-description"></div>
                        <div class="wpm-section-body-list-block-gray-button">
                            <a href="https://shop.wp-masters.com/cart/?add-to-cart=11&utm_source=plugin&utm_medium=additional_packages&utm_campaign=ai-content-writer-and-generator" target="_blank"><i class="fa-solid fa-shopping-basket"></i>  Buy license</a>
                        </div>
                    </div>
                </div>
                <div class="wpm-section-body-list-block">
                    <div class="wpm-section-body-list-block-gray">
                        <div class="wpm-section-body-list-block-gray-title">250 Articles</div>
                        <div class="wpm-section-body-list-block-gray-description"></div>
                        <div class="wpm-section-body-list-block-gray-button">
                            <a href="https://shop.wp-masters.com/cart/?add-to-cart=13&utm_source=plugin&utm_medium=additional_packages&utm_campaign=ai-content-writer-and-generator" target="_blank"><i class="fa-solid fa-shopping-basket"></i>  Buy license</a>
                        </div>
                    </div>
                </div>
                <div class="wpm-section-body-list-block">
                    <div class="wpm-section-body-list-block-gray">
                        <div class="wpm-section-body-list-block-gray-title">500 Articles</div>
                        <div class="wpm-section-body-list-block-gray-description"></div>
                        <div class="wpm-section-body-list-block-gray-button">
                            <a href="https://shop.wp-masters.com/cart/?add-to-cart=14&utm_source=plugin&utm_medium=additional_packages&utm_campaign=ai-content-writer-and-generator" target="_blank"><i class="fa-solid fa-shopping-basket"></i> Buy license</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wpm-section-content">
        <div class="wpm-section-title">Terms of Service & Important Information</div>
        <div class="wpm-section-body">
            <p>By clicking "Activate Key" button (including both free and paid licenses) you agree to our plugin <a href="https://shop.wp-masters.com/terms-of-service/?utm_source=plugin&utm_medium=terms_link&utm_campaign=ai-content-writer-and-generator" target="_blank">Terms of Service</a>. Terms of "FREE" license code usage can be changed without prior notice.
            We do not appreciate Gray/Black SEO or content bulk generation; please use this plugin responsibly. The purpose of this plugin is to assist you with getting content ideas for manual work as a next step. Usage of any non-legal or harmful topics can lead to block action without prior notice.</p>
            <p>We would love to hear your feedback and feature requests here: <a href="mailto:support@wp-masters.com?subject=Feedback / Feature Request for AI Content Writer Plugin [<?php echo esc_attr(home_url()); ?>] [<?php echo esc_attr($settings['activation_key']); ?>]">support@wp-masters.com</a>.</p>
        </div>
    </div>
</div>