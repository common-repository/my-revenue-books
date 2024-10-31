<?php
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$plugins_url = plugins_url();
$update_status = "N";
//check for security options
$mrb_page = "Transactions";

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


if (!empty($_POST['from_date'])) { $from_date = sanitize_text_field( $_POST['from_date'] ); }
	else $from_date = "01/01/" . date("Y"); //default from date

if (!empty($_POST['to_date'])) { $to_date = sanitize_text_field( $_POST['to_date'] ); }
	else $to_date = date("m/d/Y"); //default to date


$update_status = "N";
$the_id = sanitize_text_field( $_REQUEST['id'] );
$the_b_id = sanitize_text_field( $_REQUEST['b_id'] );
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
    jQuery('#datepicker3').datepicker({
        dateFormat : 'mm/dd/yy'
    	});
    jQuery('#datepicker4').datepicker({
        dateFormat : 'mm/dd/yy'
   		});
	});
	
</script>


<?php
$id = isset($id) ? $id : '';
$b_id = isset($b_id) ? $b_id : '';
$the_o_id = sanitize_text_field( $_REQUEST['id'] );
$the_b_id = sanitize_text_field( $_REQUEST['b_id'] );
$t_id = $the_id; //transaction id
$I=0;
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s", $the_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$business_name = $myrevenuebooks_sql->business_name;
	$address = $myrevenuebooks_sql->address;
	$city = $myrevenuebooks_sql->city;
	$state = $myrevenuebooks_sql->state;
	$zip = $myrevenuebooks_sql->zip;
		if ($address== NULL) { $address = ""; }
		if ($city == NULL) { $city = ""; }
		if ($state == NULL) { $state = ""; }
		if ($zip == NULL) { $zip = ""; }
	}
	
	$default_id = "1";
	$trans_amount_pending = 0; //defaults
	$trans_amount = 0; //defaults

	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND business_id = %s", $default_id, $the_b_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		//Query paid ads only
		if ($myrevenuebooks_sql->status == "Paid") { 
		$trans_amount = $trans_amount + $myrevenuebooks_sql->amount;
			}
			//Query pending ads only
			if ($myrevenuebooks_sql->status <> "Paid") { ;
			$trans_amount_pending = $trans_amount_pending + $myrevenuebooks_sql->amount;
				}
		}
		
		$sub_total_amount = $trans_amount + $trans_amount_pending;
		
	echo "<table align='right' border='0' cellpadding='0' cellspacing='0' width='100%'>";
	echo "<tr><td><br></td></tr>";
	echo "<tr><td><b>" . $business_name . "</b> <a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_adv.php&id=$the_id'>[edit]</a></td></tr>";
	echo "</table>";
	
	echo "<table align='right' border='0' cellpadding='0' cellspacing='0' width='20%'>";
	if ($sub_total_amount > 0) { $fontcolor = '#000000'; }
	if ($sub_total_amount <= 0) { $fontcolor = '#b70000'; }
		echo "<tr><td align='right'><b>Subtotal:</b>&nbsp;</td><td align='left'><font color=$fontcolor>$" . number_format($sub_total_amount, 2, '.', ',') . "</font></td></tr>";
	if ($trans_amount_pending > 0) { $fontcolor = '#2440ff'; }
	if ($trans_amount_pending <= 0) { $fontcolor = '#000000'; }
		echo "<tr><td align='right'><b>Pending:</b>&nbsp;</td><td align='left'><font color=$fontcolor>$" . number_format($trans_amount_pending, 2, '.', ',') . "</font></td></tr>";
	if ($trans_amount >= 0) { $fontcolor = '#000000'; }
	if ($trans_amount < 0) { $fontcolor = '#c40000'; }
		echo "<tr><td align='right'><b>Totals:</b>&nbsp;</td><td align='left'><font color=$fontcolor>$" . number_format($trans_amount, 2, '.', ',') . "</font></td></tr>";
	//echo "<tr><td colspan='2'>&nbsp;</td></tr>";
	echo "</table>";
		
		
	
	echo "<table align='left' border='0' cellpadding='3' cellspacing='0' width='100%'>";
	echo "<form name='displayamount' method='post'>";
	echo "<tr><td width='10px' align='left'><span class='dashicons dashicons-calendar'></span></td>";
	echo "<td align='left' width='165px'><b>Sort from </b><input type='text' name='from_date' value='$from_date' size='8' maxlength='50' id='datepicker' /></td>";
	echo "<td align='left' width='135px'><b>to&nbsp;&nbsp;</b><input type='text' name='to_date' value='$to_date' size='8' maxlength='50' id='datepicker2' /></td>";
	
	echo "<td align='left' width='80px'>
	<select name='amount_sort'>
	<option value='25'>25</option>
	<option value='50'>50</option>
    <option value='75'>75</option>
    <option value='100'>100</option>
    <option value='200'>200</option>
    <option value='300'>300</option>
    <option value='400'>400</option>
    <option value='500'>500</option>
    <option value='750'>750</option>
    <option value='1000'>1000</option>
    <option value='999999'>All</option>
  	</select></td>";
	echo "<td><input type='submit' name='display-submit' class='button-secondary' value='Filter' /></td>";
	//echo "<td align='right'><a href='admin.php?page=my-revenue-books/myrevenuebooks_add_transaction.php&id=$the_id&b_id=$the_b_id'><font color ='#167d00'><span class='dashicons dashicons-welcome-add-page'></span><b>[Add New Transaction]</b></a></font></td></tr>";
	//echo "</table>";
	echo "</form>";
	
	echo "<form method='post' action='admin.php?page=my-revenue-books/myrevenuebooks_add_transaction.php&id=$the_id&b_id=$the_b_id'>";
	echo "<td align='right'><input type='submit' name='add-submit' class='button-secondary' value='Add New Transaction' />&nbsp;</td>";
	echo "</table>";
	echo "</form>";




	
