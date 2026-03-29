<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => ''
		),
		
		array(
			'path' => 'api/offlineredirect', 
			'label' => 'Process Offline Application', 
			'icon' => ''
		),
		array(
			'path' => 'application_form', 
			'label' => 'Application Form CC', 
			'icon' => ''
		),
		
		array(
			'path' => 'payments', 
			'label' => 'Payments', 
			'icon' => ''
		),
		array(
			'path' => 'payments/challan', 
			'label' => 'Challan', 
			'icon' => ''
		),
		array(
			'path' => 'payments/detailed_challan', 
			'label' => 'Detailed Challan Report', 
			'icon' => ''
		),
		
		array(
			'path' => 'accept_reject', 
			'label' => 'Accept Reject', 
			'icon' => ''
		),
		
		array(
			'path' => 'user_info', 
			'label' => 'User Info', 
			'icon' => '',
'submenu' => array(
		array(
			'path' => 'user_info', 
			'label' => 'User Info', 
			'icon' => ''
		),
		
		array(
			'path' => 'role_permissions', 
			'label' => 'Role Permissions', 
			'icon' => ''
		),
		
		array(
			'path' => 'roles', 
			'label' => 'Roles', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'master_division', 
			'label' => 'Masters', 
			'icon' => '',
'submenu' => array(
		array(
			'path' => 'master_division', 
			'label' => 'Master Division', 
			'icon' => ''
		),
		
		array(
			'path' => 'master_ward', 
			'label' => 'Master Ward', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'application_form_oc', 
			'label' => 'Application Form Oc', 
			'icon' => ''
		)
	);
		
	
	
			public static $are_size_and_capcity_of_oh_and_ug_tank_proposed_sufficient = array(
		array(
			"value" => "YES", 
			"label" => "YES", 
		),
		array(
			"value" => "NO", 
			"label" => "NO", 
		),);
		
			public static $status = array(
		array(
			"value" => "1", 
			"label" => "CONFIRM", 
		),);
		
			public static $payment_mode = array(
		array(
			"value" => "OFFLINE", 
			"label" => "OFFLINE", 
		),
		array(
			"value" => "ONLINE", 
			"label" => "ONLINE", 
		),);
		
			public static $action = array(
		array(
			"value" => "APPROVE", 
			"label" => "APPROVE", 
		),
		array(
			"value" => "REJECT", 
			"label" => "REJECT", 
		),
		array(
			"value" => "REVERT", 
			"label" => "REVERT", 
		),);
		
}