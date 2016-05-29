<?php

public static function get_category_list_by_id($id)
{
		//select sql 
		$sqlResults = $GLOBALS['wpdb']->get_results( "SELECT * FROM wp_categories WHERE id = '$id'", OBJECT );
		
		//convert to json and return the array
		return json_encode($sqlResults,JSON_PRETTY_PRINT);
}
	

/*to check get_category_list_by_id function: write in activetor class:

		$json = Tables::get_category_list_by_id(any number we wont to delete);
		print_r($json);
		
		Output expected: A specific line with all the details, according id.
*/	

delete_category($category)
{
	$wpdb->delete( 'table', array( 'name' => $category ));
}

get_category_list()
{
}
// Integration with php code instead of return value in functions
/*<script type="text/javascript">
	var category = <?php echo json_encode($results, JSON_PRETTY_PRINT) ?>;
</script>*/

