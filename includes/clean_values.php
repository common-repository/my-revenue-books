<?php
$id = isset($id) ? $id : '';
if(isset($_REQUEST['id'])){ $ListingID = $_REQUEST['id']; }

$business_name = stripslashes( $_POST['business_name'] );
if ( ! $business_name ) { $business_name = ''; }
if ( strlen( $business_name ) > 200 ) { $business_name = substr( $business_name, 0, 200 ); }

$business_id = stripslashes( $_POST['business_id'] );
if ( ! $business_id ) { $business_id = ''; }
if ( strlen( $business_id ) > 100 ) { $business_id = substr( $business_id, 0, 100 ); }

$contact_name = stripslashes( $_POST['contact_name'] );
if ( ! $contact_name ) { $contact_name = ''; }
if ( strlen( $contact_name ) > 200 ) { $contact_name = substr( $contact_name, 0, 200 ); }

$address = stripslashes( $_POST['address'] );
if ( ! $address ) { $address = ''; }
if ( strlen( $address ) > 200 ) { $address = substr( $address, 0, 200 ); }

$address2 = stripslashes( $_POST['address2'] );
if ( ! $address2 ) { $address2 = ''; }
if ( strlen( $address2 ) > 200 ) { $address2 = substr( $address2, 0, 200 ); }

$city = stripslashes( $_POST['city'] );
if ( ! $city ) { $city = ''; }
if ( strlen( $city ) > 100 ) { $city = substr( $city, 0, 100 ); }

$st = stripslashes( $_POST['st'] );
if ( ! $st ) { $st = ''; }
if ( strlen( $st ) > 20 ) { $st = substr( $st, 0, 20 ); }

$zip = stripslashes( $_POST['zip'] );
if ( ! $zip ) { $zip = ''; }
if ( strlen( $zip ) > 15 ) { $zip = substr( $zip, 0, 15 ); }

$email = stripslashes( $_POST['email'] );
if ( ! $email ) { $email = ''; }
if ( strlen( $email ) > 200 ) { $email = substr( $email, 0, 200 ); }

$phone = stripslashes( $_POST['phone'] );
if ( ! $phone ) { $phone = ''; }
if ( strlen( $phone ) > 100 ) { $phone = substr( $phone, 0, 100 ); }

$phone2 = stripslashes( $_POST['phone2'] );
if ( ! $phone2 ) { $phone2 = ''; }
if ( strlen( $phone2 ) > 100 ) { $phone2 = substr( $phone2, 0, 100 ); }

$fax = stripslashes( $_POST['fax'] );
if ( ! $fax ) { $fax = ''; }
if ( strlen( $fax ) > 100 ) { $fax = substr( $fax, 0, 100 ); }

$website = stripslashes( $_POST['website'] );
if ( ! $website ) { $website = ''; }
if ( strlen( $website ) > 200 ) { $website = substr( $website, 0, 200 ); }

$the_date = stripslashes( $_POST['the_date'] );
if ( ! $the_date ) { $the_date = ''; }
if ( strlen( $the_date ) > 100 ) { $the_date = substr( $the_date, 0, 100 ); }

$campain_start = stripslashes( $_POST['campain_start'] );
if ( ! $campain_start ) { $campain_start = ''; }
if ( strlen( $campain_start ) > 100 ) { $campain_start = substr( $campain_start, 0, 100 ); }

$campain_end = stripslashes( $_POST['campain_end'] );
if ( ! $campain_end ) { $campain_end = ''; }
if ( strlen( $campain_end ) > 100 ) { $campain_end = substr( $campain_end, 0, 100 ); }

$reminder = stripslashes( $_POST['reminder'] );
if ( ! $reminder ) { $reminder = ''; }
if ( strlen( $reminder ) > 100 ) { $reminder = substr( $reminder, 0, 100 ); }

$reminder_date = stripslashes( $_POST['reminder_date'] );
if ( ! $reminder_date ) { $reminder_date = ''; }
if ( strlen( $reminder_date ) > 100 ) { $reminder_date = substr( $reminder_date, 0, 100 ); }

