<?php
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Workorders Dashboard";

//include security check
	include plugin_dir_path( __FILE__ ) . '../includes/security_check.php';

//include header options
	include plugin_dir_path( __FILE__ ) . '../header.php';

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
<div id="mrb_main_wrapper">


<?php
	//user not valid notice
	if ($the_security_option == "Enabled" && $mrb_current_user_id == 0) {
		echo $default_security_message . "<br>"; }
	?>

<?php
	//if a valid user is found
	if ($the_security_option == "Enabled" && $mrb_current_user_id > 0 || $the_security_option == "Disabled") { 	?>
	



<?php
if (!empty($_POST['from_date'])) { $from_date = sanitize_text_field( $_POST['from_date'] ); }
	else $from_date = "01/01/" . date("Y"); //default from date

if (!empty($_POST['to_date'])) { $to_date = sanitize_text_field( $_POST['to_date'] ); }
	else $to_date = date("m/d/Y"); //default to date
	
	$from_date2 = strtotime($from_date);
	$to_date2 = strtotime($to_date);
?>






<?php
// process the submitted form edit-submit
if (!empty($_POST['edit-submit'])) {

$update_status="Y";
	//clean the submitted information
	include plugin_dir_path( __FILE__ ) . '../includes/clean_add_plan.php';

	//add the date and add the total
	$last_edited = date("m-d-Y")." ".date("H").":".date("i").":".date("s");
	$amount = $subtotal + $discount + $shipping + $additional + $fee + $tax;
	
	
	// -------------------------------------------- WORKORDER --------------------------------------------
	// clean the submitted workorder information
	if (isset($_POST['workorder_status'])) {
	$workorder_status = sanitize_text_field($_POST['workorder_status'] ); } else $workorder_status = "";
	if ( ! $workorder_status ) { $workorder_status = ''; }
	if ( strlen( $workorder_status ) > 100 ) { $workorder_status = substr( $workorder_status, 0, 100 ); }
	
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
	
	if (isset($_POST['workorder_commission'])) {
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
// -------------------------------------------- WORKORDER --------------------------------------------
	
	
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
	$workorder_file_status = "Open"; //new order default
	
	if ($workorder_assigned_id == "Not Assigned") { $workorder_username = "Not Assigned"; $workorder_assigned = "Not Assigned"; }


$table = $wpdb->prefix . "myrevenuebooks";
$wpdb->query( $wpdb->prepare( "INSERT INTO $table (
	business_id,
	the_date,
	the_date2,
	campain_start,
	campain_end,
	reminder,
	reminder_date,
	duration,
	description,
	payment_type,
	payment_details,
	amount,
	status,
	po_ref,
	notes,
		log_notes,
		the_ref,
		reminder_sent,
		reminder_date_sent,
		primary_contact,
		secondary_contact,
		primary_email,
		secondary_email,
		ad_html,
				subtotal,
				discount,
				shipping,
				additional,
				fee,
				tax,
					ad_post_title,
					ad_post_url,
					ad_post_anchor_text,
					ad_post_term_year,
					ad_post_term_months,
					ad_post_status,
					da_score,
					pa_score,
					spam_score,
					ad_link_url,
					primary_notes,
					secondary_notes,
					ad_post_anchor_text2,
					ad_post_anchor_text3,
					ad_link_url2,
					ad_link_url3,
					da_score2,
					da_score3,
					pa_score2,
					pa_score3,
					spam_score2,
					spam_score3,
					ad_post_plagiarism,
					ad_post_plagiarism_plag,
					ad_post_plagiarism_unique,
					payment_date,
					payment_name,
					payment_email,
					payment_transid,
link_selection1,
link_selection2,
link_selection3,
link_selection4,
ad_post_anchor_text4,
ad_link_url4,
da_score4,
pa_score4,
spam_score4,
due_date,
payment_link,
workorder_type,
workorder_details,
workorder_assigned,
workorder_userid,
workorder_username,
workorder_useremail,
workorder_commission,
workorder_status,
workorder_due_date,
workorder_payment_details,
workorder_payment_date,
workorder_file_status
		)
	VALUES ( %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s )
	",
	$business_id,
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
) );



if ($update_status == "Y") {	

	///email the new workorder details to the user(s)
	//get the admin email address to send the email
	$table = $wpdb->prefix . "myrevenuebooks";
	$the_id = 1;
	$bus_check = "";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s AND business_name <> %s", $the_id, $bus_check  ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $mrb_admin_email = $myrevenuebooks_sql->email;
		$mrb_business_name = $myrevenuebooks_sql->business_name; }
	
	// check for admin email settings.  if no admin is setup in the settings, then use the default WP admin email
	$mrb_bcc_admin_email = "";
	$workorder_admin_email = ""; //default
	$workorder_subject = "New workorder from $mrb_business_name"; //default
	//$workorder_details = ""; //default
	$table_security = $wpdb->prefix . "myrevenuebooks_security";
    $security_option_query = "Disabled"; //default
    $security_option_query2 = "Enabled"; //default
    $myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_option = %s OR security_option = %s", $security_option_query, $security_option_query2 ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ $workorder_admin_email = $myrevenuebooks_sql->workorder_admin_email; }
			//if a admin email is set in the settings, use it
			if ($workorder_admin_email <> "") { $mrb_bcc_admin_email = $workorder_admin_email; }
			//if admin email is not set in the settings, use the WP default email address
			if ($workorder_admin_email == "") { $mrb_bcc_admin_email = $mrb_admin_email; }
	
		//get the workorder settings
		$table_security = $wpdb->prefix . "myrevenuebooks_security";
    	$security_option_query = "Disabled"; //default
    	$security_option_query2 = "Enabled"; //default
    	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_option = %s OR security_option = %s", $security_option_query, $security_option_query2 ));
		foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
		{ $workorder_subject = $myrevenuebooks_sql->workorder_subject; }
			if ($workorder_subject == "") { $workorder_subject = "New workorder from $mrb_business_name"; 
				$workorder_new_order_notify = $myrevenuebooks_sql->workorder_new_order_notify;
					if ($workorder_new_order_notify == "") { $workorder_new_order_notify = "Yes"; } //default
				$workorder_order_change_notify = $myrevenuebooks_sql->workorder_order_change_notify;
					if ($workorder_order_change_notify == "") { $workorder_order_change_notify = "Yes"; } //default
			}
			//check to see if there are workorder changes and if the notifications are set to yes
			if ($workorder_new_order_notify == "Yes") { $mrb_send_email = "Y"; }
	
		//get the workorder users
		$mrb_get_work_userid1 = "";
		$mrb_get_work_users1 = "workorder";
		$table1 = $wpdb->prefix . "myrevenuebooks";
		$myrevenuebooks_sqlqa = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table1 . " WHERE workorder_type = %s AND workorder_username <> %s", $mrb_get_work_users1, $mrb_get_work_userid1 ));
		foreach ( $myrevenuebooks_sqlqa as $myrevenuebooks_sqla ) 
		{ 	$mrb_work_username_query = $myrevenuebooks_sqla->workorder_username;
			$mrb_work_userid_query = $myrevenuebooks_sqla->workorder_userid; }
		
		//if the workorder is not assigned
		if ($mrb_work_username_query == "Not Assigned") {
		
		if ($mrb_send_email == "Y") {
		$i=1;
		$mrb_get_work_users1 = "";
		$mrb_get_work_users2 = "dashboard_workorder";
		
		$table_security = $wpdb->prefix . "myrevenuebooks_security";
		$myrevenuebooks_sqlqa = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND userid <> %s", $mrb_get_work_users2, $mrb_get_work_users1 ));
		foreach ( $myrevenuebooks_sqlqa as $myrevenuebooks_sqla ) 
		{ 		
				$mrb_id_search2[$i] = $myrevenuebooks_sqla->userid;
				$mrb_work_email[$i] = $myrevenuebooks_sqla->user_email;
				$mrb_work_first2[$i] = $myrevenuebooks_sqla->user_firstname;
				$mrb_work_last2[$i] = $myrevenuebooks_sqla->user_lastname;
				$mrb_display_name_search2[$i] = $mrb_work_first2[$i] . " " . $mrb_work_last2[$i];
				
			// Email the workorder if users are set
			if ($mrb_work_email[$i] <> "All" || $mrb_work_email[$i] <> "") {
		
			$the_post_email = "";
			$the_post_email = $mrb_work_email[$i];
					
			add_filter( 'wp_mail_content_type[$i]', 'set_html_content_type[$i]' );
			$body = "";
			$headers = array('Content-Type: text/html; charset=UTF-8');
			$headers[] = 'From: ' . $mrb_business_name . ' <' . $mrb_admin_email . '>';
				if ($i == 1) { $headers[] = 'Cc: ' . $mrb_bcc_admin_email; } //send to admin email only once
			$to = $the_post_email;
			$subject = $workorder_subject;
			$body = isset($body[$i]) ? $body[$i] : '';
			$body .= "Hello $mrb_work_first2[$i],<br><br>";
			$body .= "There is a new order that currently is $workorder_assigned for your review: $ $workorder_commission<br><br>";
			$body .= "Workorder due date: $workorder_due_date<br><br>";
			$body .= "Workorder status: $workorder_status<br><br>";
			$body .= "If you wish to complete this order, please login, review and accept this order as soon as possible!<br><br>";
				
			wp_mail( $to, $subject, $body, $headers );
			// Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
			remove_filter( 'wp_mail_content_type[$i]', 'set_html_content_type[$i]' );
						} //end if not all or null
			$i++;
					} //end foreach
			}//end mrb_send_email == Y
		} //end if workorder is not assigned
		
	
		
		//if workorder is assigned to a user
		if ($mrb_work_username_query <> "Not Assigned") {
		
		if ($mrb_send_email == "Y") {
		$i=1;
		$mrb_get_work_userid2 = "";
		//$mrb_get_work_users2 = "dashboard_workorder";
		$mrb_get_work_users2 = "User";
		$table_security = $wpdb->prefix . "myrevenuebooks_security";
		//$myrevenuebooks_sqlqa = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND userid = %s", $mrb_get_work_users2, $mrb_work_userid_query ));
		$myrevenuebooks_sqlqa = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND userid = %s", $mrb_get_work_users2, $mrb_work_userid_query ));
		foreach ( $myrevenuebooks_sqlqa as $myrevenuebooks_sqla ) 
		{ 		
				$mrb_id_search2[$i] = $myrevenuebooks_sqla->userid;
				$mrb_work_email[$i] = $myrevenuebooks_sqla->user_email;
				$mrb_work_first2[$i] = $myrevenuebooks_sqla->user_firstname;
				$mrb_work_last2[$i] = $myrevenuebooks_sqla->user_lastname;
				$mrb_display_name_search2[$i] = $mrb_work_first2[$i] . " " . $mrb_work_last2[$i];
				
			// Email the workorder if users are set
			if ($mrb_work_email[$i] <> "All" || $mrb_work_email[$i] <> "") {
		
			
			$the_post_email = "";
			$the_post_email = $mrb_work_email[$i];
					
			add_filter( 'wp_mail_content_type[$i]', 'set_html_content_type[$i]' );
			$body = "";
			$headers = array('Content-Type: text/html; charset=UTF-8');
			$headers[] = 'From: ' . $mrb_business_name . ' <' . $mrb_admin_email . '>';
			$headers[] = 'Cc: ' . $mrb_bcc_admin_email;
			$to = $the_post_email;
			$subject = $workorder_subject;
			$body = isset($body[$i]) ? $body[$i] : '';
			//$body .= "Hello $mrb_work_first2[$i]," . "\r\n" . "\r\n";
			$body .= "Hello $mrb_work_first2[$i],<br><br>";
			$body .= "There is a new order at $mrb_business_name for your review: $ $workorder_commission<br><br>";
			$body .= "Workorder due date: $workorder_due_date<br><br>";
			$body .= "Workorder status: $workorder_status<br><br>";
			$body .= "Please login and review the order as soon as possible!<br><br>";
				
			wp_mail( $to, $subject, $body, $headers );
			// Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
			remove_filter( 'wp_mail_content_type[$i]', 'set_html_content_type[$i]' );
						} //end if not all or null
			$i++;
					} //end foreach
				}// end mrb_send_email == Y
		} //end if workorder is assigned to a user
	
	

	
	} //end if $update_status
} //if !empty
?>













