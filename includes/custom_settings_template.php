<?php
////////////////////////// Custom settings start //////////////////////////
	
	//execute if submitted
	if (!empty($_POST[$mrb_cust_set.'_submit_mrb_display_options'])) {

	for ($xx = 1; $xx <= 8; $xx++) {

					$column_text_lenght_['mrb_cust_set'][$xx] = stripslashes( $_POST[$mrb_cust_set.'_column_text_lenght'.$xx ] );
					if ( ! $column_text_lenght_['mrb_cust_set'][$xx] ) { $column_text_lenght_['mrb_cust_set'][$xx] = '30'; }
					if ( strlen( $column_text_lenght_['mrb_cust_set'][$xx] ) > 10 ) { $column_text_lenght_['mrb_cust_set'][$xx] = substr( $column_text_lenght_['mrb_cust_set'][$xx], 0, 10 ); }				
		
	//santitize values
	$display_options_['mrb_cust_set'][$xx] = stripslashes( $_POST[$mrb_cust_set.'_mrb_reminder_display_options'.$xx ] );
	if ( ! $display_options_['mrb_cust_set'][$xx] ) { $display_options_['mrb_cust_set'][$xx] = ''; }
	if ( strlen( $display_options_['mrb_cust_set'][$xx] ) > 100 ) { $display_options_['mrb_cust_set'][$xx] = substr( $display_options_['mrb_cust_set'][$xx], 0, 100 ); }
					
		//column names
		if ($display_options_['mrb_cust_set'][$xx] == "the_date") { $column_name_display_['mrb_cust_set'][$xx] = "Date"; }
		if ($display_options_['mrb_cust_set'][$xx] == "due_date") { $column_name_display_['mrb_cust_set'][$xx] = "Due Date"; }
		if ($display_options_['mrb_cust_set'][$xx] == "business_name") { $column_name_display_['mrb_cust_set'][$xx] = "Account"; }
		if ($display_options_['mrb_cust_set'][$xx] == "campain_start") { $column_name_display_['mrb_cust_set'][$xx] = "Start"; }
		if ($display_options_['mrb_cust_set'][$xx] == "campain_end") { $column_name_display_['mrb_cust_set'][$xx] = "End"; }
		if ($display_options_['mrb_cust_set'][$xx] == "duration") { $column_name_display_['mrb_cust_set'][$xx] = "Duration"; }
		if ($display_options_['mrb_cust_set'][$xx] == "description") { $column_name_display_['mrb_cust_set'][$xx] = "Description"; }
		if ($display_options_['mrb_cust_set'][$xx] == "reminder") { $column_name_display_['mrb_cust_set'][$xx] = "Reminder"; }
		if ($display_options_['mrb_cust_set'][$xx] == "reminder_date") { $column_name_display_['mrb_cust_set'][$xx] = "Reminder Date"; }
		if ($display_options_['mrb_cust_set'][$xx] == "reminder_sent") { $column_name_display_['mrb_cust_set'][$xx] = "Reminder Sent"; }
		if ($display_options_['mrb_cust_set'][$xx] == "reminder_date_sent") { $column_name_display_['mrb_cust_set'][$xx] = "Reminder Date Sent"; }
		if ($display_options_['mrb_cust_set'][$xx] == "primary_contact") { $column_name_display_['mrb_cust_set'][$xx] = "Primary Contact"; }
		if ($display_options_['mrb_cust_set'][$xx] == "primary_email") { $column_name_display_['mrb_cust_set'][$xx] = "Primary Email"; }
		if ($display_options_['mrb_cust_set'][$xx] == "secondary_contact") { $column_name_display_['mrb_cust_set'][$xx] = "Secondary Contact"; }
		if ($display_options_['mrb_cust_set'][$xx] == "secondary_email") { $column_name_display_['mrb_cust_set'][$xx] = "Secondary Email"; }
		if ($display_options_['mrb_cust_set'][$xx] == "po_ref") { $column_name_display_['mrb_cust_set'][$xx] = "PO#"; }
		if ($display_options_['mrb_cust_set'][$xx] == "the_ref") { $column_name_display_['mrb_cust_set'][$xx] = "Ref#"; }
		if ($display_options_['mrb_cust_set'][$xx] == "subtotal") { $column_name_display_['mrb_cust_set'][$xx] = "Subtotal"; }
		if ($display_options_['mrb_cust_set'][$xx] == "discount") { $column_name_display_['mrb_cust_set'][$xx] = "Discount"; }
		if ($display_options_['mrb_cust_set'][$xx] == "shipping") { $column_name_display_['mrb_cust_set'][$xx] = "Shipping"; }
		if ($display_options_['mrb_cust_set'][$xx] == "additional") { $column_name_display_['mrb_cust_set'][$xx] = "Addl Fee"; }
		if ($display_options_['mrb_cust_set'][$xx] == "fee") { $column_name_display_['mrb_cust_set'][$xx] = "Fee"; }
		if ($display_options_['mrb_cust_set'][$xx] == "tax") { $column_name_display_['mrb_cust_set'][$xx] = "Tax"; }
		if ($display_options_['mrb_cust_set'][$xx] == "amount") { $column_name_display_['mrb_cust_set'][$xx] = "Total"; }
		if ($display_options_['mrb_cust_set'][$xx] == "payment_type") { $column_name_display_['mrb_cust_set'][$xx] = "Payment Type"; }
		if ($display_options_['mrb_cust_set'][$xx] == "payment_details") { $column_name_display_['mrb_cust_set'][$xx] = "Payment Details"; }
		if ($display_options_['mrb_cust_set'][$xx] == "status") { $column_name_display_['mrb_cust_set'][$xx] = "Status"; }

		//acounts: $business_name, $trans_count, $trans_date, $trans_amount_pending, $trans_amount, view, edit, delete
		if ($display_options_['mrb_cust_set'][$xx] == "trans_count") { $column_name_display_['mrb_cust_set'][$xx] = "#Transactions"; }
		if ($display_options_['mrb_cust_set'][$xx] == "trans_date") { $column_name_display_['mrb_cust_set'][$xx] = "Last Transaction"; }
		if ($display_options_['mrb_cust_set'][$xx] == "trans_amount_pending") { $column_name_display_['mrb_cust_set'][$xx] = "Pending"; }
		if ($display_options_['mrb_cust_set'][$xx] == "trans_amount") { $column_name_display_['mrb_cust_set'][$xx] = "Total"; }
		if ($display_options_['mrb_cust_set'][$xx] == "trans_view") { $column_name_display_['mrb_cust_set'][$xx] = "View"; }
		if ($display_options_['mrb_cust_set'][$xx] == "trans_edit") { $column_name_display_['mrb_cust_set'][$xx] = "Edit"; }
		if ($display_options_['mrb_cust_set'][$xx] == "trans_delete") { $column_name_display_['mrb_cust_set'][$xx] = "Delete"; }
		
		//workorders
		if ($display_options_['mrb_cust_set'][$xx] == "workorder_details") { $column_name_display_['mrb_cust_set'][$xx] = "Details"; }
		if ($display_options_['mrb_cust_set'][$xx] == "workorder_assigned") { $column_name_display_['mrb_cust_set'][$xx] = "Assigned To"; }
		if ($display_options_['mrb_cust_set'][$xx] == "workorder_useremail") { $column_name_display_['mrb_cust_set'][$xx] = "Email"; }
		if ($display_options_['mrb_cust_set'][$xx] == "workorder_total") { $column_name_display_['mrb_cust_set'][$xx] = "Total"; }
		if ($display_options_['mrb_cust_set'][$xx] == "workorder_commission") { $column_name_display_['mrb_cust_set'][$xx] = "Commission"; }
		if ($display_options_['mrb_cust_set'][$xx] == "workorder_status") { $column_name_display_['mrb_cust_set'][$xx] = "Workorder Status"; }
		if ($display_options_['mrb_cust_set'][$xx] == "workorder_due_date") { $column_name_display_['mrb_cust_set'][$xx] = "Workorder Due"; }
		if ($display_options_['mrb_cust_set'][$xx] == "workorder_payment_date") { $column_name_display_['mrb_cust_set'][$xx] = "Payment Date"; }
		if ($display_options_['mrb_cust_set'][$xx] == "workorder_file_status") { $column_name_display_['mrb_cust_set'][$xx] = "File Status"; }
		
		
		$wpdb->query($wpdb->prepare("UPDATE $table_custom SET 
		column_number = %s,
		column_name_display = %s,
		column_setting = %s,
		column_text_lenght = %s
		WHERE security_type = '$security_type_default_[mrb_cust_set]' AND column_number = $xx;", 
		$xx,
		$column_name_display_['mrb_cust_set'][$xx],
		$display_options_['mrb_cust_set'][$xx],
		$column_text_lenght_['mrb_cust_set'][$xx]
			));
		}
				//set column color
				$column_color_query_['mrb_cust_set'] = stripslashes( $_POST[$mrb_cust_set.'_tfavcolor'] );
				if ( ! $column_color_query_['mrb_cust_set'] ) { $column_color_query_['mrb_cust_set'] = '#cecece'; }
				if ( strlen( $column_color_query_['mrb_cust_set'] ) > 100 ) { $column_color_query_['mrb_cust_set'] = substr( $column_color_query_['mrb_cust_set'], 0, 100 ); }			
				
				//set column textcolor
				$column_text_color_query_['mrb_cust_set'] = stripslashes( $_POST[$mrb_cust_set."_favtextcolor"] );
				if ( ! $column_text_color_query_['mrb_cust_set'] ) { $column_text_color_query_['mrb_cust_set'] = '#000000'; }
				if ( strlen( $column_text_color_query_['mrb_cust_set'] ) > 100 ) { $column_text_color_query_['mrb_cust_set'] = substr( $column_text_color_query_['mrb_cust_set'], 0, 100 ); }
	
		$wpdb->query($wpdb->prepare("UPDATE $table_custom SET 
		column_color = %s,
		column_text_color = %s
		WHERE security_type = '$security_type_default_[mrb_cust_set]' AND column_number = 0;", 
		$column_color_query_['mrb_cust_set'],
		$column_text_color_query_['mrb_cust_set']
			));
}

    		//Check or add default settings
    		$security_type_query_['mrb_cust_set'] = $security_type_default_['mrb_cust_set'];
    		$column_number_query_['mrb_cust_set'] = "";
    		$mrb_column_number_check = ""; //default
    		
    		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_custom . " WHERE security_type = %s AND column_number <> %s", $security_type_query_['mrb_cust_set'], $column_number_query_['mrb_cust_set'] ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ $mrb_column_number_check = $myrevenuebooks_sql->column_number; }

				//if empty, add default values: Reminders: date, business_name, primary_contact, primary_email, campaign_start, campaign_end, reminder_date_sent, amount
				if ($mrb_column_number_check == "" && $security_type_query_['mrb_cust_set'] == "dashboard_reminder") {
				
				for ($ii = 0; $ii <= 8; $ii++) {
				$default_security_type_['mrb_cust_set'] = $security_type_default_['mrb_cust_set'];
				$default_column_text_lenght = "30";
				$default_column_color = ""; 
				$default_column_text_color = ""; 
				$default_column1 = $ii;
					if ($ii == 0) { $default_column1_setting = ""; $default_column_name_display = ""; $default_column_color = "#cecece"; $default_column_text_color = "#000000"; $default_column_text_lenght = 30; }
					if ($ii == 1) { $default_column1_setting = "the_date"; $default_column_name_display = "Date"; }
					if ($ii == 2) { $default_column1_setting = "business_name"; $default_column_name_display = "Account"; }
					if ($ii == 3) { $default_column1_setting = "primary_contact"; $default_column_name_display = "Primary Contact"; }
					if ($ii == 4) { $default_column1_setting = "primary_email"; $default_column_name_display = "Primary Email"; }
					if ($ii == 5) { $default_column1_setting = "campain_start"; $default_column_name_display = "Start"; }
					if ($ii == 6) { $default_column1_setting = "campain_end"; $default_column_name_display = "End"; }
					if ($ii == 7) { $default_column1_setting = "reminder_date_sent"; $default_column_name_display = "Reminder Date Sent"; }
					if ($ii == 8) { $default_column1_setting = "amount"; $default_column_name_display = "Total"; }
				
				$wpdb->query( $wpdb->prepare( "INSERT INTO " . $table_custom . " (
				security_type,
				column_number,
				column_name_display,
				column_setting,
				column_color,
				column_text_color,
				column_text_lenght
								)
						VALUES ( %s,%s,%s,%s,%s,%s,%s )",
				$default_security_type_['mrb_cust_set'],
				$default_column1,
				$default_column_name_display,
				$default_column1_setting,
				$default_column_color,
				$default_column_text_color,
				$default_column_text_lenght
					));
				}
			}//end if reminder or pending
			
				
				//set account column defaults
				//if empty, add default values: Pending: date, business_name, primary_contact, primary_email, campaign_start, campaign_end, reminder_date_sent, amount
				if ($mrb_column_number_check == "" && $security_type_query_['mrb_cust_set'] == "dashboard_pending") {
				
				for ($ii = 0; $ii <= 8; $ii++) {
				$default_security_type_['mrb_cust_set'] = $security_type_default_['mrb_cust_set'];
				$default_column_text_lenght = "30";
				$default_column_color = ""; 
				$default_column_text_color = ""; 
				$default_column1 = $ii;
					if ($ii == 0) { $default_column1_setting = ""; $default_column_name_display = ""; $default_column_color = "#cecece"; $default_column_text_color = "#000000"; $default_column_text_lenght = 30; }
					if ($ii == 1) { $default_column1_setting = "the_date"; $default_column_name_display = "Date"; }
					if ($ii == 2) { $default_column1_setting = "business_name"; $default_column_name_display = "Account"; }
					if ($ii == 3) { $default_column1_setting = "primary_contact"; $default_column_name_display = "Primary Contact"; }
					if ($ii == 4) { $default_column1_setting = "primary_email"; $default_column_name_display = "Primary Email"; }
					if ($ii == 5) { $default_column1_setting = "campain_start"; $default_column_name_display = "Start"; }
					if ($ii == 6) { $default_column1_setting = "campain_end"; $default_column_name_display = "End"; }
					if ($ii == 7) { $default_column1_setting = "reminder_date_sent"; $default_column_name_display = "Reminder Date Sent"; }
					if ($ii == 8) { $default_column1_setting = "amount"; $default_column_name_display = "Total"; }
				
				$wpdb->query( $wpdb->prepare( "INSERT INTO " . $table_custom . " (
				security_type,
				column_number,
				column_name_display,
				column_setting,
				column_color,
				column_text_color,
				column_text_lenght
								)
						VALUES ( %s,%s,%s,%s,%s,%s,%s )",
				$default_security_type_['mrb_cust_set'],
				$default_column1,
				$default_column_name_display,
				$default_column1_setting,
				$default_column_color,
				$default_column_text_color,
				$default_column_text_lenght
					));
				}
			}//end if pending
			
			
			
			
			//set account column defaults
			//if empty, add default values: Accounts: business_name, $trans_count, $trans_date, $trans_amount_pending, $trans_amount, view, edit, delete
			if ($mrb_column_number_check == "" && $security_type_query_['mrb_cust_set'] == "dashboard_accounts") {
							for ($ii = 0; $ii <= 8; $ii++) {
				$default_security_type_['mrb_cust_set'] = $security_type_default_['mrb_cust_set'];
				$default_column_text_lenght = "30";
				$default_column_color = ""; 
				$default_column_text_color = ""; 
				$default_column1 = $ii;
					if ($ii == 0) { $default_column1_setting = ""; $default_column_name_display = ""; $default_column_color = "#cecece"; $default_column_text_color = "#000000"; $default_column_text_lenght = 30; }
					if ($ii == 1) { $default_column1_setting = "business_name"; $default_column_name_display = "Account"; }
					if ($ii == 2) { $default_column1_setting = "trans_count"; $default_column_name_display = "#Transactions"; }
					if ($ii == 3) { $default_column1_setting = "trans_date"; $default_column_name_display = "Last Transaction"; }
					if ($ii == 4) { $default_column1_setting = "trans_amount_pending"; $default_column_name_display = "Pending"; }
					if ($ii == 5) { $default_column1_setting = "trans_amount"; $default_column_name_display = "Total"; }
					if ($ii == 6) { $default_column1_setting = "trans_view"; $default_column_name_display = "View"; }
					if ($ii == 7) { $default_column1_setting = "trans_edit"; $default_column_name_display = "Edit"; }
					if ($ii == 8) { $default_column1_setting = "trans_delete"; $default_column_name_display = "Delete"; }
				
				$wpdb->query( $wpdb->prepare( "INSERT INTO " . $table_custom . " (
				security_type,
				column_number,
				column_name_display,
				column_setting,
				column_color,
				column_text_color,
				column_text_lenght
								)
						VALUES ( %s,%s,%s,%s,%s,%s,%s )",
				$default_security_type_['mrb_cust_set'],
				$default_column1,
				$default_column_name_display,
				$default_column1_setting,
				$default_column_color,
				$default_column_text_color,
				$default_column_text_lenght
					));
				}
			
					}//end if accounts
			

			//set account column defaults
    		//if empty, add default values: Workorders
    		$security_type_query_['mrb_cust_set'] = $security_type_default_['mrb_cust_set'];
    		$column_number_query_['mrb_cust_set'] = "";
    		$mrb_column_number_check = ""; //default
    		
    		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_custom . " WHERE security_type = %s AND column_number <> %s", $security_type_query_['mrb_cust_set'], $column_number_query_['mrb_cust_set'] ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ $mrb_column_number_check = $myrevenuebooks_sql->column_number; }

				//if empty, add default values: Reminders: date, business_name, primary_contact, primary_email, campaign_start, campaign_end, reminder_date_sent, amount
				if ($mrb_column_number_check == "" && $security_type_query_['mrb_cust_set'] == "dashboard_workorder") {
				
				for ($ii = 0; $ii <= 8; $ii++) {
				$default_security_type_['mrb_cust_set'] = $security_type_default_['mrb_cust_set'];
				$default_column_text_lenght = "30";
				$default_column_color = ""; 
				$default_column_text_color = ""; 
				$default_column1 = $ii;
					if ($ii == 0) { $default_column1_setting = ""; $default_column_name_display = ""; $default_column_color = "#cecece"; $default_column_text_color = "#000000"; $default_column_text_lenght = 30; }
					if ($ii == 1) { $default_column1_setting = "the_date"; $default_column_name_display = "Date"; }
					if ($ii == 2) { $default_column1_setting = "business_name"; $default_column_name_display = "Account"; }
					if ($ii == 3) { $default_column1_setting = "workorder_assigned"; $default_column_name_display = "Assigned To"; }
					if ($ii == 4) { $default_column1_setting = "workorder_commission"; $default_column_name_display = "Commission"; }
					if ($ii == 5) { $default_column1_setting = "workorder_due_date"; $default_column_name_display = "Workorder Due"; }
					if ($ii == 6) { $default_column1_setting = "workorder_status"; $default_column_name_display = "Workorder Status"; }
					if ($ii == 7) { $default_column1_setting = "workorder_payment_date"; $default_column_name_display = "Payment Date"; }
					if ($ii == 8) { $default_column1_setting = "workorder_file_status"; $default_column_name_display = "File Status"; }
				
				$wpdb->query( $wpdb->prepare( "INSERT INTO " . $table_custom . " (
				security_type,
				column_number,
				column_name_display,
				column_setting,
				column_color,
				column_text_color,
				column_text_lenght
								)
						VALUES ( %s,%s,%s,%s,%s,%s,%s )",
				$default_security_type_['mrb_cust_set'],
				$default_column1,
				$default_column_name_display,
				$default_column1_setting,
				$default_column_color,
				$default_column_text_color,
				$default_column_text_lenght
					));
				}
			}//end if workorder



			
			
			
			//get column colors
			$mrb_column_color_['mrb_cust_set'] = "#cecece";
			$security_type_query3 = $security_type_default_['mrb_cust_set'];
			$column_number_query3 = 0;
    		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_custom . " WHERE security_type = %s AND column_number = %s", $security_type_query3, $column_number_query3 ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ 
			  $mrb_column_color_['mrb_cust_set'] = $myrevenuebooks_sql->column_color;
			  $mrb_column_text_color_['mrb_cust_set'] = $myrevenuebooks_sql->column_text_color;
			  }	
			
			//display current settings
			$security_type_query2 = $security_type_default_['mrb_cust_set'];
			$column_number_query2 = 0;
			$r=1;
    		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_custom . " WHERE security_type = %s AND column_number > %s", $security_type_query2, $column_number_query2 ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ 
					//if values are found
					$mrb_column_number[$r] = $myrevenuebooks_sql->column_number;
					$mrb_column_name_display[$r] = $myrevenuebooks_sql->column_name_display;
					$mrb_column_setting[$r] = $myrevenuebooks_sql->column_setting;
					$mrb_column_text_lenght[$r] = $myrevenuebooks_sql->column_text_lenght;
		
			//start display of the current settings
			if ($r == 1) { 
				echo "<table align='left' border='0' cellpadding='4' cellspacing='2' width='99.6%'>
				<tr bgcolor='$bgcolor'><td colspan='8'>$mrb_dashicon_setting <b>$mrb_setting_title</b></td></tr>
				<tr bgcolor='$mrb_column_color_[mrb_cust_set]' style='font-size:10px; font-weight:bold; color:$mrb_column_text_color_[mrb_cust_set]'>";
									}
				echo "<td align='center' width='12%' bgcolor='$mrb_column_color_[mrb_cust_set]' style='color:$mrb_column_text_color_[mrb_cust_set]'>$mrb_column_name_display[$r]</td>";
					$r++;
				}
				echo "</font></tr></table>";
