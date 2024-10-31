<?php
global $wpdb;

//Reminders
$date1 = date("m/d/Y");
$the_current_date = strtotime(str_replace("_", "",$date1));
$the_reminder = "Yes";
$I = 0;
$RI=0;

	//Get the company information
	$the_id = 1;
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s", $the_id  ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$bus_name = $myrevenuebooks_sql->business_name;
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
	$business_info = $myrevenuebooks_sql->business_info;
	$email_to = $myrevenuebooks_sql->email;
	}

$table = $wpdb->prefix . "myrevenuebooks";
$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE reminder = %s", $the_reminder ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		$RI++;
	$the_r_date[$RI] = $myrevenuebooks_sql->reminder_date;
	$the_r_date1[$RI] = strtotime(str_replace("_", "",$the_r_date[$RI]));
		if ($the_r_date1[$RI]<=$the_current_date) {
			
		$I++;
			$business_id[$I] = $myrevenuebooks_sql->business_id;
			//get the business name
			$the_bus_name = "";
			$table = $wpdb->prefix . "myrevenuebooks";
			$myrevenuebooks_sqlc = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id = %s AND business_name <> %s", $business_id[$I], $the_bus_name ));
			foreach ( $myrevenuebooks_sqlc as $myrevenuebooks_sqc ) 
			{ $business_name[$I] = $myrevenuebooks_sqc->business_name; }
			//echo "Business Name" . $I . ": " . $business_name[$I] . "<br>";
			
		$the_r_date[$I] = $myrevenuebooks_sql->reminder_date;
		$the_date[$I] = $myrevenuebooks_sql->the_date;
		$trans_amount[$I] = $myrevenuebooks_sql->amount;
		$the_status[$I] = $myrevenuebooks_sql->status;
		
		//echo "Search Output: ID:" . $business_id[$I] . " " . $the_date[$I] . " " . $business_name[$I] . "$ " . $trans_amount[$I] . "" . $the_status[$I] . "<br>";
			
		}
	}


	// if reminders are found
	if ($I>=1) {
		$x=0;
	
	// Email the reminder
	add_filter( 'wp_mail_content_type[$I]', 'set_html_content_type[$I]' );
	$body = "";
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$headers = 'From: My Revenue Books <' . $email_to . '>';
	$to = $email_to;
	$subject = 'Transaction Reminder';
	$body = isset($body[$x]) ? $body[$x] : '';
	$body .= "You have a reminder for the following transaction(s):" . "\r\n" . "\r\n";
		 
		for ($x = 1; $x <= $I; $x++) {
		$body .= $the_r_date[$x] . " - " . $business_name[$x] . " ($" . $trans_amount[$x] . ")" . "\r\n";
		//echo "The Body: " . $body . "<br>";
				}
		$body .= "\r\n" . "Note: You will continue to receive these notifications until you remove the reminder from the transaction or discontinue reminders in setup." . "\r\n";
		wp_mail( $to, $subject, $body, $headers );
	
		// Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
		remove_filter( 'wp_mail_content_type[$x]', 'set_html_content_type[$x]' );
		
	}


?>