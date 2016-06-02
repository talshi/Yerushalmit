<?php
require ('../../../../wp-load.php');

if (isset ( $_REQUEST )) {
	
	$img_url = $_REQUEST ['img_url'];
	$neighborhood = $_REQUEST ['neighborhood'];
	$id = $_REQUEST ['id'];
	
	global $wpdb;
	$table_name = $wpdb->prefix . "map"; 
	
	$id_main = $wpdb->get_results("SELECT * FROM wp_map where neighborhood = 'main'");
	
	echo print_r($id_main);
	
	if ($id == "main") {
		$wpdb->replace ( $table_name, array (
				'id' => 1,
				'url' => $img_url,
				'neighborhood' => "main",
		), array (
				'%d',
				'%s',
				'%s'
		) );
	} else {
		$wpdb->insert ( $table_name, array (
				'url' => $img_url,
				'neighborhood' => $neighborhood,
		), array (
				'%s',
				'%s'
		) );
	}
	
	die ();
}