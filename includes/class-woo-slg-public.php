<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Public Pages Class
 * 
 * Handles all the different features and functions
 * for the front end pages.
 * 
 * @package WooCommerce - Social Login
 * @since 1.0.0
 */
class WOO_Slg_Public {
	
	public $render,$model;
	public $socialfacebook, $socialgoogle, $sociallinkedin, $socialtwitter;
	public $socialfoursquare, $socialyahoo, $socialwindowslive, $socialvk;
	public $socialinstagram;
	public $socialamazon, $socialpaypal;
	
	public function __construct() {
		
		global $woo_slg_render,$woo_slg_model,$woo_slg_social_facebook,$woo_slg_social_google,
			$woo_slg_social_linkedin,$woo_slg_social_twitter,$woo_slg_social_yahoo,$woo_slg_social_foursquare,
			$woo_slg_social_windowslive,$woo_slg_social_vk,$woo_slg_social_instagram, $woo_slg_social_amazon, $woo_slg_social_paypal;
		
		$this->render	= $woo_slg_render;
		$this->model	= $woo_slg_model;
		
		//social class objects
		$this->socialfacebook	= $woo_slg_social_facebook;
		$this->socialgoogle		= $woo_slg_social_google;
		$this->sociallinkedin	= $woo_slg_social_linkedin;
		$this->socialtwitter	= $woo_slg_social_twitter;
		$this->socialyahoo		= $woo_slg_social_yahoo;
		$this->socialfoursquare	= $woo_slg_social_foursquare;
		$this->socialwindowslive= $woo_slg_social_windowslive;
		$this->socialvk			= $woo_slg_social_vk;
		$this->socialinstagram	= $woo_slg_social_instagram;
		$this->socialamazon	    = $woo_slg_social_amazon;
		$this->socialpaypal	    = $woo_slg_social_paypal;
		
	}	
	
	/**
	 * AJAX Call
	 * 
	 * Handles to Call ajax for register user
	 * ( Modified in version 1.3.0 )
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.0.0
	 */
	public function woo_slg_social_login() {
		
		global $woo_slg_options;
		
		$type	= $_POST['type'];
		
		$result	= array();
		$data	= array();
		$usercreated = 0;
		
		//created user who will connect via facebook
		if( $type == 'facebook' ) {
			
			$userid = $this->socialfacebook->woo_slg_get_fb_user();
			//if user id is null then return
			if( empty( $userid ) ) return;
			
			$userdata = $this->socialfacebook->woo_slg_get_fb_userdata( $userid );
			
			//check permission data user given to application
			$permData = $this->socialfacebook->woo_slg_check_fb_app_permission( 'email' );
			
			if( empty( $permData ) ) { //if user not give the permission to api and user type is facebook then it will redirected
				
				$result['redirect'] = '1';
				echo json_encode( $result );
				//do exit to get proper result
				exit;
			}
			
			//check facebook user data is not empty or check social identifire for register without email
			if( !empty( $userdata ) && isset( $userdata['email'] ) || isset( $userdata['id'] ) ) { //check isset user email from facebook 
				
				$data	= $this->model->woo_slg_get_user_common_social_data( $userdata, $type );
			}
		} else if( $type == 'googleplus' ) {
			
			$gp_userdata = $this->socialgoogle->woo_slg_get_google_user_data();			
			/*if( !isset( $gp_userdata['url'] ) ) {
				$gp_userdata['url'] = $gp_userdata['image']['url'];
			}*/
			if( !empty( $gp_userdata ) ) {
				$data	= $this->model->woo_slg_get_user_common_social_data( $gp_userdata, $type );
			}		
			
		} else if( $type == 'linkedin' ) {
			
			$li_userdata = $this->sociallinkedin->woo_slg_get_linkedin_user_data();
			if( !empty( $li_userdata['emailAddress'] ) ) {
				$data	= $this->model->woo_slg_get_user_common_social_data( $li_userdata, $type );
			}
			
		} else if( $type == 'yahoo' ) {
			
			$yh_userdata = $this->socialyahoo->woo_slg_get_yahoo_user_data();
			
			if( !empty( $yh_userdata ) ) {
				
				$email		= '';
				$last_email	= '';
				
				if( isset( $yh_userdata->emails ) && !empty( $yh_userdata->emails ) && is_array( $yh_userdata->emails ) ) {
					foreach ( $yh_userdata->emails as $key => $value ) {
						$last_email	= isset( $value->handle ) ? $value->handle : '';
						if( isset($value->primary) && $value->primary ) {
							$email	= $value->handle;
						}
					}
					
					if( empty( $email ) ) {
						$email	= $last_email;
					}
				}
				
				$yh_userdata->yh_primary_email	= $email;
				$data	= $this->model->woo_slg_get_user_common_social_data( $yh_userdata, $type );
			}
			
		} else if( $type == 'foursquare' ) { //check type is four squere
			
			$fs_userdata = $this->socialfoursquare->woo_slg_get_foursquare_user_data();
			if( !empty( $fs_userdata ) ) {
				$data	= $this->model->woo_slg_get_user_common_social_data( $fs_userdata, $type );
			}
			
		} else if( $type == 'windowslive' ) { //check type is four squere
			
			$wl_userdata = $this->socialwindowslive->woo_slg_get_windowslive_user_data();
		if( !empty( $wl_userdata ) ) { //check windowslive user data is not empty
				
				$wlemail = isset( $wl_userdata->emails->preferred ) ? $wl_userdata->emails->preferred
							: $wl_userdata->emails->account;
				$wl_userdata->wlemail	= $wlemail;
				$data	= $this->model->woo_slg_get_user_common_social_data( $wl_userdata, $type );
			}
		} else if( $type == 'vk' ) { //check type is vk

			$vk_userdata = $this->socialvk->woo_slg_get_vk_user_data();
			if( !empty( $vk_userdata ) ) {
				$data	= $this->model->woo_slg_get_user_common_social_data( $vk_userdata, $type );
			}

		} else if( $type == 'instagram' ) { //check type is instagram

			$inst_userdata	= $this->socialinstagram->woo_slg_get_instagram_user_data();

			if( !empty( $inst_userdata ) ) {

				$full_name	= explode( ' ', $inst_userdata->full_name );

				$first_name	= array_slice( $full_name, 0, 1 );
				$last_name	= array_slice( $full_name, 1 );

				$first_name	= implode( ' ', $first_name );
				$last_name	= implode( ' ', $last_name );

				$inst_userdata->first_name	= !empty($first_name) ? $first_name : '';
				$inst_userdata->last_name	= !empty($last_name) ? $last_name : '';

				$data	= $this->model->woo_slg_get_user_common_social_data( $inst_userdata, $type );
			}
		} else if( $type == 'twitter' ) { //check type is twitter

			$tw_userdata = $this->socialtwitter->woo_slg_get_twitter_user_data();
			if( !empty( $tw_userdata ) && isset( $tw_userdata->id ) && !empty( $tw_userdata->id ) ) {//check user id is set or not for twitter
				$data	= $this->model->woo_slg_get_user_common_social_data( $tw_userdata, $type );
			}			
		} else if( $type == 'amazon' ) { //check type is amazon

			$amazon_userdata = $this->socialamazon->woo_slg_get_amazon_user_data();			
			if( !empty( $amazon_userdata ) && isset( $amazon_userdata->user_id ) && !empty( $amazon_userdata->user_id ) ) {//check user id is set or not for amazon
				$data	= $this->model->woo_slg_get_user_common_social_data( $amazon_userdata, $type );
			}
		} else if( $type == 'paypal' ) { //check type is paypal

			$paypal_userdata = $this->socialpaypal->woo_slg_get_paypal_user_data();	
			
			if( !empty( $paypal_userdata ) && isset( $paypal_userdata->user_id ) && !empty( $paypal_userdata->user_id ) ) {//check user id is set or not for paypal
				$data	= $this->model->woo_slg_get_user_common_social_data( $paypal_userdata, $type );				
			}
		}

		if( !empty( $data ) ) { //If user data is not empty
			$result	= $this->woo_slg_process_profile( $data );
		}

		if( !is_user_logged_in() ) { //do action when user successfully created
			do_action( 'woo_slg_social_create_user_after', $type, $usercreated );
		}

		echo json_encode( $result );
		//do exit to get proper result
		exit;
	}

