<?php
global $wpdb;
$plugins_url = plugins_url();
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Reports";
$the_start = 0;
$the_end = 900000;

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





if (isset($_POST['download_csv'])) {
global $wpdb;

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
$II = 0;
$col_count = 0;
$col = 0;
	$the_id = stripslashes( $_POST['the_post_id'] );
	if ( ! $the_id ) { $the_id = ''; }
	if ( strlen( $the_id ) > 100 ) { $the_id = substr( $the_id, 0, 100 ); }





include ("includes/clean_transaction_report2.php");


$FileName = "mrb_account_report.csv";
$file = fopen($FileName,"w");
$HeadingsArray=array();
	$HeadingsArray[]="NAME";
for ($x = 1; $x <= $col_count; $x++) {
$HeadingsArray[]=$col["C$x"];
}
fputcsv($file,$HeadingsArray);


	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s", $the_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$business_name = $myrevenuebooks_sql->business_name;
	$the_b_id = $myrevenuebooks_sql->business_id; //business id
	$address = $myrevenuebooks_sql->address;
	$city = $myrevenuebooks_sql->city;
	$state = $myrevenuebooks_sql->state;
	$zip = $myrevenuebooks_sql->zip;
	}
	
	$trans_amount_pending = 0; //defaults
	$trans_amount = 0; //defaults
	$default_id = 1; //default
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND business_id = %s AND the_date2 >= %s AND the_date2 <= %s", $default_id, $the_b_id, $from_date2, $to_date2 ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		//Query paid ads only
		if ($myrevenuebooks_sql->status == "Paid") { 
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




	$I=1;
	$trans_amount_pending = 0; //pending amount default
	$trans_amount = 0; //paid amount default
	$bgcolor = "#ffffff";
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND business_id = %s AND the_date2 >= %s AND the_date2 <= %s ORDER BY the_date DESC LIMIT $the_start, $the_end", $default_id, $the_b_id, $from_date2, $to_date2 ));
	//$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND the_date2 >= %s AND the_date2 <= %s ORDER BY the_date2, the_date DESC", $bus_id, $from_date2, $to_date2 ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		if($bgcolor=='#ffffff'){$bgcolor='';}
		else{$bgcolor='#ffffff';}
	//$I++; 
	$II++;
	$id = $myrevenuebooks_sql->id; //business id
	$business_id = $myrevenuebooks_sql->business_id;
		
		$table = $wpdb->prefix . "myrevenuebooks";
		$myrevenuebooks_sqlc = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id = %s AND business_name <> %s", $business_id, $bus_name ));
		foreach ( $myrevenuebooks_sqlc as $myrevenuebooks_sqll ) 
		{ $business_name = $myrevenuebooks_sqll->business_name; 
			$the_b_id = $myrevenuebooks_sql->business_id; //business id 
			
					//Query paid ads only
		if ($myrevenuebooks_sql->status == "Paid") { 
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



$valuesArray=array();
$valuesArray[]=$business_name;
if ($I <= $col_count && $col['C'.$I]=='DATE') {$the_date = $myrevenuebooks_sql->the_date; $valuesArray[]=$the_date; $I++;}
if ($I <= $col_count && $col['C'.$I]=='PO/INV') {$po_ref = $myrevenuebooks_sql->po_ref; $valuesArray[]=$po_ref; $I++;}
if ($I <= $col_count && $col['C'.$I]=='REF') {$the_ref = $myrevenuebooks_sql->the_ref; $valuesArray[]=$the_ref; $I++;}
if ($I <= $col_count && $col['C'.$I]=='START') {$campain_start = $myrevenuebooks_sql->campain_start; $valuesArray[]=$campain_start; $I++;}
if ($I <= $col_count && $col['C'.$I]=='END') {$campain_end = $myrevenuebooks_sql->campain_end; $valuesArray[]=$campain_end; $I++;}
if ($I <= $col_count && $col['C'.$I]=='DURATION') {$duration = $myrevenuebooks_sql->duration; $valuesArray[]=$duration; $I++;}
if ($I <= $col_count && $col['C'.$I]=='REMINDER') {$reminder = $myrevenuebooks_sql->reminder; $valuesArray[]=$reminder; $I++;}
if ($I <= $col_count && $col['C'.$I]=='REM DATE') {$reminder_date = $myrevenuebooks_sql->reminder_date; $valuesArray[]=$reminder_date; $I++;}
if ($I <= $col_count && $col['C'.$I]=='REM SENT') {$reminder_sent = $myrevenuebooks_sql->reminder_sent; $valuesArray[]=$reminder_sent; $I++;}
if ($I <= $col_count && $col['C'.$I]=='REM DATE SENT') {$reminder_date_sent = $myrevenuebooks_sql->reminder_date_sent; $valuesArray[]=$reminder_date_sent; $I++;}
if ($I <= $col_count && $col['C'.$I]=='DESCRIPTION') {$description = $myrevenuebooks_sql->description; $valuesArray[]=$description; $I++;}
if ($I <= $col_count && $col['C'.$I]=='AD HTML') {$ad_html = $myrevenuebooks_sql->ad_html; $valuesArray[]=$ad_html; $I++;}
if ($I <= $col_count && $col['C'.$I]=='PRIMARY CONTACT') {$primary_contact = $myrevenuebooks_sql->primary_contact; $valuesArray[]=$primary_contact; $I++;}
if ($I <= $col_count && $col['C'.$I]=='PRIMARY EMAIL') {$primary_email = $myrevenuebooks_sql->primary_email; $valuesArray[]=$primary_email; $I++;}
if ($I <= $col_count && $col['C'.$I]=='SECONDARY CONTACT') {$secondary_contact = $myrevenuebooks_sql->secondary_contact; $valuesArray[]=$secondary_contact; $I++;}
if ($I <= $col_count && $col['C'.$I]=='SECONDARY EMAIL') {$secondary_email = $myrevenuebooks_sql->secondary_email; $valuesArray[]=$secondary_email; $I++;}
if ($I <= $col_count && $col['C'.$I]=='PAYMENT TYPE') {$payment_type = $myrevenuebooks_sql->payment_type; $valuesArray[]=$payment_type; $I++;}
if ($I <= $col_count && $col['C'.$I]=='PAYMENT DETAILS') {$payment_details = $myrevenuebooks_sql->payment_details; $valuesArray[]=$payment_details; $I++;}
if ($I <= $col_count && $col['C'.$I]=='SUBTOTAL') {$subtotal = $myrevenuebooks_sql->subtotal; $valuesArray[]=$subtotal; $I++;}
if ($I <= $col_count && $col['C'.$I]=='DISCOUNT') {$discount = $myrevenuebooks_sql->discount; $valuesArray[]=$discount; $I++;}
if ($I <= $col_count && $col['C'.$I]=='SHIPPING') {$shipping = $myrevenuebooks_sql->shipping; $valuesArray[]=$shipping; $I++;}
if ($I <= $col_count && $col['C'.$I]=='ADDL FEE') {$additional = $myrevenuebooks_sql->additional; $valuesArray[]=$additional; $I++;}
if ($I <= $col_count && $col['C'.$I]=='FEE') {$fee = $myrevenuebooks_sql->fee; $valuesArray[]=$fee; $I++;}
if ($I <= $col_count && $col['C'.$I]=='TAX') {$tax = $myrevenuebooks_sql->tax; $valuesArray[]=$tax; $I++;}
if ($I <= $col_count && $col['C'.$I]=='TOTAL AMOUNT') {$amount = $myrevenuebooks_sql->amount; $valuesArray[]=$amount; $I++;}
if ($I <= $col_count && $col['C'.$I]=='STATUS') {$status = $myrevenuebooks_sql->status; $valuesArray[]=$status; $I++;}
if ($I <= $col_count && $col['C'.$I]=='NOTES') {$notes = $myrevenuebooks_sql->notes; $valuesArray[]=$notes; $I++;}
if ($I <= $col_count && $col['C'.$I]=='LOG NOTES') {$log_notes = $myrevenuebooks_sql->log_notes; $valuesArray[]=$log_notes; $I++;}
if ($I > $col_count) {$I=1;}

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
$col_count = 0;
$the_id = "1";
$the_bus_name = "";

include ("includes/reports_accounts_checkbox.php");


	if (!empty($_POST['display-submit'])) {
		
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
	$II = 0;
	//$col_count = 0;
	$col = 0;
	
include ("includes/clean_transaction_report.php");

	$the_id = stripslashes( $_POST['the_business_id'] );
	if ( ! $the_id ) { $the_id = ''; }
	if ( strlen( $the_id ) > 100 ) { $the_id = substr( $the_id, 0, 100 ); }

	//check for selections
	//if (!empty($_POST['the_business_id'])) { echo "<table align='left' border='0' cellpadding='0' cellspacing='0' width='800px'><tr><td><h1><b><font color='#a20900'>No Account Selected!</font><b></h1></td></tr>"; exit; }
	if ($the_id == "") { echo "<table align='left' border='0' cellpadding='0' cellspacing='0' width='800px'><tr><td><h1><b><font color='#a20900'>No Account Selected!</font><b></h1></td></tr>"; exit; }
	//if ($col_count == 0) { echo "<table align='left' border='0' cellpadding='0' cellspacing='0' width='800px'><tr><td><h1><b><font color='#a20900'>No Columns Selected!</font><b></h1></td></tr>"; exit; }

?>

<div id="mrb_wrapper2">
		<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<tr><td width="670px"><b>Results from <?php echo $from_date; ?> - <?php echo $to_date; ?></b></td>
	<td>
	
	<?php include ("includes/reports_accounts_checkbox2.php"); ?>
	
	</td>
	</tr>
	</table>


<?php

	echo "<table align='left' border='0' cellpadding='4' cellspacing='0' width='100%'>";
	echo "<td bgcolor='#d9d9d9'><b>NAME</b></td>";
		for ($x = 1; $x <= $col_count; $x++) { $columnoutput = "C$x";
			echo "<td bgcolor='#d9d9d9'><b>$col[$columnoutput]</b></td>";
			}
			echo "</tr>";

	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s", $the_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$business_name = $myrevenuebooks_sql->business_name;
	$the_b_id = $myrevenuebooks_sql->business_id; //business id
	$address = $myrevenuebooks_sql->address;
	$city = $myrevenuebooks_sql->city;
	$state = $myrevenuebooks_sql->state;
	$zip = $myrevenuebooks_sql->zip;
	}
	
	$trans_amount_pending = 0; //defaults
	$trans_amount = 0; //defaults
	$default_id = 1; //default
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND business_id = %s AND the_date2 >= %s AND the_date2 <= %s", $default_id, $the_b_id, $from_date2, $to_date2 ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		//Query paid ads only
		if ($myrevenuebooks_sql->status == "Paid") { 
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




	$I=1;
	$trans_amount_pending = 0; //pending amount default
	$trans_amount = 0; //paid amount default
	$bgcolor = "#ffffff";
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND business_id = %s AND the_date2 >= %s AND the_date2 <= %s ORDER BY the_date DESC LIMIT $the_start, $the_end", $default_id, $the_b_id, $from_date2, $to_date2 ));
	//$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND the_date2 >= %s AND the_date2 <= %s ORDER BY the_date2, the_date DESC", $bus_id, $from_date2, $to_date2 ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		if($bgcolor=='#ffffff'){$bgcolor='';}
		else{$bgcolor='#ffffff';}
	//$I++; 
	$II++;
	$id = $myrevenuebooks_sql->id; //business id
	$business_id = $myrevenuebooks_sql->business_id;
		
		$table = $wpdb->prefix . "myrevenuebooks";
		$myrevenuebooks_sqlc = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id = %s AND business_name <> %s", $business_id, $bus_name ));
		foreach ( $myrevenuebooks_sqlc as $myrevenuebooks_sqll ) 
		{ $business_name = $myrevenuebooks_sqll->business_name; 
			$the_b_id = $myrevenuebooks_sql->business_id; //business id 
			
					//Query paid ads only
		if ($myrevenuebooks_sql->status == "Paid") { 
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
			











$business_name_print = substr(strip_tags($business_name), 0, 20) . "...";

	echo "<tr bgcolor=$bgcolor>";
	echo "<td>$business_name_print</td>";
	if ($I <= $col_count && $col['C'.$I]=='DATE') {$the_date = $myrevenuebooks_sql->the_date; echo "<td>$the_date</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='PO/INV') {$po_ref = $myrevenuebooks_sql->po_ref; echo "<td>$po_ref</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='REF') {$the_ref = $myrevenuebooks_sql->the_ref; echo "<td>$the_ref</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='START') {$campain_start = $myrevenuebooks_sql->campain_start; echo "<td>$campain_start</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='END') {$campain_end = $myrevenuebooks_sql->campain_end; echo "<td>$campain_end</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='DURATION') {$duration = $myrevenuebooks_sql->duration; echo "<td>$duration</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='REMINDER') {$reminder = $myrevenuebooks_sql->reminder; echo "<td>$reminder</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='REM DATE') {$reminder_date = $myrevenuebooks_sql->reminder_date; echo "<td>$reminder_date</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='REM SENT') {$reminder_sent = $myrevenuebooks_sql->reminder_sent; echo "<td>$reminder_sent</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='REM DATE SENT') {$reminder_date_sent = $myrevenuebooks_sql->reminder_date_sent; echo "<td>$reminder_date_sent</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='DESCRIPTION') {$description = $myrevenuebooks_sql->description; echo "<td>$description</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='AD HTML') {$ad_html = $myrevenuebooks_sql->ad_html; echo "<td>$ad_html</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='PRIMARY CONTACT') {$primary_contact = $myrevenuebooks_sql->primary_contact; echo "<td>$primary_contact</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='PRIMARY EMAIL') {$primary_email = $myrevenuebooks_sql->primary_email; echo "<td>$primary_email</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='SECONDARY CONTACT') {$secondary_contact = $myrevenuebooks_sql->secondary_contact; echo "<td>$secondary_contact</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='SECONDARY EMAIL') {$secondary_email = $myrevenuebooks_sql->secondary_email; echo "<td>$secondary_email</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='PAYMENT TYPE') {$payment_type = $myrevenuebooks_sql->payment_type; echo "<td>$payment_type</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='PAYMENT DETAILS') {$payment_details = $myrevenuebooks_sql->payment_details; echo "<td>$payment_details</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='SUBTOTAL') {$subtotal = $myrevenuebooks_sql->subtotal; echo "<td>$subtotal</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='DISCOUNT') {$discount = $myrevenuebooks_sql->discount; echo "<td>$discount</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='SHIPPING') {$shipping = $myrevenuebooks_sql->shipping; echo "<td>$shipping</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='ADDL FEE') {$additional = $myrevenuebooks_sql->additional; echo "<td>$additional</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='FEE') {$fee = $myrevenuebooks_sql->fee; echo "<td>$fee</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='TAX') {$tax = $myrevenuebooks_sql->tax; echo "<td>$tax</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='TOTAL AMOUNT') {$amount = $myrevenuebooks_sql->amount; echo "<td>$amount</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='STATUS') {$status = $myrevenuebooks_sql->status; echo "<td>$status</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='NOTES') {$notes = $myrevenuebooks_sql->notes; echo "<td>$notes</td>"; $I++;}
	if ($I <= $col_count && $col['C'.$I]=='LOG NOTES') {$log_notes = $myrevenuebooks_sql->log_notes; echo "<td>$log_notes</td>"; $I++;}
	if ($I > $col_count) {$I=1;}
}

	echo "</tr>";
	echo "<tr><td><br>$II total transactions</td>";
	echo "</table>";

	echo "<table align='left' border='0' cellpadding='2' cellspacing='0' width='100%'>";
		if ($trans_amount_pending > 0) { $fontcolor = '#2440ff'; }
	if ($trans_amount_pending <= 0) { $fontcolor = '#000000'; }
		echo "<tr><td align='right'><b>Pending Payments:</b></td> <td width='70px'><font color=$fontcolor>$" . number_format($trans_amount_pending, 2, '.', ',') . "</font></td></tr>";
	if ($trans_amount >= 0) { $fontcolor = '#000000'; }
	if ($trans_amount < 0) { $fontcolor = '#c40000'; }
		echo "<tr><td align='right'><b>Total:</b></td> <td width='70px'><font color=$fontcolor>$" . number_format($trans_amount, 2, '.', ',') . "</font></td></tr>";
		echo "</table>";

}
?>
</div>



	

<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->