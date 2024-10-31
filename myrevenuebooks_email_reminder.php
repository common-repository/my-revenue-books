<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Email Reminder";

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







if (!empty($_POST['email-submit'])) {
	
//Sanitize the POST values
	$the_id = stripslashes( $_POST['the_id'] );
	if ( ! $the_id ) { $the_id  = ''; }
	if ( strlen( $the_id ) > 200 ) { $the_id = substr( $the_id, 0, 200 ); }

	$the_b_id = stripslashes( $_POST['the_b_id'] );
	if ( ! $the_b_id ) { $the_b_id  = ''; }
	if ( strlen( $the_b_id ) > 200 ) { $the_b_id = substr( $the_b_id, 0, 200 ); }

	$mrb_business_name = stripslashes( $_POST['mrb_business_name'] );
	if ( ! $mrb_business_name ) { $mrb_business_name  = ''; }
	if ( strlen( $mrb_business_name ) > 200 ) { $mrb_business_name = substr( $mrb_business_name, 0, 200 ); }
	
	$email_from_name = stripslashes( $_POST['email_from_name'] );
	if ( ! $email_from_name ) { $email_from_name  = ''; }
	if ( strlen( $email_from_name ) > 200 ) { $email_from_name = substr( $email_from_name, 0, 200 ); }

	$email_from = stripslashes( $_POST['email_from'] );
	if ( ! $email_from ) { $email_from  = ''; }
	if ( strlen( $email_from ) > 200 ) { $email_from = substr( $email_from, 0, 200 ); }
	
	$email_to = stripslashes( $_POST['email_to'] );
	if ( ! $email_to ) { $email_to  = ''; }
	if ( strlen( $email_to ) > 200 ) { $email_to = substr( $email_to, 0, 200 ); }	
	
	$email_to_cc = stripslashes( $_POST['email_to_cc'] );
	if ( ! $email_to_cc ) { $email_to_cc  = ''; }
	if ( strlen( $email_to_cc ) > 200 ) { $email_to_cc = substr( $email_to_cc, 0, 200 ); }	
	
	$email_to_bcc = stripslashes( $_POST['email_to_bcc'] );
	if ( ! $email_to_bcc ) { $email_to_bcc  = ''; }
	if ( strlen( $email_to_bcc ) > 200 ) { $email_to_bcc = substr( $email_to_bcc, 0, 200 ); }

	$email_subject = stripslashes( $_POST['email_subject'] );
	if ( ! $email_subject ) { $email_subject  = ''; }
	if ( strlen( $email_subject ) > 200 ) { $email_subject = substr( $email_subject, 0, 200 ); }

	//$email_body = stripslashes( $_POST['email_body'] );
	//if ( ! $email_body ) { $email_body  = ''; }
	//if ( strlen( $email_body ) > 5000 ) { $email_body = substr( $email_body, 0, 5000 ); }
	
	$email_body = nl2br($_REQUEST['communication_body']); // Keep line breaks
	$email_body = stripslashes($email_body);
	//$communication_body = stripslashes( $_POST['communication_body'] );
	if ( ! $email_body ) { $email_body  = ''; }
	if ( strlen( $email_body ) > 900000 ) { $email_body = substr( $email_body, 0, 900000 ); }
	
	$reminder_sent = "Yes";
	$reminder_date_sent = date("m/d/Y")." ".date("H").":".date("i").":".date("s");
	$new_reminder_date_sent = date("m/d/Y");

//Send email
include ("includes/myrevenuebooks_email_reminder_send.php");

//Save email to database
	$table2 = $wpdb->prefix . "myrevenuebooks_email";
	$wpdb->query( $wpdb->prepare( "INSERT INTO $table2 (
	the_id,
	business_id,
	email_from_name,
	email_from,
	email_to,
	email_to_cc,
	email_to_bcc,
	email_subject,
	email_body,
	reminder_sent,
	reminder_date_sent
		)
	VALUES ( %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s )
	",
	$the_id,
	$the_b_id,
	$email_from_name,
	$email_from,
	$email_to,
	$email_to_cc,
	$email_to_bcc,
	$email_subject,
	$email_body,
	$reminder_sent,
	$reminder_date_sent
	) );

//Update Reminder Sent
$business_id = $the_b_id;
$table = $wpdb->prefix . "myrevenuebooks";
$wpdb->query($wpdb->prepare("UPDATE $table SET 
		reminder_sent = %s,
		reminder_date_sent = %s
	WHERE business_id = $business_id AND id = $the_id;", 
		$reminder_sent,
		$new_reminder_date_sent
			));


	echo "<meta http-equiv='refresh' content='0; URL=admin.php?page=my-revenue-books/myrevenuebooks_edit_transaction.php&id=$the_id&b_id=$the_b_id'>";
	exit;
}
?>














<!--  SETUP INFORMATION  -->
<?php
	$the_setup_id = 1;
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s", $the_setup_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$mrb_business_name = $myrevenuebooks_sql->business_name;
	$mrb_contact_name = $myrevenuebooks_sql->contact_name;
	$mrb_address = $myrevenuebooks_sql->address;
	$mrb_address2 = $myrevenuebooks_sql->address2;
	$mrb_city = $myrevenuebooks_sql->city;
	$mrb_state = $myrevenuebooks_sql->state;
	$mrb_zip = $myrevenuebooks_sql->zip;
	$mrb_email = $myrevenuebooks_sql->email;
	$mrb_email_template1 = $myrevenuebooks_sql->email_template1;
		if ( ! $mrb_email_template1 ) { $mrb_email_template1 = ''; }
	$mrb_phone = $myrevenuebooks_sql->phone;
	$mrb_phone2 = $myrevenuebooks_sql->phone2;
	$mrb_fax = $myrevenuebooks_sql->fax;
	$mrb_website = $myrevenuebooks_sql->website;
	$mrb_business_logo = $myrevenuebooks_sql->business_logo;
	$mrb_business_info = $myrevenuebooks_sql->business_info;
	}
