
<div class="manage_caption">Upload images to neighborhood</div>
<div class="note space">Enter an URL or upload an image for the banner.</div>
<div id="upload_neighborhood_img">
	<table class="table table-condensed">
		<tbody>
			<tr>
				<td><label for="neighborhood">Neighborhood:</label></td>
				<td><select id="neighborhood" ng-model="selectedNeighborhood"
					ng-options="activity as activity.neighborhood for activity in activities_list">
				</select></td>
				<td></td>
			</tr>
			<tr>
				<td><label for="upload_image_neighborhood">URL:</label></td>
				<td><input id="upload_image_neighborhood" type="text" size="75"
					name="upload_image_neighborhood" value="" /></td>
				<td><input id="upload_image_button_neighborhood" type="button"
					value="Upload Image" /></td>
			</tr>
			<tr>
				<td><input id="save_button_upload" type="button" value="Save Image" /></td>
				<td></td>
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
