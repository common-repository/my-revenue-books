<?php wp_enqueue_script('jquery-ui-datepicker'); ?>

<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#datepicker').datepicker({
        dateFormat : 'mm/dd/yy'
    	});
    jQuery('#datepicker2').datepicker({
        dateFormat : 'mm/dd/yy'
    	});
    jQuery('#datepicker3').datepicker({
        dateFormat : 'mm/dd/yy'
    	});
    jQuery('#datepicker4').datepicker({
        dateFormat : 'mm/dd/yy'
   		});
    jQuery('#datepicker5').datepicker({
        dateFormat : 'mm/dd/yy'
   		});
    jQuery('#datepicker6').datepicker({
        dateFormat : 'mm/dd/yy'
   		});
    jQuery('#datepicker7').datepicker({
        dateFormat : 'mm/dd/yy'
   		});
   	 jQuery('#datepicker8').datepicker({
        dateFormat : 'mm/dd/yy'
   		});
   	 jQuery('#datepicker9').datepicker({
    dateFormat : 'mm/dd/yy'
   		});
	});
</script>


<?php
	$mrb_edit_status = "";
	if ($workorder_file_status == "Closed" && $security_work_admin == "false") {$mrb_edit_status = "disabled";}


	//get the workorder default details if its a new workorder
if ($mrb_trans_type <> "edit") {
	$table_security = $wpdb->prefix . "myrevenuebooks_security";
    $security_option_query = "Disabled"; //default
    $security_option_query2 = "Enabled"; //default
    $myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_option = %s OR security_option = %s", $security_option_query, $security_option_query2 ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $workorder_details = $myrevenuebooks_sql->workorder_details; }
}
?>
	

	
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td><font color="#645500"><b>Workorder: <?php echo htmlspecialchars($business_name); ?></b></font></td></tr>
	</table>
	
	<table align="left" border="0" bordercolor="#ed9a01" cellpadding="0" cellspacing="0" width="99.5%">
	<tr><td height="22px" colspan="2" align="center" style="vertical-align: middle;" ><div id="mrb_workorder_wrapper2"><font color="#000000"><b>------ &nbsp;W O R K O R D E R&nbsp;&nbsp;&nbsp;&nbsp;D E T A I L S&nbsp; ------</b></font></div></td></tr>
	</table>


<div id="mrb_wrapper2">

