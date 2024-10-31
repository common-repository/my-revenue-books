<?php
$id = isset($id) ? $id : '';
if(isset($_REQUEST['id'])){ $ListingID = $_REQUEST['id']; }

$business_id = stripslashes( $_POST['business_id'] );
if ( ! $business_id ) { $business_id = ''; }
if ( strlen( $business_id ) > 200 ) { $business_id = substr( $business_id, 0, 200 ); }

$the_date = stripslashes( $_POST['the_date'] );
if ( ! $the_date ) { $the_date = ''; }
if ( strlen( $the_date ) > 200 ) { $the_date = substr( $the_date, 0, 200 ); }

$the_date2 = strtotime($the_date);

$campain_start = stripslashes( $_POST['campain_start'] );
if ( ! $campain_start ) { $campain_start = ''; }
if ( strlen( $campain_start ) > 200 ) { $campain_start = substr( $campain_start, 0, 200 ); }

$campain_end = stripslashes( $_POST['campain_end'] );
if ( ! $campain_end ) { $campain_end = ''; }
if ( strlen( $campain_end ) > 200 ) { $campain_end = substr( $campain_end, 0, 200 ); }

$reminder = stripslashes( $_POST['reminder'] );
if ( ! $reminder ) { $reminder = ''; }
if ( strlen( $reminder ) > 100 ) { $reminder = substr( $reminder, 0, 100 ); }

$reminder_date = stripslashes( $_POST['reminder_date'] );
if ( ! $reminder_date ) { $reminder_date = ''; }
if ( strlen( $reminder_date ) > 20 ) { $reminder_date = substr( $reminder_date, 0, 20 ); }

$duration = stripslashes( $_POST['duration'] );
if ( ! $duration ) { $duration = ''; }
if ( strlen( $duration ) > 5000 ) { $duration = substr( $duration, 0, 5000 ); }

$description = stripslashes( $_POST['description'] );
if ( ! $description ) { $description = ''; }
if ( strlen( $description ) > 900000 ) { $description = substr( $description, 0, 900000 ); }

$payment_type = stripslashes( $_POST['payment_type'] );
if ( ! $payment_type ) { $payment_type = ''; }
if ( strlen( $payment_type ) > 100 ) { $payment_type = substr( $payment_type, 0, 100 ); }

$payment_details = stripslashes( $_POST['payment_details'] );
if ( ! $payment_details ) { $payment_details = ''; }
if ( strlen( $payment_details ) > 1000 ) { $payment_details = substr( $payment_details, 0, 1000 ); }

$po_ref = stripslashes( $_POST['po_ref'] );
if ( ! $po_ref ) { $po_ref = ''; }
if ( strlen( $po_ref ) > 100 ) { $po_ref = substr( $po_ref, 0, 100 ); }

$status = stripslashes( $_POST['status'] );
if ( ! $status ) { $status = ''; }
if ( strlen( $status ) > 200 ) { $status = substr( $status, 0, 200 ); }

$notes = stripslashes( $_POST['notes'] );
if ( ! $notes ) { $notes = ''; }
if ( strlen( $notes ) > 900000 ) { $notes = substr( $notes, 0, 900000 ); }

$log_notes = stripslashes( $_POST['log_notes'] );
if ( ! $log_notes ) { $log_notes = ''; }
if ( strlen( $log_notes ) > 900000 ) { $log_notes = substr( $log_notes, 0, 900000 ); }

$the_ref = stripslashes( $_POST['the_ref'] );
if ( ! $the_ref ) { $the_ref = ''; }
if ( strlen( $the_ref ) > 200 ) { $the_ref = substr( $the_ref, 0, 200 ); }

$reminder_sent = stripslashes( $_POST['reminder_sent'] );
if ( ! $reminder_sent ) { $reminder_sent = ''; }
if ( strlen( $reminder_sent ) > 200 ) { $reminder_sent = substr( $reminder_sent, 0, 200 ); }

$reminder_date_sent = stripslashes( $_POST['reminder_date_sent'] );
if ( ! $reminder_date_sent ) { $reminder_date_sent = ''; }
if ( strlen( $reminder_date_sent ) > 200 ) { $reminder_date_sent = substr( $reminder_date_sent, 0, 200 ); }



//remove the spaces in the begining and end for these values
$primary_contact = sanitize_text_field( $_POST['primary_contact'] );
if ( ! $primary_contact ) { $primary_contact = ''; }
if ( strlen( $primary_contact ) > 200 ) { $primary_contact = substr( $primary_contact, 0, 200 ); }

$secondary_contact = sanitize_text_field( $_POST['secondary_contact'] );
if ( ! $secondary_contact ) { $secondary_contact = ''; }
if ( strlen( $secondary_contact ) > 200 ) { $secondary_contact = substr( $secondary_contact, 0, 200 ); }