$duration = stripslashes( $_POST['duration'] );
if ( ! $duration ) { $duration = ''; }
if ( strlen( $duration ) > 200 ) { $duration = substr( $duration, 0, 200 ); }

$description = stripslashes( $_POST['description'] );
if ( ! $description ) { $description = ''; }
if ( strlen( $description ) > 5000 ) { $description = substr( $description, 0, 5000 ); }

$payment_type = stripslashes( $_POST['payment_type'] );
if ( ! $payment_type ) { $payment_type = ''; }
if ( strlen( $payment_type ) > 100 ) { $payment_type = substr( $payment_type, 0, 100 ); }

$payment_details = stripslashes( $_POST['payment_details'] );
if ( ! $payment_details ) { $payment_details = ''; }
if ( strlen( $payment_details ) > 1000 ) { $payment_details = substr( $payment_details, 0, 1000 ); }

$amount = stripslashes( $_POST['amount'] );
if ( ! $amount ) { $amount = ''; }
if ( strlen( $amount ) > 100 ) { $amount = substr( $amount, 0, 100 ); }

$status = stripslashes( $_POST['status'] );
if ( ! $status ) { $status = ''; }
if ( strlen( $status ) > 100 ) { $status = substr( $status, 0, 100 ); }

$notes = stripslashes( $_POST['notes'] );
if ( ! $notes ) { $notes = ''; }
if ( strlen( $notes ) > 5000 ) { $notes = substr( $notes, 0, 5000 ); }

$last_edited = stripslashes( $_POST['last_edited'] );
if ( ! $last_edited ) { $last_edited = ''; }
if ( strlen( $last_edited ) > 100 ) { $last_edited = substr( $last_edited, 0, 100 ); }

$the_ref = stripslashes( $_POST['the_ref'] );
if ( ! $the_ref ) { $the_ref = ''; }
if ( strlen( $the_ref ) > 200 ) { $the_ref = substr( $the_ref, 0, 200 ); }

$reminder_sent = stripslashes( $_POST['reminder_sent'] );
if ( ! $reminder_sent ) { $reminder_sent = ''; }
if ( strlen( $reminder_sent ) > 200 ) { $reminder_sent = substr( $reminder_sent, 0, 200 ); }

$reminder_date_sent = stripslashes( $_POST['reminder_date_sent'] );
if ( ! $reminder_date_sent ) { $reminder_date_sent = ''; }
if ( strlen( $reminder_date_sent ) > 200 ) { $reminder_date_sent = substr( $reminder_date_sent, 0, 200 ); }

$primary_contact = stripslashes( $_POST['primary_contact'] );
if ( ! $primary_contact ) { $primary_contact = ''; }
if ( strlen( $primary_contact ) > 200 ) { $primary_contact = substr( $primary_contact, 0, 200 ); }

$primary_email = stripslashes( $_POST['primary_email'] );
if ( ! $primary_email ) { $primary_email = ''; }
if ( strlen( $primary_email ) > 200 ) { $primary_email = substr( $primary_email, 0, 200 ); }

$secondary_contact = stripslashes( $_POST['secondary_contact'] );
if ( ! $secondary_contact ) { $secondary_contact = ''; }
if ( strlen( $secondary_contact ) > 200 ) { $secondary_contact = substr( $secondary_contact, 0, 200 ); }

$secondary_email = stripslashes( $_POST['secondary_email'] );
if ( ! $secondary_email ) { $secondary_email = ''; }
if ( strlen( $secondary_email ) > 200 ) { $secondary_email = substr( $secondary_email, 0, 200 ); }

$ad_html = stripslashes( $_POST['ad_html'] );
if ( ! $ad_html ) { $ad_html = ''; }
if ( strlen( $ad_html ) > 5000 ) { $ad_html = substr( $ad_html, 0, 5000 ); }

?>