<?php

global $activities_db_version;
$activities_db_version = '1.0';

//create a table called  - wp_activities

function create_activities_table()
{
	global $wpdb;
	$table_name = $wpdb->prefix . "activities";

	if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name)
	{
		$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name varchar(55) DEFAULT '' NOT NULL,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		description varchar(55) DEFAULT '' NOT NULL,
		activityLocation varchar(55) DEFAULT '' NOT NULL,
		showOnMap varchar(55) DEFAULT '' NOT NULL,
		location varchar(55) DEFAULT '' NOT NULL,  
		category varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY (id) )";
		
		//location - array with 2 coordination - place on image

		//make dbDelta() available

		require_once (ABSPATH . 'wp-admin/includes/upgrade.php');

		/*The dbDelta function examines the current table structure,
		 compares it to the desired table structure,
		 and either adds or modifies the table as necessary.*/

		dbDelta($sql);

		/*option to record a version number for our database table structure,
		 *  so we can use that information later if we need to update the table*/

		add_option( 'activities_db_version', $activities_db_version );

	}
}

register_activation_hook ( __FILE__, 'create_activities_table' );
create_activities_table();

