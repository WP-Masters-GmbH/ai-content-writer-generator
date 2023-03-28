jQuery(document).ready(function($) {
    jQuery("body").on("click","#wpm_seo_articles_generator .wpm-menu-list li.wpm-change-table",function(){
        var table = jQuery(this).data('table');

        jQuery('#wpm_seo_articles_generator .wpm-menu-list li.wpm-change-table').removeClass('active');
        jQuery(this).addClass('active');

        jQuery('#wpm_seo_articles_generator .wpm-select-table').hide();
        jQuery('#'+table).show();
    });

    jQuery("body").on("click",".wpm-click-remove",function(){
        jQuery(this).remove();
    });

    jQuery("body").on("click","#wpm_seo_articles_generator .wpm-trigger-click",function(){
        var whereClick = jQuery(this).data('trigger');
        jQuery('#'+whereClick).trigger('click');
    });

    jQuery("body").on("click",".modal-view-content",function() {
        var modal_title = jQuery(this).data('title');
        var modal_content = jQuery(this).data('article-content');
        jQuery('#modal-content .modal-title').html(modal_title);
        jQuery('#wpm-content-here').val(modal_content);
    });



    jQuery("body").on("click","#wpm_seo_articles_generator #wpm-activate-plugin",function() {

        var button = jQuery(this);
        button.text('Loading...');
        button.closest('.wpm-section-footer').find('.wpm-ajax-error-message').html('');

        var activation_key = jQuery('#activation_key').val();

        jQuery.ajax({
            url: settings.ajaxurl,
            data: {
                'action': 'activate_plugin',
                'activation_key': activation_key,
                'nonce': settings.nonce
            },
            type:'POST',
            dataType: 'json',
            success:function(response) {
                if(response.status === 'true') {
                    jQuery('#wpm_seo_articles_generator #wpm-key-status').addClass('activated').html('Activated');
                    jQuery('#wpm_seo_articles_generator #wpm-points-counter').html(response.user.points);
                    button.closest('.wpm-section-footer').find('.wpm-ajax-error-message').addClass('wpm-success').html(response.message);
                } else {
                    button.closest('.wpm-section-footer').find('.wpm-ajax-error-message').removeClass('wpm-success').html(response.message);
                }
                button.text('Activate Key');
            }
        });
    });

    jQuery("body").on("click","#wpm_seo_articles_generator #wpm-send-articles-to-queue",function() {

        var button = jQuery(this);
        button.text('Loading...');
        button.closest('.wpm-section-footer').find('.wpm-ajax-error-message').html('');

        var language = jQuery('#language-generator').val();
        var category = jQuery('#category-post').val();
        var articles_list = jQuery('#articles_list').val();
        var activation_key = jQuery('#activation_key').val();
        var publish_status = 'draft';

        jQuery.ajax({
            url: settings.ajaxurl,
            data: {
                'action': 'send_articles_to_queue',
                'language': language,
                'category': category,
                'articles_list': articles_list,
                'activation_key': activation_key,
                'publish_status': publish_status,
                'nonce': settings.nonce
            },
            type:'POST',
            dataType: 'json',
            cache: false,
            success:function(response) {
                if(response.status === 'true') {
                    jQuery('#articles_list').val('');
                    jQuery('#wpm_seo_articles_generator #queued_articles_table').html(response.table);
                    jQuery('#wpm_seo_articles_generator #wpm-points-counter').html(response.user.points);
                    button.closest('.wpm-section-footer').find('.wpm-ajax-error-message').addClass('wpm-success').html(response.message);
                } else {
                    button.closest('.wpm-section-footer').find('.wpm-ajax-error-message').removeClass('wpm-success').html(response.message);
                }
                button.text('Send to Generator');
            }
        });
    });

    jQuery("body").on("click","#wpm_seo_articles_generator #wpm-refresh-all-posts",function() {

        var button = jQuery(this);
        button.html('<a href="javascript:void(0)" id="wpm-refresh-all-posts"><i class="fa-solid fa-refresh"></i> Loading...</a>');
        button.closest('.wpm-section-footer').find('.wpm-ajax-error-message').html('');

        var activation_key = jQuery('#activation_key').val();

        jQuery.ajax({
            url: settings.ajaxurl,
            data: {
                'action': 'get_refreshed_table',
                'activation_key': activation_key,
                'nonce': settings.nonce
            },
            type:'GET',
            dataType: 'json',
            cache: false,
            success:function(response) {
                if(response.status === 'true') {
                    jQuery('#wpm_seo_articles_generator #queued_articles_table').html(response.table);
                    jQuery('#wpm_seo_articles_generator #wpm-points-counter').html(response.user.points);
                    button.closest('.wpm-section-footer').find('.wpm-ajax-error-message').addClass('wpm-success').html(response.message);
                } else {
                    button.closest('.wpm-section-footer').find('.wpm-ajax-error-message').removeClass('wpm-success').html(response.message);
                }
                button.html('<a href="javascript:void(0)" id="wpm-refresh-all-posts"><i class="fa-solid fa-refresh"></i> Refresh</a>');
            }
        });
    });



    jQuery('#wpm_seo_articles_generator #wpm-import-all-posts').on('click', function () {

        var counter = 0;
        var all_count = 0;
        var publish = jQuery('#wpm_seo_articles_generator #publish-status').val();
        var button = jQuery(this);
        button.text('Loading...');
        button.closest('.wpm-section-footer').find('.wpm-ajax-error-message').html('');

        return import_all_posts();

        jQuery.ajax({
            url: settings.ajaxurl,
            data: {
                'action': 'import_all_posts',
                'publish_status': publish,
                'nonce': settings.nonce
            },
            type:'POST',
            dataType: 'json',
            success:function(response) {
                if(response.status === 'finished') {
                    jQuery('#wpm_seo_articles_generator #wpm-import-all-posts').attr("disabled", false);
                    jQuery('#wpm_seo_articles_generator #import-all-posts').hide();
                    button.text('Import All Posts');
                    button.closest('.wpm-section-footer').find('.wpm-ajax-error-message').addClass('wpm-success').html(response.message);
                    jQuery('#queued_articles_table').html(response.html);
                } else if(response.status === 'error') {
                    button.closest('.wpm-section-footer').find('.wpm-ajax-error-message').removeClass('wpm-success').html(response.message);
                    jQuery('#wpm_seo_articles_generator #wpm-import-all-posts').attr("disabled", false);
                } else {
                    if(counter < all_count) {
                        counter++;
                        if(all_count === 0) {
                            all_count = response.all_count;
                        }
                        jQuery('#wpm_seo_articles_generator #import-all-posts').show();
                        jQuery('#wpm_seo_articles_generator #import-all-posts span').html(counter + " / " + all_count);
                        jQuery('#import-all-posts-progress').attr('max', all_count).attr('value', counter);
                        import_all_posts(counter, all_count, publish);
                    }
                }
            }
        });
    });

    function import_all_posts()
    {
        var inputs = jQuery('a.wpm-click-remove:contains("Import Post")');

        jQuery('#wpm_seo_articles_generator #import-all-posts').show();
        jQuery('#wpm_seo_articles_generator #import-all-posts span').html(0 + " / " + inputs.length);
        jQuery('#import-all-posts-progress').attr('max', inputs.length)

        for (let i=0; i<inputs.length;i++)
        {
            setTimeout(function(){
                jQuery.get(jQuery(inputs[i]).attr('href')+'&'+jQuery('#publish-status').val());
                jQuery('#import-all-posts-progress').attr('value', i+1);
                jQuery('#wpm_seo_articles_generator #import-all-posts span').html(i+1 + " / " + inputs.length);

                if( (i+1) == inputs.length ){
                    setTimeout(window.location.reload(), 1000);
                }
            }, i*1000);
        }

        return ;
        jQuery.ajax({
            url: settings.ajaxurl,
            data: {
                'action': 'import_all_posts',
                'publish_status': publish,
                'nonce': settings.nonce
            },
            type:'POST',
            dataType: 'json',
            success:function(response) {
                if(response.status === 'finished') {
                    jQuery('#wpm_seo_articles_generator #wpm-import-all-posts').attr("disabled", false);
                    jQuery('#wpm_seo_articles_generator #import-all-posts').hide();
                    jQuery('#wpm_seo_articles_generator #wpm-import-all-posts').text('Import All Posts');
                    jQuery('#wpm_seo_articles_generator #wpm-import-all-posts').closest('.wpm-section-footer').find('.wpm-ajax-error-message').addClass('wpm-success').html(response.message);
                    jQuery('#queued_articles_table').html(response.html);
                } else if(response.status === 'error') {
                    jQuery('#wpm_seo_articles_generator #wpm-import-all-posts').closest('.wpm-section-footer').find('.wpm-ajax-error-message').removeClass('wpm-success').html(response.message);
                    jQuery('#wpm_seo_articles_generator #wpm-import-all-posts').attr("disabled", false);
                } else {
                    if(counter < all_count) {
                        counter++;
                        if(all_count === 0) {
                            all_count = response.all_count;
                        }
                        jQuery('#wpm_seo_articles_generator #import-all-posts').show();
                        jQuery('#wpm_seo_articles_generator #import-all-posts span').html(counter + " / " + all_count);
                        jQuery('#import-all-posts-progress').attr('max', all_count).attr('value', counter);
                        import_all_posts(counter, all_count, publish);
                    }
                }
            }
        });
    }

});