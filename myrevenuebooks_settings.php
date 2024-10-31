<?php
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
//$update_status = "N";
//check for security options
$mrb_page = "Settings";

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
if (!empty($_POST['edit-submit'])) {

//$update_status="Y";
include ("includes/clean_settings.php");

$last_edited = date("m-d-Y")." ".date("H").":".date("i").":".date("s");

	// checkfor cron interval change.  If so, remove the old and add the new.
	if ($current_cron != $cron_interval) {
		$interval = $cron_interval;
			
			//wp_clear_scheduled_hook('myrevenuebooks_cron_event'); // clear current myrevenuebooks_cron_event
			wp_clear_scheduled_hook('myrevenuebooks_cronjob'); // clear current myrevenuebooks_cronjob
			
		if ($interval == 'weekly') { if( !wp_next_scheduled( 'myrevenuebooks_cronjob' ) ) { wp_schedule_event( time(), 'weekly', 'myrevenuebooks_cronjob' ); }}
		if ($interval == 'twicedaily') if( !wp_next_scheduled( 'myrevenuebooks_cronjob' ) ) { { wp_schedule_event( time(), 'twicedaily', 'myrevenuebooks_cronjob' ); }}
		//if ($interval == 'hourly') { if( !wp_next_scheduled( 'myrevenuebooks_cronjob' ) ) { wp_schedule_event( time(), 'hourly', 'myrevenuebooks_cronjob' ); }}
		//if ($interval == 'oneminute') { if( !wp_next_scheduled( 'myrevenuebooks_cronjob' ) ) { wp_schedule_event( time(), 'oneminute', 'myrevenuebooks_cronjob' ); }}
		if ($interval == 'off') { wp_clear_scheduled_hook('myrevenuebooks_cronjob'); }
    	else { if( !wp_next_scheduled( 'myrevenuebooks_cronjob' ) ) { wp_schedule_event( time(), 'daily', 'myrevenuebooks_cronjob' ); }} // default
	}


$table = $wpdb->prefix . "myrevenuebooks";
$id = 1;

$wpdb->query($wpdb->prepare("UPDATE $table SET 
		business_name = %s,
		contact_name = %s,
		address = %s,
		address2 = %s,
		city = %s,
		state = %s,
		zip = %s,
		email = %s,
		email_template1 = %s,
		phone = %s,
		phone2 = %s,
		fax = %s,
		website = %s,
		business_logo = %s,
		business_info = %s,
		payment_terms = %s,
		last_edited = %s,
		cron_interval = %s,
		mrb_uninstall = %s,
		mrb_settings = %s
WHERE id = $id;", 
		$business_name,
		$contact_name,
		$address,
		$address2,
		$city,
		$state,
		$zip,
		$email,
		$email_template1,
		$phone,
		$phone2,
		$fax,
		$website,
		$business_logo,
		$business_info,
		$payment_terms,
		$last_edited,
		$cron_interval,
		$mrb_uninstall,
		$mrb_settings
			));
			
//	if ($update_status == "Y") {	
//	echo "<table align='left' border='0' cellpadding='4' cellspacing='0' width='1000px'>";
//	echo "<tr><td><h2><br>Your Information has been updated!</h2><br></td></tr></table>";				
//	}
	
	}
?>



