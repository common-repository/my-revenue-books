<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
include ("header.php");
	wp_enqueue_script('jquery-ui-datepicker');
  ?>

<?php
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
	<form name="search-submit" method="post" action="admin.php?page=my-revenue-books/myrevenuebooks_advanced_search.php">
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
	<td align="left" width="120px"><div class="mrb_sort">DATE <a href="admin.php?page=my-revenue-books/myrevenuebooks_link_report.php&mrb_sort=<?php echo $mrb_sort2; ?>"><span class="dashicons dashicons-sort"></span></a></div></td>
	<td align="left">POST TITLE / ANCHOR TEXT / [DA] [PA] [SPAM]</td>
	</tr>

<?php
	$default_id = "1";
	$default_ad_post_url = "";
	$the_b_id = "1";
	$bgcolor = "#e5e5e5";
	$i=0;
	$mrb_match=0;
	$results_found = "N";
	
	//$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE ad_post_url <> %s AND id <> %s ORDER BY $mrb_sort, $mrb_limit", $default_ad_post_url, $default_id ));
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE ad_post_url <> %s AND id <> %s ORDER BY id DESC LIMIT 50", $default_ad_post_url, $default_id ));
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
				
				
				$ad_post_status[$i] = $myrevenuebooks_sql->ad_post_status;
					$s_ad_post_status[$i] = strstr($myrevenuebooks_sql->ad_post_status, $my_search); if ($s_ad_post_status[$i] == true) { $mrb_match++; }
					if (! $ad_post_status[$i] ) { $ad_post_status[$i] = "Active"; }	
					if ($ad_post_status[$i] == "Active" ) { $ad_post_status[$i] = "A"; }
							else {$ad_post_status[$i] = "I";}
					
				$primary_notes[$i] = $myrevenuebooks_sql->primary_notes;
					$primary_notes[$i] = strstr($myrevenuebooks_sql->primary_notes, $my_search); if ($primary_notes[$i] == true) { $mrb_match++; }
				
				$secondary_notes[$i] = $myrevenuebooks_sql->secondary_notes;
					$secondary_notes[$i] = strstr($myrevenuebooks_sql->secondary_notes, $my_search); if ($secondary_notes[$i] == true) { $mrb_match++; }

				$payment_name[$i] = $myrevenuebooks_sql->payment_name;
					$s_payment_name[$i] = strstr($myrevenuebooks_sql->payment_name, $my_search); if ($s_payment_name[$i] == true) { $mrb_match++; }
				
				$payment_email[$i] = $myrevenuebooks_sql->payment_email;
					$s_payment_email[$i] = strstr($myrevenuebooks_sql->payment_email, $my_search); if ($s_payment_email[$i] == true) { $mrb_match++; }
				
				$payment_type[$i] = $myrevenuebooks_sql->payment_type;
					$s_payment_type[$i] = strstr($myrevenuebooks_sql->payment_type, $my_search); if ($s_payment_type[$i] == true) { $mrb_match++; }
				
				$payment_transid[$i] = $myrevenuebooks_sql->payment_transid;
					$s_payment_transid[$i] = strstr($myrevenuebooks_sql->payment_transid, $my_search); if ($s_payment_transid[$i] == true) { $mrb_match++; }
			
				$ad_post_anchor_text[$i] = $myrevenuebooks_sql->ad_post_anchor_text;
					$s_ad_post_anchor_text[$i] = strstr($myrevenuebooks_sql->ad_post_anchor_text, $my_search); if ($s_ad_post_anchor_text[$i] == true) { $mrb_match++; }	
				$ad_post_anchor_text2[$i] = $myrevenuebooks_sql->ad_post_anchor_text2;
					$s_ad_post_anchor_text2[$i] = strstr($myrevenuebooks_sql->ad_post_anchor_text2, $my_search); if ($s_ad_post_anchor_text2[$i] == true) { $mrb_match++; }
				$ad_post_anchor_text3[$i] = $myrevenuebooks_sql->ad_post_anchor_text3;
					$s_ad_post_anchor_text3[$i] = strstr($myrevenuebooks_sql->ad_post_anchor_text3, $my_search); if ($s_ad_post_anchor_text3[$i] == true) { $mrb_match++; }
				$ad_post_anchor_text4[$i] = $myrevenuebooks_sql->ad_post_anchor_text4;
					$s_ad_post_anchor_text4[$i] = strstr($myrevenuebooks_sql->ad_post_anchor_text4, $my_search); if ($s_ad_post_anchor_text4[$i] == true) { $mrb_match++; }

				$ad_link_url[$i] = $myrevenuebooks_sql->ad_link_url;
					$s_ad_link_url[$i] = strstr($myrevenuebooks_sql->ad_link_url, $my_search); if ($s_ad_link_url[$i] == true) { $mrb_match++; }				
				$ad_link_url2[$i] = $myrevenuebooks_sql->ad_link_url2;
					$s_ad_link_url2[$i] = strstr($myrevenuebooks_sql->ad_link_url2, $my_search); if ($s_ad_link_url2[$i] == true) { $mrb_match++; }				
				$ad_link_url3[$i] = $myrevenuebooks_sql->ad_link_url3;
					$s_ad_link_url3[$i] = strstr($myrevenuebooks_sql->ad_link_url3, $my_search); if ($s_ad_link_url3[$i] == true) { $mrb_match++; }				
				$ad_link_url4[$i] = $myrevenuebooks_sql->ad_link_url4;
					$s_ad_link_url4[$i] = strstr($myrevenuebooks_sql->ad_link_url4, $my_search); if ($s_ad_link_url4[$i] == true) { $mrb_match++; }				
					

				
			$da_score[$i] = $myrevenuebooks_sql->da_score;
			$da_score2[$i] = $myrevenuebooks_sql->da_score2;
			$da_score3[$i] = $myrevenuebooks_sql->da_score3;
			$da_score4[$i] = $myrevenuebooks_sql->da_score4;
				$s_da_score[$i] = strstr($myrevenuebooks_sql->da_score, $my_search); if ($s_da_score[$i] == true) { $mrb_match++; }
				$s_da_score2[$i] = strstr($myrevenuebooks_sql->da_score2, $my_search); if ($s_da_score2[$i] == true) { $mrb_match++; }
				$s_da_score3[$i] = strstr($myrevenuebooks_sql->da_score3, $my_search); if ($s_da_score3[$i] == true) { $mrb_match++; }
				$s_da_score4[$i] = strstr($myrevenuebooks_sql->da_score4, $my_search); if ($s_da_score4[$i] == true) { $mrb_match++; }
				
			$pa_score[$i] = $myrevenuebooks_sql->pa_score;
			$pa_score2[$i] = $myrevenuebooks_sql->pa_score2;
			$pa_score3[$i] = $myrevenuebooks_sql->pa_score3;
			$pa_score4[$i] = $myrevenuebooks_sql->pa_score4;
				$s_pa_score[$i] = strstr($myrevenuebooks_sql->pa_score, $my_search); if ($s_pa_score[$i] == true) { $mrb_match++; }
				$s_pa_score2[$i] = strstr($myrevenuebooks_sql->pa_score2, $my_search); if ($s_pa_score2[$i] == true) { $mrb_match++; }
				$s_pa_score3[$i] = strstr($myrevenuebooks_sql->pa_score3, $my_search); if ($s_pa_score3[$i] == true) { $mrb_match++; }
				$s_pa_score4[$i] = strstr($myrevenuebooks_sql->pa_score4, $my_search); if ($s_pa_score4[$i] == true) { $mrb_match++; }
				
			$spam_score[$i] = $myrevenuebooks_sql->spam_score;
			$spam_score2[$i] = $myrevenuebooks_sql->spam_score2;
			$spam_score3[$i] = $myrevenuebooks_sql->spam_score3;
			$spam_score4[$i] = $myrevenuebooks_sql->spam_score4;
				$s_spam_score[$i] = strstr($myrevenuebooks_sql->spam_score, $my_search); if ($s_spam_score[$i] == true) { $mrb_match++; }
				$s_spam_score2[$i] = strstr($myrevenuebooks_sql->spam_score2, $my_search); if ($s_spam_score2[$i] == true) { $mrb_match++; }
				$s_spam_score3[$i] = strstr($myrevenuebooks_sql->spam_score3, $my_search); if ($s_spam_score3[$i] == true) { $mrb_match++; }
				$s_spam_score4[$i] = strstr($myrevenuebooks_sql->spam_score4, $my_search); if ($s_spam_score4[$i] == true) { $mrb_match++; }
				
				
			//get string lenght
			$ad_link_url_lenght[$i] = strlen($ad_link_url[$i]);
			$ad_link_url_lenght2[$i] = strlen($ad_link_url2[$i]);
			$ad_link_url_lenght3[$i] = strlen($ad_link_url3[$i]);
			$ad_link_url_lenght4[$i] = strlen($ad_link_url4[$i]);

			//get string lenght
			$business_name_lenght[$i] = strlen($business_name[$i]);
			$primary_contact_lenght[$i] = strlen($primary_contact[$i]);
			$ad_post_title_lenght[$i] = strlen($ad_post_title[$i]);
			$ad_post_anchor_text_lenght[$i] = strlen($ad_post_anchor_text[$i]);
			$ad_post_anchor_text_lenght2[$i] = strlen($ad_post_anchor_text2[$i]);
			$ad_post_anchor_text_lenght3[$i] = strlen($ad_post_anchor_text3[$i]);
			$ad_post_anchor_text_lenght4[$i] = strlen($ad_post_anchor_text4[$i]);
			
			echo "MRB MATCH: " . $mrb_match . "<br>";
			
