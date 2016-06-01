<?php
require ('../../../../wp-load.php');

if (isset ( $_REQUEST )) {
	
	$img_url = $_REQUEST ['img_url'];
	global $wpdb;
	$table_name = $wpdb->prefix . "map";
	
	$wpdb->insert ( $table_name, array (
			'url' => $img_url 
	), array (
			'%s' 
	) );
	
	die ();
}