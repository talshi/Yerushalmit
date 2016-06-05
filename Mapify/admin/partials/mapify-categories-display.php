
<div class="manage_caption">Manage Categories</div>
<div class="note">Organize your categories.</div>
<br>

<div class="categories-control">
	<label for="search">Search: </label> <input name="search" type="text"
		ng-model="query" /> <input type="button" value="Add New Category"
		data-toggle="modal" data-target="#myModal" /> <input type="button"
		value="Remove Selected" id="IDdeleteSelectedCategory" /> <input
		type="button" value="Remove All" id="IDdeleteAllCategory" />
</div>
<!-- search bar -->

<div class="activities-table">

	<table>
		<tr>
			<th>#</th>
			<th id="IDcategory-name" ng-model="name"
				ng-click="sortBy='name'; reverseSort=!reverseSort">Category Name</th>
			<th>Description</th>
		</tr>
		<tr
			ng-repeat="category in categories_list | filter: query | orderBy:sortBy:reverseSort"
			id="table">
			<td><input type="checkbox" /></td>
			<td>{{ category.name }}</td>
			<td>{{ category.description }}</td>
		</tr>
	</table>

	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add New Catergory</h4>
					<form class="modal-body" role="form" >

						<table id="IdInsertTableCategory" class="table table-hover">
							<tr>
								<td><label for="IDDCategoryName">Category Name</label></td>
								<td><input type="text" id="IDDCategoryName"
									ng-model="CategoryName" placeholder="Category Name"></td>
							</tr>
							<tr>
								<td><label for="IDareaText">Description</label></td>
								<td><textarea type="text" ng-model="CategoryDescription"
										id="IDareaText" placeholder="Description"> </textarea></td>
							</tr>
						</table>

						<div id="upload_image_admin">
							<div id="upload_note">Upload a category image:</div>
							<div id="upload_image_container">

								<label id="upload_map_label" for="upload_image_category">Upload Image</label>
								<br>
								<input id="upload_image_category" type="text" size="36"name="upload_image_category" placeholder="URL"/> 
								<input id="upload_image_button_category" type="button" value="Upload Image" /> 
								</td>
							</div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default"
								data-dismiss="modal">Close</button>
							<!-- add item to DB.... -->
							<button id="save-button" class="btn btn-default" type="submit"
								data-dismiss="modal" ng-click="addCategory()" >Save</button>
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>

</div>



<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("#upload_image_button").click(function (e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Image',
                multiple: false
            }).open()
            .on('select', function (e) {
                // This will return the selected image from the Media Uploader, the result is an object
                var uploaded_image = image.state().get('selection').first();
                // We convert uploaded_image to a JSON object to make accessing it easier
                // Output to the console uploaded_image
                //console.log(uploaded_image);
                var image_url = uploaded_image.toJSON().url;
                // Let's assign the url value to the input field
                $('#upload_image').val(image_url)
                var image_link = $('#upload_image').val();
                $("#preview_label").html("Preview:");
                $("#img_preview").attr("src", image_link);
            });
        });
    });
</script>
