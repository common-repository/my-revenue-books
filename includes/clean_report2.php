<?php
//count the columns
$col_count=0;

//$the_id = stripslashes( $_POST['the_business_id'] );
//if ( ! $the_id ) { $the_id = ''; }
//if ( strlen( $the_id ) > 100 ) { $the_id = substr( $the_id, 0, 100 ); }

$q1 = isset($_POST['the_inv_date']);
if ($q1 == 1) { $col_count++;
	$the_inv_date = stripslashes( $_POST['the_inv_date'] );
	if ( ! $the_inv_date ) { $the_inv_date = ''; }
	if ( strlen( $the_inv_date ) > 100 ) { $the_inv_date = substr( $the_inv_date, 0, 100 ); }
	}

$q14 = isset($_POST['the_business_name']);
if ($q14 == 1) { $col_count++;
	$the_business_name = stripslashes( $_POST['the_business_name'] );
	if ( ! $the_business_name ) { $the_business_name = ''; }
	if ( strlen( $the_business_name ) > 200 ) { $the_business_name = substr( $the_business_name, 0, 200 ); }
	}

$q2 = isset($_POST['the_po_ref']);
if ($q2 == 1) { $col_count++;
	$the_po_ref = stripslashes( $_POST['the_po_ref'] );
	if ( ! $the_po_ref ) { $the_po_ref = ''; }
	if ( strlen( $the_po_ref ) > 100 ) { $the_po_ref = substr( $the_po_ref, 0, 100 ); }
	}

$q3 = isset($_POST['the_campain_start']);
if ($q3 == 1) { $col_count++;
	$the_campain_start = stripslashes( $_POST['the_campain_start'] );
	if ( ! $the_campain_start ) { $the_campain_start = ''; }
	if ( strlen( $the_campain_start ) > 100 ) { $the_campain_start = substr( $the_campain_start, 0, 100 ); }
	}

$q4 = isset($_POST['the_campain_end']);
if ($q4 == 1) { $col_count++;
	$the_campain_end = stripslashes( $_POST['the_campain_end'] );
	if ( ! $the_campain_end ) { $the_campain_end = ''; }
	if ( strlen( $the_campain_end ) > 100 ) { $the_campain_end = substr( $the_campain_end, 0, 100 ); }
	}

$q5 = isset($_POST['the_reminder']);
if ($q5 == 1) { $col_count++;
	$the_reminder = stripslashes( $_POST['the_reminder'] );
	if ( ! $the_reminder ) { $the_reminder = ''; }
	if ( strlen( $the_reminder ) > 100 ) { $the_reminder = substr( $the_reminder, 0, 100 ); }
	}

$q6 = isset($_POST['the_reminder_date']);
if ($q6 == 1) { $col_count++;
	$the_reminder_date = stripslashes( $_POST['the_reminder_date'] );
	if ( ! $the_reminder_date ) { $the_reminder_date = ''; }
	if ( strlen( $the_reminder_date ) > 20 ) { $the_reminder_date = substr( $the_reminder_date, 0, 20 ); }
	}

$q7 = isset($_POST['the_duration']);
if ($q7 == 1) { $col_count++;
	$the_duration = stripslashes( $_POST['the_duration'] );
	if ( ! $the_duration ) { $the_duration = ''; }
	if ( strlen( $the_duration ) > 15 ) { $the_duration = substr( $the_duration, 0, 15 ); }
	}
	
$q8 = isset($_POST['the_description']);
if ($q8 == 1) { $col_count++;
	$the_description = stripslashes( $_POST['the_description'] );
	if ( ! $the_description ) { $the_description = ''; }
	if ( strlen( $the_description ) > 5000 ) { $the_description = substr( $the_description, 0, 5000 ); }
	}

$q9 = isset($_POST['the_payment_type']);
if ($q9 == 1) { $col_count++;
	$the_payment_type = stripslashes( $_POST['the_payment_type'] );
	if ( ! $the_payment_type ) { $the_payment_type = ''; }
	if ( strlen( $the_payment_type ) > 100 ) { $the_payment_type = substr( $the_payment_type, 0, 100 ); }
	}