//initial or no sort options
if (empty($_POST['display-submit'])) {
	$the_start = 0;
	$the_end = 25;
	$default_id = "1";
	
	echo "<table align='left' border='0' cellpadding='4' cellspacing='0' width='1000px'>";

	echo "<tr bgcolor='#d2d2d2'><td><b>#</b></td><td><b>Invoice Date</b></td><td><b>INV/PO</b></td><td><b>Ref</b></td><td><b>Contact</b></td><td><b>Start</b></td><td><b>End</b></td><td><b>Reminder/Date</b></td><td><b>Amount</b></td><td><b>Status</b></td><td align='center'><b>Copy</b></td><td align='center'><b>Delete</b></td></tr>";
	
	//$bgcolor = "#ffffff";
	$bgcolor = "#e1e1e1";
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND business_id = %s AND business_name IS NULL ORDER BY ID DESC, the_date2 LIMIT $the_start, $the_end", $default_id, $the_b_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		if($bgcolor=='#ffffff'){$bgcolor='#e1e1e1';}
		else{$bgcolor='#ffffff';}
		//if($bgcolor=='#ffffff'){$bgcolor='';}
		//else{$bgcolor='#ffffff';}
	$I++;
	$id = $myrevenuebooks_sql->id; //business id
	$business_id = $myrevenuebooks_sql->business_id;
	$primary_contact = $myrevenuebooks_sql->primary_contact;
			$primary_contact_len = strlen("$primary_contact");
				if ($primary_contact_len > 20) {$primary_contact_print = substr(strip_tags($primary_contact), 0, 20) . "...";}
				else $primary_contact_print = $primary_contact;

	$the_date = $myrevenuebooks_sql->the_date;
	$campain_start = $myrevenuebooks_sql->campain_start;
		if ($campain_start == "") { $campain_start = "--"; }
	$campain_end = $myrevenuebooks_sql->campain_end;
		if ($campain_end == "") { $campain_end = "--"; }
	$reminder = $myrevenuebooks_sql->reminder;
	$reminder_date = $myrevenuebooks_sql->reminder_date;
		if ($reminder_date == "") { $reminder_date = "None"; }
	$duration = $myrevenuebooks_sql->duration;
	$description = $myrevenuebooks_sql->description;
	$payment_type = $myrevenuebooks_sql->payment_type;
	$payment_details = $myrevenuebooks_sql->payment_details;
	$amount = $myrevenuebooks_sql->amount;
	$status = $myrevenuebooks_sql->status;
	$po_ref = $myrevenuebooks_sql->po_ref;
		if ($po_ref == "") { $po_ref = "--"; }
	$the_ref = $myrevenuebooks_sql->the_ref;
	if ($the_ref == "") { $the_ref = "--"; }	
	
	$copy_logo = "<table align='left' border='0' cellpadding='1' cellspacing='0' width='50px' bgcolor='#d2d2d2'><tr><td align='center'><img src='' alt='Copy'></td></tr></table>";
	$space_logo = "<table align='left' border='0' cellpadding='1' cellspacing='0' width='4px'><tr><td align='center'></td></tr></table>";
	$delete_logo = "<table align='left' border='0' cellpadding='1' cellspacing='0' width='60px' bgcolor='#d2d2d2'><tr><td align='center'><font color='#c40000'>Delete</td></tr></table>";
	
	echo "<tr bgcolor=$bgcolor><td><a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_transaction.php&id=$id&b_id=$business_id'>$id</a></td>
	<td>$the_date</td>
	<td>$po_ref</td>
	<td>$the_ref</td>
	<td>$primary_contact_print</td>
	<td>$campain_start</td>
	<td>$campain_end</td>
	<td>$reminder, $reminder_date</td>
	<td>$" . number_format($amount, 2, '.', ',') . "</td>
	<td>$status</td>"
	?>
	
<!-- <td align="center"><a href="admin.php?page=my-revenue-books/myrevenuebooks_copy_transaction.php&id=<?php echo $id; ?>&b_id=<?php echo $business_id; ?>&the_o_id=<?php echo $the_id; ?>" style="text-decoration: none;"><img src="<?php echo $plugins_url . "/my-revenue-books/images/copy-icon.png"; ?>" alt="Copy" title="Copy"><span class="dashicons dashicons-admin-page"></span></a></td> -->

<!-- <td align="center"><a href="admin.php?page=my-revenue-books/myrevenuebooks_delete_transaction.php&id=<?php echo $id; ?>&t_id=<?php echo $t_id; ?>&b_id=<?php echo $business_id; ?>&_wpnonce=<?php echo $deletenonce; ?> " style="text-decoration: none;"><img src="<?php echo $plugins_url . "/my-revenue-books/images/delete-1-icon.png"; ?>" alt="Delete" title="Delete"><span class='dashicons dashicons-trash'></span></a></td> -->

<td align="center"><a href="admin.php?page=my-revenue-books/myrevenuebooks_copy_transaction.php&id=<?php echo $id; ?>&b_id=<?php echo $business_id; ?>&the_o_id=<?php echo $the_id; ?>" style="text-decoration: none;"><div class='mrb_acct_options_del'><span class="dashicons dashicons-admin-page" title="Copy"></span></div></a></td>

<td align="center"><a href="admin.php?page=my-revenue-books/myrevenuebooks_delete_transaction.php&id=<?php echo $id; ?>&t_id=<?php echo $t_id; ?>&b_id=<?php echo $business_id; ?>&_wpnonce=<?php echo $deletenonce; ?> " style="text-decoration: none;"><div class="mrb_acct_options_del"><span class="dashicons dashicons-trash" title="Delete"></span></div></a></td>
	
	<?php
	}
	echo "<tr><td colspan='11'><br><b>$I total transactions</b></td>";
	echo "</tr></table>";
	}
	
	
	