<!-- set defaults and display the new order input form-->
<?php
if (!empty($_POST['add-workorder'])) {

$the_id = stripslashes( $_POST['the_business_id'] );
if ( ! $the_id ) { $the_id = ''; }
if ( strlen( $the_id ) > 200 ) { $the_id = substr( $the_id, 0, 200 ); }

			$the_bus_name = "";
			$table = $wpdb->prefix . "myrevenuebooks";
			$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s AND business_name <> %s ORDER BY business_name ASC", $the_id, $the_bus_name ));
				foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
		{
			$the_b_id = $myrevenuebooks_sql->business_id;
			$business_id = $myrevenuebooks_sql->business_id;
	$business_name = $myrevenuebooks_sql->business_name;
	$contact_name = $myrevenuebooks_sql->contact_name;
	$secondary_contact = $myrevenuebooks_sql->secondary_contact;
	$secondary_email = $myrevenuebooks_sql->secondary_email;
	$address = $myrevenuebooks_sql->address;
		if ($address== NULL) { $address = "N/A"; }
	$address2 = $myrevenuebooks_sql->address2;
	$city = $myrevenuebooks_sql->city;
		if ($city == NULL) { $city = "N/A"; }
	$state = $myrevenuebooks_sql->state;
		if ($state == NULL) { $state = "N/A"; }
	$zip = $myrevenuebooks_sql->zip;
		if ($zip == NULL) { $zip = "00000"; }
	$email = $myrevenuebooks_sql->email;
	$phone = $myrevenuebooks_sql->phone;
		if ($phone == NULL) { $phone = "(000) 000-0000"; }
	$phone2 = $myrevenuebooks_sql->phone2;
		if ($phone2 == NULL) { $phone2 = "(000) 000-0000"; }
	$fax = $myrevenuebooks_sql->fax;
		if ($fax == NULL) { $fax = "(000) 000-0000"; }
	$website = $myrevenuebooks_sql->website;
	$yyy = date("Y");
		}
	
	$primary_contact = $contact_name;
	$primary_email = $email;
			
	//DEFAULTS
	$the_date = date("m/d/Y"); 
	$campain_start = "";
	$campain_end = "";
	$reminder = "";
	$reminder_date = "";
	$duration = "";
	$description = "";
	$payment_type = "";
	$payment_details = "";
	$subtotal = "0.00";
	$discount = "0.00";
	$shipping = "0.00";
	$additional = "0.00";
	$fee = "0.00";
	$tax = "0.00";
	//$amount = "0.00";
	$status = "Pending";
	$po_ref = "";
	$notes = "";
	$log_notes = "";
	$yyy = date("Y");
		$the_ref = "";
		$reminder_sent = "";
		$reminder_date_sent = "";
		$ad_html = "";
				$ad_post_title = "";
				$ad_post_url = "";
				$ad_post_anchor_text = "";
				$ad_post_term_year = "";
				$ad_post_term_months = "";
				$ad_post_status = "Active";
				$da_score = "";
				$pa_score = "";
				$spam_score = "";
				$ad_link_url = "";
				
				//added 1/3/21
				$primary_notes = "";
				$secondary_notes = "";
				$ad_post_anchor_text2 = "";
				$ad_post_anchor_text3 = "";
				$ad_link_url2 = "";
				$ad_link_url3 = "";
				$da_score2 = "";
				$da_score3 = "";
				$pa_score2 = "";
				$pa_score3 = "";
				$spam_score2 = "";
				$spam_score3 = "";
				$ad_post_plagiarism = "";
				$ad_post_plagiarism_plag = "";
				$ad_post_plagiarism_unique = "";
				$payment_date = "";
				$payment_name = "";
				$payment_transid = "";
	//added 2/21/21
$payment_email = "";
$link_selection1 = "";
$link_selection2 = "";
$link_selection3 = "";
$link_selection4 = "";
$ad_post_anchor_text4 = "";
$ad_link_url4 = "";
$da_score4 = "";
$pa_score4 = "";
$spam_score4 = "";
	//added 5/28/22
$payment_link = "";


	$payment_terms = ""; //default
	$def_id = 1; //default
	$the_bb_name = 1;
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s AND business_id = %s", $def_id, $the_bb_name ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
			$payment_terms = $myrevenuebooks_sql->payment_terms;
				}
	if ($payment_terms == "") { $payment_terms = "15"; }

	//add the due date
	$due_date = date("Y/m/d");
	$mrb_mod_date = strtotime($due_date."+ $payment_terms days"); // add net date - default is 15 days
	$due_date = date("m/d/Y",$mrb_mod_date);




