
<div>
	<div class="manage_caption">Manage Activities</div>
	<div class="note space">
		Click on the image to add an activity. Scroll down to manage your
		activities. <b>(refresh the page if the image does not appear)</b>
	</div>
	<div id="map" ng-init="">
		<img id="image-activities" data-toggle="modal" data-target="#myModal"
			src="{{ img_url }}" ng-click="createCoords($event)"></img> <span
			id="popup"></span>
		<div ng-repeat="activity in activities_list">
			<img id="{{activity.id}}" class="marker" style="top: {{activity.locationY}}%; left: {{activity.locationX}}%; display: relative;	" ng-src="/wp-content/plugins/Mapify/admin/images/map-marker-icon.png" ng-click="editFunction(activity.id)" data-toggle='modal' data-target='#myImg'></img>
		</div>
	</div>
	<div class="activities-control">
		<!-- search bar -->
		<label for="search">Search:</label> <input name="search" type="text"
			ng-model="query" /> <input type="button" value="Remove Selected" /> <input
			type="button" value="Remove All" id="remove_all_button" />
	</div>
	<div class="activities-table">
		<table>
			<tr>
				<th>#</th>
				<th id="IDactivity-name" ng-model="name"
					ng-click="sortBy='name'; reverseSort=!reverseSort">Activity Name</th>
				<th id="IDDate" ng-model="date"
					ng-click="sortBy='date'; reverseSort=!reverseSort">Date</th>
				<th id="IDNeighb" ng-model="neighborhood"
					ng-click="sortBy='neighborhood'; reverseSort=!reverseSort">neighborhood</th>
				<th id="IDCategory" ng-model="category"
					ng-click="sortBy='category'; reverseSort=!reverseSort">Category</th>
				<th>Description</th>
				<th>Edit</th>
			</tr>
			<tr id={{activity.id}}
				ng-repeat="activity in activities_list | filter: query | orderBy:sortBy:reverseSort "
				id="table">
				<td><input id="" type="checkbox" /></td>
				<td>{{ activity.name }}</td>
				<td>{{ activity.date | date: "dd/MM/yyyy" }}</td>
				<td>{{ activity.neighborhood}}</td>
				<td>{{ activity.category }}</td>
				<td>{{ activity.description }}</td>
				<td><input type="button" id={{activity.id}} value="Edit"
					ng-click="editFunction(activity.id)" data-toggle="modal"
					data-target="#myImg"></td>
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
							<td><input type="text" ng-model="activityDate"
								placeholder="dd/mm/yyyy"></td>
						</tr>
						<tr>
							<td><label>Neighborhood</label></td>

							<td><select ng-model="selectedNeighborhood" 
								ng-options="neighborhood as neighborhood.neighborhood for neighborhood in neighborhood_list">
									<option></option>
							</select></td>


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
							<td><textarea type="text" ng-model="activityDescription" rows="4"
									cols="40"> </textarea></td>
						</tr>
					</table>
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
				<h4 class="modal-title">Edit Activity</h4>
			</div>

			<div class="modal-body">
				<table id="IdInsertTable" class="table table-hover">
					<tr>
						<td><label>Activity Name</label></td>
						<td><input type="text" ng-model="activityNameEdit" 
							placeholder="Activity Name"></td>
					</tr>
					<tr>
						<td><label>Activity Date</label></td>
						<td><input type="text" ng-model="activityDateEdit"
							placeholder="dd/mm/yyyy"  ></td>
					</tr>
					<tr>
						<td><label>Neighborhood</label></td>

						<td><select ng-model="selectedNeighborhood" 
							ng-options="neighborhood as neighborhood.neighborhood for neighborhood in neighborhood_list">
								<option value="" selected hidden />								
						</select></td>
					</tr>
					<tr>
						<td><label>Activity Category</label></td>
						<td><select ng-model="selectedCategory"
							ng-options="category as category.name for category in categories_list">
								<option value="" selected hidden />					
						</select></td>
					</tr>
					<tr>
						<td><label>Description</label></td>
						<td><textarea type="text" ng-model="activityDesEdit" rows="4"
								cols="40" > </textarea></td>
								
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="save-button" type="button" class="btn btn-default" ng-click = "saveEditFunction()" data-dismiss="modal" >Save</button>
			</div>
		</div>

	</div>
</div>