<?php
//change the workorder email subject
if (!empty($_POST['edit-subject'])) {
	$workorder_id = stripslashes( $_POST['workorder_id'] );
	if ( ! $workorder_id ) { $workorder_id = ''; }
	if ( strlen( $workorder_id ) > 200 ) { $workorder_id = substr( $workorder_id, 0, 200 ); }
	
	$workorder_subject = stripslashes( $_POST['workorder_subject'] );
	if ( ! $workorder_subject ) { $workorder_subject = ''; }
	if ( strlen( $workorder_subject ) > 200 ) { $workorder_subject = substr( $workorder_subject, 0, 200 ); }

	$workorder_subject_change = stripslashes( $_POST['workorder_subject_change'] );
	if ( ! $workorder_subject_change ) { $workorder_subject_change = ''; }
	if ( strlen( $workorder_subject_change ) > 200 ) { $workorder_subject_change = substr( $workorder_subject_change, 0, 200 ); }	
	
	$workorder_details = stripslashes( $_POST['workorder_details'] );
	if ( ! $workorder_details ) { $workorder_details = ''; }
	if ( strlen( $workorder_details ) > 900000 ) { $workorder_details = substr( $workorder_details, 0, 900000 ); }
	
	$workorder_new_order_notify = stripslashes( $_POST['workorder_new_order_notify'] );
	if ( ! $workorder_new_order_notify ) { $workorder_new_order_notify = ''; }
	if ( strlen( $workorder_new_order_notify ) > 100 ) { $workorder_new_order_notify = substr( $workorder_new_order_notify, 0, 100 ); }
	
	$workorder_order_change_notify = stripslashes( $_POST['workorder_order_change_notify'] );
	if ( ! $workorder_order_change_notify ) { $workorder_order_change_notify = ''; }
	if ( strlen( $workorder_order_change_notify ) > 100 ) { $workorder_order_change_notify = substr( $workorder_order_change_notify, 0, 100 ); }
	
	$workorder_admin_email = stripslashes( $_POST['workorder_admin_email'] );
	if ( ! $workorder_admin_email ) { $workorder_admin_email = ''; }
	if ( strlen( $workorder_admin_email ) > 500 ) { $workorder_admin_email = substr( $workorder_admin_email, 0, 500 ); }
	

	
	$table_security = $wpdb->prefix . "myrevenuebooks_security";
	$wpdb->query($wpdb->prepare("UPDATE $table_security SET 
		workorder_subject = %s,
		workorder_subject_change = %s,
		workorder_details = %s,
		workorder_new_order_notify = %s,
		workorder_order_change_notify = %s,
		workorder_admin_email = %s
		WHERE id = $workorder_id;", 
		$workorder_subject,
		$workorder_subject_change,
		$workorder_details,
		$workorder_new_order_notify,
		$workorder_order_change_notify,
		$workorder_admin_email
			));
}
?>





<?php
	$table = $wpdb->prefix . "myrevenuebooks";
	$the_id = 1;
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s", $the_id  ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$business_name = $myrevenuebooks_sql->business_name;
	$contact_name = $myrevenuebooks_sql->contact_name;
	$address = $myrevenuebooks_sql->address;
	$address2 = $myrevenuebooks_sql->address2;
	$city = $myrevenuebooks_sql->city;
	$state = $myrevenuebooks_sql->state;
	$zip = $myrevenuebooks_sql->zip;
	$email = $myrevenuebooks_sql->email;
	$email_template1 = $myrevenuebooks_sql->email_template1;
	$phone = $myrevenuebooks_sql->phone;
	$phone2 = $myrevenuebooks_sql->phone2;
	$fax = $myrevenuebooks_sql->fax;
	$website = $myrevenuebooks_sql->website;
	$business_logo = $myrevenuebooks_sql->business_logo;
	$business_info = $myrevenuebooks_sql->business_info;
	
	$payment_terms = $myrevenuebooks_sql->payment_terms;
	
	$cron_interval = $myrevenuebooks_sql->cron_interval;
		if($cron_interval == '') { $cron_interval = "daily"; }
	$current_cron = $cron_interval; // get the current values
	$mrb_uninstall = $myrevenuebooks_sql->mrb_uninstall;
		if (! $mrb_uninstall) {$mrb_uninstall = "no";}
	$mrb_settings = $myrevenuebooks_sql->mrb_settings;
		if (! $mrb_settings) {$mrb_settings = "init";}
	}
	$next_cron_schedule = wp_next_scheduled( 'myrevenuebooks_cronjob' );
