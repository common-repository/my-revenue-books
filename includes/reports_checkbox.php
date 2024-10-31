<!-- //////////////// reports menu //////////////// -->
	<table align="left" border="0" cellpadding="2" cellspacing="1" width="100%">
	<td align="left"><div class="mrb_report_tab_wrapper"><span class="dashicons dashicons-chart-pie"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_reports.php">Reports</a></div></td>
	<td><div class="mrb_report_tab_wrapper"><span class="dashicons dashicons-groups"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_report_accounts.php">Detailed Account Report</a></div></td>
	<td><div class="mrb_report_tab_wrapper">&nbsp;<span class="dashicons dashicons-text-page"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_report_transactions.php">Detailed Transaction Report</a></div></td>
	<td><div class="mrb_report_tab_wrapper">&nbsp;<span class="dashicons dashicons-chart-bar"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_report_ytdcomp.php">YTD Comparison Report</a></div></td>
	<td><div class="mrb_report_tab_wrapper">&nbsp;<span class="dashicons dashicons-admin-links"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_link_report.php">Link Report</a></div></td>
	<td><div class="mrb_report_tab_wrapper">&nbsp;<span class="dashicons dashicons-hammer"></span>&nbsp;<a href="admin.php?page=my-revenue-books/myrevenuebooks_reports_workorders.php">Workorder Report</a></div></td>
	</tr>
	</table>
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td height="5px"> </td></tr>
	</table>
<!-- //////////////// end reports menu //////////////// -->