$q10 = isset($_POST['the_payment_details']);
if ($q10 == 1) { $col_count++;
	$the_payment_details = stripslashes( $_POST['the_payment_details'] );
	if ( ! $the_payment_details ) { $the_payment_details = ''; }
	if ( strlen( $the_payment_details ) > 1000 ) { $the_payment_details = substr( $the_payment_details, 0, 1000 ); }
	}

$q11 = isset($_POST['the_amount']);
if ($q11 == 1) { $col_count++;
	$the_amount = stripslashes( $_POST['the_amount'] );
	if ( ! $the_amount ) { $the_amount = ''; }
	if ( strlen( $the_amount ) > 100 ) { $the_amount = substr( $the_amount, 0, 100 ); }
	}

$q12 = isset($_POST['the_status']);
if ($q12 == 1) { $col_count++;
	$the_status = stripslashes( $_POST['the_status'] );
	if ( ! $the_status ) { $the_status = ''; }
	if ( strlen( $the_status ) > 200 ) { $the_status = substr( $the_status, 0, 200 ); }
	}

$q13 = isset($_POST['the_notes']);
if ($q13 == 1) { $col_count++;
	$the_notes = stripslashes( $_POST['the_notes'] );
	if ( ! $the_notes ) { $the_notes = ''; }
	if ( strlen( $the_notes ) > 5000 ) { $the_notes = substr( $the_notes, 0, 5000 ); }
	}

$q15 = isset($_POST['the_ref']);
if ($q15 == 1) { $col_count++;
	$the_ref = stripslashes( $_POST['the_ref'] );
	if ( ! $the_ref ) { $the_ref = ''; }
	if ( strlen( $the_ref ) > 200 ) { $the_ref = substr( $the_ref, 0, 200 ); }
	}
$q16 = isset($_POST['reminder_sent']);
if ($q16 == 1) { $col_count++;
	$reminder_sent = stripslashes( $_POST['reminder_sent'] );
	if ( ! $reminder_sent ) { $reminder_sent = ''; }
	if ( strlen( $reminder_sent ) > 200 ) { $reminder_sent = substr( $reminder_sent, 0, 200 ); }
	}
$q17 = isset($_POST['reminder_date_sent']);
if ($q17 == 1) { $col_count++;
	$reminder_date_sent = stripslashes( $_POST['reminder_date_sent'] );
	if ( ! $reminder_date_sent ) { $reminder_date_sent = ''; }
	if ( strlen( $reminder_date_sent ) > 200 ) { $reminder_date_sent = substr( $reminder_date_sent, 0, 200 ); }
	}
$q18 = isset($_POST['ad_html']);
if ($q18 == 1) { $col_count++;
	$ad_html = stripslashes( $_POST['ad_html'] );
	if ( ! $ad_html ) { $ad_html = ''; }
	if ( strlen( $ad_html ) > 5000 ) { $ad_html = substr( $ad_html, 0, 5000 ); }
	}
$q19 = isset($_POST['primary_contact']);
if ($q19 == 1) { $col_count++;
	$primary_contact = stripslashes( $_POST['primary_contact'] );
	if ( ! $primary_contact ) { $primary_contact = ''; }
	if ( strlen( $primary_contact ) > 200 ) { $primary_contact = substr( $primary_contact, 0, 200 ); }
	}
$q20 = isset($_POST['primary_email']);
if ($q20 == 1) { $col_count++;
	$primary_email = stripslashes( $_POST['primary_email'] );
	if ( ! $primary_email ) { $primary_email = ''; }
	if ( strlen( $primary_email ) > 200 ) { $primary_email = substr( $primary_email, 0, 200 ); }
	}
$q21 = isset($_POST['secondary_contact']);
if ($q21 == 1) { $col_count++;
	$secondary_contact = stripslashes( $_POST['secondary_contact'] );
	if ( ! $secondary_contact ) { $secondary_contact = ''; }
	if ( strlen( $secondary_contact ) > 200 ) { $secondary_contact = substr( $secondary_contact, 0, 200 ); }
	}
$q22 = isset($_POST['secondary_email']);
if ($q22 == 1) { $col_count++;
	$secondary_email = stripslashes( $_POST['secondary_email'] );
	if ( ! $secondary_email ) { $secondary_email = ''; }
	if ( strlen( $secondary_email ) > 200 ) { $secondary_email = substr( $secondary_email, 0, 200 ); }
	}
	
	
	
?>