<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page Misc Tab
 * 
 * The code for the plugins settings page misc tab
 * 
 * @package WooCommerce - Social Login
 * @since 1.6.4
 */

// Get misc options 
$woo_slg_delete_options = get_option( 'woo_slg_delete_options' );

?>
<!-- beginning of the misc settings meta box -->
<div id="woo-slg-misc" class="post-box-container">
	<div class="metabox-holder">
		<div class="meta-box-sortables ui-sortable">
			<div id="misc" class="postbox">
				<div class="handlediv" title="<?php _e( 'Click to toggle', 'wooslg' ); ?>"><br /></div>
					
					<!-- misc settings box title -->
					<h3 class="hndle">
						<span style='vertical-align: top;'><?php _e( 'Misc Settings', 'wooslg' ); ?></span>
					</h3>

					<div class="inside">
					
					<table class="form-table">
						<tbody>
							
							<?php
								// do action for add setting before misc settings
								do_action( 'woo_slg_before_misc_setting', $woo_slg_options );
								
							?>

							<tr>
								<th scope="row">
									<label for="woo_slg_delete_options"><?php _e( 'Delete Options:', 'wooslg' ); ?></label>
								</th>
								<td>
									<input type="checkbox" id="woo_slg_delete_options" name="woo_slg_delete_options" value="1" <?php echo ($woo_slg_delete_options=='yes') ? 'checked="checked"' : ''; ?>/></br>
									<span class="description"><label for="woo_slg_delete_options"><?php echo __( 'If you don\'t want to use the Social Login Plugin on your site anymore, you can check that box. This makes sure, that all the settings and tables are being deleted from the database when you deactivate the plugin.','wooslg' ); ?></label></span>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">
									<label for="woo_slg_gen_sys_log"><?php _e( 'System Report:', 'wooslg' ); ?></label>
								</th>
								<td>
									<a class="button" href="<?php echo add_query_arg(array( 'woo_slg_gen_sys_log' => '1')); ?>" ><?php echo __( 'Generate System Report', 'wooslg' ); ?></a></br>
									<span class="description"><?php echo __( 'Please generate system report file and provide us in your ticket when contacting support.','wooslg' ); ?></span>
								</td>
							</tr>
							
							<!-- Misc Settings End -->

							<!-- Page Settings End --><?php
							
							// do action for add setting after misc settings
							do_action( 'woo_slg_after_misc_setting', $woo_slg_options );
							
							?>
							<tr>
								<td colspan="2"><?php
									echo apply_filters ( 'woo_slg_settings_submit_button', '<input class="button-primary woo-slg-save-btn" type="submit" name="woo-slg-set-submit" value="'.__( 'Save Changes','wooslg' ).'" />' );?>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- .inside -->
			</div><!-- #misc -->
		</div><!-- .meta-box-sortables ui-sortable -->
	</div><!-- .metabox-holder -->
</div><!-- #woo-slg-misc -->