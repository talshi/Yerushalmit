
<div class="space" ng-app="wp_mapify_app" ng-controller="activitiesCtrl">
	<h1>Manage Activities</h1>

	<div class="note">Click on the image to add an activity.</div>

	<div id="map" ng-init = "initActivities()">
		<!-- TODO need to find dynamicly the correct src of the image -->
		<img id="image-activities" data-toggle="modal" data-target="#myModal"
			src="http://localhost/wordpress/wp-content/uploads/2016/05/map.jpg" ng-click = "createCoords($event)" ></img>
		<span id="popup"></span>
	</div>

	<div class="activities-table">
		<table>
			<tr>
				<th>#</th>
				<th id="IDactivity-name" ng-model="name"
					ng-click="sortBy='name'; reverseSort=!reverseSort">Activity Name</th>
				<th id="IDDate" ng-model="date"
					ng-click="sortBy='date'; reverseSort=!reverseSort">Date</th>
				<th>neighborhood</th>
				<th id="IDDate" ng-model="date"ng-click="sortBy='category'; reverseSort=!reverseSort">Category</th>
				<th>Description</th>
				<th>Edit</th>
			</tr>
			<tr
				ng-repeat="activity in activities_list | filter: query | orderBy:sortBy:reverseSort "
				id="table">
				<td><input id="" type="checkbox" /></td>
				<td>{{ activity.name }}</td>
				<td>{{ activity.date }}</td>
				<td>{{ activity.neighborhood}}</td>
				<td>{{ activity.category }}</td>
				<td>{{ activity.description }}</td>
				<td><input type="button" id="" value="Edit"></td>
			</tr>
		</table>
		<div class="activities-control">
			<!-- search bar -->
			<label for="search">Search:</label> <input name="search" type="text"
				ng-model="query" /> <input type="button" value="Remove Selected" />
			<input type="button" value="Delete All" />
		</div>
	</div>


	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Activity</h4>
				</div>
				<form class="modal-body" role="form" >

					<label>Location X: </label> <span id="locationX" ng-model= "locationX"></span>
					<br>
					<label>Location Y: </label> <span id="locationY" ng-model= "locationY"></span>
					
					<table id="IdInsertTable" class="table table-hover">
						<tr>
							<td><label>Activity Name </label></td>
							<td><input type="text" ng-model="activityName" placeholder="Activity Name"></td>
						</tr>
						<tr>
							<td><label>Activity Date </label></td>
							<td><input type="text" ng-model="activityDate"
								placeholder="dd/mm/yyyy"></td>
						</tr>
						<tr>
							<td><label>Neighborhood </label></td>
							<td><input type="text" ng-model="neighborhood" placeholder="neighborhood"></td>
						</tr>						
						<tr>
							<td><label>Activity Category </label></td>
							<!-- 							<td><input type="text" ng-model="activityCategory"></td> -->
							<td><select>
									<option ng-repeat="category in categories_list"
										value="{{category.name}}">{{category.name}}</option>
							</select></td>
						</tr>
						<tr>
							<td><label>Description </label></td>
							<br>
							<br>
							<td><textarea type="text" ng-model="activityDescription" rows="4" cols="40"> </textarea></td>
						</tr>
					</table>

					<div id="upload_image_admin">
						<div id="upload_note">Enter an URL or upload an image</div>
						<div id="upload_image_container">

							<label id="upload_map_label" for="upload_image">Upload Image</label>
							<input id="upload_image" type="text" size="24"
								name="upload_image" value="" /> <input id="upload_image_button"
								type="button" value="Upload Image" /> <input id="save_button"
								type="button" value="Save Image" /> <br />
							</td>
						</div>
					</div>

					<div class="modal-footer">
						
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						
						<!-- add item to DB.... -->
						
						<button id="save-button" class="btn btn-default" type="submit" action="" data-dismiss="modal" ng-click = "addActivity()"  >Save</button>
					</div>

				</form>
			</div>

		</div>

	</div>
</div>

<div id="myImg" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Activity Details</h4>
			</div>
			<div class="modal-body">
				<div>
					<label>Location: </label> <span id="location"></span>
				</div>
				<div>
					<label>Activity Name: </label>
				</div>
				<div>
					<label>Activity Date: </label>
				</div>
				<div>
					<label>Activity Category: </label>
				</div>
				<div>
					<label>neighborhood:</label>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="save-button" type="button" class="btn btn-default">Save</button>
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

