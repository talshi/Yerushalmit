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
			<form class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Activity</h4>
				</div>
				<div class="modal-body">
					<div>
						<label>Index: </label> <span id="marker-index"></span>
					</div>
					<div>
						<label>Location: </label> <span id="location"></span>
					</div>
					<div>
						<label for="name_input">Activity Name: </label> <input id="name_input" type="text" required>
					</div>
					<div>
						<label for="date_input">Activity Date: </label> <input id="date_input" type="text" required>
					</div>
					<div>
						<label for="category_input">Activity Category: </label> <input id="category_input" type="text" required>
					</div>
					<div>
						<label for="desc_input">Activity Description: </label> <input id="desc_input" type="text">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<!-- 					<button id="save-button" type="button" class="btn btn-default">Save</button> -->
					<input id="save-button" type="submit" class="btn btn-default" value="Save" />
				</div>
			</form>

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

// Set size of image
var newwidth;
// Index of marker
var index = 0;

function getCoords(elem) {
	var r = elem.getBoundingClientRect();
	return { top: r.top, left: r.left };
}



jQuery(document).ready(function() {
	jQuery("#image-activities").width(newwidth);
	jQuery("#marker-index").html(index);
});

// Find cooridinates and normalize it according to image
jQuery("#image-activities").click(function (e) {
    var pageCoords = getCoords(this);
	x = ((e.clientX - pageCoords.left) * 100) / jQuery("#image-activities").width();
	y = ((e.clientY - pageCoords.top) * 100) / jQuery("#image-activities").height();
    jQuery("#location").html("X: " + x + " Y: " + y);
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

jQuery("#save-button").click(function(e) {
	var m = "<img id='img-marker" + index + "' class='marker' src='/wp-content/plugins/Mapify/admin/images/map-marker-icon.png'></img>";
	jQuery("#image-activities").after(m);
	jQuery("#img-marker" + index).css({
		"top": x + pageCoords.top,
		"left": y + pageCoords.left
	});

    var pageCoords = getCoords(this);
	x = ((e.clientX - pageCoords.left) * 100) / jQuery("#image-activities").width();
	y = ((e.clientY - pageCoords.top) * 100) / jQuery("#image-activities").height();
	index++;
	jQuery("#location").html("X: " + x + " Y: " + y);
	jQuery("#marker-index").html(index);
});

</script>