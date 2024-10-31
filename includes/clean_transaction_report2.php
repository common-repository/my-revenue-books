<?php
	if (!empty($_POST['the_inv_date2'])) { $col_count++; $col=array("C$col_count"=>"DATE");
										$the_inv_date = stripslashes( $_POST['the_inv_date2'] ); 
										if ( ! $the_inv_date ) { $the_inv_date = ''; }
										if ( strlen( $the_inv_date ) > 100 ) { $the_inv_date = substr( $the_inv_date, 0, 100 ); }
										} else $the_inv_date = "";

	if (!empty($_POST['the_po_ref2'])) { $col_count++; 
										if (!empty($col)) {$col=$col + array("C$col_count"=>"PO/INV");}
											else $col=array("C$col_count"=>"PO/INV");
										$the_po_ref = stripslashes( $_POST['the_po_ref2'] ); 
										if ( ! $the_po_ref ) { $the_po_ref = ''; }
										if ( strlen( $the_po_ref ) > 100 ) { $the_po_ref = substr( $the_po_ref, 0, 100 ); }
										} else $the_po_ref = "";
	
	if (!empty($_POST['the_ref2'])) { $col_count++; 
										if (!empty($col)) {$col=$col + array("C$col_count"=>"REF");}
											else $col=array("C$col_count"=>"REF");
										$the_ref = stripslashes( $_POST['the_ref2'] ); 
										if ( ! $the_ref ) { $the_ref = ''; }
										if ( strlen( $the_ref ) > 100 ) { $the_ref = substr( $the_ref, 0, 100 ); }
										} else $the_ref = "";
	
	if (!empty($_POST['the_campain_start2'])) { $col_count++; 
										if (!empty($col)) {$col=$col + array("C$col_count"=>"START");}
											else $col=array("C$col_count"=>"START");
										$the_campain_start = stripslashes( $_POST['the_campain_start2'] ); 
										if ( ! $the_campain_start ) { $the_campain_start = ''; }
										if ( strlen( $the_campain_start ) > 100 ) { $the_campain_start = substr( $the_campain_start, 0, 100 ); }
										} else $the_campain_start = "";

	if (!empty($_POST['the_campain_end2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"END");}
											else $col=array("C$col_count"=>"END");
										$the_campain_end = stripslashes( $_POST['the_campain_end2'] ); 
										if ( ! $the_campain_end ) { $the_campain_end = ''; }
										if ( strlen( $the_campain_end ) > 100 ) { $the_campain_end = substr( $the_campain_end, 0, 100 ); }
										} else $the_campain_end = "";

	if (!empty($_POST['the_duration2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"DURATION");}
											else $col=array("C$col_count"=>"DURATION");
										$the_duration = stripslashes( $_POST['the_duration2'] ); 
										if ( ! $the_duration ) { $the_duration = ''; }
										if ( strlen( $the_duration ) > 100 ) { $the_duration = substr( $the_duration, 0, 100 ); }
										} else $the_duration = "";

	if (!empty($_POST['the_reminder2'])) { $col_count++; $col=$col + array("C$col_count"=>"REMINDER");
										if (!empty($col)) {$col=$col + array("C$col_count"=>"REMINDER");}
											else $col=array("C$col_count"=>"REMINDER");
										$the_reminder = stripslashes( $_POST['the_reminder2'] ); 
										if ( ! $the_reminder ) { $the_reminder = ''; }
										if ( strlen( $the_reminder ) > 100 ) { $the_reminder = substr( $the_reminder, 0, 100 ); }
										} else $the_reminder = "";

	if (!empty($_POST['the_reminder_date2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"REM DATE");}
											else $col=array("C$col_count"=>"REM DATE");
										$the_reminder_date = stripslashes( $_POST['the_reminder_date2'] ); 
										if ( ! $the_reminder_date ) { $the_reminder_date = ''; }
										if ( strlen( $the_reminder_date ) > 100 ) { $the_reminder_date = substr( $the_reminder_date, 0, 100 ); }
										} else $the_reminder_date = "";

	if (!empty($_POST['reminder_sent2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"REM SENT");}
											else $col=array("C$col_count"=>"REM SENT");
										$reminder_sent = stripslashes( $_POST['reminder_sent2'] ); 
										if ( ! $reminder_sent ) { $reminder_sent = ''; }
										if ( strlen( $reminder_sent ) > 100 ) { $reminder_sent = substr( $reminder_sent, 0, 100 ); }
										} else $reminder_sent = "";

	if (!empty($_POST['reminder_date_sent2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"REM DATE SENT");}
											else $col=array("C$col_count"=>"REM DATE SENT");
										$reminder_date_sent = stripslashes( $_POST['reminder_date_sent2'] ); 
										if ( ! $reminder_date_sent ) { $reminder_date_sent = ''; }
										if ( strlen( $reminder_date_sent ) > 100 ) { $reminder_date_sent = substr( $reminder_date_sent, 0, 100 ); }
										} else $reminder_date_sent = "";

	if (!empty($_POST['the_description2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"DESCRIPTION");}
											else $col=array("C$col_count"=>"DESCRIPTION");
										$the_description = stripslashes( $_POST['the_description2'] ); 
										if ( ! $the_description ) { $the_description = ''; }
										if ( strlen( $the_description ) > 5000 ) { $the_description = substr( $the_description, 0, 5000 ); }
										} else $the_description = "";

	if (!empty($_POST['ad_html2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"AD HTML");}
											else $col=array("C$col_count"=>"AD HTML");
										$ad_html = stripslashes( $_POST['ad_html2'] ); 
										if ( ! $ad_html ) { $ad_html = ''; }
										if ( strlen( $ad_html ) > 5000 ) { $ad_html = substr( $ad_html, 0, 5000 ); }
										} else $ad_html = "";

	if (!empty($_POST['primary_contact2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"PRIMARY CONTACT");}
											else $col=array("C$col_count"=>"PRIMARY CONTACT");
										$primary_contact = stripslashes( $_POST['primary_contact2'] ); 
										if ( ! $primary_contact ) { $primary_contact = ''; }
										if ( strlen( $primary_contact ) > 100 ) { $primary_contact = substr( $primary_contact, 0, 100 ); }
										} else $primary_contact = "";

	if (!empty($_POST['primary_email2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"PRIMARY EMAIL");}
											else $col=array("C$col_count"=>"PRIMARY EMAIL");
										$primary_email = stripslashes( $_POST['primary_email2'] ); 
										if ( ! $primary_email ) { $primary_email = ''; }
										if ( strlen( $primary_email ) > 100 ) { $primary_email = substr( $primary_email, 0, 100 ); }
										} else $primary_email = "";

	if (!empty($_POST['secondary_contact2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"SECONDARY CONTACT");}
											else $col=array("C$col_count"=>"SECONDARY CONTACT");										
										$secondary_contact = stripslashes( $_POST['secondary_contact2'] ); 
										if ( ! $secondary_contact ) { $secondary_contact = ''; }
										if ( strlen( $secondary_contact ) > 100 ) { $secondary_contact = substr( $secondary_contact, 0, 100 ); }
										} else $secondary_contact = "";

	if (!empty($_POST['secondary_email2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"SECONDARY EMAIL");}
											else $col=array("C$col_count"=>"SECONDARY EMAIL");								
										$secondary_email = stripslashes( $_POST['secondary_email2'] ); 
										if ( ! $secondary_email ) { $secondary_email = ''; }
										if ( strlen( $secondary_email ) > 100 ) { $secondary_email = substr( $secondary_email, 0, 100 ); }
										} else $secondary_email = "";

	if (!empty($_POST['the_payment_type2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"PAYMENT TYPE");}
											else $col=array("C$col_count"=>"PAYMENT TYPE");								
										$the_payment_type = stripslashes( $_POST['the_payment_type2'] ); 
										if ( ! $the_payment_type ) { $the_payment_type = ''; }
										if ( strlen( $the_payment_type ) > 255 ) { $the_payment_type = substr( $the_payment_type, 0, 255 ); }
										} else $the_payment_type = "";

	if (!empty($_POST['the_payment_details2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"PAYMENT DETAILS");}
											else $col=array("C$col_count"=>"PAYMENT DETAILS");
										$the_payment_details = stripslashes( $_POST['the_payment_details2'] ); 
										if ( ! $the_payment_details ) { $the_payment_details = ''; }
										if ( strlen( $the_payment_details ) > 255 ) { $the_payment_details = substr( $the_payment_details, 0, 255 ); }
										} else $the_payment_details = "";

	if (!empty($_POST['subtotal2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"SUBTOTAL");}
											else $col=array("C$col_count"=>"SUBTOTAL");									
										$subtotal = stripslashes( $_POST['subtotal2'] ); 
										if ( ! $subtotal ) { $subtotal = ''; }
										if ( strlen( $subtotal ) > 20 ) { $subtotal = substr( $subtotal, 0, 20 ); }
										} else $subtotal = "";

	if (!empty($_POST['discount2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"DISCOUNT");}
											else $col=array("C$col_count"=>"DISCOUNT");
										$discount = stripslashes( $_POST['discount2'] ); 
										if ( ! $discount ) { $discount = ''; }
										if ( strlen( $discount ) > 20 ) { $discount = substr( $discount, 0, 20 ); }
										} else $discount = "";

	if (!empty($_POST['shipping2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"SHIPPING");}
											else $col=array("C$col_count"=>"SHIPPING");
										$shipping = stripslashes( $_POST['shipping2'] ); 
										if ( ! $shipping ) { $shipping = ''; }
										if ( strlen( $shipping ) > 20 ) { $shipping = substr( $shipping, 0, 20 ); }
										} else $shipping = "";

	if (!empty($_POST['additional2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"ADDL FEE");}
											else $col=array("C$col_count"=>"ADDL FEE");
										$additional = stripslashes( $_POST['additional2'] ); 
										if ( ! $additional ) { $additional = ''; }
										if ( strlen( $additional ) > 20 ) { $additional = substr( $additional, 0, 20 ); }
										} else $additional = "";

	if (!empty($_POST['fee2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"FEE");}
											else $col=array("C$col_count"=>"FEE");
										$fee = stripslashes( $_POST['fee2'] ); 
										if ( ! $fee ) { $fee = ''; }
										if ( strlen( $fee ) > 10 ) { $fee = substr( $fee, 0, 10 ); }
										} else $fee = "";

	if (!empty($_POST['tax2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"TAX");}
											else $col=array("C$col_count"=>"TAX");
										$tax = stripslashes( $_POST['tax2'] ); 
										if ( ! $tax ) { $tax = ''; }
										if ( strlen( $tax ) > 10 ) { $tax = substr( $tax, 0, 10 ); }
										} else $tax = "";

	if (!empty($_POST['the_amount2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"TOTAL AMOUNT");}
											else $col=array("C$col_count"=>"TOTAL AMOUNT");
										$the_amount = stripslashes( $_POST['the_amount2'] ); 
										if ( ! $the_amount ) { $the_amount = ''; }
										if ( strlen( $the_amount ) > 10 ) { $the_amount = substr( $the_amount, 0, 10 ); }
										} else $the_amount = "";

	if (!empty($_POST['the_status2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"STATUS");}
											else $col=array("C$col_count"=>"STATUS");
										$the_status = stripslashes( $_POST['the_status2'] ); 
										if ( ! $the_status ) { $the_status = ''; }
										if ( strlen( $the_status ) > 100 ) { $the_status = substr( $the_status, 0, 100 ); }
										} else $the_status = "";

	if (!empty($_POST['the_notes2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"NOTES");}
											else $col=array("C$col_count"=>"NOTES");
										$the_notes = stripslashes( $_POST['the_notes2'] ); 
										if ( ! $the_notes ) { $the_notes = ''; }
										if ( strlen( $the_notes ) > 5000 ) { $the_notes = substr( $the_notes, 0, 5000 ); }
										} else $the_notes = "";

	if (!empty($_POST['the_log_notes2'])) { $col_count++;
										if (!empty($col)) {$col=$col + array("C$col_count"=>"LOG NOTES");}
											else $col=array("C$col_count"=>"LOG NOTES");
										$the_log_notes = stripslashes( $_POST['the_log_notes2'] ); 
										if ( ! $the_log_notes ) { $the_log_notes = ''; }
										if ( strlen( $the_log_notes ) > 90000 ) { $the_log_notes = substr( $the_log_notes, 0, 90000 ); }
										} else $the_log_notes = "";
?>