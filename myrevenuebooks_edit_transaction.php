<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
if (! wp_verify_nonce($deletenonce, 'my-nonce') ) die("Unable to complete your request!");
$update_status = "N";
	$the_id = sanitize_text_field( $_REQUEST['id'] );
	$the_b_name = "";
	$the_b_id = sanitize_text_field( $_REQUEST['b_id'] );
	$get_id = 0; //set default for log files
	if(isset($_REQUEST['get_id'])){ $get_id = $_REQUEST['get_id']; }


//check for security options
$mrb_page = "Edit Transaction";

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
	if ($the_security_option == "Enabled" && $mrb_current_user_id > 0 || $the_security_option == "Disabled") { 	?>




<?php 

if (!empty($_POST['edit-submit'])) {

$update_status="Y";
include ("includes/clean_add_plan.php");

$business_name = stripslashes( $_POST['business_name'] );
if ( ! $business_name ) { $business_name = ''; }
if ( strlen( $business_name ) > 200 ) { $business_name = substr( $business_name, 0, 200 ); }

$last_edited = date("m-d-Y")." ".date("H").":".date("i").":".date("s");
$amount = $subtotal + $discount + $shipping + $additional + $fee + $tax;



// -------------------------------------------- WORKORDER --------------------------------------------
	if (isset($_POST['workorder_type'])) {
	$workorder_type = sanitize_text_field($_POST['workorder_type'] ); } else $workorder_type = "";
	if ( ! $workorder_type ) { $workorder_type = ''; }
	if ( strlen( $workorder_type ) > 100 ) { $workorder_type = substr( $workorder_type, 0, 100 ); }
	
	
//if a workorder, get entries...if not, then insert blank entries
if ($workorder_type == "Workorder") {

	// clean the submitted workorder information
	if (isset($_POST['workorder_status'])) {
	$workorder_status = sanitize_text_field($_POST['workorder_status'] ); } else $workorder_status = "";
	if ( ! $workorder_status ) { $workorder_status = ''; }
	if ( strlen( $workorder_status ) > 100 ) { $workorder_status = substr( $workorder_status, 0, 100 ); }
	
	if (isset($_POST['workorder_file_status'])) {
	$workorder_file_status = sanitize_text_field($_POST['workorder_file_status'] ); } else $workorder_file_status = "";
	if ( ! $workorder_file_status ) { $workorder_file_status = ''; }
	if ( strlen( $workorder_file_status ) > 100 ) { $workorder_file_status = substr( $workorder_file_status, 0, 100 ); }
	
	if (isset($_POST['workorder_assigned'])) {
	$workorder_assigned_id = sanitize_text_field($_POST['workorder_assigned'] ); } else $workorder_assigned_id = "";
	if ( ! $workorder_assigned_id ) { $workorder_assigned_id = ''; }
	if ( strlen( $workorder_assigned_id ) > 100 ) { $workorder_assigned_id = substr( $workorder_assigned_id, 0, 100 ); }
	
	if (isset($_POST['workorder_type'])) {
	$workorder_type = sanitize_text_field($_POST['workorder_type'] ); } else $workorder_type = "";
	if ( ! $workorder_type ) { $workorder_type = ''; }
	if ( strlen( $workorder_type ) > 100 ) { $workorder_type = substr( $workorder_type, 0, 100 ); }
	
	if (isset($_POST['workorder_commission'])) {
	$workorder_commission = sanitize_text_field($_POST['workorder_commission'] ); } else $workorder_commission = "";
	if ( ! $workorder_commission ) { $workorder_commission = ''; }
	if ( strlen( $workorder_commission ) > 100 ) { $workorder_commission = substr( $workorder_commission, 0, 100 ); }
	
	if (isset($_POST['workorder_username'])) {
	$workorder_username = sanitize_text_field($_POST['workorder_username'] ); } else $workorder_username = "";
	if ( ! $workorder_username ) { $workorder_username = ''; }
	if ( strlen( $workorder_username ) > 100 ) { $workorder_username = substr( $workorder_username, 0, 100 ); }

	if (isset($_POST['workorder_due_date'])) {
	$workorder_due_date = sanitize_text_field($_POST['workorder_due_date'] ); } else $workorder_due_date = "";
	if ( ! $workorder_due_date ) { $workorder_due_date = ''; }
	if ( strlen( $workorder_due_date ) > 100 ) { $workorder_due_date = substr( $workorder_due_date, 0, 100 ); }
	
	if (isset($_POST['workorder_payment_details'])) {
	$workorder_payment_details = sanitize_text_field($_POST['workorder_payment_details'] ); } else $workorder_payment_details = "";
	if ( ! $workorder_payment_details ) { $workorder_payment_details = ''; }
	if ( strlen( $workorder_payment_details ) > 500 ) { $workorder_payment_details = substr( $workorder_payment_details, 0, 500 ); }

	if (isset($_POST['workorder_payment_date'])) {
	$workorder_payment_date = sanitize_text_field($_POST['workorder_payment_date'] ); } else $workorder_payment_date = "";
	if ( ! $workorder_payment_date ) { $workorder_payment_date = ''; }
	if ( strlen( $workorder_payment_date ) > 500 ) { $workorder_payment_date = substr( $workorder_payment_date, 0, 500 ); }
	
	$mrb_var24 = ""; $mrb_f24 = "";
	if(isset($_POST['workorder_details'])  ){
      $mrb_var24=htmlentities(wpautop($_POST['workorder_details']));
      $mrb_f24=update_option('workorder_details', $mrb_var24);
		} else $workorder_details = "";
	
	$workorder_details = $mrb_var24;
	$workorder_assigned = $workorder_username;
	$workorder_userid = $workorder_assigned_id;
	
	$default_user_email = "";
	$the_user_email = "";
	$workorder_useremail = "";
	$table_wp = $wpdb->prefix . "users";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_wp . " WHERE id = %s AND id <> %s", $workorder_assigned_id, $default_user_email ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $workorder_useremail = $myrevenuebooks_sql->user_email; }
	
		//find first name
		$default_umeta = "first_name";
		$table_wp = $wpdb->prefix . "usermeta";
		$myrevenuebooks_sqlq2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_wp . " WHERE user_id = %s AND meta_key = %s", $workorder_assigned_id, $default_umeta ));
		foreach ( $myrevenuebooks_sqlq2 as $myrevenuebooks_sql2 )
		{
		$mrb_user_firstname = $myrevenuebooks_sql2->meta_value;
		}
			if ($mrb_user_firstname == "") { $mrb_user_firstname = "No Name"; }
	//find last name
		$default_umeta2 = "last_name";
		$table_wp = $wpdb->prefix . "usermeta";
		$myrevenuebooks_sqlq3 = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_wp . " WHERE user_id = %s AND meta_key = %s", $workorder_assigned_id, $default_umeta2 ));
		foreach ( $myrevenuebooks_sqlq3 as $myrevenuebooks_sql3 )
		{
		$mrb_user_lastname = $myrevenuebooks_sql3->meta_value;
		}
	
	$workorder_userid = $workorder_assigned_id;
	$workorder_username = $mrb_user_firstname . " " . $mrb_user_lastname;
	$workorder_assigned = $workorder_username;
	
	if ($workorder_assigned_id == "Not Assigned") { $workorder_username = "Not Assigned"; $workorder_assigned = "Not Assigned"; }

		} //end workorder_type = Workorder

