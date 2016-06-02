
<div class="space" ng-app="wp_mapify_app" ng-controller="activitiesCtrl">
	<h1>Manage Activities</h1>

	<div class="note">Click on the image to add an activity.</div>

	<div id="map" ng-init="initActivities()">
		<!-- TODO need to find dynamicly the correct src of the image -->
		<img id="image-activities" data-toggle="modal" data-target="#myModal"
			src="http://localhost/wordpress/wp-content/uploads/2016/05/map.jpg"
			ng-click="createCoords($event)"></img> <span id="popup"></span>
	</div>
	<div class="activities-control">
		<!-- search bar -->
		<label for="search">Search:</label> <input name="search" type="text"
			ng-model="query" /> <input type="button" value="Remove Selected" /> <input
			type="button" value="Remove All" />
	</div>
	<div class="activities-table">
		<table>
			<tr>
				<th>#</th>
				<th id="IDactivity-name" ng-model="name" ng-click="sortBy='name'; reverseSort=!reverseSort">Activity Name</th>
				<th id="IDDate" ng-model="date"ng-click="sortBy='date'; reverseSort=!reverseSort">Date</th>
				<th id="IDNeighb" ng-model="neighborhood"ng-click="sortBy='neighborhood'; reverseSort=!reverseSort" >neighborhood</th>
				<th id="IDCategory" ng-model="category"ng-click="sortBy='category'; reverseSort=!reverseSort">Category</th>
				<th>Description</th>
				<th>Edit</th>
			</tr>
			<tr
				ng-repeat="activity in activities_list | filter: query | orderBy:sortBy:reverseSort "id="table">
				<td><input id="" type="checkbox" /></td>
				<td>{{ activity.name }}</td>
				<td>{{ activity.date }}</td>
				<td>{{ activity.neighborhood}}</td>
				<td>{{ activity.category }}</td>
				<td>{{ activity.description }}</td>
				<td><input type="button" id="" value="Edit"></td>
			</tr>
		</table>
	</div>


	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Activity</h4>
				</div>
				<form class="modal-body" role="form">
					<table id="IdInsertTable" class="table table-hover">
						<tr>
							<td><label>Activity Name</label></td>
							<td><input type="text" ng-model="activityName"
								placeholder="Activity Name"></td>
						</tr>
						<tr>
							<td><label>Activity Date</label></td>
							<td><input type="text" ng-model="activityDate" placeholder="dd/mm/yyyy"></td>
						</tr>
						<tr>
							<td><label>Neighborhood</label></td>
							<td><input type="text" ng-model="neighborhood"
								placeholder="Neighborhood"></td>
						</tr>
						<tr>
							<td><label>Activity Category</label></td>
							<td><select ng-model="selectedCategory"
								ng-options="category as category.name for category in categories_list">
								<option></option>
								</select></td>
						</tr>
						<tr>
							<td><label>Description</label></td>
							<td><textarea type="text" ng-model="activityDescription" rows="4" cols="40"> </textarea></td>
						</tr>
					</table>

					<div id="upload_image_admin">
						<div id="upload_note">Enter an URL or upload an image</div>
						<div id="upload_image_container">
							<label id="upload_map_label_act" for="upload_image_act">Upload Image</label>
							<input id="upload_image_act" type="text" size="24"name="upload_image_act" value="" /> 
						    <input id="upload_image_button"	type="button" value="Upload Image" />
						    <input id="save_button_act" type="button" value="Save Image" /> <br />
							</td>
						</div>
					</div>

	<script>
	


	</script>




					<div class="modal-footer">

						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

						<!-- add item to DB.... -->

						<button id="save-button" class="btn btn-default" type="submit"
							action="" data-dismiss="modal" ng-click="addActivity()">Save</button>
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
				<table id="IdInsertTable" class="table table-hover">
					<tr>
						<td><label>Activity Name</label></td>
						<td><input type="text" ng-model="activityName"
							placeholder="Activity Name"></td>
					</tr>
					<tr>
						<td><label>Activity Date</label></td>
						<td><input type="text" ng-model="activityDate"
							placeholder="dd/mm/yyyy"></td>
					</tr>
					<tr>
						<td><label>Neighborhood</label></td>
						<td><input type="text" ng-model="neighborhood"
							placeholder="Neighborhood"></td>
					</tr>
					<tr>
						<td><label>Activity Category</label></td>
						<td><select>
								<option ng-repeat="category in categories_list"
									value="{{category.name}}">{{category.name}}</option>
						</select></td>
					</tr>
					<tr>
						<td><label>Description</label></td>
						<td><textarea type="text" ng-model="activityDescription" rows="4"
								cols="40"> </textarea></td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="save-button" type="button" class="btn btn-default">Save</button>
			</div>
		</div>

	</div>
</div>

