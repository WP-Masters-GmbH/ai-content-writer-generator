<div id="<?php echo esc_attr(WPM_SEO_ARTICLES_GENERATOR_ID); ?>">

    <!-- Left Sidebar -->
    <div class="wpm-left-sidebar">
        <div class="wpm-logo">
            <a href="https://wp-masters.com/" target="_blank">
                <img src="<?php echo esc_attr(WPM_SEO_ARTICLES_GENERATOR_PLUGIN_PATH.'/assets/img/logo.png') ?>" class="wpm-big-logo" alt="">
                <img src="<?php echo esc_attr(WPM_SEO_ARTICLES_GENERATOR_PLUGIN_PATH.'/assets/img/logo-sm.png') ?>" class="wpm-small-logo" alt="">
            </a>
        </div>
        <ul class="wpm-menu-list">
            <?php include( 'tabs/menu.php' ); ?>
        </ul>
    </div>

    <!-- Center Content -->
    <div class="wpm-center-content">
        <div class="wpm-select-table" id="dashboard-table">
	        <?php include( 'tabs/dashboard-table.php' ); ?>
        </div>
        <div class="wpm-select-table" id="generate-content-table" style="display: none">
		    <?php include( 'tabs/generate-content-table.php' ); ?>
        </div>
        <div class="wpm-select-table" id="system-info-table" style="display: none">
            <?php include( 'tabs/system-info-table.php' ); ?>
        </div>
    </div>

    <!-- Right Sidebar -->
    <div class="wpm-right-sidebar">
        <div class="wpm-need-help-block">
            <a href="https://www.youtube.com/watch?v=qv1EjqNI65k" target="_blank" class="wpm-our-company-block-button"><i class="fa-solid fa-play-circle"></i> Quick Video Tutorial</a>
        </div>
        <div class="wpm-need-help-block">
            &nbsp;
        </div>
        <div class="wpm-need-help-block">
            Need Support?
        </div>
        <div class="wpm-our-company-block">
            <div class="wpm-our-company-block-icon"><i class="fa-solid fa-comment"></i></div>
            <div class="wpm-our-company-block-title">Contact us</div>
            <div class="wpm-our-company-block-description">Please remember to include your website URL and license code in email</div>
            <a href="mailto:support@wp-masters.com?subject=Need support for AI Content Writer Plugin [<?php echo esc_attr(home_url()); ?>] [<?php echo esc_attr($settings['activation_key']); ?>]" class="wpm-our-company-block-button" target="_blank">support@wp-masters.com</a>
        </div>
        <div class="wpm-need-help-block">
            Need a Custom Solution?
        </div>
        <div class="wpm-our-company-block">
            <div class="wpm-our-company-block-icon"><i class="fa-solid fa-people-line"></i></div>
            <div class="wpm-our-company-block-title">Get a Quote</div>
            <div class="wpm-our-company-block-description">Our company provide WP services for years, including frontend, backend, custom API integrations, support and much more</div>
            <a href="https://wp-masters.com/?utm_source=plugin&utm_medium=banner&utm_campaign=ai-content-writer-and-generator" class="wpm-our-company-block-button" target="_blank">Official Website</a>
        </div>
    </div>

</div>