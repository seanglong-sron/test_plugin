<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Class
 * 
 * Handles generic Admin functionality and AJAX requests.
 * 
 * @package WooCommerce - Social Login
 * @since 1.0.0
 */
class WOO_Slg_Admin {
	
	var $model, $scripts, $render;
	
	public function __construct() {
		
		global $woo_slg_model, $woo_slg_scripts,$woo_slg_render;
		
		$this->model = $woo_slg_model;
		$this->scripts = $woo_slg_scripts;
		$this->render = $woo_slg_render;
	}
	
	/**
	 * Register All need admin menu page
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.0.0
	 */
	public function woo_slg_admin_menu_pages() {

		add_menu_page( __( 'WooCommerce Social Login', 'wooslg' ), __( 'WooCommerce Social Login', 'wooslg' ), 'manage_options', 'woo-social-login', array( $this, 'woo_slg_social_login' ), WOO_SLG_IMG_URL . '/wpweb-menu-icon.png' );
		 
		$woo_slg_social_login = add_submenu_page( 'woo-social-login' , __( 'WooCommerce Social Login - Statistics', 'wooslg' ), __( 'Statistics', 'wooslg' ), 'manage_options', 'woo-social-login', array( $this, 'woo_slg_social_login' ) ); 

		// settings page
		$settings_page = add_submenu_page( 'woo-social-login', __( 'WooCommerce Social Login - Settings', 'wooslg' ), __( 'Settings', 'wooslg' ), 'manage_options', 'woo-social-settings', array( $this, 'woo_slg_settings_page' ) ); // add setting page

        add_action("admin_head-$settings_page", array( $this->scripts, 'woo_slg_settings_page_load_scripts'));
		
	}
	
	/**
	 * Settings Page
	 *
	 * The code for the plugins main settings page
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.6.4
	 */
	public function woo_slg_settings_page() {
		
		include_once( WOO_SLG_ADMIN . '/forms/woo-slg-plugin-settings.php' );
	}
	
