<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Google+ Tab
 * 
 * The code for the plugins settings page google plus tab
 * 
 * @package WooCommerce - Social Login
 * @since 1.6.4
 */

// Set option for default value
$woo_slg_gp_icon_text = (!empty($woo_slg_gp_icon_text)) ? $woo_slg_gp_icon_text : __( 'Sign in with Google+', 'wooslg' ) ;
$woo_slg_gp_link_icon_text = (!empty($woo_slg_gp_link_icon_text)) ? $woo_slg_gp_link_icon_text : __( 'Link your account to Google+', 'wooslg' ) ;

?>
<!-- beginning of the google_plus settings meta box -->
<div id="woo-slg-google-plus" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="google_plus" class="postbox">
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wooslg' ); ?>"><br /></div>
					
					<!-- google_plus settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Google+ Settings', 'wooslg' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							
							<?php
								// do action for add setting before google plus settings
								do_action( 'woo_slg_before_google_plus_setting', $woo_slg_options );
								
							?>
							
							<tr valign="top">
								<th scope="row">
									<label><?php _e( 'Google+ Application:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( 'Before you can start using Google+ for the social login, you need to create a Google+ Application. You can get a step by step tutorial on how to create Google+ Application on our', 'wooslg' ) . ' <a target="_blank" href="http://wpweb.co.in/documents/social-network-integration/google/">' . __( 'Documentation', 'wooslg' ) . '</a>'; ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_googleplus"><?php _e( 'Enable Google+:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_googleplus" name="woo_slg_enable_googleplus" value="1" <?php echo ($woo_slg_enable_googleplus=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_googleplus"><?php echo __( 'Check this box, if you want to enable google+ social login registration.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_gp_client_id"><?php _e( 'Google+ Client ID:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_gp_client_id" type="text" class="regular-text" name="woo_slg_gp_client_id" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_gp_client_id ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Google+ Client ID.', 'wooslg'); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_gp_client_secret"><?php _e( 'Google+ Client Secret:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_gp_client_secret" type="text" class="regular-text" name="woo_slg_gp_client_secret" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_gp_client_secret ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Google+ Client Secret.', 'wooslg'); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_gp_redirect_url"><?php echo __( 'Google+ Callback URL:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( '<code>'.WOO_SLG_GP_REDIRECT_URL.'</code>', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_gp_avatar"><?php _e( 'Enable Google Plus Avatar:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_gp_avatar" name="woo_slg_enable_gp_avatar" value="1" <?php echo ($woo_slg_enable_gp_avatar=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_gp_avatar"><?php echo __( 'Check this box, if you want to use Google Plus profile pictures as avatars.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_gp_icon_text"><?php _e( 'Custom Google+ Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_gp_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_gp_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_gp_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Google+ Text, Enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_gp_link_icon_text"><?php _e( 'Custom Google+ Link Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_gp_link_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_gp_link_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_gp_link_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Google+ Link Text, enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_gp_icon_url"><?php _e( 'Custom Google+ Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_gp_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_gp_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_gp_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Google+ Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_gp_link_icon_url"><?php _e( 'Custom Google+ Link Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_gp_link_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_gp_link_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_gp_link_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Google+ Link Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<!-- Google+ Settings End -->

							<!-- Page Settings End --><?php
							
							// do action for add setting after google plus settings
							do_action( 'woo_slg_after_google_plus_setting', $woo_slg_options );
							
							?>
							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- .inside -->
			</div><!-- #google_plus -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #woo-slg-google-plus -->