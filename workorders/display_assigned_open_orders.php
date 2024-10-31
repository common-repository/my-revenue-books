
	<!-- add workorder icon and settings -->
	<div id="mrb_workorder_wrapper1">
	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr><td width="2%" align="left"><div class="mrb_workorder_wrapper_text"><span class="dashicons dashicons-hammer"></span></div></td>
	<td width="70%" align="left"><div class="mrb_workorder_wrapper_text">Workorder: Assigned & Open Orders</div></td><td align="right"><i>Workorder file status: Open</i></td></tr>
	</table>
	</div>

<?php
    		//Check column and color settings
    		$table_security = $wpdb->prefix . "myrevenuebooks_security";
    		$security_type_query2 = "dashboard_workorder";
    		$column_number_query2 = 0;
    		$mrb_column_number_check = ""; //default
    		$mrb_col_color2 = "#cecece"; //default
    		$mrb_col_tex_color2 = "#000000"; //default
    		
    		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND column_number = %s", $security_type_query2, $column_number_query2 ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ $mrb_col_color2 = $myrevenuebooks_sql->column_color;
				$mrb_col_tex_color2 = $myrevenuebooks_sql->column_text_color;
						}	
			
			//show results
			?>
			<div id="mrb_wrapper2">
			
			<?php
    		echo "<table align='left' border='0' cellpadding='4' cellspacing='1' width='100%'>";
    		echo "<tr bgcolor='$mrb_col_color2' style='font-weight:bold; color:$mrb_col_tex_color2'>";

    		
    		//Check or add default settings
    		$table_security = $wpdb->prefix . "myrevenuebooks_security";
    		$security_type_query2 = "dashboard_workorder";
    		$column_number_query2 = 0;
    		$mrb_column_number_check = ""; //default
    		$y = 0;
    		
    		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND column_number > %s", $security_type_query2, $column_number_query2 ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ 
				$y++;
				$mrb_column_number_check[$y] = $myrevenuebooks_sql->column_number; 
				$mrb_reminder_column_number[$y] = $myrevenuebooks_sql->column_number; 
				$mrb_reminder_column_name[$y] = $myrevenuebooks_sql->column_name_display; 
				$mrb_reminder_column_setting[$y] = $myrevenuebooks_sql->column_setting;
				
				$mrb_reminder_column_text_lenght[$y] = $myrevenuebooks_sql->column_text_lenght;
				 
					//if settings are found
					echo "<td align='center'>$mrb_reminder_column_name[$y]</td>";
									}
					//if empty, add default values: date, business_name, primary_contact, primary_email, campaign_start, campaign_end, reminder_date_sent, amount
					if ($y == 0) {
						for ($yy = 1; $yy <= 8; $yy++) {
						if ($yy == 1) { $mrb_reminder_column_setting[$yy] = "the_date"; $mrb_reminder_column_name[$yy] = "Date"; $mrb_reminder_column_text_lenght[$yy] = 10; }
						if ($yy == 2) { $mrb_reminder_column_setting[$yy] = "business_name"; $mrb_reminder_column_name[$yy] = "Account"; $mrb_reminder_column_text_lenght[$yy] = 10; }
						if ($yy == 3) { $mrb_reminder_column_setting[$yy] = "workorder_assigned"; $mrb_reminder_column_name[$yy] = "Assigned To"; $mrb_reminder_column_text_lenght[$yy] = 10; }
						if ($yy == 4) { $mrb_reminder_column_setting[$yy] = "workorder_useremail"; $mrb_reminder_column_name[$yy] = "Email"; $mrb_reminder_column_text_lenght[$yy] = 30; }
						if ($yy == 5) { $mrb_reminder_column_setting[$yy] = "workorder_due_date"; $mrb_reminder_column_name[$yy] = "Workorder Due"; $mrb_reminder_column_text_lenght[$yy] = 30; }
						if ($yy == 6) { $mrb_reminder_column_setting[$yy] = "workorder_commission"; $mrb_reminder_column_name[$yy] = "Commission"; $mrb_reminder_column_text_lenght[$yy] = 30; }
						if ($yy == 7) { $mrb_reminder_column_setting[$yy] = "workorder_status"; $mrb_reminder_column_name[$yy] = "Status"; $mrb_reminder_column_text_lenght[$yy] = 10; }
						if ($yy == 8) { $mrb_reminder_column_setting[$yy] = "workorder_file_status"; $mrb_reminder_column_name[$yy] = "File Status"; $mrb_reminder_column_text_lenght[$yy] = 10; }
							echo "<td align='center'>$mrb_reminder_column_name[$yy]</td>";
									} //end add default values
						} //end check for settings
					echo "</tr></font>";

	//$mrb_user_check = $mrb_user_firstname . " " . $mrb_user_lastname;
	$mrb_user_check = $mrb_user_id;
	
	$wrk_assgn = "Not Assigned"; //default
	$check_status = "Workorder"; //default
	$check_wrk_st = "Open";
	$I = 0;
	$bgcolor = "#e1e1e1";
	$trans_amt_pending = 0; //default
	$table = $wpdb->prefix . "myrevenuebooks";
	//if admin workorder access
	if ($security_work_admin == "true") {
		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table  . " WHERE workorder_type = %s AND workorder_file_status = %s ORDER BY id DESC", $check_status, $check_wrk_st ));
	}
	//if user access
	if ($security_work_admin == "false") {
		//$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table  . " WHERE workorder_type = %s AND workorder_file_status = %s AND workorder_userid = %s OR workorder_userid = %s ORDER BY id DESC", $check_status, $check_wrk_st, $mrb_user_id, $wrk_assgn ));
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table  . " WHERE workorder_type = %s AND workorder_file_status = %s AND workorder_userid = %s OR workorder_userid = %s ORDER BY id DESC", $check_status, $check_wrk_st, $mrb_user_check, $wrk_assgn ));
		}
	
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		if($bgcolor=='#ffffff'){$bgcolor='#e1e1e1';}
		else{$bgcolor='#ffffff';}

		$I++;
			//check for past due
			$the_date_check[$I] = date("m/d/Y");
				$the_date_check[$I] = strtotime(str_replace("_", "",$the_date_check[$I]));
				
			$due_date_check[$I] = "01/01/2099";
				$due_date_check1[$I] = $myrevenuebooks_sql->due_date;
				$due_date_check[$I] = strtotime(str_replace("_", "",$due_date_check1[$I]));
				if ($due_date_check[$I] == "") { $due_date_check[$I] = strtotime(str_replace("_", "","01/01/2099")); }

		
			$business_id = $myrevenuebooks_sql->business_id;
			//get the business name
			$the_bus_name = ""; //default
			$business_name = ""; //default
			$table = $wpdb->prefix . "myrevenuebooks";
			$myrevenuebooks_sqlc = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table  . " WHERE business_id = %s AND business_name <> %s", $business_id, $the_bus_name ));
			foreach ( $myrevenuebooks_sqlc as $myrevenuebooks_sqc ) 
			{ $business_name = $myrevenuebooks_sqc->business_name; }
			
			$the_mrbid[$I] = $myrevenuebooks_sql->id;
			$trans_amt_pending = $trans_amt_pending + $myrevenuebooks_sql->amount;
			
			//check for special options
			for ($xx = 1; $xx <= 8; $xx++) {
				
						$mrb_reminder_column_change_1 = "";//default for number search
						$mrb_reminder_column_change_2 = "";//default for number search
						
						$mrb_reminder_column[$xx] = $myrevenuebooks_sql->{$mrb_reminder_column_setting[$xx]};
						
							//check for display amount and add $, num format and color
							if ($mrb_reminder_column_setting[$xx] == "amount" 
										|| $mrb_reminder_column_setting[$xx] == "subtotal" 
										|| $mrb_reminder_column_setting[$xx] == "discount" 
										|| $mrb_reminder_column_setting[$xx] == "shipping" 
										|| $mrb_reminder_column_setting[$xx] == "additional" 
										|| $mrb_reminder_column_setting[$xx] == "fee" 
										|| $mrb_reminder_column_setting[$xx] == "tax" )
							{ $mrb_reminder_column_change_1 = $myrevenuebooks_sql->{$mrb_reminder_column_setting[$xx]};
								$mrb_reminder_column_change_2 = number_format($mrb_reminder_column_change_1, 2, '.', ',');
										if ($mrb_reminder_column_change_2 >= 0) { $font_color1 = '#000000'; }
										if ($mrb_reminder_column_change_2 < 0) { $font_color1 = '#c40000'; }									   
												$mrb_reminder_column[$xx] = "<font color=$font_color1>$" . $mrb_reminder_column_change_2 . "</font>";
														   }
							//check for account name
							if ($mrb_reminder_column_setting[$xx] == "business_name") { $mrb_reminder_column[$xx] = $business_name; };										
							
			//check text lenght and reduce per the custom or default settings
			//if not a number, reduce the character lenght per the setting
			if ($mrb_reminder_column_change_2 == "") {
		
			$mrb_reminder_column_lenght_check[$xx] = $mrb_reminder_column[$xx];
			$mrb_reminder_column_len[$xx] = strlen("$mrb_reminder_column_lenght_check[$xx]");		
			if ($mrb_reminder_column_len[$xx] > $mrb_reminder_column_text_lenght[$xx]) {$mrb_reminder_column[$xx] = substr(strip_tags($mrb_reminder_column_lenght_check[$xx]), 0, $mrb_reminder_column_text_lenght[$xx]) . "...";}
						}
				}//end for xx
				
		echo "<tr bgcolor=$bgcolor>";
			//check for past due and change text color
			$font_color_date = "#000000";
			if ($the_date_check[$I] > $due_date_check[$I]) { $font_color_date = "#934600"; }

		for ($z = 1; $z <= 8; $z++) {
		echo "<td><div class='mrb-dashboard-links'><a href='admin.php?page=my-revenue-books/workorders/edit_transaction.php&id=$the_mrbid[$I]&b_id=$business_id'><font color=$font_color_date>$mrb_reminder_column[$z]</a></font></div></td>";
							}
				echo "</tr>";		
		}

	//if security is enabled and security access is true, display the pending amount total.  If not. dont display.  If security is disabled then display.
	if ($I>0 && $the_security_option == "Enabled" && $security_security_access == "true" || $the_security_option == "Disabled" && $I>0) 
			{   //echo "<tr><td colspan='8' align='left'><font color='#934600'><i>* These invoices are past due</i></font></td></tr>";
				//echo "<tr><td colspan='8' align='right'><b>Total: $" . number_format($trans_amt_pending, 2, '.', ',') . "</b></td></tr>"; 
				}
	if ($I==0) { echo "<tr><td colspan='8'>No Workorders</td></tr></table>"; }
	echo "</table>";
// } // end security_access check
///////////////////// End Display Pending /////////////////////
?>
</div>
	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr><td height="20px">&nbsp;</td></tr></table>