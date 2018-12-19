<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Yahoo Tab
 * 
 * The code for the plugins settings page Yahoo tab
 * 
 * @package WooCommerce - Social Login
 * @since 1.6.4
 */

// Set option for default value
$woo_slg_yh_icon_text = (!empty($woo_slg_yh_icon_text)) ? $woo_slg_yh_icon_text : __( 'Sign in with Yahoo', 'wooslg' ) ;
$woo_slg_yh_link_icon_text = (!empty($woo_slg_yh_link_icon_text)) ? $woo_slg_yh_link_icon_text : __( 'Link your account to Yahoo', 'wooslg' ) ;

?>
<!-- beginning of the yahoo settings meta box -->
<div id="woo-slg-yahoo" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="yahoo" class="postbox">
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wooslg' ); ?>"><br /></div>
					
					<!-- yahoo settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Yahoo Settings', 'wooslg' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							
							<?php
								// do action for add setting before Yahoo settings
								do_action( 'woo_slg_before_yahoo_setting', $woo_slg_options );
								
							?>
							
							<tr valign="top">
								<th scope="row">
									<label><?php _e( 'Yahoo Application:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( 'Before you can start using Yahoo for the social login, you need to create a Yahoo Application. You can get a step by step tutorial on how to create Yahoo Application on our', 'wooslg' ) . ' <a target="_blank" href="http://wpweb.co.in/documents/social-network-integration/yahoo/">' . __( 'Documentation', 'wooslg' ) . '</a>'; ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_yahoo"><?php _e( 'Enable Yahoo:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_yahoo" name="woo_slg_enable_yahoo" value="1" <?php echo ($woo_slg_enable_yahoo=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_yahoo"><?php echo __( 'Check this box, if you want to enable Yahoo social login registration.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_yh_consumer_key"><?php _e( 'Yahoo Consumer Key:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_yh_consumer_key" type="text" class="regular-text" name="woo_slg_yh_consumer_key" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_yh_consumer_key ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Yahoo Consumer Key.', 'wooslg'); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_yh_consumer_secret"><?php _e( 'Yahoo Consumer Secret:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_yh_consumer_secret" type="text" class="regular-text" name="woo_slg_yh_consumer_secret" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_yh_consumer_secret ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Yahoo Consumer Secret.', 'wooslg'); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_yh_app_id"><?php _e( 'Yahoo App Id:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_yh_app_id" type="text" class="regular-text" name="woo_slg_yh_app_id" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_yh_app_id ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Yahoo App Id.', 'wooslg'); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label ><?php echo __( 'Yahoo Home Page URL:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( '<code>'.WOO_SLG_YH_REDIRECT_URL.'</code>', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_yh_avatar"><?php _e( 'Enable Yahoo Avatar:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_yh_avatar" name="woo_slg_enable_yh_avatar" value="1" <?php echo ($woo_slg_enable_yh_avatar=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_yh_avatar"><?php echo __( 'Check this box, if you want to use Yahoo profile pictures as avatars.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_yh_icon_text"><?php _e( 'Custom Yahoo Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_yh_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_yh_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_yh_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Yahoo Text, Enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_yh_link_icon_text"><?php _e( 'Custom Yahoo Link Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_yh_link_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_yh_link_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_yh_link_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Yahoo Link Text, enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_yh_icon_url"><?php _e( 'Custom Yahoo Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_yh_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_yh_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_yh_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Yahoo Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_yh_link_icon_url"><?php _e( 'Custom Yahoo Link Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_yh_link_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_yh_link_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_yh_link_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Yahoo Link Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<!-- Yahoo Settings End -->

							<!-- Page Settings End --><?php
							
							// do action for add setting after Yahoo settings
							do_action( 'woo_slg_after_yahoo_setting', $woo_slg_options );
							
							?>
							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- .inside -->
			</div><!-- #yahoo -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #woo-slg-yahoo -->