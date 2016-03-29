<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:    Mapify
 * Plugin URI:  
 * Description:    Mapify takes a picture and add it the functionality to add info markers to it.
 * Version:        1.0
 * Author:         talshi, guybi, gabrielaes, stavdv, AlumaK .
 * Author URI:  
 * License:        GPL2
 * License URI:    https://www.gnu.org/licenses/gpl-2.0.html
 
 Mapify is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Mapify is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Mapify. If not, see {URI to Plugin License}.
 
 */

// DEBUG
define('WP_DEBUG', true)

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_mapify() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mapify-activator.php';
	Plugin_Name_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_mapify() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mapify-deactivator.php';
	Plugin_Name_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mapify' );
register_deactivation_hook( __FILE__, 'deactivate_mapify' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mapify.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mapify() {

	$plugin = new mapify();
	$plugin->run();

}
run_mapify();
