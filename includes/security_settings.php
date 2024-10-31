<?php

$table_security = $wpdb->prefix . "myrevenuebooks_security";

			//count security user count for options
			$security_type_check = "User";
			$userid_check = 0;
			$mrb_user_count = 0;

			$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE userid <> %s AND security_type = %s", $userid_check, $security_type_check ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ $mrb_user_count++; }

	

// ----------------------------
    // Check if form is submitted successfully
    if(isset($_POST[$mrb_form_submit_name]))
    {
        // Check if any option is selected
        if(isset($_POST[$mrb_form_post_name]))
        {
        		$the_submitted_userid = 0;
				$the_userid_add = 0;
        		
        		//remove all users before adding new ones
        		//$remove_reminder_users = "dashboard_reminder"; //default
        		$remove_the_id = 0; //default
        		$remove_userid_check = "";
				$deletenonce=$_REQUEST['_wpnonce'];
			if (! wp_verify_nonce($deletenonce, 'my-nonce') ) die("Unable to complete your request!");
			$wpdb->query( $wpdb->prepare( "DELETE FROM $table_security WHERE security_type = %s AND userid <> %s AND id > %s", $mrb_remove_current_users, $remove_userid_check, $remove_the_id ));
        	
            //Count the users selected
            $thecount = count($_POST[$mrb_form_post_name]);
            
            //Check for ALL selection
            	$a = 0;
    			$the_submitted_userid_check = $_POST[$mrb_form_post_name];
    			$the_userid_add_check = $the_submitted_userid_check[$a];
								
				//Add ALL default values
				if ($the_userid_add_check == "ALL") {
								$thecount = 1;//set to query no user selections if ALL is found
								$the_userid_add = "ALL"; //default
								$mrb_user_firstname_query = "All";
								$mrb_user_lastname_query = "Users";
								$mrb_user_email_query = "All";
								$mrb_user_role_query = "ALL";
								$mrb_user_role_level_query = 1;
								} 
           
            // Retrieving each selected option
            	for ($i = 0; $i < $thecount; $i++) {
    			$the_submitted_userid = $_POST[$mrb_form_post_name];
    			$the_userid_add = $the_submitted_userid[$i];
    			
    		//add the user information
    		$security_type_query_user = "User"; //default
    		$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND userid = %s", $security_type_query_user, $the_userid_add ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ 
				$mrb_user_firstname_query = $myrevenuebooks_sql->user_firstname;
				$mrb_user_lastname_query = $myrevenuebooks_sql->user_lastname;
				$mrb_user_role_query = $myrevenuebooks_sql->user_role;
				$mrb_user_role_level_query = $myrevenuebooks_sql->user_role_level;
				$mrb_user_email_query = $myrevenuebooks_sql->user_email;
			}

    	
    	//add user to the database
    	$wpdb->query( $wpdb->prepare( "INSERT INTO " . $table_security . " (
		security_type,
		userid,
		user_firstname,
		user_lastname,
		user_email,
		user_role,
		user_role_level
			)
		VALUES ( %s,%s,%s,%s,%s,%s,%s )",
		$mrb_remove_current_users,
		$the_userid_add,
		$mrb_user_firstname_query,
		$mrb_user_lastname_query,
		$mrb_user_email_query,
		$mrb_user_role_query,
		$mrb_user_role_level_query,
			));
					}
        }     
    else
        echo "You did not select any users!";
        
        
        
        
        
        
   //check to see if curent user is a security user.  If not, add them to avoid being locked out of the security page
    		$check_sec_id = "";
    		$check_all_id = "ALL";
    		$check_security = "security";
    		$check_sec_id1 = ""; //default
    		
    		//check for security ALL users
    		$myrevenuebooks_sqlqz = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND userid = %s", $check_security, $check_all_id ));
			foreach ( $myrevenuebooks_sqlqz as $myrevenuebooks_sqlz ) 
			{ $check_sec_id1 = $myrevenuebooks_sqlz->userid; }
    		
    		echo "check_sec_id1: " . $check_sec_id1 . "<br>";
    		
    		//check for individual security users.  If selected, add current user
    		$myrevenuebooks_sqlqx = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND userid = %s", $check_security, $mrb_user_id ));
			foreach ( $myrevenuebooks_sqlqx as $myrevenuebooks_sqlx ) 
			{ $check_sec_id = $myrevenuebooks_sqlx->userid; }
			
			$mrb_current_user_check = wp_get_current_user();
			$mrb_user_firstname_query2 = $mrb_current_user_check->user_firstname; //wordpress first name
				if ($mrb_user_firstname_query2 == "") { $mrb_user_firstname_query2 = "No"; }
			$mrb_user_lastname_query2 = $mrb_current_user_check->user_lastname; //wordpress last name
				if ($mrb_user_lastname_query2 == "") { $mrb_user_lastname_query2 = "Name"; }
			
			if ($check_sec_id == "" && $check_sec_id1 == "") {
						$mrb_add_current_users2 = "security";
						$the_userid_add2 = $mrb_user_id;
						$mrb_user_role_query2 = "Administrator"; 
						$mrb_user_role_level_query2 = 1;
				    	$wpdb->query( $wpdb->prepare( "INSERT INTO " . $table_security . " (
						security_type,
						userid,
						user_firstname,
						user_lastname,
						user_role,
						user_role_level
										)
						VALUES ( %s,%s,%s,%s,%s,%s )",
						$mrb_add_current_users2,
						$the_userid_add2,
						$mrb_user_firstname_query2,
						$mrb_user_lastname_query2,
						$mrb_user_role_query2,
						$mrb_user_role_level_query2,
									));			
			}
    	
    	echo "<meta http-equiv='refresh' content='0; URL=admin.php?page=my-revenue-books/myrevenuebooks_security.php'>";
	exit;	
}

