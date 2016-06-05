
<div ng-controller="imagesCtrl">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet"
		href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script
		src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


	<div id="upload_neighborhood_img">
		<h2>Upload images to neighborhood</h2>

		<div id="upload_note">Enter an URL or upload an image for the banner.</div>

		<table class="table table-condensed">
			<tbody>
				<tr>
					<td>neighborhood :</td>
					<td ><select ng-model="selectedNeighborhood"
						ng-options="activity as activity.neighborhood for activity in activities_list">
							<option></option>
					</select></td>
					<td></td>
				</tr>
				<tr>
					<td>URL:</td>
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
</div>

<div>
	<div>
		<label id="preview_label" class="page-header"></label>
	</div>
	<div>
		<img id="img_preview" class="img_preview"></img>
	</div>
</div>
