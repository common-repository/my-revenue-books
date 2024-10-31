<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Edit";

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
	if ($the_security_option == "Enabled" && $mrb_current_user_id > 0 || $the_security_option == "Disabled") { 	?>






<table align="left" border="0" cellpadding="4" cellspacing="0" width="1000px">
<form name="editlisting" method="post">

<tr><td align="center"><select name='the_business_id' value='' style='font-size:12px'>Select</option>";
<option value='0'>Select the account</option>

<?php 
$the_id = "1";
$the_bus_name = "";
$table = $wpdb->prefix . "myrevenuebooks";
$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id > %s AND business_name <> %s ORDER BY business_name ASC", $the_id, $the_bus_name ));
foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
{ 
$business_id = $myrevenuebooks_sql->business_id;
$business_name = $myrevenuebooks_sql->business_name;
?>
<option value='<?php echo $myrevenuebooks_sql->business_id; ?>'><?php echo $business_name; ?></option>

<?php
}
?>
</select></font><br></td></tr>

<tr><td colspan="2" height="45" align="center"><input type="submit" name="select-submit" value="Select" /></td></tr>

</table>
</form>





<?php
	if (!empty($_POST['select-submit'])) {
	
	$business_id = stripslashes( $_POST['the_business_id'] );
	if ( ! $business_id ) { $business_id = ''; }
	if ( strlen( $business_id ) > 200 ) { $business_id = substr( $business_id, 0, 200 ); }
	
	//check for account selection
	if ($business_id == "") { echo "<table align='left' border='0' cellpadding='0' cellspacing='0'><tr><td><h1><b><font color='#a20900'>No Account Selected!</font><b></h1></td></tr>"; exit; }

	$the_bus_name = "";
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE business_id = %s AND business_name <> %s", $business_id, $the_bus_name ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
	$the_bus_id = $myrevenuebooks_sql->id;
	$business_name = $myrevenuebooks_sql->business_name;
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
	}

?>



<table align="left" border="0" cellpadding="4" cellspacing="0" width="1000px">
<form name="editlisting" method="post">

<input type="hidden" value="<?php echo htmlspecialchars($business_id); ?>" name="business_id" />
<input type="hidden" value="<?php echo htmlspecialchars($the_bus_id); ?>" name="the_bus_id" />

<tr><td colspan="2"><span class="dashicons dashicons-edit"></span><b>Edit/Update Advertising Account:</b></td></tr>

<tr bgcolor="#ffffff"><td><b>Business Name:</b></td>
<td><input type="text" name="business_name" value="<?php echo htmlspecialchars($business_name); ?>" size="45" maxlength="200"></td></tr>

<tr><td><b>Contact Name:</b></td>
<td><input type="text" name="contact_name" value="<?php echo htmlspecialchars($contact_name); ?>" size="45" maxlength="200"></td></tr>

<tr bgcolor="#ffffff"><td><b>Address:</b></td>
<td><input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" size="45" maxlength="200"></td></tr>

<tr><td><b>Address line 2:</b></td>
<td><input type="text" name="address2" value="<?php echo htmlspecialchars($address2); ?>" size="45" maxlength="200"></td></tr>

<tr bgcolor="#ffffff"><td><b>City:</b></td>
<td><input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>" size="45" maxlength="200"></td></tr>
<tr><td><b>State:</b></td>
<td><input type="text" name="state" value="<?php echo htmlspecialchars($state); ?>" size="45" maxlength="200"></td></tr>
<tr bgcolor="#ffffff"><td><b>Zip:</b></td>
<td><input type="text" name="zip" value="<?php echo htmlspecialchars($zip); ?>" size="45" maxlength="200"></td></tr>

<tr><td><b>Phone Number:</b></td>
<td><input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" size="45" maxlength="100"></td></tr>

<tr bgcolor="#ffffff"><td><b>Optional Phone Number:</b></td>
<td><input type="text" name="phone2" value="<?php echo htmlspecialchars($phone2); ?>" size="45" maxlength="100"></td></tr>

<tr><td><b>Email Address:</b></td>
<td><input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" size="45" maxlength="100"></td></tr>

<tr bgcolor="#ffffff"><td><b>Fax Number:</b></td>
<td><input type="text" name="fax" value="<?php echo htmlspecialchars($fax); ?>" size="45" maxlength="100"></td></tr>

<tr><td><b>Website URL:</b></td>
<td><input type="text" name="website" value="<?php echo htmlspecialchars($website); ?>" size="45" maxlength="100"></td></tr>

<tr bgcolor="#ffffff"><td><b>Business logo:</b></td>
<td>
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="95%">
	<tr><td><label for="upload_image">
    <input id="upload_image" type="text" size="52" name="ad_image" value="<?php echo htmlspecialchars($business_logo); ?>" style='font-size:11px' /><br>
    <input id="upload_image_button" class="button" type="button" value="Upload/Select Image" /><br>
    Enter the URL or click on upload/select an image.</td>
    <td><img src="<?php echo $business_logo; ?>" width="80"><br></td></tr>
    </label></td></tr></font></table></td></tr>

<tr><td><b>Business Information/Notes:</b></td>
<td colspan="3"><textarea rows="8" cols="80" name="business_info" maxlength="5000"><?php echo htmlspecialchars($business_info); ?></textarea></td></tr>

<tr><td colspan="2" height="45" align="center"><input type="submit" name="edit-submit" class="button-primary" value="Update" /></td></tr>

</tr></table>
</form>

	<?php
	}
	?>








<?php 

if (!empty($_POST['edit-submit'])) {

$update_status="Y";
include ("includes/clean_add.php");

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
	echo "<tr><td><h2><br>$business_name has been updated!</h2><br></td></tr>
		<tr><td>Contact: $contact_name<br>
		Address: $address<br>
		Address: $address2<br>
		City/St/Zip: $city, $state $zip<br>
		Email: $email<br>
		Phone: $phone<br>
		Phone: $phone2<br>
		Fax: $fax<br>
		Website: $website<br>
		Logo URL: $business_logo<br>
		Business Information/Info: $business_info<br>
		</td></tr></table>";
	}		
				
	
	}
?>







	

<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->