// -------------------------------------------- END WORKORDER --------------------------------------------



$table = $wpdb->prefix . "myrevenuebooks";
$wpdb->query($wpdb->prepare("UPDATE $table SET 
	the_date = %s,
	the_date2 = %s,
	campain_start = %s,
	campain_end = %s,
	reminder = %s,
	reminder_date = %s,
	duration = %s,
	description = %s,
	payment_type = %s,
	payment_details = %s,
	amount = %s,
	status = %s,
	po_ref = %s,
	notes = %s,
		log_notes = %s,
		the_ref = %s,
		reminder_sent = %s,
		reminder_date_sent = %s,
		primary_contact = %s,
		secondary_contact = %s,
		primary_email = %s,
		secondary_email = %s,
		ad_html = %s,
				subtotal = %s,
				discount = %s,
				shipping = %s,
				additional = %s,
				fee = %s,
				tax = %s,
					ad_post_title = %s,
					ad_post_url = %s,
					ad_post_anchor_text = %s,
					ad_post_term_year = %s,
					ad_post_term_months = %s,
					ad_post_status = %s,
					da_score = %s,
					pa_score = %s,
					spam_score = %s,
					ad_link_url = %s,
					primary_notes = %s,
					secondary_notes = %s,
					ad_post_anchor_text2 = %s,
					ad_post_anchor_text3 = %s,
					ad_link_url2 = %s,
					ad_link_url3 = %s,
					da_score2 = %s,
					da_score3 = %s,
					pa_score2 = %s,
					pa_score3 = %s,
					spam_score2 = %s,
					spam_score3 = %s,
					ad_post_plagiarism = %s,
					ad_post_plagiarism_plag = %s,
					ad_post_plagiarism_unique = %s,
					payment_date = %s,
					payment_name = %s,
					payment_email = %s,
					payment_transid = %s,
					link_selection1 = %s,
					link_selection2 = %s,
					link_selection3 = %s,
					link_selection4 = %s,
					ad_post_anchor_text4 = %s,
					ad_link_url4 = %s,
					da_score4 = %s,
					pa_score4 = %s,
					spam_score4 = %s,
					due_date = %s,
					payment_link = %s,
					workorder_type = %s,
					workorder_details = %s,
					workorder_assigned = %s,
					workorder_userid = %s,
					workorder_username = %s,
					workorder_useremail = %s,
					workorder_commission = %s,
					workorder_status = %s,
					workorder_due_date = %s,
					workorder_payment_details = %s,
					workorder_payment_date = %s,
					workorder_file_status = %s
WHERE business_id = $business_id AND id = $the_id;", 
	$the_date,
	$the_date2,
	$campain_start,
	$campain_end,
	$reminder,
	$reminder_date,
	$duration,
	$description,
	$payment_type,
	$payment_details,
	$amount,
	$status,
	$po_ref,
	$notes,
		$log_notes,
		$the_ref,
		$reminder_sent,
		$reminder_date_sent,
		$primary_contact,
		$secondary_contact,
		$primary_email,
		$secondary_email,
		$ad_html,
				$subtotal,
				$discount,
				$shipping,
				$additional,
				$fee,
				$tax,
					$ad_post_title,
					$ad_post_url,
					$ad_post_anchor_text,
					$ad_post_term_year,
					$ad_post_term_months,
					$ad_post_status,
					$da_score,
					$pa_score,
					$spam_score,
					$ad_link_url,
					$primary_notes,
					$secondary_notes,
					$ad_post_anchor_text2,
					$ad_post_anchor_text3,
					$ad_link_url2,
					$ad_link_url3,
					$da_score2,
					$da_score3,
					$pa_score2,
					$pa_score3,
					$spam_score2,
					$spam_score3,
					$ad_post_plagiarism,
					$ad_post_plagiarism_plag,
					$ad_post_plagiarism_unique,
					$payment_date,
					$payment_name,
					$payment_email,
					$payment_transid,
					$link_selection1,
					$link_selection2,
					$link_selection3,
					$link_selection4,
					$ad_post_anchor_text4,
					$ad_link_url4,
					$da_score4,
					$pa_score4,
					$spam_score4,
					$due_date,
					$payment_link,
					$workorder_type,
					$workorder_details,
					$workorder_assigned,
					$workorder_userid,
					$workorder_username,
					$workorder_useremail,
					$workorder_commission,
					$workorder_status,
					$workorder_due_date,
					$workorder_payment_details,
					$workorder_payment_date,
					$workorder_file_status
			));

			
