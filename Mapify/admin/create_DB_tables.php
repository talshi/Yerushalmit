<?php

class Tables
{	
	public $map_db_version = '1.0';
	public  $activities_db_version = '1.0';
	public $categories_db_version = '1.0';
	
	// create a table called - wp_map
	public static function set_map()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . "map";
	
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name)
		{
			
			/*$sql = "CREATE TABLE $table_name ( 
				url varchar(55) DEFAULT '' NOT NULL
				
			)";*/
			
			$sql = 'CREATE TABLE ' . $table_name . '(
				map_id int,
				map_url VARCHAR(20000),
				PRIMARY KEY (map_id))';
			
			// make dbDelta() available
			require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
			
			dbDelta ( $sql );
			
			update_option ( 'map_db_version', $map_db_version );
			
			// set default image, because the table is already build ??
			if (null == $wpdb->get_var ( 'SELECT map_url FROM ' . $wpdb->prefix . 'map' ))
			{
				$wpdb->replace( 'wp_map', array('map_id'=> 555, 'map_url' => "C:/Users/User/Desktop/Gabriela/myPlaylist/img/logo.jpg"), array('%d', '%s') );
			}

		}
	}



	// create a table called - wp_activities
	public static function create_activities_table() 
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
			
				// location - array with 2 coordination - place on image
				
				// make dbDelta() available
				
				require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
				
				/*
				 * The dbDelta function examines the current table structure,
				 * compares it to the desired table structure,
				 * and either adds or modifies the table as necessary.
				 */
				
				dbDelta ( $sql );
			
				/*
				 * option to record a version number for our database table structure,
				 * so we can use that information later if we need to update the table
				 */
			
				add_option ( 'activities_db_version', $activities_db_version );
				
			}
		}


// create a table called - wp_categories
	public static function create_categories_table() 
	{
		global $wpdb;
		$table_name = $wpdb->prefix . "categories";
		
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name)
		{
			$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			logoUrl varchar(55) DEFAULT '' NOT NULL,
			name varchar(55) DEFAULT '' NOT NULL,
			description varchar(55) DEFAULT '' NOT NULL,
			PRIMARY KEY (id) )";
			
			// make dbDelta() available
			
			require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
			
			/*
			 * The dbDelta function examines the current table structure,
			 * compares it to the desired table structure,
			 * and either adds or modifies the table as necessary.
			 */
			
			dbDelta ( $sql );
			
			/*
			 * option to record a version number for our database table structure,
			 * so we can use that information later if we need to update the table
			 */
			
			add_option ( 'categories_db_version', $categories_db_version );
		}
	}

	public static function map_install_data()
	{
		global $wpdb;
		$welcome_url = 'http://';
		$table_name = $wpdb->prefix . 'map';
		$wpdb->insert(
				$table_name,
				array(
						'url' => $welcome_url,
				)
				);
	}
	public static function categories_install_data()
	{
		
		global $wpdb;
		$welcome_name = 'Mr. WordPress';
							$table_name = $wpdb->prefix . 'categories';
	
		$wpdb->insert(
				$table_name,
				array(
						'name' => $welcome_name,

				)
				);
	}
	public static function activities_install_data()
	{
	
		global $wpdb;
		$welcome_name = 'Mr. WordPress';
		$table_name = $wpdb->prefix . 'activities';
	
		$wpdb->insert(
				$table_name,
				array(
						'name' => $welcome_name,
						'time' => current_time( 'mysql' ),
	
				)
				);
	}
	public static function delete_all()
	{
		global $wpdb;	//required global declaration of WP variable
		$table_name = $wpdb->prefix.activities;
		
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name)
		{
			$sql = "DROP TABLE ". $table_name;
			$wpdb->query($sql);
		}
		
		$table_name = $wpdb->prefix.categories;
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name)
		{
			$sql = "DROP TABLE ". $table_name;
			$wpdb->query($sql);
		}
		
		$table_name = $wpdb->prefix.map;
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name)
		{
			$sql = "DROP TABLE ". $table_name;
			$wpdb->query($sql);
		}
	}

	public static function get_activity_list_by_id($id)
	{
		//select sql
		$sqlResults = $GLOBALS['wpdb']->get_results( "SELECT * FROM wp_activities WHERE id = '$id'", OBJECT );
	
		//convert to json and return the array
		return json_encode($sqlResults,JSON_PRETTY_PRINT);
	}
}