<div id="mrb_invoice_wrapper">

	<form name="editlisting" method="post">
	<input type="hidden" value="<?php echo htmlspecialchars($business_id); ?>" name="business_id" />
	<input type="hidden" value="<?php echo htmlspecialchars($business_name); ?>" name="business_name" />
	<!-- workorders add-on -->
	<input type="hidden" value="<?php echo htmlspecialchars($workorder_username); ?>" name="workorder_username" />
	<input type="hidden" value="<?php echo htmlspecialchars($workorder_useremail); ?>" name="workorder_useremail" />
	<input type="hidden" value="<?php echo htmlspecialchars($pre_workorder_assigned); ?>" name="pre_workorder_assigned" />
	<input type="hidden" value="<?php echo htmlspecialchars($pre_workorder_status); ?>" name="pre_workorder_status" />
	<input type="hidden" value="Workorder" name="workorder_type" />
	<input type="hidden" value="<?php echo htmlspecialchars($workorder_userid); ?>" name="workorder_userid" />

	
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="99.5%">
	<tr><td width="115px"><font color="#820000"><b>Assigned To:</b>&nbsp;</font></td>
	<td align="left" style="vertical-align: middle;">
	
	<! -- select a user -->
	<select name="workorder_assigned" <?php echo $mrb_edit_status; ?> >
	
	<?php if ($workorder_assigned == "Not Assigned") { echo "<option value='Not Assigned'>Not Assigned</option>"; } ?>
	<?php if ($workorder_assigned <> "Not Assigned") { echo "<option value='$workorder_userid'>$workorder_assigned</option>"; } ?>
	<?php if ($workorder_assigned <> "Not Assigned") { echo "<option value='Not Assigned'>Not Assigned</option>"; } ?>
	
	
	<?php
	//get users
	$ii=1;
		$mrb_get_work_userid = "";
		$mrb_get_work_users = "dashboard_workorder";
		$table_security = $wpdb->prefix . "myrevenuebooks_security";
		$myrevenuebooks_sqlqz = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND userid <> %s", $mrb_get_work_users, $mrb_get_work_userid ));
		foreach ( $myrevenuebooks_sqlqz as $myrevenuebooks_sqlz ) 
		{ 		$mrb_id_search = $myrevenuebooks_sqlz->userid;
				$mrb_work_first = $myrevenuebooks_sqlz->user_firstname;
				$mrb_work_last = $myrevenuebooks_sqlz->user_lastname;
				$mrb_display_name_search = $mrb_work_first . " " . $mrb_work_last;
			?>
			
			<!-- if All Users is the value, then no users have been added, so display nothing or no users to assign -->
			<?php if ($mrb_display_name_search <> "All Users") { ?>
			
			<?php if ($mrb_display_name_search <> $workorder_assigned) { ?>
			
				<!-- if not a admin user, you can't' select other users -->
				<?php if ($security_work_admin == "false" && $mrb_id_search == $mrb_user_id) { ?>
				<option value="<?php echo htmlspecialchars($mrb_id_search); ?>"><?php echo htmlspecialchars($mrb_display_name_search); ?></option>
				<?php } ?>
			
				<!-- if admin user, you can select other users -->
				<?php if ($security_work_admin == "true") { ?>
				<option value="<?php echo htmlspecialchars($mrb_id_search); ?>"><?php echo htmlspecialchars($mrb_display_name_search); ?></option>
				<?php } ?>
			
			<?php } ?>
			<?php
			}
			$ii++; } ?>
		
		</select><! -- end select a user -->
	</td>
	<td>If “Not Assigned” you want to accept the workorder, then select and assign it to yourself.<br>If the workorder is assigned to you and you do not want to accept it, then select and assign it to "Not Assigned"</td>
	</tr>
	
	<tr bgcolor="#ffffff"><td width="115px" align="left"><font color="#068200"><b>Workorder Status:</b></font>&nbsp;</td>
		<td align="left"><select name="workorder_status" required <?php echo $mrb_edit_status; ?> >
			<?php if ($workorder_status <> "") { echo "<option value='$workorder_status'>$workorder_status</option>"; } ?>
			<?php if ($workorder_status <> "Waiting Acceptance") {?> <option value="Waiting Acceptance">Waiting Acceptance</option><?php } ?>
			<?php if ($workorder_status <> "Accepted") {?> <option value="Accepted">Accepted</option><?php } ?>
    		<?php if ($workorder_status <> "Working") {?> <option value="Working">Working</option><?php } ?>
    		<?php if ($workorder_status <> "Complete") {?> <option value="Complete">Complete</option><?php } ?>
    		<?php if ($workorder_status <> "Pending") {?> <option value="Pending">Pending</option><?php } ?>
    		<?php if ($workorder_status <> "Cancelled") {?> <option value="Cancelled">Cancelled</option><?php } ?>
    		<?php if ($workorder_status <> "Removed") {?> <option value="Removed">Removed</option><?php } ?>
    		<?php if ($workorder_status <> "Paid") {?> <option value="Paid">Paid</option><?php } ?>
 			</select></td>
 			<td>Select the workorder status</td>
 			</tr>
	</table>
	
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="99.5%">
		<tr><td width="115px" align="left"><font color="#068200"><b>File Status:</b></font>&nbsp;</td>
		<td align="left" width="95px"><select name="workorder_file_status" required <?php echo $mrb_edit_status; ?> >
		<?php if ($workorder_file_status <> "") { echo "<option value='$workorder_file_status'>$workorder_file_status</option>"; } ?>
		<?php if ($workorder_file_status <> "Open") {?> <option value="Open">Open</option><?php } ?>
		<?php if ($workorder_file_status <> "Closed") {?> <option value="Closed">Closed</option><?php } ?>
		</select></td><td>Set to "closed" to remove it from the assigned & open orders list</td></tr>
	</table>
	
	<table align="left" border="0" cellpadding="2" cellspacing="0" width="99.5%">
	<tr bgcolor="#ffffff"><td><b>&nbsp;Commission</b></td>
		<td><b>&nbsp;Due Date</b></td>
		<td><b>&nbsp;Payment Date</b></td>
		<td><b>&nbsp;Payment Details</b></td></tr>
	<tr bgcolor="#ffffff"><td><input type="text" name="workorder_commission" placeholder="0.00" step="0.01" value="<?php echo htmlspecialchars($workorder_commission); ?>" size="7" maxlength="100" <?php echo $mrb_edit_status; ?>></td>
		<td><input type="text" value="<?php echo htmlspecialchars($workorder_due_date); ?>" name="workorder_due_date" size="10" maxlength="100" id="datepicker8" <?php echo $mrb_edit_status; ?>/></td>
		<td><input type="text" value="<?php echo htmlspecialchars($workorder_payment_date); ?>" name="workorder_payment_date" size="10" maxlength="100" id="datepicker9" <?php echo $mrb_edit_status; ?>/></td>
		<td><input type="text" value="<?php echo htmlspecialchars($workorder_payment_details); ?>" name="workorder_payment_details" size="65" maxlength="500" <?php echo $mrb_edit_status; ?>/></td>
		
		<!-- top submit button -->
		<?php if ($security_work_admin == "true") { ?>
		<td align="right"><input type="submit" name="edit-submit" class="button-primary" value="Update Workorder" /></td></tr>
		<?php } ?>
		
		<?php if ($security_work_access == "true" && $workorder_file_status == "Open" && $security_work_admin == "false") { ?>
		<td align="right"><input type="submit" name="edit-submit" class="button-primary" value="Update Workorder" /></td></tr>
		<?php } ?>
		
		<?php if ($security_work_access == "true" && $workorder_file_status == "Closed" && $security_work_admin == "false") { ?>
		<td align="right"><input type="submit" class="button-secondary" value="Closed" disabled></td></tr>
		<?php } ?>
		<!-- end top submit button -->
		
		
		</table>
		

	<!-- workorder details form -->
	<table align="left" border="0" bordercolor="#817e7e" cellpadding="2" cellspacing="1" width="99.5%" bgcolor="#d7d7d7">
	<?php
		$default_content = $workorder_details;
		$editor_id = 'workorder_details';
		$option_name='workorder_details';
		$default_content=html_entity_decode($default_content);
		$default_content=stripslashes($default_content);
	?>
	<tr><td>
	<?php wp_editor( $default_content, $editor_id,array('workorder_details' => $option_name,'media_buttons' => false, 'editor_height' => 350,'teeny' => false, 'media_buttons' => true)  ); ?>
	</td></tr>
	</table>
	
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="99.5%" bgcolor="#d7d7d7">
	<tr><td align="center"><i>You can add a default template message and the new workorder email subject in <a href="admin.php?page=my-revenue-books/myrevenuebooks_settings.php#S1" style="text-decoration:none" title="settings">settings</a>!</i></td></tr>
	</table>
	<!-- end workorder details form -->
	
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td>&nbsp;</td></tr>
	</table>

	<div class="mrb_invoice_to_wrapper">
	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr><td>&nbsp;</td></tr>
	</table>
	</div>
