<?php

public static function get_category_list_by_id()
	{
		//option 1
		/*$results = $wpdb->get_results( 'SELECT * FROM wp_categories WHERE option_id = $id', OBJECT );*/
		
		//option 2
		$results = $GLOBALS['wpdb']->get_results( 'SELECT * FROM wp_categories WHERE id = 1', OBJECT );
		//print_r($results);
		
		//convert to json and return the array
		return json_encode($results, JSON_PRETTY_PRINT);
	}
	
	/*write in activetor class:
		$json = Tables::get_category_list_by_id();
		print_r($json);
	*/
	
}	

delete_category()
{

}

get_category_list()
{

}

/*<script type="text/javascript">
	var category = <?php echo json_encode($results, JSON_PRETTY_PRINT) ?>;
</script>*/