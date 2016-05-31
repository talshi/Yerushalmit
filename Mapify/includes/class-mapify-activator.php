<?php
/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */


class Mapify_Activator {
	


	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {	
		
		require_once dirname(__DIR__) . '/includes/create_DB_tables.php';
		
		Tables::set_map();
		Tables::create_activities_table();
		Tables::create_categories_table();
		Tables::map_install_data();
		Tables::categories_install_data();
		Tables::activities_install_data();
		
	}
}
