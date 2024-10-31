<?php
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Reports";

//include security check
	include ("includes/security_check.php");
//include header options
	include ("header.php");

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


	//if the user does not have access to accounts
	if ($the_security_option == "Enabled" && $security_reports_access == "false") { ?>
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td align="middle"><h3><?php echo $default_security_message; ?></h3></td></tr>
	<tr><td align="middle"><b>Contact your administrator or check the <a href="admin.php?page=my-revenue-books/myrevenuebooks_security.php">security & privacy</a> settings to enable access.</b></td></tr>
	<tr><td>&nbsp;</td></tr>
	</table>
<?php
}



	//if security is enabled and security access is true, display.  If not. dont display.  If security is disabled then display.
	if ($the_security_option == "Enabled" && $security_reports_access == "true" || $the_security_option == "Disabled") {
	


////////// START REPORTS ///////////////
  if (isset($_POST['download_csv'])) {

   global $wpdb;
   			//set the dates
				$from_date = "";
				$to_date = "";
				//check for dates
				if(isset($_REQUEST['fromdate'])){ $from_date = sanitize_text_field( $_REQUEST['fromdate'] ); }
				if(isset($_REQUEST['todate'])){ $to_date = sanitize_text_field( $_REQUEST['todate'] ); }
					//if no dates, go back to reports
					if ( ! $from_date ) { $url = "admin.php?page=my-revenue-books/myrevenuebooks_reports.php"; echo "<script> location.replace('$url'); </script>"; exit;}

	$from_date2 = strtotime($from_date);
	$to_date2 = strtotime($to_date);
	$bus_id = 1;
	$bus_name = "";
	$I = 0;
	$II = 1;
	$trans_amount_pending = 0; //pending amount default
	$trans_amount = 0; //paid amount default
	
	
		//name the cvs file
	$FileName = "mrb_export.csv";
	$file = fopen($FileName,"w");

	/* Write csv headers */
		$HeadingsArray=array();
		$HeadingsArray[]="payment_date";
		$HeadingsArray[]="the_date";
		$HeadingsArray[]="id";
		$HeadingsArray[]="business_name";
		$HeadingsArray[]="payment_name";
		$HeadingsArray[]="payment_email";
		$HeadingsArray[]="payment_transid";
		$HeadingsArray[]="po_ref";
		$HeadingsArray[]="the_ref";
		$HeadingsArray[]="campain_start";
		$HeadingsArray[]="campain_end";
		$HeadingsArray[]="subtotal";
		$HeadingsArray[]="discount";
		$HeadingsArray[]="shipping";
		$HeadingsArray[]="additional";
		$HeadingsArray[]="fee";
		$HeadingsArray[]="tax";
		$HeadingsArray[]="amount";
		$HeadingsArray[]="status";
		$HeadingsArray[]="payment_type";
		$HeadingsArray[]="payment_details";
		fputcsv($file,$HeadingsArray);

	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND the_date2 >= %s AND the_date2 <= %s ORDER BY the_date2, the_date DESC", $bus_id, $from_date, $to_date ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$I++; $II++;
	
	$business_id2 = $myrevenuebooks_sql->business_id;
			
			$table = $wpdb->prefix . "myrevenuebooks";
			$myrevenuebooks_sqlc = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id = %s AND business_name <> %s LIMIT 1", $business_id2, $bus_name ));
			foreach ( $myrevenuebooks_sqlc as $myrevenuebooks_sqll ) 
			{ $business_name = $myrevenuebooks_sqll->business_name; }
	$the_id = $myrevenuebooks_sql->id;
	$the_date = $myrevenuebooks_sql->the_date;
	$campain_start = $myrevenuebooks_sql->campain_start;
	$campain_end = $myrevenuebooks_sql->campain_end;
	$reminder = $myrevenuebooks_sql->reminder;
	$reminder_date = $myrevenuebooks_sql->reminder_date;
	$duration = $myrevenuebooks_sql->duration;
	$description = $myrevenuebooks_sql->description;
	$payment_type = $myrevenuebooks_sql->payment_type;
	$payment_details = $myrevenuebooks_sql->payment_details;
	$amount = $myrevenuebooks_sql->amount;
	$status = $myrevenuebooks_sql->status;
	$po_ref = $myrevenuebooks_sql->po_ref;
	$notes = $myrevenuebooks_sql->notes;
	$yyy = date("Y");
		$the_ref = $myrevenuebooks_sql->the_ref;
		$reminder_sent = $myrevenuebooks_sql->reminder_sent;
		$reminder_date_sent = $myrevenuebooks_sql->reminder_date_sent;
		$primary_contact = $myrevenuebooks_sql->primary_contact;
		$secondary_contact = $myrevenuebooks_sql->secondary_contact;
		$primary_email = $myrevenuebooks_sql->primary_email;
		$secondary_email = $myrevenuebooks_sql->secondary_email;
		$ad_html = $myrevenuebooks_sql->ad_html;
				$subtotal = $myrevenuebooks_sql->subtotal;
				$discount = $myrevenuebooks_sql->discount;
				$shipping = $myrevenuebooks_sql->shipping;
				$additional = $myrevenuebooks_sql->additional;
				$fee = $myrevenuebooks_sql->fee;
				$tax = $myrevenuebooks_sql->tax;
					if ($subtotal == "") {$subtotal = "0.00";}
					if ($discount == "") {$discount = "0.00";}
					if ($shipping == "") {$shipping = "0.00";}
					if ($additional == "") {$additional = "0.00";}
					if ($fee == "") {$fee = "0.00";}
					if ($tax == "") {$tax = "0.00";}
			
			$payment_type = $myrevenuebooks_sql->payment_type;
			$payment_details = $myrevenuebooks_sql->payment_details;
			$payment_date = $myrevenuebooks_sql->payment_date;
			$payment_name = $myrevenuebooks_sql->payment_name;
			$payment_email = $myrevenuebooks_sql->payment_email;
			$payment_transid = $myrevenuebooks_sql->payment_transid;


    /* write values to csv */
		$valuesArray=array();
		$valuesArray[]=$payment_date;
		$valuesArray[]=$the_date;
		$valuesArray[]=$the_id;
		$valuesArray[]=$business_name;
		$valuesArray[]=$payment_name;
		$valuesArray[]=$payment_email;
		$valuesArray[]=$payment_transid;
		$valuesArray[]=$po_ref;
		$valuesArray[]=$the_ref;
		$valuesArray[]=$campain_start;
		$valuesArray[]=$campain_end;
		$valuesArray[]=$subtotal;
		$valuesArray[]=$discount;
		$valuesArray[]=$shipping;
		$valuesArray[]=$additional;
		$valuesArray[]=$fee;
		$valuesArray[]=$tax;
		$valuesArray[]=$amount;
		$valuesArray[]=$status;
		$valuesArray[]=$payment_type;
		$valuesArray[]=$payment_details;
		fputcsv($file,$valuesArray);
	}
	
	fclose($file);
	header("Location: $FileName");





	}
