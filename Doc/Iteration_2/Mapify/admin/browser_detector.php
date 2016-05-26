<?php

//create bdetector table 
function bdetector_activate() 
{
	global $wpdb;
	
	$table_name = $wpdb->prefix . "bdetector";
	
	// doesn't exists
	if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name) 
	{
		$sql = 'CREATE TABLE ' . $table_name . '(
				id INTEGER(10) UNSIGNED AUTO_INCREMENT,
				hit_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
				user_agent VARCHAR(255),
				PRIMARY KEY (id) )';
		
		require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
 		dbDelta ( $sql );
		
		add_option ( 'bdetector_database_version', '1.0' );
	}
}

register_activation_hook ( __FILE__, 'bdetector_activate' );
bdetector_activate();

//create map table
function map_activate()
{
	global $wpdb;

	$table_name = $wpdb->prefix . "map";

	// doesn't exists
	if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name)
	{
		$sql = 'CREATE TABLE ' . $table_name . '(
				map_url VARCHAR(20000))';
		
		require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta ( $sql );
		
		add_option ( 'map_database_version', '1.0' );
		
		$consolelog = "<script>console.log('im here!');</script>";
		echo $consolelog;
	}
}

register_activation_hook ( __FILE__, 'map_activate' );
map_activate();

//set map url
function set_map_url($url)
{
	
}
?>