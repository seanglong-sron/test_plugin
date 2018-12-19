<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Windows Live Tab
 * 
 * The code for the plugins settings page Windows Live tab
 * 
 * @package WooCommerce - Social Login
 * @since 1.6.4
 */

// Set option for default value
$woo_slg_wl_icon_text = (!empty($woo_slg_wl_icon_text)) ? $woo_slg_wl_icon_text : __( 'Sign in with Windows Live', 'wooslg' ) ;
$woo_slg_wl_link_icon_text = (!empty($woo_slg_wl_link_icon_text)) ? $woo_slg_wl_link_icon_text : __( 'Link your account to Windows Live', 'wooslg' ) ;

?>
<!-- beginning of the Windows Live settings meta box -->
<div id="woo-slg-windows-live" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="windows-live" class="postbox">
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wooslg' ); ?>"><br /></div>
					
					<!-- Windows Live settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Windows Live Settings', 'wooslg' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							
							<?php
								// do action for add setting before Windows Live settings
								do_action( 'woo_slg_before_windows_live_setting', $woo_slg_options );
								
							?>
							
							<tr valign="top">
								<th scope="row">
									<label><?php _e( 'Windows Live Application:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( 'Before you can start using Windows Live for the social login, you need to create a Windows Live Application. You can get a step by step tutorial on how to create Windows Live Application on our', 'wooslg' ) . ' <a target="_blank" href="http://wpweb.co.in/documents/social-network-integration/windows_live/">' . __( 'Documentation', 'wooslg' ) . '</a>'; ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_windowslive"><?php _e( 'Enable Windows Live:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_windowslive" name="woo_slg_enable_windowslive" value="1" <?php echo ($woo_slg_enable_windowslive=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_windowslive"><?php echo __( 'Check this box, if you want to enable Windows Live social login registration.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_wl_client_id"><?php _e( 'Windows Live Client ID:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_wl_client_id" type="text" class="regular-text" name="woo_slg_wl_client_id" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_wl_client_id ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Windows Live Client ID.', 'wooslg'); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_wl_client_secret"><?php _e( 'Windows Live Client Secret:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_wl_client_secret" type="text" class="regular-text" name="woo_slg_wl_client_secret" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_wl_client_secret ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Windows Live Client Secret.', 'wooslg'); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_li_redirect_url"><?php echo __( 'Windows Live Callback URL:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( '<code>'.site_url().'</code>', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_wl_icon_text"><?php _e( 'Custom Windows Live Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_wl_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_wl_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_wl_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Windows Live Text, Enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_wl_link_icon_text"><?php _e( 'Custom Windows Live Link Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_wl_link_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_wl_link_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_wl_link_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Windows Live Link Text, enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_wl_icon_url"><?php _e( 'Custom Windows Live Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_wl_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_wl_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_wl_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Windows Live Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_wl_link_icon_url"><?php _e( 'Custom Windows Live Link Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_wl_link_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_wl_link_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_wl_link_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Windows Live Link Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<!-- Windows Live Settings End -->

							<!-- Page Settings End --><?php
							
							// do action for add setting after Windows Live settings
							do_action( 'woo_slg_after_windows_live_setting', $woo_slg_options );
							
							?>
							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- .inside -->
			</div><!-- #windows-live -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #woo-slg-windows-live -->