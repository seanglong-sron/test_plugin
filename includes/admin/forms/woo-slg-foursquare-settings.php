<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Foursquare Tab
 * 
 * The code for the plugins settings page foursquare tab
 * 
 * @package WooCommerce - Social Login
 * @since 1.6.4
 */

// Set option for default value
$woo_slg_fs_icon_text = (!empty($woo_slg_fs_icon_text)) ? $woo_slg_fs_icon_text : __( 'Sign in with Foursquare', 'wooslg' ) ;
$woo_slg_fs_link_icon_text = (!empty($woo_slg_fs_link_icon_text)) ? $woo_slg_fs_link_icon_text : __( 'Link your account to Foursquare', 'wooslg' ) ;

?>
<!-- beginning of the foursquare settings meta box -->
<div id="woo-slg-foursquare" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="foursquare" class="postbox">
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wooslg' ); ?>"><br /></div>
					
					<!-- foursquare settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Foursquare Settings', 'wooslg' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							
							<?php
								// do action for add setting before foursquare settings
								do_action( 'woo_slg_before_foursquare_setting', $woo_slg_options );
								
							?>
							
							<tr valign="top">
								<th scope="row">
									<label><?php _e( 'Foursquare Application:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( 'Before you can start using Foursquare for the social login, you need to create a Foursquare Application. You can get a step by step tutorial on how to create Foursquare Application on our', 'wooslg' ) . ' <a target="_blank" href="http://wpweb.co.in/documents/social-network-integration/foursquare/">' . __( 'Documentation', 'wooslg' ) . '</a>'; ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_foursquare"><?php _e( 'Enable Foursquare:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_foursquare" name="woo_slg_enable_foursquare" value="1" <?php echo ($woo_slg_enable_foursquare=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_foursquare"><?php echo __( 'Check this box, if you want to enable Foursquare social login registration.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fs_client_id"><?php _e( 'Foursquare Client ID:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_fs_client_id" type="text" class="regular-text" name="woo_slg_fs_client_id" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_fs_client_id ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Foursquare Client ID.', 'wooslg'); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fs_client_secret"><?php _e( 'Foursquare Client Secret:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_fs_client_secret" type="text" class="regular-text" name="woo_slg_fs_client_secret" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_fs_client_secret ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Foursquare Client Secret.', 'wooslg'); ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_fs_avatar"><?php _e( 'Enable Foursquare Avatar:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_fs_avatar" name="woo_slg_enable_fs_avatar" value="1" <?php echo ($woo_slg_enable_fs_avatar=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_fs_avatar"><?php echo __( 'Check this box, if you want to use Foursquare profile pictures as avatars.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fs_icon_text"><?php _e( 'Custom Foursquare Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_fs_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_fs_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_fs_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Foursquare Text, Enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fs_link_icon_text"><?php _e( 'Custom Foursquare Link Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_fs_link_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_fs_link_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_fs_link_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Foursquare Link Text, enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fs_icon_url"><?php _e( 'Custom Foursquare Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_fs_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_fs_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_fs_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Foursquare Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_fs_link_icon_url"><?php _e( 'Custom Foursquare Link Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_fs_link_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_fs_link_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_fs_link_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Foursquare Link Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<!-- Foursquare Settings End -->

							<!-- Page Settings End --><?php
							
							// do action for add setting after foursquare settings
							do_action( 'woo_slg_after_foursquare_setting', $woo_slg_options );
							
							?>
							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- .inside -->
			</div><!-- #foursquare -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #woo-slg-foursquare -->