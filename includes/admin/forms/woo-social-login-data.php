<?php
/**
 * Social Login Data
 * 
 * Handles to show social login data
 * on the page
 * 
 * @package WPSocial Deals Engine
 * @since 1.0.0
 */

	global $woo_slg_model, $woo_slg_options;
	
	//social model class
	$model = $woo_slg_model;
?>

<div class="wrap">
	
	<!-- wpweb logo -->
	<img src="<?php echo WOO_SLG_IMG_URL . '/wpweb-logo.png'; ?>" class="woo-slg-wpweb-logo" alt="<?php _e( 'WP Web Logo', 'wooslg' );?>" />
	
	<h2 class="woo-slg-settings-title"><?php _e( 'Social Login - Statistics', 'wooslg' ); ?></h2>
	
	<?php
	
		//save order of social networks
		if( isset( $_POST['woo-slg-settings-social-submit'] ) && $_POST['woo-slg-settings-social-submit'] == __('Save Changes','wooslg') ) {
			
			$woo_social_order = $_POST['social_order'];			
			
			update_option( 'woo_social_order', $woo_social_order );		

			//Update global variable when update settings
			$woo_slg_options = woo_slg_global_settings();		
			
			echo '<div id="message" class="updated fade below-h2">
						<p><strong>'.__( 'Changes Saved.','wooslg').'</strong></p>
				  </div>';
		}
	?>
	
	<form action="" method="POST">
		<h3><?php _e( 'Drag to Change Order', 'wooslg' );?></h3>
		<p><?php _e('Drag and drop the below providers to control their display order.', 'wooslg'); ?></p>
		<table class="woo-slg-sortable widefat">
			<thead>
				<tr>
					<th width="3%"></th>
					<th width="1%" class="woo-slg-social-none"><?php _e('Change Order', 'wooslg'); ?></th>
					<?php
						//do action to add header before
						do_action( 'woo_slg_social_table_header_change_order_before' );
					?>
					<th class="col-network"><?php _e( 'Network', 'wooslg');?></th>
					<?php
						//do action to add social table header network after
						do_action( 'woo_slg_social_table_header_network_before' );
					?>
					<th class="col-register-count"><?php _e( 'Register Count', 'wooslg');?></th>
					<?php
						//do action to add social table header after
						do_action( 'woo_slg_social_table_header_register_count_before' );
					?>
					<th class="col-status"><?php _e( 'Status', 'wooslg');?></th>
					<?php
						//do action to add social table header status after
						do_action( 'woo_slg_social_table_header_status_before' );
					?>
					<th class="col-setting"></th>
					<?php
						//do action to add social table header settings after
						do_action( 'woo_slg_social_table_header_settings_after' );
					?>
				</tr>
			</thead>
			<tbody>
				<?php
					//do action to add social table content before
					do_action( 'woo_slg_social_table_content_before' );
					
					//get all social networks
					$allnetworks = woo_slg_get_sorted_social_network();
					
					//register user count
					$regusers = array();
					
					foreach ( $allnetworks as $key => $value ) {

						$countargs = array( 
											'getcount' =>	'1',
											'network'	=>	$key 
										  );
						$regusers[$key]['count'] = $model->woo_slg_social_get_users( $countargs );
						$regusers[$key]['label'] = $value;

						$is_network_activated = get_option('woo_slg_enable_'.$key);

						$settings_url_key = $key;

						$redirect_uri = add_query_arg(	
														array(
																'page' 		=> 'woo-social-settings',
																'tab'		=> $settings_url_key
														), esc_html( admin_url( 'admin.php' ) )
													);
				?>
					<tr>
						<?php
							//do action to add social table data before
							do_action( 'woo_slg_social_table_data_before', $key, $value );
						?>
						<td class="woo-slg-table-col"><img class='woo-slg-drag-drop-menu' src="<?php echo WOO_SLG_IMG_URL.'/backend/menu.png'; ?>" title="<?php _e('Drag & Drop', 'wooslg'); ?>"></td>
						<td width="1%" class="woo-slg-social-none">
							<input type="hidden" name="social_order[]" value="<?php echo $key;?>" />
						</td>
						<?php
							//do action to add social icon after
							do_action( 'woo_slg_social_table_data_icon_after', $key, $value );
						?>
						<td class="woo-slg-netowrk-<?php echo $key; ?> woo-slg-table-col"><img src="<?php echo WOO_SLG_IMG_URL.'/backend/images/'.$key.'.png';?>" alt="<?php echo $value;?>" /></td>
						<?php
							//do action to add social table data network
							do_action( 'woo_slg_social_table_data_network_after', $key, $value );
						?>
						<td class="woo-slg-table-col reg-count-label"><?php echo $regusers[$key]['count'];?></td>
						<?php
							//do action to add social table data reg count after
							do_action( 'woo_slg_social_table_data_reg_count_after', $key, $value );
						?>
						<td class="woo-slg-table-col">
							<?php
								// Show tick if network is activated else show -
								if(!empty($is_network_activated) && $is_network_activated == 'yes') {
									echo "<img class='woo-slg-network-activated' src='" . WOO_SLG_IMG_URL.'/backend/check-mark.png' . "' alt='" . $value . "' />";
								} else {
									_e('-', 'wooslg');
								}
							?>
						</td>
						<?php
							//do action to add social table header status after
							do_action( 'woo_slg_social_table_data_status_after' );
						?>
						<td><a href="<?php echo $redirect_uri ?>" class="button"><?php _e('Settings', 'wooslg'); ?></a></td>
						<?php
							//do action to add social table data reg count after
							do_action( 'woo_slg_social_table_data_reg_settings_after', $key, $value );
						?>
					</tr>
			<?php	
					}
					
					//do action to add social table content after
					do_action( 'woo_slg_social_table_content_after' );
			?>
			</tbody>
			<tfoot>
				<tr>
					<th width="3%"></th>
					<th class="col-network"><?php _e( 'Network', 'wooslg');?></th>
					<th width="1%" class="woo-slg-social-none"><?php _e('Chage Order', 'wooslg'); ?></th>
					<?php
						//do action to add footer before
						do_action( 'woo_slg_social_table_footer_change_order_after' );
					?>
					<th class="col-register-count"><?php _e( 'Register Count', 'wooslg');?></th>
					<?php
						//do action to add social table footer network after
						do_action( 'woo_slg_social_table_foooter_network_after' );
					?>
					<th class="col-status"><?php _e( 'Status', 'wooslg');?></th>
					<?php
						//do action to add social table header status after
						do_action( 'woo_slg_social_table_header_status_after' );
					?>
					<?php
						//do action to add social table footer after
						do_action( 'woo_slg_social_table_footer_register_count_after' );
					?>
					<th></th>
					<?php
						//do action to add social table footer settings after
						do_action( 'woo_slg_social_table_footer_settings_after' );
					?>
				</tr>
			</tfoot>
		</table>
		
		<?php
				//do action to add social table after
				do_action( 'woo_slg_social_data_table_after' );
				
				echo apply_filters ( 
							 	'woo_slg_social_submit_button', 
							 	'<input type="submit" id="woo-slg-settings-social-submit" name="woo-slg-settings-social-submit" class="woo-slg-social-submit button-primary" value="'.__('Save Changes','wooslg').'" />'
							);
		?>		
	</form><br/>
	<h3><?php _e( 'Social Networks Registeration Pie Graph', 'wooslg' );?></h3>
	<?php
		$colors = array(
						'facebook'		=>	'A200C2',
						'twitter'		=>	'46c0FB',
						'googleplus'	=>	'0083A8',
						'linkedin'		=>	'4E6CF7',
						'yahoo'			=>	'4863AE',
						'foursquare'	=>	'44A8E0',
						'vk'			=>	'4A63A3',
						'instagram'		=>	'A67C66'
					);
		//applying filter for chart color
		$colors = apply_filters( 'woo_slg_social_chart_colors', $colors );
		
		foreach( $regusers as $key => $val ){
			if( $val['count']== 0 ){
				unset( $regusers[$key] );
				unset( $colors[$key] );
			}
		}
	?>
	<script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback( WooSlgDrawChart );

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function WooSlgDrawChart() {
		
	      	<?php
	      		$datarows = '';
	      		foreach( $regusers as $key => $val ){
					$count = $val['count'];
					$datarows .= "['".$val['label']."', $count], ";
				}
				$datarows = trim( $datarows, ',');
	      	?>
      	
	        // Create the data table.
	        var deals_social_data = new google.visualization.DataTable();
	        deals_social_data.addColumn('string', 'Topping');
	        deals_social_data.addColumn('number', 'Slices');
	        deals_social_data.addRows([<?php echo $datarows;?>]);
	        
	        // Set chart options
	        var deals_social_chart_options = {
	        				'title':'<?php _e('Social Networks Register Percentage', 'wooslg'); ?>',
	                       	'width':650,
	                       	'height':450
	        			}; 
	
	        // Instantiate and draw our chart, passing in some options.
	        var deals_social_chart = new google.visualization.PieChart(document.getElementById('woo_slg_social_chart_element'));
	        deals_social_chart.draw(deals_social_data, deals_social_chart_options );
      }
    </script>
	<div id="woo_slg_social_chart_element" class="woo-slg-social-chart-container"></div><!--.woo-slg-social-chart-container-->
	
</div><!--wrap-->