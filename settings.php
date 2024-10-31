<?php
define ( 'myrevenuebooks_plugin_url', plugin_dir_url(__FILE__)); // Media upload
define ('myrevenuebooks_version', '5.1.5');



if(!class_exists('myrevenuebooks_Settings'))
{
	class myrevenuebooks_Settings
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'addSettingsSubMenuPageToTopLevelMenu'));
			add_action( 'admin_enqueue_scripts', array(&$this, 'myrevenuebooks_media_admin_scripts' )); // Media upload
			add_action('init', array(&$this, 'register_plugin_styles'));
			add_action('myrevenuebooks_cronjob', array(&$this,'myrevenuebooks_cron_job')); // cron job
			add_filter('cron_schedules', array(&$this,'myrevenuebooks_cron_add' )); // cron job schedules
		} // END public function __construct

	function myrevenuebooks_cron_add( $schedules ) { 
	// Wordpress default values: hourly, twicedaily, daily
   	$schedules['weekly'] = array('interval' => (60 * 60 * 24 * 7), 'display' => __('Once Weekly', 'myrevenuebooks'));
   	//$schedules['every4hours'] = array('interval' => 60 * 60 * 4, 'display' => __('Every 4 Hours', 'myrevenuebooks'));
    //$schedules['twiceperhour'] = array('interval' => 60 * 30, 'display' => __('Twice per hour', 'myrevenuebooks'));
    //$schedules['tenminutes'] = array('interval' => 60 * 10, 'display' => __('Every 10 minutes', 'myrevenuebooks'));
    //$schedules['fiveminutes'] = array('interval' => 60 * 5, 'display' => __('Every 5 minutes', 'myrevenuebooks'));
    //$schedules['oneminute'] = array('interval' => 60 * 1, 'display' => __('Every 1 minute', 'myrevenuebooks'));
    return $schedules;
			}
		
		// Wordpress default values: hourly, twicedaily, daily
		function myrevenuebooks_cron_job() {
			include ("myrevenuebooks_reminder.php");
			include ("includes/check_version.php");
			}

        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
 
        } // END public static function activate
        
		
        
        public function settings_section_myrevenuebooks()
        {
            
        }
        
        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args)
        {

        }
        
        
        // Media upload
        public function myrevenuebooks_media_admin_scripts() 
		{
		 wp_enqueue_media();
		 wp_enqueue_script( 'myrevenuebooks-media-js', myrevenuebooks_plugin_url . 'js/myrevenuebooks-media.js', array(), '1.0.0', true );
		}
		
		
		
		public function register_plugin_styles() {
		wp_enqueue_style('style', myrevenuebooks_plugin_url . 'style.css' );
		wp_enqueue_style( 'myrevenuebooks' );
			// Load the datepicker script (pre-registered in WordPress).
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('jquery-ui', myrevenuebooks_plugin_url . '/js/jquery-ui.css');
		}
		


		public function add_menu()
        {
            // Add a page to manage this plugin's settings
//        	add_options_page(
//        	    'WP Plugin Template Settings', 
//        	    'WP Plugin Template', 
//        	    'manage_options', 
//        	    'myrevenuebooks', 
//        	    array(&$this, 'plugin_settings_page')
//        	);
        } // END public function add_menu()


		public function addSettingsSubMenuPageToTopLevelMenu() {
			
		$plugins_url = plugins_url();
		add_menu_page(
					'myrevenuebooks Settings', 
        	    	'MRB',
					'manage_options',
					'myrevenuebooks',
					array(&$this, 'plugin_settings_page'),
					'dashicons-money-alt', );
			
			//workorders
			add_submenu_page( 'myrevenuebooks', 'Workorders' , 'Workorders', 'edit_others_posts', 'my-revenue-books/workorders/dashboard.php');
			add_submenu_page( 'options.php', 'Workorders' , 'Workorders', 'edit_others_posts', 'my-revenue-books/workorders/display_workorders.php');
			add_submenu_page( 'options.php', 'Workorders' , 'Workorders Edit', 'edit_others_posts', 'my-revenue-books/workorders/edit_transaction.php');
			add_submenu_page( 'options.php', 'Workorders' , 'Workorder Settings', 'edit_others_posts', 'my-revenue-books/workorders/workorder_settings.php');
			add_submenu_page( 'options.php', 'Workorders' , 'Workorder Search', 'edit_others_posts', 'my-revenue-books/workorders/search.php');
			add_submenu_page( 'options.php', 'Workorders' , 'Workorder Reports', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_reports_workorders.php');
			
			
			add_submenu_page( 'options.php', 'Security', 'Security', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_security.php');
			add_submenu_page( 'options.php', 'Settings', 'Settings', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_settings.php');
			add_submenu_page( 'options.php', 'Search', 'Search', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_search.php');
        	add_submenu_page( 'options.php', 'Reports' , 'Reports', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_reports.php');
        	add_submenu_page( 'options.php', 'Accounts', 'Accounts', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_accounts.php');
        	add_submenu_page( 'options.php', 'Link Report', 'Link Report', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_link_report.php');
        	add_submenu_page( 'options.php', 'Dashboard' , 'Dashboard', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_index.php');
        	add_submenu_page( 'options.php', 'Add Account', 'Add Account', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_add.php');
        	add_submenu_page( 'options.php', 'Help' , 'Help', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_help.php');
			add_submenu_page( 'options.php', 'Edit Transaction' , 'Edit Transaction', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_edit_transaction.php');
			add_submenu_page( 'options.php', 'Copy Transaction' , 'Copy Transaction', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_copy_transaction.php');
			add_submenu_page( 'options.php', 'Edit Adv' , 'Edit Adv', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_edit_adv.php');
			add_submenu_page( 'options.php', 'Delete Adv' , 'Delete Adv', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_delete_adv.php');
			add_submenu_page( 'options.php', 'Delete Transaction' , 'Delete Transaction', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_delete_transaction.php');
			add_submenu_page( 'options.php', 'View Transactions' , 'View Transactions', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_view_transactions.php');
			add_submenu_page( 'options.php', 'Add Transactions' , 'Add Transactions', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_add_transaction.php');
			add_submenu_page( 'options.php', 'Header' , 'Header', 'edit_others_posts', 'my-revenue-books/header.php');
			add_submenu_page( 'options.php', 'Report Accounts' , 'Report Accounts', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_report_accounts.php');
			add_submenu_page( 'options.php', 'Report Transactions' , 'Report Transactions', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_report_transactions.php');
			add_submenu_page( 'options.php', 'Report YTD Comp' , 'Report Transactions', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_report_ytdcomp.php');
			add_submenu_page( 'options.php', 'Email Reminder' , 'Email Reminder', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_email_reminder.php');
			add_submenu_page( 'options.php', 'Email' , 'Email Reminder', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_email_reminder_log.php');
			add_submenu_page( 'options.php', 'Email' , 'Email', 'edit_others_posts', 'my-revenue-books/myrevenuebooks_email.php');
    	}

        /**
         * Menu Callback
         */		
        public function plugin_settings_page()
        {
        	if(!current_user_can('edit_others_posts'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
			// Render the settings template
			include(sprintf("%s/myrevenuebooks_index.php", dirname(__FILE__)));
			} // END public function plugin_settings_page()

        
    } // END class myrevenuebooks_Settings
} // END if(!class_exists('myrevenuebooks_Settings'))