if ($update_status == "Y") {	
	echo "<table align='left' border='0' cellpadding='4' cellspacing='0' width='1000px'>";
	echo "<tr><td><h2><br>The transaction information has been updated for $business_name!</h2></td></tr></table>";
	}		
	
	//get the id
	$the_b_name = "";
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id = %s AND business_name <> %s", $the_b_id, $the_b_name ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $id = $myrevenuebooks_sql->id; }		
	echo "<meta http-equiv='refresh' content='0; URL=admin.php?page=my-revenue-books/myrevenuebooks_view_transactions.php&id=$id&b_id=$the_b_id'>";
	exit;
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
		$t_id = $myrevenuebooks_sql->id; 
	$business_name = $myrevenuebooks_sql->business_name;
	$address = $myrevenuebooks_sql->address;
		if ($address== NULL) { $address = ""; }
	$city = $myrevenuebooks_sql->city;
		if ($city == NULL) { $city = ""; }
	$state = $myrevenuebooks_sql->state;
		if ($state == NULL) { $state = ""; }
	$zip = $myrevenuebooks_sql->zip;
		if ($zip == NULL) { $zip = ""; }
	$contact_name = $myrevenuebooks_sql->contact_name;
	$address2 = $myrevenuebooks_sql->address2;
	$email = $myrevenuebooks_sql->email;
	$phone = $myrevenuebooks_sql->phone;
		if ($phone == NULL) { $phone = ""; }
	$phone2 = $myrevenuebooks_sql->phone2;
		if ($phone2 == NULL) { $phone2 = ""; }
	$fax = $myrevenuebooks_sql->fax;
		if ($fax == NULL) { $fax = ""; }
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
	$log_notes = $myrevenuebooks_sql->log_notes;
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
				$ad_post_title = $myrevenuebooks_sql->ad_post_title;
				$ad_post_url = $myrevenuebooks_sql->ad_post_url;
				$ad_post_anchor_text = $myrevenuebooks_sql->ad_post_anchor_text;
				$ad_post_term_year = $myrevenuebooks_sql->ad_post_term_year;
				$ad_post_term_months = $myrevenuebooks_sql->ad_post_term_months;
				$ad_post_status = $myrevenuebooks_sql->ad_post_status;
					if (! $ad_post_status ) { $ad_post_status = 'Active'; }	
				$da_score = $myrevenuebooks_sql->da_score;
				$pa_score = $myrevenuebooks_sql->pa_score;
				$spam_score = $myrevenuebooks_sql->spam_score;
				$ad_link_url = $myrevenuebooks_sql->ad_link_url;
				
				//added 1/3/21
				$primary_notes = $myrevenuebooks_sql->primary_notes;
					if (! $primary_notes ) { $primary_notes = ''; }
				$secondary_notes = $myrevenuebooks_sql->secondary_notes;
					if (! $secondary_notes ) { $secondary_notes = ''; }	
				$ad_post_anchor_text2 = $myrevenuebooks_sql->ad_post_anchor_text2;
				$ad_post_anchor_text3 = $myrevenuebooks_sql->ad_post_anchor_text3;
				$ad_link_url2 = $myrevenuebooks_sql->ad_link_url2;
				$ad_link_url3 = $myrevenuebooks_sql->ad_link_url3;
				$da_score2 = $myrevenuebooks_sql->da_score2;
				$da_score3 = $myrevenuebooks_sql->da_score3;
				$pa_score2 = $myrevenuebooks_sql->pa_score2;
				$pa_score3 = $myrevenuebooks_sql->pa_score3;
				$spam_score2 = $myrevenuebooks_sql->spam_score2;
				$spam_score3 = $myrevenuebooks_sql->spam_score3;
				$ad_post_plagiarism = $myrevenuebooks_sql->ad_post_plagiarism;
				$ad_post_plagiarism_plag = $myrevenuebooks_sql->ad_post_plagiarism_plag;
				$ad_post_plagiarism_unique = $myrevenuebooks_sql->ad_post_plagiarism_unique;
				$payment_date = $myrevenuebooks_sql->payment_date;
				$payment_name = $myrevenuebooks_sql->payment_name;
				$payment_transid = $myrevenuebooks_sql->payment_transid;
				//added 2/21/21
				$payment_email = $myrevenuebooks_sql->payment_email;
				$link_selection1 = $myrevenuebooks_sql->link_selection1;
				$link_selection2 = $myrevenuebooks_sql->link_selection2;
				$link_selection3 = $myrevenuebooks_sql->link_selection3;
				$link_selection4 = $myrevenuebooks_sql->link_selection4;
				$ad_post_anchor_text4 = $myrevenuebooks_sql->ad_post_anchor_text4;
				$ad_link_url4 = $myrevenuebooks_sql->ad_link_url4;
				$da_score4 = $myrevenuebooks_sql->da_score4;
				$pa_score4 = $myrevenuebooks_sql->pa_score4;
				$spam_score4 = $myrevenuebooks_sql->spam_score4;
				$due_date = $myrevenuebooks_sql->due_date;
				$payment_link = $myrevenuebooks_sql->payment_link;
				
				//workorder add-on
				$workorder_type = $myrevenuebooks_sql->workorder_type;
				$workorder_details = $myrevenuebooks_sql->workorder_details;
				$workorder_assigned = $myrevenuebooks_sql->workorder_assigned;
					$pre_workorder_assigned = $workorder_assigned;
				$workorder_userid = $myrevenuebooks_sql->workorder_userid;
				$workorder_username = $myrevenuebooks_sql->workorder_username;
				$workorder_useremail = $myrevenuebooks_sql->workorder_useremail;
				$workorder_commission = $myrevenuebooks_sql->workorder_commission;
				$workorder_status = $myrevenuebooks_sql->workorder_status;
					$pre_workorder_status = $workorder_status;
				$workorder_due_date = $myrevenuebooks_sql->workorder_due_date;
				$workorder_payment_details = $myrevenuebooks_sql->workorder_payment_details;
				$workorder_payment_date = $myrevenuebooks_sql->workorder_payment_date;
				$workorder_file_status = $myrevenuebooks_sql->workorder_file_status;
				
	}
			if (! $reminder ) { $reminder = 'No'; }	
			if (! $reminder_sent ) { $reminder_sent = 'No'; }
			if (! $primary_contact ) { $primary_contact = $contact_name; }
			if (! $primary_email ) { $primary_email = $email; }
					if ($subtotal == "") {$subtotal = "0.00";}
					if ($discount == "") {$discount = "0.00";}
					if ($shipping == "") {$shipping = "0.00";}
					if ($additional == "") {$additional = "0.00";}
					if ($fee == "") {$fee = "0.00";}
					if ($tax == "") {$tax = "0.00";}
