<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
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
    jQuery('#datepicker5').datepicker({
        dateFormat : 'mm/dd/yy'
   		});
    jQuery('#datepicker6').datepicker({
        dateFormat : 'mm/dd/yy'
   		});
    jQuery('#datepicker7').datepicker({
        dateFormat : 'mm/dd/yy'
   		});
	});
</script>




<?php

if (!empty($_POST['edit-submit'])) {

$update_status="Y";
$the_id = sanitize_text_field( $_REQUEST['id'] );
$the_b_id = sanitize_text_field( $_REQUEST['b_id'] );

include ("includes/clean_add_plan.php");

$last_edited = date("m-d-Y")." ".date("H").":".date("i").":".date("s");

$amount = $subtotal + $discount + $shipping + $additional + $fee + $tax;

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
payment_link
		)
	VALUES ( %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s )
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
					$payment_link
) );


if ($update_status == "Y") {	
	echo "<table align='left' border='0' cellpadding='4' cellspacing='0' width='1000px'>";
	echo "<tr><td><h2><br>Successfully added!</h2><br></td></tr></table>";
	}		
	
	echo "<meta http-equiv='refresh' content='0; URL=admin.php?page=my-revenue-books/myrevenuebooks_view_transactions.php&id=$the_id&b_id=$the_b_id'>";
	exit;
	}
?>




<?php

	$the_id = sanitize_text_field( $_REQUEST['id'] );
	$the_b_name = "";
	$the_b_id = sanitize_text_field( $_REQUEST['b_id'] );
	$business_id = sanitize_text_field( $_REQUEST['b_id'] );
	$get_id = 0; //set default for log files
	if(isset($_REQUEST['get_id'])){ $get_id = $_REQUEST['get_id']; }

	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id = %s AND business_name <> %s", $the_b_id, $the_b_name ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
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
?>


<?php
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
		//$primary_contact = "";
		//$secondary_contact = "";
		//$primary_email = "";
		//$secondary_email = "";
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
$workorder_type = "";



	$payment_terms = ""; //default
	$def_id = 1; //default
	$the_bb_name = 1; //default
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


?>






<!-- //////////////////////////////////////////////////// -->

<?php $mrb_trans_type = "add"; ?>
<?php include ("includes/input_form.php"); ?>



<!-- //////////////////////////////////////////////////// -->








	

<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->