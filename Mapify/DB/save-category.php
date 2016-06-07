<?php
require ('../../../../wp-load.php');

if (isset ( $_REQUEST )) {
	
	$logoUrl = $_REQUEST ['logoUrl'];
	$name = $_REQUEST ['name'];
	$description = $_REQUEST ['description'];
	
	global $wpdb;
	$table_name = $wpdb->prefix . "categories";
	
	$wpdb->insert ( $table_name, array (
			'logoUrl' => $logoUrl,
			'name' => $name,
			'description' => $description
	), array (
			'%s',
			'%s',
			'%s'
	));
	
	die ();
}