?>




		
		<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%" bgcolor="<?php echo $mrb_security_section_color; ?>">
		<tr height="32px"><td width="22px" align="left"><?php echo $mrb_security_section_icon;?></td>
			<td width="230px" align="left"><b><?php echo $mrb_security_section_name; ?></b></td>
			<td width="200px" align="left"><b>Current Users:</b></td>
			<td width="200px"><b>Select Users:</b></td>
			<td></td>
			<td></td></tr></table>
			
			<table align="left" border="0" cellpadding="4" cellspacing="0" width="100%" bgcolor="#ffffff">
			<form method = "post">		
			
			<tr><td width="22px"></td>
				
				<!-- if the section is a workorder setting -->
				<?php if($mrb_security_section == "workorder_admin") {
					echo "<td width='230px'><span class='dashicons dashicons-info'></span> Workorder administrators will have access to <u>all</u> of the workorders, add new workorders, edit open or closed workorders, and will have workorder search capabilities.</td>"; }?>
				
				<?php if($mrb_security_section == "workorder") { 
					echo "<td width='230px'><span class='dashicons dashicons-info'></span> Workorder users will only have access to their workorders, add new workorders, edit their open orders only, and no workorder search capabilities.</td>"; }?>
				
				
				<!-- if the section is not a workorder setting -->
				<?php if($mrb_security_section <> "workorder_admin" && $mrb_security_section <> "workorder" ) { echo "<td width='230px'></td>"; }?>	
				
				
				<td width="200px" align="left"><select name = '<?php echo $mrb_form_select_name; ?>[]' multiple size = <?php echo $mrb_user_count + 1; ?>>
			
			<?php //get user information
			$mrb_user_fullname_query1[$mrb_section] = "-All Users-"; //default
			$mrb_userid_query1[$mrb_section] = 0; //default
			//$security_type_query1[$mrb_section] = "dashboard_reminder"; //default
			$security_type_query1[$mrb_section] = $mrb_remove_current_users;
			$security_userid_query1[$mrb_section] = ""; //default
			$table_security = $wpdb->prefix . "myrevenuebooks_security";
			$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND userid <> %s", $security_type_query1[$mrb_section], $security_userid_query1[$mrb_section] ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ 
				$mrb_userid_query1[$mrb_section] = $myrevenuebooks_sql->userid;
				$mrb_user_firstname_query1[$mrb_section] = $myrevenuebooks_sql->user_firstname;
				$mrb_user_lastname_query1[$mrb_section] = $myrevenuebooks_sql->user_lastname;
				$mrb_user_role_query1[$mrb_section] = $myrevenuebooks_sql->user_role;
				$mrb_user_fullname_query1[$mrb_section] = $mrb_user_firstname_query1[$mrb_section] . " " . $mrb_user_lastname_query1[$mrb_section];
					
					//workorders set view to no users.  Workorders must contain users to assign and email
					if ($mrb_user_fullname_query1[$mrb_section] == "All Users" && $mrb_security_section_name == "Workorders") {
						$mrb_user_fullname_query1[$mrb_section] = "No Users"; }
			?>
			<option value = '<?php echo $mrb_userid_query1[$mrb_section]; ?>' disabled><?php echo $mrb_user_fullname_query1[$mrb_section]; ?></option>
			<?php } ?>
				
				<?php if ($mrb_user_fullname_query1[$mrb_section] == "ALL") { 
						$mrb_user_fullname_query1[$mrb_section] = "-All Users-";
						echo "<option value = '$mrb_userid_query1[$mrb_section]'>$mrb_user_fullname_query1[$mrb_section]</option>"; 
						} ?>
				
			
			
			
			</select></td>



		
		<td width="200px" align="left"><select name = '<?php echo $mrb_form_post_name; ?>[]' multiple size = <?php echo $mrb_user_count + 1; ?>>