	/**
	 * Save Settings Page
	 *
	 * Opdate the option of plugin settings
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.6.4
	 */
	public function woo_slg_settings_save() {

		global $woo_slg_options, $woo_slg_model;

		if( isset($_POST['woo-slg-set-submit']) && !empty($_POST['woo-slg-set-submit']) ){

			// Extract the post array data
			extract($_POST);

			$woo_slg_email_notification_type			= !empty( $woo_slg_email_notification_type ) ? $woo_slg_email_notification_type : 'wordpress';
			// Checkboxs value check
			$woo_slg_enable_notification 				= ( isset($_POST['woo_slg_enable_notification']) ) ? 'yes' : 'no';
			$woo_slg_send_new_account_email_to_admin 	= ( isset($_POST['woo_slg_send_new_account_email_to_admin']) ) ? 'yes' : 'no';
			$woo_slg_enable_login_page 					= ( isset($_POST['woo_slg_enable_login_page']) ) ? 'yes' : 'no';
			$woo_slg_enable_woo_register_page 			= ( isset($_POST['woo_slg_enable_woo_register_page']) ) ? 'yes' : 'no';
			$woo_slg_enable_on_checkout_page 			= ( isset($_POST['woo_slg_enable_on_checkout_page']) ) ? 'yes' : 'no';
			$woo_slg_enable_wp_login_page 				= ( isset($_POST['woo_slg_enable_wp_login_page']) ) ? 'yes' : 'no';
			$woo_slg_enable_wp_register_page 			= ( isset($_POST['woo_slg_enable_wp_register_page']) ) ? 'yes' : 'no';
			$woo_slg_enable_buddypress_login_page 		= ( isset($_POST['woo_slg_enable_buddypress_login_page']) ) ? 'yes' : 'no';
			$woo_slg_enable_buddypress_register_page 	= ( isset($_POST['woo_slg_enable_buddypress_register_page']) ) ? 'yes' : 'no';
			$woo_slg_enable_bbpress_login_page 			= ( isset($_POST['woo_slg_enable_bbpress_login_page']) ) ? 'yes' : 'no';
			$woo_slg_enable_bbpress_register_page 		= ( isset($_POST['woo_slg_enable_bbpress_register_page']) ) ? 'yes' : 'no';
			$woo_slg_enable_peepso_login_page 			= ( isset($_POST['woo_slg_enable_peepso_login_page']) ) ? 'yes' : 'no';
			$woo_slg_enable_peepso_register_page 		= ( isset($_POST['woo_slg_enable_peepso_register_page']) ) ? 'yes' : 'no';
			$woo_slg_allow_peepso_avatar 				= ( isset($_POST['woo_slg_allow_peepso_avatar']) ) ? 'yes' : 'no';
			$woo_slg_allow_peepso_cover 				= ( isset($_POST['woo_slg_allow_peepso_cover']) ) ? 'yes' : 'no';
			$woo_slg_display_link_thank_you 			= ( isset($_POST['woo_slg_display_link_thank_you']) ) ? 'yes' : 'no';
			$woo_slg_display_link_acc_detail 			= ( isset($_POST['woo_slg_display_link_acc_detail']) ) ? 'yes' : 'no';
			$woo_slg_enable_expand_collapse				= !empty( $woo_slg_enable_expand_collapse ) ? $woo_slg_enable_expand_collapse : '';

			// Facebook tab checkboxs
			$woo_slg_enable_facebook 					= ( isset($_POST['woo_slg_enable_facebook']) ) ? 'yes' : 'no';
			$woo_slg_enable_fb_avatar 					= ( isset($_POST['woo_slg_enable_fb_avatar']) ) ? 'yes' : 'no';
			// Google+ tab checkboxs
			$woo_slg_enable_googleplus 					= ( isset($_POST['woo_slg_enable_googleplus']) ) ? 'yes' : 'no';
			$woo_slg_enable_gp_avatar 					= ( isset($_POST['woo_slg_enable_gp_avatar']) ) ? 'yes' : 'no';
			// LinkedIn tab checkboxs
			$woo_slg_enable_linkedin 					= ( isset($_POST['woo_slg_enable_linkedin']) ) ? 'yes' : 'no';
			$woo_slg_enable_li_avatar 					= ( isset($_POST['woo_slg_enable_li_avatar']) ) ? 'yes' : 'no';
			// Twitter tab checkboxs
			$woo_slg_enable_twitter 					= ( isset($_POST['woo_slg_enable_twitter']) ) ? 'yes' : 'no';
			$woo_slg_enable_tw_avatar 					= ( isset($_POST['woo_slg_enable_tw_avatar']) ) ? 'yes' : 'no';
			// Yahoo tab checkboxs
			$woo_slg_enable_yahoo 						= ( isset($_POST['woo_slg_enable_yahoo']) ) ? 'yes' : 'no';
			$woo_slg_enable_yh_avatar 					= ( isset($_POST['woo_slg_enable_yh_avatar']) ) ? 'yes' : 'no';
			// Foursquare tab checkboxs
			$woo_slg_enable_foursquare 					= ( isset($_POST['woo_slg_enable_foursquare']) ) ? 'yes' : 'no';
			$woo_slg_enable_fs_avatar 					= ( isset($_POST['woo_slg_enable_fs_avatar']) ) ? 'yes' : 'no';
			// Windows Live tab checkbox
			$woo_slg_enable_windowslive 				= ( isset($_POST['woo_slg_enable_windowslive']) ) ? 'yes' : 'no';
			// VK tab checkboxs
			$woo_slg_enable_vk 							= ( isset($_POST['woo_slg_enable_vk']) ) ? 'yes' : 'no';
			$woo_slg_enable_vk_avatar 					= ( isset($_POST['woo_slg_enable_vk_avatar']) ) ? 'yes' : 'no';
			// Instagram tab checkboxs
			$woo_slg_enable_instagram 					= ( isset($_POST['woo_slg_enable_instagram']) ) ? 'yes' : 'no';
			$woo_slg_enable_inst_avatar 				= ( isset($_POST['woo_slg_enable_inst_avatar']) ) ? 'yes' : 'no';
			// Amazon tab checkbox
			$woo_slg_enable_amazon 						= ( isset($_POST['woo_slg_enable_amazon']) ) ? 'yes' : 'no';
			// Paypal tab checkbox
			$woo_slg_enable_paypal 						= ( isset($_POST['woo_slg_enable_paypal']) ) ? 'yes' : 'no';
			// Misc tab checkbox
			$woo_slg_delete_options 					= ( isset($_POST['woo_slg_delete_options']) ) ? 'yes' : 'no';

			// Peepso avatar each time
			$woo_slg_peepso_avatar_each_time 			= ( isset($_POST['woo_slg_peepso_avatar_each_time']) ) ? 'yes' : 'no';
			// Peepso cover each time
			$woo_slg_peepso_cover_each_time 			= ( isset($_POST['woo_slg_peepso_cover_each_time']) ) ? 'yes' : 'no';
			


			// set options in array for save
			$woo_slg_options_save = array(
				'woo_slg_email_notification_type' 			=> $woo_slg_email_notification_type,
				'woo_slg_enable_notification' 				=> $woo_slg_enable_notification,
				'woo_slg_send_new_account_email_to_admin' 	=> $woo_slg_send_new_account_email_to_admin,
				'woo_slg_redirect_url' 						=> $woo_slg_redirect_url,
				'woo_slg_base_reg_username' 				=> $woo_slg_base_reg_username,
				'woo_slg_enable_login_page' 				=> $woo_slg_enable_login_page,
				'woo_slg_enable_woo_register_page' 			=> $woo_slg_enable_woo_register_page,
				'woo_slg_enable_on_checkout_page' 			=> $woo_slg_enable_on_checkout_page,
				'woo_slg_enable_wp_login_page' 				=> $woo_slg_enable_wp_login_page,
				'woo_slg_enable_wp_register_page' 			=> $woo_slg_enable_wp_register_page,
				'woo_slg_enable_buddypress_login_page' 		=> $woo_slg_enable_buddypress_login_page,
				'woo_slg_enable_buddypress_register_page' 	=> $woo_slg_enable_buddypress_register_page,
				'woo_slg_enable_bbpress_login_page' 		=> $woo_slg_enable_bbpress_login_page,
				'woo_slg_enable_bbpress_register_page' 		=> $woo_slg_enable_bbpress_register_page,
				'woo_slg_enable_peepso_login_page' 			=> $woo_slg_enable_peepso_login_page,
				'woo_slg_enable_peepso_register_page' 		=> $woo_slg_enable_peepso_register_page,
				'woo_slg_allow_peepso_avatar' 				=> $woo_slg_allow_peepso_avatar,
				'woo_slg_allow_peepso_cover' 				=> $woo_slg_allow_peepso_cover,
				'woo_slg_display_link_thank_you' 			=> $woo_slg_display_link_thank_you,
				'woo_slg_display_link_acc_detail'			=> $woo_slg_display_link_acc_detail,
				'woo_slg_login_heading' 					=> $woo_slg_login_heading,
				'woo_slg_enable_expand_collapse' 			=> $woo_slg_enable_expand_collapse,
				'woo_slg_social_btn_type' 					=> $woo_slg_social_btn_type,
				
				'woo_slg_enable_facebook' 					=> $woo_slg_enable_facebook,
				'woo_slg_fb_app_id' 						=> $woo_slg_fb_app_id,
				'woo_slg_fb_app_secret' 					=> $woo_slg_fb_app_secret,
				'woo_slg_fb_language' 						=> $woo_slg_fb_language,
				'woo_slg_enable_fb_avatar' 					=> $woo_slg_enable_fb_avatar,
				'woo_slg_fb_icon_text' 						=> $woo_slg_fb_icon_text,
				'woo_slg_fb_link_icon_text' 				=> $woo_slg_fb_link_icon_text,
				'woo_slg_fb_icon_url' 						=> $woo_slg_fb_icon_url,
				'woo_slg_fb_link_icon_url' 					=> $woo_slg_fb_link_icon_url,

				'woo_slg_enable_googleplus'					=> $woo_slg_enable_googleplus,
				'woo_slg_gp_client_id'						=> $woo_slg_gp_client_id,
				'woo_slg_gp_client_secret'					=> $woo_slg_gp_client_secret,
				'woo_slg_enable_gp_avatar'					=> $woo_slg_enable_gp_avatar,
				'woo_slg_gp_icon_text'						=> $woo_slg_gp_icon_text,
				'woo_slg_gp_link_icon_text'					=> $woo_slg_gp_link_icon_text,
				'woo_slg_gp_icon_url'						=> $woo_slg_gp_icon_url,
				'woo_slg_gp_link_icon_url'					=> $woo_slg_gp_link_icon_url,

				'woo_slg_enable_linkedin'					=> $woo_slg_enable_linkedin,
				'woo_slg_li_app_id'							=> $woo_slg_li_app_id,
				'woo_slg_li_app_secret'						=> $woo_slg_li_app_secret,
				'woo_slg_enable_li_avatar'					=> $woo_slg_enable_li_avatar,
				'woo_slg_li_icon_text'						=> $woo_slg_li_icon_text,
				'woo_slg_li_link_icon_text'					=> $woo_slg_li_link_icon_text,
				'woo_slg_li_icon_url'						=> $woo_slg_li_icon_url,
				'woo_slg_li_link_icon_url'					=> $woo_slg_li_link_icon_url,

				'woo_slg_enable_twitter'					=> $woo_slg_enable_twitter,
				'woo_slg_tw_consumer_key'					=> $woo_slg_tw_consumer_key,
				'woo_slg_tw_consumer_secret'				=> $woo_slg_tw_consumer_secret,
				'woo_slg_enable_tw_avatar'					=> $woo_slg_enable_tw_avatar,
				'woo_slg_tw_icon_text'						=> $woo_slg_tw_icon_text,
				'woo_slg_tw_link_icon_text'					=> $woo_slg_tw_link_icon_text,
				'woo_slg_tw_icon_url'						=> $woo_slg_tw_icon_url,
				'woo_slg_tw_link_icon_url'					=> $woo_slg_tw_link_icon_url,

				'woo_slg_enable_yahoo'						=> $woo_slg_enable_yahoo,
				'woo_slg_yh_consumer_key'					=> $woo_slg_yh_consumer_key,
				'woo_slg_yh_consumer_secret'				=> $woo_slg_yh_consumer_secret,
				'woo_slg_yh_app_id'							=> $woo_slg_yh_app_id,
				'woo_slg_enable_yh_avatar'					=> $woo_slg_enable_yh_avatar,
				'woo_slg_yh_icon_text'						=> $woo_slg_yh_icon_text,
				'woo_slg_yh_link_icon_text'					=> $woo_slg_yh_link_icon_text,
				'woo_slg_yh_icon_url'						=> $woo_slg_yh_icon_url,
				'woo_slg_yh_link_icon_url'					=> $woo_slg_yh_link_icon_url,

				'woo_slg_enable_foursquare'					=> $woo_slg_enable_foursquare,
				'woo_slg_fs_client_id'						=> $woo_slg_fs_client_id,
				'woo_slg_fs_client_secret'					=> $woo_slg_fs_client_secret,
				'woo_slg_enable_fs_avatar'					=> $woo_slg_enable_fs_avatar,
				'woo_slg_fs_icon_text'						=> $woo_slg_fs_icon_text,
				'woo_slg_fs_link_icon_text'					=> $woo_slg_fs_link_icon_text,
				'woo_slg_fs_icon_url'						=> $woo_slg_fs_icon_url,
				'woo_slg_fs_link_icon_url'					=> $woo_slg_fs_link_icon_url,

				'woo_slg_enable_windowslive'				=> $woo_slg_enable_windowslive,
				'woo_slg_wl_client_id'						=> $woo_slg_wl_client_id,
				'woo_slg_wl_client_secret'					=> $woo_slg_wl_client_secret,
				'woo_slg_wl_icon_text'						=> $woo_slg_wl_icon_text,
				'woo_slg_wl_link_icon_text'					=> $woo_slg_wl_icon_text,
				'woo_slg_wl_icon_url'						=> $woo_slg_wl_icon_url,
				'woo_slg_wl_link_icon_url'					=> $woo_slg_wl_link_icon_url,

				'woo_slg_enable_vk'							=> $woo_slg_enable_vk,
				'woo_slg_vk_app_id'							=> $woo_slg_vk_app_id,
				'woo_slg_vk_app_secret'						=> $woo_slg_vk_app_secret,
				'woo_slg_enable_vk_avatar'					=> $woo_slg_enable_vk_avatar,
				'woo_slg_vk_icon_text'						=> $woo_slg_vk_icon_text,
				'woo_slg_vk_link_icon_text'					=> $woo_slg_vk_link_icon_text,
				'woo_slg_vk_icon_url'						=> $woo_slg_vk_icon_url,
				'woo_slg_vk_link_icon_url'					=> $woo_slg_vk_link_icon_url,

				'woo_slg_enable_instagram'					=> $woo_slg_enable_instagram,
				'woo_slg_inst_client_id'					=> $woo_slg_inst_client_id,
				'woo_slg_inst_client_secret'				=> $woo_slg_inst_client_secret,
				'woo_slg_enable_inst_avatar'				=> $woo_slg_enable_inst_avatar,
				'woo_slg_inst_icon_text'					=> $woo_slg_inst_icon_text,
				'woo_slg_inst_link_icon_text'				=> $woo_slg_inst_link_icon_text,
				'woo_slg_inst_icon_url'						=> $woo_slg_inst_icon_url,
				'woo_slg_inst_link_icon_url'				=> $woo_slg_inst_link_icon_url,

				'woo_slg_enable_amazon'						=> $woo_slg_enable_amazon,
				'woo_slg_amazon_client_id'					=> $woo_slg_amazon_client_id,
				'woo_slg_amazon_client_secret'				=> $woo_slg_amazon_client_secret,
				'woo_slg_amazon_icon_text'					=> $woo_slg_amazon_icon_text,
				'woo_slg_amazon_link_icon_text'				=> $woo_slg_amazon_link_icon_text,
				'woo_slg_amazon_icon_url'					=> $woo_slg_amazon_icon_url,
				'woo_slg_amazon_link_icon_url'				=> $woo_slg_amazon_link_icon_url,

				'woo_slg_enable_paypal'						=> $woo_slg_enable_paypal,
				'woo_slg_paypal_client_id'					=> $woo_slg_paypal_client_id,
				'woo_slg_paypal_client_secret'				=> $woo_slg_paypal_client_secret,
				'woo_slg_paypal_environment'				=> $woo_slg_paypal_environment,
				'woo_slg_paypal_icon_text'					=> $woo_slg_paypal_icon_text,
				'woo_slg_paypal_link_icon_text'				=> $woo_slg_paypal_link_icon_text,
				'woo_slg_paypal_icon_url'					=> $woo_slg_paypal_icon_url,
				'woo_slg_paypal_link_icon_url'				=> $woo_slg_paypal_link_icon_url,

				'woo_slg_delete_options'					=> $woo_slg_delete_options,
				'woo_slg_peepso_avatar_each_time'			=> $woo_slg_peepso_avatar_each_time,
				'woo_slg_peepso_cover_each_time'			=> $woo_slg_peepso_cover_each_time,
			);

			// Strip Slashes before save
			$woo_slg_options_save = $woo_slg_model->woo_slg_escape_slashes_deep( $woo_slg_options_save, false );

			// Save the settings options
			foreach( $woo_slg_options_save as $woo_slg_options_key => $woo_slg_options_value){

				update_option( $woo_slg_options_key, $woo_slg_options_value );
			}

			// Update Global Options value after Save
			$woo_slg_options	= woo_slg_global_settings();

		}

	}
	