<!-- end workorders add-on -->



	<div class="mrb_invoice_date_wrapper"><b>Invoice Date: </b><input type="text" value="<?php echo htmlspecialchars($the_date); ?>" name="the_date" size="20" maxlength="100" id="datepicker" <?php echo $mrb_edit_status; ?>/></div>
	<div class="mrb_invoice_date_wrapper"><b>Invoice or PO#: </b><input type="text" value="<?php echo htmlspecialchars($po_ref); ?>" name="po_ref" size="20" maxlength="100" <?php echo $mrb_edit_status; ?>/><br></div>
	<div class="mrb_invoice_date_wrapper"><b>Reference: </b><input type="text" value="<?php echo htmlspecialchars($the_ref); ?>" name="the_ref" size="20" maxlength="100" <?php echo $mrb_edit_status; ?>/></div>
	<div class="mrb_invoice_date_wrapper"><b>Due Date: </b><input type="text" value="<?php echo htmlspecialchars($due_date); ?>" name="due_date" size="20" maxlength="100" id="datepicker7" <?php echo $mrb_edit_status; ?>/></div>
	<div class="cb"></div>
	
<!-- ///////////////////////// CONTACT INFORMATION ///////////////////////// -->
	<div class="mrb_invoice_header_wrapper">
	<span class="dashicons dashicons-admin-users"></span> <b>Contact Information:</b>
	</div>

<div class="mrb_invoice_body_wrapper">
	
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td>&nbsp;<b>Primary Contact Name</b></td><td>&nbsp;<b>Primary Contact Email</b></td><td>&nbsp;<b>Primary Contact Notes</b></td></tr>
	<tr><td><input type="text" name="primary_contact" value="<?php echo htmlspecialchars($primary_contact); ?>" size="30" maxlength="200" <?php echo $mrb_edit_status; ?> ></td>
		<td><input type="text" name="primary_email" value="<?php echo htmlspecialchars($primary_email); ?>" size="50" maxlength="200" <?php echo $mrb_edit_status; ?> ></td>
		<td><input type="text" name="primary_notes" value="<?php echo htmlspecialchars($primary_notes); ?>" size="51" maxlength="200" <?php echo $mrb_edit_status; ?> ></td></tr>
	</table>
	
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td>&nbsp;<b>Secondary Contact Name</b></td><td>&nbsp;<b>Secondary Contact Email</b></td><td>&nbsp;<b>Secondary Contact Notes</b></td></tr>
	<tr><td><input type="text" name="secondary_contact" value="<?php echo htmlspecialchars($secondary_contact); ?>" size="30" maxlength="200" <?php echo $mrb_edit_status; ?> ></td>
		<td><input type="text" name="secondary_email" value="<?php echo htmlspecialchars($secondary_email); ?>" size="50" maxlength="200" <?php echo $mrb_edit_status; ?> ></td>
		<td><input type="text" name="secondary_notes" value="<?php echo htmlspecialchars($secondary_notes); ?>" size="51" maxlength="200" <?php echo $mrb_edit_status; ?> ></td></tr>
	</table>
</div>
<!-- /////////////////////// END CONTACT INFORMATION /////////////////////// -->
	
	
	
	
	
	
	
	
	
<!-- ///////////////////////// AD DURATION AND REMINDER ///////////////////////// -->
	<div class="mrb_invoice_header_wrapper">
	<span class="dashicons dashicons-calendar"></span> <b>Duration & Reminder Options: (if applicable)</b>
	</div>
	
<div class="mrb_invoice_body_wrapper">

	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td align="left" width="143px">&nbsp;<b>Start Date</b></td>
		<td width="20px">&nbsp;</td>
		<td align="left" width="250px">&nbsp;<b>End Date</b></td>
		<td colspan="2" align="left">&nbsp;<b>Add dashboard reminder and date?</b></td>
		<td colspan="2" align="left">&nbsp;<b>Email reminder already sent?</b></td>
		</tr>
	<tr><td><input type="text" id="datepicker2" name="campain_start" value="<?php echo htmlspecialchars($campain_start); ?>" size="15" maxlength="100" placeholder="Start" <?php echo $mrb_edit_status; ?> ></td>
		<td>to</td>
		<td><input type="text" id="datepicker3" name="campain_end" value="<?php echo htmlspecialchars($campain_end); ?>" size="15" maxlength="100" placeholder="End" <?php echo $mrb_edit_status; ?> ></td>
		<td width="70px" align="left"><select name="reminder" <?php echo $mrb_edit_status; ?> >
			<option value="<?php echo htmlspecialchars($reminder); ?>"><?php echo htmlspecialchars($reminder); ?></option>
			<option value="No">No</option>
 			<option value="Yes">Yes</option>
  			</select></td>
		<td align="left"><input type="text" id="datepicker4" name="reminder_date" value="<?php echo htmlspecialchars($reminder_date); ?>" size="15" maxlength="100" placeholder="If yes, add date" <?php echo $mrb_edit_status; ?> ></td>
		<td width="70px"><select name="reminder_sent" <?php echo $mrb_edit_status; ?> >
			<option value="<?php echo htmlspecialchars($reminder_sent); ?>"><?php echo htmlspecialchars($reminder_sent); ?></option>
			<option value="No">No</option>
    		<option value="Yes">Yes</option>
 			</select></td>
		<td><input type="text" id="datepicker5" name="reminder_date_sent" value="<?php echo htmlspecialchars($reminder_date_sent); ?>" size="15" maxlength="100" placeholder="If yes, add date" <?php echo $mrb_edit_status; ?> ></td>
	</tr>
	</table>
	
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
		<tr><td align="left"><b>Notes&nbsp;</b></td>
		<td><input type="text" name="duration" value="<?php echo htmlspecialchars($duration); ?>" size="140" maxlength="5000"></td></tr>
	</table>
	
</div>



