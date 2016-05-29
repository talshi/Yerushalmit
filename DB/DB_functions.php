<?php

public static function get_category_list_by_id($id)
{
	//select sql 
	$sqlResults = $GLOBALS['wpdb']->get_results( "SELECT * FROM wp_categories WHERE id = '$id'", OBJECT );
	
	//convert to json and return the array
	return json_encode($sqlResults,JSON_PRETTY_PRINT);
}	

/*	to check get_category_list_by_id function: write in activetor class:

	$json = Tables::get_category_list_by_id(any number we wont to delete);
	print_r($json);
		
	Output expected: A specific line with all the details, according id.
*/	

public static function get_activity_list_by_id($id)
{
	//select sql 
	$sqlResults = $GLOBALS['wpdb']->get_results( "SELECT * FROM wp_activities WHERE id = '$id'", OBJECT );
	
	//convert to json and return the array
	return json_encode($sqlResults,JSON_PRETTY_PRINT);
}
/*
	test like get_category_list_by_id.
*/

public static function delete_category_by_id($id)
{
	global $wpdb;
	$table = $wpdb->prefix . "categories";
		
	$wpdb->query(("DELETE FROM `wp_categories` WHERE `wp_categories`.`id` = '$id'"));
}

/*	to check delete_category_by_id function: write in activetor class:

	Tables::delete_category(10);
	
	Output expected: A specific line - according id will delete, in phpmyAdmin.
*/

public static function get_category_list()
{
	$results = $GLOBALS['wpdb']->get_results( "SELECT * FROM `wp_categories ", OBJECT );
	return json_encode($results,JSON_PRETTY_PRINT);
}

//------------------------------------------------------------------------------------------
//include class.
//for example:
/*<script type="text/javascript">
	var category = <?php echo Tables::get_activity_list_by_id() ?>;
</script>*/