<div id="mrb_wrapper">

	<table align="left" border="0" cellpadding="0" cellspacing="2" width="100%">
	<tr><td><span class="dashicons dashicons-chart-bar"></span> <b>Reports - Detailed Transaction</b></td></tr>
	</table>
	
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	
	<form name="display-submit" method="post">
	<tr bgcolor="#d2d2d2"><td>Filter Dates From: <input type="text" name="from_date" value="<?php echo htmlspecialchars($from_date); ?>" size="10" maxlength="50" id="datepicker" />
		To: <input type="text" name="to_date" value="<?php echo htmlspecialchars($to_date); ?>" size="10" maxlength="50" id="datepicker2" />
	</td></tr></table>
	
	<table align="left" border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr bgcolor="#d9d9d9"><tr><td colspan="6" height="30"><b>Select the columns to display:</b></td></tr>
	<td><input type="checkbox" name="the_inv_date" value="Y" checked>Invoice Date</td>
	<td><input type="checkbox" name="the_business_name2" value="Y" checked disabled>Business Name</td>
	<td><input type="checkbox" name="the_po_ref" value="Y" <?php if (!empty($_POST['the_po_ref'])): ?> checked="checked"<?php endif; ?> >Inv/PO</td>
		<td><input type="checkbox" name="the_ref" value="Y" <?php if (!empty($_POST['the_ref'])): ?> checked="checked"<?php endif; ?> >Ref</td>
	<td><input type="checkbox" name="the_campain_start" value="Y" <?php if (!empty($_POST['the_campain_start'])): ?> checked="checked"<?php endif; ?> >Campain Start</td>
	<td><input type="checkbox" name="the_campain_end" value="Y" <?php if (!empty($_POST['the_campain_end'])): ?> checked="checked"<?php endif; ?> >Campain End</td></tr>
	
	<tr><td><input type="checkbox" name="the_reminder" value="Y" <?php if (!empty($_POST['the_reminder'])): ?> checked="checked"<?php endif; ?> >Reminder</td>
	<td><input type="checkbox" name="the_reminder_date" value="Y" <?php if (!empty($_POST['the_reminder_date'])): ?> checked="checked"<?php endif; ?> >Reminder Date</td>
		<td><input type="checkbox" name="reminder_sent" value="Y" <?php if (!empty($_POST['reminder_sent'])): ?> checked="checked"<?php endif; ?> >Reminder Sent</td>
	<td><input type="checkbox" name="reminder_date_sent" value="Y" <?php if (!empty($_POST['reminder_date_sent'])): ?> checked="checked"<?php endif; ?> >Reminder Sent Date</td>
	<td><input type="checkbox" name="the_description" value="Y" <?php if (!empty($_POST['the_description'])): ?> checked="checked"<?php endif; ?> >Description</td>
		<td><input type="checkbox" name="ad_html" value="Y" <?php if (!empty($_POST['ad_html'])): ?> checked="checked"<?php endif; ?> >Ad Html</td></tr>
		
		<tr><td><input type="checkbox" name="primary_contact" value="Y" <?php if (!empty($_POST['primary_contact'])): ?> checked="checked"<?php endif; ?> >Primary Contact</td>
		<td><input type="checkbox" name="primary_email" value="Y" <?php if (!empty($_POST['primary_email'])): ?> checked="checked"<?php endif; ?> >Primary Email</td>
		<td><input type="checkbox" name="secondary_contact" value="Y" <?php if (!empty($_POST['secondary_contact'])): ?> checked="checked"<?php endif; ?> >Secondary Contact</td>
		<td><input type="checkbox" name="secondary_email" value="Y" <?php if (!empty($_POST['secondary_email'])): ?> checked="checked"<?php endif; ?> >Secondary Email</td>
		<td><input type="checkbox" name="the_payment_type" value="Y" <?php if (!empty($_POST['the_payment_type'])): ?> checked="checked"<?php endif; ?> >Payment Type</td>
		<td><input type="checkbox" name="the_payment_details" value="Y" <?php if (!empty($_POST['the_payment_details'])): ?> checked="checked"<?php endif; ?> >Payment Details</td></tr>
	
		<tr><td><input type="checkbox" name="subtotal" value="Y" <?php if (!empty($_POST['subtotal'])): ?> checked="checked"<?php endif; ?> >Subtotal</td>
		<td><input type="checkbox" name="discount" value="Y" <?php if (!empty($_POST['discount'])): ?> checked="checked"<?php endif; ?> >Discount</td>
		<td><input type="checkbox" name="shipping" value="Y" <?php if (!empty($_POST['shipping'])): ?> checked="checked"<?php endif; ?> >Shipping</td>
		<td><input type="checkbox" name="additional" value="Y" <?php if (!empty($_POST['additional'])): ?> checked="checked"<?php endif; ?> >Addl Amount</td>
		<td><input type="checkbox" name="fee" value="Y" <?php if (!empty($_POST['fee'])): ?> checked="checked"<?php endif; ?> >Fees</td>
		<td><input type="checkbox" name="tax" value="Y" <?php if (!empty($_POST['tax'])): ?> checked="checked"<?php endif; ?> >Tax</td></tr>
		
	<tr><td><input type="checkbox" name="the_amount" value="Y" <?php if (!empty($_POST['the_amount'])): ?> checked="checked"<?php endif; ?> >Amount</td>
	<td><input type="checkbox" name="the_status" value="Y" <?php if (!empty($_POST['the_status'])): ?> checked="checked"<?php endif; ?> >Status</td>
	<td><input type="checkbox" name="the_notes" value="Y" <?php if (!empty($_POST['the_notes'])): ?> checked="checked"<?php endif; ?> >Notes</td>
	<td><input type="checkbox" name="the_log_notes" value="Y" <?php if (!empty($_POST['the_log_notes'])): ?> checked="checked"<?php endif; ?> >Log Notes</td>
	<td><input type="checkbox" name="the_duration" value="Y" <?php if (!empty($_POST['the_duration'])): ?> checked="checked"<?php endif; ?> >Duration Notes</td></tr>
	
	<input type="hidden" value="Y" name="the_business_name" />
	</table>
	
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<tr><td height="45" align="center" width="85%"><input type="submit" name="display-submit" value="Get Report" /></td>
	</tr>
	</form>
	</table>
</div>