<?php
//count the columns
$col_count=0;

$the_id = stripslashes( $_POST['the_business_id'] );
if ( ! $the_id ) { $the_id = ''; }
if ( strlen( $the_id ) > 100 ) { $the_id = substr( $the_id, 0, 100 ); }

$q1 = isset($_POST['the_inv_date']);
if ($q1 == 1) { $col_count++;
	$the_inv_date = stripslashes( $_POST['the_inv_date'] );
	if ( ! $the_inv_date ) { $the_inv_date = ''; }
	if ( strlen( $the_inv_date ) > 100 ) { $the_inv_date = substr( $the_inv_date, 0, 100 ); }
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
?>