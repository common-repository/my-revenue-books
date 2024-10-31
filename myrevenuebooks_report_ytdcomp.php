<?php
global $wpdb;
$plugins_url = plugins_url();
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Reports";

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



$mrb_sort_amt_request = "";
		
	if(isset($_POST['search-amount'])){ $mrb_sort_amt_request = sanitize_text_field($_POST['search-amount']);
		$mrb_sort_amt_request = stripslashes( $_POST['search-amount'] );
		if ( ! $mrb_sort_amt_request ) { $mrb_sort_amt_request = '4'; }
		if ( strlen( $mrb_sort_amt_request ) > 200 ) { $mrb_sort_amt_request = substr( $mrb_sort_amt_request, 0, 200 );	}
			$mrb_sort_amt = $mrb_sort_amt_request;
				}
		else {$mrb_sort_amt = 4; } //default sort amount 0-4 (5)
?>


<?php
	$bus_id = 1; //default
	$mrb_null = ""; //default

for ($xx = 0; $xx <= $mrb_sort_amt; $xx++) {
	$mrb_year[$xx] = date("Y") - $xx;
	$mrb_yr_ttl[$xx] = $mrb_year[$xx]; //default
	$mrb_amt_ttl[$xx] = $mrb_year[$xx]; //default
	}


