<?php
require ('../../../../wp-load.php');
// add_action ( 'wp_ajax_my_action', 'my_action_callback' );
// function my_action_callback() {
	if (isset ( $_REQUEST )) {
		$img_url = $_REQUEST ['img_url'];
		global $wpdb;
		
		$wpdb->replace ( 'wp_map', array (
				'map_id' => 555,
				'map_url' => $img_url
		), array (
				'%d',
				'%s' 
		) );
		echo $img_url;
		die ();
	}
// }
?>