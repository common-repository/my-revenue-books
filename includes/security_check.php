<?php
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

	//set defaults for dashboard
	$security_reminder_access = "false"; //default
	$security_pending_access = "false"; //default
	$security_accounts_access = "false"; //default
	$security_security_access = "false"; //default
	$security_settings_access = "false"; //default
	$security_reports_access = "false"; //default
	$security_search_access = "false"; //default
	$security_work_admin = "false"; //default
	$security_work_access = "false"; //default
	
	// check to see if the security feature is enabled
	$the_security_option = ""; //default
	$security_option_check = "";
	$userid_check = "";
	$table_security = $wpdb->prefix . "myrevenuebooks_security";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_option <> %s AND id <> %s", $security_option_check, $userid_check ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $the_security_option = $myrevenuebooks_sql->security_option; 
		$default_security_message = $myrevenuebooks_sql->default_security_message; } 
	
	// disabled security option output
	//if ($the_security_option == "Disabled") { echo "Security is disabled<br>"; }
	
	//check if the current user has a role
	if ($the_security_option == "Enabled") { 
			
			$mrb_current_user_role = 0; //defaults
			$user_role_level_check = 0; //defaults
			$mrb_current_user_id = 0; //defaults
			$mrb_current_user_role_level = 0; //defaults
			
			$table_security2 = $wpdb->prefix . "myrevenuebooks_security";
			$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security2 . " WHERE userid = %s AND user_role <> %s", $mrb_user_id, $user_role_level_check ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ 
				$mrb_current_user_id = $myrevenuebooks_sql->userid; 
				$mrb_current_user_role = $myrevenuebooks_sql->user_role; 
				$mrb_current_user_role_level = $myrevenuebooks_sql->user_role_level;	}
				
				
//dashboard check

if ($mrb_page == "Dashboard" || $mrb_page == "Accounts" || $mrb_page == "Security" || $mrb_page == "Settings" || $mrb_page == "Reports" || $mrb_page == "Link Report" || $mrb_page == "Workorders Dashboard" || $mrb_page == "Edit Transaction" || $mrb_page == "Search" || $mrb_page == "Help" || $mrb_page == "Transactions") {
		// check to see if the user has reminder access if security is enabled
		$security_reminder_query1 = "dashboard_reminder"; //query for the dashboard reminder section
		$security_pending_query2 = "dashboard_pending"; //query for the dashboard pending section
		$security_accounts_query3 = "dashboard_accounts"; //query for the dashboard accounts section
		$security_accounts_query4 = "security";
		$security_accounts_query5 = "settings";
		$security_accounts_query6 = "reports";
		$security_accounts_query7 = "search";
		$security_accounts_query8 = "workorder_admin";
		$security_accounts_query9 = "dashboard_workorder";
		
	$security_type_query = "User";
	$security_userid_query = "0";
	$security_reminder_query = "";
	$security_type_check = ""; //default
	$security_userid_check = ""; //default
	$security_allusers = "ALL"; //default
	$reminder_users = ""; //default
	$pending_users = ""; //default
	$accounts_users = ""; //default
	
	$table_security = $wpdb->prefix . "myrevenuebooks_security";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type <> %s AND userid <> %s", $security_type_query, $security_userid_query ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $security_type_check = $myrevenuebooks_sql->security_type;
		$security_userid_check = $myrevenuebooks_sql->userid;
		//check dashboard reminder
		if ($security_type_check == $security_reminder_query1){ 
			if ($security_userid_check == $security_allusers) { $security_reminder_access = "true"; }
			if ($security_userid_check == $mrb_user_id) { $security_reminder_access = "true"; }
				}
		//check dashboard pending
		if ($security_type_check == $security_pending_query2){ 
			if ($security_userid_check == $security_allusers) { $security_pending_access = "true"; }
			if ($security_userid_check == $mrb_user_id) { $security_pending_access = "true"; }
				}
		//check dashboard accounts
		if ($security_type_check == $security_accounts_query3){ 
			if ($security_userid_check == $security_allusers) { $security_accounts_access = "true"; }
			if ($security_userid_check == $mrb_user_id) { $security_accounts_access = "true"; }
				}
		//check security access
		if ($security_type_check == $security_accounts_query4){ 
			if ($security_userid_check == $security_allusers) { $security_security_access = "true"; }
			if ($security_userid_check == $mrb_user_id) { $security_security_access = "true"; }
				}
		//check settings access
		if ($security_type_check == $security_accounts_query5){ 
			if ($security_userid_check == $security_allusers) { $security_settings_access = "true"; }
			if ($security_userid_check == $mrb_user_id) { $security_settings_access = "true"; }
				}
		//check reports access
		if ($security_type_check == $security_accounts_query6){ 
			if ($security_userid_check == $security_allusers) { $security_reports_access = "true"; }
			if ($security_userid_check == $mrb_user_id) { $security_reports_access = "true"; }
				}
				
		//check search access
		if ($security_type_check == $security_accounts_query7){ 
			if ($security_userid_check == $security_allusers) { $security_search_access = "true"; }
			if ($security_userid_check == $mrb_user_id) { $security_search_access = "true"; }
				}			
				
		//check workorder access
		if ($security_type_check == $security_accounts_query8){ 
			if ($security_userid_check == $security_allusers) { $security_work_admin = "true"; }
			if ($security_userid_check == $mrb_user_id) { $security_work_admin = "true"; }	
				}
		
		if ($security_type_check == $security_accounts_query9){ 
			if ($security_userid_check == $security_allusers) { $security_work_access = "true"; }
			if ($security_userid_check == $mrb_user_id) { $security_work_access = "true"; }
				}
				
				
	}		
	
} //end dashboard check
				
		
				
				
				} //end security option check

?>