	/**
	 * Add Social Login Page
	 * 
	 * Handles to load social login 
	 * page to show social login register data
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.0.0
	 */
	public function woo_slg_social_login() {
		
		include_once( WOO_SLG_ADMIN . '/forms/woo-social-login-data.php' );
	}
	
	/**
	 * Pop Up On Editor
	 *
	 * Includes the pop up on the WordPress editor
	 *
	 * @package WooCommerce - Social Login
	 * @since 1.1.1
	 */
	public function woo_slg_shortcode_popup() {
		
		include_once( WOO_SLG_ADMIN . '/forms/woo-slg-admin-popup.php' );
	}
	
    /**
	 * Add notice if SSL is not enabled
	 *
	 * @package WooCommerce - Social Login
	 * @since 1.1.1
	 */
	public function woo_slg_admin_ssl_notice(){
		
		global $woo_slg_options;
		
		$woo_social_order = get_option( 'woo_social_order' );	
		
		foreach ( $woo_social_order as $provider ) {
			
			global ${"woo_slg_social_".$provider};
			
			if( array_key_exists( 'woo_slg_enable_'.$provider, $woo_slg_options ) && $woo_slg_options['woo_slg_enable_'.$provider] == "yes" 
				&& isset(${"woo_slg_social_".$provider}->requires_ssl) && ${"woo_slg_social_".$provider}->requires_ssl) {			?>
			<div class="error">
        		<p><?php _e( 'WooCommerce Social Login : <b>'. $provider .'</b> requires SSL for authentication. ', 'wooslg' ); ?></p>
    		</div>
    
	<?php }
		}	
	}
    
