<?php
require ('../../../../wp-load.php');

if (isset ( $_REQUEST )) {

	global $wpdb;
	$table_name = $wpdb->prefix . "activities_image";
	
	$activity_name = $_REQUEST ['activity_name'];
	$img_url = $_REQUEST ['img_url'];
	
	$activity_id = $wpdb->get_results ( "SELECT id FROM wp_activities WHERE name = '$activity_name'"); 
	
	$wpdb->insert ( $table_name, array (
			'activity_name' => $activity_name,
			'activity_id' => $activity_id[0]->id,
			//'activity_id' => "1",
			'image_id' => "1",
			'url' => $img_url,
	), array (
			//'%s',
			'%s',
			'%d',
			'%d',
			'%s'
	) );
	
	die ();
}


