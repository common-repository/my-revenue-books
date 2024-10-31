<?php
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
$role_error = "";
//check for dashboard security options
$mrb_page = "Security";

	//get current user information
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
		if ($mrb_user_firstname == "") { $mrb_user_firstname = "No Name";}
		

//enable or disable security
//do not remove from top location, needs to check update first before headers are loaded
if (!empty($_POST['security-enable-submit'])) {

	$default_security_message = "Sorry, you are not allowed to access this page.";
	$security_option = stripslashes( $_POST['security_option'] );
	if ( ! $security_option ) { $security_option = ''; }
	if ( strlen( $security_option ) > 100 ) { $security_option = substr( $security_option, 0, 100 ); }
		$id_check = "1";
		$table_security = $wpdb->prefix . "myrevenuebooks_security";
		$wpdb->query($wpdb->prepare("UPDATE " . $table_security . " SET 
		security_option = %s,
		default_security_message = %s
		WHERE id = $id_check;", 
		$security_option,
		$default_security_message
			));

//only add default admin user if security is enabled
if ($security_option <> "Disabled") {
// check for default admin user, if not add current user as default
	$the_security_type = "User";//default
	$id_check = "";
	$found_userid = 0;
	$table_security = $wpdb->prefix . "myrevenuebooks_security";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE userid = %s AND id <> %s", $mrb_user_id, $id_check ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $the_userid = $myrevenuebooks_sql->userid;
	  $found_userid = 1; }
	
	//add default user if none are found
	if ($found_userid <> 1) {
		$mrb_user_role = "Administrator";
		$mrb_user_role_level = "1";
		$table_security = $wpdb->prefix . "myrevenuebooks_security";
		$wpdb->query( $wpdb->prepare( "INSERT INTO " . $table_security . " (
		security_type,
		userid,
		user_email,
		user_firstname,
		user_lastname,
		user_role,
		user_role_level
		)
	VALUES ( %s,%s,%s,%s,%s,%s,%s )
	",
		$the_security_type,
		$mrb_user_id,
		$mrb_user_email,
		$mrb_user_firstname,
		$mrb_user_lastname,
		$mrb_user_role,
		$mrb_user_role_level
		) );
				
				//add default values for access
				$table_security = $wpdb->prefix . "myrevenuebooks_security";
				$mrb_user_role_level = "1";
				$sec_default_add[1] = "security";
				$sec_default_add[2] = "settings";
				$sec_default_add[3] = "reports";
				$sec_default_add[4] = "search";
				$sec_default_add[5] = "dashboard_reminder";
				$sec_default_add[6] = "dashboard_pending";
				$sec_default_add[7] = "dashboard_accounts";
				$sec_default_add[8] = "workorder_admin";
				$sec_default_add[9] = "dashboard_workorder";
				
				for ($d = 1; $d <= 9; $d++) {
    			$wpdb->query( $wpdb->prepare( "INSERT INTO " . $table_security . " (
				security_type,
				userid,
				user_firstname,
				user_lastname,
				user_email,
				user_role,
				user_role_level
					)
				VALUES ( %s,%s,%s,%s,%s,%s,%s )",
		$sec_default_add[$d],
		$mrb_user_id,
		$mrb_user_firstname,
		$mrb_user_lastname,
		$mrb_user_email,
		$mrb_user_role,
		$mrb_user_role_level
			));
			} // end for $d
		
				} //end add default user and access
	} //end security_option <> Disabled option
		
		}
//end enable or disable security
?>


