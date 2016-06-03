<?php
require ('../../../../wp-load.php');

if (isset ( $_REQUEST )) {
	
	$img_url = $_REQUEST ['img_url'];
	$neighborhood = $_REQUEST ['neighborhood'];
	$isNeighborhood = $_REQUEST ['isNeighborhood'];
	
	global $wpdb;
	$table_name = $wpdb->prefix . "map"; 
	
 	//$id_main = $wpdb->get_results("SELECT id FROM " . $wpdb->prefix . "map WHERE neighborhood = 'main'");
	
	//echo json_encode($id_main);
	
	if ($neighborhood == "main") {
		$wpdb->replace ( $table_name, array (
				'id' => 1,
				'url' => $img_url,
				//TODO fix neighborhood data
				'neighborhood' => "main",
				'map_id' => '0'
		), array (
				'%d',
				'%s',
				'%s',
				'%d'
		) );
	} else {
		$wpdb->insert ( $table_name, array (
				'url' => $img_url,
				//TODO fix neighborhood data
				'neighborhood' => $neighborhood,
				'map_id' => '0'
		), array (
				'%s',
				'%s',
				'%d'
		) );
	}
	
	//die ();
	
}