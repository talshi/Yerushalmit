<?php

global $map_db_version;
$map_db_version = '1.0';

// create a table called - wp_map
function set_map() {
	global $wpdb;
	$table_name = $wpdb->prefix . "map";

	
	if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name) {
		
		$sql = "CREATE TABLE $table_name (
			url varchar(55) DEFAULT '' NOT NULL
		)";
		
		// make dbDelta() available
		require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
		
		dbDelta ( $sql );
		
		update_option ( 'map_db_version', $map_db_version );
		
	}
}