?>

			<?php
			//get the workorder settings
			$workorder_subject = "New workorder from $business_name"; //default
			$workorder_details = ""; //default
			$table_security = $wpdb->prefix . "myrevenuebooks_security";
    		$security_option_query = "Disabled"; //default
    		$security_option_query2 = "Enabled"; //default
    		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_option = %s OR security_option = %s", $security_option_query, $security_option_query2 ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ 
				$workorder_id = $myrevenuebooks_sql->id;
				$workorder_subject = $myrevenuebooks_sql->workorder_subject;
				$workorder_subject_change = $myrevenuebooks_sql->workorder_subject_change;
				$workorder_details = $myrevenuebooks_sql->workorder_details;
				$workorder_new_order_notify = $myrevenuebooks_sql->workorder_new_order_notify;
					if ($workorder_new_order_notify == "") { $workorder_new_order_notify = "Yes"; }
				$workorder_order_change_notify = $myrevenuebooks_sql->workorder_order_change_notify;
					if ($workorder_order_change_notify == "") { $workorder_order_change_notify = "Yes"; }
				$workorder_admin_email = $myrevenuebooks_sql->workorder_admin_email;
			}
?>




<?php
	//user not valid notice
	if ($the_security_option == "Enabled" && $mrb_current_user_id == 0) {
	echo $default_security_message . "<br>"; }
	?>
	
	<?php
	//if the user does not have access to settings
	if ($the_security_option == "Enabled" && $security_settings_access == "false") { ?>
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
	if ($the_security_option == "Enabled" && $security_settings_access == "true" || $the_security_option == "Disabled") {
	?>










<!-- Start main setting options -->
<div id="mrb_wrapper">
	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr><td width="2%" align="left"><div class="mrb_wrapper_text"><span class="dashicons dashicons-admin-generic"></span></div></td>
	<td align="left"><div class="mrb_wrapper_text"><?php echo "Main Settings:"; ?></div></td></tr>
	</table>
</div>



<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
<form name="editlisting" method="post">
	<tr bgcolor="#ffffff"><td width="130"><b>*Business Name:</b></td>
	<td><input type="text" name="business_name" value="<?php echo htmlspecialchars($business_name); ?>" size="45" maxlength="200" required></td></tr>

	<tr><td><b>Contact Name (Full):</b></td>
	<td><input type="text" name="contact_name" value="<?php echo htmlspecialchars($contact_name); ?>" size="45" maxlength="200"></td></tr>

	<tr bgcolor="#ffffff"><td><b>Address:</b></td>
	<td><input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" size="60" maxlength="200"></td></tr>

	<tr><td><b>Address line 2:</b></td>
	<td><input type="text" name="address2" value="<?php echo htmlspecialchars($address2); ?>" size="60" maxlength="200"></td></tr>
</table>

<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<tr bgcolor="#ffffff"><td width="130px" align="left"><b>City:</b></td>
	<td align="left" width="300px"><input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>" size="35" maxlength="200"></td>
	<td align="left" width="40px"><b>State:</b></td>
	<td align="left" width="130px"><input type="text" name="state" value="<?php echo htmlspecialchars($state); ?>" size="10" maxlength="200"></td>
	<td align="left" width="30px"><b>Zip:</b></td>
	<td align="left"><input type="text" name="zip" value="<?php echo htmlspecialchars($zip); ?>" size="10" maxlength="200"></td></tr>
</table>

<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<tr><td width="130px"><b>Phone:</b></td>
	<td align="left" width="190px"><input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" size="20" maxlength="100"></td>
	<td align="left" width="90px"><b>Phone Addl:</b></td>
	<td align="left" width="190px"><input type="text" name="phone2" value="<?php echo htmlspecialchars($phone2); ?>" size="20" maxlength="100"></td>
	<td><b>Fax:</b></td>
	<td><input type="text" name="fax" value="<?php echo htmlspecialchars($fax); ?>" size="20" maxlength="100"></td></tr>
</table>


<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<tr bgcolor="#ffffff"><td width="130"><b>*Email Address:</b></td>
	<td><input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" size="45" maxlength="100" required><i>*All notices and email reminders will be sent/received by this email address.</i></td></tr>

	<tr><td><b>Website URL:</b></td>
	<td><input type="text" name="website" value="<?php echo htmlspecialchars($website); ?>" size="45" maxlength="100"></td></tr>
</table>


<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<tr bgcolor="#ffffff"><td width="130"><b>Business logo:</b></td>
<td>
<table align="left" border="0" cellpadding="0" cellspacing="0" width="95%">
			<tr>
				<td><label for="upload_image">
					<input id="upload_image" type="text" size="100" name="ad_image" value="<?php echo htmlspecialchars($business_logo); ?>" style='font-size:11px' /><br>
					<input id="upload_image_button" class="button" type="button" value="Upload/Select Image" />&nbsp;&nbsp;*Enter the URL or click on upload/select an image.</td>
				<td><img src="<?php echo $business_logo; ?>" width="80"><br></td></tr>
			</label></td></tr></table>
</td></tr></table>	

<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
<tr><td width="130"><b>Business Info/Notes:</b></td>
<td><textarea rows="3" cols="105" name="business_info" maxlength="5000"><?php echo htmlspecialchars($business_info); ?></textarea></td></tr>
</table>

<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
<tr><td width="130"><b>Payment Terms (net):</b></td>
<td><input type="text" name="payment_terms" value="<?php echo htmlspecialchars($payment_terms); ?>" size="15" maxlength="15"></td></tr>
</table>






<!-- reminder setup -->
<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%" bgcolor="cecece">
<tr><td width="22px" align="left"><span class="dashicons dashicons-calendar"></span></td><td align="left"><b>Reminders: Email Template</b></td></tr>
</table>

<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
<tr bgcolor="#ffffff"><td valign="top" bgcolor="#ffffff">
<i>Template Tags:</i></br>
<font size="1"><font color="green"><b>[:primary_contact:]</b></font> = Primary Contact<br>
<font color="green"><b>[:mrb_business_name:]</b></font> =  Business Name<br>
<font color="green"><b>[:po_ref:]</b></font> = PO/INV#<br>
<font color="green"><b>[:the_ref:]</b></font> = Reference<br>
<font color="green"><b>[:campaign_start:]</b></font> = Start<br>
<font color="green"><b>[:campaign_end:]</b></font> = End<br>
<font color="green"><b>[:duration:]</b></font> = Duration<br>
<font color="green"><b>[:description:]</b></font> = Description<br>
<font color="green"><b>[:ad_html:]</b></font> = Ad HTML<br>
<font color="green"><b>[:payment_type:]</b></font> = Payment Type<br>
<font color="green"><b>[:payment_details:]</b></font> = Payment Details<br>
<font color="green"><b>[:amount:]</b></font> = Amount<br>
<font color="green"><b>[:status:]</b></font> = Status</font>
</td>
<td><textarea rows="15" cols="118" name="email_template1" maxlength="5000"><?php echo htmlspecialchars($email_template1); ?></textarea><br><i>*Default email template for your reminders.</i></td></tr>
<tr><td></td><td></td></tr>
</table>



<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%" bgcolor="#d5d5d5">
<tr><td><span class="dashicons dashicons-database-remove"></span><b>Uninstall Options:</b> You can choose to keep or remove your information and settings.  *Note this action is <b>not reversable</b> and all information will be lost if you choose the option to remove everything while uninstalling this plugin.  If you are just deactivating the plugin, no information will be lost.</td></tr>
<tr><td align="left">Do you want to remove all information during uninstall? 
<select name="mrb_uninstall" value="">SelectUninstall</option>
	<?php if ($mrb_uninstall == "no") { ?>
		<option value="<?php echo htmlspecialchars($mrb_uninstall); ?>"><?php echo htmlspecialchars($mrb_uninstall); ?></option>
		<option value="yes">yes</option> <?php } ?>
	<?php if ($mrb_uninstall == "yes") { ?>
		<option value="<?php echo htmlspecialchars($mrb_uninstall); ?>"><?php echo htmlspecialchars($mrb_uninstall); ?></option>
		<option value="no">no</option> <?php } ?>
</select></td></tr></table>



<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
<tr bgcolor="#ffffff"><td width="200"><span class="dashicons dashicons-calendar"></span><b>Reminder Schedule:</b></td>
<td><select name="cron_interval" value="">SelectSchedule</option>
<option value="<?php echo htmlspecialchars($cron_interval); ?>"><?php echo htmlspecialchars($cron_interval); ?></option>
<option value="weekly">Weekly</option>
<option value="daily">Daily</option>
<option value="twicedaily">Twicedaily</option>
<option value="hourly">Hourly</option>
<!-- <option value="oneminute">1 Minute</option> -->
<option value="off">Off</option>
</select> Next Reminder: <?php echo date('M d Y H:i:s',$next_cron_schedule); ?>
</td></tr>

<tr bgcolor="#ffffff"><td colspan="2">
	<i>You will receive a email reminder for all transactions that you have set a reminder for.  To turn off email reminders, set to "off".</i><br>
	<i>*Be sure to add your email address above or you will not receive any reminders!</i>
</td></tr>

<input type="hidden" value="<?php echo htmlspecialchars($current_cron); ?>" name="current_cron" />
<input type="hidden" value="setup" name="mrb_settings" />

<tr><td colspan="2" height="45" align="center"><input type="submit" name="edit-submit" class="button-primary" value="Update Main Settings" /></td></tr>
<tr><td height="10px">&nbsp;</td></tr>
</table>
</form>
<!-- end main setting options -->






<!-- customize view options start -->
<div id="mrb_wrapper">
	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr><td width="2%" align="left"><div class="mrb_wrapper_text"><span class="dashicons dashicons-admin-customizer"></span></div></td>
	<td align="left"><div class="mrb_wrapper_text"><?php echo "Customize View Options:"; ?></div></td></tr>
	</table>
</div>





<?php
	//////////// REMINDER SETTINGS ////////////////
	$bgcolor = "";
	$mrb_cust_set = "reminder";
	$security_type_default_['mrb_cust_set'] = "dashboard_reminder";
	$table_custom = $wpdb->prefix . "myrevenuebooks_security";
	$mrb_setting_title = "Current Reminder Column Settings:";
	$mrb_dashicon_setting = "<span class='dashicons dashicons-calendar'></span>";
	include ("includes/custom_settings_template.php");
	//////////// END REMINDER SETTINGS ////////////////


//////////// PENDINGS SETTINGS ////////////////
	$bgcolor = "#ffffff";
	$mrb_cust_set = "pending";
	$security_type_default_['mrb_cust_set'] = "dashboard_pending";
	$table_custom = $wpdb->prefix . "myrevenuebooks_security";
	$mrb_setting_title = "Current Pending Column Settings:";
	$mrb_dashicon_setting = "<span class='dashicons dashicons-sticky'></span>";
	include ("includes/custom_settings_template.php");
//////////// END PENDINGS SETTINGS ////////////////


//////////// ACCOUNT SETTINGS ////////////////
	$bgcolor = "";
	$mrb_cust_set = "accounts";
	$security_type_default_['mrb_cust_set'] = "dashboard_accounts";
	$table_custom = $wpdb->prefix . "myrevenuebooks_security";
	$mrb_setting_title = "Current Account Column Settings: <i>(Note, only the column colors can be changed at this time)</i>";
	$mrb_dashicon_setting = "<span class='dashicons dashicons-portfolio'></span>";
	include ("includes/custom_settings_template.php");
//////////// END ACCOUNT SETTINGS ////////////////


?>

	<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<tr><td>&nbsp;</td></tr>
	</table>
<div id="mrb_workorder_wrapper2">
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%" id="S1">
	<tr><td width="22px" align="left"><span class="dashicons dashicons-hammer"></span></td><td align="left"><b>Workorders: Setup</b></td>
	<td align="right">Be sure to check the workorder <a href="admin.php?page=my-revenue-books/myrevenuebooks_security.php#S2">security & privacy settings</a> before using this feature!</td></tr>
	</table>
</div>
<?php



//////////// WORKORDER SETTINGS ////////////////
	$bgcolor = "#ffffff";
	$mrb_cust_set = "workorder";
	$security_type_default_['mrb_cust_set'] = "dashboard_workorder";
	$table_custom = $wpdb->prefix . "myrevenuebooks_security";
	$mrb_setting_title = "Current Workorder Column Settings:";
	$mrb_dashicon_setting = "<span class='dashicons dashicons-hammer'></span>";
	include ("includes/custom_settings_template.php");
//////////// END WORKORDER SETTINGS ////////////////
?>

<!-- start workorder email setup -->
<form name="edit-subject" method="post">
<input type="hidden" value="<?php echo $workorder_id; ?>" name="workorder_id" />


<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
<?php 
$mrb_admin_email = get_bloginfo('admin_email'); ?>
<tr><td align="left" width="150" valign="top"><b>Admin email address for all notices:</b></td>
		<td valign="top"><input type="text" name="workorder_admin_email" value="<?php echo htmlspecialchars($workorder_admin_email); ?>" size="50" maxlength="500">
			<b><i><font color="#950000">&nbsp;*You can only enter <b><u>one</u></b> email address or you will not receive any notices</font></i></b>
			<br><i>If left empty, the default 'from' email address will be the one that you have entered in the main settings!</i> ( <?php echo $email; ?> )</i>
		</td></tr>
<tr><td></td><td></td></tr>
</table>

<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%" bgcolor="#ffffff">
<tr><td align="left" width="150" valign="top"><b>New Workorder Email Subject Line:</b></td>
	<td><input type="text" name="workorder_subject" value="<?php echo htmlspecialchars($workorder_subject); ?>" size="121" maxlength="200">
	<br><i>*The default settings are 'New workorder from <?php echo $business_name; ?>'</i></td></tr>
<tr><td></td><td></td></tr>
</table>

<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
<form name="edit-subject" method="post">
	<input type="hidden" value="<?php echo $workorder_id; ?>" name="workorder_id" />
<tr><td align="left" width="150" valign="top"><b>Changed Workorder Email Subject Line:</b></td>
	<td><input type="text" name="workorder_subject_change" value="<?php echo htmlspecialchars($workorder_subject_change); ?>" size="121" maxlength="200">
	<br><i>*The default settings are 'Changes have been made for the workorder # at <?php echo $business_name; ?>'</i></td></tr>
<tr><td></td><td></td></tr>
</table>

<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%" bgcolor="#ffffff">
<tr><td align="left" width="150" valign="top"><b>Workorder change notifications:</b></td>
	<td align="left" width="300px"><b>Email the assigned user(s) or each new workorder?</b></td>
	<td align="left" width="80"><select name="workorder_new_order_notify" value="">SelectSchedule</option>
		<option value="<?php echo htmlspecialchars($workorder_new_order_notify); ?>"><?php echo htmlspecialchars($workorder_new_order_notify); ?></option>
		<?php if ($workorder_new_order_notify <> "Yes") { echo "<option value='Yes'>Yes</option>"; } ?>
		<?php if ($workorder_new_order_notify <> "No") { echo "<option value='No'>No</option>"; } ?>
</select>
	</td>
	<td align="left" width="285px"><b>Email the administrator for each order change?</b></td>
		<td align="left"><select name="workorder_order_change_notify" value="">SelectSchedule</option>
		<option value="<?php echo htmlspecialchars($workorder_order_change_notify); ?>"><?php echo htmlspecialchars($workorder_order_change_notify); ?></option>
		<?php if ($workorder_order_change_notify <> "Yes") { echo "<option value='Yes'>Yes</option>"; } ?>
		<?php if ($workorder_order_change_notify <> "No") { echo "<option value='No'>No</option>"; } ?>
	</td></tr>
	<tr><td></td><td colspan="4"><i>Each new order will send out an email to the user(s) and each order change (assigned or status changes) will send an email to the administrator</i></td></tr>

</table>



<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
<tr><td align="left" valign="top" width="150"><b>Workorders Details Template:</b> <i>This will be included in the order details for all new workorders as default.</i></td>
	<td><textarea rows="7" cols="124" name="workorder_details" maxlength="900000"><?php echo htmlspecialchars($workorder_details); ?></textarea></td>

</tr>
<tr><td colspan="2" align="right"><input type="submit" name="edit-subject" class="button-primary" value="Submit Workorder Changes" /></td></tr>
</form>
</table>
<!-- end workorder email setup -->








<?php
} // end if security is enabled and security access is true
?>

<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->