?>


<!-- settings -->
<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%" bordercolor="#ff0000" id="r1">
<form name="<?php echo $mrb_cust_set; ?>add-mrb-display-options" method="post">
<tr bgcolor='<?php echo $bgcolor; ?>'><td>

<?php $mrb_column_action = ""; // default ?>

<?php for ($s = 1; $s <= 8; $s++) {
	if ($security_type_query_['mrb_cust_set'] == "dashboard_accounts") { $mrb_column_action = "disabled";} ?>
	<table align="left" border="1" cellpadding="2" cellspacing="2" width="12%" bordercolor="#cfcfcf">
	<tr><td align="center">
	Column <?php echo $s; ?><br>
	
	<?php if ($security_type_query_['mrb_cust_set'] == "dashboard_accounts") { ?>
			<select name="<?php echo $mrb_cust_set; ?>_mrb_reminder_display_options<?php echo $s;?>" value="" style="width:110px; font-size:10px;">
			<option value="<?php echo $mrb_column_setting[$s]; ?>" class="mrb-options-text"><?php echo $mrb_column_name_display[$s]; ?></option>
			</select><br>
		Max Text Lenght: <input type="text" name="<?php echo $mrb_cust_set; ?>_column_text_lenght<?php echo $s; ?>" value="<?php echo $mrb_column_text_lenght[$s]; ?>" size="3" maxlength="3" class="mrb-options-text" readonly>
					<br><p style="font-size:8px">(Note only limits text options)</p></td></tr>
				<?php } ?>
	
	<?php if ($security_type_query_['mrb_cust_set'] <> "dashboard_accounts") { ?>
	<select name="<?php echo $mrb_cust_set; ?>_mrb_reminder_display_options<?php echo $s;?>" value="" style="width:110px; font-size:10px;">
	<option value="<?php echo $mrb_column_setting[$s]; ?>" class="mrb-options-text"><?php echo $mrb_column_name_display[$s]; ?></option>	
	<option value="the_date" class="mrb-options-text">Date</option>
	<option value="due_date" class="mrb-options-text">Due Date</option>
	<option value="business_name" class="mrb-options-text">Account</option>
	<option value="campain_start" class="mrb-options-text">Start</option>
	<option value="campain_end" class="mrb-options-text">End</option>
	<option value="duration" class="mrb-options-text">Duration</option>
	<option value="description" class="mrb-options-text">Description</option>
	<option value="reminder" class="mrb-options-text">Set Reminder(Y/N)</option>
	<option value="reminder_date" class="mrb-options-text">Reminder Date</option>
	<option value="reminder_sent" class="mrb-options-text">Reminder Sent(Y/N)</option>
	<option value="reminder_date_sent" class="mrb-options-text">Reminder Sent Date</option>
	<option value="primary_contact" class="mrb-options-text">Primary Contact</option>
	<option value="primary_email" class="mrb-options-text">Primary Email</option>
	<option value="secondary_contact" class="mrb-options-text">Secondary Contact</option>
	<option value="secondary_email" class="mrb-options-text">Secondary Email</option>
	<option value="po_ref" class="mrb-options-text">PO#</option>
	<option value="the_ref" class="mrb-options-text">Ref#</option>
	<option value="subtotal" class="mrb-options-text">Subtotal</option>
	<option value="discount" class="mrb-options-text">Discount</option>
	<option value="shipping" class="mrb-options-text">Shipping</option>
	<option value="additional" class="mrb-options-text">Addl Fee</option>
	<option value="fee" class="mrb-options-text">Fee</option>
	<option value="tax" class="mrb-options-text">Tax</option>
	<option value="amount" class="mrb-options-text">Total</option>
	<option value="payment_type" class="mrb-options-text">Payment Type</option>
	<option value="payment_details" class="mrb-options-text">Payment Details</option>
	<option value="status" class="mrb-options-text">Status</option>
	
	<?php if ($security_type_query_['mrb_cust_set'] == "dashboard_workorder") { ?>
	<option value="workorder_details" class="mrb-options-text">Details</option>
	<option value="workorder_assigned" class="mrb-options-text">Assigned To</option>
	<option value="workorder_useremail" class="mrb-options-text">Email</option>
	<option value="workorder_commission" class="mrb-options-text">Commission</option>
	<option value="workorder_status" class="mrb-options-text">Workorder Status</option>
	<option value="workorder_due_date" class="mrb-options-text">Workorder Due</option>
	<option value="workorder_payment_date" class="mrb-options-text">Payment Date</option>
	<option value="workorder_file_status" class="mrb-options-text">File Status</option>
	<?php } ?>
	
	
	</select><br>
		Max Text Lenght: <input type="text" name="<?php echo $mrb_cust_set; ?>_column_text_lenght<?php echo $s; ?>" value="<?php echo $mrb_column_text_lenght[$s]; ?>" size="3" maxlength="3" class="mrb-options-text">
	<br><p style="font-size:8px">(Note only limits text options)</p></td></tr>
	<?php } 
	} ?>
	</table>
