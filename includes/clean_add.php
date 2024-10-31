<?php
$id = isset($id) ? $id : '';
if(isset($_REQUEST['id'])){ $ListingID = $_REQUEST['id']; }

$business_name = stripslashes( $_POST['business_name'] );
if ( ! $business_name ) { $business_name = ''; }
if ( strlen( $business_name ) > 200 ) { $business_name = substr( $business_name, 0, 200 ); }

$business_id = stripslashes( $_POST['business_id'] );
if ( ! $business_id ) { $business_id = ''; }
if ( strlen( $business_id ) > 200 ) { $business_id = substr( $business_id, 0, 200 ); }

$contact_name = stripslashes( $_POST['contact_name'] );
if ( ! $contact_name ) { $contact_name = ''; }
if ( strlen( $contact_name ) > 200 ) { $contact_name = substr( $contact_name, 0, 200 ); }

$address = stripslashes( $_POST['address'] );
if ( ! $address ) { $address = ''; }
if ( strlen( $address ) > 200 ) { $address = substr( $address, 0, 200 ); }

$address2 = stripslashes( $_POST['address2'] );
if ( ! $address2 ) { $address2 = ''; }
if ( strlen( $address2 ) > 200 ) { $address2 = substr( $address2, 0, 200 ); }

$city = stripslashes( $_POST['city'] );
if ( ! $city ) { $city = ''; }
if ( strlen( $city ) > 100 ) { $city = substr( $city, 0, 100 ); }

$state = stripslashes( $_POST['state'] );
if ( ! $state ) { $state = ''; }
if ( strlen( $state ) > 20 ) { $state = substr( $state, 0, 20 ); }

$zip = stripslashes( $_POST['zip'] );
if ( ! $zip ) { $zip = ''; }
if ( strlen( $zip ) > 15 ) { $zip = substr( $zip, 0, 15 ); }

$email = stripslashes( $_POST['email'] );
if ( ! $email ) { $email = ''; }
if ( strlen( $email ) > 200 ) { $email = substr( $email, 0, 200 ); }

$secondary_contact = stripslashes( $_POST['secondary_contact'] );
if ( ! $secondary_contact ) { $secondary_contact = ''; }
if ( strlen( $secondary_contact ) > 200 ) { $secondary_contact = substr( $secondary_contact, 0, 200 ); }

$secondary_email = stripslashes( $_POST['secondary_email'] );
if ( ! $secondary_email ) { $secondary_email = ''; }
if ( strlen( $secondary_email ) > 200 ) { $secondary_email = substr( $secondary_email, 0, 200 ); }

$phone = stripslashes( $_POST['phone'] );
if ( ! $phone ) { $phone = ''; }
if ( strlen( $phone ) > 100 ) { $phone = substr( $phone, 0, 100 ); }

$phone2 = stripslashes( $_POST['phone2'] );
if ( ! $phone2 ) { $phone2 = ''; }
if ( strlen( $phone2 ) > 100 ) { $phone2 = substr( $phone2, 0, 100 ); }

$fax = stripslashes( $_POST['fax'] );
if ( ! $fax ) { $fax = ''; }
if ( strlen( $fax ) > 100 ) { $fax = substr( $fax, 0, 100 ); }

$website = stripslashes( $_POST['website'] );
if ( ! $website ) { $website = ''; }
if ( strlen( $website ) > 200 ) { $website = substr( $website, 0, 200 ); }

$business_logo = stripslashes( $_POST['ad_image'] );
if ( ! $business_logo ) { $business_logo = ''; }
if ( strlen( $business_logo ) > 200 ) { $business_logo = substr( $business_logo, 0, 200 ); }

$business_info = stripslashes( $_POST['business_info'] );
if ( ! $business_info ) { $business_info = ''; }
if ( strlen( $business_info ) > 5000 ) { $business_info = substr( $business_info, 0, 5000 ); }

?>