<!-- display email options if not disabled -->
<?php if ($mrb_edit_status <> "disabled") { ?>
	
<!-- if not adding or copying a new invoice, add email information -->
<?php if ($mrb_trans_type == "edit") { ?>

<div class="mrb_ad_contact_email_wrapper">
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="780px">
	<tr><td width="4px"><span class="dashicons dashicons-email-alt"></span></td>
	<td colspan="5"><b>&nbsp;<?php echo "<a href='admin.php?page=my-revenue-books/myrevenuebooks_email_reminder.php&id=$the_id&b_id=$business_id'>Send A Email Reminder"; ?></a> &nbsp;&nbsp;*Set your default email template in <a href="admin.php?page=my-revenue-books/myrevenuebooks_settings.php">settings</a>.</td></tr>
	</table>
	
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="780px">
	<tr><td colspan="2">Email Reminder Log........</td></tr>
	
<?php //Check for sent email reminders
$I=0;
$tbbg = "#ffffff";
	$table2 = $wpdb->prefix . "myrevenuebooks_email";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table2 . " WHERE business_id = %s AND the_id = %s ORDER BY id DESC", $the_b_id, $the_id ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $I++;
		if($tbbg==''){$tbbg='#ffffff';}
		else{$tbbg='';}
	$email_id[$I] = $myrevenuebooks_sql->id;
	$email_the_id[$I] = $myrevenuebooks_sql->the_id;
	$email_the_b_id[$I] = $myrevenuebooks_sql->business_id;
	$email_reminder_date_sent[$I] = $myrevenuebooks_sql->reminder_date_sent;
	echo "<tr bgcolor='$tbbg'><td valign='top' colspan='1' width='17%'><a href='admin.php?page=my-revenue-books/myrevenuebooks_edit_transaction.php&get_id=$email_id[$I]&id=$email_the_id[$I]&b_id=$email_the_b_id[$I]'>$email_reminder_date_sent[$I]</a></td>";
		
		if ($get_id <> 0) {
			$table2 = $wpdb->prefix . "myrevenuebooks_email";
			$myrevenuebooks_sqlq2 = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table2 . " WHERE id = %s AND reminder_date_sent = %s ", $get_id, $email_reminder_date_sent[$I] ));
			foreach ( $myrevenuebooks_sqlq2 as $myrevenuebooks_sql2 ) 
			{
			$email_from_name[$I] = $myrevenuebooks_sql2->email_from_name;
			$email_from[$I] = $myrevenuebooks_sql2->email_from;
			$email_to[$I] = $myrevenuebooks_sql2->email_to;
			$email_to_cc[$I] = $myrevenuebooks_sql2->email_to_cc;
			$email_to_bcc[$I] = $myrevenuebooks_sql2->email_to_bcc;
			$email_subject[$I] = $myrevenuebooks_sql2->email_subject;
			$email_body[$I] = $myrevenuebooks_sql2->email_body;
			$reminder_sent[$I] = $myrevenuebooks_sql2->reminder_sent;
			$reminder_date_sent[$I] = $myrevenuebooks_sql2->reminder_date_sent;
			echo "<td colspan='1' bgcolor='$tbbg' style='white-space:pre-line'><b>From (Name): </b>" . $email_from_name[$I] . "<br>";
			echo "<b>From (Email Address): </b>" . $email_from[$I] . "<br>";
			echo "<b>To: </b>" . $email_to[$I] . "<br>";
			echo "<b>Cc: </b>" . $email_to_cc[$I] . "<br>";
			echo "<b>Bcc: </b>" . $email_to_bcc[$I] . "<br>";
			echo "<b>Subject: </b>" . $email_subject[$I] . "<br>";
			echo $email_body[$I] . "<br></td>";
							}
		echo "</tr>";
	}
	}
	?>
	</table>
	<?php } ?> <!-- end remove if adding a new invoice -->
</div>

<!-- ///////////////////////// END AD DURATION AND REMINDER ///////////////////////// -->

<?php } ?> <!-- end if not disabled





<!-- ///////////////////////// AD DETAILS ///////////////////////// -->
	<div class="mrb_invoice_header_wrapper">
	<span class="dashicons dashicons-clipboard"></span> <b>Post Details:</b>
	</div>


