<?php
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Help";

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

?>


<table align="left" border="0" cellpadding="10" cellspacing="0" width="100%">
<tr><td><span class="dashicons dashicons-buddicons-topics"></span></td><td><b>Help Topics:</b></td></tr>

<tr><td><span class="dashicons dashicons-hammer"></span></td><td>New to 5.1.0 is workorders.  You can assign users to do job tasks.  You have two options, administrators and users that you can assign in the <a href='admin.php?page=my-revenue-books/myrevenuebooks_security.php' style='text-decoration: none'><b>security & privacy options</b></a> page and you must complete the workorder <a href='admin.php?page=my-revenue-books/myrevenuebooks_settings.php' style='text-decoration: none'><b>settings</b></a> before using this feature!  Workorder administrators will have access to all of the workorders for all users.  Administrators will be able to add new workorders, edit open or closed workorders, and they will have workorder search capabilities.  Workorder users will only have access to their workorders.  Users will be able to add new workorders, edit their open orders only, and no workorder search capabilities.  Take note that users will not be able to edit any closed workorders.</td></tr>



<tr bgcolor="#ffffff"><td><span class="dashicons dashicons-shield"></span></td><td>New to 5.0.0, you now have security and privacy options.  To add a user, first they must be a editor or an administrator in Wordpress.  You can go to the Wordpress users page and change their role for each user that you want to add.  Once they are either an editor or an administrator, you will be able to add them in the <a href='admin.php?page=my-revenue-books/myrevenuebooks_security.php' style='text-decoration: none'><b>security & privacy</b></a> page settings.</td></tr>

<tr><td><span class="dashicons dashicons-shield"></span></td><td>Why can't I see all of the users in the dropdown in the security & privacy page?  All users must be a editor or and administrator in Wordpress.</td></tr>

<tr bgcolor="#ffffff"><td><span class="dashicons dashicons-shield"></span></td><td>How do I left access to users?  Go to the <a href='admin.php?page=my-revenue-books/myrevenuebooks_security.php' style='text-decoration: none'><b>security & privacy page</b></a> and scroll down.  You can set certain sections to "all users", select one user or you can select multiple users in the drop-down menu.</td></tr>

<tr><td><span class="dashicons dashicons-shield"></span></td><td>Do I have to enable the <a href='admin.php?page=my-revenue-books/myrevenuebooks_security.php' style='text-decoration: none'><b>security & privacy</b></a> options?  No if you do not enable it, MRB will work as usual and all editors and administrators will have full access.</td></tr>

<tr bgcolor="#ffffff"><td></td><td></td></tr>
<tr><td></td><td></td></tr>
<tr><td></td><td></td></tr>

</table>









	

<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->