<?php
// remove user
//check for role removals
	$r_id=0; // id
	$t_id=0; // userid
	if(isset($_REQUEST['r_id'])) { $r_id = sanitize_text_field( $_REQUEST['r_id'] ); }
	if(isset($_REQUEST['t_id'])) { $t_id = sanitize_text_field( $_REQUEST['t_id'] ); }
	
	if ($r_id > 0) {
		
		// check to see if the security feature is enabled and at least one user is active and administrator
		$i = 0;
		$security_option_value = ""; //default
		$security_option_check = "Enabled";
		$u_check = "";
		$table_security = $wpdb->prefix . "myrevenuebooks_security";
		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_option = %s AND userid = %s", $security_option_check, $u_check ));
		foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
		{ $security_option_value = $myrevenuebooks_sql->security_option; }
		
		if ($security_option_value = "Enabled") {
			// make sure that there is at least one administrator account before changing role
			$mrb_user_role_check2 = "Administrator";
			$table_security = $wpdb->prefix . "myrevenuebooks_security";
			$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE user_role = %s AND userid <> %s", $mrb_user_role_check2, $t_id ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ $i++; }
		//if more admins, remove selected user
		if ($i >= 1 ) {
				$deletenonce=$_REQUEST['_wpnonce'];
				if (! wp_verify_nonce($deletenonce, 'my-nonce') ) die("Unable to complete your request!");
				$table_security = $wpdb->prefix . "myrevenuebooks_security";
				$wpdb->query( $wpdb->prepare( "DELETE FROM $table_security WHERE id = %s AND userid = %s", $r_id, $t_id ));
				
				// delete the user in other options
				$mrb_delete_security_type = "User"; //default
				$wpdb->query( $wpdb->prepare( "DELETE FROM $table_security WHERE security_type <> %s AND userid = %s", $mrb_delete_security_type, $t_id ));
					}
		} //end if enabled
		 if ($i == 0) { $role_error = "You must have at least one Administrator account!"; }
	
	} //end if role removal

?>


<?php 



//add security users
if (!empty($_POST['add-security-user'])) {

	if (isset($_POST['add_user_id'])) {
	$assigned_id = sanitize_text_field($_POST['add_user_id'] ); } else $assigned_id = "";
	if ( ! $assigned_id ) { $assigned_id = ''; }
	if ( strlen( $assigned_id ) > 100 ) { $assigned_id = substr( $assigned_id, 0, 100 ); }
	
	//user role
	if (isset($_POST['add_user_role'])) {
	$assigned_user_role = sanitize_text_field($_POST['add_user_role'] ); } else $assigned_user_role = "";
	if ( ! $assigned_user_role ) { $assigned_user_role = ''; }
	if ( strlen( $assigned_user_role ) > 100 ) { $assigned_user_role = substr( $assigned_user_role, 0, 100 ); }
	
	$default_user_email = "";
	$the_user_email = "";
	$table_wp = $wpdb->prefix . "users";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_wp . " WHERE id = %s AND id <> %s", $assigned_id, $default_user_email ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $the_user_email = $myrevenuebooks_sql->user_email; }
	
		//find first name
		$default_umeta = "first_name";
		$table_wp = $wpdb->prefix . "usermeta";
		$myrevenuebooks_sqlq2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_wp . " WHERE user_id = %s AND meta_key = %s", $assigned_id, $default_umeta ));
		foreach ( $myrevenuebooks_sqlq2 as $myrevenuebooks_sql2 )
		{
		$mrb_user_firstname = $myrevenuebooks_sql2->meta_value;
		}
	//find last name
		$default_umeta2 = "last_name";
		$table_wp = $wpdb->prefix . "usermeta";
		$myrevenuebooks_sqlq3 = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_wp . " WHERE user_id = %s AND meta_key = %s", $assigned_id, $default_umeta2 ));
		foreach ( $myrevenuebooks_sqlq3 as $myrevenuebooks_sql3 )
		{
		$mrb_user_lastname = $myrevenuebooks_sql3->meta_value;
		}

		//check for existing user already added
			$x=0;
			$mrb_user_role_check3 = "";
			$table_security = $wpdb->prefix . "myrevenuebooks_security";
			$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE userid = %s AND user_role <> %s", $assigned_id, $mrb_user_role_check3 ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ $x++; }
		//add user if not already in the database
		if ($x == 0) {
			
		//get wordpress user role
		$default_user_email = "";
		$table_wp = $wpdb->prefix . "users";
		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_wp . " WHERE ID = %s AND user_email <> %s", $assigned_id, $default_user_email ));
		foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql )
		{
			$mrb_id_search = $myrevenuebooks_sql->ID;
			
			$get_mrb_wp_user_role2 = get_userdata( $mrb_id_search );
			if( !empty( $get_mrb_wp_user_role2->roles ) ){
    		foreach( $get_mrb_wp_user_role2->roles as $the_wp_role2 ){}  }
			$mrb_wp_user_role2 = ucwords($the_wp_role2); //current wordpress user role
			$mrb_user_role = $mrb_wp_user_role2;
			}
				

		
		//set user level
		$the_security_type = "User";//default
		$mrb_user_role_level = "";
		if ($mrb_user_role == "Administrator") { $mrb_user_role_level = "1"; }
		if ($mrb_user_role == "Editor") { $mrb_user_role_level = "2"; }
		if ($mrb_user_role == "Author") { $mrb_user_role_level = "3"; }
		if ($mrb_user_role == "Contributor") { $mrb_user_role_level = "4"; }
		if ($mrb_user_role == "Subscriber") { $mrb_user_role_level = "5"; }
	
		$table_security = $wpdb->prefix . "myrevenuebooks_security";
		$wpdb->query( $wpdb->prepare( "INSERT INTO " . $table_security . " (
		security_type,
		userid,
		user_email,
		user_firstname,
		user_lastname,
		user_role,
		user_role_level
		)
	VALUES ( %s,%s,%s,%s,%s,%s,%s )
	",
		$the_security_type,
		$assigned_id,
		$the_user_email,
		$mrb_user_firstname,
		$mrb_user_lastname,
		$mrb_user_role,
		$mrb_user_role_level
		) );
	}


	if ($x > 0) { $role_error = "This user has already beed added!"; }
}