</td></tr>
</table>

	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
	
		<tr bgcolor='<?php echo $bgcolor; ?>'>
		<td align="right"><span class="dashicons dashicons-color-picker"></span> <label for="<?php echo $mrb_cust_set; ?>_tfavcolor">Select Header Background Color:</label></td>
		<td><input type="color" id="<?php echo $mrb_cust_set; ?>_tfavcolor" name="<?php echo $mrb_cust_set; ?>_tfavcolor"  value="<?php echo $mrb_column_color_['mrb_cust_set']; ?>"></td>
		
		<td align="right"><span class="dashicons dashicons-color-picker"></span> <label for="<?php echo $mrb_cust_set; ?>_favtextcolor">Select Header Text Color: </label></td>
		<td><input type="color" id="<?php echo $mrb_cust_set; ?>_favtextcolor" name="<?php echo $mrb_cust_set; ?>_favtextcolor"  value="<?php echo $mrb_column_text_color_['mrb_cust_set']; ?>"></td>
		
		<td align="right" width="50%"><input type="submit" name="<?php echo $mrb_cust_set; ?>_submit_mrb_display_options" class="button-primary" value="Submit Changes" action=""></td></tr>
</form>
<tr><td>&nbsp;</td></tr>
</table>

<?php
////////////////////////// End custom settings //////////////////////////

?>