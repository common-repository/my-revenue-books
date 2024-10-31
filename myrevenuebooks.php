<?php
/*
Plugin Name: my-revenue-books
Plugin URI: https://barryalbert.com
Description: A plugin that will make your record keeping of online advertising a lot easier.
Version: 5.1.5
Author: Barry Albert
Author URI: http://www.barryalbert.com
License: GPLv3
*/
/*
Copyright 2024  Barry Albert  (email : support@barryalbert.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 3, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Contact Form to Database Extension.
If not, see http://www.gnu.org/licenses/gpl-3.0.html
*/

if(!class_exists('myrevenuebooks'))
{
	class myrevenuebooks
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// Initialize Settings
			//include_once 'myrevenuebooks_shortcode.php';
			//include_once 'myrevenuebooks_shortcode_feedback.php';
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$myrevenuebooks_Settings = new myrevenuebooks_Settings();	
		} // END public function __construct
		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
		if( !wp_next_scheduled( 'myrevenuebooks_cronjob' ) ) {  
		wp_schedule_event( time(), 'off', 'myrevenuebooks_cronjob' ); // default cron for activation	
						}

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');  // This will load the proper functions
		global $wpdb;
	$table_name = $wpdb->prefix . "myrevenuebooks";
 
	$sql = "CREATE TABLE " . $table_name . " (
	id BIGINT(7) NOT NULL AUTO_INCREMENT,
	business_name LONGTEXT NULL,
	business_id INT(7) NULL,
	contact_name LONGTEXT NULL,
	address LONGTEXT NULL,
	address2 LONGTEXT NULL,
	city LONGTEXT NULL,
	state LONGTEXT NULL,
	zip LONGTEXT NULL,
	email LONGTEXT NULL,
	email_template1 LONGTEXT NULL,
	phone LONGTEXT NULL,
	phone2 LONGTEXT NULL,
	fax LONGTEXT NULL,
	website LONGTEXT NULL,
	business_logo LONGTEXT NULL,
	business_info LONGTEXT NULL,
	the_date LONGTEXT NULL,
	the_date2 LONGTEXT NULL,
	campain_start LONGTEXT NULL,
	campain_end LONGTEXT NULL,
	reminder LONGTEXT NULL,
	reminder_date LONGTEXT NULL,
	duration LONGTEXT NULL,
	description LONGTEXT NULL,
	payment_type LONGTEXT NULL,
	payment_details LONGTEXT NULL,
	amount LONGTEXT NULL,
	status LONGTEXT NULL,
	po_ref LONGTEXT NULL,
	notes LONGTEXT NULL,
	log_notes LONGTEXT NULL,
	last_edited LONGTEXT NULL,
	version LONGTEXT NULL,
	cron_interval LONGTEXT NULL,
	the_ref LONGTEXT NULL,
	reminder_sent LONGTEXT NULL,
	reminder_date_sent LONGTEXT NULL,
	primary_contact LONGTEXT NULL,
	secondary_contact LONGTEXT NULL,
	primary_email LONGTEXT NULL,
	secondary_email LONGTEXT NULL,
	ad_html LONGTEXT NULL,
	subtotal LONGTEXT NULL,
	discount LONGTEXT NULL,
	shipping LONGTEXT NULL,
	additional LONGTEXT NULL,
	fee LONGTEXT NULL,
	tax LONGTEXT NULL,
		ad_post_title LONGTEXT NULL,
		ad_post_url LONGTEXT NULL,
		ad_post_anchor_text LONGTEXT NULL,
		ad_post_term_year LONGTEXT NULL,
		ad_post_term_months LONGTEXT NULL,
		ad_post_status LONGTEXT NULL,
		da_score LONGTEXT NULL,
		pa_score LONGTEXT NULL,
		spam_score LONGTEXT NULL,
		ad_link_url LONGTEXT NULL,
		primary_notes LONGTEXT NULL,
		secondary_notes LONGTEXT NULL,
		ad_post_anchor_text2 LONGTEXT NULL,
		ad_post_anchor_text3 LONGTEXT NULL,
		ad_link_url2 LONGTEXT NULL,
		ad_link_url3 LONGTEXT NULL,
		da_score2 LONGTEXT NULL,
		da_score3 LONGTEXT NULL,
		pa_score2 LONGTEXT NULL,
		pa_score3 LONGTEXT NULL,
		spam_score2 LONGTEXT NULL,
		spam_score3 LONGTEXT NULL,
		ad_post_plagiarism LONGTEXT NULL,
		ad_post_plagiarism_plag LONGTEXT NULL,
		ad_post_plagiarism_unique LONGTEXT NULL,
		mrb_uninstall LONGTEXT NULL,
		mrb_settings LONGTEXT NULL,
		payment_date LONGTEXT NULL,
		payment_name LONGTEXT NULL,
		payment_email LONGTEXT NULL,
		payment_transid LONGTEXT NULL,
		payment_link LONGTEXT NULL,
		payment_terms LONGTEXT NULL,
		link_selection1 LONGTEXT NULL,
		link_selection2 LONGTEXT NULL,
		link_selection3 LONGTEXT NULL,
		link_selection4 LONGTEXT NULL,
		ad_post_anchor_text4 LONGTEXT NULL,
		ad_link_url4 LONGTEXT NULL,
		da_score4 LONGTEXT NULL,
		pa_score4 LONGTEXT NULL,
		spam_score4 LONGTEXT NULL,
		due_date LONGTEXT NULL,
		workorder_type LONGTEXT NULL,
		workorder_details LONGTEXT NULL,
		workorder_assigned LONGTEXT NULL,
		workorder_userid LONGTEXT NULL,
		workorder_username LONGTEXT NULL,
		workorder_useremail LONGTEXT NULL,
		workorder_total LONGTEXT NULL,
		workorder_commission LONGTEXT NULL,
		workorder_status LONGTEXT NULL,
		workorder_due_date LONGTEXT NULL,
		workorder_payment_details LONGTEXT NULL,
		workorder_payment_date LONGTEXT NULL,
	PRIMARY KEY  (id)
	)  $charset_collate;";
	dbDelta($sql);
                