$primary_email = sanitize_text_field( $_POST['primary_email'] );
if ( ! $primary_email ) { $primary_email = ''; }
if ( strlen( $primary_email ) > 200 ) { $primary_email = substr( $primary_email, 0, 200 ); }

$secondary_email = sanitize_text_field( $_POST['secondary_email'] );
if ( ! $secondary_email ) { $secondary_email = ''; }
if ( strlen( $secondary_email ) > 200 ) { $secondary_email = substr( $secondary_email, 0, 200 ); }

//$ad_post_title = sanitize_text_field( $_POST['ad_post_title'] );
//if ( ! $ad_post_title ) { $ad_post_title = ''; }
//if ( strlen( $ad_post_title ) > 300 ) { $ad_post_title = substr( $ad_post_title, 0, 300 ); }

$ad_post_title = stripslashes( $_POST['ad_post_title'] );
if ( ! $ad_post_title ) { $ad_post_title = ''; }
if ( strlen( $ad_post_title ) > 300 ) { $ad_post_title = substr( $ad_post_title, 0, 300 ); }


$ad_post_url = sanitize_text_field( $_POST['ad_post_url'] );
if ( ! $ad_post_url ) { $ad_post_url = ''; }
if ( strlen( $ad_post_url ) > 300 ) { $ad_post_url = substr( $ad_post_url, 0, 300 ); }
//end remove the spaces in the begining and end for these values




$ad_html = stripslashes( $_POST['ad_html'] );
if ( ! $ad_html ) { $ad_html = ''; }
if ( strlen( $ad_html ) > 900000 ) { $ad_html = substr( $ad_html, 0, 900000 ); }

$subtotal = stripslashes( $_POST['subtotal'] );
if ( ! $subtotal ) { $subtotal = ''; }
if ( strlen( $subtotal ) > 100 ) { $subtotal = substr( $subtotal, 0, 100 ); }

$discount = stripslashes( $_POST['discount'] );
if ( ! $discount ) { $discount = ''; }
if ( strlen( $discount ) > 100 ) { $discount = substr( $discount, 0, 100 ); }

$shipping = stripslashes( $_POST['shipping'] );
if ( ! $shipping ) { $shipping = ''; }
if ( strlen( $shipping ) > 100 ) { $shipping = substr( $shipping, 0, 100 ); }

$additional = stripslashes( $_POST['additional'] );
if ( ! $additional ) { $additional = ''; }
if ( strlen( $additional ) > 100 ) { $additional = substr( $additional, 0, 100 ); }

$fee = stripslashes( $_POST['fee'] );
if ( ! $fee ) { $fee = ''; }
if ( strlen( $fee ) > 100 ) { $fee = substr( $fee, 0, 100 ); }

$tax = stripslashes( $_POST['tax'] );
if ( ! $tax ) { $tax = ''; }
if ( strlen( $tax ) > 100 ) { $tax = substr( $tax, 0, 100 ); }

$ad_post_term_year = stripslashes( $_POST['ad_post_term_year'] );
if ( ! $ad_post_term_year ) { $ad_post_term_year = '0'; }
if ( strlen( $ad_post_term_year ) > 100 ) { $ad_post_term_year = substr( $ad_post_term_year, 0, 100 ); }

$ad_post_term_months = stripslashes( $_POST['ad_post_term_months'] );
if ( ! $ad_post_term_months ) { $ad_post_term_months = '0'; }
if ( strlen( $ad_post_term_months ) > 100 ) { $ad_post_term_months = substr( $ad_post_term_months, 0, 100 ); }

$ad_post_status = stripslashes( $_POST['ad_post_status'] );
if ( ! $ad_post_status ) { $ad_post_status = 'Active'; }
if ( strlen( $ad_post_status ) > 100 ) { $ad_post_status = substr( $ad_post_status, 0, 100 ); }

$da_score = stripslashes( $_POST['da_score'] );
if ( ! $da_score ) { $da_score = '0'; }
if ( strlen( $da_score ) > 10 ) { $da_score = substr( $da_score, 0, 10 ); }

$pa_score = stripslashes( $_POST['pa_score'] );
if ( ! $pa_score ) { $pa_score = '0'; }
if ( strlen( $pa_score ) > 10 ) { $pa_score = substr( $pa_score, 0, 10 ); }

$spam_score = stripslashes( $_POST['spam_score'] );
if ( ! $spam_score ) { $spam_score = '0'; }
if ( strlen( $spam_score ) > 10 ) { $spam_score = substr( $spam_score, 0, 10 ); }

$primary_notes = stripslashes( $_POST['primary_notes'] );
if ( ! $primary_notes ) { $primary_notes = ''; }
if ( strlen( $primary_notes ) > 500 ) { $primary_notes = substr( $primary_notes, 0, 500 ); }