?>





<?php
	//get the email templates
	$themrb_defaultid = 1;
	$themrb_defaultid2 = 1;
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s AND business_id = %s LIMIT 1", $themrb_defaultid, $themrb_defaultid2 ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ //email templates
		$email_template1 = $myrevenuebooks_sql->email_template1; //reminder
	}
?>






<!-- add header bar -->

	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#dedede">
	<?php $mrb_menu_color = "mrb_submenu3"; ?>
		<!-- back tab -->
		<tr><td align="left" width="80px"><a href="admin.php?page=my-revenue-books/myrevenuebooks_view_transactions.php&id=<?php echo $t_id; ?>&b_id=<?php echo $business_id; ?>" title="Go Back"><div class="<?php echo $mrb_menu_color; ?>"><span class="dashicons dashicons-controls-back"></span> BACK</a></div></td>
	
		<!-- copy tab -->
		<td align="left" width="80px"><a href="admin.php?page=my-revenue-books/myrevenuebooks_copy_transaction.php&id=<?php echo $the_id; ?>&b_id=<?php echo $business_id; ?>&the_o_id=<?php echo $the_id; ?>" title="Copy Transaction"><div class="<?php echo $mrb_menu_color; ?>"><span class="dashicons dashicons-backup"></span> COPY</a></div></td>

		<!-- delete tab -->
		<td align="left"><a href="admin.php?page=my-revenue-books/myrevenuebooks_delete_transaction.php&id=<?php echo $the_id; ?>&t_id=<?php echo $t_id; ?>&b_id=<?php echo $business_id; ?>&_wpnonce=<?php echo $deletenonce; ?>" title="Delete Transaction"><div class="<?php echo $mrb_menu_color; ?>"><span class="dashicons dashicons-trash"></span> DELETE</a></div></td>
		<!-- end delete tab -->
	</tr>
	</table>