?>







<?php wp_enqueue_script('jquery-ui-datepicker'); ?>
 <script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#datepicker').datepicker({
        dateFormat : 'mm/dd/yy'
    	});
    jQuery('#datepicker2').datepicker({
        dateFormat : 'mm/dd/yy'
    	});
	});
</script>








<?php
$to_date = date("m/d/Y"); //default to date
$from_date = "01/01/" . date("Y"); //default from date
	//$ytd_to_date = date("m/d/Y"); //default YTD date
	$ytd_to_date = "12/31/" . date("Y"); //default YTD date
	$ytd_to_date2 = strtotime($ytd_to_date);
	$ytd_from_date = "01/01/" . date("Y"); //default YTD from date
	$ytd_from_date2 = strtotime($ytd_from_date);
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



<!-- YTD totals -->
<div id="mrb_wrapper">


<?php
	$trans_amount_pending2 = 0; //pending amount default
	$trans_amount2 = 0; //paid amount default
	$trans_subtotal = 0; // default
	$trans_discount = 0; // default
	$trans_shipping = 0; // default
	$trans_additional = 0; // default
	$trans_fee = 0; // default
	$trans_tax = 0; // default
	$bus_id = 1;
	$bus_name = "";
	$a = 0;
	$aa = 1;
	
	//defaults
	$mrb_jan=0; $jan=0;
	$mrb_feb=0; $feb=0;
	$mrb_mar=0; $mar=0;
	$mrb_apr=0; $apr=0;
	$mrb_may=0; $may=0;
	$mrb_jun=0; $jun=0;
	$mrb_jul=0; $jul=0;
	$mrb_aug=0; $aug=0;
	$mrb_sep=0; $sep=0;
	$mrb_oct=0; $oct=0;
	$mrb_nov=0; $nov=0;
	$mrb_dec=0; $dec=0;
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND the_date2 >= %s AND the_date2 <= %s ORDER BY the_date2, the_date DESC", $bus_id, $ytd_from_date2, $ytd_to_date2 ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$aa++;
	$id = $myrevenuebooks_sql->id; //business id
	$business_id = $myrevenuebooks_sql->business_id;
		
		$table = $wpdb->prefix . "myrevenuebooks";
		$myrevenuebooks_sqlc = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id = %s AND business_name <> %s", $business_id, $bus_name ));
		foreach ( $myrevenuebooks_sqlc as $myrevenuebooks_sqll ) 
		{ $business_name = $myrevenuebooks_sqll->business_name; 
			
		//Query paid ads only
		if ($myrevenuebooks_sql->status == "Paid") { 
		$trans_subtotal = $trans_subtotal + $myrevenuebooks_sql->subtotal;
		$round_subtotal = round($trans_subtotal, 2);
		$trans_subtotal = $round_subtotal;
		
		$trans_discount = $trans_discount + $myrevenuebooks_sql->discount;
		$round_discount = round($trans_discount, 2);
		$trans_discount = $round_discount;

		$trans_shipping = $trans_shipping + $myrevenuebooks_sql->shipping;
		$round_shipping = round($trans_shipping, 2);
		$trans_shipping = $round_shipping;

		$trans_additional = $trans_additional + $myrevenuebooks_sql->additional;
		$round_additional = round($trans_additional, 2);
		$trans_additional = $round_additional;

		$trans_fee = $trans_fee + $myrevenuebooks_sql->fee;
		$round_fee = round($trans_fee, 2);
		$trans_fee = $round_fee;

		$trans_tax = $trans_tax + $myrevenuebooks_sql->tax;
		$round_tax = round($trans_tax, 2);
		$trans_tax = $round_tax;
		
		$trans_amount2 = $trans_amount2 + $myrevenuebooks_sql->amount;
		$round_amount = round($trans_amount2, 2);
		$trans_amount2 = $round_amount;
		
		$a++; // add the total of paid transactions
		
			$the_mrb_date = $myrevenuebooks_sql->the_date; //get the date of the invoice
			$the_mrb_date_result = substr($the_mrb_date, 0, 2);
				if ($the_mrb_date_result == "01") {$mrb_jan = $mrb_jan + $myrevenuebooks_sql->amount; $jan++; }
				if ($the_mrb_date_result == "02") {$mrb_feb = $mrb_feb + $myrevenuebooks_sql->amount; $feb++; }
				if ($the_mrb_date_result == "03") {$mrb_mar = $mrb_mar + $myrevenuebooks_sql->amount; $mar++; }
				if ($the_mrb_date_result == "04") {$mrb_apr = $mrb_apr + $myrevenuebooks_sql->amount; $apr++; }
				if ($the_mrb_date_result == "05") {$mrb_may = $mrb_may + $myrevenuebooks_sql->amount; $may++; }
				if ($the_mrb_date_result == "06") {$mrb_jun = $mrb_jun + $myrevenuebooks_sql->amount; $jun++; }
				if ($the_mrb_date_result == "07") {$mrb_jul = $mrb_jul + $myrevenuebooks_sql->amount; $jul++; }
				if ($the_mrb_date_result == "08") {$mrb_aug = $mrb_aug + $myrevenuebooks_sql->amount; $aug++; }
				if ($the_mrb_date_result == "09") {$mrb_sep = $mrb_sep + $myrevenuebooks_sql->amount; $sep++; }
				if ($the_mrb_date_result == "10") {$mrb_oct = $mrb_oct + $myrevenuebooks_sql->amount; $oct++; }
				if ($the_mrb_date_result == "11") {$mrb_nov = $mrb_nov + $myrevenuebooks_sql->amount; $nov++; }
				if ($the_mrb_date_result == "12") {$mrb_dec = $mrb_dec + $myrevenuebooks_sql->amount; $dec++; }
			}
			//Query pending ads only
			if ($myrevenuebooks_sql->status <> "Paid") { ;
			$trans_amount_pending2 = $trans_amount_pending2 + $myrevenuebooks_sql->amount;
			$round_amount_pending2 = round($trans_amount_pending2, 2);
			$trans_amount_pending2 = $round_amount_pending2;
				}
		}
	}
	

	//echo "<table align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>";
	//echo "<tr><td><span class='dashicons dashicons-money-alt'></span><b>YTD totals with <u>$a</u> paid transactions:</b> Total Amount (# Transactions)</td></tr>";
	//echo "</table>";
	?>
	
	
	
	
	<table align="left" border="0" cellpadding="4" cellspacing="1" width="100%" bgcolor="#f0f0f0">
	<tr bgcolor="#dbdbdb"><td colspan="6"><b><span class="dashicons dashicons-money-alt"></span> Year-to-date monthly totals:</b>&nbsp;&nbsp;<i>$amount(#transactions)</i></td></tr>
	<tr bgcolor="#ffffff">
		<td><b>January: </b>$<?php echo number_format($mrb_jan, 2, '.', ','); ?> (<?php echo $jan; ?>)</td>
		<td><b>February: </b>$<?php echo number_format($mrb_feb, 2, '.', ','); ?> (<?php echo $feb; ?>)</td>
		<td><b>March: </b>$<?php echo number_format($mrb_mar, 2, '.', ','); ?> (<?php echo $mar; ?>)</td>
		<td><b>April: </b>$<?php echo number_format($mrb_apr, 2, '.', ','); ?> (<?php echo $apr; ?>)</td>
		<td><b>May: </b>$<?php echo number_format($mrb_may, 2, '.', ','); ?> (<?php echo $may; ?>)</td>
		<td><b>June: </b>$<?php echo number_format($mrb_jun, 2, '.', ','); ?> (<?php echo $jun; ?>)</td>
	</tr>
	<tr bgcolor="#ffffff">
		<td><b>July: </b>$<?php echo number_format($mrb_jul, 2, '.', ','); ?> (<?php echo $jul; ?>)</td>
		<td><b>August: </b>$<?php echo number_format($mrb_aug, 2, '.', ','); ?> (<?php echo $aug; ?>)</td>
		<td><b>September: </b>$<?php echo number_format($mrb_sep, 2, '.', ','); ?> (<?php echo $sep; ?>)</td>
		<td><b>October: </b>$<?php echo number_format($mrb_oct, 2, '.', ','); ?> (<?php echo $oct; ?>)</td>
		<td><b>November: </b>$<?php echo number_format($mrb_nov, 2, '.', ','); ?> (<?php echo $nov; ?>)</td>
		<td><b>December: </b>$<?php echo number_format($mrb_dec, 2, '.', ','); ?> (<?php echo $dec; ?>)</td>
	</tr>
	</table>
	
	
	
	
<!--
	<table align="left" border="0" cellpadding="2" cellspacing="2" width="100%">
	<tr><td width="25%"><b>January: </b>$<?php echo number_format($mrb_jan, 2, '.', ','); ?> (<?php echo $jan; ?>)</td>
		<td width="25%"><b>April: </b>$<?php echo number_format($mrb_apr, 2, '.', ','); ?> (<?php echo $apr; ?>)</td>
		<td width="25%"><b>July: </b>$<?php echo number_format($mrb_jul, 2, '.', ','); ?> (<?php echo $jul; ?>)</td>
		<td width="25%"><b>October: </b>$<?php echo number_format($mrb_oct, 2, '.', ','); ?> (<?php echo $oct; ?>)</td></tr>
	<tr><td><b>February: </b>$<?php echo number_format($mrb_feb, 2, '.', ','); ?> (<?php echo $feb; ?>)</td>
		<td><b>May: </b>$<?php echo number_format($mrb_may, 2, '.', ','); ?> (<?php echo $may; ?>)</td>
		<td><b>August: </b>$<?php echo number_format($mrb_aug, 2, '.', ','); ?> (<?php echo $aug; ?>)</td>
		<td><b>November: </b>$<?php echo number_format($mrb_nov, 2, '.', ','); ?> (<?php echo $nov; ?>)</td></tr>
	<tr><td><b>March: </b>$<?php echo number_format($mrb_mar, 2, '.', ','); ?> (<?php echo $mar; ?>)</td>
		<td><b>June: </b>$<?php echo number_format($mrb_jun, 2, '.', ','); ?> (<?php echo $jun; ?>)</td>
		<td><b>September: </b>$<?php echo number_format($mrb_sep, 2, '.', ','); ?> (<?php echo $sep; ?>)</td>
		<td><b>December: </b>$<?php echo number_format($mrb_dec, 2, '.', ','); ?> (<?php echo $dec; ?>)</td></tr>
	</table>
-->
	

	
	<?php
	echo "<table align='left' border='0' cellpadding='4' cellspacing='1' width='100%'>";

				echo "<tr><td bgcolor='#e7e7e7'><b>Pending:</b> $" . number_format($trans_amount_pending2, 2, '.', ',') . "</td>";
				echo "<td bgcolor='#e7e7e7'><b>Subtotal:</b> $" . number_format($trans_subtotal, 2, '.', ',') . "</td>";
				echo "<td bgcolor='#e7e7e7'><b>Discount:</b> $" . number_format($trans_discount, 2, '.', ',') . "</td>";
				echo "<td bgcolor='#e7e7e7'><b>Shipping:</b> $" . number_format($trans_shipping, 2, '.', ',') . "</td>";
				echo "<td bgcolor='#e7e7e7'><b>Additional:</b> $" . number_format($trans_additional, 2, '.', ',') . "</td>";
				echo "<td bgcolor='#e7e7e7'><b>Fee:</b> $" . number_format($trans_fee, 2, '.', ',') . "</td>";
				echo "<td bgcolor='#e7e7e7'><b>Tax:</b> $" . number_format($trans_tax, 2, '.', ',') . "</td>";
				echo "<td bgcolor='#e7e7e7'><b>Total:</b> $" . number_format($trans_amount2, 2, '.', ',') . "</td></tr>";
echo "</table>";

?>


	<table align="left" border="0" cellpadding="4" cellspacing="1" width="100%">
	<tr><td align="right"><i><?php echo $a; ?> YTD Paid Transactions</i></b></td></tr>
	</table>


</div>









<div id="mrb_main_wrapper">
	
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<tr><td align="left" width="25px"><span class="dashicons dashicons-chart-bar"></span></td><td align="left"><h3>Reports: General Report</h3></td></tr>
	</table>
	
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<form name="displayamount" method="post">
	<tr bgcolor="#d2d2d2"><td>Filter Dates From: <input type="text" name="from_date" value="<?php echo $from_date; ?>" size="10" maxlength="50" id="datepicker" />
	To: <input type="text" name="to_date" value="<?php echo $to_date; ?>" size="10" maxlength="50" id="datepicker2" />
	<input type="submit" name="display-submit1" class="button-secondary" value="Get Report" /></td></tr>
	</table>
	</form>
</div>








<?php
	if (!empty($_POST['display-submit1'])) {
			
	$from_date = stripslashes( $_POST['from_date'] );
	if ( ! $from_date ) { $from_date = '01/01/2000'; }
	if ( strlen( $from_date ) > 50 ) { $from_date = substr( $from_date, 0, 50 ); }
	$from_date2 = strtotime($from_date);
	
	$to_date = stripslashes( $_POST['to_date'] );
	if ( ! $to_date ) { $to_date = date("m/d/Y"); }
	if ( strlen( $to_date ) > 50 ) { $to_date = substr( $to_date, 0, 50 ); }
	$to_date2 = strtotime($to_date);

	$bus_id = 1;
	$bus_name = "";
	$I = 0;
	$II = 1;
	?>
	
	
	<!-- <div id="mrb_wrapper2"> -->
	<div id="mrb_main_wrapper">
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<tr><td width="100%"><b>General report results from <?php echo $from_date; ?> - <?php echo $to_date; ?></b></td>
	<td align="right">
	<form name="exportcontacts" method="post" id="download_form" action="admin.php?page=my-revenue-books/myrevenuebooks_reports.php&fromdate=<?php echo $from_date2;?>&todate=<?php echo $to_date2;?>&noheader=true">
	<button class="button-primary" type="submit" name="download_csv" value="">Download (.csv)</button>
	</form>
	</td>
	</tr></table>
	
	
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr bgcolor="#d2d2d2">
	<td width="35px"><b>ID</b></td>
	<td width="75px"><b>Date</b></td>
	<td><b>Name</b></td>
	<td><b>INV/PO</b></td>
	<td><b>REF</b></td>
	<td><b>Contact</b></td>
	<td><b>Amount</b></td>
	<td align="center"><b>Name / Trans ID</b></td>
	<td align="center"><b>Status /<br>Pmt Date</b></td></tr>


	<?php

	
	$trans_amount_pending = 0; //pending amount default
	$trans_amount = 0; //paid amount default
	$trans_subtotal2 = 0; // default
	$trans_discount2 = 0; // default
	$trans_shipping2 = 0; // default
	$trans_additional2 = 0; // default
	$trans_fee2 = 0; // default
	$trans_tax2 = 0; // default
	$bgcolor = "#e1e1e1";
	
	//$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND the_date >= %s AND the_date <= %s ORDER BY the_date DESC", $bus_id, $from_date, $to_date ));
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND the_date2 >= %s AND the_date2 <= %s ORDER BY the_date2, the_date DESC", $bus_id, $from_date2, $to_date2 ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		if($bgcolor=='#ffffff'){$bgcolor='#e1e1e1';}
		else{$bgcolor='#ffffff';}
	$I++; $II++;
	$id = $myrevenuebooks_sql->id; //business id
	$business_id = $myrevenuebooks_sql->business_id;
		
		$table = $wpdb->prefix . "myrevenuebooks";
		$myrevenuebooks_sqlc = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id = %s AND business_name <> %s", $business_id, $bus_name ));
		foreach ( $myrevenuebooks_sqlc as $myrevenuebooks_sqll ) 
		{ $business_name = $myrevenuebooks_sqll->business_name; 
			
		//Query paid ads only
		if ($myrevenuebooks_sql->status == "Paid") { 
		$trans_subtotal2 = $trans_subtotal2 + $myrevenuebooks_sql->subtotal;
		$round_subtotal2 = round($trans_subtotal2, 2);
		$trans_subtotal2 = $round_subtotal2;
		
		$trans_discount2 = $trans_discount2 + $myrevenuebooks_sql->discount;
		$round_discount2 = round($trans_discount2, 2);
		$trans_discount2 = $round_discount2;

		$trans_shipping2 = $trans_shipping2 + $myrevenuebooks_sql->shipping;
		$round_shipping2 = round($trans_shipping2, 2);
		$trans_shipping2 = $round_shipping2;

		$trans_additional2 = $trans_additional2 + $myrevenuebooks_sql->additional;
		$round_additional2 = round($trans_additional2, 2);
		$trans_additional2 = $round_additional2;

		$trans_fee2 = $trans_fee2 + $myrevenuebooks_sql->fee;
		$round_fee2 = round($trans_fee2, 2);
		$trans_fee2 = $round_fee2;

		$trans_tax2 = $trans_tax2 + $myrevenuebooks_sql->tax;
		$round_tax2 = round($trans_tax2, 2);
		$trans_tax2 = $round_tax2;
		
		$trans_amount = $trans_amount + $myrevenuebooks_sql->amount;
		$round_amount = round($trans_amount, 2);
		$trans_amount = $round_amount;
			}
			//Query pending ads only
			if ($myrevenuebooks_sql->status <> "Paid") { ;
			$trans_amount_pending = $trans_amount_pending + $myrevenuebooks_sql->amount;
			$round_amount_pending = round($trans_amount_pending, 2);
			$trans_amount_pending = $round_amount_pending;
				}
		
		}
	$the_id = $myrevenuebooks_sql->id;
	$the_date = $myrevenuebooks_sql->the_date;
	$campain_start = $myrevenuebooks_sql->campain_start;
	$campain_end = $myrevenuebooks_sql->campain_end;
	$reminder = $myrevenuebooks_sql->reminder;
	$reminder_date = $myrevenuebooks_sql->reminder_date;
	$duration = $myrevenuebooks_sql->duration;
	$description = $myrevenuebooks_sql->description;
	$payment_type = $myrevenuebooks_sql->payment_type;
	$payment_details = $myrevenuebooks_sql->payment_details;
	$amount = $myrevenuebooks_sql->amount;
	$status = $myrevenuebooks_sql->status;
	$po_ref = $myrevenuebooks_sql->po_ref;
	$the_ref = $myrevenuebooks_sql->the_ref;
	$primary_contact = $myrevenuebooks_sql->primary_contact;
	$payment_date = $myrevenuebooks_sql->payment_date;
	$payment_name = $myrevenuebooks_sql->payment_name;
	$payment_transid = $myrevenuebooks_sql->payment_transid;
	
	$primary_name_len = strlen("$primary_contact");
		if ($primary_name_len > 20) {$business_name_print = substr(strip_tags($business_name), 0, 20) . "..."; }
			else $business_name_print = $business_name;
	
	$primary_contact_len = strlen("$primary_contact");
		if ($primary_contact_len > 20) {$primary_contact_print = substr(strip_tags($primary_contact), 0, 20) . "...";}
			else $primary_contact_print = $primary_contact;
	
	$payment_name_len = strlen("$payment_name");
		if ($payment_name_len > 30) {$payment_name_print = substr(strip_tags($payment_name), 0, 30) . "...";}
			else $payment_name_print = $payment_name;
	
	$payment_transid_print = strlen("$payment_transid");
		if ($payment_transid_print > 30) {$payment_transid_print = substr(strip_tags($payment_transid), 0, 30) . "...";}
			else $payment_transid_print = $payment_transid;
	
	echo "<tr bgcolor='$bgcolor' height='36px'>
	<td><a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_transaction.php&id=$the_id&b_id=$business_id'>$id</a></td>
	<td>$the_date</td>
	<td>$business_name_print</td>
	<td>$po_ref</td>
	<td>$the_ref</td>
	<td>$primary_contact_print</td>
	<td>$" . number_format($amount, 2, '.', ',') . "</td>
	<td>$payment_name_print<br>$payment_transid_print</td>
	<td align='center'>$status<br>$payment_date</td></tr>";

	}
	echo "<tr><td colspan='9'><b><i><u>$I</u> transactions...</i></b></td>";
	echo "</table>";
	
	
	echo "<table align='right' border='0' cellpadding='2' cellspacing='2' width='25%'>";
				echo "<tr><td align='right'><b>Pending Payments:</b></td><td align='right'>$" . number_format($trans_amount_pending, 2, '.', ',') . "</td></tr>";
				echo "<tr><td align='right'><b>Subtotal:</b></td><td align='right'> $" . number_format($trans_subtotal2, 2, '.', ',') . "</td></tr>";
				echo "<tr><td align='right'><b>Discount:</b></td><td align='right'> $" . number_format($trans_discount2, 2, '.', ',') . "</td></tr>";
				echo "<tr><td align='right'><b>Shipping:</b></td><td align='right'> $" . number_format($trans_shipping2, 2, '.', ',') . "</td></tr>";
				echo "<tr><td align='right'><b>Additional:</b></td><td align='right'> $" . number_format($trans_additional2, 2, '.', ',') . "</td></tr>";
				echo "<tr><td align='right'><b>Fee:</b></td><td align='right'> $" . number_format($trans_fee2, 2, '.', ',') . "</td></tr>";
				echo "<tr><td align='right'><b>Tax:</b></td><td align='right'> $" . number_format($trans_tax2, 2, '.', ',') . "</td></tr>";
				echo "<tr><td align='right'><b>Total:</b></td><td align='right'><b>$" . number_format($trans_amount, 2, '.', ',') . "</b></td></tr>";
	echo "</table>";
	
	
			
		}

?>

</div>



<?php
} // end if security is enabled and security access is true
?>

	
<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->