$secondary_notes = stripslashes( $_POST['secondary_notes'] );
if ( ! $secondary_notes ) { $secondary_notes = ''; }
if ( strlen( $secondary_notes ) > 500 ) { $secondary_notes = substr( $secondary_notes, 0, 500 ); }



//remove the spaces in the begining and end for these values
$ad_post_anchor_text = sanitize_text_field( $_POST['ad_post_anchor_text'] );
if ( ! $ad_post_anchor_text ) { $ad_post_anchor_text = ''; }
if ( strlen( $ad_post_anchor_text ) > 200 ) { $ad_post_anchor_text = substr( $ad_post_anchor_text, 0, 200 ); }

$ad_post_anchor_text2 = sanitize_text_field( $_POST['ad_post_anchor_text2'] );
if ( ! $ad_post_anchor_text2 ) { $ad_post_anchor_text2 = ''; }
if ( strlen( $ad_post_anchor_text2 ) > 200 ) { $ad_post_anchor_text2 = substr( $ad_post_anchor_text2, 0, 200 ); }

$ad_post_anchor_text3 = sanitize_text_field( $_POST['ad_post_anchor_text3'] );
if ( ! $ad_post_anchor_text3 ) { $ad_post_anchor_text3 = ''; }
if ( strlen( $ad_post_anchor_text3 ) > 200 ) { $ad_post_anchor_text3 = substr( $ad_post_anchor_text3, 0, 200 ); }

$ad_post_anchor_text4 = sanitize_text_field( $_POST['ad_post_anchor_text4'] );
if ( ! $ad_post_anchor_text4 ) { $ad_post_anchor_text4 = ''; }
if ( strlen( $ad_post_anchor_text4 ) > 200 ) { $ad_post_anchor_text4 = substr( $ad_post_anchor_text4, 0, 200 ); }

$ad_link_url = sanitize_text_field( $_POST['ad_link_url'] );
if ( ! $ad_link_url ) { $ad_link_url = ''; }
if ( strlen( $ad_link_url ) > 500 ) { $ad_link_url = substr( $ad_link_url, 0, 500 ); }

$ad_link_url2 = sanitize_text_field( $_POST['ad_link_url2'] );
if ( ! $ad_link_url2 ) { $ad_link_url2 = ''; }
if ( strlen( $ad_link_url2 ) > 500 ) { $ad_link_url2 = substr( $ad_link_url2, 0, 500 ); }

$ad_link_url3 = sanitize_text_field( $_POST['ad_link_url3'] );
if ( ! $ad_link_url3 ) { $ad_link_url3 = ''; }
if ( strlen( $ad_link_url3 ) > 500 ) { $ad_link_url3 = substr( $ad_link_url3, 0, 500 ); }

$ad_link_url4 = sanitize_text_field( $_POST['ad_link_url4'] );
if ( ! $ad_link_url4 ) { $ad_link_url4 = ''; }
if ( strlen( $ad_link_url4 ) > 500 ) { $ad_link_url4 = substr( $ad_link_url4, 0, 500 ); }
//end remove the spaces in the begining and end for these values



$da_score2 = stripslashes( $_POST['da_score2'] );
if ( ! $da_score2 ) { $da_score2 = ''; }
if ( strlen( $da_score2 ) > 100 ) { $da_score2 = substr( $da_score2, 0, 100 ); }

$da_score3 = stripslashes( $_POST['da_score3'] );
if ( ! $da_score3 ) { $da_score3 = ''; }
if ( strlen( $da_score3 ) > 100 ) { $da_score3 = substr( $da_score3, 0, 100 ); }

$da_score4 = stripslashes( $_POST['da_score4'] );
if ( ! $da_score4 ) { $da_score4 = ''; }
if ( strlen( $da_score4 ) > 100 ) { $da_score4 = substr( $da_score4, 0, 100 ); }

$pa_score2 = stripslashes( $_POST['pa_score2'] );
if ( ! $pa_score2 ) { $pa_score2 = ''; }
if ( strlen( $pa_score2 ) > 100 ) { $pa_score2 = substr( $pa_score2, 0, 100 ); }

$pa_score3 = stripslashes( $_POST['pa_score3'] );
if ( ! $pa_score3 ) { $pa_score3 = ''; }
if ( strlen( $pa_score3 ) > 100 ) { $pa_score3 = substr( $pa_score3, 0, 100 ); }

$pa_score4 = stripslashes( $_POST['pa_score4'] );
if ( ! $pa_score4 ) { $pa_score4 = ''; }
if ( strlen( $pa_score4 ) > 100 ) { $pa_score4 = substr( $pa_score4, 0, 100 ); }

