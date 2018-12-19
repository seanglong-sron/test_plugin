<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Amazon Tab
 * 
 * The code for the plugins settings page amazon tab
 * 
 * @package WooCommerce - Social Login
 * @since 1.6.4
 */

// Set option for default value
$woo_slg_amazon_icon_text = (!empty($woo_slg_amazon_icon_text)) ? $woo_slg_amazon_icon_text : __( 'Sign in with Amazon', 'wooslg' ) ;
$woo_slg_amazon_link_icon_text = (!empty($woo_slg_amazon_link_icon_text)) ? $woo_slg_amazon_link_icon_text : __( 'Link your account to Amazon', 'wooslg' ) ;

?>
<!-- beginning of the amazon settings meta box -->
<div id="woo-slg-amazon" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="amazon" class="postbox">
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wooslg' ); ?>"><br /></div>
					
					<!-- amazon settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Amazon Settings', 'wooslg' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							
							<?php
								// do action for add setting before amazon settings
								do_action( 'woo_slg_before_amazon_setting', $woo_slg_options );
								
							?>
							
							<tr valign="top">
								<th scope="row">
									<label><?php _e( 'Amazon Application:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( 'Before you can start using Amazon for the social login, you need to create a Amazon Application. You can get a step by step tutorial on how to create Amazon Application on our', 'wooslg' ) . ' <a target="_blank" href="http://wpweb.co.in/documents/social-network-integration/amazon/">' . __( 'Documentation', 'wooslg' ) . '</a>'; ?></span>
								</td>
							</tr>

							<tr>
								<th scope="row">
									<label for="woo_slg_enable_amazon"><?php _e( 'Enable Amazon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_enable_amazon" name="woo_slg_enable_amazon" value="1" <?php echo ($woo_slg_enable_amazon=='yes') ? 'checked="checked"' : ''; ?>/>
									<label for="woo_slg_enable_amazon"><?php echo __( 'Check this box, if you want to enable Amazon social login registration.', 'wooslg' ); ?></label>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_amazon_client_id"><?php _e( 'Amazon Client ID:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_amazon_client_id" type="text" class="regular-text" name="woo_slg_amazon_client_id" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_amazon_client_id ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Amazon Client ID.', 'wooslg'); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_amazon_client_secret"><?php _e( 'Amazon Client Secret:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_amazon_client_secret" type="text" class="regular-text" name="woo_slg_amazon_client_secret" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_amazon_client_secret ); ?>" /></br>
									<span class="description"><?php echo __( 'Enter Amazon Client Secret.', 'wooslg'); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label><?php echo __( 'Amazon Callback URL:', 'wooslg' ); ?></label>
								</th>
								<td>
									<span class="description"><?php echo __( '<code>'.WOO_SLG_AMAZON_REDIRECT_URL.'</code>', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_amazon_icon_text"><?php _e( 'Custom Amazon Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_amazon_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_amazon_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_amazon_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Amazon Text, Enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_amazon_link_icon_text"><?php _e( 'Custom Amazon Link Text:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_amazon_link_icon_text" type="text" class="regular-text woo_slg_social_btn_text" name="woo_slg_amazon_link_icon_text" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_amazon_link_icon_text ); ?>" /></br>
									<span class="description"><?php echo __( 'If you want to use your own Amazon Link Text, enter here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_amazon_icon_url"><?php _e( 'Custom Amazon Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_amazon_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_amazon_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_amazon_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Amazon Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_amazon_link_icon_url"><?php _e( 'Custom Amazon Link Icon:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input id="woo_slg_amazon_link_icon_url" type="text" class="woo_slg_social_btn_image regular-text" name="woo_slg_amazon_link_icon_url" value="<?php echo $woo_slg_model->woo_slg_escape_attr( $woo_slg_amazon_link_icon_url ); ?>" />
									<input type="button" class="woo-slg-upload-file-button button-secondary" value="<?php _e( 'Upload File', 'wooslg' );?>"/></br>
									<span class="description"><?php echo __( 'If you want to use your own Amazon Link Icon, upload one here.', 'wooslg' ); ?></span>
								</td>
							</tr>

							<!-- Amazon Settings End -->

							<!-- Page Settings End --><?php
							
							// do action for add setting after amazon settings
							do_action( 'woo_slg_after_amazon_setting', $woo_slg_options );
							
							?>
							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- .inside -->
			</div><!-- #amazon -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #woo-slg-amazon -->