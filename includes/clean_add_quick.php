<?php
$id = isset($id) ? $id : '';
if(isset($_REQUEST['id'])){ $id = $_REQUEST['id']; }

$business_id = stripslashes( $_POST['business_id'] );
if ( ! $business_id ) { $business_id = ''; }
if ( strlen( $business_id ) > 200 ) { $business_id = substr( $business_id, 0, 200 ); }

$the_date = stripslashes( $_POST['the_date'] );
if ( ! $the_date ) { $the_date = ''; }
if ( strlen( $the_date ) > 200 ) { $the_date = substr( $the_date, 0, 200 ); }

$the_date2 = strtotime($the_date);

$reminder = stripslashes( $_POST['reminder'] );
if ( ! $reminder ) { $reminder = ''; }
if ( strlen( $reminder ) > 100 ) { $reminder = substr( $reminder, 0, 100 ); }

$description = stripslashes( $_POST['description'] );
if ( ! $description ) { $description = ''; }
if ( strlen( $description ) > 5000 ) { $description = substr( $description, 0, 5000 ); }

$amount = stripslashes( $_POST['amount'] );
if ( ! $amount ) { $amount = ''; }
if ( strlen( $amount ) > 100 ) { $amount = substr( $amount, 0, 100 ); }

$po_ref = stripslashes( $_POST['po_ref'] );
if ( ! $po_ref ) { $po_ref = ''; }
if ( strlen( $po_ref ) > 100 ) { $po_ref = substr( $po_ref, 0, 100 ); }

$status = stripslashes( $_POST['status'] );
if ( ! $status ) { $status = ''; }
if ( strlen( $status ) > 200 ) { $status = substr( $status, 0, 200 ); }

?>