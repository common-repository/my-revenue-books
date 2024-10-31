<?php
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Dashboard";


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



<?php
	//user not valid notice
	if ($the_security_option == "Enabled" && $mrb_current_user_id == 0) {
		echo $default_security_message . "<br>"; }
	?>

<?php
	//if a valid user is found
	if ($the_security_option == "Enabled" && $mrb_current_user_id > 0 || $the_security_option == "Disabled") { 	

	
	//if the user does not have access to pending, reminder and accounts
	if ($the_security_option == "Enabled" && $security_accounts_access == "false" && $security_reminder_access == "false" && $security_pending_access == "false") { ?>
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td align="middle"><h3><?php echo $default_security_message; ?></h3></td></tr>
	<tr><td align="middle"><b>Contact your administrator or check the <a href="admin.php?page=my-revenue-books/myrevenuebooks_security.php">security & privacy</a> settings to enable access.</b></td></tr>
	<tr><td>&nbsp;</td></tr>
	</table>
<?php
}


///////////////////// Display Reminders /////////////////////
					
	// if security is enabled and reminder access is true, display.  If not. dont display.  If security is disabled then display.
	if ($the_security_option == "Enabled" && $security_reminder_access == "true" || $the_security_option == "Disabled") {
	
	//start reminder display
	$date1 = date("m/d/Y");
	$the_current_date = strtotime(str_replace("_", "",$date1));

	//Check for a cron reminder schedule
	$cron_interval2 = ""; //default
	$the_main_id = 1;
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table  . " WHERE id = %s AND cron_interval <> %s", $the_main_id, $cron_interval2 ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
		{
			$cron_interval2 = $myrevenuebooks_sql->cron_interval;
			}
			$next_cron_schedule2 = wp_next_scheduled( 'myrevenuebooks_cronjob' );
			if ($next_cron_schedule2 == "") {$next_reminder = "";}
			else
			$next_reminder = "Next reminder at " . date('M d Y H:i:s',$next_cron_schedule2);
?>
	
	<!-- add reminder icon and reminder settings -->
	<div id="mrb_wrapper">
	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr><td width="2%" align="left"><div class="mrb_wrapper_text"><span class="dashicons dashicons-calendar"></span></div></td>
	<td width="10%" align="left"><div class="mrb_wrapper_text"><?php echo "Reminders"; ?></div></td>
	<td><div class="mrb_reminder">&nbsp;<a href='admin.php?page=my-revenue-books/myrevenuebooks_settings.php'><?php echo "[" . $cron_interval2 . "]"; ?></a>
		 <?php echo "&nbsp;" . $next_reminder; ?></div></td>
		 <td align="right"><a href='admin.php?page=my-revenue-books/myrevenuebooks_settings.php#r1' style='text-decoration: none'><span class="dashicons dashicons-admin-generic"></span></a></td></tr>
	</table>
	</div>

<div id="mrb_wrapper2">
<?php
    		//Check column and color settings
    		$table_security = $wpdb->prefix . "myrevenuebooks_security";
    		$security_type_query1 = "dashboard_reminder";
    		$column_number_query1 = 0;
    		$mrb_column_number_check = ""; //default
    		$mrb_col_color = "#cecece"; //default
    		$mrb_col_tex_color = "#000000"; //default
    		
    		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND column_number = %s", $security_type_query1, $column_number_query1 ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ $mrb_col_color = $myrevenuebooks_sql->column_color;
				$mrb_col_tex_color = $myrevenuebooks_sql->column_text_color;
						}	
			//show results
    		echo "<table align='left' border='0' cellpadding='4' cellspacing='1' width='100%'>";
    		echo "<tr bgcolor='$mrb_col_color' style='font-weight:bold; color:$mrb_col_tex_color'>";
    		
    		
    		//Check or add default reminder settings
    		$table_security = $wpdb->prefix . "myrevenuebooks_security";
    		$security_type_query1 = "dashboard_reminder";
    		$column_number_query1 = 0;
    		$mrb_column_number_check = ""; //default
    		$y = 0;
    		
    		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND column_number > %s", $security_type_query1, $column_number_query1 ));
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
						if ($yy == 2) { $mrb_reminder_column_setting[$yy] = "business_name"; $mrb_reminder_column_name[$yy] = "Account"; $mrb_reminder_column_text_lenght[$yy] = 30; }
						if ($yy == 3) { $mrb_reminder_column_setting[$yy] = "primary_contact"; $mrb_reminder_column_name[$yy] = "Primary Contact"; $mrb_reminder_column_text_lenght[$yy] = 30; }
						if ($yy == 4) { $mrb_reminder_column_setting[$yy] = "primary_email"; $mrb_reminder_column_name[$yy] = "Primary Email"; $mrb_reminder_column_text_lenght[$yy] = 30; }
						if ($yy == 5) { $mrb_reminder_column_setting[$yy] = "campain_start"; $mrb_reminder_column_name[$yy] = "Start"; $mrb_reminder_column_text_lenght[$yy] = 10; }
						if ($yy == 6) { $mrb_reminder_column_setting[$yy] = "campain_end"; $mrb_reminder_column_name[$yy] = "End"; $mrb_reminder_column_text_lenght[$yy] = 10; }
						if ($yy == 7) { $mrb_reminder_column_setting[$yy] = "reminder_date_sent"; $mrb_reminder_column_name[$yy] = "Reminder Date Sent"; $mrb_reminder_column_text_lenght[$yy] = 10; }
						if ($yy == 8) { $mrb_reminder_column_setting[$yy] = "amount"; $mrb_reminder_column_name[$yy] = "Total"; $mrb_reminder_column_text_lenght[$yy] = 10; }
							echo "<td align='center'>$mrb_reminder_column_name[$yy]</td>";
									} //end add default values
						} //end check for settings
					echo "</tr></font>";
	
	// get the invoices with a reminder set to yes
	$the_reminder = "Yes"; //reminder set to Yes
	$bgcolor = "#e1e1e1";
	$ri = 0;
	$I = 0;
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table  . " WHERE reminder = %s ORDER BY id DESC, the_date2", $the_reminder ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		$ri++;
		$the_r_date[$ri] = $myrevenuebooks_sql->reminder_date;
		$the_r_date1[$ri] = strtotime(str_replace("_", "",$the_r_date[$ri]));
		if ($the_r_date1[$ri]<=$the_current_date) {

		if($bgcolor=='#ffffff'){$bgcolor='#e1e1e1';}
		else{$bgcolor='#ffffff';}
		$I++;
			$business_id[$I] = $myrevenuebooks_sql->business_id;
			//get the business name
			$the_bus_name = ""; //default
			$business_name = ""; //default
			$table = $wpdb->prefix . "myrevenuebooks";
			$myrevenuebooks_sqlc = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table  . " WHERE business_id = %s AND business_name <> %s", $business_id[$I], $the_bus_name ));
			foreach ( $myrevenuebooks_sqlc as $myrevenuebooks_sqc ) 
			{ $business_name = $myrevenuebooks_sqc->business_name; }
			
			$the_id[$I] = $myrevenuebooks_sql->id;
			
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
		for ($z = 1; $z <= 8; $z++) {
			echo "<td><div class='mrb-dashboard-links'><a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_transaction.php&id=$the_id[$I]&b_id=$business_id[$I]'>$mrb_reminder_column[$z]</a></div></td>";
							}
				echo "</tr>";		
		}
	}
	if ($I>=1) { echo "<tr><td colspan='8' align='right'><font size='1'><i>*Edit the transaction and set the reminder to <b><u>No</b></u> to remove it from this list.</font></i></td></tr>"; }
	if ($I==0) { echo "<tr><td colspan='8'>No reminders</td></tr>"; }
	echo "</table>";
} // end security_reminder_access check
///////////////////// End Display Reminders /////////////////////
?>
</div>