<div class="mrb_invoice_body_wrapper">
	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%" bgcolor="#e7e7e7">
	<tr><td align="left" width="70"><b>Post Status:</b></td>
	<td align="left" width="90"><select name="ad_post_status">
	<option value="<?php echo htmlspecialchars($ad_post_status); ?>" selected>Active</option>
	<?php if ($ad_post_status == "Inactive") { ?> <option value="Active">Active</option> <?php };?>
	<?php if ($ad_post_status == "Active") { ?> <option value="Inactive">Inactive</option> <?php };?>
  	</select></td>
  	
  	<td width="70px"><b>Post Term:</b></td><td width="110px"><input type="text" name="ad_post_term_year" size="3" maxlength="10" value="<?php echo htmlspecialchars($ad_post_term_year); ?>" placeholder="0"> Year(s)</td>
	<td><input type="text" name="ad_post_term_months" size="2" maxlength="10" value="<?php echo htmlspecialchars($ad_post_term_months); ?>" placeholder="0"> Months(s)</td>
  	
  	
  	
  	</tr>
  	</table>

  	<table align="left" border="0" cellpadding="1" cellspacing="2">
  	<tr><td width="70px"><b>Plagiarism:</b></td>
  	<td width="100px"><b>&nbsp;&#10003;Checked: </b><input type="text" name="ad_post_plagiarism" size="8" maxlength="20" value="<?php echo htmlspecialchars($ad_post_plagiarism); ?>" placeholder="Yes/No"></td>
	<td width="100px"><b>&nbsp;<font style="color:red">&#37; Plagiarism: </font></b><input type="text" name="ad_post_plagiarism_plag" size="8" maxlength="20" value="<?php echo htmlspecialchars($ad_post_plagiarism_plag); ?>" placeholder="% Plagiarism"></td>
	<td width="100px"><b>&nbsp;<font style="color:green">&#37; Unique: </font></b><input type="text" name="ad_post_plagiarism_unique" size="8" maxlength="20" value="<?php echo htmlspecialchars($ad_post_plagiarism_unique); ?>" placeholder="% Unique"></td>
	</tr>
	</table>
  	
  	<!-- <table align="left" border="0" cellpadding="1" cellspacing="2" width="100%" bgcolor="#e7e7e7">
  	<tr><td width="70px"><b>Post Term:</b></td><td width="110px"><input type="text" name="ad_post_term_year" size="3" maxlength="10" value="<?php echo htmlspecialchars($ad_post_term_year); ?>" placeholder="0"> Year(s)</td>
	<td><input type="text" name="ad_post_term_months" size="2" maxlength="10" value="<?php echo htmlspecialchars($ad_post_term_months); ?>" placeholder="0"> Months(s)</td></tr>
	</table> -->
	
	<table align="left" border="0" cellpadding="1" cellspacing="2" width="100%" bgcolor="#e7e7e7">
	<tr><td width="70px"><b>Post Title:</b></td><td><input type="text" name="ad_post_title" size="135" maxlength="300" value="<?php echo htmlspecialchars($ad_post_title); ?>"></td></tr>
	<tr><td><b>*Post URL:</b></td><td><input type="text" name="ad_post_url" size="135" maxlength="300" value="<?php echo htmlspecialchars($ad_post_url); ?>"></td></tr>
	</table>
	<table align="left" border="0" cellpadding="1" cellspacing="2" width="100%">
	<tr><td align="right" colspan="2"><i> *required to search the <a href="admin.php?page=my-revenue-books/myrevenuebooks_link_report.php">link report</a>.&nbsp;&nbsp;</i></td></tr>
	</table>
</div>


<div class="mrb_invoice_body_wrapper">


<!-- //////////////////// LINK 1 //////////////////// -->
<div class="mrb_ad_link_wrapper">
	<table align="left" border="0" cellpadding="1" cellspacing="0" width="100%">
	<tr bgcolor="#cecece"><td width="80"><b><span class="dashicons dashicons-admin-links"></span><b>Link 1:</b></td>
	
	<td width="300">
		<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<?php if ($link_selection1 == "Primary") { ?><td align="left"><div class="mrb_link_heading"><input type="radio" name="link_selection1" value="Primary" checked> Primary Link</div></td><?php }
		else echo "<td><div class='mrb_link_heading'><input type='radio' name='link_selection1' value='Primary'> Primary Link</div></td>"; ?>
	
	<?php if ($link_selection1 == "Reference") { ?><td><div class="mrb_link_heading"><input type="radio" name="link_selection1" value="Reference" checked> Reference Link</div></td><?php }
		else echo "<td><div class='mrb_link_heading'><input type='radio' name='link_selection1' value='Reference'> Reference Link</div></td>"; ?>

	<?php if ($link_selection1 == "Other") { ?><td><div class="mrb_link_heading"><input type="radio" name="link_selection1" value="Other" checked> Other</div></td><?php }
		else echo "<td><div class='mrb_link_heading'><input type='radio' name='link_selection1' value='Other'> Other</div></td>"; ?>
		</table>
		</td>
		<td width="300"> </td>
	
	<td align="center"><div class="mrb_link_heading">Domain Authority</div></td>
	<td align="center"><div class="mrb_link_heading">Page Authority</div></td>
	<td align="center"><div class="mrb_link_heading">Spam Score</div></td></tr>

	<tr><td align="right"><b>Anchor Text:&nbsp;</b></td>
	<td colspan="2"><input type="text" name="ad_post_anchor_text" size="90" value="<?php echo htmlspecialchars($ad_post_anchor_text); ?>"></td>
	<td align="center"><input type="text" name="da_score" size="8" value="<?php echo htmlspecialchars($da_score); ?>"></td>
	<td align="center"><input type="text" name="pa_score" size="8" value="<?php echo htmlspecialchars($pa_score); ?>"></td>
	<td align="center"><input type="text" name="spam_score" size="8" value="<?php echo htmlspecialchars($spam_score); ?>"></td>
	</tr>
	
	<tr><td align="right"><b>Link URL:&nbsp;</b></td>
	<td colspan="5"><input type="text" name="ad_link_url" size="143" maxlength="200" value="<?php echo htmlspecialchars($ad_link_url); ?>"></td>
	</tr></table>
</div>
<!-- //////////////////// END LINK 1 //////////////////// -->