	/**
	 * Process Profile
	 * 
	 * Handles to process social profile
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.3.0
	 */
	public function woo_slg_process_profile( $data = array() ) {

		global $wpdb,$woo_slg_options;
		
		$user			= null;
		$new_customer	= false;
		$found_via		= null;
		
		$message		= woo_slg_messages();
		
		if( !empty( $data ) && !empty( $data['type'] ) ) {
			
			//social provider type
			$type		= $data['type'];
			$identifier	= $data['id'];

			// First, try to identify user based on the social identifier
			$user_id	= $wpdb->get_var( $wpdb->prepare( 'SELECT user_id FROM '.$wpdb->usermeta.' WHERE ( meta_key = "%s" AND meta_value = "%s" || meta_key = "%s" AND meta_value = "%s" )', 'woo_slg_social_' . $type . '_identifier', $identifier, 'woo_slg_social_identifier', $identifier ) );
			
			if ( $user_id ) {
				$user		= get_user_by( 'id', $user_id );
				$found_via	= 'social_identifier';
			}			
			
			// Fall back to email - user may already have an account on WooCommerce with the same email as in their social profile
			if ( ! $user && !empty( $data['email'] ) ) {
				$user		= get_user_by( 'email', $data['email'] );
				$found_via	= 'email';
			}

			if ( is_user_logged_in() ) { // If a user is already logged in
				
				// check that the logged in user and found user are the same.
				// This happens when user is linking a new social profile to their account.
				if( $user && get_current_user_id() !== $user->ID ) {
					
					if ( $found_via == 'social_identifier' ) {
						
						$already_linked_error	= isset( $message['already_linked_error'] ) ? $message['already_linked_error'] : '';
						return wc_add_notice( $already_linked_error, 'error' );
					} else {						
						$account_exist_error	= isset( $message['account_exist_error'] ) ? $message['account_exist_error'] : '';
						return wc_add_notice( $account_exist_error, 'error' );
					}
				}
				
				// If the social profile is not linked to any user accounts,
				// use the currently logged in user as the customer
				if ( ! $user ) {
					$user = get_user_by( 'id', get_current_user_id() );
				}
			}
			
			if ( ! $user ) { // If no user was found, create one
				
				$user_id	= $this->woo_slg_add_user( $data );
				$user		= get_user_by( 'id', $user_id );
				
				// indicate that a new user was created
				$new_customer = true;
			}
			
			// Update customer's WP user profile and billing details
			$this->woo_slg_update_customer_profile( $user->ID, $data, $new_customer );
			if( $type == 'facebook' ){
                            WooSocialLoginPersistentAnonymous::delete('facebook_at');
                            WooSocialLoginPersistentAnonymous::delete('facebook_display');
                        }
			if ( !is_user_logged_in() ) { // Log user in or add account linked notice for a logged in user

				wp_set_auth_cookie( $user->ID );

				//update last login with social account
				woo_slg_update_social_last_login_timestamp( $user->ID, $type );
				
				do_action( 'woo_slg_login_user_authenticated', $user->ID, $type );

			} else {
				wc_add_notice( sprintf( __( 'Your %s account is now linked to your account.', 'wooslg' ), $type ), 'notice' );
			}
		}
	}

