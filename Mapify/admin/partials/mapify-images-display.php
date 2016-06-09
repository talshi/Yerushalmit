
<div id = "success_image"></div>
<div class="manage_caption">Upload Images to Neighborhood</div>
<div class="note space">Enter an URL or upload an image for the banner.</div>
<hr>
<hr>
<div id="upload_neighborhood_img">
	<table class="table table-condensed">
		<tbody>
			<tr>
				<td><label for="Activity">Activity:</label></td>
				<td><select id="Activity" value = "main" ng-model="selectedActivity"
 							ng-options="Activity as Activity.name for Activity in activity_list" >
							<option value="" selected hidden />
				</select></td>
				<td></td>
			</tr>
			<tr>
				<td><label for="upload_image_neighborhood">URL:</label></td>
				<td><input placeholder="HTTP://..." id="upload_image_neighborhood" type="text" size="75"
					name="upload_image_neighborhood" value="" /></td>
				<td></td>
			</tr>
			<tr>
				<td><input id="save_button_upload" type="button" value="Save Image" /></td>
				<td><input id="upload_image_button_neighborhood" type="button"
					value="Upload Image" /></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</div>

<div class="activities-control">
	<input id="remove_selected_images_button" type="button" value="Remove Selected" />
	<input id="remove_all_images_button" type="button" value="Remove All" />
</div>

<div class="images-table">
		<table>
			<tr>
				<th>#</th>
				<th id="IDImage-name" ng-model="name">Image Name</th>
				<th id="ID-URL" ng-model="ImageURL">Image URL</th>
			</tr>
			<tr id={{image.id}}
				ng-repeat="image in images_list" id="images_table">
				<td><input id="checked{{ image.id }}" type="checkbox" /></td>
				<td>{{ image.activity_name }}</td>
				<td><img src="{{ image.url }}" width="40" height="40"></td>
			</tr>
		</table>
	</div>
