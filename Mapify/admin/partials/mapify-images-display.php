
<div class="manage_caption">Upload Images to Neighborhood</div>
<div class="note space">Enter an URL or upload an image for the banner.</div>
<hr>
<div id = "success_image"></div>
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

<div>
	<div>
		<label id="preview_label" class="page-header"></label>
	</div>
	<div>
		<img id="img_preview" class="img_preview"></img>
	</div>
</div>