	/**
	 * Update customer's social profiles
	 * 
	 * Handles to update customer's social profiles
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.3.0
	 */
	public function woo_slg_update_customer_profile( $wp_id = '', $wp_user_data = array(), $new_customer = false ) {

		if( $wp_id > 0 && !empty( $wp_user_data['type'] ) ) { //check wordpress user id is greater then zero

			//type of social account
			$type	= $wp_user_data['type'];

			if( $new_customer ) { //If new customer is created

				//social data update
				update_user_meta( $wp_id, 'woo_slg_social_data', $wp_user_data['all'] );
				update_user_meta( $wp_id, 'woo_slg_social_identifier', $wp_user_data['id'] );
				update_user_meta( $wp_id, 'woo_slg_social_user_connect_via', $wp_user_data['type'] );

				// Updating billing information
				update_user_meta( $wp_id, 'billing_first_name', $wp_user_data['first_name'] );
				update_user_meta( $wp_id, 'billing_last_name', $wp_user_data['last_name'] );

				// Updating shipping information
				update_user_meta( $wp_id, 'shipping_first_name', $wp_user_data['first_name'] );
				update_user_meta( $wp_id, 'shipping_last_name', $wp_user_data['last_name'] );

				$wpuserdetails = array (
											'ID'			=> $wp_id,
											'user_url'		=> isset( $wp_user_data['link'] ) ? $wp_user_data['link'] : '',
											'first_name'	=> isset( $wp_user_data['first_name'] ) ? $wp_user_data['first_name'] : '',
											'last_name'		=> isset( $wp_user_data['last_name'] ) ? $wp_user_data['last_name'] : '',
											'nickname'		=> isset( $wp_user_data['name'] ) ? $wp_user_data['name'] : '',
											'display_name'	=> isset( $wp_user_data['name'] ) ? $wp_user_data['name'] : ''
										);
				
				wp_update_user( $wpuserdetails );

			} else {

				$primary	= get_user_meta( $wp_id, 'woo_slg_social_user_connect_via', true );
				$secondary	= get_user_meta( $wp_id, 'woo_slg_social_'.$type.'_identifier', true );

				if( $primary != $type && $secondary != $type ) {
					
					update_user_meta( $wp_id, 'woo_slg_social_'.$type.'_data', $wp_user_data['all'] );
					update_user_meta( $wp_id, 'woo_slg_social_'.$type.'_identifier', $wp_user_data['id'] );
				}
			}

			// get primary login account
			$primary_acc = get_user_meta( $wp_id, 'woo_slg_social_user_connect_via', true );

			// check if user login via secondary account
			if( $primary_acc != $type ) {
				
				return true; 
			}

			if( class_exists( 'PeepSo' ) ) { // check if Peepso exist

				$woo_slg_peepso_avatar = get_option( 'woo_slg_allow_peepso_avatar' ); // If option to set avtar photo is checked
				$woo_slg_peepso_cover = get_option( 'woo_slg_allow_peepso_cover' ); // If option to set cover photo is checked

				$peepso_avatar_each_time = get_option( 'woo_slg_peepso_avatar_each_time' ); // If option to set avtar photo is each time
				$peepso_cover_each_time = get_option( 'woo_slg_peepso_cover_each_time' ); // If option to set cover photo each time

				$avatar_image 	= get_user_meta( $wp_id, 'woo_slg_social_avatar_img', true );
				$cover_image 	= get_user_meta( $wp_id, 'woo_slg_social_cover_img', true );

				// check if peepso avatar is enabled
				if( !empty( $woo_slg_peepso_avatar ) && $woo_slg_peepso_avatar == 'yes' ) {

					// If avatar image is empty or avatar every time option enabled
					if( empty( $avatar_image ) || $peepso_avatar_each_time == 'yes' ) {

						// Get profile image
						$avatar_image = '';
						if( $type == 'facebook' && !empty( $wp_user_data['all']['picture'] ) ){
							$avatar_image = $wp_user_data['all']['picture'];

						}elseif ( $type == 'googleplus' && !empty( $wp_user_data['all']->picture ) ){
							$avatar_image = $wp_user_data['all']->picture;

						}elseif ( $type == 'linkedin' && !empty( $wp_user_data['all']['pictureUrl'] ) ){
							$avatar_image = $wp_user_data['all']['pictureUrl'];

						}elseif ( $type == 'twitter' && !empty( $wp_user_data['all']->profile_image_url ) ){
							$avatar_image = $wp_user_data['all']->profile_image_url;

						}elseif ( $type == 'yahoo' && !empty( $wp_user_data['all']->image->imageUrl ) ){
							$avatar_image = $wp_user_data['all']->image->imageUrl;

						}elseif ( $type == 'foursquare' && !empty( $wp_user_data['all']->photo->prefix ) ){
							$image_url = $wp_user_data['all']->photo->prefix.'200x200'.$wp_user_data['all']->photo->suffix;
							$avatar_image = $image_url;

						}elseif ( $type == 'instagram' && !empty( $wp_user_data['all']->profile_picture ) ){
							$avatar_image = $wp_user_data['all']->profile_picture;

						}elseif ( $type == 'vk' && !empty( $wp_user_data['all']['photo_big'] ) ){
							$avatar_image = $wp_user_data['all']['photo_big'];

						}

						// Update meta for avatar image
						update_user_meta( $wp_id, 'woo_slg_social_avatar_img', $avatar_image );

						// set avatar to peepso avatar
						if( !empty( $avatar_image ) ) {
							woo_slg_set_peepso_avatar_img( $wp_id, $avatar_image);
						}
					}

				}

				if( !empty( $woo_slg_peepso_cover ) && $woo_slg_peepso_cover == 'yes' ){

					// If Cover image is empty or cover image every time option enabled
					if( empty( $cover_image ) || $peepso_cover_each_time == 'yes' ) {

						$cover_image = '';
						if( $type == 'facebook' && !empty( $wp_user_data['all']['cover'] ) ){
							$cover_image = $wp_user_data['all']['cover'];

						} elseif ( $type == 'twitter' && !empty( $wp_user_data['all']->profile_banner_url ) ) {
							$cover_image = $wp_user_data['all']->profile_banner_url;

						}

						// Update user meta for cover image
						update_user_meta( $wp_id, 'woo_slg_social_cover_img', $cover_image );

						// set cover image to peepso cover
						if( !empty( $cover_image ) ) {
							woo_slg_set_peepso_cover_img( $wp_id, $cover_image);
						}
					}

				}
			}

		}
	}

