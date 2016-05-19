<?php

	global $jal_db_version;
	$jal_db_version = '1.0';

	//create a table called (prefix)liveshoutbox - wp_liveshoutbox.
	function jal_install () 
	{
		global $wpdb;
		$table_name = $wpdb->prefix . "liveshoutbox";
	
		$charset_collate = $wpdb->get_charset_collate();
	
		if($wpdb->get_var('SHOW TABLES LIKE' . $table_name) != $table_name)
		{
			$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			name tinytext NOT NULL,
			text text NOT NULL,
			url varchar(55) DEFAULT '' NOT NULL,
			UNIQUE KEY id (id)
			) $charset_collate;";
		
			// make dbDelta() available
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			
			/*The dbDelta function examines the current table structure,
			compares it to the desired table structure, 
			and either adds or modifies the table as necessary,
			so it can be very handy for updates*/
			dbDelta( $sql );
			
			add_option( 'jal_db_version', $jal_db_version );
		}
		
		register_activation_hook( __FILE__, 'jal_install' );
		
		//adding Initial Data
		function jal_install_data() 
		{
			global $wpdb;
	
			$welcome_name = 'Mr. WordPress';
			$welcome_text = 'Congratulations, you just completed the installation!';
	
			$table_name = $wpdb->prefix . 'liveshoutbox';
	
			$wpdb->insert( 
				$table_name, 
			array( 
			'time' => current_time( 'mysql' ), 
			'name' => $welcome_name, 
			'text' => $welcome_text, 
				) 
			);
			register_activation_hook( __FILE__, 'jal_install_data' );
		}
   
}

?>