?>

<?php
if($mrb_match >= 1) { 
		if($bgcolor=='#ffffff'){$bgcolor='#e5e5e5';}
		else{$bgcolor='#ffffff';}
		$results_found = "Y";
		?>



<tr bgcolor="<?php echo $bgcolor; ?>" class="mrb_link_display_text2">
	<td align="center" valign="top"><?php echo "<a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_transaction.php&id=$the_id[$i]&b_id=$business_id[$i]'>$the_id[$i]</a>" ?></td>
	<td valign="top"><?php echo $the_date[$i]; ?><br>
	<?php echo substr($business_name[$i],0,20) ?><?php if ($business_name_lenght[$i] > 20) {echo "...";} ?><br>
		<?php echo $primary_contact[$i]; ?><?php if ($primary_contact_lenght[$i] > 20) {echo "...";} ?></td>
		
	
	
	<td valign="top">
	
	<!-- Get the title and link -->
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td width="15px"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/external_link.png'; ?>"></td>
		<td valign="top"><?php echo "<a href='$ad_post_url[$i]' target='_blank'>" ?><b><?php echo substr($ad_post_title[$i],0,90) ?><?php if ($ad_post_title_lenght[$i] > 90) {echo "...";} ?><?php echo "</a>"; ?></b>
	</td></tr></table>
	
	<!-- Get the anchor text, link, and DA-PA-SPAM -->
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr class="mrb_adv_search_text"><td align="left"> Anchor Text</td><td align="left"> Link URL</td><td width="12px">[DA]</td><td width="12px">[PA]</td><td width="12px">[SS]</td></tr>
	
	<tr class="mrb_adv_search_results_text"><td width="165px"><?php echo substr($ad_post_anchor_text[$i],0,25) ?><?php if ($ad_post_anchor_text_lenght[$i] > 25) {echo "...";} ?></td>
	<td><?php echo $ad_link_url[$i]; ?></td>
	<td><?php echo "[" . $da_score[$i] . "] "; ?></td>
	<td><?php echo "[" . $pa_score[$i] . "] "; ?></td>
	<td><?php echo "[" . $spam_score[$i] . "] "; ?></td></tr>
	
	<!-- Archor text and link URL #2 if exists -->
	<?php if ($ad_post_anchor_text_lenght2[$i] > 0) { ?>
		<tr class="mrb_adv_search_results_text"><td><?php echo substr($ad_post_anchor_text2[$i],0,25) ?><?php if ($ad_post_anchor_text_lenght2[$i] > 25) {echo "...";} ?></td>
		<td><?php echo $ad_link_url2[$i]; ?></td>
		<td><?php echo "[" . $da_score2[$i] . "] "; ?></td>
		<td><?php echo "[" . $pa_score2[$i] . "] "; ?></td>
		<td><?php echo "[" . $spam_score2[$i] . "] "; ?></td></tr>
	<?php } ?>
	
	<!-- Archor text and link URL #3 if exists -->
	<?php if ($ad_post_anchor_text_lenght3[$i] > 0) { ?>
		<tr class="mrb_adv_search_results_text"><td><?php echo substr($ad_post_anchor_text3[$i],0,25) ?><?php if ($ad_post_anchor_text_lenght3[$i] > 25) {echo "...";} ?></td>
		<td><?php echo $ad_link_url3[$i]; ?></td>
		<td><?php echo "[" . $da_score3[$i] . "] "; ?></td>
		<td><?php echo "[" . $pa_score3[$i] . "] "; ?></td>
		<td><?php echo "[" . $spam_score3[$i] . "] "; ?></td></tr>
	<?php } ?>

	<!-- Archor text and link URL #4 if exists -->
	<?php if ($ad_post_anchor_text_lenght4[$i] > 0) { ?>
		<tr class="mrb_adv_search_results_text"><td><?php echo substr($ad_post_anchor_text4[$i],0,25) ?><?php if ($ad_post_anchor_text_lenght4[$i] > 25) {echo "...";} ?></td>
		<td><?php echo $ad_link_url4[$i]; ?></td>
		<td><?php echo "[" . $da_score4[$i] . "] "; ?></td>
		<td><?php echo "[" . $pa_score4[$i] . "] "; ?></td>
		<td><?php echo "[" . $spam_score4[$i] . "] "; ?></td></tr>
	<?php } ?>
	
	
	</table>
	</tr>


<?php }
$i++;
$mrb_match=0;
	}
	//if ($i==1) {echo "No search results found!";}
	if ($results_found == "N") {echo "<tr><td colspan='3'>No search results found!</td></tr>";}
?>
</table>





<?php }  ?>
</div>





<!-- end of search link display ---------------------------------------------------------------------->