    /**
	 * if cURL is not enabled then show notice
	 *
	 * @package WooCommerce - Social Login
	 * @since 1.5.6
	 */
    public function woo_slg_admin_curl_notice() {

        if( !extension_loaded('curl') ) { ?>
            <div class="error notice">
                <p>
                    <?php                     
                    echo sprintf( __( 'WooCommerce Social Login requires the %scURL%s PHP function to exist.  Contact your host or server administrator to configure and install the missing function.', 'wooslg' ),'<b>', '</b>' );                     
                    ?>
                </p>
            </div><?php
        }
    }

    /**
	 * Handles to display social login settings moved notice
	 *
	 * @package WooCommerce - Social Login
	 * @since 1.5.6
	 */
    public function woo_slg_admin_settings_moved_notice(){

    	// Declare prefix
		$usermeta_prefix	= WOO_SLG_USER_META_PREFIX;

		if ( get_option( 'woo_slg_dismissed_social_login_settings_moved_notice' ) ) {
			return;
		}

    	if ( get_user_meta( get_current_user_id(), $usermeta_prefix.'dismissed_social_login_settings_moved_notice', true ) ) {
			return;
		}

		// Get current screen
    	$current_screen = get_current_screen();

    	// Check whether we are on WooCommerce settings page
    	if( !empty( $current_screen ) && $current_screen->id == 'woocommerce_page_wc-settings' ) {

    		// Get redirect URL
			$redirect_uri = add_query_arg(	
											array(
													'page' 		=> 'woo-social-settings'
											), esc_html( admin_url( 'admin.php' ) )
										);
    	?>
        <div class="updated woocommerce-message notice">
        	<a class="woocommerce-message-close notice-dismiss" style="top:0;" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'wooslg-hide-notice', 'social_login_settings_moved' ), 'wooslg_hide_notice_nonce', '_wooslg_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'wooslg' ); ?></a>
            <p>
                <?php                     
                echo sprintf( __( 'Looking for the Social Login options? They can now be found in the seperate menu. <a href="%s">Go see them in action here.</a>', 'wooslg' ), $redirect_uri );                     
                ?>
            </p>
        </div><?php
    	}
    }

    /**
	 * Handles to save dismiss notice data
	 *
	 * @package WooCommerce - Social Login
	 * @since 1.5.6
	 */
    public function woo_slg_hide_notices(){

    	// Declare prefix
		$usermeta_prefix	= WOO_SLG_USER_META_PREFIX;

    	if ( isset( $_GET['wooslg-hide-notice'] ) && isset( $_GET['_wooslg_notice_nonce'] ) ) {

			if ( ! wp_verify_nonce( $_GET['_wooslg_notice_nonce'], 'wooslg_hide_notice_nonce' ) ) {
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'woocommerce' ) );
			}

			if ( ! current_user_can( 'manage_woocommerce' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'woocommerce' ) );
			}

			$hide_notice = sanitize_text_field( $_GET['wooslg-hide-notice'] );

			update_user_meta( get_current_user_id(), $usermeta_prefix . 'dismissed_' . $hide_notice . '_notice', true );

			do_action( 'wooslg_hide_' . $hide_notice . '_notice' );
		}
    }

	/**
	 * Add 'Social Profiles' column to the Users admin table
	 *
	 * @package WooCommerce - Social Login
	 * @since 1.4.7
	 */
	public function woo_slg_add_user_columns ( $columns ) {
		
		return woo_slg_array_insert_after( $columns, 'email', array( 'wps_social_login_profiles' => __( 'Primary Social Profile', 'wooslg' ) ) );
	}
	
	/**
	 * Render social profile icons in the 'Social Profiles' column of the Users admin table
	 *
	 * @package WooCommerce - Social Login
	 * @since 1.4.7
	 */
	public function woo_slg_user_column_values ( $output, $column_name, $user_id ) {
		
		if ( $column_name === 'wps_social_login_profiles' ) {
			
			$wps_user = get_user_by( 'id', $user_id );
			if ( !empty( $user_id ) && !empty( $wps_user ) ){
				
				$wps_user_soc_login_prof = get_user_meta( $user_id, 'woo_slg_social_user_connect_via', true );
				if ( !empty( $wps_user_soc_login_prof ) ) {
					
					$provider	= WOO_SLG_IMG_URL . "/" . $wps_user_soc_login_prof . ".png";
					$output 	.= '<img src="' . $provider . '" >';
				} else {
					$output .= __( 'N/A', 'wooslg');
				}
			}
		}
		
		return $output;
	}
	
	
	/**
	 * Render social profile icons in the user edit screen
	 *
	 * @package WooCommerce - Social Login
	 * @since 1.4.8
	 */
	function woo_slg_show_user_profiles( $user ) { 

		$user_id = $user->ID;
		$primaryProfile = __( 'N/A', 'wooslg');

		// solved link profile not show on admin side,pass user id
		$linked_profiles = $this->render->woo_slg_get_user_social_linked_profiles($user_id);
		
		//get primary social account type if exist
		$primary_social		= get_user_meta( $user_id, 'woo_slg_social_user_connect_via', true );		
		if ( !empty( $primary_social ) ) {					
				$provider	= WOO_SLG_IMG_URL . "/" . $primary_social . ".png";
				$primaryProfile	= '<img src="' . $provider . '" >';
		}		
		?>
		
		<h2><?php _e( 'Social Profiles', 'wooslg' ); ?></h2>
			<table class="form-table">
				<tr>
					<th> <?php _e( 'Primary Social Profile', 'wooslg' ); ?></th>
					<td><?php echo $primaryProfile; ?></td>
				</tr>
				<tr>
					<th> <?php _e( 'Linked Social Profiles', 'wooslg' ); ?></th>
					<td>
					<?php
					$woo_linked_profiles = 0;
					if( !empty( $linked_profiles ) ) {
						
						foreach ( $linked_profiles as $profile => $value ) {
							if( $profile != $primary_social ) {
								$provider		= WOO_SLG_IMG_URL . "/" . $profile . ".png";
								echo '<img src="'.$provider.'" class="woo-slg-linked-provider-image">';
								$woo_linked_profiles++;
							}
						}
					} 
					if( $woo_linked_profiles == 0) {
						_e( 'N/A', 'wooslg');
					}
					?>
					</td>
				</tr>
			</table>
	<?php
	}

	/**
	 * Function to generate and download system log report
	 *
	 * @package WooCommerce - Social Login
	 * @since 1.5.6
	 */
	public function woo_slg_generate_system_log(){

		// If post data is set
		if( !empty($_GET['page']) && $_GET['page'] == 'woo-social-settings' && !empty($_GET['woo_slg_gen_sys_log']) && $_GET['woo_slg_gen_sys_log'] == 1 ) {

			// Declare username array
			$username_arr = array(
                ''				=> __( 'Based on unique ID & random number', 'wooslg' ),
				'realname'		=> __( 'Based on real name', 'wooslg' ),
				'emailbased'	=> __( 'Based on email ID', 'wooslg' ),
				'realemailbased'	=> __( 'Actual email ID','wooslg')
            );

			// get all required options to show in system log
			$delete_option				 = get_option('woo_slg_delete_options');
			$enable_email_notification	 = get_option('woo_slg_enable_notification');
			$user_name 					 = get_option('woo_slg_base_reg_username');
			$is_enabled_login_page 		 = get_option('woo_slg_enable_login_page');
			$is_enabled_register_page 	 = get_option('woo_slg_enable_woo_register_page');
			$is_enabled_checkout_page	 = get_option('woo_slg_enable_on_checkout_page');
			$is_enabled_wp_login_page	 = get_option('woo_slg_enable_wp_login_page');
			$is_enabled_wp_register_page = get_option('woo_slg_enable_wp_register_page');
			$disp_thankyou_page			 = get_option('woo_slg_display_link_thank_you');

			// Open new file
		    $handle = fopen("social-login-system-report.txt", "w");

		    // Start writing data in our file
		    $log_data 			= '--- WPWeb Social Login Report Information ---';

		    // Declare woocommerce variables to use for getting system data
			$system_info		= woo_slg_get_system_info();

			if( class_exists( 'Woocommerce' ) ) {

				$system_status  = new WC_REST_System_Status_Controller;
				$database       = $system_status->get_database_info();
			}

			// HTML for WordPress environment
			$log_data	.= "\n\n".__('--- WordPress Environment ---', 'wooslg');
			$log_data	.= "\n".__('Home URL: ', 'wooslg') . $system_info['environment']['home_url'];
			$log_data	.= "\n".__('WorPress Version: ', 'wooslg') . $system_info['environment']['wp_version'];
			$log_data	.= "\n".__('WP Debug Mode: ', 'wooslg') . ( $system_info['environment']['wp_debug_mode']? __('Yes', 'wooslg') : __('No', 'wooslg') );
			$log_data	.= "\n".__('WP cron: ', 'wooslg') . ( $system_info['environment']['wp_cron'] ? __('Yes', 'wooslg') : __('No', 'wooslg') );

			// HTML for Server environment
			$log_data	.= "\n\n".__('--- Server Environment ---', 'wooslg');
			$log_data	.= "\n".__('PHP Version: ', 'wooslg') . $system_info['environment']['php_version'];
			if( class_exists( 'Woocommerce' ) ) {
				$log_data	.= "\n".__('WC Database Version: ', 'wooslg') . $database['wc_database_version'];
			}
			$log_data	.= "\n".__('fsockopen/cURL: ', 'wooslg') . ( $system_info['environment']['fsockopen_or_curl_enabled'] ? __('Yes', 'wooslg') : __('No', 'wooslg') );

			// HTML for Active plugins
			$log_data	.= "\n\n".__('--- Active Plugins ---', 'wooslg');
			foreach($system_info['plugins'] as $plugin){

				if ( ! empty( $plugin['name'] ) ) {
					$dirname = dirname( $plugin['plugin'] );
	
					// Link the plugin name to the plugin url if available.
					$plugin_name = esc_html( $plugin['name'] );
					
					$version_string = '';
					$network_string = '';
					if ( strstr( $plugin['url'], 'woothemes.com' ) || strstr( $plugin['url'], 'woocommerce.com' ) ) {
						if ( ! empty( $plugin['version_latest'] ) && version_compare( $plugin['version_latest'], $plugin['version'], '>' ) ) {
							/* translators: %s: plugin latest version */
							$version_string = ' &ndash; <strong style="color:red;">' . sprintf( esc_html__( '%s is available', 'wooslg' ), $plugin['version_latest'] ) . '</strong>';
						}
	
						if ( false != $plugin['network_activated'] ) {
							$network_string = ' &ndash; <strong style="color:black;">' . __( 'Network enabled', 'wooslg' ) . '</strong>';
						}
					}
					
					$log_data .= "\n" . $plugin_name . __( ' by ', 'wooslg' ) . $plugin['author_name'] . __(' - ', 'wooslg') . esc_html( $plugin['version'] ) . $version_string . $network_string;
				}
			}

			// HTML for Active theme
			$log_data .= "\n\n".__('--- Active Theme ---', 'wooslg');
			$log_data .= "\n" . __('Theme Name: ', 'wooslg') . $system_info['theme']['name'];
			$log_data .= "\n" . __('Version: ') . $system_info['theme']['version'];
			$log_data .= "\n" . __('Author URL: ') . $system_info['theme']['author_url'];
			$log_data .= "\n" . __('Child theme: ') . ( $system_info['theme']['is_child_theme'] ? __('Yes', 'wooslg') : __('No', 'wooslg') );

			// HTML for Plugin settings
			$log_data .= "\n\n" . __('--- Plugin Settings ---', 'wooslg');
			$log_data .= "\n" . __("Delete Option: ", 'wooslg') . ( !empty($delete_option) ? ucfirst($delete_option) : __('No', 'wooslg') );
			$log_data .= "\n" . __("Enable Email Notification: ", 'wooslg') . ( !empty($enable_email_notification) ? ucfirst($enable_email_notification) : __('No', 'wooslg') );
			$log_data .= "\n" . __("Autoregistered Usernames: ", 'wooslg') . $username_arr[$user_name];
			$log_data .= "\n" . __("Display Login button on WooCommerce login Page: ", 'wooslg') . ( !empty($is_enabled_login_page) ? ucfirst($is_enabled_login_page) : __('No', 'wooslg') );
			$log_data .= "\n" . __("Display Login button on WooCommerce Registration Page: ", 'wooslg') . ( !empty($is_enabled_register_page) ? ucfirst($is_enabled_register_page) : __('No', 'wooslg') );
			$log_data .= "\n" . __("Display Login button on WooCommerce Checkout Page: ", 'wooslg') . ( !empty($is_enabled_checkout_page) ? ucfirst($is_enabled_checkout_page) : __('No', 'wooslg') );
			$log_data .= "\n" . __("Display Login button on Wordpress default login Page: ", 'wooslg') . ( !empty($is_enabled_wp_login_page) ? ucfirst($is_enabled_wp_login_page) : __('No', 'wooslg') );
			$log_data .= "\n" . __("Display Login button on Wordpress default register Page: ", 'wooslg') . ( !empty($is_enabled_wp_register_page) ? ucfirst($is_enabled_wp_register_page) : __('No', 'wooslg') );
			$log_data .= "\n" . __("Display Link Your Account on thankyou page: ", 'wooslg') . ( !empty($disp_thankyou_page) ? ucfirst($disp_thankyou_page) : __('No', 'wooslg') );

		    fwrite($handle, $log_data);
		    fclose($handle);

		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename('social-login-system-report.txt').'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize('social-login-system-report.txt'));
		    readfile('social-login-system-report.txt');
		    unlink("social-login-system-report.txt");
		    exit;
		}
	}

	/**
     * Display license activation notice
     * 
     * On Dismiss plugin will expire notice for 30 days. If plugin updated to new version then 
     * it will display notice again.
     * 
     * @package WooCommerce - Social Login
     * @since 1.6.3
     */
    public function woo_slg_license_activating_notice() {
        
        if ( ! $this->model->woo_slg_is_activated() && 
                ( empty( $_COOKIE['wooslgdeactivationmsg'] ) || version_compare( $_COOKIE['wooslgdeactivationmsg'], WOO_SLG_VERSION, '<' ) ) ) {
            ?>
            <style>
                .woo_slg_license-activation-notice {
                    position: relative;
                }
            </style>
            <script type="text/javascript">
                (function ( $ ) {
                    var setCookie = function ( c_name, value, exdays ) {
                        var exdate = new Date();
                        exdate.setDate( exdate.getDate() + exdays );
                        var c_value = encodeURIComponent( value ) + ((null === exdays) ? "" : "; expires=" + exdate.toUTCString());
                        document.cookie = c_name + "=" + c_value;
                    };
                    $( document ).on( 'click.woo-slg-notice-dismiss',
                        '.woo-slg-notice-dismiss',
                        function ( e ) {
                            e.preventDefault();
                            var $el = $( this ).closest('#woo_slg_license-activation-notice' );
                            $el.fadeTo( 100, 0, function () {
                                $el.slideUp( 100, function () {
                                    $el.remove();
                                } );
                            } );
                            setCookie( 'wooslgdeactivationmsg',
                                '<?php echo WOO_SLG_VERSION; ?>',
                                30 );
                        } );
                })( window.jQuery );
            </script>
            <?php            
            $redirect = add_query_arg(  array( 'page' => 'wpweb-upd-helper' ), esc_url( ( is_multisite() ? network_admin_url() : admin_url() ) ) );
            echo '<div class="updated woo_slg_license-activation-notice" id="woo_slg_license-activation-notice"><p>' . sprintf( __( 'Hola! Would you like to receive automatic updates? Please <a href="%s">activate your copy</a> of WooCommerce - Social Login.', 'wooslg' ), $redirect ) . '</p>' . '<button type="button" class="notice-dismiss woo-slg-notice-dismiss"><span class="screen-reader-text">' . __( 'Dismiss this notice.', 'wooslg' ) . '</span></button></div>';
        }
    }

    /**
     * Display WPWEB Upgrade notice
     *
     * @package WooCommerce - Social Login
     * @since 1.6.3
     */
    public function woo_slg_check_wpweb_updater_upgrate_notice() { ?>
        <div class="error fade notice is-dismissible" id="woo-wpweb-upgrade-notice">
            <p><?= __( 'WooCommerce - Social Login requires WPWEB Updater version greater then 1.0.4. Please Upgrade to latest version.', 'wooslg' ); ?></p>
            <button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e( 'Dismiss this notice.', 'wooslg' ); ?></span></button>
        </div>
        <?php
    }
    
    /**
     * Check WPWEB Updater v1.0.4 or old version activated
     *
     * If yes then Deactivated WPWEB updater plugin and display notice to install latest updater plugin
     *
     * @package WooCommerce - Social Login
     * @since 1.6.3
     */
    public function woo_slg_check_wpweb_updater_activation() {

        // if WPWEB Updater is activated
        if ( class_exists( 'Wpweb_Upd_Admin' ) && version_compare( WPWEB_UPD_VERSION, '1.0.5', '<' ) ) {
            // deactivate the WPWEB Updater plugin
            deactivate_plugins('wpweb-updater/wpweb-updater.php');
            // Display notice of WPWEB Updater older version
            add_action( 'admin_notices', array( $this, 'woo_slg_check_wpweb_updater_upgrate_notice' ) );
        }
    }

	/**
	 * Adding Hooks
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.0.0
	 */
	public function add_hooks() {
		
		//add admin menu pages
		//add_action ( 'admin_menu', array( $this, 'woo_slg_admin_menu_pages' ) );
		
		// mark up for popup
		add_action( 'admin_footer-post.php', array( $this,'woo_slg_shortcode_popup' ) );
		add_action( 'admin_footer-post-new.php', array( $this,'woo_slg_shortcode_popup' ) );
		if(!is_ssl()){
			add_action( 'admin_notices', array( $this,'woo_slg_admin_ssl_notice' ) ); 
		}
        
        // check curl is enabled or not
        add_action( 'admin_notices', array( $this, 'woo_slg_admin_curl_notice' ) );

        // Admin notice for settings moved
        add_action( 'admin_notices', array( $this, 'woo_slg_admin_settings_moved_notice' ) );

        // Remove admin notice
        add_action( 'wp_loaded', array( $this, 'woo_slg_hide_notices' ) );
		
		// add social profiles column to the Users admin table
		add_filter( 'manage_users_columns',       array( $this, 'woo_slg_add_user_columns' ), 11 );
		add_filter( 'manage_users_custom_column', array( $this, 'woo_slg_user_column_values' ), 11, 3 );
		
		add_action( 'show_user_profile', array( $this, 'woo_slg_show_user_profiles' ) );
		add_action( 'edit_user_profile', array( $this, 'woo_slg_show_user_profiles' ) );

		// Add action to generate and download system report file
		add_action( 'admin_init', array( $this, 'woo_slg_generate_system_log' ) );

        add_action( 'admin_notices', array( $this, 'woo_slg_license_activating_notice') );
        add_action( 'network_admin_notices', array( $this, 'woo_slg_license_activating_notice' ) );

        if( is_multisite() && ! is_network_admin() ) { // for multisite
			remove_action( 'admin_notices', array( $this, 'woo_slg_license_activating_notice' ) );
		}

        //Check WPWEB Updater version 
        add_action( 'admin_init', array( $this, 'woo_slg_check_wpweb_updater_activation' ) );

        //Check Save settings
        add_action( 'admin_init', array( $this, 'woo_slg_settings_save' ) );
	}
}