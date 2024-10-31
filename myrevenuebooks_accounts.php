<?php
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Accounts";

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


<!-- MAIN CONTENT -->

<?php
	//user not valid notice
	if ($the_security_option == "Enabled" && $mrb_current_user_id == 0) {
		echo $default_security_message . "<br>"; }
	?>

<?php
	//if a valid user is found
	if ($the_security_option == "Enabled" && $mrb_current_user_id > 0 || $the_security_option == "Disabled") { 	
	
	
	//if the user does not have access to accounts
	if ($the_security_option == "Enabled" && $security_accounts_access == "false") { ?>
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td align="middle"><h3><?php echo $default_security_message; ?></h3></td></tr>
	<tr><td align="middle"><b>Contact your administrator or check the <a href="admin.php?page=my-revenue-books/myrevenuebooks_security.php">security & privacy</a> settings to enable access.</b></td></tr>
	<tr><td>&nbsp;</td></tr>
	</table>
<?php
}
	
	
	
	/////////// START ACCOUNTS //////////////

	// if security is enabled and access is true, display.  If not. dont display.  If security is disabled then display.
	if ($the_security_option == "Enabled" && $security_accounts_access == "true" || $the_security_option == "Disabled") {

////////////////////// Accounts and Transactions //////////////////////////////
	
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

	<div class="mrb_accounts">
	<form method='post' action='admin.php?page=my-revenue-books/myrevenuebooks_add.php'>
	<input type='submit' name='add-submit' class='button-small' value='Add New Account' />
	</form>
		</div>
		
		<div class="mrb_wrapper_sorting">Sorting <?php echo $the_sort_end . " of " . $mrb_bus_total; ?></div>

	<div class="mrb_wrapper_sort_options">
	<?php
	echo "<table align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>";
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
    		echo "<table align='left' border='0' cellpadding='4' cellspacing='1' width='100%'>";
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
					echo "</tr></font>";

	
	
	
	
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
	echo "</tr>";
		}
		
	}
	if ($I==0) { echo "<tr><td>No accounts</td></tr>"; }
	echo "</table>";
	
?>
</div>
<?php
//}



} // end security access check
///////////////////// End Display Accounts /////////////////////






	



} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->