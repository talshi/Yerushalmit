<?php
require_once dirname ( __DIR__ ) . '/../../../wp-config.php';

$action = $_POST ['action'];
switch ($action) {
	case "get_activity_list" :
		echo DB_functions::get_activity_list ();
		break;
	case "get_category_list_by_id" :
		$id = $_POST ['id'];
		echo DB_functions::get_category_list_by_id ( $id );
		break;
	case "get_activity_list_by_id" :
		$id = $_POST ['id'];
		echo DB_functions::get_activity_list_by_id ( $id );
		break;
	case "delete_category_by_id" :
		echo DB_functions::delete_category_by_id ();
		break;
	case "delete_activity_by_id" :
		echo DB_functions::delete_activity_by_id ();
		break;
	case "get_category_list" :
		echo DB_functions::get_category_list ();
		break;
	case "get_main_map_url" :
		echo DB_functions::get_main_map_url ();
		break;
	case "get_neighborhoods" :
		echo DB_functions::get_neighborhoods ();
		break;
	case "delete_all_activities" :
		echo DB_functions::delete_all_activities ();
		break;
	case "delete_all_categories" :
		echo DB_functions::delete_all_categories ();
		break;
	case "update_activities_table_by_id" :
		$id = $_POST ['id'];
		$name = $_POST ['name'];
		$date = $_POST ['date'];
		$description = $_POST ['description'];
		$neighborhood = $_POST ['neighborhood'];
		$category = $_POST ['category'];
		DB_functions::update_activities_table_by_id ( $id, $name, $date, $description, $neighborhood, $category );
		break;
	case "save_activity" :
		$name = $_POST ['name'];
		$date = $_POST ['date'];
		$description = $_POST ['description'];
		$neighborhood = $_POST ['neighborhood'];
		$locationX = $_POST ['locationX'];
		$locationY = $_POST ['locationY'];
		$category = $_POST ['category'];
		echo DB_functions::save_activity($name, $date, $description, $neighborhood, $locationX, $locationY, $category);
		break;
}
class DB_functions {
	public static function update_activities_table_by_id($id, $name, $date, $description, $neighborhood, $category) {
		global $wpdb;
		$table_name = $wpdb->prefix . "activities";
		echo "i'm here";
		$wpdb->update ( $table_name, array (
				'name' => $name, // string
				'date' => $date,
				'description' => $description, // integer (number)
				'neighborhood' => $neighborhood,
				// 'showOnMap' => 'value4',
				'category' => $category 
		), array (
				'ID' => $id 
		), array (
				'%s', // value1
				'%s',
				'%s', // value2
				'%s',
				'%s' 
		), array (
				'%d' 
		) );
	}
	public static function get_neighborhoods() {
		global $wpdb;
		
		$neighborhoods = $GLOBALS ['wpdb']->get_results ( "SELECT neighborhood FROM `wp_map ", OBJECT );
		
		return json_encode ( $neighborhoods, JSON_PRETTY_PRINT );
	}
	public static function get_category_list_by_id($id) {
		// select sql
		$sqlResults = $GLOBALS ['wpdb']->get_results ( "SELECT * FROM wp_categories WHERE id = '$id'", OBJECT );
		
		// convert to json and return the array
		return json_encode ( $sqlResults, JSON_PRETTY_PRINT );
	}
	
	/*
	 * to check get_category_list_by_id function: write in activetor class:
	 *
	 * $json = Tables::get_category_list_by_id(any number we wont to delete);
	 * print_r($json);
	 *
	 * Output expected: A specific line with all the details, according id.
	 */
	public static function get_activity_list_by_id($id) {
		// select sql
		$sqlResults = $GLOBALS ['wpdb']->get_results ( "SELECT * FROM wp_activities WHERE id = '$id'", OBJECT );
		
		// convert to json and return the array
		return json_encode ( $sqlResults, JSON_PRETTY_PRINT );
	}
	/*
	 * test like get_category_list_by_id.
	 */
	public static function delete_category_by_id($id) {
		global $wpdb;
		
		$wpdb->query ( ("DELETE FROM `wp_categories` WHERE `wp_categories`.`id` = '$id'") );
	}
	public static function delete_all_activities() {
		global $wpdb;
		$wpdb->query ( "DELETE FROM `wp_activities" );
	}
	public static function delete_all_categories() {
		global $wpdb;
		$wpdb->query ( "DELETE FROM `wp_categories" );
	}
	
	/*
	 * to check delete_category_by_id function: write in activetor class:
	 *
	 * Tables::delete_category(10);
	 *
	 * Output expected: A specific line - according id will delete, in phpmyAdmin.
	 */
	public static function delete_activity_by_id($id) {
		global $wpdb;
		$table = $wpdb->prefix . "activities";
		
		$wpdb->query ( ("DELETE FROM `wp_categories` WHERE `wp_categories`.`id` = '$id'") );
	}
	public static function get_category_list() {
		$results = $GLOBALS ['wpdb']->get_results ( "SELECT * FROM `wp_categories ", OBJECT );
		return json_encode ( $results, JSON_PRETTY_PRINT );
	}
	public static function get_activity_list() {
		$results = $GLOBALS ['wpdb']->get_results ( "SELECT * FROM `wp_activities ", OBJECT );
		return json_encode ( $results, JSON_PRETTY_PRINT );
	}
    
    public static function get_maps() {
		global $wpdb;
		
		$maps = $GLOBALS ['wpdb']->get_results ( "SELECT * FROM `wp_map ", OBJECT );
		
		return json_encode ( $maps, JSON_PRETTY_PRINT );
	}
	
	// ------------------------------------------------------------------------------------------
	// include class.
	// for example:
	/*
	 * <script type="text/javascript">
	 * var category = <?php echo Tables::get_activity_list_by_id() ?>;
	 * </script>
	 */
	public static function get_main_map_url() {
		global $wpdb;
		$url_main = $wpdb->get_results ( "SELECT * FROM " . $wpdb->prefix . "map WHERE neighborhood = 'main'" );
		return json_encode ( $url_main, JSON_PRETTY_PRINT );
	}
	public static function save_activity($name, $date, $description, $neighborhood, $locationX, $locationY, $category) {
		global $wpdb;
		$table_name = $wpdb->prefix . "activities";
		
		$wpdb->insert ( $table_name, array (
				'name' => $name,
				'date' => $date,
				'description' => $description,
				'neighborhood' => $neighborhood,
				'locationX' => $locationX,
				'locationY' => $locationY,
				'category' => $category 
		), array (
				'%s',
				'%s',
				'%s',
				'%s',
				'%lu',
				'%lu',
				'%s' 
		) );
		
		return json_encode ( $wpdb->get_results ( "SELECT id FROM wp_activities WHERE name = '$name'", OBJECT ), JSON_PRETTY_PRINT );
		// ***
	}


    public static function get_activities_images() {
		global $wpdb;
		
		$images = $GLOBALS ['wpdb']->get_results ( "SELECT * FROM `wp_activities_image ", OBJECT );
		
		return json_encode ( $images, JSON_PRETTY_PRINT );
	}
}