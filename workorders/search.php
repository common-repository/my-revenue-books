<?php

	if ($security_work_admin == "true") {
		

$mrb_page = "Search";

//////////////// START SEARCH ///////////////////
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
?>


<!-- search bar ----------------------------------------------------------------->

<?php
	//set defauts for search
	$my_search = isset($my_search) ? $my_search : 'enter-your-search';
	//set default my_search
	function ezagentcrmgetIfSet(&$value, $default = null)
	{ return isset($value) ? $value : $default; }
	$my_searchclean = ezagentcrmgetIfSet($_REQUEST['my_search']);
	$my_search = sanitize_text_field( $my_searchclean);
?>

<div id="mrb_links_wrapper">

<table align="right" border="0" cellpadding="4" cellspacing="0" width="100%">
	<form name="mrb_search" method="post">
	
	<!-- Add search bar -->	
	<form name="search-submit" method="post" action="admin.php?page=my-revenue-books/myrevenuebooks_search.php">
	<?php if ($my_search <> "" ) {echo '<tr><td align="right"><i>Searching for ' . $my_search . '</i></td></tr>'; } ?>
	<tr><td align="right"><input class="mrb_search_textbox" type="text" placeholder="Search (case-sensitive)" name="my_search" value="" size="60" maxlength="500" required>
	<input type="submit" name="search-submit" class="button-primary" value="Search" /></form></td></tr>
</table>
</div>
<!-- end search bar----------------------------------------------------------------->








<!-- start of search display ---------------------------------------------------------------------->

<?php
//if (!empty($_POST['search-submit'])) { 
if ($my_search <> NULL ) {
?>






<!-- start of search display -------------------------------------------------------------------------->

<div id="mrb_invoice_wrapper">
<table align="left" border="0" cellpadding="4" cellspacing="1" width="100%">
<tr class="mrb_heading_text">
	<td width='40px'><div class="mrb_sort">ID <a href='admin.php?page=my-revenue-books/workorders/search.php&my_search=<?php echo $my_search; ?>&mrb_sort=<?php echo $mrb_sort1; ?>'><span class="dashicons dashicons-sort"></span></a></div></td>
	<td align='left'><div class="mrb_sort">DATE <a href='admin.php?page=my-revenue-books/workorders/search.php&my_search=<?php echo $my_search; ?>&mrb_sort=<?php echo $mrb_sort2; ?>'><span class="dashicons dashicons-sort"></span></a></div></td>
	<td align='left'>ACCT NAME</td>
	<td>CONTACT</td>
	<td>PO</td>
	<td>REF</td>
	<td>START</td>
	<td>END</td>
	<td>AMOUNT</td>
	<td>STATUS</td>
	</tr>

<?php
	$default_id = "1";
	$the_b_id = "1";
	$bgcolor = "#e5e5e5";
	$i=1;
	$mrb_match=0;
	$results_found = "N";
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id <> %s AND business_id <> %s ORDER BY $mrb_sort", $default_id, $the_b_id ));
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
			$po_ref_lenght[$i] = strlen($po_ref[$i]);
			$the_ref_lenght[$i] = strlen($the_ref[$i]);
?>

<?php
if($mrb_match >= 1) { 
		if($bgcolor=='#ffffff'){$bgcolor='#e5e5e5';}
		else{$bgcolor='#ffffff';}
		$results_found = "Y";
				?>
<tr bgcolor="<?php echo $bgcolor; ?>" class="mrb_link_display_text" style="height:50px">
	<td align="center"><?php echo "<a href='admin.php?page=my-revenue-books/workorders/edit_transaction.php&id=$the_id[$i]&b_id=$business_id[$i]'>$the_id[$i]</a>" ?></td>
	<td><?php echo $the_date[$i]; ?></td>
	<td><?php echo substr($business_name[$i],0,15) ?><?php if ($business_name_lenght[$i] > 15) {echo "...";} ?></td>
	<td><?php echo $primary_contact[$i]; ?><?php if ($primary_contact_lenght[$i] > 15) {echo "...";} ?></td>
	<td><?php echo substr($po_ref[$i],0,10) ?><?php if ($po_ref_lenght[$i] > 10) {echo "...";} ?></td>
	<td><?php echo substr($the_ref[$i],0,10) ?><?php if ($the_ref_lenght[$i] > 10) {echo "...";} ?></td>
	<td><?php echo $campain_start[$i]; ?></td>
	<td><?php echo $campain_end[$i]; ?></td>
	<td align="right"><?php echo "$" . number_format($amount[$i], 2, '.', ','); ?></td>
	<td align="center"><?php echo $status[$i]; ?></td>
	</tr>
<?php } ?>

<?php
$i++;
$mrb_match=0;
	}
	if ($results_found == "N") {echo "<tr><td colspan='10'>No search results found!</td></tr>";}
?>
<tr><td colspan="10"></td></tr>
</table>

</div>


<?php }

}//end security_work_admin = true
?>
<!-- end of search link display ---------------------------------------------------------------------->