$table_name2 = $wpdb->prefix . "myrevenuebooks_email";
	$sql = "CREATE TABLE " . $table_name2 . " (
	id BIGINT(7) NOT NULL AUTO_INCREMENT,
	the_id INT(7) NULL,
	business_id INT(7) NULL,
	email_from_name LONGTEXT NULL,
	email_from LONGTEXT NULL,
	email_to LONGTEXT NULL,
	email_to_cc LONGTEXT NULL,
	email_to_bcc LONGTEXT NULL,
	email_subject LONGTEXT NULL,
	email_body LONGTEXT NULL,
	reminder_sent LONGTEXT NULL,
	reminder_date_sent LONGTEXT NULL,
	PRIMARY KEY  (id)
	)  $charset_collate;";
	dbDelta($sql);

		$table_name3 = $wpdb->prefix . "myrevenuebooks_security";
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE $table_name3 (
		id BIGINT(7) NOT NULL AUTO_INCREMENT,
		security_option LONGTEXT NULL,
		security_type LONGTEXT NULL,
		column_number LONGTEXT NULL,
		column_name_display LONGTEXT NULL,
		column_setting LONGTEXT NULL,
		column_color LONGTEXT NULL,
		column_text_color LONGTEXT NULL,
		column_text_lenght LONGTEXT NULL,
 		userid LONGTEXT NULL,
		user_email LONGTEXT NULL,
		user_firstname LONGTEXT NULL,
		user_lastname LONGTEXT NULL,
		user_role LONGTEXT NULL,
		user_role_level LONGTEXT NULL,
		default_security_message LONGTEXT NULL,
		workorder_type LONGTEXT NULL,
		workorder_details LONGTEXT NULL,
		workorder_assigned LONGTEXT NULL,
		workorder_userid LONGTEXT NULL,
		workorder_username LONGTEXT NULL,
		workorder_useremail LONGTEXT NULL,
		workorder_commission LONGTEXT NULL,
		workorder_status LONGTEXT NULL,
		workorder_subject LONGTEXT NULL,
		workorder_subject_change LONGTEXT NULL,
		workorder_new_order_notify LONGTEXT NULL,
		workorder_order_change_notify LONGTEXT NULL,
		workorder_admin_email LONGTEXT NULL,
		workorder_file_status LONGTEXT NULL,
		PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	
	//Check for new install.....if so add info
	$security_option_check = "";
	$id_check = "";
	$x=0;
	$table3 = $wpdb->prefix . 'myrevenuebooks_security';
	$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table3 . " WHERE security_option <> %s AND id <> %s", $security_option_check, $id_check ));
	foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
	{
		$security_option = $myrevenuebooks_sql->security_option;
		$x++;
		}
			if ($x == 0) {
			//Add Initial Data to myrevenuebooks_security
			$security_option = "Disabled";
			$table_name3 = $wpdb->prefix . 'myrevenuebooks_security';
			$wpdb->insert( $table_name3, 
			array( 'security_option' => $security_option, ) 
			);
				}



	//Check for new install.....if so add generic info
	$the_id = "";
	$theid = "";
	$table = $wpdb->prefix . "myrevenuebooks";
	$easyshow_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id <> %s", $the_id  ));
	foreach ( $easyshow_sqlq as $easyshow_sql ) 
	{ 
	$theid = $easyshow_sql->id;
	}
	
		if ($theid == "") {
		global $wpdb;
		$business_name = "Your Business Name";
		$business_id = 1;
		$contact_name = "Your Full Name";
		$address = "Your Address";
		$address2 = "Address Line 2";
		$city = "City";
		$state = "St";
		$zip = "Zip";
		$email = "Your Email Address";
		$email_template1 = "This is your default email template.  You can customize this as your default template for all reminders sent. Use tags like [:primary_contact:], [:campaign_start:] and [:campaign_end:] to generate a custom email to each recipient.  You can also add your email signature here.";
		$phone = "000-000-0000";
		$phone2 = "000-000-0000";
		$fax = "000-000-0000";
		$website = "yourwebsite.com";
		//$version = "5.1.5";
		$version = myrevenuebooks_version;
		$cron_interval = "off";
		$mrb_uninstall = "no";
		$mrb_settings = "init";
		$payment_terms = "15";
		
		
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
		email_template1,
		phone,
		phone2,
		fax,
		website,
		version,
		cron_interval,
		mrb_uninstall,
		mrb_settings,
		payment_terms
		)
		VALUES ( %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s )
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
		$email_template1,
		$phone,
		$phone2,
		$fax,
		$website,
		$version,
		$cron_interval,
		$mrb_uninstall,
		$mrb_settings,
		$payment_terms
		) );
	}
	
		} // END public static function activate
		
		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			wp_clear_scheduled_hook('myrevenuebooks_cronjob'); //clear cron
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				global $wpdb;
				// Set cron default value
				$the_update_id = 1;
				$default_cron_interval = "off";
				$table = $wpdb->prefix . "myrevenuebooks";
				$wpdb->query($wpdb->prepare("UPDATE $table SET 
				cron_interval = %s
				WHERE id = $the_update_id;",
				$default_cron_interval ));
		} // END public static function deactivate
		
		
		public static function uninstall()
		{
			global $wpdb;
				$the_uninstall_id = 1;
				$table = $wpdb->prefix . "myrevenuebooks";
				$myrevenuebooks_sqlq = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table . " WHERE id = %s", $the_uninstall_id  ));
				foreach ( $myrevenuebooks_sqlq as $myrevenuebooks_sql ) 
				{ $mrb_uninstall = $myrevenuebooks_sql->mrb_uninstall; }
			if ($mrb_uninstall == "yes") {
				$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}myrevenuebooks" );
				$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}myrevenuebooks_email" ); 
				$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}myrevenuebooks_security" );}
			
			//$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}myrevenuebooks" );
			//$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}myrevenuebooks_email" );
			wp_clear_scheduled_hook('myrevenuebooks_cronjob'); //clear cron
		} // END public static function deactivate	
		

		// Add the settings link to the plugins page
		function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=myrevenuebooks">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}
		
	} // END class myrevenuebooks
} // END if(!class_exists('myrevenuebooks'))
if(class_exists('myrevenuebooks'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('myrevenuebooks', 'activate'));
	register_deactivation_hook(__FILE__, array('myrevenuebooks', 'deactivate'));
	register_uninstall_hook(__FILE__, array('myrevenuebooks', 'uninstall'));
	// instantiate the plugin class
	$myrevenuebooks = new myrevenuebooks();
}