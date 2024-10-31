<?php
$plugins_url = plugins_url();
$current_date = date("m/d/Y");
$current_version = myrevenuebooks_version;
//include_once ("includes/check_version.php");


	$chk_uninstall_id = 1;
	$the_busid = 1;
	$table = $wpdb->prefix . "myrevenuebooks";
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s AND business_id = %s", $chk_uninstall_id, $the_busid ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{ $mrb_settings = $myrevenuebooks_sql->mrb_settings;
		if (! $mrb_settings) {$mrb_settings = "init";}
	}
?>

<div id="mrb_main_wrapper">
	
	<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%">
	<tr>

<!-- home tab -->
	<?php if ($mrb_page == "Dashboard") { $mrb_menu_color = "mrb_menus"; } else { $mrb_menu_color = "mrb_menus2"; } ?>
		<td align="center" width="9%"><a href="admin.php?page=my-revenue-books/myrevenuebooks_index.php" title="Dashboard"><div class="<?php echo $mrb_menu_color; ?>"><span class="dashicons dashicons-dashboard"></span></a></div></td>
<!-- end home tab -->


<!-- workorder tab -->
<?php
	//if workorder access is true
	if ($the_security_option == "Enabled" && $mrb_current_user_id > 0 || $the_security_option == "Disabled") {
	if ($mrb_page == "Workorders Dashboard") { $mrb_menu_color = "mrb_menus"; } else { $mrb_menu_color = "mrb_menus2"; } ?>
<td align="center" width="9%"><a href="admin.php?page=my-revenue-books/workorders/dashboard.php" title="Workorders"><div class="<?php echo $mrb_menu_color; ?>"><span class="dashicons dashicons-hammer"></span></a></div></td>
<?php }
	
	//if workorder access is false
	if ($the_security_option == "Enabled" && $mrb_current_user_id == 0) { ?>
	<td align="center" width="9%"><font color="#c7c7c7"><div class="mrb_menus_noaccess"><span class="dashicons dashicons-hammer"></span></div></font></td>
	<?php } ?>
<!-- end workorder tab -->



<!-- accounts tab -->
<?php
	//if security is enabled and accounts access is true
	if ($the_security_option == "Enabled" && $security_accounts_access == "true" || $the_security_option == "Disabled") {
	if ($mrb_page == "Accounts") { $mrb_menu_color = "mrb_menus"; } else { $mrb_menu_color = "mrb_menus2"; } ?>
	<td align="center" width="9%"><a href="admin.php?page=my-revenue-books/myrevenuebooks_accounts.php" title="Accounts"><div class="<?php echo $mrb_menu_color; ?>"><span class="dashicons dashicons-groups"></span></a></div></td>
<?php }

	//if security is enabled and accounts access is false
	if ($the_security_option == "Enabled" && $security_accounts_access == "false") { ?>
	<td align="center" width="9%"><font color="#c7c7c7"><div class="mrb_menus_noaccess"><span class="dashicons dashicons-groups"></span></div></font></td>
	<?php } ?>
<!-- endaccounts tab -->


<!-- search tab -->
<?php
	//if security is enabled and search access is true
	if ($the_security_option == "Enabled" && $security_search_access == "true" || $the_security_option == "Disabled") {
	if ($mrb_page == "Search") { $mrb_menu_color = "mrb_menus"; } else { $mrb_menu_color = "mrb_menus2"; } ?>
	<td align="center" width="9%"><a href="admin.php?page=my-revenue-books/myrevenuebooks_search.php" title="Search"><div class="<?php echo $mrb_menu_color; ?>"><span class="dashicons dashicons-search"></span></a></div></td>
	<?php }
	
	//if security is enabled and search access is false
	if ($the_security_option == "Enabled" && $security_search_access == "false") { ?>
	<td align="center" width="9%"><font color="#c7c7c7"><div class="mrb_menus_noaccess"><span class="dashicons dashicons-search"></span></div></font></td>
	<?php } ?>
<!-- endsearch tab -->


<!-- reports tab -->
<?php
	//if security is enabled and reports access is true
	if ($the_security_option == "Enabled" && $security_reports_access == "true" || $the_security_option == "Disabled") {
	if ($mrb_page == "Reports") { $mrb_menu_color = "mrb_menus"; } else { $mrb_menu_color = "mrb_menus2"; } ?>
	<td align="center" width="9%"><a href="admin.php?page=my-revenue-books/myrevenuebooks_reports.php" title="Reports"><div class="<?php echo $mrb_menu_color; ?>"><span class="dashicons dashicons-chart-pie"></span></a></div></td>
	<?php }

	//if security is enabled and reports access is false
	if ($the_security_option == "Enabled" && $security_reports_access == "false") { ?>
	<td align="center" width="9%"><font color="#c7c7c7"><div class="mrb_menus_noaccess"><span class="dashicons dashicons-chart-pie"></span></div></font></td>
	<?php } ?>