<!-- end add header bar -->











<!-- //////////////////////////////////////////////////// -->

<?php $mrb_trans_type = "edit"; ?>

<?php include ("includes/input_form.php"); ?>

<!-- //////////////////////////////////////////////////// -->






<!-- add footer bar -->

	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#dedede">
	<?php $mrb_menu_color = "mrb_submenu3"; ?>
		<!-- back tab -->
		<tr><td align="left" width="80px"><a href="admin.php?page=my-revenue-books/myrevenuebooks_view_transactions.php&id=<?php echo $t_id; ?>&b_id=<?php echo $business_id; ?>" title="Go Back"><div class="mrb_submenu3"><span class="dashicons dashicons-controls-back"></span> BACK</a></div></td>
	
		<!-- copy tab -->
		<td align="left" width="80px"><a href="admin.php?page=my-revenue-books/myrevenuebooks_copy_transaction.php&id=<?php echo $the_id; ?>&b_id=<?php echo $business_id; ?>&the_o_id=<?php echo $the_id; ?>" title="Copy Transaction"><div class="mrb_submenu3"><span class="dashicons dashicons-backup"></span> COPY</a></div></td>

		<!-- delete tab -->
		<td align="left"><a href="admin.php?page=my-revenue-books/myrevenuebooks_delete_transaction.php&id=<?php echo $the_id; ?>&t_id=<?php echo $t_id; ?>&b_id=<?php echo $business_id; ?>&_wpnonce=<?php echo $deletenonce; ?>" title="Delete Transaction"><div class="mrb_submenu3"><span class="dashicons dashicons-trash"></span> DELETE</a></div></td>


