<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Delete Account";

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



if (!empty($_POST['edit-submit'])) {
	$table = $wpdb->prefix . "myrevenuebooks";
	$the_b_id = sanitize_text_field( $_REQUEST['b_id'] );
	
	$wpdb->query( $wpdb->prepare( "DELETE FROM $table WHERE business_id = %s", $the_b_id ));

	echo "<meta http-equiv='refresh' content='0; URL=admin.php?page=my-revenue-books/myrevenuebooks_index.php'>";

exit;
}
?>






<?php
	$id = isset($id) ? $id : '';
	$b_id = isset($b_id) ? $b_id : '';
	$the_id = sanitize_text_field( $_REQUEST['id'] );
	$the_b_id = sanitize_text_field( $_REQUEST['b_id'] );
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s", $the_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$the_bus_id = $myrevenuebooks_sql->id;
	$business_name = $myrevenuebooks_sql->business_name;
	$business_id = $myrevenuebooks_sql->business_id;
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
	$business_info = $myrevenuebooks_sql->business_info;
	}

?>



<table align="left" border="0" cellpadding="4" cellspacing="0" width="1000px">
<form name="editlisting" method="post">

<tr><td colspan="2"><h2><b>Delete:</b></h2></td></tr>

<tr bgcolor="#ffffff"><td><b>Business Name:</b></td>
<td><?php echo htmlspecialchars($business_name); ?></td></tr>

<tr><td><b>Contact Name:</b></td>
<td><?php echo htmlspecialchars($contact_name); ?></td></tr>

<tr bgcolor="#ffffff"><td><b>Address:</b></td>
<td><?php echo htmlspecialchars($address); ?><br>
	<?php echo htmlspecialchars($city); ?>, <?php echo htmlspecialchars($state); ?> <?php echo htmlspecialchars($zip); ?></td></tr>

<tr><td><b>Phone Number:</b></td>
<td><?php echo htmlspecialchars($phone); ?></td></tr>

<tr bgcolor="#ffffff"><td><b>Optional Phone Number:</b></td>
<td><?php echo htmlspecialchars($phone2); ?></td></tr>

<tr><td><b>Email Address:</b></td>
<td><?php echo htmlspecialchars($email); ?></td></tr>

<tr bgcolor="#ffffff"><td><b>Fax Number:</b></td>
<td><?php echo htmlspecialchars($fax); ?></td></tr>

<tr><td><b>Website URL:</b></td>
<td><?php echo htmlspecialchars($website); ?></td></tr>

<tr><td colspan='2' align='center'><b>*Note this will also delete <b><u>ALL</u></b> of the transactions for this account!</b></td></tr>
<tr><td colspan='2' align='center'><b>*You can also move transactions from this account to another account by clicking on each transaction and selecting move.</b></td></tr>
<tr><td colspan='2' align='center'><b><br><font color = '#c40000'>Are you sure you want to delete <?php echo htmlspecialchars($business_name); ?> ?</font></b> No, <a href='admin.php?page=my-revenue-books/myrevenuebooks_index.php'>go back</a></td></tr>
<tr><td colspan="2" height="45" align="center"><input type="submit" name="edit-submit" class="button-primary" value="Delete" /></td></tr>

</tr></table>
</form>

<?php
$the_start = 0;
$the_end = 1000;
$I=0;

	echo "<table align='left' border='0' cellpadding='4' cellspacing='0' width='1000px'>";
	echo "<tr><td colspan='8'><br><b>Transactions</b></td></tr>";
	echo "<tr bgcolor='#d2d2d2'><td><b>#</b></td><td>Invoice Date</td><td>PO/Ref</td><td>Start</td><td>End</td><td>Rem</td><td>Rem Date</td><td>Amount</td><td>Status</td></tr>";
	
	$bgcolor = "#ffffff";
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND business_id = %s ORDER BY the_date DESC LIMIT $the_start, $the_end", $the_id, $the_b_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		if($bgcolor=='#ffffff'){$bgcolor='';}
		else{$bgcolor='#ffffff';}
	$I++;
	$id = $myrevenuebooks_sql->id;
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
	
	echo "<tr bgcolor=$bgcolor><td><a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_transaction.php&id=$id&b_id=$business_id'>$id</a></td>
	<td>$the_date</td>
	<td>$po_ref</td>
	<td>$campain_start</td>
	<td>$campain_end</td>
	<td>$reminder</td>
	<td>$reminder_date</td>
	<td>$ $amount</td>
	<td>$status</td></tr>";
	
	}
	echo "<tr><td colspan='8'><br>$I total transactions</td></tr>";
	echo "</table>";







	


} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->