<?php

global $categories_db_version;
$categories_db_version = '1.0';

//create a table called  - wp_categories

function create_categories_table()
{
	global $wpdb;
	$table_name = $wpdb->prefix . "categories";

	if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name)
	{
		$sql = "CREATE TABLE $table_name (
		url varchar(55) DEFAULT '' NOT NULL
		)";

		//make dbDelta() available

		require_once (ABSPATH . 'wp-admin/include/upgrade.php');

		/*The dbDelta function examines the current table structure,
		 compares it to the desired table structure,
		 and either adds or modifies the table as necessary.*/

		dbDelta($sql);

		/*option to record a version number for our database table structure,
		 *  so we can use that information later if we need to update the table*/

		add_option( 'categories_db_version', $categories_db_version );

	}
	register_activation_hook ( __FILE__, 'create_categories_table' );
	create_categories_table();
}