for ($yy = 0; $yy <= $mrb_sort_amt; $yy++) {
				//set monthly and counter defaults to zero for each year
				$mrb_01[$mrb_year[$yy]]=0; $mrb_02[$mrb_year[$yy]]=0; $mrb_03[$mrb_year[$yy]]=0; $mrb_04[$mrb_year[$yy]]=0; $mrb_05[$mrb_year[$yy]]=0; $mrb_06[$mrb_year[$yy]]=0;
				$mrb_07[$mrb_year[$yy]]=0; $mrb_08[$mrb_year[$yy]]=0; $mrb_09[$mrb_year[$yy]]=0; $mrb_10[$mrb_year[$yy]]=0; $mrb_11[$mrb_year[$yy]]=0; $mrb_12[$mrb_year[$yy]]=0;
				$mrb_01_count[$mrb_year[$yy]]=0; $mrb_02_count[$mrb_year[$yy]]=0; $mrb_03_count[$mrb_year[$yy]]=0; $mrb_04_count[$mrb_year[$yy]]=0; $mrb_05_count[$mrb_year[$yy]]=0; $mrb_06_count[$mrb_year[$yy]]=0;
				$mrb_07_count[$mrb_year[$yy]]=0; $mrb_08_count[$mrb_year[$yy]]=0; $mrb_09_count[$mrb_year[$yy]]=0; $mrb_10_count[$mrb_year[$yy]]=0; $mrb_11_count[$mrb_year[$yy]]=0; $mrb_12_count[$mrb_year[$yy]]=0;
				
	//query start
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id > %s AND the_date <> %s ORDER BY the_date2, the_date ASC", $bus_id, $mrb_null ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		//get the year
		$mrb_query_year = substr($myrevenuebooks_sql->the_date, 6, 4); //get the year of the invoice
			if ($mrb_query_year == $mrb_year[$yy]) {
				$mrb_query_month = substr($myrevenuebooks_sql->the_date, 0, 2); //get the month of the invoice
				// make sure its a paid transaction
				$mrb_query_status = $myrevenuebooks_sql->status;
				if ($mrb_query_month == "01" && $mrb_query_status == "Paid") { $mrb_01[$mrb_year[$yy]] = $mrb_01[$mrb_year[$yy]] + $myrevenuebooks_sql->amount; $mrb_01_count[$mrb_year[$yy]]++; }
				if ($mrb_query_month == "02" && $mrb_query_status == "Paid") { $mrb_02[$mrb_year[$yy]] = $mrb_02[$mrb_year[$yy]] + $myrevenuebooks_sql->amount; $mrb_02_count[$mrb_year[$yy]]++; }
				if ($mrb_query_month == "03" && $mrb_query_status == "Paid") { $mrb_03[$mrb_year[$yy]] = $mrb_03[$mrb_year[$yy]] + $myrevenuebooks_sql->amount; $mrb_03_count[$mrb_year[$yy]]++; }
				if ($mrb_query_month == "04" && $mrb_query_status == "Paid") { $mrb_04[$mrb_year[$yy]] = $mrb_04[$mrb_year[$yy]] + $myrevenuebooks_sql->amount; $mrb_04_count[$mrb_year[$yy]]++; }
				if ($mrb_query_month == "05" && $mrb_query_status == "Paid") { $mrb_05[$mrb_year[$yy]] = $mrb_05[$mrb_year[$yy]] + $myrevenuebooks_sql->amount; $mrb_05_count[$mrb_year[$yy]]++; }
				if ($mrb_query_month == "06" && $mrb_query_status == "Paid") { $mrb_06[$mrb_year[$yy]] = $mrb_06[$mrb_year[$yy]] + $myrevenuebooks_sql->amount; $mrb_06_count[$mrb_year[$yy]]++; }
				if ($mrb_query_month == "07" && $mrb_query_status == "Paid") { $mrb_07[$mrb_year[$yy]] = $mrb_07[$mrb_year[$yy]] + $myrevenuebooks_sql->amount; $mrb_07_count[$mrb_year[$yy]]++; }
				if ($mrb_query_month == "08" && $mrb_query_status == "Paid") { $mrb_08[$mrb_year[$yy]] = $mrb_08[$mrb_year[$yy]] + $myrevenuebooks_sql->amount; $mrb_08_count[$mrb_year[$yy]]++; }
				if ($mrb_query_month == "09" && $mrb_query_status == "Paid") { $mrb_09[$mrb_year[$yy]] = $mrb_09[$mrb_year[$yy]] + $myrevenuebooks_sql->amount; $mrb_09_count[$mrb_year[$yy]]++; }
				if ($mrb_query_month == "10" && $mrb_query_status == "Paid") { $mrb_10[$mrb_year[$yy]] = $mrb_10[$mrb_year[$yy]] + $myrevenuebooks_sql->amount; $mrb_10_count[$mrb_year[$yy]]++; }
				if ($mrb_query_month == "11" && $mrb_query_status == "Paid") { $mrb_11[$mrb_year[$yy]] = $mrb_11[$mrb_year[$yy]] + $myrevenuebooks_sql->amount; $mrb_11_count[$mrb_year[$yy]]++; }
				if ($mrb_query_month == "12" && $mrb_query_status == "Paid") { $mrb_12[$mrb_year[$yy]] = $mrb_12[$mrb_year[$yy]] + $myrevenuebooks_sql->amount; $mrb_12_count[$mrb_year[$yy]]++; }
		
		//add monthly total transactions
		$mrb_yr_ttl[$mrb_year[$yy]] = $mrb_01_count[$mrb_year[$yy]] + $mrb_02_count[$mrb_year[$yy]] + $mrb_03_count[$mrb_year[$yy]] + $mrb_04_count[$mrb_year[$yy]] + $mrb_05_count[$mrb_year[$yy]] + $mrb_06_count[$mrb_year[$yy]] + $mrb_07_count[$mrb_year[$yy]] + $mrb_08_count[$mrb_year[$yy]] + $mrb_09_count[$mrb_year[$yy]] + $mrb_10_count[$mrb_year[$yy]] + $mrb_11_count[$mrb_year[$yy]] + $mrb_12_count[$mrb_year[$yy]];
		//add monthly total amounts
		$mrb_amt_ttl[$mrb_year[$yy]] = $mrb_01[$mrb_year[$yy]] + $mrb_02[$mrb_year[$yy]] + $mrb_03[$mrb_year[$yy]] + $mrb_04[$mrb_year[$yy]] + $mrb_05[$mrb_year[$yy]] + $mrb_06[$mrb_year[$yy]] + $mrb_07[$mrb_year[$yy]] + $mrb_08[$mrb_year[$yy]] + $mrb_09[$mrb_year[$yy]] + $mrb_10[$mrb_year[$yy]] + $mrb_11[$mrb_year[$yy]] + $mrb_12[$mrb_year[$yy]];
			}
}
}
?>



