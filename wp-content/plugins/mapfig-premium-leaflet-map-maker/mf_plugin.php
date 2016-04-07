<?php 
/**
 * Plugin Name: MapFig Leaflet Plugin
 * Description: A Plugin & widget by mapfig.com that allows you to create/display map on Posts/Pages as well as on widget areas.
 * Author: MapFig Ltd
 * Author URI: http://www.mapfig.com/
 * Plugin URI: http://www.mapfig.com/wordpress-plugins.html
 * Version: 3.0.1
 * License: GPL
 */
 
 global $wpdb;
 define('social_TITLE', 'social');
 define('social_SLUG', 'social');
 define('MF_MAP_TABLE', $wpdb->prefix . 'mapfig_premium_map');
 define('MF_LAYERS_TABLE', $wpdb->prefix . 'mapfig_premium_layers');
 define('MF_GROUPS_TABLE', $wpdb->prefix . 'mapfig_premium_groups');
 define('MF_GROUPS_HAS_LAYERS_TABLE', $wpdb->prefix . 'mapfig_premium_groups_has_layers');
 define('MAPFIG_PREMIUM_EMP_DOCROOT', dirname(__FILE__));
 define('MAPFIG_PREMIUM_EMP_WEBROOT', str_replace(getcwd(), home_url(), dirname(__FILE__)));
 
 include 'config.php'; 
 
 register_activation_hook(__FILE__, 'mapfig_premium_tb_mf_install');
 register_deactivation_hook(__FILE__, 'mapfig_premium_tb_mf_uninstall');
 add_action('admin_menu', 'mapfig_premium_mf_menu');
 
 add_action('admin_init', 'mapfig_premium_my_script_enqueuer');
 add_action( 'wp_enqueue_scripts', 'mapfig_premium_my_script_enqueuer');

 include 'lib/model.php'; 
 include 'lib/install.php';
 include 'lib/functions.php';
 include 'lib/controller.php';
 include 'shortcode_function.php';
 include 'widget/mf-widget.php';
?>