<?php
			//get user information
			$u=0;
			$mrb_user_fullname_query2[$mrb_section] = "ALL"; //default
			$mrb_userid_query2[$mrb_section] = 0; //default
			$security_type_query2[$mrb_section] = "User"; //default
			$security_userid_query2[$mrb_section] = ""; //default
			$table_security = $wpdb->prefix . "myrevenuebooks_security";
			$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_security . " WHERE security_type = %s AND userid <> %s", $security_type_query2[$mrb_section], $security_userid_query2[$mrb_section] ));
			foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
			{ 
				$mrb_userid_query2[$mrb_section] = $myrevenuebooks_sql->userid;
				$mrb_user_firstname_query2[$mrb_section] = $myrevenuebooks_sql->user_firstname;
				$mrb_user_lastname_query2[$mrb_section] = $myrevenuebooks_sql->user_lastname;
				$mrb_user_role_query2[$mrb_section] = $myrevenuebooks_sql->user_role;
					$mrb_user_fullname_query2[$mrb_section] = $mrb_user_firstname_query2[$mrb_section] . " " . $mrb_user_lastname_query2[$mrb_section];
			?>
			
			
			
			<?php if ($u == 0 && $mrb_security_section_name == "Workorders") { echo "<option value = 'ALL'>-No Users-</option>"; } ?>
			<?php if ($u == 0 && $mrb_security_section_name == "Workorders: Users") { echo "<option value = 'NO'>-No Users-</option>"; } ?>
			
			<!-- <?php if ($u == 0 && $mrb_security_section_name <> "Workorders") { echo "<option value = 'ALL'>-All Users-</option>"; } ?> -->
				<?php if ($u == 0 && $mrb_security_section_name <> "Workorders: Users") { echo "<option value = 'ALL'>-All Users-</option>"; } ?>
			
			
			<option value = '<?php echo $mrb_userid_query2[$mrb_section]; ?>'><?php echo $mrb_user_fullname_query2[$mrb_section]; ?></option>
			<?php $u++;} ?>
			
			
				<?php if ($mrb_user_fullname_query2[$mrb_section] == "ALL") { echo "<option value = '$mrb_userid_query2[$mrb_section]'>$mrb_user_fullname_query2[$mrb_section]</option>"; } ?>
			
			</select></td><td align="left" style="color:#7d7d80;"><i>To select multiple users, hold down the control button (ctrl) on Windows or command button (cmd) on Mac.  If nothing is selected, all users will have access.</i></td>
			<input type="hidden" value="<?php echo $deletenonce; ?>" name="_wpnonce" />
			<td align="center" width="100px"><input type="submit" name="<?php echo $mrb_form_submit_name; ?>" class="button-secondary" value="Submit" action=""></td></tr>
        </form>
        <?php if ($mrb_security_section_name == "Page Access - Security & Privacy") { ?><tr><td colspan="6" align="center"><b>Note, you will not be able to remove yourself from the security page because you will be locked out!</b></td></tr><?php } ?>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
		</table>