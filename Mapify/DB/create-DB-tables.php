<?php
class Tables {
	public $map_db_version = '1.0';
	public $activities_db_version = '1.0';
	public $categories_db_version = '1.0';
	public $activities_image_db_version = '1.0';
	public $counter_db_version = '1.0';
	
	// create a table called - wp_map
	public static function set_map() {
		global $wpdb;
		$table_name = $wpdb->prefix . "map";
		
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name) {
			
			$sql = "CREATE TABLE $table_name ( 
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				map_id varchar(55) NOT NULL,
				url varchar(5000) NOT NULL,
				neighborhood VARCHAR(100) NOT NULL,
				
				PRIMARY KEY (id) )";
			
			// make dbDelta() available
			require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
			
			dbDelta ( $sql );
			
			add_option ( 'map_db_version', $map_db_version );
			/*
			$temp = map_;
			$num = $sqlResults = $GLOBALS ['wpdb']->get_results ( "SELECT image_id FROM wp_activities_image WHERE id = 1", OBJECT );
			
			echo $num->image_id;
			
			$tmp = $temp . $num->image_id;
			
			 $consolelog = "<script>console.log($num);</script>";
			 echo $consolelog;
			*/
			$wpdb->insert ( $table_name, array (
					'neighborhood' => "main",
					'url' => "/wp-content/plugins/Mapify/admin/images/default_main_img.png"
			) );
			
			
		}
	}
	
	// create a table called - wp_activities
	public static function create_activities_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . "activities";
		
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name) {
			$sql = "CREATE TABLE $table_name (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				name varchar(5000) DEFAULT '' NOT NULL,
				date varchar(55) NOT NULL,
				description varchar(5000) DEFAULT '' NOT NULL,
				neighborhood varchar(55) DEFAULT '' NOT NULL,
				showOnMap varchar(55) DEFAULT '' NOT NULL,
				locationX varchar(55) DEFAULT '' NOT NULL,
				locationY varchar(55) DEFAULT '' NOT NULL,
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
	
	// create a table called - wp_activities
	public static function create_activities_image_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . "activities_image";
		
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name) {
			$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			activity_id mediumint(9) NOT NULL, 
			image_id mediumint(9) NOT NULL,
			url varchar(5000) DEFAULT '' NOT NULL,
			PRIMARY KEY (id) )";

			
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
			
			add_option ( 'activities_image_db_version', $activities_image_db_version );
		}
	}
	
	// create a table called - wp_categories
	public static function create_categories_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . "categories";
		
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name) {
			$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			logoUrl varchar(5000) DEFAULT '' NOT NULL,
			name varchar(500) DEFAULT '' NOT NULL,
			description varchar(5000) DEFAULT '' NOT NULL,
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
	
	// create a table called - wp_categories
	public static function counter_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . "counter";
	
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name) {
			$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			category_id mediumint(9) NOT NULL ,
			activity_id mediumint(9) NOT NULL ,
			image_id mediumint(9) NOT NULL ,
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
				
			add_option ( 'counter_db_version', $counter_db_version );
			
			$wpdb->insert ( $table_name, array (
					'category_id' => 0,
					'activity_id' => 0,
					'image_id' => 0
			) );
		}
	}
	
	public static function map_install_data() {
		// global $wpdb;
		// $welcome_url = 'http://';
		// $table_name = $wpdb->prefix . 'map';
		// $wpdb->insert(
		// $table_name,
		// array(
		// 'url' => $welcome_url,
		// )
		// );
	}
	
	public static function categories_install_data() {
		global $wpdb;
		$welcome_name = 'Mr. WordPress';
		$table_name = $wpdb->prefix . 'categories';
		
		$wpdb->insert ( $table_name, array (
				'name' => $welcome_name 
		) );
	}
	
	public static function activities_install_data() {
		global $wpdb;
		$welcome_name = 'Mr. WordPress';
		$table_name = $wpdb->prefix . 'activities';
		
		$wpdb->insert ( $table_name, array (
				'name' => $welcome_name,
				'time' => current_time ( 'mysql' ) 
		) );
	}
	
	public static function create_all_db_tables(){
		Tables::set_map();
		Tables::create_activities_table();
		Tables::create_activities_image_table();
		Tables::create_categories_table();
		Tables::counter_table();
	}
	
	public static function delete_all() {
		global $wpdb; // required global declaration of WP variable
		$table_name = $wpdb->prefix . activities;
		
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name) {
			$sql = "DROP TABLE " . $table_name;
			$wpdb->query ( $sql );
		}
		
		$table_name = $wpdb->prefix . categories;
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name) {
			$sql = "DROP TABLE " . $table_name;
			$wpdb->query ( $sql );
		}
		
		$table_name = $wpdb->prefix . map;
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name) {
			$sql = "DROP TABLE " . $table_name;
			$wpdb->query ( $sql );
		}
		
		$table_name = $wpdb->prefix . activities_image;
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name) {
			$sql = "DROP TABLE " . $table_name;
			$wpdb->query ( $sql );
		}
		
		$table_name = $wpdb->prefix . counter_table;
		if ($wpdb->get_var ( 'SHOW TABLES LIKE ' . $table_name ) != $table_name) {
			$sql = "DROP TABLE " . $table_name;
			$wpdb->query ( $sql );
		}
	}
	