<!-- future addition 
		
		<td align="left"><a href="admin.php?page=my-revenue-books/myrevenuebooks_email.php&id=<?php echo $the_id; ?>&b_id=<?php echo $business_id; ?>&the_o_id=<?php echo $the_id; ?>&the_type=post" title="Send Post Email"><div class="mrb_submenu3"><span class="dashicons dashicons-email"></span> COMPOSE POST EMAIL</a></div></td>

		<td align="left"><a href="admin.php?page=my-revenue-books/myrevenuebooks_email.php&id=<?php echo $the_id; ?>&b_id=<?php echo $business_id; ?>&the_o_id=<?php echo $the_id; ?>&the_type=link" title="Send Link Email"><div class="mrb_submenu3"><span class="dashicons dashicons-email"></span> COMPOSE LINK EMAIL</a></div></td>
		
		<td align="left"><a href="admin.php?page=my-revenue-books/myrevenuebooks_email.php&id=<?php echo $the_id; ?>&b_id=<?php echo $business_id; ?>&the_o_id=<?php echo $the_id; ?>&the_type=ppayment" title="Send Payment Notice"><div class="mrb_submenu3"><span class="dashicons dashicons-embed-post"></span> POST PAYMENT REMINDER</a></div></td>
		
		<td align="left"><a href="admin.php?page=my-revenue-books/myrevenuebooks_email.php&id=<?php echo $the_id; ?>&b_id=<?php echo $business_id; ?>&the_o_id=<?php echo $the_id; ?>&the_type=lpayment" title="Send Payment Notice"><div class="mrb_submenu3"><span class="dashicons dashicons-admin-links"></span> LINK PAYMENT REMINDER</a></div></td>

<?php if ($email_template1 <> "") { ?>
		<td align="left"><a href="admin.php?page=my-revenue-books/myrevenuebooks_email_reminder.php&id=<?php echo $the_id; ?>&b_id=<?php echo $business_id; ?>&the_o_id=<?php echo $the_id; ?>" title="Email Reminder"><div class="mrb_submenu3"><span class="dashicons dashicons-email-alt"></span> EMAIL REMINDER</a></div></td>

-->
	
	
	</tr></table>
<!-- end add footer bar -->




<!-- Move Invoice -->

<div class="mrb_desc_text">
<!-- Move Invoice -->
	
	<form name="moveinvoice" method="post">
		<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%" bgcolor="#eaeaea">
		<tr><td align="right" width="20"><span class="dashicons dashicons-move"></span></td>
			<td width="90">&nbsp;<b>MOVE INVOICE:</b></td>
			<td align="left"><select name='the_business_id' value='' style='font-size:12px'>Select</option>";
				<option value='0'>Select the account</option>
	<?php
	//get current invoice id and business id
	$move_id = sanitize_text_field( $_REQUEST['id'] );
	$move_bid = sanitize_text_field( $_REQUEST['b_id'] );

$the_id_move = "1";
$the_bus_name = "";
$table = $wpdb->prefix . "myrevenuebooks";
$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id > %s AND business_name <> %s ORDER BY business_name ASC", $the_id_move, $the_bus_name ));
foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
{ 
$business_id = $myrevenuebooks_sql->business_id;
$move_business_name = $myrevenuebooks_sql->business_name;
?>
<option value='<?php echo $myrevenuebooks_sql->business_id; ?>'><?php echo $move_business_name; ?></option>

<?php
}
?>
</select></font>
<input type="submit" name="select-move" class="button-secondary" value="Move and update the invoice" /></td></tr>
</table>
</form>


</div>

<!-- Move Invoice Execute-->
<?php
	if (!empty($_POST['select-move'])) {
	
	$move_update_status="Y";
	$move_business_id = stripslashes( $_POST['the_business_id'] );
	if ( ! $move_business_id ) { $move_business_id = ''; }
	if ( strlen( $move_business_id ) > 200 ) { $move_business_id = substr( $move_business_id, 0, 200 ); }
	
	//check for account selection
	if ($move_business_id == "") { 
		echo "<table width='100%' align='left' bgcolor='#ebebeb'><tr><td align='center'><h2><b><font color='#a20900'>No Account Selected!</font><b></h2></td></tr></table>"; 
		}
	
	if ($move_business_id <> "") { 
	$table = $wpdb->prefix . "myrevenuebooks";
	$wpdb->query($wpdb->prepare("UPDATE $table SET 
	business_id = %s
	WHERE id = $move_id;", 
	$move_business_id
			));		
	echo "<meta http-equiv='refresh' content='0; URL=admin.php?page=my-revenue-books/myrevenuebooks_edit_transaction.php&id=$move_id&b_id=$move_business_id'>";
	exit; 
	}
}
?>


<?php } ?>
	

<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->