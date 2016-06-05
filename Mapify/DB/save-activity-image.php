<?php
require ('../../../../wp-load.php');

if (isset ( $_REQUEST )) {

	$activity_name = $_REQUEST ['activity_name'];
	$img_url = $_REQUEST ['img_url'];
	
	global $wpdb;
	$table_name = $wpdb->prefix . "activities_image";
	
	$wpdb->insert ( $table_name, array (
			//'activity_name' => $activity_name,
			'activity_id' => "1",
			'image_id' => "1",
			'url' => $img_url,
	), array (
			//'%s',
			'%s'
	) );
	
	die ();
}


