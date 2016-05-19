
<?php
header('Content-Type: application/json');
if(isset($_POST['upload_image'])) {
	print_r($_POST);
}
$postdata = file_get_contents("php://input");
echo $postdata;
$request = json_decode($postdata);
echo $request;
// echo '<div id="message" class="updated">Image Updated Successfully!</div>';
// 	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['upload_image'] != '') // TODO not working
// 	{
	// update_option('mapify_map_url' , $_POST['upload_image']);
// 		echo '<div id="message" class="updated">Image Updated Successfully!</div>';
	?>
	
<?php
// }
?>