<!-- //////////////////// LINK 2 //////////////////// -->
<div class="mrb_ad_link_wrapper">
	<table align="left" border="0" cellpadding="1" cellspacing="0" width="100%">
	<tr bgcolor="#cecece"><td width="80"><b><span class="dashicons dashicons-admin-links"></span><b>Link 2:</b></td>
	
	<td width="300">
		<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<?php if ($link_selection2 == "Primary") { ?><td align="left"><div class="mrb_link_heading"><input type="radio" name="link_selection2" value="Primary" checked> Primary Link</div></td><?php }
		else echo "<td><div class='mrb_link_heading'><input type='radio' name='link_selection2' value='Primary'> Primary Link</div></td>"; ?>
	
	<?php if ($link_selection2 == "Reference") { ?><td><div class="mrb_link_heading"><input type="radio" name="link_selection2" value="Reference" checked> Reference Link</div></td><?php }
		else echo "<td><div class='mrb_link_heading'><input type='radio' name='link_selection2' value='Reference'> Reference Link</div></td>"; ?>

	<?php if ($link_selection2 == "Other") { ?><td><div class="mrb_link_heading"><input type="radio" name="link_selection2" value="Other" checked> Other</div></td><?php }
		else echo "<td><div class='mrb_link_heading'><input type='radio' name='link_selection2' value='Other'> Other</div></td>"; ?>
		</table>
		</td>
		<td width="300"> </td>
	
	<td align="center"><div class="mrb_link_heading">Domain Authority</div></td>
	<td align="center"><div class="mrb_link_heading">Page Authority</div></td>
	<td align="center"><div class="mrb_link_heading">Spam Score</div></td></tr>

	<tr><td align="right"><b>Anchor Text:&nbsp;</b></td>
	<td colspan="2"><input type="text" name="ad_post_anchor_text2" size="90" value="<?php echo htmlspecialchars($ad_post_anchor_text2); ?>"></td>
	<td align="center"><input type="text" name="da_score2" size="8" value="<?php echo htmlspecialchars($da_score2); ?>"></td>
	<td align="center"><input type="text" name="pa_score2" size="8" value="<?php echo htmlspecialchars($pa_score2); ?>"></td>
	<td align="center"><input type="text" name="spam_score2" size="8" value="<?php echo htmlspecialchars($spam_score2); ?>"></td>
	</tr>
	
	<tr><td align="right"><b>Link URL:&nbsp;</b></td>
	<td colspan="5"><input type="text" name="ad_link_url2" size="143" maxlength="200" value="<?php echo htmlspecialchars($ad_link_url2); ?>"></td>
	</tr></table>
</div>
<!-- //////////////////// END LINK 2 //////////////////// -->


<!-- //////////////////// LINK 3 //////////////////// -->
<div class="mrb_ad_link_wrapper">
	<table align="left" border="0" cellpadding="1" cellspacing="0" width="100%">
	<tr bgcolor="#cecece"><td width="80"><b><span class="dashicons dashicons-admin-links"></span><b>Link 3:</b></td>
	
	<td width="300">
		<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<?php if ($link_selection3 == "Primary") { ?><td align="left"><div class="mrb_link_heading"><input type="radio" name="link_selection3" value="Primary" checked> Primary Link</div></td><?php }
		else echo "<td><div class='mrb_link_heading'><input type='radio' name='link_selection3' value='Primary'> Primary Link</div></td>"; ?>
	
	<?php if ($link_selection3 == "Reference") { ?><td><div class="mrb_link_heading"><input type="radio" name="link_selection3" value="Reference" checked> Reference Link</div></td><?php }
		else echo "<td><div class='mrb_link_heading'><input type='radio' name='link_selection3' value='Reference'> Reference Link</div></td>"; ?>

	<?php if ($link_selection3 == "Other") { ?><td><div class="mrb_link_heading"><input type="radio" name="link_selection3" value="Other" checked> Other</div></td><?php }
		else echo "<td><div class='mrb_link_heading'><input type='radio' name='link_selection3' value='Other'> Other</div></td>"; ?>
		</table>
		</td>
		<td width="300"> </td>
	
	<td align="center"><div class="mrb_link_heading">Domain Authority</div></td>
	<td align="center"><div class="mrb_link_heading">Page Authority</div></td>
	<td align="center"><div class="mrb_link_heading">Spam Score</div></td></tr>

	<tr><td align="right"><b>Anchor Text:&nbsp;</b></td>
	<td colspan="2"><input type="text" name="ad_post_anchor_text3" size="90" value="<?php echo htmlspecialchars($ad_post_anchor_text3); ?>"></td>
	<td align="center"><input type="text" name="da_score3" size="8" value="<?php echo htmlspecialchars($da_score3); ?>"></td>
	<td align="center"><input type="text" name="pa_score3" size="8" value="<?php echo htmlspecialchars($pa_score3); ?>"></td>
	<td align="center"><input type="text" name="spam_score3" size="8" value="<?php echo htmlspecialchars($spam_score3); ?>"></td>
	</tr>
	
	<tr><td align="right"><b>Link URL:&nbsp;</b></td>
	<td colspan="5"><input type="text" name="ad_link_url3" size="143" maxlength="200" value="<?php echo htmlspecialchars($ad_link_url3); ?>"></td>
	</tr></table>
</div>
<!-- //////////////////// END LINK 3 //////////////////// -->


<!-- //////////////////// LINK 4 //////////////////// -->
<div class="mrb_ad_link_wrapper">
	<table align="left" border="0" cellpadding="1" cellspacing="0" width="100%">
	<tr bgcolor="#cecece"><td width="80"><b><span class="dashicons dashicons-admin-links"></span><b>Link 4:</b></td>
	
	<td width="300">
		<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<?php if ($link_selection4 == "Primary") { ?><td align="left"><div class="mrb_link_heading"><input type="radio" name="link_selection4" value="Primary" checked> Primary Link</div></td><?php }
		else echo "<td><div class='mrb_link_heading'><input type='radio' name='link_selection4' value='Primary'> Primary Link</div></td>"; ?>
	
	<?php if ($link_selection4 == "Reference") { ?><td><div class="mrb_link_heading"><input type="radio" name="link_selection4" value="Reference" checked> Reference Link</div></td><?php }
		else echo "<td><div class='mrb_link_heading'><input type='radio' name='link_selection4' value='Reference'> Reference Link</div></td>"; ?>

	<?php if ($link_selection4 == "Other") { ?><td><div class="mrb_link_heading"><input type="radio" name="link_selection4" value="Other" checked> Other</div></td><?php }
		else echo "<td><div class='mrb_link_heading'><input type='radio' name='link_selection4' value='Other'> Other</div></td>"; ?>
		</table>
		</td>
		<td width="300"> </td>
	
	<td align="center"><div class="mrb_link_heading">Domain Authority</div></td>
	<td align="center"><div class="mrb_link_heading">Page Authority</div></td>
	<td align="center"><div class="mrb_link_heading">Spam Score</div></td></tr>

	<tr><td align="right"><b>Anchor Text:&nbsp;</b></td>
	<td colspan="2"><input type="text" name="ad_post_anchor_text4" size="90" value="<?php echo htmlspecialchars($ad_post_anchor_text4); ?>"></td>
	<td align="center"><input type="text" name="da_score4" size="8" value="<?php echo htmlspecialchars($da_score4); ?>"></td>
	<td align="center"><input type="text" name="pa_score4" size="8" value="<?php echo htmlspecialchars($pa_score4); ?>"></td>
	<td align="center"><input type="text" name="spam_score4" size="8" value="<?php echo htmlspecialchars($spam_score4); ?>"></td>
	</tr>
	
	<tr><td align="right"><b>Link URL:&nbsp;</b></td>
	<td colspan="5"><input type="text" name="ad_link_url4" size="143" maxlength="200" value="<?php echo htmlspecialchars($ad_link_url4); ?>"></td>
	</tr></table>