$spam_score2 = stripslashes( $_POST['spam_score2'] );
if ( ! $spam_score2 ) { $spam_score2 = ''; }
if ( strlen( $spam_score2 ) > 100 ) { $spam_score2 = substr( $spam_score2, 0, 100 ); }

$spam_score3 = stripslashes( $_POST['spam_score3'] );
if ( ! $spam_score3 ) { $spam_score3 = ''; }
if ( strlen( $spam_score3 ) > 100 ) { $spam_score3 = substr( $spam_score3, 0, 100 ); }

$spam_score4 = stripslashes( $_POST['spam_score4'] );
if ( ! $spam_score4 ) { $spam_score4 = ''; }
if ( strlen( $spam_score4 ) > 100 ) { $spam_score4 = substr( $spam_score4, 0, 100 ); }

$ad_post_plagiarism = stripslashes( $_POST['ad_post_plagiarism'] );
if ( ! $ad_post_plagiarism ) { $ad_post_plagiarism = 'No'; }
if ( strlen( $ad_post_plagiarism ) > 100 ) { $ad_post_plagiarism = substr( $ad_post_plagiarism, 0, 100 ); }

$ad_post_plagiarism_plag = stripslashes( $_POST['ad_post_plagiarism_plag'] );
if ( ! $ad_post_plagiarism_plag ) { $ad_post_plagiarism_plag = '0'; }
if ( strlen( $ad_post_plagiarism_plag ) > 100 ) { $ad_post_plagiarism_plag = substr( $ad_post_plagiarism_plag, 0, 100 ); }

$ad_post_plagiarism_unique = stripslashes( $_POST['ad_post_plagiarism_unique'] );
if ( ! $ad_post_plagiarism_unique ) { $ad_post_plagiarism_unique = '0'; }
if ( strlen( $ad_post_plagiarism_unique ) > 100 ) { $ad_post_plagiarism_unique = substr( $ad_post_plagiarism_unique, 0, 100 ); }

$payment_date = stripslashes( $_POST['payment_date'] );
if ( ! $payment_date ) { $payment_date = ''; }
if ( strlen( $payment_date ) > 100 ) { $payment_date = substr( $payment_date, 0, 100 ); }

$payment_name = stripslashes( $_POST['payment_name'] );
if ( ! $payment_name ) { $payment_name = ''; }
if ( strlen( $payment_name ) > 100 ) { $payment_name = substr( $payment_name, 0, 100 ); }

$payment_transid = stripslashes( $_POST['payment_transid'] );
if ( ! $payment_transid ) { $payment_transid = ''; }
if ( strlen( $payment_transid ) > 100 ) { $payment_transid = substr( $payment_transid, 0, 100 ); }

$payment_email = stripslashes( $_POST['payment_email'] );
if ( ! $payment_email ) { $payment_email = ''; }
if ( strlen( $payment_email ) > 200 ) { $payment_email = substr( $payment_email, 0, 200 ); }

$due_date = stripslashes( $_POST['due_date'] );
if ( ! $due_date ) { $due_date = ''; }
if ( strlen( $due_date ) > 100 ) { $due_date = substr( $due_date, 0, 100 ); }

$payment_link = stripslashes( $_POST['payment_link'] );
if ( ! $payment_link ) { $payment_link = ''; }
if ( strlen( $payment_link ) > 300 ) { $payment_link = substr( $payment_link, 0, 300 ); }

if (isset($_POST['link_selection1'])) {
	$link_selection1 = stripslashes( $_POST['link_selection1'] );
	if ( ! $link_selection1 ) { $link_selection1 = ''; }
	if ( strlen( $link_selection1 ) > 300 ) { $link_selection1 = substr( $link_selection1, 0, 300 ); }
	} else $link_selection1 = '';

if (isset($_POST['link_selection2'])) {
	$link_selection2 = stripslashes( $_POST['link_selection2'] );
	if ( ! $link_selection2 ) { $link_selection2 = ''; }
	if ( strlen( $link_selection2 ) > 300 ) { $link_selection2 = substr( $link_selection2, 0, 300 ); }
	} else $link_selection2 = '';

if (isset($_POST['link_selection3'])) {
	$link_selection3 = stripslashes( $_POST['link_selection3'] );
	if ( ! $link_selection3 ) { $link_selection3 = ''; }
	if ( strlen( $link_selection3 ) > 300 ) { $link_selection3 = substr( $link_selection3, 0, 300 ); }
	} else $link_selection3 = '';

if (isset($_POST['link_selection4'])) {
	$link_selection4 = stripslashes( $_POST['link_selection4'] );
	if ( ! $link_selection4 ) { $link_selection4 = ''; }
	if ( strlen( $link_selection4 ) > 300 ) { $link_selection4 = substr( $link_selection4, 0, 300 ); }
	} else $link_selection4 = '';


?>