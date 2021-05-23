<?php
/**
 * Request Form Display Entrie
 * 
 * @package 	Wordpress_Comparison_Plugin
 * @subpackage 	Wordpress_Comparison_Plugin/admin
 * @since 		1.1.2.1
 * @author 		Netseek Pty Ltd
 */
?>
<div class="navigation-bar-wcp-settings d-flex justify-content-between">
	<div class="tab-title"><?php echo esc_html( get_admin_page_title() ); ?></div>
	<?php $logo = plugin_dir_url( __FILE__ ).'assets/images/wcp-logo.png'; ?>
	<a href="https://wordpresscomparisonplugin.com/" target="_blank"><img src="<?php echo $logo;?>" alt="" class="wcp-logo"></a>
</div>
<div class="wrap">
	<?php

		// pagination 
		global $wpdb;
		$request_form_quote_entries = $wpdb->prefix.'request_quotes_entries';
		$customPagHTML     = "";
		$query             = "SELECT * FROM $request_form_quote_entries";
		$total_query     = $wpdb->get_results($query);
		$total = count($total_query);
		$items_per_page = 10;
		$page             = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
		$offset         = ( $page * $items_per_page ) - $items_per_page;
		$totalPage         = ceil($total / $items_per_page);

		if($totalPage > 1)
		{
			$customPagHTML_count     =  '<div class="quotes_entries_count"><span>Page '.$page.' of '.$totalPage.'</span> </div>';
			$customPagHTML = 
			'<div class="quotes_entries_pager">'
			.paginate_links( array(
			'base' => add_query_arg( 'cpage', '%#%' ),
			'format' => '',
			'prev_text' => __('&laquo;'),
			'next_text' => __('&raquo;'),
			'total' => $totalPage,
			'current' => $page
			)).
			'</div>'
			;
		}
		// end pagination
		$results         = $wpdb->get_results( $query  . " ORDER BY ID ASC LIMIT $offset, $items_per_page" );
		?>
		<div class="form-entries-container">
			<h1 class="form-entries request">Quote Request Entries</h1>
			<table class="form-entries-table" id="form-entries">
				<tr  class="form-entries-tr">
					<th class="form-entries-th-col-1">Id</th>
					<th class="form-entries-th-col-1">Subject</th>
					<th class="form-entries-th-col-2">Sender</th>
					<th class="form-entries-th-col-3">Sent to</th>
					<th class="form-entries-th-col-3">Delivery Time</th>
				</tr>
				<?php
				foreach($results as $email_logs):
				?>
				<tr>
					<td style="width:10%;"><?=$email_logs->ID;?></td>
					<td><?=$email_logs->subject_title;?></td>
					<td><?=$email_logs->sender;?></td>
					<td><?=$email_logs->sent_to;?></td>
					<td><?=$email_logs->created_at;?></td>
				</tr>
				<?php
				endforeach;
				?>
			</table>
			<?php  ?>
		</div>
		<?php
	?>
</div>
<?php		
echo $customPagHTML_count;
echo $customPagHTML;
