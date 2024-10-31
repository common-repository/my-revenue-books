<?php
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Link Report";


//include security check
	include ("includes/security_check.php");
//include header options
	include ("header.php");
	
	wp_enqueue_script('jquery-ui-datepicker');

	// get the wordpress user information
    $mrb_current_user_check = wp_get_current_user();
	$mrb_user_id = $mrb_current_user_check->ID; //wordpress user id
		//get current user role in wordpress
		$mrb_user_obj = get_userdata( $mrb_user_id );
		if( !empty( $mrb_user_obj->roles ) ){
    	foreach( $mrb_user_obj->roles as $the_role ){}  }
	$mrb_user_role = $the_role; //current wordpress user role
	$mrb_user_email =  $mrb_current_user_check->user_email; //wordpress user email address
	$mrb_user_firstname = $mrb_current_user_check->user_firstname; //wordpress first name
	$mrb_user_lastname = $mrb_current_user_check->user_lastname; //wordpress last name
?>


<!-- MAIN CONTENT -->

<?php
	//user not valid notice
	if ($the_security_option == "Enabled" && $mrb_current_user_id == 0) {
		echo $default_security_message . "<br>"; }
	?>

<?php
	//if a valid user is found
	if ($the_security_option == "Enabled" && $mrb_current_user_id > 0 || $the_security_option == "Disabled") { 	




	//if security is enabled and security access is true, display.  If not. dont display.  If security is disabled then display.
	if ($the_security_option == "Enabled" && $security_reports_access == "true" || $the_security_option == "Disabled") {






/////// START LINK REPORT ///////////////////
//sort options
			//initial page load defaults
			$mrb_sort = "the_date2 DESC, the_date";//default
			$mrb_sorting = 2;//default
				$mrb_sort1 = 2; //ID SORT: ID ASC
				$mrb_sort2 = 4; //DATE SORT: the_date2 ASC, the_date

//check for new sort
		if(isset($_REQUEST['mrb_sort'])) {
			$mrb_sorting = sanitize_text_field( $_REQUEST['mrb_sort'] );
			//if ( ! $mrb_sort ) { $mrb_sort = 3; }
			if($mrb_sorting == 1) {$mrb_sort = "ID DESC"; $mrb_sort1 = 2;}
			if($mrb_sorting == 2) {$mrb_sort = "ID ASC"; $mrb_sort1 = 1;}
			if($mrb_sorting == 3) {$mrb_sort = "the_date2 DESC, the_date"; $mrb_sort2 = 4;}
			if($mrb_sorting == 4) {$mrb_sort = "the_date2 ASC, the_date"; $mrb_sort2 = 3;}
		}


//paging
$mrb_paging = 20;
	if (!empty($_POST['link-search-submit'])) {
	$mrb_paging = stripslashes( $_POST['mrb_paging'] );
	if ( ! $mrb_paging ) { $mrb_paging = '20'; }
	if ( strlen( $mrb_paging ) > 10 ) { $mrb_paging = substr( $mrb_paging, 0, 10 ); }
			}

$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
$mrb_limit = $mrb_paging; // number of rows in page
	if ($mrb_limit == "" || $mrb_limit == 0) {$mrb_limit = 5; }
$offset = ( $pagenum - 1 ) * $mrb_limit;
$table = $wpdb->prefix . "myrevenuebooks";
$mrb_total_links = $wpdb->get_var("SELECT COUNT('id') FROM " . $table . " WHERE ad_post_url <> '' " );
$num_of_pages = ceil( $mrb_total_links / $mrb_limit );
?>


<!-- //////////////// reports menu //////////////// -->
	<table align="left" border="0" cellpadding="2" cellspacing="1" width="100%">
	<td align="left"><div class="mrb_report_tab_wrapper"><span class="dashicons dashicons-chart-pie"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_reports.php">Reports</a></div></td>
	<td><div class="mrb_report_tab_wrapper"><span class="dashicons dashicons-groups"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_report_accounts.php">Detailed Account Report</a></div></td>
	<td><div class="mrb_report_tab_wrapper">&nbsp;<span class="dashicons dashicons-text-page"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_report_transactions.php">Detailed Transaction Report</a></div></td>
	<td><div class="mrb_report_tab_wrapper">&nbsp;<span class="dashicons dashicons-chart-bar"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_report_ytdcomp.php">YTD Comparison Report</a></div></td>
	<td><div class="mrb_report_tab_wrapper">&nbsp;<span class="dashicons dashicons-admin-links"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_link_report.php">Link Report</a></div></td>
	<td><div class="mrb_report_tab_wrapper">&nbsp;<span class="dashicons dashicons-hammer"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_reports_workorders.php">Workorder Report</a></div></td>
	</tr>
	</table>
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td height="5px"> </td></tr>
	</table>
<!-- //////////////// end reports menu //////////////// -->





<div id="mrb_links_wrapper">
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td align="left"><span class="dashicons dashicons-admin-links"></span>&nbsp;<b>Link Report</b> - <i>Only transactions with information in the ad post url field can be found here.  Other transactions can be searched by using the <a href="admin.php?page=my-revenue-books/myrevenuebooks_search.php">search</a> page.</i></td></tr>
	</table>
</div>



<!-- search bar ----------------------------------------------------------------->

<?php
	//set defauts for search
	$my_search = isset($my_search) ? $my_search : 'enter-your-search';
	//set default my_search
	function ezagentcrmgetIfSet(&$value, $default = null)
	{ return isset($value) ? $value : $default; }
	$my_search = ezagentcrmgetIfSet($_REQUEST['my_search']);
?>

<div id="mrb_links_wrapper">

<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<form name="mrb_search" method="post">
	
	<!-- Add search bar -->
	<form name="search-submit" method="post" action="admin.php?page=my-revenue-books/myrevenuebooks_search.php">
	<?php if ($my_search <> "" ) {echo '<tr><td align="left"><i>Searching for ' . $my_search . '</i></td></tr>'; } ?>
	<!-- <tr><td align="right"><span class="dashicons dashicons-search"></span>&nbsp;<?php echo "Searching for " . $my_search; ?></td></tr> -->
	<tr><td align="right"><input class="mrb_search_textbox" type="text" placeholder="Search links (case-sensitive)" name="my_search" value="" size="40" maxlength="300" required>
	<input type="submit" name="search-submit" class="button-primary" value="Search" /></form></td></tr>
</table>
</div>

<!-- end search bar----------------------------------------------------------------->






<!-- top paging bar -------------------------------------------------------------------------->

<!-- dont display during a search query --------->
<?php if (! $my_search ) { ?>

<div id="mrb_links_wrapper">
	<div class="mrb_paging_text">
	<?php
	//paging
	$page_links = paginate_links( array(
	'base' => add_query_arg( 'pagenum', '%#%' ),
	'format' => '',
	'prev_text' => __( '&laquo; Prev', 'myrevenuebooks' ),
	'next_text' => __( 'Next &raquo;', 'myrevenuebooks' ),
	'total' => $num_of_pages,
	'current' => $pagenum
	) );
if ( $page_links ) {
?>

	<table align="left" border="0" cellpadding="0" cellspacing="0" width="980px">
	<form name="link-search-submit" method="post" action="admin.php?page=my-revenue-books/myrevenuebooks_link_report.php">
	<tr><td>Display <input type="text" name="mrb_paging" size="2" maxlength="10" value="<?php echo htmlspecialchars($mrb_paging); ?>"> Records <input type="submit" name="link-search-submit" class="button-secondary" value="Submit" /></form></td>
</div>

<td><div class="tablenav">
	<div class="tablenav-pages" style="margin: 0;">
	Displaying page <b><?php echo $pagenum; ?></b> of <?php echo $num_of_pages; ?> (<?php echo $mrb_total_links; ?> records found)&nbsp;&nbsp;&nbsp;<?php echo $page_links; ?></td></tr>
	</table>
<?php } ?>
</div>
<?php } ?>

<!-- end top paging bar -------------------------------------------------------------------------->




<div id="mrb_invoice_wrapper">


<!-- start of search link display ---------------------------------------------------------------------->

<?php
if (!empty($_POST['search-submit'])) {
?>

<table align="left" border="0" cellpadding="4" cellspacing="1" width="100%">
<tr class="mrb_heading_text">
	<td width="40px"><div class="mrb_sort">ID <a href="admin.php?page=my-revenue-books/myrevenuebooks_link_report.php&mrb_sort=<?php echo $mrb_sort1; ?>"><span class="dashicons dashicons-sort"></span></a></div></td>
	<td align="left"><div class="mrb_sort">DATE <a href="admin.php?page=my-revenue-books/myrevenuebooks_link_report.php&mrb_sort=<?php echo $mrb_sort2; ?>"><span class="dashicons dashicons-sort"></span></a></div></td>
	<td align="left">ACCOUNT</td>
	<td align="left">CONTACT</td>
	<td align="left">POST TITLE / ANCHOR TEXT</td>
	<td colspan="2">POST URL</td>
	<td>AMOUNT</td>
	<td>STATUS</td>
	<td width="50px">LINK</td>
	</tr>

<?php
	$default_id = "1";
	$default_ad_post_url = "";
	$the_b_id = "1";
	$bgcolor = "#e5e5e5";
	$i=0;
	$mrb_match=0;
	$results_found = "N";
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE ad_post_url <> %s AND id <> %s ORDER BY $mrb_sort, $mrb_limit", $default_ad_post_url, $default_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$business_id[$i] = $myrevenuebooks_sql->business_id;
			//get the business name
			$the_bus_name[$i] = "";
			$table = $wpdb->prefix . "myrevenuebooks";
			$myrevenuebooks_sqlc = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id = %s AND business_name <> %s", $business_id[$i], $the_bus_name[$i] ));
			foreach ( $myrevenuebooks_sqlc as $myrevenuebooks_sqc ) 
			{ $business_name[$i] = $myrevenuebooks_sqc->business_name; }
	
	//not searched columns ////////////////////////////////////////////////////////
	$campain_start[$i] = $myrevenuebooks_sql->campain_start;
	$campain_end[$i] = $myrevenuebooks_sql->campain_end;
	$reminder[$i] = $myrevenuebooks_sql->reminder;
	$reminder_date[$i] = $myrevenuebooks_sql->reminder_date;
	$duration[$i] = $myrevenuebooks_sql->duration;
	$status[$i] = $myrevenuebooks_sql->status;
	$yyy[$i] = date("Y");
	$reminder_sent[$i] = $myrevenuebooks_sql->reminder_sent;
	$reminder_date_sent[$i] = $myrevenuebooks_sql->reminder_date_sent;
	$ad_post_term_year[$i] = $myrevenuebooks_sql->ad_post_term_year;
	$ad_post_term_months[$i] = $myrevenuebooks_sql->ad_post_term_months;
	$da_score[$i] = $myrevenuebooks_sql->da_score;
	$pa_score[$i] = $myrevenuebooks_sql->pa_score;
	$spam_score[$i] = $myrevenuebooks_sql->spam_score;

			
			//searched columns ///////////////////////////////////////////////////////////////////////////////////
				$s_the_id[$i] = strstr($myrevenuebooks_sql->id, $my_search); if ($s_the_id[$i] == true) { $mrb_match++; }
				$the_id[$i] = $myrevenuebooks_sql->id;
				
				$s_the_date[$i] = strstr($myrevenuebooks_sql->the_date, $my_search); if ($s_the_date[$i] == true) { $mrb_match++; }
				$the_date[$i] = $myrevenuebooks_sql->the_date;
				
				$s_amount[$i] = strstr($myrevenuebooks_sql->amount, $my_search); if ($s_amount[$i] == true) { $mrb_match++; }
				$amount[$i] = $myrevenuebooks_sql->amount;
				
				$s_po_ref[$i] = strstr($myrevenuebooks_sql->po_ref, $my_search); if ($s_po_ref[$i] == true) { $mrb_match++; }
				$po_ref[$i] = $myrevenuebooks_sql->po_ref;
				
				$s_the_ref[$i] = strstr($myrevenuebooks_sql->the_ref, $my_search); if ($s_the_ref[$i] == true) { $mrb_match++; }
				$the_ref[$i] = $myrevenuebooks_sql->the_ref;
				
				$s_payment_type[$i] = strstr($myrevenuebooks_sql->payment_type, $my_search); if ($s_payment_type[$i] == true) { $mrb_match++; }
				$payment_type[$i] = $myrevenuebooks_sql->payment_type;
				
				$s_payment_details[$i] = strstr($myrevenuebooks_sql->payment_details, $my_search); if ($s_payment_details[$i] == true) { $mrb_match++; }
				$payment_details[$i] = $myrevenuebooks_sql->payment_details;
				
				$s_description[$i] = strstr($myrevenuebooks_sql->description, $my_search); if ($s_description[$i] == true) { $mrb_match++; }
				$description[$i] = $myrevenuebooks_sql->description;
				
				$s_notes[$i] = strstr($myrevenuebooks_sql->notes, $my_search); if ($s_notes[$i] == true) { $mrb_match++; }
				$notes[$i] = $myrevenuebooks_sql->notes;
				
				$s_log_notes[$i] = strstr($myrevenuebooks_sql->log_notes, $my_search); if ($s_log_notes[$i] == true) { $mrb_match++; }
				$log_notes[$i] = $myrevenuebooks_sql->log_notes;
				
				$s_primary_contact[$i] = strstr($myrevenuebooks_sql->primary_contact, $my_search); if ($s_primary_contact[$i] == true) { $mrb_match++; }
				$primary_contact[$i] = $myrevenuebooks_sql->primary_contact;
				
				$s_primary_email[$i] = strstr($myrevenuebooks_sql->primary_email, $my_search); if ($s_primary_email[$i] == true) { $mrb_match++; }
				$primary_email[$i] = $myrevenuebooks_sql->primary_email;
				
				$s_secondary_contact[$i] = strstr($myrevenuebooks_sql->secondary_contact, $my_search); if ($s_secondary_contact[$i] == true) { $mrb_match++; }
				$secondary_contact[$i] = $myrevenuebooks_sql->secondary_contact;
				
				$s_secondary_email[$i] = strstr($myrevenuebooks_sql->secondary_email, $my_search); if ($s_secondary_email[$i] == true) { $mrb_match++; }
				$secondary_email[$i] = $myrevenuebooks_sql->secondary_email;
				
				$s_ad_html[$i] = strstr($myrevenuebooks_sql->ad_html, $my_search); if ($s_ad_html[$i] == true) { $mrb_match++; }
				$ad_html[$i] = $myrevenuebooks_sql->ad_html;
				
				$s_ad_post_title[$i] = strstr($myrevenuebooks_sql->ad_post_title, $my_search); if ($s_ad_post_title[$i] == true) { $mrb_match++; }
				$ad_post_title[$i] = $myrevenuebooks_sql->ad_post_title;

				$s_ad_post_url[$i] = strstr($myrevenuebooks_sql->ad_post_url, $my_search); if ($s_ad_post_url[$i] == true) { $mrb_match++; }				
				$ad_post_url[$i] = $myrevenuebooks_sql->ad_post_url;
				
				$s_ad_link_url[$i] = strstr($myrevenuebooks_sql->ad_link_url, $my_search); if ($s_ad_link_url[$i] == true) { $mrb_match++; }				
				$ad_link_url[$i] = $myrevenuebooks_sql->ad_link_url;
				
				$s_ad_post_anchor_text[$i] = strstr($myrevenuebooks_sql->ad_post_anchor_text, $my_search); if ($s_ad_post_anchor_text[$i] == true) { $mrb_match++; }	
				$ad_post_anchor_text[$i] = $myrevenuebooks_sql->ad_post_anchor_text;
				
				$s_ad_post_status[$i] = strstr($myrevenuebooks_sql->ad_post_status, $my_search); if ($s_ad_post_status[$i] == true) { $mrb_match++; }
				$ad_post_status[$i] = $myrevenuebooks_sql->ad_post_status;
					if (! $ad_post_status[$i] ) { $ad_post_status[$i] = "Active"; }	
					if ($ad_post_status[$i] == "Active" ) { $ad_post_status[$i] = "A"; }
							else {$ad_post_status[$i] = "I";}
							
				$primary_notes[$i] = strstr($myrevenuebooks_sql->primary_notes, $my_search); if ($primary_notes[$i] == true) { $mrb_match++; }
				$secondary_notes[$i] = strstr($myrevenuebooks_sql->secondary_notes, $my_search); if ($secondary_notes[$i] == true) { $mrb_match++; }
				$ad_post_anchor_text2[$i] = strstr($myrevenuebooks_sql->ad_post_anchor_text2, $my_search); if ($ad_post_anchor_text2[$i] == true) { $mrb_match++; }
				$ad_post_anchor_text3[$i] = strstr($myrevenuebooks_sql->ad_post_anchor_text3, $my_search); if ($ad_post_anchor_text3[$i] == true) { $mrb_match++; }
				$ad_link_url2[$i] = strstr($myrevenuebooks_sql->ad_link_url2, $my_search); if ($ad_link_url2[$i] == true) { $mrb_match++; }
				$ad_link_url3[$i] = strstr($myrevenuebooks_sql->ad_link_url3, $my_search); if ($ad_link_url3[$i] == true) { $mrb_match++; }

				$payment_name[$i] = strstr($myrevenuebooks_sql->payment_name, $my_search); if ($payment_name[$i] == true) { $mrb_match++; }
				$payment_email[$i] = strstr($myrevenuebooks_sql->payment_email, $my_search); if ($payment_email[$i] == true) { $mrb_match++; }
				$payment_type[$i] = strstr($myrevenuebooks_sql->payment_type, $my_search); if ($payment_type[$i] == true) { $mrb_match++; }
				$payment_transid[$i] = strstr($myrevenuebooks_sql->payment_transid, $my_search); if ($payment_transid[$i] == true) { $mrb_match++; }

			//get string lenght
			$business_name_lenght[$i] = strlen($business_name[$i]);
			$primary_contact_lenght[$i] = strlen($primary_contact[$i]);
			$ad_post_title_lenght[$i] = strlen($ad_post_title[$i]);
			$ad_post_anchor_text_lenght[$i] = strlen($ad_post_anchor_text[$i]);
?>

<?php
if($mrb_match >= 1) { 
		if($bgcolor=='#ffffff'){$bgcolor='#e5e5e5';}
		else{$bgcolor='#ffffff';}
		$results_found = "Y";
		?>

<tr bgcolor="<?php echo $bgcolor; ?>" class="mrb_link_display_text" style="height:50px">
	<td align="center"><?php echo "<a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_transaction.php&id=$the_id[$i]&b_id=$business_id[$i]'>$the_id[$i]</a>" ?></td>
	<td><?php echo $the_date[$i]; ?></td>
	<td><?php echo substr($business_name[$i],0,20) ?><?php if ($business_name_lenght[$i] > 20) {echo "...";} ?></td>
	<td><?php echo $primary_contact[$i]; ?><?php if ($primary_contact_lenght[$i] > 20) {echo "...";} ?></td>
	<td><b><?php echo substr($ad_post_title[$i],0,43) ?><?php if ($ad_post_title_lenght[$i] > 43) {echo "...";} ?></b>
		<br>&ldquo;<?php echo substr($ad_post_anchor_text[$i],0,41) ?><?php if ($ad_post_anchor_text_lenght[$i] > 41) {echo "...";} ?>&rdquo;</td>
	
	<td align="right"><?php echo "<a href='$ad_post_url[$i]' target='_blank'>Link</a>" ?></td>
			<td align="left"><?php echo "<a href='$ad_post_url[$i]' target='_blank'><span class='dashicons dashicons-external'></span></a>" ?></td>
	<td align="right"><?php echo "$" . number_format($amount[$i], 2, '.', ','); ?></td>
	<td align="center"><?php echo $status[$i]; ?></td>
	<td align="center"><?php echo $ad_post_status[$i]; ?></td>
	</tr>
<?php } ?>

<?php
$i++;
$mrb_match=0;

	}
	if ($results_found == "N") {echo "<tr><td colspan='9'>No search results found!</td></tr>";}
?>
</table>

<?php } ?>
<!-- end of search link display ---------------------------------------------------------------------->





<!-- start of regular link display ---------------------------------------------------------------------->

<!-- dont display during a search query --------->
<?php if (! $my_search ) { ?>


<!-- <div id="mrb_invoice_wrapper"> -->
<table align="left" border="0" cellpadding="4" cellspacing="1" width="100%">
<tr class="mrb_heading_text">
	<td width="40px"><div class="mrb_sort">ID <a href="admin.php?page=my-revenue-books/myrevenuebooks_link_report.php&mrb_sort=<?php echo $mrb_sort1; ?>"><span class="dashicons dashicons-sort"></span></a></div></td>
	<td align="left"><div class="mrb_sort">DATE <a href="admin.php?page=my-revenue-books/myrevenuebooks_link_report.php&mrb_sort=<?php echo $mrb_sort2; ?>"><span class="dashicons dashicons-sort"></span></a></div></td>
	<td align="left">ACCOUNT</td>
	<td align="left">CONTACT</td>
	<td align="left">POST TITLE / ANCHOR TEXT</td>
	<td colspan="2">POST URL</td>
	<td>AMOUNT</td>
	<td>STATUS</td>
	<td width="50px">LINK</td>
	</tr>
	

<?php
	$default_id = "1";
	$default_ad_post_url = "";
	$the_b_id = "1";
	$bgcolor = "#e5e5e5";
	$i=1;
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE ad_post_url <> %s AND id <> %s ORDER BY $mrb_sort LIMIT $offset, $mrb_limit", $default_ad_post_url, $default_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		if($bgcolor=='#ffffff'){$bgcolor='#e5e5e5';}
		else{$bgcolor='#ffffff';}
	
	$business_id[$i] = $myrevenuebooks_sql->business_id;
			//get the business name
			$the_bus_name[$i] = "";
			$table = $wpdb->prefix . "myrevenuebooks";
			$myrevenuebooks_sqlc = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id = %s AND business_name <> %s", $business_id[$i], $the_bus_name[$i] ));
			foreach ( $myrevenuebooks_sqlc as $myrevenuebooks_sqc ) 
			{ $business_name[$i] = $myrevenuebooks_sqc->business_name; }
			
	$the_id[$i] = $myrevenuebooks_sql->id;
	$the_date[$i] = $myrevenuebooks_sql->the_date;
	$campain_start[$i] = $myrevenuebooks_sql->campain_start;
	$campain_end[$i] = $myrevenuebooks_sql->campain_end;
	$reminder[$i] = $myrevenuebooks_sql->reminder;
	$reminder_date[$i] = $myrevenuebooks_sql->reminder_date;
	$duration[$i] = $myrevenuebooks_sql->duration;
	$description[$i] = $myrevenuebooks_sql->description;
	$payment_type[$i] = $myrevenuebooks_sql->payment_type;
	$payment_details[$i] = $myrevenuebooks_sql->payment_details;
	$amount[$i] = $myrevenuebooks_sql->amount;
	$status[$i] = $myrevenuebooks_sql->status;
	$po_ref[$i] = $myrevenuebooks_sql->po_ref;
	$notes[$i] = $myrevenuebooks_sql->notes;
	$log_notes[$i] = $myrevenuebooks_sql->log_notes;
	$yyy[$i] = date("Y");
		$the_ref[$i] = $myrevenuebooks_sql->the_ref;
		$reminder_sent[$i] = $myrevenuebooks_sql->reminder_sent;
		$reminder_date_sent[$i] = $myrevenuebooks_sql->reminder_date_sent;
		$primary_contact[$i] = $myrevenuebooks_sql->primary_contact;
		$secondary_contact[$i] = $myrevenuebooks_sql->secondary_contact;
		$primary_email[$i] = $myrevenuebooks_sql->primary_email;
		$secondary_email[$i] = $myrevenuebooks_sql->secondary_email;
		$ad_html[$i] = $myrevenuebooks_sql->ad_html;
				$ad_post_title[$i] = $myrevenuebooks_sql->ad_post_title;
				$ad_post_url[$i] = $myrevenuebooks_sql->ad_post_url;
				$ad_post_anchor_text[$i] = $myrevenuebooks_sql->ad_post_anchor_text;
				$ad_post_term_year[$i] = $myrevenuebooks_sql->ad_post_term_year;
				$ad_post_term_months[$i] = $myrevenuebooks_sql->ad_post_term_months;
				$ad_post_status[$i] = $myrevenuebooks_sql->ad_post_status;
					if (! $ad_post_status[$i] ) { $ad_post_status[$i] = "Active"; }	
					if ($ad_post_status[$i] == "Active" ) { $ad_post_status[$i] = "A"; }
							else {$ad_post_status[$i] = "I";}
				$da_score[$i] = $myrevenuebooks_sql->da_score;
				$pa_score[$i] = $myrevenuebooks_sql->pa_score;
				$spam_score[$i] = $myrevenuebooks_sql->spam_score;
				$ad_link_url[$i] = $myrevenuebooks_sql->ad_link_url;
			
			//get string lenght
			$business_name_lenght[$i] = strlen($business_name[$i]);
			$primary_contact_lenght[$i] = strlen($primary_contact[$i]);
			$ad_post_title_lenght[$i] = strlen($ad_post_title[$i]);
			$ad_post_anchor_text_lenght[$i] = strlen($ad_post_anchor_text[$i]);
?>


<tr bgcolor="<?php echo $bgcolor; ?>" class="mrb_link_display_text" style="height:50px">
	<td align="center"><?php echo "<a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_transaction.php&id=$the_id[$i]&b_id=$business_id[$i]'>$the_id[$i]</a>" ?></td>
	<td><?php echo $the_date[$i]; ?></td>
	<td><?php echo substr($business_name[$i],0,20) ?><?php if ($business_name_lenght[$i] > 20) {echo "...";} ?></td>
	<td><?php echo $primary_contact[$i]; ?><?php if ($primary_contact_lenght[$i] > 20) {echo "...";} ?></td>
	<td><b><?php echo substr($ad_post_title[$i],0,43) ?><?php if ($ad_post_title_lenght[$i] > 43) {echo "...";} ?></b>
		<br>&ldquo;<?php echo substr($ad_post_anchor_text[$i],0,41) ?><?php if ($ad_post_anchor_text_lenght[$i] > 41) {echo "...";} ?>&rdquo;</td>
	
	<td align="right"><?php echo "<a href='$ad_post_url[$i]' target='_blank'>Link</a>" ?></td>
			<td align="left"><?php echo "<a href='$ad_post_url[$i]' target='_blank'><span class='dashicons dashicons-external'></span></a>" ?></td>
	<td align="right"><?php echo "$" . number_format($amount[$i], 2, '.', ','); ?></td>
	<td align="center"><?php echo $status[$i]; ?></td>
	<td align="center"><?php echo $ad_post_status[$i]; ?></td>
	</tr>


<?php
$i++;
	}
	if ($i==1) {echo "No accounts found!";}
?>
</table>
<!-- end of regular link display ---------------------------------------------------------------------->

<?php } ?>
</div>




<?php
} // end if security is enabled and security access is true
?>

	

<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->