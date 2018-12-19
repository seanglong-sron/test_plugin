<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Twitter Tab
 * 
 * The code for the plugins settings page twitter tab
 * 
 * @package WooCommerce - Social Login
 * @since 1.6.4
 */

// Get twitter options 
$woo_slg_twitter_options = array(
	'woo_slg_enable_twitter',
	'woo_slg_tw_consumer_key',
	'woo_slg_tw_consumer_secret',
	'woo_slg_enable_tw_avatar',
	'woo_slg_tw_icon_text',
	'woo_slg_tw_link_icon_text',
	'woo_slg_tw_icon_url',
	'woo_slg_tw_link_icon_url'
);

// Get option value
foreach ($woo_slg_twitter_options as $woo_slg_option_key) {

	$$woo_slg_option_key = get_option( $woo_slg_option_key );
}

// Set option for default value
$woo_slg_tw_icon_text = (!empty($woo_slg_tw_icon_text)) ? $woo_slg_tw_icon_text : __( 'Sign in with Twitter', 'wooslg' ) ;
$woo_slg_tw_link_icon_text = (!empty($woo_slg_tw_link_icon_text)) ? $woo_slg_tw_link_icon_text : __( 'Link your account to Twitter', 'wooslg' ) ;

?>
<!-- beginning of the twitter settings meta box -->
<div id="woo-slg-twitter" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="twitter" class="postbox">
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wooslg' ); ?>"><br /></div>
					
					<!-- twitter settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Twitter Settings', 'wooslg' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							
							<?php
								// do action for add setting before twitter settings
								do_action( 'woo_slg_before_twitter_setting' );
								
							?>
							
							<tr valign="top">
								<th scope="row">
									<label><?php _e( 'Twitter Application:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( 'Before you can start using Twitter for the social login, you need to create a Twitter Application. You can get a step by step tutorial on how to create Twitter Application on our', 'wooslg' ) . ' <a target="_blank" href="http://wpweb.co.in/documents/social-network-integration/twitter/">' . __( 'Documentation', 'wooslg' ) . '</a>'; ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_twitter"><?php _e( 'Enable Twitter:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_twitter" name="woo_slg_enable_twitter" value="1" <?php echo ($woo_slg_enable_twitter=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_twitter"><?php echo __( 'Check this box, if you want to enable Twitter social login registration.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_tw_consumer_key"><?php _e( 'Twitter API Key:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_tw_consumer_key" type="text" class="regular-text" name="woo_slg_tw_consumer_key" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_tw_consumer_key ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Twitter API Key.', 'wooslg'); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_tw_consumer_secret"><?php _e( 'Twitter API Secret:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_tw_consumer_secret" type="text" class="regular-text" name="woo_slg_tw_consumer_secret" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_tw_consumer_secret ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Twitter API Secret.', 'wooslg'); ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_tw_avatar"><?php _e( 'Enable Twitter Avatar:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_tw_avatar" name="woo_slg_enable_tw_avatar" value="1" <?php echo ($woo_slg_enable_tw_avatar=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_tw_avatar"><?php echo __( 'Check this box, if you want to use Twitter profile pictures as avatars.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_tw_icon_text"><?php _e( 'Custom Twitter Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_tw_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_tw_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_tw_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Twitter Text, Enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_tw_link_icon_text"><?php _e( 'Custom Twitter Link Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_tw_link_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_tw_link_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_tw_link_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Twitter Link Text, enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_tw_icon_url"><?php _e( 'Custom Twitter Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_tw_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_tw_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_tw_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Twitter Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_tw_link_icon_url"><?php _e( 'Custom Twitter Link Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_tw_link_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_tw_link_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_tw_link_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Twitter Link Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<!-- Twitter Settings End -->

							<!-- Page Settings End --><?php
							
							// do action for add setting after twitter settings
							do_action( 'woo_slg_after_twitter_setting' );
							
							?>
							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- .inside -->
			</div><!-- #twitter -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #woo-slg-twitter -->