//added 6/1/22
$workorder_type = "";
$workorder_details = "";
$workorder_assigned = "Not Assigned";
$workorder_userid = "";
$workorder_username = "";
$workorder_useremail = "";
$workorder_commission = "";
$workorder_status = "";
$workorder_due_date = "";
$workorder_payment_details = "";
$workorder_payment_date = "";
$workorder_file_status = "Open";
	$pre_workorder_assigned = $workorder_assigned;
	$pre_workorder_status = $workorder_status;
?>

<!-- <div id="mrb_wrapper2"> -->

<!-- //////////////////////////////////////////////////// -->
<?php
	// add new transaction
	$mrb_trans_type = "add";
	include plugin_dir_path( __FILE__ ) . 'input_form.php';
?>
<!-- //////////////////////////////////////////////////// -->


<!-- </div> -->
<?php
	} //end if not empty 
?>







<?php
// if no additon is selected, display current workorders and add option
	
	if (empty($_POST['add-workorder'])) { 
						//display to non-users

	//if the user does not have access to settings
	if ($the_security_option == "Enabled" && $security_work_access == "false" && $security_work_admin == "false") { ?>
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td align="middle"><h3><?php echo $default_security_message; ?></h3></td></tr>
	<tr><td align="middle"><b>Contact your administrator or check the <a href="admin.php?page=my-revenue-books/myrevenuebooks_security.php">security & privacy</a> settings to enable access.</b></td></tr>
	<tr><td>&nbsp;</td></tr>
	</table>
	<?php } ?>
	
	
	
	
	
	
<?php	
	
	if ($the_security_option == "Disabled") { ?>
		<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
		<tr><td align="center"><b>NOTICE: Workworders will not work correctly unless the <a href="admin.php?page=my-revenue-books/myrevenuebooks_security.php">security & privacy</a> settings are enabled and the <a href="admin.php?page=my-revenue-books/myrevenuebooks_settings.php#S1">workorder settings</a> are entered!</b></td></tr>
		<tr><td align="center">When enabled, you will be able to select the workorder administrators and the workorder users.</td></tr>
		<tr><td>&nbsp;</td></tr>
		</table>
		<?php } ?>
	
	
	
	
	<!-- search form -->
	<?php include plugin_dir_path( __FILE__ ) . 'search.php'; ?>
	<!-- endsearch form -->
	
	
	
	
	<?php
	// if security is enabled and access is true, display.  If not, dont display.  If security is disabled then display.
	//if ($the_security_option == "Enabled" && $security_work_access == "true" || $the_security_option == "Enabled" && $security_work_admin == "true" || $the_security_option == "Disabled")
	if ($the_security_option == "Enabled" && $security_work_access == "true" || $the_security_option == "Enabled" && $security_work_admin == "true") { ?>
	
	<!-- add assigned or not assigned orders -->
	<?php include plugin_dir_path( __FILE__ ) . 'display_assigned_open_orders.php'; ?>
	<!-- end add assigned ot not assigned orders -->
	
	

	
	
	
	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
	<form name="displayamount" method="post">
	<tr><td align="left" width="25px"><span class="dashicons dashicons-sort"></span></td>
		<td align="left" width="283px"><b>Sort from </b><input type="text" name="from_date" value="<?php echo $from_date; ?>" size="8" maxlength="50" id="datepicker" />
		<b>to&nbsp;</b><input type="text" name="to_date" value="<?php echo $to_date; ?>" size="8" maxlength="50" id="datepicker2" /></td>
		<td aligh="left"><select name="amount_sort">
		<option value="25">25</option>
		<option value="50">50</option>
		<option value="75">75</option>
		<option value="100">100</option>
		<option value="200">200</option>
		<option value="300">300</option>
		<option value="500">500</option>
		<option value="800">800</option>
		<option value="1000">1000</option>
		<option value="2000">2000</option>
		<option value="2500">2500</option>
		<option value="9999999">All</option>
		</select>
		<input type="submit" name="display-submit" class="button-secondary" value="Filter" /></td>
		</form>




	<!-- select an account to add a new workorder -->
	<form name="addworkorder" method="post">
	<td align="right">
	<label for="the_business_id"></label>
	<select name="the_business_id" required>
	<option disabled selected value="">Select Account</option>
		<?php 
		//select company
			$i = 0;
			$default_id = "1";
			$the_bus_name = "";
			$table = $wpdb->prefix . "myrevenuebooks";
			$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id > %s AND business_name <> %s ORDER BY business_name ASC", $default_id, $the_bus_name ));
				foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
				{ 	$i++;
					$get_id = $myrevenuebooks_sql->id;
					$business_name = $myrevenuebooks_sql->business_name;
					$the_b_id = $myrevenuebooks_sql->business_id;
							?>
			<option value="<?php echo $get_id; ?>"><?php echo $business_name; ?></option>
			<?php } ?>
		</select>
		<input type="submit" class="button-secondary" name="add-workorder" value="Add A New Workorder" /></td></tr>
	</form>
	</table>
	<!-- end select an account to add a new workorder -->





		
<?php
	include plugin_dir_path( __FILE__ ) . 'display_workorder_transactions.php';
?>

<?php
	}// end if security is enabled and access is true
} // end if empty
?>





<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->