</div>
<!-- //////////////////// END LINK 4 //////////////////// -->














	
</div>
	


		
		
		
<!-- ///////////////////////// AD DETAILS ///////////////////////// -->	
		
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td width="100%"><span class="dashicons dashicons-open-folder"></span> <b>Description:</b><br><textarea style="width: 99.5%; max-width: 99.5%;" rows="8" name="description" maxlength="900000" <?php echo $mrb_edit_status; ?> ><?php echo htmlspecialchars($description); ?></textarea></td></tr>
	<tr><td><span class="dashicons dashicons-html"></span> <b>HTML:</b><br><textarea style="width: 99.5%; max-width: 99.5%;" rows="8" name="ad_html" maxlength="900000" <?php echo $mrb_edit_status; ?> ><?php echo htmlspecialchars($ad_html); ?></textarea></td></tr>
	<tr><td><span class="dashicons dashicons-media-text"></span> <b>Notes:</b><br><textarea style="width: 99.5%; max-width: 99.5%;" rows="8" name="notes" maxlength="900000" <?php echo $mrb_edit_status; ?> ><?php echo htmlspecialchars($notes); ?></textarea></td></tr>
	<tr><td><span class="dashicons dashicons-media-text"></span> <b>Log Notes:</b><br><textarea style="width: 99.5%; max-width: 99.5%;" rows="8" name="log_notes" maxlength="900000" <?php echo $mrb_edit_status; ?> ><?php echo htmlspecialchars($log_notes); ?></textarea></td></tr>
	<tr><td>&nbsp;</td></tr>
	</table>
	
	








<script>
function mrbcalc(form) {
var	theAmount = "0";
var theSubTotal = "0";
var theDiscount = "0";
var theShipping = "0";
var theAdditional = "0";
var theFee = "0";
var theTax = "0";

var theSubTotal = document.getElementById("subtotal").value;
var theDiscount = document.getElementById("discount").value;
var theShipping = document.getElementById("shipping").value;
var theAdditional = document.getElementById("additional").value;
var theFee = document.getElementById("fee").value;
var theTax = document.getElementById("tax").value;

theAmount1 = parseFloat(theSubTotal)+parseFloat(theDiscount)+parseFloat(theShipping)+parseFloat(theAdditional)+parseFloat(theFee)+parseFloat(theTax);
theAmount = parseFloat(theAmount1).toFixed(2);

document.getElementById("mrbresult").innerHTML = theAmount;
return false;
}
</script>

<body onload="mrbcalc()">



<div class="mrb_invoice_body_wrapper">

	<div class="mrb_invoice_header_wrapper">
	<span class="dashicons dashicons-money-alt"></span> <b>Payment Details:</b>
	</div>
	
	<div class="mrb_desc_text_wrapper">
	<!-- <div class="mrb_desc_text"> -->
		<table width="100%">
		<tr><td> <b>Payment Date</b></td><td> <b>Payment Type</b></td><td> <b>Payment Name</b></td><td> <b>Payment Email</b></td><td> <b>Transaction ID or Number</b></td></tr>
		<tr><td><input type="text" name="payment_date" size="7" maxlength="100" placeholder="Date Rcvd" id="datepicker6" value="<?php echo htmlspecialchars($payment_date); ?>" <?php echo $mrb_edit_status; ?> ></td>
			<td><input type="text" name="payment_type" size="10" maxlength="200" placeholder="Cash, Paypal, etc." value="<?php echo htmlspecialchars($payment_type); ?>" <?php echo $mrb_edit_status; ?> ></td>
			<td><input type="text" name="payment_name" size="15" maxlength="100" placeholder="Sender name" value="<?php echo htmlspecialchars($payment_name); ?>" <?php echo $mrb_edit_status; ?> ></td>
			<td><input type="text" name="payment_email" size="25" maxlength="200" placeholder="Sender email address" value="<?php echo htmlspecialchars($payment_email); ?>" <?php echo $mrb_edit_status; ?> ></td>
			<td><input type="text" name="payment_transid" size="20" maxlength="100" placeholder="ID or number" value="<?php echo htmlspecialchars($payment_transid); ?>" <?php echo $mrb_edit_status; ?> ></td>
		</tr>
		</table>
	<!-- </div> -->
	
	<!-- <div class="mrb_desc_text"> -->
		<table width="100%">
		<tr><td><b>Payment Link:</b></td></tr>
		<tr><td><input type="text" name="payment_link" size="111" maxlength="300" value="<?php echo htmlspecialchars($payment_link); ?>" <?php echo $mrb_edit_status; ?> ></td></tr>
		<tr><td><b>Payment Details:</b></td></tr>
		<tr><td><textarea rows="16" cols="114" name="payment_details" maxlength="5000" placeholder="Add any additional ad, payment, or transaction details here." <?php echo $mrb_edit_status; ?> ><?php echo htmlspecialchars($payment_details); ?></textarea></td></tr>
		</table>
	<!-- </div> -->
