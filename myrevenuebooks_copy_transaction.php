<?php
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
	$the_id = sanitize_text_field( $_REQUEST['id'] );
	$the_b_name = "";
	$the_b_id = sanitize_text_field( $_REQUEST['b_id'] );

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
	if ($the_security_option == "Enabled" && $mrb_current_user_id > 0 || $the_security_option == "Disabled") { 	?>





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
include ("includes/clean_add_plan.php");

$the_o_id = sanitize_text_field( $_REQUEST['the_o_id'] );

$business_name = stripslashes( $_POST['business_name'] );
if ( ! $business_name ) { $business_name = ''; }
if ( strlen( $business_name ) > 200 ) { $business_name = substr( $business_name, 0, 200 ); }

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
					da_score4 ,
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
	echo "<table align='left' border='0' cellpadding='4' cellspacing='0' width='800px'>";
	echo "<tr><td><h2><br>The transaction information has been copied for $business_name.</h2></td></tr></table>";
	}		
				
	echo "<meta http-equiv='refresh' content='0; URL=admin.php?page=my-revenue-books/myrevenuebooks_view_transactions.php&id=$the_o_id&b_id=$the_b_id'>";
	exit;
	}
?>









<?php
	$the_id = sanitize_text_field( $_REQUEST['id'] );
	$the_b_name = "";
	$the_b_id = sanitize_text_field( $_REQUEST['b_id'] );
	$the_o_id = sanitize_text_field( $_REQUEST['the_o_id'] );
	
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
				$payment_email = $myrevenuebooks_sql->payment_email;
				$payment_transid = $myrevenuebooks_sql->payment_transid;
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
	
					if ($subtotal == "") {$subtotal = "0.00";}
					if ($discount == "") {$discount = "0.00";}
					if ($shipping == "") {$shipping = "0.00";}
					if ($additional == "") {$additional = "0.00";}
					if ($fee == "") {$fee = "0.00";}
					if ($tax == "") {$tax = "0.00";}

?>
	

<!-- //////////////////////////////////////////////////// -->

<?php $mrb_trans_type = "copy"; ?>
<?php include ("includes/input_form.php"); ?>



<!-- //////////////////////////////////////////////////// -->



	

<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->