<!-- //////////////// reports menu //////////////// -->
	<table align="left" border="0" cellpadding="2" cellspacing="1" width="100%">
	<td align="left"><div class="mrb_report_tab_wrapper"><span class="dashicons dashicons-chart-pie"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_reports.php">Reports</a></div></td>
	<td><div class="mrb_report_tab_wrapper"><span class="dashicons dashicons-groups"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_report_accounts.php">Detailed Account Report</a></div></td>
	<td><div class="mrb_report_tab_wrapper">&nbsp;<span class="dashicons dashicons-text-page"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_report_transactions.php">Detailed Transaction Report</a></div></td>
	<td><div class="mrb_report_tab_wrapper">&nbsp;<span class="dashicons dashicons-chart-bar"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_report_ytdcomp.php">YTD Comparison Report</a></div></td>
	<td><div class="mrb_report_tab_wrapper">&nbsp;<span class="dashicons dashicons-admin-links"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_link_report.php">Link Report</a></div></td>
	<td><div class="mrb_report_tab_wrapper">&nbsp;<span class="dashicons dashicons-hammer"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_reports_workorders.php">Workorder Report</a></div></td>
	</tr>
	</table>
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td height="5px"> </td></tr>
	</table>
<!-- //////////////// end reports menu //////////////// -->





<div id="mrb_wrapper">

	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td align="left" width="25px"><span class="dashicons dashicons-chart-bar"></span></td>
		<td align="left"><h3><b>YTD Comparison Report</b></h3></td></tr>
		</table>
		
		
		<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr><td>
		<form name="displayamount" method="post">
		Display:&nbsp;<select name="search-amount" value="">Query</option>
		<?php if ($mrb_sort_amt_request > 0) {?><option value='$mrb_sort_amt_request'><?php echo $mrb_sort_amt_request + 1; ?></option><?php };  ?>
		<option value="1">2</option>
		<option value="2">3</option>
		<option value="3">4</option>
		<option value="4">5</option>
		<option value="5">6</option>
		<option value="6">7</option>
		<option value="7">8</option>
		<option value="8">9</option>
		<option value="9">10</option>
		<input type="hidden" value="setup" name="mrb_settings" />&nbsp;Years
		<input type="submit" name="display-submit" class="button-secondary" value="Submit" />
		</td></tr>
		</form>
		</table>




