<?php
global $wpdb;
if ( ! defined( 'ABSPATH' ) ) exit;



// Send Email
add_filter( 'wp_mail_content_type', 'set_html_content_type' );

$headers[] = "MIME-Version: 1.0\r\n";
//$headers = array('Content-Type: text/html; charset=UTF-8');
$headers[] = "From: ".$email_from_name." <".$email_from.">\r\n";
$headers[] = "Cc: ".$email_from_name." <".$email_to_cc.">\r\n";
$headers[] = "Bcc: ".$email_from_name." <".$email_to_bcc.">\r\n";
$to = $email_to;
	$Cc = $email_to_cc;
	$Bcc = $email_to_bcc;
$subject = $email_subject;
$body = isset($body) ? $body : '';
$body .= $email_body;

$body .= '';

wp_mail( $to, $subject, $body, $headers );

// Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

function set_html_content_type() {
	return 'text/html';
	//return 'text/plain';
}



?>

