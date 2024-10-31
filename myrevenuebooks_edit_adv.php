<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Edit Account";

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



if (!empty($_POST['edit-submit'])) {

$update_status="Y";
include ("includes/clean_add.php");

	if ($business_logo == "") {
	$plugins_url = plugins_url();
	$business_logo = plugins_url( 'images/money_fist.png', __FILE__ );
	}

	$the_bus_id = stripslashes( $_POST['the_bus_id'] );
	if ( ! $the_bus_id ) { $the_bus_id = ''; }
	if ( strlen( $the_bus_id ) > 200 ) { $the_bus_id = substr( $the_bus_id, 0, 200 ); }

$last_edited = date("m-d-Y")." ".date("H").":".date("i").":".date("s");

$table = $wpdb->prefix . "myrevenuebooks";

$wpdb->query($wpdb->prepare("UPDATE $table SET 
		business_name = %s,
		contact_name = %s,
		address = %s,
		address2 = %s,
		city = %s,
		state = %s,
		zip = %s,
		email = %s,
		secondary_contact = %s,
		secondary_email = %s,
		phone = %s,
		phone2 = %s,
		fax = %s,
		website = %s,
		business_logo = %s,
		business_info = %s,
		last_edited = %s
WHERE business_id = $business_id AND id = $the_bus_id;", 
		$business_name,
		$contact_name,
		$address,
		$address2,
		$city,
		$state,
		$zip,
		$email,
		$secondary_contact,
		$secondary_email,
		$phone,
		$phone2,
		$fax,
		$website,
		$business_logo,
		$business_info,
		$last_edited
			));

			
	if ($update_status == "Y") {	
	echo "<table align='left' border='0' cellpadding='4' cellspacing='0' width='1000px'>";
	echo "<tr><td><h2><br>$business_name has been updated!</h2><br></td></tr></table>";
	}					
	
	}
?>








<?php

	$the_id = sanitize_text_field( $_REQUEST['id'] );
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s", $the_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$the_bus_id = $myrevenuebooks_sql->id;
	$business_name = $myrevenuebooks_sql->business_name;
	$business_id = $myrevenuebooks_sql->business_id;
	$contact_name = $myrevenuebooks_sql->contact_name;
	$address = $myrevenuebooks_sql->address;
	$address2 = $myrevenuebooks_sql->address2;
	$city = $myrevenuebooks_sql->city;
	$state = $myrevenuebooks_sql->state;
	$zip = $myrevenuebooks_sql->zip;
	$email = $myrevenuebooks_sql->email;
	$phone = $myrevenuebooks_sql->phone;
	$phone2 = $myrevenuebooks_sql->phone2;
	$fax = $myrevenuebooks_sql->fax;
	$website = $myrevenuebooks_sql->website;
	$business_logo = $myrevenuebooks_sql->business_logo;
	$business_info = $myrevenuebooks_sql->business_info;
	$secondary_contact = $myrevenuebooks_sql->secondary_contact;
	$secondary_email = $myrevenuebooks_sql->secondary_email;
	}

?>



<table align="left" border="0" cellpadding="2" cellspacing="0" width="1000px">
<form name="editlisting" method="post">

<input type="hidden" value="<?php echo htmlspecialchars($business_id); ?>" name="business_id" />
<input type="hidden" value="<?php echo htmlspecialchars($the_bus_id); ?>" name="the_bus_id" />

<tr><td colspan="2"><h2><span class="dashicons dashicons-businessperson"></span> <b>Update Account:</b></h2></td></tr>


<tr><td width="150px"><b>Business Name:</b></td>
<td><input placeholder="*Required" type="text" name="business_name" value="<?php echo htmlspecialchars($business_name); ?>" size="70" maxlength="200"></td></tr>

<tr><td><b>Address:</b></td>
<td><input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" size="70" maxlength="200"></td></tr>

<tr><td><b>Address line 2:</b></td>
<td><input type="text" name="address2" value="<?php echo htmlspecialchars($address2); ?>" size="70" maxlength="200"></td></tr>
</table>

<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
<tr><td width="150px"><b>City:</b></td><td width="290px"><input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>" size="40" maxlength="200"></td>
						<td width="30px"><b>State:</b></td><td align="left" width="200px"><input type="text" name="state" value="<?php echo htmlspecialchars($state); ?>" size="25" maxlength="200"></td>
						<td width="25px"><b>Zip:</b></td><td align="left"><input type="text" name="zip" value="<?php echo htmlspecialchars($zip); ?>" size="10" maxlength="200"></td></tr>
</table>

<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
<tr><td width="150px"><b>Phone Number:</b></td>
<td><input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" size="15" maxlength="100" placeholder="000-000-000"></td></tr>

<tr><td><b>Opt Phone Number:</b></td>
<td><input type="text" name="phone2" value="<?php echo htmlspecialchars($phone2); ?>" size="15" maxlength="100" placeholder="000-000-000"></td></tr>

<tr><td><b>Fax Number:</b></td>
<td><input type="text" name="fax" value="<?php echo htmlspecialchars($fax); ?>" size="15" maxlength="100" placeholder="000-000-000"></td></tr>

<tr><td><b>Primary Contact:</b></td>
<td><input type="text" name="contact_name" value="<?php echo htmlspecialchars($contact_name); ?>" size="45" maxlength="200"></td></tr>

<tr><td><b>Primary Email:</b></td>
<td><input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" size="45" maxlength="100"></td></tr>

<tr><td><b>Secondary Contact:</b></td>
<td><input type="text" name="secondary_contact" value="<?php echo htmlspecialchars($secondary_email); ?>" size="45" maxlength="200"></td></tr>

<tr><td><b>Secondary Email:</b></td>
<td><input type="text" name="secondary_email" value="<?php echo htmlspecialchars($secondary_contact); ?>" size="45" maxlength="100"></td></tr>

<tr><td><b>Website URL:</b></td>
<td><input type="text" name="website" value="<?php echo htmlspecialchars($website); ?>" size="45" maxlength="100"></td></tr>



<tr bgcolor="#ffffff"><td><b>Business logo:</b></td>
<td>
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td width="600px"><label for="upload_image">
    <input id="upload_image" type="text" size="100" name="ad_image" value="<?php echo htmlspecialchars($business_logo); ?>" style='font-size:11px' /><br>
    <input id="upload_image_button" class="button" type="button" value="Upload/Select Image" /><br>
    Enter the URL or click on upload/select an image.</td>
    <td><img src="<?php echo $business_logo; ?>" width="60"><br></td></tr>
    </label></td></tr></font></table></td></tr>

<tr><td><b>Business Information/Notes:</b></td>
<td colspan="3"><textarea rows="6" cols="110" name="business_info" maxlength="5000"><?php echo htmlspecialchars($business_info); ?></textarea></td></tr>

<tr><td colspan="2" height="45" align="center"><input type="submit" name="edit-submit" class="button-primary" value="Update" /></td></tr>

</tr>
</form>
</table>




	

<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->