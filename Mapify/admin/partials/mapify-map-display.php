<div id="success"></div>

<div class="manage_caption">Manage Map</div>

<table class="manageMapTable">
	<tr>
		<td>
			<div class="note space">Enter an URL or upload an image for the
				banner.</div>
			<div id="upload_main_img">
				<label id="upload_map_label" for="upload_image_main">Upload Main
					Image</label><br> <input id="upload_image_main" type="text"
					size="36" name="upload_image" placeholder="Upload an Image" /> <input
					id="upload_image_button_main" type="button" value="Upload Image" class= "buttonDesign"/>
				<input id="save_button_main" type="button" value="Save Image" class= "buttonDesign"/>
			</div>
		</td>

		<td>
			<div>
				<div>
					<label id="preview_label" class="page-header"></label>
				</div>
				<div id="DivImg_preview">
					<img id="img_preview" class="img_preview" alt ="IMAGE"></img>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td><div id="upload_neighborhood_img">
				<label id="upload_map_label" for="upload_image_neighborhood">Upload
					neighborhood Image </label>
				<div class="note space">Enter an URL or upload an image for the
					banner.</div>
				<div class="space">
					<label for="neighborhood">Neighborhood:</label> <input
						id="neighborhood" type="text"
						placeholder="Insert Name of Neighborhood" required />
				</div>
				<input id="upload_image_neighborhood" type="text" size="36"
					name="upload_image_neighborhood" placeholder="Upload an Image" /> <input
					id="upload_image_button_neighborhood" type="button"
					value="Upload Image" class= "buttonDesign"/> <input id="save_button_neighborhood"
					type="button" value="Save Image" class= "buttonDesign" />

			</div></td>
		<td>
		</td>
	</tr>
</table>
<div class="activities-control">
	<input class = "buttonDesign" id="remove_selected_images_button" type="button" value="Remove Selected" />
	<input class = "buttonDesign" id="remove_all_images_button" type="button" value="Remove All" />
</div>
<div class="images-table">
		<table>
			<tr class="firstLineTable">
				<th>#</th>
				<th id="IDImage-name" ng-model="name" ng-click="sortBy='neighbothood'; reverseSort=!reverseSort" >Neighbothood</th>
				<th id="ID-URL" ng-model="ImageURL">Image</th>
			</tr>
			<tr id={{image.id}} ng-repeat = "image in neighbothood_list | filter: query | orderBy:sortBy:reverseSort " class="data_table">
				<td width = "10%"><input id="checked{{ image.id }}" type="checkbox" /></td>
				<td width = "75%"  class = "fontImages">{{ image.neighborhood }}</td>
				<td width = "15%"><img src="{{ image.url }}" width="100%" height="20%"></td>
			</tr>
		</table>
	</div>