//change security users role
//for the future usage
/*
		if (!empty($_POST['change-security-user-role'])) {

		if (isset($_POST['add_user_change'])) {
		$new_user_role = sanitize_text_field($_POST['add_user_change'] ); } else $new_user_role = "";
		if ( ! $new_user_role ) { $new_user_role = ''; }
		if ( strlen( $new_user_role ) > 100 ) { $new_user_role = substr( $new_user_role, 0, 100 ); }
		
		if (isset($_POST['the_user_id'])) {
		$the_user_id2 = sanitize_text_field($_POST['the_user_id'] ); } else $the_user_id2 = "";
		if ( ! $the_user_id2 ) { $the_user_id2 = ''; }
		if ( strlen( $the_user_id2 ) > 100 ) { $the_user_id2 = substr( $the_user_id2, 0, 100 ); }

			// make sure that there is at least one administrator account before changing role
			$x = 0;
			$mrb_user_role_check2 = "Administrator";
			$table_security = $wpdb->prefix . "myrevenuebooks_security";
			$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE user_role = %s AND userid <> %s", $mrb_user_role_check2, $the_user_id2 ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ $x++; }
			
		//set user level
		$the_security_type = "User";//default
		if ($new_user_role == "Administrator") { $mrb_user_role_level = "1"; }
		if ($new_user_role == "Editor") { $mrb_user_role_level = "2"; }
		if ($new_user_role == "Author") { $mrb_user_role_level = "3"; }
		if ($new_user_role == "Contributor") { $mrb_user_role_level = "4"; }
		if ($new_user_role == "Subscriber") { $mrb_user_role_level = "5"; }
			
		// if more admin accounts are found, change role
		if ($x > 0 ) {
		$table_security = $wpdb->prefix . "myrevenuebooks_security";
		$wpdb->query($wpdb->prepare("UPDATE " . $table_security . " SET 
		user_role = %s,
		user_role_level = %s
		WHERE userid = $the_user_id2;", 
		$new_user_role,
		$mrb_user_role_level
			));
					}
				if ($x == 0) { $role_error = "Cannot change user role.  You must have at least one Administrator account!"; }
}
*/


// add default security message to non-users
	if (!empty($_POST['add-default-security-message'])) {
		$default_security_message_check = stripslashes( $_POST['default_security_message_add'] );
		if ( ! $default_security_message_check ) { $default_security_message_check = ''; }
		if ( strlen( $default_security_message_check ) > 300 ) { $default_security_message_check = substr( $default_security_message_check, 0, 300 ); }
		
		$security_check = "";
		$table_security = $wpdb->prefix . "myrevenuebooks_security";
		$wpdb->query($wpdb->prepare("UPDATE " . $table_security . " SET default_security_message = %s WHERE security_option <> %s", $default_security_message_check, $security_check ));
				echo "MESSAGE: " . $default_security_message_check . "<br>";
				}



// check to see if the security feature is enabled
	$default_security_message = ""; //default
	$security_option = "";
	$security_option_check = "0";
	$id_check = "";
	$id_check2 = "";
	$table_security = $wpdb->prefix . "myrevenuebooks_security";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_option <> %s AND id <> %s", $security_option_check, $id_check ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $security_option = $myrevenuebooks_sql->security_option; 
		$default_security_message = $myrevenuebooks_sql->default_security_message; }
		if ($security_option == "") { $security_option = "Disabled";}