<?php
///////////////////// Display Pending /////////////////////

	// if security is enabled and access is true, display.  If not. dont display.  If security is disabled then display.
	if ($the_security_option == "Enabled" && $security_pending_access == "true" || $the_security_option == "Disabled") { ?>

	<!-- add pending icon and settings -->
	<div id="mrb_wrapper">
	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr><td width="2%" align="left"><div class="mrb_wrapper_text"><span class="dashicons dashicons-sticky"></span></div></td>
	<td width="25%" align="left"><div class="mrb_wrapper_text"><?php echo "Pending Transactions"; ?></div></td>
		 <td align="right"><a href='admin.php?page=my-revenue-books/myrevenuebooks_settings.php#r1' style='text-decoration: none'><span class="dashicons dashicons-admin-generic"></span></a></td></tr>
	</table>
	</div>

<?php
    		//Check column and color settings
    		$table_security = $wpdb->prefix . "myrevenuebooks_security";
    		$security_type_query2 = "dashboard_pending";
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
    		$security_type_query2 = "dashboard_pending";
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
						if ($yy == 2) { $mrb_reminder_column_setting[$yy] = "po_ref"; $mrb_reminder_column_name[$yy] = "PO"; $mrb_reminder_column_text_lenght[$yy] = 10; }
						if ($yy == 3) { $mrb_reminder_column_setting[$yy] = "the_ref"; $mrb_reminder_column_name[$yy] = "Ref"; $mrb_reminder_column_text_lenght[$yy] = 10; }
						if ($yy == 4) { $mrb_reminder_column_setting[$yy] = "business_name"; $mrb_reminder_column_name[$yy] = "Account"; $mrb_reminder_column_text_lenght[$yy] = 30; }
						if ($yy == 5) { $mrb_reminder_column_setting[$yy] = "primary_contact"; $mrb_reminder_column_name[$yy] = "Primary Contact"; $mrb_reminder_column_text_lenght[$yy] = 30; }
						if ($yy == 6) { $mrb_reminder_column_setting[$yy] = "primary_email"; $mrb_reminder_column_name[$yy] = "Primary Email"; $mrb_reminder_column_text_lenght[$yy] = 30; }
						if ($yy == 7) { $mrb_reminder_column_setting[$yy] = "reminder_sent"; $mrb_reminder_column_name[$yy] = "Reminder Sent"; $mrb_reminder_column_text_lenght[$yy] = 10; }
						if ($yy == 8) { $mrb_reminder_column_setting[$yy] = "amount"; $mrb_reminder_column_name[$yy] = "Total"; $mrb_reminder_column_text_lenght[$yy] = 10; }
							echo "<td align='center'>$mrb_reminder_column_name[$yy]</td>";
									} //end add default values
						} //end check for settings
					echo "</tr></font>";

	$bus_id = 1; //defaults
	$check_status = "Pending"; //default
	$I = 0;
	//$bgcolor = "#ffffff";
	$bgcolor = "#e1e1e1";
	$trans_amt_pending = 0; //default

	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table  . " WHERE business_id > %s AND status = %s ORDER BY id DESC, the_date2", $bus_id, $check_status ));
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

		
			$business_id[$I] = $myrevenuebooks_sql->business_id;
			//get the business name
			$the_bus_name = ""; //default
			$business_name = ""; //default
			$table = $wpdb->prefix . "myrevenuebooks";
			$myrevenuebooks_sqlc = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table  . " WHERE business_id = %s AND business_name <> %s", $business_id[$I], $the_bus_name ));
			foreach ( $myrevenuebooks_sqlc as $myrevenuebooks_sqc ) 
			{ $business_name = $myrevenuebooks_sqc->business_name; }
			
			$the_id[$I] = $myrevenuebooks_sql->id;
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
		echo "<td><div class='mrb-dashboard-links'><a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_transaction.php&id=$the_id[$I]&b_id=$business_id[$I]'><font color=$font_color_date>$mrb_reminder_column[$z]</a></font></div></td>";
							}
				echo "</tr>";		
		}

	//if security is enabled and security access is true, display the pending amount total.  If not. dont display.  If security is disabled then display.
	if ($I>0 && $the_security_option == "Enabled" && $security_security_access == "true" || $the_security_option == "Disabled" && $I>0) 
			{   echo "<tr><td colspan='8' align='left'><font color='#934600'><i>* These invoices are past due</i></font></td></tr>";
				echo "<tr><td colspan='8' align='right'><b>Total: $" . number_format($trans_amt_pending, 2, '.', ',') . "</b></td></tr>"; }
	if ($I==0) { echo "<tr><td colspan='8'>No Pending Transactions</td></tr>"; }
	echo "<tr><td colspan='8'></td></tr></table>";
} // end security_access check
///////////////////// End Display Pending /////////////////////
?>
</div>