//with sort options
if (!empty($_POST['display-submit'])) {
	
	$the_end = stripslashes( $_POST['amount_sort'] );
	if ( ! $the_end ) { $the_end = ''; }
	if ( strlen( $the_end ) > 100 ) { $the_end = substr( $the_end, 0, 100 ); }
	
	$from_date = stripslashes( $_POST['from_date'] );
	if ( ! $from_date ) { $from_date = '01/01/2000'; }
	if ( strlen( $from_date ) > 50 ) { $from_date = substr( $from_date, 0, 50 ); }
	
	$to_date = stripslashes( $_POST['to_date'] );
	if ( ! $to_date ) { $to_date = date("m/d/Y"); }
	if ( strlen( $to_date ) > 50 ) { $to_date = substr( $to_date, 0, 50 ); }
	
	$from_date2 = strtotime($from_date);
	$to_date2 = strtotime($to_date);

	$the_start = 0;
	$bus_id = 1;
	$bus_name = "";
	$I = 0;
	$default_id = "1";
	
	echo "<table align='left' border='0' cellpadding='4' cellspacing='0' width='1000px'>";
	echo "<tr bgcolor='#d2d2d2'><td><b>#</b></td><td><b>Invoice Date</b></td><td><b>INV/PO</b></td><td><b>Ref</b><td><b>Contact</b></td></td><td><b>Start</b></td><td><b>End</b></td><td><b>Reminder/Date</b></td><td><b>Amount</b></td><td><b>Status</b></td><td align='center'><b>Copy</b></td><td align='center'><b>Delete</b></td></tr>";
	

	$bgcolor = "#e1e1e1";
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND business_id = %s AND the_date2 >= %s AND the_date2 <= %s AND business_name IS NULL ORDER BY the_date2, ID DESC LIMIT $the_start, $the_end", $default_id, $the_b_id, $from_date2, $to_date2 ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		if($bgcolor=='#ffffff'){$bgcolor='#e1e1e1';}
		else{$bgcolor='#ffffff';}

	$I++;
	$id = $myrevenuebooks_sql->id; //business id
	$business_id = $myrevenuebooks_sql->business_id;
	$primary_contact = $myrevenuebooks_sql->primary_contact;
			$primary_contact_len = strlen("$primary_contact");
				if ($primary_contact_len > 20) {$primary_contact_print = substr(strip_tags($primary_contact), 0, 20) . "...";}
				else $primary_contact_print = $primary_contact;


	$the_date = $myrevenuebooks_sql->the_date;
	$campain_start = $myrevenuebooks_sql->campain_start;
		if ($campain_start == "") { $campain_start = "--"; }
	$campain_end = $myrevenuebooks_sql->campain_end;
		if ($campain_end == "") { $campain_end = "--"; }
	$reminder = $myrevenuebooks_sql->reminder;
	$reminder_date = $myrevenuebooks_sql->reminder_date;
		if ($reminder_date == "") { $reminder_date = "None"; }
	$duration = $myrevenuebooks_sql->duration;
	$description = $myrevenuebooks_sql->description;
	$payment_type = $myrevenuebooks_sql->payment_type;
	$payment_details = $myrevenuebooks_sql->payment_details;
	$amount = $myrevenuebooks_sql->amount;
	$status = $myrevenuebooks_sql->status;
	$po_ref = $myrevenuebooks_sql->po_ref;
		if ($po_ref == "") { $po_ref = "--"; }
	$the_ref = $myrevenuebooks_sql->the_ref;
	if ($the_ref == "") { $the_ref = "--"; }
	
	$copy_logo = "<table align='left' border='0' cellpadding='1' cellspacing='0' width='50px' bgcolor='#d2d2d2'><tr><td align='center'><span class='dashicons dashicons-admin-page'></span></td></tr></table>";
	$space_logo = "<table align='left' border='0' cellpadding='1' cellspacing='0' width='4px'><tr><td align='center'></td></tr></table>";
	$delete_logo = "<table align='left' border='0' cellpadding='1' cellspacing='0' width='60px' bgcolor='#d2d2d2'><tr><td align='center'><font color='#c40000'>Delete</td></tr></table>";
	
	echo "<tr bgcolor=$bgcolor><td><a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_transaction.php&id=$id&b_id=$business_id'>$id</a></td>
	<td>$the_date</td>
	<td>$po_ref</td>
	<td>$the_ref</td>
	<td>$primary_contact_print</td>
	<td>$campain_start</td>
	<td>$campain_end</td>
	<td>$reminder, $reminder_date</td>
	<td>$" . number_format($amount, 2, '.', ',') . "</td>
	<td>$status</td>"
		?>

<td align="center"><a href="admin.php?page=my-revenue-books/myrevenuebooks_copy_transaction.php&id=<?php echo $id; ?>&b_id=<?php echo $business_id; ?>&the_o_id=<?php echo $the_id; ?>" style="text-decoration: none;"><div class='mrb_acct_options_del'><span class="dashicons dashicons-admin-page" title="Copy"></span></div></a></td>

<td align="center"><a href="admin.php?page=my-revenue-books/myrevenuebooks_delete_transaction.php&id=<?php echo $id; ?>&t_id=<?php echo $t_id; ?>&b_id=<?php echo $business_id; ?>&_wpnonce=<?php echo $deletenonce; ?> " style="text-decoration: none;"><div class="mrb_acct_options_del"><span class="dashicons dashicons-trash" title="Delete"></span></div></a></td>
	
	<?php
	}
	echo "<tr><td colspan='11'><br>$I total transactions</td>";
	//echo "<td colspan='2' align='right'><a href='admin.php?page=my-revenue-books/myrevenuebooks_add_transaction.php&id=$the_id&b_id=$the_b_id'><font color ='#167d00'>[Add New Transaction]</a></font></td></tr>";
	echo "</tr></table>";
	}



	


} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->