?>








<!-- MAIN CONTENT -->

<?php //include security check
	include ("includes/security_check.php");
//include header options
	include ("header.php");
	?>

<?php
	//user not valid notice
	if ($the_security_option == "Enabled" && $mrb_current_user_id == 0) {
	echo $default_security_message . "<br>"; }
	?>

	<?php
	//if the user does not have access to settings
	if ($the_security_option == "Enabled" && $security_security_access == "false") { ?>
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td align="middle"><h3><?php echo $default_security_message; ?></h3></td></tr>
	<tr><td align="middle"><b>Contact your administrator or check the <a href="admin.php?page=my-revenue-books/myrevenuebooks_security.php">security & privacy</a> settings to enable access.</b></td></tr>
	<tr><td>&nbsp;</td></tr>
	</table>
	<?php } ?>



<?php
	//if a valid user is found
	if ($the_security_option == "Enabled" && $mrb_current_user_id > 0 || $the_security_option == "Disabled") { 	
	
	//if security is enabled and security access is true, display.  If not. dont display.  If security is disabled then display.
	if ($the_security_option == "Enabled" && $security_security_access == "true" || $the_security_option == "Disabled") {
	?>
	
	
	
		

	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr><td><h3>Security & Privacy Options:</h3></b></td></tr>
	</table>

	<!-- enable or disable security -->
	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
	<form name="securitysettings" method="post">
	<?php $security_option_display = ""; //default
		if ($security_option == "Disabled") { $security_option_change = "Enabled"; $security_option_display = "Enable"; }
		if ($security_option == "Enabled") { $security_option_change = "Disabled"; $security_option_display = "Disable"; }
			?>
	<input type="hidden" value="<?php echo $security_option_change; ?>" name="security_option" />
	<tr><td align="center"><input type="submit" name="security-enable-submit" class="button-primary" value="<?php echo $security_option_display; ?> Security & Privacy" /></td></tr>
	<tr><td align="center">You can enable or disable the security and privacy options here.<br>If disabled, all administrators and editors will have full access!</td></tr>
	</form>
	</table>
	
<?php
//if the securiity option is enabled, display the options
if ($security_option == "Enabled"){ ?>

	<!-- view current users -->
		<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
		<tr><td>&nbsp;</td></tr>
		<tr bgcolor="#cecece"><td width="2%"><span class="dashicons dashicons-groups"></span></td>
							  <td width="98%" align="left"><b>Current users:</b> <i>(Added users will have access, but you can limit their access by using the user limitation options)</i></td></tr>
		</table>
		
		<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
		<tr bgcolor="#c0dcc9"><td></td><td><b>USER</b></td><td><b>EMAIL</b></td><td><b>WP ROLE</b></td><td colspan="9" align="center"><b>ACCESS</b></td><td width="60" align="center"><b>REMOVE</b></td></tr>	
		
		<?php
		$security_user_check = "User";
		$id_check3 = 0;
		$table_security = $wpdb->prefix . "myrevenuebooks_security";
		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND userid <> %s", $security_user_check, $id_check3 ));
		foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
		{ 
		$id = $myrevenuebooks_sql->id;
		$userid = $myrevenuebooks_sql->userid;
		$mrb_user_email = $myrevenuebooks_sql->user_email;
		$mrb_user_firstname = $myrevenuebooks_sql->user_firstname;
		$mrb_user_lastname = $myrevenuebooks_sql->user_lastname;
		//$mrb_user_role = $myrevenuebooks_sql->user_role;
		
		
		
		
		
		// get the wordpress user role
		$get_mrb_wp_user_role = get_userdata( $userid );
		if( !empty( $get_mrb_wp_user_role->roles ) ){ foreach( $get_mrb_wp_user_role->roles as $the_wp_role ){}  }
		$mrb_wp_user_role = ucwords($the_wp_role); //current wordpress user role
		
				// get the users access
					$the_access_type = ""; //default
					//defaults
					$security_access = "<div title='Security & Privacy Access Disabled'><font color='#d9d8da'><span class='dashicons dashicons-shield'></span></font>";
					$settings_access = "<div title='Settings Access Disabled'><font color='#d9d8da'><span class='dashicons dashicons-admin-generic'></span></span>";
					$reports_access = "<div title='Reports Access Disabled'><font color='#d9d8da'><span class='dashicons dashicons-chart-bar'></span></span>";
					$search_access = "<div title='Search Access Disabled'><font color='#d9d8da'><span class='dashicons dashicons-search'></span></span>";
					$rem_access = "<div title='Reminders Access Disabled'><font color='#d9d8da'><span class='dashicons dashicons-calendar'></span></span>";
					$pen_access = "<div title='Pending Access Disabled'><font color='#d9d8da'><span class='dashicons dashicons-sticky'></span></span>";
					$act_access = "<div title='Accounts Access Disabled'><font color='#d9d8da'><span class='dashicons dashicons-portfolio'></span></span>";
					$work_admin = "<div title='Workorder Admin Access Disabled'><font color='#d9d8da'><span class='dashicons dashicons-hammer'></span></font>";
					$work_access = "<div title='Workorder User Access Disabled'><font color='#d9d8da'><span class='dashicons dashicons-hammer'></span></font>";
				
				$myrevenuebooks_sqlq1 = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type <> %s AND userid = %s", $security_user_check, $userid ));
				foreach ( $myrevenuebooks_sqlq1 as $myrevenuebooks_sql1 ) 
				{ $the_access_type = $myrevenuebooks_sql1->security_type; 
				//page access
				if ($the_access_type == "security") { $security_access = "<div title='Security & Privacy Access Enabled'><span class='dashicons dashicons-shield'></span></div>"; }
				if ($the_access_type == "settings") { $settings_access = "<div title='Settings Access Enabled'><span class='dashicons dashicons-admin-generic'></span></div>"; }
				if ($the_access_type == "reports") { $reports_access = "<div title='Reports Access Enabled'><span class='dashicons dashicons-chart-bar'></span></div>"; }
				if ($the_access_type == "search") { $search_access = "<div title='Search Access Enabled'><span class='dashicons dashicons-search'></span></div>"; }
				//dashboard access
				if ($the_access_type == "dashboard_reminder") { $rem_access = "<div title='Reminders Access Enabled'><span class='dashicons dashicons-calendar'></span></div>"; }
				if ($the_access_type == "dashboard_pending") { $pen_access = "<div title='Pending Access Enabled'><span class='dashicons dashicons-sticky'></span></div>"; }
				if ($the_access_type == "dashboard_accounts") { $act_access = "<div title='Accounts Access Enabled'><span class='dashicons dashicons-portfolio'></span></div>"; }	
				if ($the_access_type == "workorder_admin") { $work_admin = "<div title='Workorder Admin Access Enabled'><span class='dashicons dashicons-hammer'></span></div>"; }	
				if ($the_access_type == "dashboard_workorder") { $work_access = "<div title='Workorder User Access Enabled'><span class='dashicons dashicons-hammer'></span></div>"; }	
									}
				
				// check ALL selection, if so add to all users
				$default_all_setting = "ALL";
				$myrevenuebooks_sqlqz = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type <> %s AND userid = %s", $security_user_check, $default_all_setting ));
				foreach ( $myrevenuebooks_sqlqz as $myrevenuebooks_sqlz ) 
				{ $the_access_type = $myrevenuebooks_sqlz->security_type;
				//page access
				if ($the_access_type == "security") { $security_access = "<div title='Security & Privacy Access'><span class='dashicons dashicons-shield'></span></div>"; }
				if ($the_access_type == "settings") { $settings_access = "<div title='Settings Access'><span class='dashicons dashicons-admin-generic'></span></div>"; }
				if ($the_access_type == "reports") { $reports_access = "<div title='Reports Access'><span class='dashicons dashicons-chart-bar'></span></div>"; }
				if ($the_access_type == "search") { $search_access = "<div title='Search Access'><span class='dashicons dashicons-search'></span></div>"; }
				//dashboard access
				if ($the_access_type == "dashboard_reminder") { $rem_access = "<div title='Reminders Access'><span class='dashicons dashicons-calendar'></span></div>"; }
				if ($the_access_type == "dashboard_pending") { $pen_access = "<div title='Pending Access'><span class='dashicons dashicons-sticky'></span></div>"; }
				if ($the_access_type == "dashboard_accounts") { $act_access = "<div title='Accounts Access'><span class='dashicons dashicons-portfolio'></span></div>"; }
				if ($the_access_type == "workorder_admin") { $work_admin = "<div title='Workorder Admin Access'><span class='dashicons dashicons-hammer'></span></div>"; }
				if ($the_access_type == "dashboard_workorder") { $work_access = "<div title='Workorder User Access'><span class='dashicons dashicons-hammer'></span></div>"; }
		
									}

				// display results
			?>
			<tr><td><span class="dashicons dashicons-admin-users"></span></td>
			<td><?php echo $mrb_user_firstname . " " . $mrb_user_lastname; ?></td>
			<td><?php echo $mrb_user_email ?></td>
			<td><?php echo $mrb_wp_user_role ?></td>
			<td width="40"><?php echo $security_access ?></td>
			<td width="40"><?php echo $settings_access ?></td>
			<td width="40"><?php echo $reports_access ?></td>
			<td width="40"><?php echo $search_access ?></td>
			<td width="40"><?php echo $rem_access ?></td>
			<td width="40"><?php echo $pen_access ?></td>
			<td width="40"><?php echo $act_access ?></td>
			<td width="40"><?php echo $work_admin ?></td>
			<td width="40"><?php echo $work_access ?></td>
			<!-- Change user roles......currently a future feature -->
			<!-- <td>
				<form name="change-user-role" method="post">
				<select name="add_user_change">
				<?php if ($mrb_user_role <> 'Administrator') { echo "<option value='Administrator'>Administrator</option>"; } ?>
				<?php if ($mrb_user_role <> 'Editor') { echo "<option value='Editor'>Editor</option>"; } ?>
				<?php if ($mrb_user_role <> 'Author') { echo "<option value='Author'>Author</option>"; } ?>
				<?php if ($mrb_user_role <> 'Contributor') { echo "<option value='Contributor'>Contributor</option>"; } ?>
				<?php if ($mrb_user_role <> 'Subscriber') { echo "<option value='Subscriber'>Subscriber</option>"; } ?>
				</select></td>
				<td>
				<input type="hidden" value="<?php echo $userid; ?>" name="the_user_id" />
				<input type="submit" name="change-security-user-role" class="button-secondary" value="Change Role" action="">
				</form>
			</td> -->
			<td align="center"><a href="admin.php?page=my-revenue-books/myrevenuebooks_security.php&r_id=<?php echo $id; ?>&t_id=<?php echo $userid; ?>&_wpnonce=<?php echo $deletenonce; ?> " style="text-decoration: none;"><div class="mrb_acct_options_del2"><span class="dashicons dashicons-trash" title="Delete User"></span></div></a></td></tr>
	<?php } ?>
	
		<?php if ($role_error <> "") { echo "<tr><td colspan='123' align='center'><font color=red>$role_error</font></td></tr>"; } ?>
		</table>



	<!-- add new users -->
	<table align="right" border="0" cellpadding="2" cellspacing="1" width="100%">
	<tr><td>&nbsp;</td></tr>
	<form name="add-user" method="post">
	<tr><td align="left" width="11%"><b>Select New User:</b></td><td>
	<select name="add_user_id">
	<!-- <option value=""></option> -->
	<?php
	//get users
	$ii=1;
	$default_id = "0";
	$default_user_email = "";
	$table_wp = $wpdb->prefix . "users";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_wp . " WHERE ID > %s AND user_email <> %s", $default_id, $default_user_email ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql )
	{
			$mrb_display_name_search = $myrevenuebooks_sql->display_name;
			$mrb_id_search_check = $myrevenuebooks_sql->ID;
	
		// check wordpress user role
			$get_mrb_wp_user_role3 = get_userdata( $mrb_id_search_check );
			if( !empty( $get_mrb_wp_user_role3->roles ) ){
    		foreach( $get_mrb_wp_user_role3->roles as $the_wp_role3 ){}  }
			$mrb_wp_user_role3 = ucwords($the_wp_role3); //current wordpress user role
			$mrb_user_role_chk = $mrb_wp_user_role3;
	
	// check for editor or administraor roles only
	if ($mrb_user_role_chk == "Editor" || $mrb_user_role_chk == "Administrator") {
		$mrb_id_search = $mrb_id_search_check;
				?>
				<option value="<?php echo htmlspecialchars($mrb_id_search); ?>"><?php echo htmlspecialchars($mrb_display_name_search); ?></option>
				<?php
					} ?>


	
	<?php
	$ii++;
			}
	?>
	</select>&nbsp;&nbsp;
	
	<!--<td>
	<select name="add_user_role">
	<option value="Administrator">Administrator</option>
	<option value="Editor">Editor</option>
	<option value="Author">Author</option>
	<option value="Contributor">Contributor</option>
	<option value="Subscriber">Subscriber</option>
	</select>
	</td> -->
	<input type="submit" name="add-security-user" class="button-secondary" value="Add New User" action="">&nbsp;&nbsp;<b><i>(Only administrators and editors can be added!)</i></b></td></tr>
	</form>
	</table>




<?php // ----------------------------------- Start default page message ----------------------------------- ?>

	<!-- add default security message to non-users -->
		<!-- add space -->
		<table align="left" border="0" cellpadding="2" cellspacing="1" width="100%">
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr></table>
		
		<table align="left" border="0" cellpadding="4" cellspacing="1" width="100%" bgcolor="#cecece">
		<tr><td width="2%"><span class="dashicons dashicons-clipboard"></span></td><td width="98%" align="left"><h3>Default message to display for all users without access:</h3></td></tr>
		</table>
	
		<table align="left" border="0" cellpadding="2" cellspacing="1" width="100%">
		<form name="add-default-security-message" method="post">
		<tr><td><textarea rows="3" cols="120" name="default_security_message_add" maxlength="5000"><?php echo htmlspecialchars($default_security_message); ?></textarea></td>
		<td><input type="submit" name="add-default-security-message" class="button-secondary" value="Add Default Message" action=""></td></tr>
		</form>
		<tr><td><i>(This message will be displayed if the user does not have access to that area.)</i></td></tr>
	</table>
		<!-- add space -->
		<table align="left" border="0" cellpadding="2" cellspacing="1" width="100%">
		<tr><td colspan="2">&nbsp;</td></tr></table>
	
<?php // ----------------------------------- End default page message ----------------------------------- ?>




<?php // ----------------------------------- Start index page options ----------------------------------- ?>


	<table align="left" border="0" cellpadding="4" cellspacing="1" width="100%" bgcolor="#cecece">
		<tr><td width="2%"><span class="dashicons dashicons-privacy"></span></td><td width="98%" align="left"><h3>User Limitation Options:</h3></td></tr>
		</table>



<?php
	
	//Security Page Access
	$mrb_security_section_color = "#9fbeff";
	$mrb_security_section_name = "Page Access - Security & Privacy";
	$mrb_security_section = "security";
	$mrb_security_section_icon = "<span class='dashicons dashicons-shield'>";
	$mrb_section = 1;
	$mrb_remove_current_users = "security";
		$mrb_form_submit_name = "add-dashboard-$mrb_security_section-userid";
		$mrb_form_post_name = "add-dashboard-$mrb_security_section-user";
		$mrb_form_select_name = "dashboard-$mrb_security_section-users"; //users

	include ("includes/security_settings.php");

	
	//Settings Page Access
	$mrb_security_section_color = "#9fbeff";
	$mrb_security_section_name = "Page Access - Settings";
	$mrb_security_section = "settings";
	$mrb_security_section_icon = "<span class='dashicons dashicons-admin-generic'>";
	$mrb_section = 2;
	$mrb_remove_current_users = "settings";
		$mrb_form_submit_name = "add-dashboard-$mrb_security_section-userid";
		$mrb_form_post_name = "add-dashboard-$mrb_security_section-user";
		$mrb_form_select_name = "dashboard-$mrb_security_section-users"; //users

	include ("includes/security_settings.php");

	
	//Reports Page Access
	$mrb_security_section_color = "#cecece";
	$mrb_security_section_name = "Page Access - Reports";
	$mrb_security_section = "reports";
	$mrb_security_section_icon = "<span class='dashicons dashicons-chart-bar'>";
	$mrb_section = 3;
	$mrb_remove_current_users = "reports";
		$mrb_form_submit_name = "add-dashboard-$mrb_security_section-userid";
		$mrb_form_post_name = "add-dashboard-$mrb_security_section-user";
		$mrb_form_select_name = "dashboard-$mrb_security_section-users"; //users

	include ("includes/security_settings.php");

	
	//Search Page Access
	$mrb_security_section_color = "#cecece";
	$mrb_security_section_name = "Page Access - Search";
	$mrb_security_section = "search";
	$mrb_security_section_icon = "<span class='dashicons dashicons-search'>";
	$mrb_section = 3;
	$mrb_remove_current_users = "search";
		$mrb_form_submit_name = "add-dashboard-$mrb_security_section-userid";
		$mrb_form_post_name = "add-dashboard-$mrb_security_section-user";
		$mrb_form_select_name = "dashboard-$mrb_security_section-users"; //users

	include ("includes/security_settings.php");
?>

<?php

	//Reminder section = 1
	$mrb_security_section_color = "#cecece";
	$mrb_security_section_name = "Dashboard - Reminders";
	$mrb_security_section = "reminder";
	$mrb_security_section_icon = "<span class='dashicons dashicons-calendar'>";
	$mrb_section = 4;
	$mrb_remove_current_users = "dashboard_reminder";
		$mrb_form_submit_name = "add-dashboard-$mrb_security_section-userid";
		$mrb_form_post_name = "add-dashboard-$mrb_security_section-user";
		$mrb_form_select_name = "dashboard-$mrb_security_section-users"; //dashboard users

	include ("includes/security_settings.php");


	//Pending section = 2
	$mrb_security_section_color = "#cecece";
	$mrb_security_section_name = "Dashboard - Pending Transactions";
	$mrb_security_section = "pending";
	$mrb_security_section_icon = "<span class='dashicons dashicons-sticky'>";
	$mrb_section = 5;
	$mrb_remove_current_users = "dashboard_pending";
		$mrb_form_submit_name = "add-dashboard-$mrb_security_section-userid";
		$mrb_form_post_name = "add-dashboard-$mrb_security_section-user";
		$mrb_form_select_name = "dashboard-$mrb_security_section-users"; //dashboard users

	include ("includes/security_settings.php");


	//Pending section = 3
	$mrb_security_section_name = "Dashboard - Accounts";
	$mrb_security_section = "accounts";
	$mrb_security_section_icon = "<span class='dashicons dashicons-portfolio'>";
	$mrb_section = 6;
	$mrb_remove_current_users = "dashboard_accounts";
		$mrb_form_submit_name = "add-dashboard-$mrb_security_section-userid";
		$mrb_form_post_name = "add-dashboard-$mrb_security_section-user";
		$mrb_form_select_name = "dashboard-$mrb_security_section-users"; //dashboard users

	include ("includes/security_settings.php");
	
	
// start of workorder add-on
	?>
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%" id="S2">
	<tr><td> </td></tr>
	<tr><td align="middle">Be sure to check the workorder <a href="admin.php?page=my-revenue-books/myrevenuebooks_settings.php#S1">settings</a> before using this feature!</td></tr>
	</table>
	<?php
	
	//Workorder section = 4 - add aministrators
	$mrb_security_section_color = "#fdd700";
	$mrb_security_section_name = "Workorders: Administrators";
	$mrb_security_section = "workorder_admin";
	$mrb_security_section_icon = "<span class='dashicons dashicons-hammer'>";
	$mrb_section = 6;
	$mrb_remove_current_users = "workorder_admin";
		$mrb_form_submit_name = "add-dashboard-$mrb_security_section-userid";
		$mrb_form_post_name = "add-dashboard-$mrb_security_section-user";
		$mrb_form_select_name = "dashboard-$mrb_security_section-users"; //dashboard users

	include ("includes/security_settings.php");

	//Workorder section = 5 - add users
	$mrb_security_section_color = "#fdd700";
	$mrb_security_section_name = "Workorders: Users";
	$mrb_security_section = "workorder";
	$mrb_security_section_icon = "<span class='dashicons dashicons-hammer'>";
	$mrb_section = 6;
	$mrb_remove_current_users = "dashboard_workorder";
		$mrb_form_submit_name = "add-dashboard-$mrb_security_section-userid";
		$mrb_form_post_name = "add-dashboard-$mrb_security_section-user";
		$mrb_form_select_name = "dashboard-$mrb_security_section-users"; //dashboard users

	include ("includes/security_settings.php");

// end workorder add-on
?>



<?php // ----------------------------------- End index page options ----------------------------------- ?>


<?php } ?> <!-- end if the security option is enabled, display the options -->


<?php
} // end if security is enabled and security access is true
?>

<?php
} // end if a valid user is found
?>
</div> <!-- mrb_main_wrapper from header.php -->