<?php
////////////////////// Accounts and Transactions //////////////////////////////

	// if security is enabled and access is true, display.  If not. dont display.  If security is disabled then display.
	if ($the_security_option == "Enabled" && $security_accounts_access == "true" || $the_security_option == "Disabled") {
	
	//Count the accounts
	$bus_id = 1;
	$bus_name = "";
	$mrb_bus_total = 0;
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table  . " WHERE business_id > %s AND business_name <> %s", $bus_id, $bus_name ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{	if ($myrevenuebooks_sql->business_name <> "") {
			$mrb_bus_total++; }
			}

	//default values
	//if display otions are empty or not summitted
	$the_start = 0;
	$the_end = 50;
	$bus_id = 1;
	$bus_name = "";
	$I = 0;
	$bgcolor = "#ffffff";
	if ($mrb_bus_total >= $the_end) { $the_sort_end = $the_end; }
	if ($mrb_bus_total <= $the_end) { $the_sort_end = $mrb_bus_total; }

	
	//if display options are submitted
	if (!empty($_POST['display-submit'])) {

	$the_end = stripslashes( $_POST['amount_sort'] );
	if ( ! $the_end ) { $the_end = ''; }
	if ( strlen( $the_end ) > 100 ) { $the_end = substr( $the_end, 0, 100 ); }
	
	$the_start = 0;
	$bus_id = 1;
	$bus_name = "";
	$I = 0;
	$bgcolor = "#ffffff";
	if ($mrb_bus_total >= $the_end) { $the_sort_end = $the_end; }
	if ($mrb_bus_total <= $the_end) { $the_sort_end = $mrb_bus_total; }
		}
	
	
	?>
	<div id="mrb_wrapper">
	
		<div class="mrb_wrapper_text"><span class="dashicons dashicons-portfolio"></span></div>
		<div class="mrb_wrapper_text"><?php echo "Accounts ($mrb_bus_total)"; ?></div>

	<!--
	<div class="mrb_accounts">
	<form method='post' action='admin.php?page=my-revenue-books/myrevenuebooks_add.php'>
	<input type='submit' name='add-submit' class='button-secondary' value='Add Account' />
	</form>
		</div>
	-->
		
		<div class="mrb_wrapper_sorting">Sorting <?php echo $the_sort_end . " of " . $mrb_bus_total; ?>&nbsp;&nbsp;&nbsp;</div>

	<div class="mrb_wrapper_sort_options">
	<?php
	echo "<table align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>";
	
	echo "<tr><td align='center' width='150'><form method='post' action='admin.php?page=my-revenue-books/myrevenuebooks_add.php'>
				  <input type='submit' name='add-submit' class='button-secondary' value='Add New Account' /></form></td>";
	
	echo "<form name='displayamount' method='post'>";
	echo "<td align='right'>Display:
	<select name='amount_sort'>
	<option value='10'>10</option>
	<option value='25'>25</option>
	<option value='50'>50</option>
    <option value='75'>75</option>
    <option value='100'>100</option>
    <option value='200'>200</option>
    <option value='500'>500</option>
    <option value='999999'>All</option>
  	</select>";
  	echo "<input type='submit' name='display-submit' class='button-secondary' value='Filter' /></td></tr>";
	echo "</table>";
	echo "</form>";
	?>
	
		</div>
	</div>
	<div id="mrb_wrapper2">
	
	<?php
	
	
	
	    	//Check column and color settings
    		$table_security = $wpdb->prefix . "myrevenuebooks_security";
    		$security_type_query3 = "dashboard_accounts";
    		$column_number_query3 = 0;
    		$mrb_column_number_check = ""; //default
    		$mrb_col_color3 = "#cecece"; //default
    		$mrb_col_tex_color3 = "#000000"; //default
    		
    		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND column_number = %s", $security_type_query3, $column_number_query3 ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ $mrb_col_color3 = $myrevenuebooks_sql->column_color;
				$mrb_col_tex_color3 = $myrevenuebooks_sql->column_text_color;
						}	
			//show results
    		echo "<table align='left' border='0' cellpadding='6' cellspacing='1' width='100%'>";
    		echo "<tr bgcolor='$mrb_col_color3' style='font-weight:bold; color:$mrb_col_tex_color3'>";
	
	
	    	//Check or add default settings
    		$table_security = $wpdb->prefix . "myrevenuebooks_security";
    		$security_type_query3 = "dashboard_accounts";
    		$column_number_query3 = 0;
    		$mrb_column_number_check = ""; //default
    		$y = 0;
    		
    		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND column_number > %s", $security_type_query3, $column_number_query3 ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ 
				$y++;
				$mrb_column_number_check[$y] = $myrevenuebooks_sql->column_number; 
				$mrb_accounts_column_number[$y] = $myrevenuebooks_sql->column_number; 
				$mrb_accounts_column_name[$y] = $myrevenuebooks_sql->column_name_display; 
				$mrb_accounts_column_setting[$y] = $myrevenuebooks_sql->column_setting;
				
				$mrb_accounts_column_text_lenght[$y] = $myrevenuebooks_sql->column_text_lenght;
				 
					//if settings are found
					echo "<td align='center'>$mrb_accounts_column_name[$y]</td>";
									}
					//if empty, add default values: Accounts: business_name, $trans_count, $trans_date, $trans_amount_pending, $trans_amount, view, edit, delete
					if ($y == 0) {
						for ($yy = 1; $yy <= 8; $yy++) {
						if ($yy == 1) { $mrb_accounts_column_setting[$yy] = "business_name"; $mrb_accounts_column_name[$yy] = "Account"; $mrb_accounts_column_text_lenght[$yy] = 40; }
						if ($yy == 2) { $mrb_accounts_column_setting[$yy] = "trans_count"; $mrb_accounts_column_name[$yy] = "# Trans"; $mrb_accounts_column_text_lenght[$yy] = 20; }
						if ($yy == 3) { $mrb_accounts_column_setting[$yy] = "trans_date"; $mrb_accounts_column_name[$yy] = "Last Trans"; $mrb_accounts_column_text_lenght[$yy] = 20; }
						if ($yy == 4) { $mrb_accounts_column_setting[$yy] = "trans_amount_pending"; $mrb_accounts_column_name[$yy] = "Pending"; $mrb_accounts_column_text_lenght[$yy] = 30; }
						if ($yy == 5) { $mrb_accounts_column_setting[$yy] = "trans_amount"; $mrb_accounts_column_name[$yy] = "Total"; $mrb_accounts_column_text_lenght[$yy] = 30; }
						if ($yy == 6) { $mrb_accounts_column_setting[$yy] = "trans_view"; $mrb_accounts_column_name[$yy] = "View"; $mrb_accounts_column_text_lenght[$yy] = 20; }
						if ($yy == 7) { $mrb_accounts_column_setting[$yy] = "trans_edit"; $mrb_accounts_column_name[$yy] = "Edit"; $mrb_accounts_column_text_lenght[$yy] = 20; }
						if ($yy == 8) { $mrb_accounts_column_setting[$yy] = "trans_delete"; $mrb_accounts_column_name[$yy] = "Delete"; $mrb_accounts_column_text_lenght[$yy] = 20; }
							echo "<td align='center'>$mrb_accounts_column_name[$yy]</td>";
									} //end add default values
						} //end check for settings	
					echo "<td></td></tr></font>";
	
	
	
	
	
	

	
	
	
	
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table  . " WHERE business_id > %s AND business_name <> %s ORDER BY business_name ASC LIMIT $the_start, $the_end", $bus_id, $bus_name ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{	
	if($bgcolor=='#ffffff'){$bgcolor='';}
	else{$bgcolor='#ffffff';}
		// Find accounts
		if ($myrevenuebooks_sql->business_name <> "") {
			$I++;
			$default_id = "1";
			$trans_amount_pending[$I] = 0; //defaults
			$trans_amount[$I] = 0; //defaults
			$trans_count[$I] = 0; //defaults
			$trans_date[$I] = "None"; //defaults
			$business_id[$I] = $myrevenuebooks_sql->business_id;
			$the_id[$I] = $myrevenuebooks_sql->id;
			//$business_name[$I] = $myrevenuebooks_sql->business_name;
			$business_name = $myrevenuebooks_sql->business_name;
			$business_logo[$I] = $myrevenuebooks_sql->business_logo;
			
				// Query the number of transactions, total amounts and pending amounts
				$table = $wpdb->prefix . "myrevenuebooks";
				$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table  . " WHERE id > %s AND business_id = %s AND business_name IS NULL", $default_id, $business_id[$I] ));
				foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sqls ) 
				{
				$trans_count[$I] = isset($trans_count[$I]) ? $trans_count[$I] : 0;
				$trans_count[$I] = $trans_count[$I] + 1;
					//Query paid ads only
					if ($myrevenuebooks_sqls->status == "Paid") { 
					$trans_amount[$I] = isset($trans_amount[$I]) ? $trans_amount[$I] : 0;
					//settype($trans_amount[$I], "integer");
					//settype($myrevenuebooks_sqls->amount, "integer");
					$trans_amount[$I] = $trans_amount[$I] + $myrevenuebooks_sqls->amount;
						}
					//Query pending ads only
					if ($myrevenuebooks_sqls->status <> "Paid") { 
					$trans_amount_pending[$I] = isset($trans_amount_pending[$I]) ? $trans_amount_pending[$I] : '';
					$trans_amount_pending[$I] = $trans_amount_pending[$I] + $myrevenuebooks_sqls->amount;
						}
						//Query last transaction date
						$trans_date[$I] = $myrevenuebooks_sqls->the_date;
							
				} //end trans, total amts		
				
				//check for display amount and add $, num format and color
				$mrb_accounts_column_change1 = $trans_amount_pending[$I];
				$mrb_accounts_column_change2 = number_format($trans_amount_pending[$I], 2, '.', ',');
						if ($mrb_accounts_column_change2 >= 0) { $font_color_accounts = '#000000'; }
						if ($mrb_accounts_column_change2 < 0) { $font_color_accounts = '#c40000'; }									   
							$trans_amount_pending[$I] = "<font color=$font_color_accounts>$" . $mrb_accounts_column_change2 . "</font>";

				$mrb_accounts_column_change3 = $trans_amount[$I];
				$mrb_accounts_column_change4 = number_format($trans_amount[$I], 2, '.', ',');
						if ($mrb_accounts_column_change4 >= 0) { $font_color_accounts = '#000000'; }
						if ($mrb_accounts_column_change4 < 0) { $font_color_accounts = '#c40000'; }									   
							$trans_amount[$I] = "<font color=$font_color_accounts>$" . $mrb_accounts_column_change4 . "</font>";						
				
				//$trans_view = "<a href='admin.php?page=my-revenue-books/myrevenuebooks_view_transactions.php&id=$the_id[$I]&b_id=$business_id[$I]'>View</a>";
				//$trans_edit = "<a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_adv.php&id=$the_id[$I]'>Edit</a>";
				//$trans_delete = "<a href='admin.php?page=my-revenue-books/myrevenuebooks_delete_adv.php&id=$the_id[$I]&b_id=$business_id[$I]&_wpnonce=$deletenonce'> Delete</a>";
				
	$trans_view = "<a href='admin.php?page=my-revenue-books/myrevenuebooks_view_transactions.php&id=$the_id[$I]&b_id=$business_id[$I]' style='text-decoration: none;'><span class='dashicons dashicons-welcome-view-site' title='View'></span></a>";
		
	$trans_edit = "<a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_adv.php&id=$the_id[$I]' style='text-decoration: none;'><span class='dashicons dashicons-edit' title='Edit'></span></a>";
	
	$trans_delete =	"<a href='admin.php?page=my-revenue-books/myrevenuebooks_delete_adv.php&id=$the_id[$I]&b_id=$business_id[$I]&_wpnonce=$deletenonce' style='text-decoration: none;'><div class='mrb_acct_options_del2'><span class='dashicons dashicons-trash' title='Delete'></span></div></a>";
		
		
	echo "<tr bgcolor=$bgcolor><td align='left' height='25px' class='mrb-dashboard-links'><a href='admin.php?page=my-revenue-books/myrevenuebooks_view_transactions.php&id=$the_id[$I]&b_id=$business_id[$I]'>$business_name</a>";
	echo "<td align='center'>$trans_count[$I]</td>";
	echo "<td align='center'>$trans_date[$I]</td>";
	echo "<td align='left'>$trans_amount_pending[$I]</td>";
	echo "<td align='left'>$trans_amount[$I]</td>";
	echo "<td align='center' class='mrb-dashboard-links'>$trans_view</td>";
	echo "<td align='center' class='mrb-dashboard-links'>$trans_edit</td>";
	echo "<td align='center' class='mrb-dashboard-links'>$trans_delete</td>";
		echo "<td align='center' width='150'><form method='post' action='admin.php?page=my-revenue-books/myrevenuebooks_add_transaction.php&id=$the_id[$I]&b_id=$business_id[$I]'>";
		echo "<input type='submit' name='add-submit' class='button-secondary' value='Add New Transaction' /></form></td>";
	echo "</tr>";
		}
		
	}
	if ($I==0) { echo "<tr><td>No accounts</td></tr>"; }
	echo "</table>";
	
?>
</div>
<?php
//}



} // end security_access check
///////////////////// End Display Accounts /////////////////////


} // end if a valid user is found
?>

</div> <!-- mrb_main_wrapper from header.php -->