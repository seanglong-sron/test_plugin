<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Facebook Tab
 * 
 * The code for the plugins settings page facebook tab
 * 
 * @package WooCommerce - Social Login
 * @since 1.6.4
 */

$select_fblanguage = array( 
	'en_US' => __( 'English', 'wooslg' ),
	'af_ZA' => __( 'Afrikaans', 'wooslg' ),
	'sq_AL' => __( 'Albanian', 'wooslg' ),
	'ar_AR' => __( 'Arabic', 'wooslg' ),
	'hy_AM' => __( 'Armenian', 'wooslg' ),
	'eu_ES' => __( 'Basque', 'wooslg' ),
	'be_BY' => __( 'Belarusian', 'wooslg' ),
	'bn_IN' => __( 'Bengali', 'wooslg' ),
	'bs_BA' => __( 'Bosanski', 'wooslg' ),
	'bg_BG' => __( 'Bulgarian', 'wooslg' ),
	'ca_ES' => __( 'Catalan', 'wooslg' ),
	'zh_CN' => __( 'Chinese', 'wooslg' ),
	'cs_CZ' => __( 'Czech', 'wooslg' ),
	'da_DK' => __( 'Danish', 'wooslg' ),
	'fy_NL' => __( 'Dutch', 'wooslg' ),
	'eo_EO' => __( 'Esperanto', 'wooslg' ),
	'et_EE' => __( 'Estonian', 'wooslg' ),
	'et_EE' => __( 'Estonian', 'wooslg' ),
	'fi_FI' => __( 'Finnish', 'wooslg' ),
	'fo_FO' => __( 'Faroese', 'wooslg' ),
	'tl_PH' => __( 'Filipino', 'wooslg' ),
	'fr_FR' => __( 'French', 'wooslg' ),
	'gl_ES' => __( 'Galician', 'wooslg' ),
	'ka_GE' => __( 'Georgian', 'wooslg' ),
	'de_DE' => __( 'German', 'wooslg' ),
	'el_GR' => __( 'Greek', 'wooslg' ),
	'he_IL' => __( 'Hebrew', 'wooslg' ),
	'hi_IN' => __( 'Hindi', 'wooslg' ),
	'hr_HR' => __( 'Hrvatski', 'wooslg' ),
	'hu_HU' => __( 'Hungarian', 'wooslg' ),
	'is_IS' => __( 'Icelandic', 'wooslg' ),
	'id_ID' => __( 'Indonesian', 'wooslg' ),
	'ga_IE' => __( 'Irish', 'wooslg' ),
	'it_IT' => __( 'Italian', 'wooslg' ),
	'ja_JP' => __( 'Japanese', 'wooslg' ),
	'ko_KR' => __( 'Korean', 'wooslg' ),
	'ku_TR' => __( 'Kurdish', 'wooslg' ),
	'la_VA' => __( 'Latin', 'wooslg' ),
	'lv_LV' => __( 'Latvian', 'wooslg' ),
	'fb_LT' => __( 'Leet Speak', 'wooslg' ),
	'lt_LT' => __( 'Lithuanian', 'wooslg' ),
	'mk_MK' => __( 'Macedonian', 'wooslg' ),
	'ms_MY' => __( 'Malay', 'wooslg' ),
	'ml_IN' => __( 'Malayalam', 'wooslg' ),
	'nl_NL' => __( 'Nederlands', 'wooslg' ),
	'ne_NP' => __( 'Nepali', 'wooslg' ),
	'nb_NO' => __( 'Norwegian', 'wooslg' ),
	'ps_AF' => __( 'Pashto', 'wooslg' ),
	'fa_IR' => __( 'Persian', 'wooslg' ),
	'pl_PL' => __( 'Polish', 'wooslg' ),
	'pt_PT' => __( 'Portugese', 'wooslg' ),
	'pt_BR' => __( 'Portuguese (Brazil)', 'wooslg' ),
	'pa_IN' => __( 'Punjabi', 'wooslg' ),
	'ro_RO' => __( 'Romanian', 'wooslg' ),
	'ru_RU' => __( 'Russian', 'wooslg' ),
	'sk_SK' => __( 'Slovak', 'wooslg' ),
	'sl_SI' => __( 'Slovenian', 'wooslg' ),
	'es_LA' => __( 'Spanish', 'wooslg' ),
	'sr_RS' => __( 'Srpski', 'wooslg' ),
	'sw_KE' => __( 'Swahili', 'wooslg' ),
	'sv_SE' => __( 'Swedish', 'wooslg' ),
	'ta_IN' => __( 'Tamil', 'wooslg' ),
	'te_IN' => __( 'Telugu', 'wooslg' ),
	'th_TH' => __( 'Thai', 'wooslg' ),
	'tr_TR' => __( 'Turkish', 'wooslg' ),
	'uk_UA' => __( 'Ukrainian', 'wooslg' ),
	'vi_VN' => __( 'Vietnamese', 'wooslg' ),
	'cy_GB' => __( 'Welsh', 'wooslg' ),
	'zh_TW' => __( 'Traditional Chinese Language', 'wooslg' )  );

