<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">

<form name="export" method="post" action="admin.php?page=my-revenue-books/myrevenuebooks_report_transactions.php&noheader=true">

<input type="hidden" name="from_date" value="<?php echo htmlspecialchars($from_date); ?>" size="10" maxlength="50" id="datepicker" />
<input type="hidden" name="to_date" value="<?php echo htmlspecialchars($to_date); ?>" size="10" maxlength="50" id="datepicker2" />


<input type="hidden" name="the_inv_date2" value="Y" checked>
<input type="hidden" name="the_business_name2" value="Y" checked disabled>
<input type="hidden" name="the_po_ref2" value="<?php if (!empty($_POST['the_po_ref'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="the_ref2" value="<?php if (!empty($_POST['the_ref'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="the_campain_start2" value="<?php if (!empty($_POST['the_campain_start'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="the_campain_end2" value="<?php if (!empty($_POST['the_campain_end'])): ?>Y<?php endif; ?>" >

<input type="hidden" name="the_reminder2" value="<?php if (!empty($_POST['the_reminder'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="the_reminder_date2" value="<?php if (!empty($_POST['the_reminder_date'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="reminder_sent2" value="<?php if (!empty($_POST['reminder_sent'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="reminder_date_sent2" value="<?php if (!empty($_POST['reminder_date_sent'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="the_description2" value="<?php if (!empty($_POST['the_description'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="ad_html2" value="<?php if (!empty($_POST['ad_html'])): ?>Y<?php endif; ?>" >

<input type="hidden" name="primary_contact2" value="<?php if (!empty($_POST['primary_contact'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="primary_email2" value="<?php if (!empty($_POST['primary_email'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="secondary_contact2" value="<?php if (!empty($_POST['secondary_contact'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="secondary_email2" value="<?php if (!empty($_POST['secondary_email'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="the_payment_type2" value="<?php if (!empty($_POST['the_payment_type'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="the_payment_details2" value="<?php if (!empty($_POST['the_payment_details'])): ?>Y<?php endif; ?>" >

<input type="hidden" name="subtotal2" value="<?php if (!empty($_POST['subtotal'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="discount2" value="<?php if (!empty($_POST['discount'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="shipping2" value="<?php if (!empty($_POST['shipping'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="additional2" value="<?php if (!empty($_POST['additional'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="fee2" value="<?php if (!empty($_POST['fee'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="tax2" value="<?php if (!empty($_POST['tax'])): ?>Y<?php endif; ?>" >

<input type="hidden" name="the_amount2" value="<?php if (!empty($_POST['the_amount'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="the_status2" value="<?php if (!empty($_POST['the_status'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="the_notes2" value="<?php if (!empty($_POST['the_notes'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="the_log_notes2" value="<?php if (!empty($_POST['the_log_notes'])): ?>Y<?php endif; ?>" >
<input type="hidden" name="the_duration2" value="<?php if (!empty($_POST['the_duration'])): ?>Y<?php endif; ?>" >

<input type="hidden" value="Y" name="the_business_name" />

	
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<tr><td height="45" align="center" width="85%"><button class="button-primary" type="submit" name="download_csv" value="">Download (.csv)</button></td></tr>
	</form>
	</table>