<?php
?>
<div ng-app="wp_mapify_app" class="space">
	<h1>Manage Activities</h1>

	<div class="note">Click on the image to add an activity.</div>

	<div>
		<input id="zoom-in" class="btn btn-default" type="button" value="+" />
		<input id="zoom-out" class="btn btn-default" type="button" value="-" />
	</div>

	<div>
		<!-- TODO need to find dynamicly the correct src of the image -->
		<img id="image-activities" data-toggle="modal" data-target="#myModal"
			src="http://localhost/wordpress/wp-content/uploads/2016/05/jerusalem-map.png"></img>
		<div id="popup"></div>
	</div>

	<div class="activities-table" ng-controller="activitiesCtrl">
		<table>
			<tr>
				<th>#</th>
				<th>Activity Name</th>
				<th>Date</th>
				<th>Description</th>
			</tr>
			<tr ng-repeat="activity in activities_list">
				<td><input type="checkbox" /></td>
				<td>{{ activity.name }}</td>
				<td>{{ activity.date }}</td>
				<td>{{ activity.description }}</td>
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
				<div class="modal-body">
					<div>
						<label>Location: </label> <span id="location"></span>
					</div>
					<div>
						<label>Activity Name: </label> <input type="text">
					</div>
					<div>
						<label>Activity Date: </label> <input type="text">
					</div>
					<div>
						<label>Activity Category: </label> <input type="text">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="save-button" type="button" class="btn btn-default">Save</button>
				</div>
			</div>

		</div>
	</div>
</div>

<script>

// Find cooridinates and normalize it according to image
jQuery("#image-activities").click(function (e) {
    var pageCoords = getCoords(this);
    var x = e.clientX - pageCoords.left;
    var y = e.clientY - pageCoords.top;
    jQuery("#location").html("X: " + x + " Y: " + y);
});

function getCoords(elem) {
	var r = elem.getBoundingClientRect();
	return { top: r.top, left: r.left };
}

// Set size of image
var newwidth;

jQuery(document).ready(function() {
	jQuery("#image-activities").width(newwidth);
});

// Zoom-In Button
jQuery("#zoom-in").click(function(e) {
	var currentwidth = jQuery("#image-activities").width();
	var imgoffset = jQuery("#image-activities").offset().left;
	if(currentwidth < (screen.width - imgoffset) * 0.9) {
		newwidth = currentwidth*1.1;
		jQuery("#image-activities").width(newwidth);
	}
});

//Zoom-Out Button
jQuery("#zoom-out").click(function(e) {
	var currentwidth = jQuery("#image-activities").width();
	var imgoffset = jQuery("#image-activities").offset().left;
	if(currentwidth > screen.width * 0.4) {
		newwidth = currentwidth*0.9;
		jQuery("#image-activities").width(newwidth);
	}
});

</script>