$woo_slg_fb_icon_text = (!empty($woo_slg_fb_icon_text)) ? $woo_slg_fb_icon_text : __( 'Sign in with Facebook', 'wooslg' ) ;
$woo_slg_fb_link_icon_text = (!empty($woo_slg_fb_link_icon_text)) ? $woo_slg_fb_link_icon_text : __( 'Link your account to Facebook', 'wooslg' ) ;

?>
<!-- beginning of the facebook settings meta box -->
<div id="woo-slg-facebook" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="facebook" class="postbox">
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wooslg' ); ?>"><br /></div>
					
					<!-- facebook settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Facebook Settings', 'wooslg' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
						
							<?php
								// do action for add setting before facebook settings
								do_action( 'woo_slg_before_facebook_setting', $woo_slg_options );
								
							?>
							
							<tr valign="top">
								<th scope="row">
									<label><?php _e( 'Facebook Application:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( 'Before you can start using Facebook for the social login, you need to create a Facebook Application. You can get a step by step tutorial on how to create Facebook Application on our', 'wooslg' ) . ' <a target="_blank" href="http://wpweb.co.in/documents/social-network-integration/facebook/">'. __( 'Documentation', 'wooslg' ). '</a>'; ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_facebook"><?php _e( 'Enable Facebook:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_facebook" name="woo_slg_enable_facebook" value="1" <?php echo ($woo_slg_enable_facebook=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_facebook"><?php echo __( 'Check this box, if you want to enable facebook social login registration.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fb_app_id"><?php _e( 'Facebook App ID/API Key:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_fb_app_id" type="text" class="regular-text" name="woo_slg_fb_app_id" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_fb_app_id ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Facebook API Key.', 'wooslg'); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fb_app_secret"><?php _e( 'Facebook App Secret:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_fb_app_secret" type="text" class="regular-text" name="woo_slg_fb_app_secret" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_fb_app_secret ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Facebook App Secret.', 'wooslg'); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label><?php echo __( 'Facebook Valid OAuth Redirect URL:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( '<code>'.WOO_SLG_FB_REDIRECT_URL.'</code>', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fb_language"><?php echo __( 'Facebook API Locale:', 'wooslg' ); ?></label>
								</th>
								<td>
									<select name="woo_slg_fb_language" id="woo_slg_fb_language" class="wslg-select" style="max-width: 90%; width: 350px;">
										<?php foreach ( $select_fblanguage as $key => $option ) { ?>
											<option value="<?php echo $key; ?>" <?php selected( $woo_slg_fb_language, $key ); ?>>
												<?php esc_html_e( $option ); ?>
											</option>
										<?php } ?>
									</select><br />
									<span class="description"><?php echo '<br />'. __(  'Select the language for Facebook. With this option, you can explicitly tell which language you want to use for communicating with Facebook.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_fb_avatar"><?php _e( 'Enable Facebook Avatar:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_fb_avatar" name="woo_slg_enable_fb_avatar" value="1" <?php echo ($woo_slg_enable_fb_avatar=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_fb_avatar"><?php echo __( 'Check this box, if you want to use Facebook profile pictures as avatars.', 'wooslg' ); ?></label>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fb_icon_url"><?php _e( 'Custom Facebook Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_fb_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_fb_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_fb_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Facebook Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fb_link_icon_url"><?php _e( 'Custom Facebook Link Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_fb_link_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_fb_link_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_fb_link_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Facebook Link Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fb_icon_text"><?php _e( 'Custom Facebook Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_fb_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_fb_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_fb_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Facebook Text, Enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fb_link_icon_text"><?php _e( 'Custom Facebook Link Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_fb_link_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_fb_link_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_fb_link_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Facebook Link Text, enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<!-- Facebook Settings End -->

							<!-- Page Settings End --><?php
							
							// do action for add setting after facebook settings
							do_action( 'woo_slg_after_facebook_setting', $woo_slg_options );
							
							?>
							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- .inside -->
			</div><!-- #facebook -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #woo-slg-facebook -->