</div>


<div class="mrb_desc_text_wrapper2">

	<div class="mrb_desc_text">
		<table width="100%">
		<tr><td><b>Subtotal:</b></td></tr>
		<tr><td><b>$</b><input type="number" id="subtotal" name="subtotal" value="<?php echo htmlspecialchars($subtotal); ?>" size="7" maxlength="20" placeholder="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onchange="mrbcalc(this)" class="pmtsize" required <?php echo $mrb_edit_status; ?> ></td></tr>
		</table>
	</div>
</div>


<div class="mrb_desc_text_wrapper3">
	<div class="mrb_desc_text">
		<table width="100%">
		<tr><td><b>Discount Amount:</b></td></tr>
		<tr><td><b>$</b><input type="number" id="discount" name="discount" value="<?php echo htmlspecialchars($discount); ?>" size="7" maxlength="20" placeholder="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onchange="mrbcalc(this)" class="pmtsize" required <?php echo $mrb_edit_status; ?> ></td></tr>
		</table>
	</div>

	<div class="mrb_desc_text">
		<table width="100%">
		<tr><td><b>Shipping Costs:</b></td></tr>
		<tr><td><b>$</b><input type="number" id="shipping" name="shipping" value="<?php echo htmlspecialchars($shipping); ?>" size="7" maxlength="20" placeholder="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onchange="mrbcalc(this)" class="pmtsize" required <?php echo $mrb_edit_status; ?> ></td></tr>
		</table>
	</div>
	
	<div class="mrb_desc_text">
		<table width="100%">
		<tr><td><b>Additional Cost:</b></td></tr>
		<tr><td><b>$</b><input type="number" id="additional" name="additional" value="<?php echo htmlspecialchars($additional); ?>" size="7" maxlength="20" placeholder="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onchange="mrbcalc(this)" class="pmtsize" required <?php echo $mrb_edit_status; ?> ></td></tr>
		</table>
	</div>

	<div class="mrb_desc_text">
		<table width="100%">
		<tr><td><b>Processing Fee:</b></td></tr>
		<tr><td><b>$</b><input type="number" id="fee" name="fee" value="<?php echo htmlspecialchars($fee); ?>" size="7" maxlength="20" placeholder="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onchange="mrbcalc(this)" class="pmtsize" required <?php echo $mrb_edit_status; ?> ></td></tr>
		</table>
	</div>
	
	<div class="mrb_desc_text">
		<table width="100%">
		<tr><td><b>Sales Tax:</b></td></tr>
		<tr><td><b>$</b><input type="number" id="tax" name="tax" value="<?php echo htmlspecialchars($tax); ?>" size="7" maxlength="20" placeholder="0.00" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onchange="mrbcalc(this)" class="pmtsize" required <?php echo $mrb_edit_status; ?> ></td></tr>
		</table>
	</div>
</div>

<div class="mrb_desc_text_wrapper2">
		<table width="100%" bgcolor="#ffffff">
		<tr><td><b>Total:</b></td></tr>
		<tr><td><b>$ <span id="mrbresult" name="amount"></span></b></td></tr>
		</table>
</div>

<div class="mrb_desc_text_wrapper4">
	<div class="mrb_desc_text">
		<table width="100%">
		<tr><td><b>Invoice Status:</b></td></tr>
		<tr><td>
			<select name="status" <?php echo $mrb_edit_status; ?> >
			<option value="<?php echo htmlspecialchars($status); ?>"><?php echo htmlspecialchars($status); ?></option>
			<?php if ($status <> "Accepted") {?> <option value="Accepted">Accepted</option><?php } ?>
    		<?php if ($status <> "Working") {?> <option value="Working">Working</option><?php } ?>
    		<?php if ($status <> "Paid") {?> <option value="Paid">Paid</option><?php } ?>
    		<?php if ($status <> "Pending") {?> <option value="Pending">Pending</option><?php } ?>
    		<?php if ($status <> "Cancelled") {?> <option value="Cancelled">Cancelled</option><?php } ?>
    		<?php if ($status <> "Removed") {?> <option value="Removed">Removed</option><?php } ?>
    		<?php if ($status <> "Other") {?> <option value="Other">Other</option><?php } ?>
 			</select>
		</td>
		
		<?php if ($mrb_trans_type == "add") { $mrb_update_value = "Add New";} ?>
		<?php if ($mrb_trans_type == "copy") { $mrb_update_value = "Add New";} ?>
		<?php if ($mrb_trans_type == "edit") { $mrb_update_value = "Update";} ?>
		

<!-- 
<?php if ($security_work_admin == "true" && $workorder_file_status == "Closed" || $security_work_admin == "true" && $workorder_file_status == "" || $security_work_admin == "true" && $workorder_file_status == "Open") { }?>
-->

		<?php if ($security_work_admin == "true") { ?>
		<td align="right"><input type="submit" name="edit-submit" class="button-primary" value="<?php echo $mrb_update_value;?>" /></td></tr>
		<?php } ?>
		
		<?php if ($security_work_access == "true" && $workorder_file_status == "Open" && $security_work_admin == "false") { ?>
		<td align="right"><input type="submit" name="edit-submit" class="button-primary" value="<?php echo $mrb_update_value;?>" /></td></tr>
		<?php } ?>
		
		<?php if ($security_work_access == "true" && $workorder_file_status == "Closed" && $security_work_admin == "false") { ?>
		<td align="right"><input type="submit" class="button-secondary" value="Closed" disabled></td></tr>
		<?php } ?>
		
		</table>
	</div>
</div>

</form>
</div>
</div> <!-- mrb_wrapper2 -->

<?php
$update_status="Y";

?>