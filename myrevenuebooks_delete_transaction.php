<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";

$deletenonce=$_REQUEST['_wpnonce'];
if (! wp_verify_nonce($deletenonce, 'my-nonce') ) die("Unable to complete your request!");

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




///////////// START DELETE /////////////////


if (!empty($_POST['edit-submit'])) {
	$table = $wpdb->prefix . "myrevenuebooks";
	$the_id = sanitize_text_field( $_REQUEST['id'] );
	$the_b_id = sanitize_text_field( $_REQUEST['b_id'] );
	$the_trans_id = sanitize_text_field( $_REQUEST['t_id'] ); //transaction id
	
	$wpdb->query( $wpdb->prepare( "DELETE FROM $table WHERE id = %s AND business_id = %s", $the_id, $the_b_id ));

	echo "<meta http-equiv='refresh' content='0; URL=admin.php?page=my-revenue-books/myrevenuebooks_view_transactions.php&id=$the_trans_id&b_id=$the_b_id'>";

exit;
}

?>









<?php
	$the_id = sanitize_text_field( $_REQUEST['id'] ); //business id
	$the_trans_id = sanitize_text_field( $_REQUEST['t_id'] ); //transaction id
	$the_b_id = sanitize_text_field( $_REQUEST['b_id'] ); //business id
	$the_b_name = "";
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id = %s AND business_name <> %s", $the_b_id, $the_b_name ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$business_name = $myrevenuebooks_sql->business_name;
	$address = $myrevenuebooks_sql->address;
	$city = $myrevenuebooks_sql->city;
	$state = $myrevenuebooks_sql->state;
	$zip = $myrevenuebooks_sql->zip;
	$contact_name = $myrevenuebooks_sql->contact_name;
	$address = $myrevenuebooks_sql->address;
	$address2 = $myrevenuebooks_sql->address2;
	$city = $myrevenuebooks_sql->city;
	$state = $myrevenuebooks_sql->state;
	$zip = $myrevenuebooks_sql->zip;
	$email = $myrevenuebooks_sql->email;
	$phone = $myrevenuebooks_sql->phone;
	$phone2 = $myrevenuebooks_sql->phone2;
	$fax = $myrevenuebooks_sql->fax;
	$website = $myrevenuebooks_sql->website;
	$business_logo = $myrevenuebooks_sql->business_logo;
	}
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s", $the_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$business_id = $myrevenuebooks_sql->business_id;
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
	$notes = $myrevenuebooks_sql->notes;
	$yyy = date("Y");
	}

?>
	

<div id="mrb_invoice_wrapper">



<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
<form name="editlisting" method="post">

<input type="hidden" value="<?php echo htmlspecialchars($business_id); ?>" name="business_id" />
<input type="hidden" value="<?php echo htmlspecialchars($business_name); ?>" name="business_name" />

<tr><td><h2><font color="#9b0000"><b>Delete invoice for <?php echo htmlspecialchars($business_name); ?></b></font></h2></td></tr>
</table>

<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">

<tr bgcolor="#ffffff"><td width="175px"><b>Invoice Date:</b></td>
<td><?php echo htmlspecialchars($the_date); ?></td></tr>

<tr><td><b>PO or Reference #:</b></td>
<td><?php echo htmlspecialchars($po_ref); ?> | <?php echo htmlspecialchars($the_ref); ?></td></tr>

<tr><td colspan="2" bgcolor="#d3d3d3"><b>Ad Duration:</b></td></tr>

<tr><td><b>Start Date:</b></td><td><?php echo htmlspecialchars($campain_start); ?></td></tr>
<tr><td><b>End Date:</b></td><td><?php echo htmlspecialchars($campain_end); ?></td></tr>

<tr bgcolor="#ffffff"><td><b>Reminder:</b></td><td><?php echo htmlspecialchars($reminder); ?></td></tr>
<tr bgcolor="#ffffff"><td><b>Reminder Date:</b></td><td><?php echo htmlspecialchars($reminder_date); ?></td></tr>

<tr><td><b>Duration:</b></td>
<td colspan="3"><?php echo htmlspecialchars($duration); ?></td></tr>

<tr><td bgcolor="#d3d3d3" colspan="2"><b>Ad Details:</b></td></tr>

<tr bgcolor="#ffffff"><td><b>Ad Description:</b></td>
<td><?php echo htmlspecialchars($description); ?></td></tr>

<tr><td><b>Payment Type:</b></td>
<td><?php echo htmlspecialchars($payment_type); ?></td></tr>

<tr bgcolor="#ffffff"><td><b>Payment Details:</b></td>
<td><?php echo htmlspecialchars($payment_details); ?></td></tr>

<tr><td><b>Amount:</b></td>
<td>$ <?php echo htmlspecialchars($amount); ?></td></tr>

<tr bgcolor="#ffffff"><td><b>Status:</b></td>
<td><?php echo htmlspecialchars($status); ?></td></tr>

<tr><td><b>Notes:</b></td>
<td><?php echo htmlspecialchars($notes); ?></td></tr>

<tr><td align='center' colspan="2"><b><br><font color = '#c40000'>Are you sure you want to delete this transaction?</font></b> No, <a href='admin.php?page=my-revenue-books/myrevenuebooks_view_transactions.php&id=<?php echo $the_trans_id; ?>&b_id=<?php echo $the_b_id; ?>'>go back</a></td></tr>

<tr><td colspan="2" height="45" align="center"><input type="submit" name="edit-submit" class="button-secondary" value="Delete Transaction" /></td></tr>

</tr></table>
</form>

<?php
$update_status="Y";

?>
</div>




	

<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->