?>


<?php
	$the_id = sanitize_text_field( $_REQUEST['id'] );
	$the_b_name = "";
	$the_b_id = sanitize_text_field( $_REQUEST['b_id'] );
	
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
	}
			if (! $reminder ) { $reminder = 'No'; }	
			if (! $reminder_sent ) { $reminder_sent = 'No'; }
			if (! $primary_contact ) { $primary_contact = $contact_name; }
			if (! $primary_email ) { $primary_email = $email; }
			
	// Convert Email Template
	$email_string = str_replace("[:primary_contact:]","$primary_contact","$mrb_email_template1"); $mrb_email_template1 = $email_string;
	$email_string = str_replace("[:mrb_business_name:]","$mrb_business_name","$mrb_email_template1"); $mrb_email_template1 = $email_string;
	$email_string = str_replace("[:po_ref:]","$po_ref","$mrb_email_template1"); $mrb_email_template1 = $email_string;
	$email_string = str_replace("[:the_ref:]","$the_ref","$mrb_email_template1"); $mrb_email_template1 = $email_string;	
	$email_string = str_replace("[:campaign_start:]","$campain_start","$mrb_email_template1"); $mrb_email_template1 = $email_string;
	$email_string = str_replace("[:campaign_end:]","$campain_end","$mrb_email_template1"); $mrb_email_template1 = $email_string;
	$email_string = str_replace("[:duration:]","$duration","$mrb_email_template1"); $mrb_email_template1 = $email_string;
	$email_string = str_replace("[:description:]","$description","$mrb_email_template1"); $mrb_email_template1 = $email_string;
	$email_string = str_replace("[:ad_html:]","$ad_html","$mrb_email_template1"); $mrb_email_template1 = $email_string;
	$email_string = str_replace("[:payment_type:]","$payment_type","$mrb_email_template1"); $mrb_email_template1 = $email_string;
	$email_string = str_replace("[:payment_details:]","$payment_details","$mrb_email_template1"); $mrb_email_template1 = $email_string;
	$email_string = str_replace("[:amount:]","$amount","$mrb_email_template1"); $mrb_email_template1 = $email_string;
	$email_string = str_replace("[:status:]","$status","$mrb_email_template1"); $mrb_email_template1 = $email_string;

$email_body = $mrb_email_template1;

?>


<form name="editlisting" method="post">
	<input type="hidden" value="<?php echo htmlspecialchars($the_id); ?>" name="the_id" />
	<input type="hidden" value="<?php echo htmlspecialchars($the_b_id); ?>" name="the_b_id" />
	<input type="hidden" value="<?php echo htmlspecialchars($mrb_business_name); ?>" name="mrb_business_name" />

<table align="left" border="0" cellpadding="1" cellspacing="0" width="800px">
<tr><td width='17%'><b>From (Name):</b></td><td><input type="text" name="email_from_name" value="<?php echo htmlspecialchars($mrb_contact_name); ?>" size="50" maxlength="100"/></td></tr>
<tr><td><b>From (Email Address):</b></td><td><input type="text" name="email_from" value="<?php echo htmlspecialchars($mrb_email); ?>" size="50" maxlength="100"/></td></tr>
</table>

<table align="left" border="0" cellpadding="1" cellspacing="0" width="800px">
<tr><td><b>*To:</b></td><td><input type="text" name="email_to" value="<?php echo htmlspecialchars($primary_email); ?>" size="112" maxlength="200"/></td></tr>
<tr><td><b>*Cc:</b></td><td><input type="text" name="email_to_cc" value="<?php echo htmlspecialchars($secondary_email); ?>" size="112" maxlength="200"/></td></tr>
<tr><td><b>*Bcc:</b></td><td><input type="text" name="email_to_bcc" value="<?php echo htmlspecialchars($mrb_email); ?>" size="112" maxlength="200"/></td></tr>
<tr><td colspan="2"><i>*Separate multiple email addresses with a coma. (Ex: emailaddress@thewebsite.com, thenextemail@thenextwebsite.com)</i></td></tr>
</table>

<table align="left" border="0" cellpadding="4" cellspacing="0" width="800px">
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td><b>Subject:</b></td><td><input type="text" name="email_subject" value="Your <?php echo $mrb_business_name; ?> Ad Plan has expired" size="112" maxlength="200"/></td></tr>
<!-- <tr><td colspan="2"><b>Email Body:</b> *You can set your default email template in <a href="admin.php?page=my-revenue-books/myrevenuebooks_settings.php">settings</a>.</td></tr> -->
<!-- <tr><td colspan="2"><textarea rows="20" cols="123" name="email_body" maxlength="5000"><?php echo htmlspecialchars($email_body); ?></textarea></td></tr> -->

</table>


<?php

$args = array(
    'textarea_rows' => 15,
    'wpautop' => true,
    'teeny' => false,
    'media_buttons' => false,
    'dfw' => false,
    'quicktags' => true
);

?>

<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td><?php wp_editor( $email_body, 'communication_body', $args ); ?></td></tr></table>



<table align="left" border="0" cellpadding="4" cellspacing="0" width="800px">
<tr><td colspan="4" height="45" align="center"><input type="submit" name="email-submit" class="button-primary" value="Send Email" /></td></tr>
</table>






	

<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->