	/**
	 * Add User
	 * 
	 * Handles to Add user to wordpress database
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.0.0
	 */
	public function woo_slg_add_user( $userdata = array() ) {

		// register a new WordPress user
		$wp_user_data				= array();
		$wp_user_data['name']		= $userdata['name'];
		$wp_user_data['first_name']	= $userdata['first_name'];
		$wp_user_data['last_name']	= $userdata['last_name'];
		$wp_user_data['email']		= ( !empty( $userdata['email'] ) ) ? $userdata['email']:'';

		// added for vk.com
		$wp_user_data['id']		= $userdata['id'];
		$wp_user_data['type']	= $userdata['type'];

		$wp_id = $this->model->woo_slg_add_wp_user( $wp_user_data );

		return $wp_id;
	}

	/**
	 * Load Login Page For Social
	 * 
	 * Handles to load login page for social
	 * when no email address found
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.0.0
	 */
	public function woo_slg_social_login_redirect() {

		global $woo_slg_options;

		$socialtype = isset( $_GET['wooslgnetwork'] ) ? $_GET['wooslgnetwork'] : '';

		//get all social networks
		$allsocialtypes = woo_slg_social_networks();

		if( !is_user_logged_in() && isset( $_GET['woo_slg_social_login'] ) 
			&& !empty( $socialtype ) && array_key_exists( $socialtype, $allsocialtypes ) ) {

			// get redirect url from shortcode
			$stcd_redirect_url = isset($_SESSION['woo_slg_stcd_redirect_url']) ? $_SESSION['woo_slg_stcd_redirect_url'] : '';

			//check button clicked from widget then redirect to widget page url
			if( isset( $_GET['container'] ) && $_GET['container'] == 'widget' ) {

				// get redirect url from widget 
				$stcd_redirect_url = $_SESSION['woo_slg_stcd_redirect_url_widget'];
			}

			$redirect_url = !empty( $stcd_redirect_url ) ? $stcd_redirect_url : woo_slg_get_current_page_url();

			$data = array();

			//wordpress error class
			$errors = new WP_Error();

	  		switch ( $socialtype ) {

	  			case 'twitter'	:
					//get twitter user data
					$tw_userdata = $this->socialtwitter->woo_slg_get_twitter_user_data();

					//check user id is set or not for twitter
					if( !empty( $tw_userdata ) && isset( $tw_userdata->id ) && !empty( $tw_userdata->id ) ) {

						$data['first_name'] = $tw_userdata->name;
						$data['last_name'] = '';
						$data['name'] = $tw_userdata->screen_name; //display name of user
						$data['type'] = 'twitter';
						$data['all'] = $tw_userdata;
						$data['link'] = 'https://twitter.com/' . $tw_userdata->screen_name;
						$data['id']	= $tw_userdata->id;
					}
					break;
	  		}

	  		//if cart is empty or user is not logged in social media
	  		//and accessing the url then send back user to checkout page
	  		if( !isset( $data['id'] ) || empty( $data['id'] ) ) {

	  			if( isset( $_SESSION['woo']['woo_slg_stcd_redirect_url_widget'] ) ) {
	  				unset( $_SESSION['woo']['woo_slg_stcd_redirect_url_widget'] );
	  			}
				if( isset( $_SESSION['woo']['woo_slg_stcd_redirect_url'] ) ) {
					unset( $_SESSION['woo']['woo_slg_stcd_redirect_url'] );
				}
				wp_redirect( $redirect_url );
				exit;
	  		}

			//when user will click submit button of custom login
			//check user clicks submit button of registration page and get parameter should be valid param
			if( ( isset( $_POST['woo-slg-submit'] ) && !empty( $_POST['woo-slg-submit'] ) 
					&& $_POST['woo-slg-submit'] == __( 'Register', 'wooslg' ) ) ) {

				$loginurl = wp_login_url();

				if( isset( $_POST['woo_slg_social_email'] ) ) { //check email is set or not

					$socialemail = $_POST['woo_slg_social_email'];

					if ( empty( $socialemail ) ) { //if email is empty
						$errors->add( 'empty_email', '<strong>'.__( 'ERROR', 'wooslg').' :</strong> '.__( 'Enter your email address.', 'wooslg' ) );
					} elseif ( !is_email( $socialemail ) ) { //if email is not valid
						$errors->add( 'invalid_email', '<strong>'.__( 'ERROR', 'wooslg').' :</strong> '.__('The email address did not validate.', 'wooslg' ) );
						$socialemail = '';
					} elseif ( email_exists( $socialemail ) ) {//if email is exist or not

						$errors->add('email_exists', '<strong>'.__( 'ERROR', 'wooslg').' :</strong> '.__('Email already exists, If you have an account login first.', 'wooslg' ) );
					}

					if ( $errors->get_error_code() == '' ) { //

						if( !empty( $data ) ) { //check user data is not empty

			  		 		$data['email'] = $socialemail;

			  		 		//create user
			  		 		$this->woo_slg_process_profile( $data );
							//$usercreated = $this->woo_slg_add_user( $data );

				  			if( isset( $_SESSION['woo']['woo_slg_stcd_redirect_url_widget'] ) ) {
				  				unset( $_SESSION['woo']['woo_slg_stcd_redirect_url_widget'] );
				  			}
							if( isset( $_SESSION['woo']['woo_slg_stcd_redirect_url'] ) ) {
								unset( $_SESSION['woo']['woo_slg_stcd_redirect_url'] );
							}
							wp_redirect( $redirect_url );
							exit;
						}
				  	}
			  	}
			}

			//redirect user to custom registration form
			if( isset( $_GET['woo_slg_social_login'] ) && !empty( $_GET['woo_slg_social_login'] ) ) {

				//login call back url after registration
				/*$callbackurl = wp_login_url();
				$callbackurl = add_query_arg('woo_slg_social_login_done', 1, $callbackurl);*/
				$socialemail = isset( $_POST['woo_slg_social_email'] ) ? $_POST['woo_slg_social_email'] : '';

		  		//check the user who is going to connect with site
				//it is alreay exist with same data or not 
				//if user is exist then simply make that user logged in
				$metaquery = array(
            						'relation' => 'OR',
									array(
											'key'	=>	'woo_slg_social_' . $data['type'] . '_identifier',
											'value'	=>	$data['id']
										),
									array(
											'key'	=>	'woo_slg_social_identifier',
											'value'	=>	$data['id']
										)
								);

				$getusers = get_users( array( 'meta_query' => $metaquery ) );
				$wpuser = array_shift( $getusers ); //getting users

				//check user is exist or not conected with same metabox
				if( !empty( $wpuser ) ) {

					//make user logged in
					wp_set_auth_cookie( $wpuser->ID, false );

					//update last login with social account
					woo_slg_update_social_last_login_timestamp( $wpuser->ID, $socialtype );
					
		  			if( isset( $_SESSION['woo']['woo_slg_stcd_redirect_url_widget'] ) ) {
		  				unset( $_SESSION['woo']['woo_slg_stcd_redirect_url_widget'] );
		  			}
					if( isset( $_SESSION['woo']['woo_slg_stcd_redirect_url'] ) ) {
						unset( $_SESSION['woo']['woo_slg_stcd_redirect_url'] );
					}
					
					if( !empty( $_GET['page_id'] ) ) {
						
						$redirect_url = get_permalink( $_GET['page_id'] );
					}
					
					wp_redirect( $redirect_url );
					exit;
				} else {
					
					//if user is not exist then show register user form
					
					login_header(__('Registration Form', 'wooslg') , '<p class="message register">' . __('Please enter your email address to complete registration.', 'wooslg' ) . '</p>', $errors );
					
					?>
						<form name="registerform" id="registerform" action="" method="post">
							  <p>
								  <label for="wcsl_email"><?php _e( 'E-mail', 'wooslg' ); ?><br />
								  <input type="text" name="woo_slg_social_email" id="woo_slg_social_email" class="input" value="<?php  echo $socialemail ?>" size="25" tabindex="20" /></label>
							  </p>
							  <p id="reg_passmail">
							  	<?php _e( 'Username and Password will be sent to your email.', 'wooslg' ); ?>
							  </p>
							  <br class="clear" />
							  <p class="submit"><input type="submit" name="woo-slg-submit" id="woo-slg-submit" class="button-primary" value="<?php _e( 'Register', 'wooslg' ); ?>" tabindex="100" /></p>
						</form>
					<?php
					
					login_footer('user_login');
					exit;
				}
			}
		}
	}
	
