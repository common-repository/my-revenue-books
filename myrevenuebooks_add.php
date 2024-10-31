<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$deletenonce = wp_create_nonce('my-nonce');
$update_status = "N";
//check for security options
$mrb_page = "Add Account";

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

$last_edited = date("m-d-Y")." ".date("H").":".date("i").":".date("s");


$table = $wpdb->prefix . "myrevenuebooks";

$wpdb->query( $wpdb->prepare( "INSERT INTO $table (
		business_name,
		business_id,
		contact_name,
		address,
		address2,
		city,
		state,
		zip,
		email,
		phone,
		phone2,
		fax,
		website,
		business_logo,
		business_info,
		secondary_contact,
		secondary_email,
		last_edited
		)
	VALUES ( %s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s )
	",
		$business_name,
		$business_id,
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
		$secondary_contact,
		$secondary_email,
		$last_edited
	
) );
	
	$the_id = "";
	//get the next business id
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id <> %s ORDER BY business_id DESC LIMIT 0,1", $the_id  ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $business_id = $myrevenuebooks_sql->business_id; }
	//get the next id
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id <> %s ORDER BY id DESC LIMIT 0,1", $the_id  ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $id = $myrevenuebooks_sql->id; }
	
		echo "<table align='left' border='0' cellpadding='4' cellspacing='0' width='800px'>";
		echo "<tr><td><h2><br>$business_name has been added!</h2></td></tr>
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
		</td></tr></tr>
		</table>";
		
	$url = "admin.php?page=my-revenue-books/myrevenuebooks_view_transactions.php&id=$id&b_id=$business_id"; 
	echo "<script> location.replace('$url'); </script>";
	exit;

	}
?>









<?php
	$the_id = "";
	//get the next business id
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id <> %s ORDER BY business_id DESC LIMIT 0,1", $the_id  ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $business_id = $myrevenuebooks_sql->business_id + 1; }
	
	$plugins_url = plugins_url();
	$business_logo = plugins_url( 'images/money_fist.png', __FILE__ );
	
?>



<div id="mrb_invoice_wrapper">



<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
<form name="editlisting" method="post">

<input type="hidden" value="<?php echo htmlspecialchars($business_id); ?>" name="business_id" />

<tr><td colspan="2"><h2><span class="dashicons dashicons-businessperson"></span> <b>Add New Account:</b></h2></td></tr>

<tr><td width="150px"><b>Business Name:</b></td>
<td><input placeholder="*Required" type="text" name="business_name" value="" size="70" maxlength="200"></td></tr>

<tr><td><b>Address:</b></td>
<td><input type="text" name="address" value="" size="70" maxlength="200"></td></tr>

<tr><td><b>Address line 2:</b></td>
<td><input type="text" name="address2" value="" size="70" maxlength="200"></td></tr>
</table>

<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
<tr><td width="150px"><b>City:</b></td><td width="290px"><input type="text" name="city" value="" size="40" maxlength="200"></td>
						<td width="30px"><b>State:</b></td><td align="left" width="200px"><input type="text" name="state" value="" size="25" maxlength="200"></td>
						<td width="25px"><b>Zip:</b></td><td align="left"><input type="text" name="zip" value="" size="10" maxlength="200"></td></tr>
</table>

<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
<tr><td width="150px"><b>Phone Number:</b></td>
<td><input type="text" name="phone" value="" size="15" maxlength="100" placeholder="000-000-000"></td></tr>

<tr><td><b>Opt Phone Number:</b></td>
<td><input type="text" name="phone2" value="" size="15" maxlength="100" placeholder="000-000-000"></td></tr>

<tr><td><b>Fax Number:</b></td>
<td><input type="text" name="fax" value="" size="15" maxlength="100" placeholder="000-000-000"></td></tr>

<tr><td><b>Primary Contact:</b></td>
<td><input type="text" name="contact_name" value="" size="45" maxlength="200"></td></tr>

<tr><td><b>Primary Email:</b></td>
<td><input type="text" name="email" value="" size="45" maxlength="100"></td></tr>

<tr><td><b>Secondary Contact:</b></td>
<td><input type="text" name="secondary_contact" value="" size="45" maxlength="200"></td></tr>

<tr><td><b>Secondary Email:</b></td>
<td><input type="text" name="secondary_email" value="" size="45" maxlength="100"></td></tr>

<tr><td><b>Website URL:</b></td>
<td><input type="text" name="website" value="" size="45" maxlength="100"></td></tr>


<tr bgcolor="#ffffff"><td><b>Business logo:</b></td>
<td>
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td width="600px"><label for="upload_image">
    <input id="upload_image" type="text" size="100" name="ad_image" value="" style='font-size:11px' /><br>
    <input id="upload_image_button" class="button" type="button" value="Upload/Select Image" /><br>
    Enter the URL or click on upload/select an image.</td>
    <td><img src="<?php echo $business_logo; ?>" width="60"><br></td></tr>
    </label></td></tr></font></table></td></tr>
    
<tr><td><b>Business Information/Notes:</b></td>
<td colspan="3"><textarea rows="6" cols="110" name="business_info" maxlength="5000"></textarea></td></tr>

<tr><td colspan="2" height="45" align="center"><input type="submit" name="edit-submit" class="button-primary" value="Add New Account" /></td></tr>

</table>
</form>


</div>




	
<?php
} // end if a valid user is found
?>


</div> <!-- mrb_main_wrapper from header.php -->