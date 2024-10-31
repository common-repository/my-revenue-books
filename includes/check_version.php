<?php
$the_new_version = myrevenuebooks_version;
$current_version = "";
$the_version_id = 1;
$the_user = 1;
$the_busid = 1;
	
// Update database to the new version if required
$table = $wpdb->prefix . "myrevenuebooks";
$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s AND business_id = %s", $the_user, $the_busid ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		$current_version = $myrevenuebooks_sql->version;
		
		if ( $current_version != $the_new_version ) {
			
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			global $wpdb;
			$table_name = $wpdb->prefix . "myrevenuebooks";
			$sql = "CREATE TABLE " . $table_name . " (
			the_ref LONGTEXT NULL,
			reminder_sent LONGTEXT NULL,
			reminder_date_sent LONGTEXT NULL,
			primary_contact LONGTEXT NULL,
			secondary_contact LONGTEXT NULL,
			primary_email LONGTEXT NULL,
			secondary_email LONGTEXT NULL,
			ad_html LONGTEXT NULL,
			log_notes LONGTEXT NULL,
			email_template1 LONGTEXT NULL,
				subtotal LONGTEXT NULL,
				discount LONGTEXT NULL,
				shipping LONGTEXT NULL,
				additional LONGTEXT NULL,
				fee LONGTEXT NULL,
				tax LONGTEXT NULL,
					ad_post_title LONGTEXT NULL,
					ad_post_url LONGTEXT NULL,
					ad_post_anchor_text LONGTEXT NULL,
					ad_post_term_year LONGTEXT NULL,
					ad_post_term_months LONGTEXT NULL,
					ad_post_status LONGTEXT NULL,
					da_score LONGTEXT NULL,
					pa_score LONGTEXT NULL,
					spam_score LONGTEXT NULL,
					ad_link_url LONGTEXT NULL,
					primary_notes LONGTEXT NULL,
					secondary_notes LONGTEXT NULL,
		ad_post_anchor_text2 LONGTEXT NULL,
		ad_post_anchor_text3 LONGTEXT NULL,
		ad_link_url2 LONGTEXT NULL,
		ad_link_url3 LONGTEXT NULL,
		da_score2 LONGTEXT NULL,
		da_score3 LONGTEXT NULL,
		pa_score2 LONGTEXT NULL,
		pa_score3 LONGTEXT NULL,
		spam_score2 LONGTEXT NULL,
		spam_score3 LONGTEXT NULL,
		ad_post_plagiarism LONGTEXT NULL,
		ad_post_plagiarism_plag LONGTEXT NULL,
		ad_post_plagiarism_unique LONGTEXT NULL,
		mrb_uninstall LONGTEXT NULL,
		mrb_settings LONGTEXT NULL,
		payment_date LONGTEXT NULL,
		payment_name LONGTEXT NULL,
		payment_email LONGTEXT NULL,
		payment_transid LONGTEXT NULL,
		payment_terms LONGTEXT NULL,
				link_selection1 LONGTEXT NULL,
				link_selection2 LONGTEXT NULL,
				link_selection3 LONGTEXT NULL,
				link_selection4 LONGTEXT NULL,
				ad_post_anchor_text4 LONGTEXT NULL,
				ad_link_url4 LONGTEXT NULL,
				da_score4 LONGTEXT NULL,
				pa_score4 LONGTEXT NULL,
				spam_score4 LONGTEXT NULL,
				due_date LONGTEXT NULL,
				payment_link LONGTEXT NULL,
				workorder_type LONGTEXT NULL,
				workorder_details LONGTEXT NULL,
				workorder_assigned LONGTEXT NULL,
				workorder_userid LONGTEXT NULL,
				workorder_username LONGTEXT NULL,
				workorder_useremail LONGTEXT NULL,
				workorder_total LONGTEXT NULL,
				workorder_commission LONGTEXT NULL,
				workorder_status LONGTEXT NULL,
				workorder_due_date LONGTEXT NULL,
				workorder_payment_details LONGTEXT NULL,
				workorder_payment_date LONGTEXT NULL,
				workorder_file_status LONGTEXT NULL,
			PRIMARY KEY  (id)
					)  $charset_collate;";
			dbDelta($sql);

			$table_name2 = $wpdb->prefix . "myrevenuebooks_email";
			$sql = "CREATE TABLE " . $table_name2 . " (
			id BIGINT(7) NOT NULL AUTO_INCREMENT,
			the_id INT(7) NULL,
			business_id INT(7) NULL,
			email_from_name LONGTEXT NULL,
			email_from LONGTEXT NULL,
			email_to LONGTEXT NULL,
			email_to_cc LONGTEXT NULL,
			email_to_bcc LONGTEXT NULL,
			email_subject LONGTEXT NULL,
			email_body LONGTEXT NULL,
			reminder_sent LONGTEXT NULL,
			reminder_date_sent LONGTEXT NULL,
			PRIMARY KEY  (id)
			)  $charset_collate;";
			dbDelta($sql);
			
		$table_name3 = $wpdb->prefix . "myrevenuebooks_security";
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE $table_name3 (
		id BIGINT(7) NOT NULL AUTO_INCREMENT,
		security_option LONGTEXT NULL,
		security_type LONGTEXT NULL,
		column_number LONGTEXT NULL,
		column_name_display LONGTEXT NULL,
		column_setting LONGTEXT NULL,
		column_color LONGTEXT NULL,
		column_text_color LONGTEXT NULL,
		column_text_lenght LONGTEXT NULL,
 		userid LONGTEXT NULL,
		user_email LONGTEXT NULL,
		user_firstname LONGTEXT NULL,
		user_lastname LONGTEXT NULL,
		user_role LONGTEXT NULL,
		user_role_level LONGTEXT NULL,
		default_security_message LONGTEXT NULL,
		workorder_type LONGTEXT NULL,
		workorder_details LONGTEXT NULL,
		workorder_assigned LONGTEXT NULL,
		workorder_userid LONGTEXT NULL,
		workorder_username LONGTEXT NULL,
		workorder_useremail LONGTEXT NULL,
		workorder_commission LONGTEXT NULL,
		workorder_status LONGTEXT NULL,
		workorder_subject LONGTEXT NULL,
		workorder_subject_change LONGTEXT NULL,
		workorder_new_order_notify LONGTEXT NULL,
		workorder_order_change_notify LONGTEXT NULL,
		workorder_admin_email LONGTEXT NULL,
		PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		
	//Check for new install.....if so add info
	$security_option_check = "";
	$id_check = "";
	$x=0;
	$table_name3 = $wpdb->prefix . "myrevenuebooks_security";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_name3 . " WHERE security_option <> %s AND id <> %s", $security_option_check, $id_check ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		$security_option = $myrevenuebooks_sql->security_option;
		$x++;
		}
			if ($x == 0) {
			//Add Initial Data to myrevenuebooks_security
			$security_option = "Disabled";
			$table_name3 = $wpdb->prefix . 'myrevenuebooks_security';
			$wpdb->insert( $table_name3, 
			array( 'security_option' => $security_option, ));	
				}
				
				
			//Update to the new version
			$table = $wpdb->prefix . "myrevenuebooks";
			$wpdb->query($wpdb->prepare("UPDATE $table SET 
			version = %s
			WHERE business_id = $the_version_id;", 
			$the_new_version ));

	
	// Update subtotal if empty with amount values
	$the_id2 = "";
	$subtotal = "";
	$amount = "";
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id > %s", $the_user ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
		{
		$the_id2 = $myrevenuebooks_sql->id;
		$business_id2 = $myrevenuebooks_sql->business_id;
		$subtotal = $myrevenuebooks_sql->subtotal;
		$amount = $myrevenuebooks_sql->amount;
		if ($amount <> "" && $subtotal == "") { $subtotal = $amount;
			$wpdb->query($wpdb->prepare("UPDATE $table SET 
				subtotal = %s
			WHERE business_id = $business_id2 AND id = $the_id2;", 
			$subtotal ));
							}
	
					}
			}
}

// Get New Version Number
$table = $wpdb->prefix . "myrevenuebooks";
$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s AND business_id = %s", $the_user, $the_busid ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $current_version = $myrevenuebooks_sql->version; }