<?php
require ('../../../../wp-load.php');

if (isset ( $_REQUEST )) {
	
	//$id = $_REQUEST ['id'];
	$name = $_REQUEST ['name'];
	$date = $_REQUEST ['date'];
	$description = $_REQUEST ['description'];
	$neighborhood = $_REQUEST['neighborhood'];
	$locationX = $_REQUEST ['locationX'];
	$locationY = $_REQUEST ['locationY'];
	$category = $_REQUEST ['category'];
	
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
	
	die ();
}


