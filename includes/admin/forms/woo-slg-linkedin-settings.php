<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page LinkedIn Tab
 * 
 * The code for the plugins settings page linkedin tab
 * 
 * @package WooCommerce - Social Login
 * @since 1.6.4
 */

// Set option for default value
$woo_slg_li_icon_text = (!empty($woo_slg_li_icon_text)) ? $woo_slg_li_icon_text : __( 'Sign in with LinkedIn', 'wooslg' ) ;
$woo_slg_li_link_icon_text = (!empty($woo_slg_li_link_icon_text)) ? $woo_slg_li_link_icon_text : __( 'Link your account to LinkedIn', 'wooslg' ) ;

?>
<!-- beginning of the linkedin settings meta box -->
<div id="woo-slg-linkedin" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="linkedin" class="postbox">
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wooslg' ); ?>"><br /></div>
					
					<!-- linkedin settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'LinkedIn Settings', 'wooslg' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							
							<?php
								// do action for add setting before linkedin settings
								do_action( 'woo_slg_before_linkedin_setting', $woo_slg_options );
								
							?>
							
							<tr valign="top">
								<th scope="row">
									<label><?php _e( 'LinkedIn Application:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( 'Before you can start using LinkedIn for the social login, you need to create a LinkedIn Application. You can get a step by step tutorial on how to create LinkedIn Application on our', 'wooslg' ) . ' <a target="_blank" href="http://wpweb.co.in/documents/social-network-integration/linkedin/">' . __( 'Documentation', 'wooslg' ) . '</a>'; ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_linkedin"><?php _e( 'Enable LinkedIn:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_linkedin" name="woo_slg_enable_linkedin" value="1" <?php echo ($woo_slg_enable_linkedin=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_linkedin"><?php echo __( 'Check this box, if you want to enable LinkedIn social login registration.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_li_app_id"><?php _e( 'LinkedIn App ID/API Key:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_li_app_id" type="text" class="regular-text" name="woo_slg_li_app_id" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_li_app_id ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter LinkedIn App ID/API Key.', 'wooslg'); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_li_app_secret"><?php _e( 'LinkedIn App Secret:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_li_app_secret" type="text" class="regular-text" name="woo_slg_li_app_secret" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_li_app_secret ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter LinkedIn App Secret.', 'wooslg'); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_li_redirect_url"><?php echo __( 'LinkedIn Callback URL:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( '<code>'.WOO_SLG_LI_REDIRECT_URL.'</code>', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_li_avatar"><?php _e( 'Enable LinkedIn Avatar:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_li_avatar" name="woo_slg_enable_li_avatar" value="1" <?php echo ($woo_slg_enable_li_avatar=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_li_avatar"><?php echo __( 'Check this box, if you want to use LinkedIn profile pictures as avatars.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_li_icon_text"><?php _e( 'Custom LinkedIn Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_li_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_li_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_li_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own LinkedIn Text, Enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_li_link_icon_text"><?php _e( 'Custom LinkedIn Link Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_li_link_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_li_link_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_li_link_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own LinkedIn Link Text, enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_li_icon_url"><?php _e( 'Custom LinkedIn Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_li_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_li_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_li_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own LinkedIn Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_li_link_icon_url"><?php _e( 'Custom LinkedIn Link Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_li_link_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_li_link_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_li_link_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own LinkedIn Link Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<!-- LinkedIn Settings End -->

							<!-- Page Settings End --><?php
							
							// do action for add setting after linkedin settings
							do_action( 'woo_slg_after_linkedin_setting', $woo_slg_options );
							
							?>
							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- .inside -->
			</div><!-- #linkedin -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #woo-slg-linkedin -->