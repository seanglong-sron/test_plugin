jQuery(document).ready( function($) {
	
	//sortable table
	jQuery('table.woo-slg-sortable tbody').sortable({
		items:'tr',
		cursor:'move',
		axis:'y',
		handle: 'td',
		scrollSensitivity:40,
		helper:function(e,ui){
			ui.children().each(function(){
				jQuery(this).width(jQuery(this).width());
			});
			ui.css('left', '0');
			return ui;
		},
		start:function(event,ui){
			ui.item.css('background-color','#f6f6f6');
		},
		stop:function(event,ui){
			ui.item.removeAttr('style');
		}
	});
	
	//Media Uploader
	$( document ).on( 'click', '.woo-slg-upload-file-button', function() {	
	
		var imgfield,showfield;
		imgfield = jQuery(this).prev('input').attr('id');
		showfield = jQuery(this).parents('td').find('.woo-vou-img-view');    			
		
		if(typeof wp == "undefined" || WooVouAdminSettings.new_media_ui != '1' ){// check for media uploader						
				
			tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	    	
			window.original_send_to_editor = window.send_to_editor;
			window.send_to_editor = function(html) {
				
				if(imgfield)  {
					
					var mediaurl = $('img',html).attr('src');
					$('#'+imgfield).val(mediaurl);
					showfield.html('<img src="'+mediaurl+'" />');
					tb_remove();
					imgfield = '';
					
				} else {
					
					window.original_send_to_editor(html);
					
				}
			};
	    	return false;
			  
		} else {
									
			var file_frame;
			//window.formfield = '';
			
			//new media uploader
			var button = jQuery(this);
	
			//window.formfield = jQuery(this).closest('.file-input-advanced');
		
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				//file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
				file_frame.open();
			  return;
			}
						
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				frame: 'post',
				state: 'insert',
				//title: button.data( 'uploader_title' ),
				/*button: {
					text: button.data( 'uploader_button_text' ),
				},*/
				multiple: false  // Set to true to allow multiple files to be selected
			});
	
			file_frame.on( 'menu:render:default', function(view) {
		        // Store our views in an object.
		        var views = {};
	
		        // Unset default menu items
		        view.unset('library-separator');
		        view.unset('gallery');
		        view.unset('featured-image');
		        view.unset('embed');
	
		        // Initialize the views in our view object.
		        view.set(views);
		    });
	
			// When an image is selected, run a callback.
			file_frame.on( 'insert', function() {
	
				// Get selected size from media uploader
				var selected_size = $('.attachment-display-settings .size').val();
				
				var selection = file_frame.state().get('selection');
				selection.each( function( attachment, index ) {
					attachment = attachment.toJSON();
					
					// Selected attachment url from media uploader
					var attachment_url = attachment.sizes[selected_size].url;
					
					if(index == 0){
						// place first attachment in field
						$('#'+imgfield).val(attachment_url);
						showfield.html('<img src="'+attachment_url+'" />');
						
					} else{
						$('#'+imgfield).val(attachment_url);
						showfield.html('<img src="'+attachment_url+'" />');
					}
				});
			});
	
			// Finally, open the modal
			file_frame.open();			
		}
		
	});
	
	// Hide and show settings fields on change selections
	$(document).on( 'change', '.woo_slg_social_btn_change', function() {
		
		var this_obj = $( this );
		
		if( this_obj.val() == 0 ) {
			
			$('.woo_slg_social_btn_image').parents('tr').show();
			$('.woo_slg_social_btn_text').parents('tr').hide();
		}
		
		if( this_obj.val() == 1 ) {
			
			$('.woo_slg_social_btn_text').parents('tr').show();
			$('.woo_slg_social_btn_image').parents('tr').hide();
		}
	});
	
	// Check if available settings available hide and show related settings
	if( $( '.woo_slg_social_btn_change' ).length > 0 ) {
		$( '.woo_slg_social_btn_change:checked' ).change();
	}

	woo_slg_toggle_admin_email();
	$('#woo_slg_email_notification_type').change(function(){

		woo_slg_toggle_admin_email();
	});

	$('#woo_slg_enable_notification').change(function(){
		woo_slg_toggle_admin_email();
	});
	
	function woo_slg_toggle_admin_email(){

		$('#woo_slg_send_new_account_email_to_admin').parents('li').show();
		if($('#woo_slg_email_notification_type').length){
			var email_type = $('#woo_slg_email_notification_type').val();
			if(email_type == 'woocommerce'){
				if($('#woo_slg_enable_notification').is(':checked')){
					$('#woo_slg_enable_notification').parents('li').next().show();
				} else {
					$('#woo_slg_enable_notification').parents('li').next().hide();
				}
			}
		} else {
			$('#woo_slg_enable_notification').parents('li').next().show();
		}
	}

	//Website Url Valid check
	$(document).on( 'click', '.woo-slg-save-btn', function() {

		var website_url = $('#woo_slg_redirect_url').val();

		if( website_url != '' && !woo_slg_is_url_valid( website_url ) ) {
			$('#general_tab').trigger( "click" );
			websitecontent = $('#woo_slg_redirect_url').addClass('woo-slg-not-rec').focus();
			$('#woo_slg_redirect_url').parent().find('.woo-slg-hide').show();

			$('html, body').animate({ scrollTop: websitecontent.offset().top - 50 }, 500);			
			return false;
		}
	});


	//  When user clicks on tab, this code will be executed
    $( document ).on( "click", ".nav-tab-wrapper a", function() {

        //  First remove class "active" from currently active tab
        $(".nav-tab-wrapper a").removeClass('nav-tab-active');
 
        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("nav-tab-active");
 
        //  Hide all tab content
        $(".woo-slg-tab-content").hide();
 
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).attr("href");
 
        //  Show the selected tab content
        $(selected_tab).show();
        
        var selected = selected_tab.split('-');
        $(".woo-slg-tab-content").removeClass('woo-slg-selected-tab');
 		$( '#woo_slg_selected_tab' ).val( selected[3] );
 
        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });

    // Set the select2 for setting page
    $(".wslg-select").select2();
    
    //call on click reset options button from settings page
	$( document ).on( "click", "#woo_slg_reset_settings", function() {
		
		var ans;
		ans = confirm( WooVouAdminSettings.reset_settings_warning );

		if(ans){
			return true;
		} else {
			return false;
		}
	});

	$(document).on('change', '#woo_slg_allow_peepso_avatar', function(){
		if( $(this).is(':checked') ){
			$('#peepso_avatar_each_time').show();
		} else{
			$('#peepso_avatar_each_time').hide();
		}
	});

	$(document).on('change', '#woo_slg_allow_peepso_cover', function(){
		if( $(this).is(':checked') ){
			$('#peepso_cover_each_time').show();
		} else{
			$('#peepso_cover_each_time').hide();
		}
	});
    
}); // End of document ready function

// function to validate url
function woo_slg_is_url_valid( url ) {
    return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}