	/**
	 * Handles to change avatar image if user is connected via social service
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.1
	 */
	function woo_slg_get_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
		
		$user_id = false;
		
		if ( is_numeric( $id_or_email ) ) { // If user id is there
			
			$user_id = $id_or_email;
			
		} elseif ( is_object( $id_or_email ) ) { // If data is from comment then take user id
			
			if ( !empty( $id_or_email->user_id ) ) {
				$user_id = $id_or_email->user_id;
			}
			
		} else {
			$user 		= get_user_by( 'email', $id_or_email );
			$user_id	= isset($user->ID) ? $user->ID : '';
		}
		
		// Getting profile pic
		$avatar_pic = $this->model->woo_slg_get_user_profile_pic( $user_id );
		
		if( !empty($avatar_pic) ) {
			$avatar = '<img width="'.$size.'" height="'.$size.'" class="avatar avatar-'.$size.'" src="'.$avatar_pic.'" alt="" />';
		}
		
		return $avatar;
	}

	/**
	 * AJAX Call
	 * 
	 * Handles to Call ajax for unlink  user profile
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.3.0
	 */
	public function woo_slg_social_unlink_profile() {

		//get provider
		$provider	= isset( $_POST['provider'] ) ? $_POST['provider'] : '';

		$woo_slg_profile_data	= '';
		$result	= array();
		$data	= '';

		if( is_user_logged_in()  ) { 

			// Get current user login id
			$user_id	= get_current_user_id();

			if( $user_id ) { //If user id exist
				if( !empty( $provider ) ) {
					delete_user_meta( $user_id, 'woo_slg_social_' . $provider . '_data' );
					delete_user_meta( $user_id, 'woo_slg_social_' . $provider . '_identifier' );

					delete_user_meta( $user_id, 'woo_slg_social_' . $provider . '_login_timestamp' );
					delete_user_meta( $user_id, 'woo_slg_social_' . $provider . '_login_timestamp_gmt' );
				} else { // unlink primary account from version 1.6.1
					delete_user_meta( $user_id, 'woo_slg_social_data' );
					delete_user_meta( $user_id, 'woo_slg_social_identifier' );
					delete_user_meta( $user_id, 'woo_slg_social_user_connect_via' );
				}

				ob_start();
				$this->render->woo_slg_social_profile();
				$data	= ob_get_clean();

				$messages = woo_slg_messages();
				$account_unlinked_notice	= $messages['account_unlinked_notice'] ? $messages['account_unlinked_notice'] : '';

				// display notice for unlink account
				wc_add_notice( sprintf( $account_unlinked_notice,  ucfirst( $_POST['provider'] ) ), 'notice' );

				$result	= array(
								'success'	=> 1,
								'data'		=> $data
							);
			}
		}

		echo json_encode( $result );
		exit;
	}
        
        /**
         * Process Facebook data on page load
         * 
         * This function will Save the data of facebook in database
         * 
         * @package WooCommerce Social Login
         * @since Version 1.6.4
         */
        
        public function woo_slg_process_facebook_data(){
        	global $woo_slg_options;
            if( WooSocialLoginPersistentAnonymous::get('facebook_at') ){
                $type           = "facebook";
                $usercreated    = 0;
                $userdata       = $this->socialfacebook->woo_slg_live_connect_user_fb_profile();
                if( $userdata ){
                    //check facebook user data is not empty or check social identifire for register without email
                    if (!empty($userdata) && isset($userdata['email']) || isset($userdata['id'])) { //check isset user email from facebook 
                        $data = $this->model->woo_slg_get_user_common_social_data($userdata, $type);
                    }

                    if (!empty($data)) { //If user data is not empty
                        $result = $this->woo_slg_process_profile($data);
                    }

                    if (!is_user_logged_in()) { //do action when user successfully created
                        do_action('woo_slg_social_create_user_after', $type, $usercreated);
                    }
                    
                    $current_page_url = ( !empty( $_SESSION['woo_slg_fb_redirect_url'] ) ) ? $_SESSION['woo_slg_fb_redirect_url']:site_url();

                    $redirect_url = !empty($woo_slg_options['woo_slg_redirect_url']) ? $woo_slg_options['woo_slg_redirect_url'] : $current_page_url;

                    wp_redirect( $redirect_url );exit;
                }
            }
        }

        /**
	 * Allow Social login buttons to display
	 * 
	 * Added compatibility of following theme :
	 *  - https://themeforest.net/item/workscout-job-board-wordpress-theme/13591801
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.3.0
	 */
	public function woo_slg_allw_social_login_button( $allow ) {

		//Get current theme details
		$current_theme = wp_get_theme();

		//Check current theme
		if( function_exists( 'workscout_setup' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Allow Social login buttons on login page of Wordpress
	 * 
	 * Handle login page Social login buttons based on settings
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.3.0
	 */
	public function woo_slg_social_login_buttons_on_wp_login( ) {

		//add social login buttons on wordpress login page
		add_action ( 'login_footer' , array( $this->render, 'woo_slg_social_login_buttons_on_login' ) );
	}

	/**
	 * Allow Social login buttons on register page of Wordpress
	 * 
	 * Handle register page Social login buttons based on settings
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.3.0
	 */
	public function woo_slg_social_login_buttons_on_wp_register( ) {

		//add social login buttons on wordpress login page
		add_action ( 'login_footer' , array( $this->render, 'woo_slg_social_login_buttons_on_login' ) );
	}

	/**
	 * Allow new account email to admin
	 * 
	 * Handles to send new account email to admin
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.5.6
	 */
	public function woo_slg_send_new_account_notification_admin($headers, $email_type, $object){

		// Declare prefix
		$usermeta_prefix	= WOO_SLG_USER_META_PREFIX;

		$admin_email 		= get_option('admin_email'); // Get admin email
		$allow_user_email	= get_option('woo_slg_enable_notification');
    	$allow_admin_email 	= get_option('woo_slg_send_new_account_email_to_admin'); // Check if admin email is ticked

    	/* 
    	** If admin email is not empty and
    	** if email notification type is woocommerce and
    	** if admin email option is ticked and
    	** object is instance of class user
     	*/
		if (!empty($admin_email) && $email_type == 'customer_new_account' 
			&& !empty($allow_user_email) && $allow_user_email == 'yes'
			&& !empty($allow_admin_email) && $allow_admin_email == 'yes'
			&& !empty($object) && is_object($object) && ($object instanceof WP_User) ) {

			// If meta for social login is saved
        	$user_via_scial_login = get_user_meta($object->ID, $usermeta_prefix.'by_social_login', true);
        	if(!empty($user_via_scial_login) && $user_via_scial_login == 'true') {

        		// Add admin email to BCC
        		$headers .= 'Bcc: ' . $admin_email . "\r\n";
        	}
	    }

	    return apply_filters('woo_slg_send_new_account_notification_admin', $headers, $object);
	}

	/**
	 * Upgrade database for our new options
	 * 
	 * Handles to upgrade database and save new options
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.5.6
	 */
	public function woo_slg_update_options(){

		$woo_slg_email_notification_type = get_option('woo_slg_email_notification_type');

		if(empty($woo_slg_email_notification_type)){

			$woo_slg_enable_notification = get_option('woo_slg_enable_notification');

			update_option('woo_slg_email_notification_type', 'wordpress');
			if(!empty($woo_slg_enable_notification) && $woo_slg_enable_notification == 'yes'){

				update_option('woo_slg_send_new_account_email_to_admin', 'yes');
			} else {

				update_option('woo_slg_send_new_account_email_to_admin', 'no');
			}
		}
	}

	/**
	 * Adding Hooks
	 * 
	 * Adding proper hoocks for the public pages.
	 * 
	 * @package WooCommerce - Social Login
	 * @since 1.0.0
	 */
	public function add_hooks() {
		
		global $woo_slg_options;
		

		// add action to show link up button on my account page
		
		//check is there any social media is enable or not
		if( woo_slg_check_social_enable() ) {

			$woo_social_order = get_option( 'woo_social_order' );
                        //Initializes Facebook API
			add_action( 'init', array( $this->socialfacebook, 'woo_slg_initialize_facebook' ) );
                        
                        add_action( 'init', array( $this, 'woo_slg_process_facebook_data' ) );
                        
			//Initializes Google Plus API
			add_action( 'init', array( $this->socialgoogle, 'woo_slg_initialize_google' ) );

			// add action for linkedin login
			add_action( 'init', array( $this->sociallinkedin, 'woo_slg_initialize_linkedin' ) );

			// add action for twitter login
			add_action( 'init', array( $this->socialtwitter, 'woo_slg_initialize_twitter' ) );

			// add action for yahoo login
			add_action( 'init', array( $this->socialyahoo, 'woo_slg_initialize_yahoo' ) );

			// add action for foursquare login
			add_action( 'init', array( $this->socialfoursquare, 'woo_slg_initialize_foursquare' ) );

			//add action for windows live login
			add_action( 'init', array( $this->socialwindowslive, 'woo_slg_initialize_windowslive' ) );

			// add action for vk login
			add_action( 'init', array( $this->socialvk, 'woo_slg_initialize_vk' ) );

			// add action for instagram login
			add_action( 'init', array( $this->socialinstagram, 'woo_slg_initialize_instagram' ) );
			
			// add action for amazon login
			add_action( 'init', array( $this->socialamazon, 'woo_slg_initialize_amazon' ) );
			
			// add action for amazon login
			add_action( 'init', array( $this->socialpaypal, 'woo_slg_initialize_paypal' ) );

			//check WooCommerce is activated or not
			if( class_exists( 'Woocommerce' ) ) {

	            if( $woo_slg_options['woo_slg_enable_on_checkout_page'] != "no" ) {
	                // add action to show social login form at checkout page.
	                add_action( 'woocommerce_after_template_part', array( $this->render, 'woo_slg_social_login_buttons' ) );
	            }
	
				// optional link buttons on thank you page
				add_action( 'woocommerce_before_template_part', array( $this->render, 'woo_slg_maybe_render_social_link_buttons' ) );
	
				// render login buttons on the login form
				add_action( 'woocommerce_login_form_end', array( $this->render, 'woo_slg_myaccount_social_login_buttons' ) );

				// render login buttons on the Woocommerce register page
				add_action( 'woocommerce_register_form_end', array( $this->render, 'woo_slg_on_woo_register_social_login_buttons' ) );

				// allow to add admin email in bcc
        		add_filter('woocommerce_email_headers', array( $this, 'woo_slg_send_new_account_notification_admin' ), 10, 3);
			}

			//add action to load login page
			add_action( 'login_init', array( $this, 'woo_slg_social_login_redirect' ) );

			if( !empty( $woo_social_order ) ) {
				$priority = 5;
				foreach ( $woo_social_order as $social ) {
					add_action( 'woo_slg_checkout_social_login', array( $this->render, 'woo_slg_login_'.$social ), $priority );
					$priority += 5;
				}
			}
		}

		// Filter to change the avatar image
		add_filter( 'get_avatar', array( $this, 'woo_slg_get_avatar' ), 10, 5 );

		//AJAX Call to Login Via Social Media
		add_action( 'wp_ajax_woo_slg_social_unlink_profile', array( $this, 'woo_slg_social_unlink_profile' ) );
		add_action( 'wp_ajax_nopriv_woo_slg_social_unlink_profile', array( $this, 'woo_slg_social_unlink_profile' ) );

		//AJAX Call to unlink Via Social Media
		add_action( 'wp_ajax_woo_slg_social_login', array( $this, 'woo_slg_social_login' ) );
		add_action( 'wp_ajax_nopriv_woo_slg_social_login', array( $this, 'woo_slg_social_login' ) );

		if( isset( $woo_slg_options['woo_slg_enable_wp_login_page'] ) && !empty( $woo_slg_options['woo_slg_enable_wp_login_page'] ) && $woo_slg_options['woo_slg_enable_wp_login_page'] == "yes" ) { // check enable login page buttons from settings
			add_action ( 'login_form_login' , array( $this, 'woo_slg_social_login_buttons_on_wp_login' ) );
		}

		if( isset( $woo_slg_options['woo_slg_enable_wp_register_page'] ) && !empty( $woo_slg_options['woo_slg_enable_wp_register_page'] ) && $woo_slg_options['woo_slg_enable_wp_register_page'] == "yes" ) { // check enable register page buttons from settings
			add_action ( 'login_form_register' , array( $this, 'woo_slg_social_login_buttons_on_wp_register' ) );
		}

		if( isset( $woo_slg_options['woo_slg_enable_buddypress_login_page'] ) && !empty( $woo_slg_options['woo_slg_enable_buddypress_login_page'] ) && $woo_slg_options['woo_slg_enable_buddypress_login_page'] == "yes" ) { // check enable BUddyPress login from settings

			//add social login buttons on BuddyPress login.
			add_action ( 'bp_after_login_widget_loggedout' , array( $this->render, 'woo_slg_social_login_buttons_on_login' ) );
		}

		if( isset( $woo_slg_options['woo_slg_enable_buddypress_register_page'] ) && !empty( $woo_slg_options['woo_slg_enable_buddypress_register_page'] ) && $woo_slg_options['woo_slg_enable_buddypress_register_page'] == "yes" ) { // check enable BUddyPress registration from settings

			//add social login buttons on BuddyPress registration.
			add_action ( 'bp_after_register_page' , array( $this->render, 'woo_slg_social_login_buttons_on_login' ) );
		}

		// add filter for allow social login buttons display
		add_filter( 'woo_slg_allow_social_logn_button', array( $this, 'woo_slg_allw_social_login_button' ) );

		if( isset( $woo_slg_options['woo_slg_enable_bbpress_register_page'] ) && !empty( $woo_slg_options['woo_slg_enable_bbpress_register_page'] ) && $woo_slg_options['woo_slg_enable_bbpress_register_page'] == "yes" ) { // check enable bbPress registration from settings

			// remove default wordpress register action hook
			remove_action( 'login_form_register', array( $this, 'woo_slg_social_login_buttons_on_wp_register') );

			add_action ( 'register_form' , array( $this->render, 'woo_slg_social_login_buttons_on_login' ), 999 );
		}
		if( isset( $woo_slg_options['woo_slg_enable_bbpress_login_page'] ) && !empty( $woo_slg_options['woo_slg_enable_bbpress_login_page'] ) && $woo_slg_options['woo_slg_enable_bbpress_login_page'] == "yes" ) { // check enable bbPress login from settings

			// remove default wordpress register action hook
			remove_action( 'login_form_login', array( $this, 'woo_slg_social_login_buttons_on_wp_login') );

			add_action ( 'login_form' , array( $this->render, 'woo_slg_social_login_buttons_on_login' ), 999 );
		}

        add_action('init', array($this, 'woo_slg_update_options'));

        /**
         * Check if PeepSo is installed
         * @since 1.6.3
        */
        if( class_exists( 'PeepSo' ) ) {
        	
        	// Check if Social login buttons enabled for Peepso Regitration page
        	if( !empty( $woo_slg_options['woo_slg_enable_peepso_register_page'] ) && $woo_slg_options['woo_slg_enable_peepso_register_page'] == "yes" ) {

	        	add_action('peepso_after_registration_form', array( $this->render, 'woo_slg_social_login_buttons_on_login' ) );
	    	}

	    	// Check if Social login buttons enabled for Peepso Login page
	        if( !empty( $woo_slg_options['woo_slg_enable_peepso_login_page'] ) && $woo_slg_options['woo_slg_enable_peepso_login_page'] == "yes" ) {

	        	add_action('peepso_action_render_login_form_after', array( $this->render, 'woo_slg_social_login_buttons_on_login' ) );
	    	}
	    }
        
	}
}