<!-- endreports tab -->


<!-- settings tab -->
<?php
	//if security is enabled and settings access is true
	if ($the_security_option == "Enabled" && $security_settings_access == "true" || $the_security_option == "Disabled") {
	if ($mrb_page == "Settings") { $mrb_menu_color = "mrb_menus"; } else { $mrb_menu_color = "mrb_menus2"; } ?>
		<td align="center" width="9%"><a href="admin.php?page=my-revenue-books/myrevenuebooks_settings.php" title="Settings"><div class="<?php echo $mrb_menu_color; ?>"><span class="dashicons dashicons-admin-generic"></span></a></div></td>
		<?php } ?>

<?php	
	//if security is enabled and settings access is false
	if ($the_security_option == "Enabled" && $security_settings_access == "false") { ?>
		<td align="center" width="9%"><font color="#c7c7c7"><div class="mrb_menus_noaccess"><span class="dashicons dashicons-admin-generic"></span></div></font></td>
		<?php } ?>

<!-- endsettings tab -->


<!-- security tab -->
<?php
	//if security is enabled and security access is true
	if ($the_security_option == "Enabled" && $security_security_access == "true" || $the_security_option == "Disabled") {
		if ($mrb_page == "Security") { $mrb_menu_color = "mrb_menus"; } else { $mrb_menu_color = "mrb_menus2"; } ?>
		<td align="center" width="9%"><a href="admin.php?page=my-revenue-books/myrevenuebooks_security.php" title="Security & Privacy"><div class="<?php echo $mrb_menu_color; ?>"><span class="dashicons dashicons-shield"></span></a></div></td>
		<?php } ?>

<?php
	//if security is enabled and security access is false
	if ($the_security_option == "Enabled" && $security_security_access == "false") { ?>
		<td align="center" width="9%"><font color="#c7c7c7"><div class="mrb_menus_noaccess"><span class="dashicons dashicons-shield"></span></div></font></td>
		<?php } ?>
<!-- end security tab -->


<!-- help tab -->
<?php	
	//if security is enabled and settings access is true, show help
	if ($the_security_option == "Enabled" && $security_settings_access == "true" || $the_security_option == "Disabled") {
	if ($mrb_page == "Help Topics") { $mrb_menu_color = "mrb_menus"; } else { $mrb_menu_color = "mrb_menus2"; } ?>
	<td align="center" width="9%"><a href="admin.php?page=my-revenue-books/myrevenuebooks_help.php" title="Help Topics"><div class="<?php echo $mrb_menu_color; ?>"><span class="dashicons dashicons-buddicons-topics"></span></a></div></td>
	<?php }

	//if security is enabled and settings access is true, dont show help
	if ($the_security_option == "Enabled" && $security_settings_access == "false") { ?>
	<td align="center" width="9%"><font color="#c7c7c7"><div class="mrb_menus_noaccess"><span class="dashicons dashicons-buddicons-topics"></span></div></font></td>
	<?php } ?>
<!-- end help tab -->


<!-- mrb version and information -->
	<?php $mrb_menu_color = "mrb_menus3"; ?>
	<td align="right" width="51%"><div class="<?php echo $mrb_menu_color; ?>"><b>My Revenue Books</b> | v<?php echo htmlspecialchars($current_version); ?>
		<?php if ($the_security_option == "Enabled" && $security_security_access == "true" || $the_security_option == "Disabled") { ?>
		<br>Security & Privacy: <a href="admin.php?page=my-revenue-books/myrevenuebooks_security.php"><?php echo $the_security_option; ?></a> </div></td></tr></table>
		<?php }
		
		if ($the_security_option == "Enabled" && $security_security_access == "false") { ?>
		<br>Security & Privacy: <?php echo $the_security_option; ?> </div></td></tr></table>
		<?php } ?>
<!-- end mrb version and information -->




<?php
	if ($mrb_settings == "init") { ?>
		
	<table align="center" border="1" cellpadding="2" cellspacing="2" width="70%" bordercolor="#ff0000">
	<tr><td align="center"><font color="red"><b>NOTICE: </b><font color="red">You must visit the <a href="admin.php?page=my-revenue-books/myrevenuebooks_settings.php">settings</a> and <a href="admin.php?page=my-revenue-books/myrevenuebooks_security.php">security</a> pages to complete the initial setup before beginning!</font></td>
		</tr>
		</table>
<?php } ?>

