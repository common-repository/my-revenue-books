<?php
$id = isset($id) ? $id : '';
if(isset($_REQUEST['id'])){ $ListingID = $_REQUEST['id']; }

$business_name = stripslashes( $_POST['business_name'] );
if ( ! $business_name ) { $business_name = ''; }
if ( strlen( $business_name ) > 200 ) { $business_name = substr( $business_name, 0, 200 ); }

$business_info = stripslashes( $_POST['business_info'] );
if ( ! $business_info ) { $business_info = ''; }
if ( strlen( $business_info ) > 5000 ) { $business_info = substr( $business_info, 0, 5000 ); }

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

$email_template1 = stripslashes( $_POST['email_template1'] );
if ( ! $email_template1 ) { $email_template1 = ''; }
if ( strlen( $email_template1 ) > 5000 ) { $email_template1 = substr( $email_template1, 0, 5000 ); }

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

$cron_interval = stripslashes( $_POST['cron_interval'] );
if ( ! $cron_interval ) { $cron_interval = ''; }
if ( strlen( $cron_interval ) > 200 ) { $cron_interval = substr( $cron_interval, 0, 200 ); }

$current_cron = stripslashes( $_POST['current_cron'] );
if ( ! $current_cron ) { $current_cron = ''; }
if ( strlen( $current_cron ) > 200 ) { $current_cron = substr( $current_cron, 0, 200 ); }

$mrb_uninstall = stripslashes( $_POST['mrb_uninstall'] );
if ( ! $mrb_uninstall ) { $mrb_uninstall = 'no'; }
if ( strlen( $mrb_uninstall ) > 100 ) { $mrb_uninstall = substr( $mrb_uninstall, 0, 100 ); }

$mrb_settings = stripslashes( $_POST['mrb_settings'] );
if ( ! $mrb_settings ) { $mrb_settings = 'init'; }
if ( strlen( $mrb_settings ) > 100 ) { $mrb_settings = substr( $mrb_settings, 0, 100 ); }

$payment_terms = stripslashes( $_POST['payment_terms'] );
if ( ! $payment_terms ) { $payment_terms = 'init'; }
if ( strlen( $payment_terms ) > 15 ) { $payment_terms = substr( $payment_terms, 0, 15 ); }

?>