<?php
	$mrb_bgcolor1 = "#ffffff"; //default
	$mrb_bgcolor2 = "#ebebeb"; //default
	echo "<table align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>";
	echo "<tr><td align='right'>Year (# Transactions) <i>*Paid transactions only </i></td></tr></table>";
	echo "<table align='left' border='0' cellpadding='4' cellspacing='1' width='100%'>";
	echo "<tr bgcolor='#4a8fce'><td><b>MTH/YR</b></td>";
	
	
	for ($sss = 0; $sss <= $mrb_sort_amt; $sss++) {
			//check for totals, if empty set to zero
			if (empty($mrb_yr_ttl[$mrb_year[$sss]])) {$mrb_yr_ttl_disp = 0;}
				else {$mrb_yr_ttl_disp = $mrb_yr_ttl[$mrb_year[$sss]];}

		echo "<td align='center'><b>$mrb_year[$sss]</b> ($mrb_yr_ttl_disp)</td>"; }
		echo "</tr>";	
	
	$mrb_month = array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');

	for ($mrb_disp = 0; $mrb_disp <= 11; $mrb_disp++) {
		
		echo "<tr><td bgcolor='#d9d9d9'>$mrb_month[$mrb_disp]</td>";
		$mrb_bgcolor = $mrb_bgcolor1;
		for ($ss = 0; $ss <= $mrb_sort_amt; $ss++) { $the_mrb_year = $mrb_year[$ss];
			if ($mrb_disp == 0) { echo "<td bgcolor=$mrb_bgcolor>$" . number_format($mrb_01[$the_mrb_year], 2, '.', ',') . " ($mrb_01_count[$the_mrb_year])</td>"; }
			if ($mrb_disp == 1) { echo "<td bgcolor=$mrb_bgcolor>$" . number_format($mrb_02[$the_mrb_year], 2, '.', ',') . " ($mrb_02_count[$the_mrb_year])</td>"; }
			if ($mrb_disp == 2) { echo "<td bgcolor=$mrb_bgcolor>$" . number_format($mrb_03[$the_mrb_year], 2, '.', ',') . " ($mrb_03_count[$the_mrb_year])</td>"; }
			if ($mrb_disp == 3) { echo "<td bgcolor=$mrb_bgcolor>$" . number_format($mrb_04[$the_mrb_year], 2, '.', ',') . " ($mrb_04_count[$the_mrb_year])</td>"; }
			if ($mrb_disp == 4) { echo "<td bgcolor=$mrb_bgcolor>$" . number_format($mrb_05[$the_mrb_year], 2, '.', ',') . " ($mrb_05_count[$the_mrb_year])</td>"; }
			if ($mrb_disp == 5) { echo "<td bgcolor=$mrb_bgcolor>$" . number_format($mrb_06[$the_mrb_year], 2, '.', ',') . " ($mrb_06_count[$the_mrb_year])</td>"; }
			if ($mrb_disp == 6) { echo "<td bgcolor=$mrb_bgcolor>$" . number_format($mrb_07[$the_mrb_year], 2, '.', ',') . " ($mrb_07_count[$the_mrb_year])</td>"; }
			if ($mrb_disp == 7) { echo "<td bgcolor=$mrb_bgcolor>$" . number_format($mrb_08[$the_mrb_year], 2, '.', ',') . " ($mrb_08_count[$the_mrb_year])</td>"; }
			if ($mrb_disp == 8) { echo "<td bgcolor=$mrb_bgcolor>$" . number_format($mrb_09[$the_mrb_year], 2, '.', ',') . " ($mrb_09_count[$the_mrb_year])</td>"; }
			if ($mrb_disp == 9) { echo "<td bgcolor=$mrb_bgcolor>$" . number_format($mrb_10[$the_mrb_year], 2, '.', ',') . " ($mrb_10_count[$the_mrb_year])</td>"; }
			if ($mrb_disp == 10) { echo "<td bgcolor=$mrb_bgcolor>$" . number_format($mrb_11[$the_mrb_year], 2, '.', ',') . " ($mrb_11_count[$the_mrb_year])</td>"; }
			if ($mrb_disp == 11) { echo "<td bgcolor=$mrb_bgcolor>$" . number_format($mrb_12[$the_mrb_year], 2, '.', ',') . " ($mrb_12_count[$the_mrb_year])</td>"; }
		if ($mrb_bgcolor == $mrb_bgcolor2) {$mrb_bgcolor = $mrb_bgcolor1;} else { $mrb_bgcolor = $mrb_bgcolor2; }
				}
		echo "</tr>";
	}
	
	echo "<tr><td bgcolor='#d9d9d9'><b>TOTALS</b></td>";
	
	for ($sss = 0; $sss <= $mrb_sort_amt; $sss++) {
			if (empty($mrb_amt_ttl[$mrb_year[$sss]])) {$mrb_amt_ttl_disp = 0;}
				else {$mrb_amt_ttl_disp = $mrb_amt_ttl[$mrb_year[$sss]];}
		echo "<td bgcolor='#d9d9d9'><b>$" . number_format($mrb_amt_ttl_disp, 2, '.', ',') . "</b></td>";
		}
	echo "</tr></table>";
?>
</div>





	

<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->