// 	public static function get_category_list_by_id($id) {
// 		$results = $GLOBALS ['wpdb']->get_results ( "SELECT * FROM wp_categories WHERE id = '$id'", OBJECT );
// 		return json_encode ( $results, JSON_PRETTY_PRINT );
		
// 		// global $wpdb;
// 		// $category_table = $wpdb->prefix . "categories";
// 		// $results = $wpdb->get_results( "SELECT * FROM $category_table WHERE option_id = '$id'", OBJECT );
// 		// return json_encode($results, JSON_PRETTY_PRINT);
// 	}
	public static function delete_category($category) {
		global $wpdb;
		$table = $wpdb->prefix . "categories";
		
		$wpdb->query ( ("DELETE FROM `wp_categories` WHERE `wp_categories`.`id` = '$category'") );
	}
// 	public static function get_activity_list_by_id($id) {
// 		// select sql
// 		$sqlResults = $GLOBALS ['wpdb']->get_results ( "SELECT * FROM wp_activities WHERE id = '$id'", OBJECT );
		
// 		// convert to json and return the array
// 		return json_encode ( $sqlResults, JSON_PRETTY_PRINT );
// 	}
// 	public static function get_category_list() {
// 		$results = $GLOBALS ['wpdb']->get_results ( "SELECT * FROM `wp_categories ", OBJECT );
// 		return json_encode ( $results, JSON_PRETTY_PRINT );
// 	}
// 	public static function get_activity_url_by_id($id) {
// 		// select sql
// 		$sqlResults = $GLOBALS ['wpdb']->get_results ( "SELECT logoUrl FROM wp_categories WHERE id = '$id'", OBJECT );
		
// 		// convert to json and return the array
// 		$sqlResults = json_encode ( $sqlResults, JSON_PRETTY_PRINT );
		
// 		/*
// 		 * $consolelog = "<script>console.log($sqlResults);</script>";
// 		 * echo $consolelog;
// 		 */
// 	}
// 	public static function get_activity_to_show($id) {
// 		// select sql
// 		$sqlResults = $GLOBALS ['wpdb']->get_results ( "SELECT showOnMap FROM wp_activities WHERE id = '$id'", OBJECT );
		
// 		// convert to json and return the array
// 		$sqlResults = json_encode ( $sqlResults, JSON_PRETTY_PRINT );
		
// 		// $consolelog = "<script>console.log($sqlResults);</script>";
// 		// echo $consolelog;
// 	}
// 	public static function get_image_by_activity_id($activityid) {
// 		$sqlResults = $GLOBALS ['wpdb']->get_results ( "SELECT showOnMap FROM wp_activities_image WHERE id = '$activityid'", OBJECT );
		
// 		$sqlResults = json_encode ( $sqlResults, JSON_PRETTY_PRINT );
	
// 	}
}
?>