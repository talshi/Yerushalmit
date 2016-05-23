
<div ng-app="wp_mapify_app">
	<div id="manage_caption">Manage Activities</div>
	<div class="note">Click on the image to add an activity.</div>

<!--	<div>
		<input id="zoom-in" class="btn btn-default" type="button" value="+" />
		<input id="zoom-out" class="btn btn-default" type="button" value="-" />
	</div>
-->
	<div id="map">
		<!-- TODO need to find dynamicly the correct src of the image -->
		<img id="image-activities" data-toggle="modal" data-target="#myModal"
			src="http://localhost/wordpress/wp-content/uploads/2016/05/map.png"></img>
        <span id="popup"></span>
	</div>


	<div class="activities-table" ng-controller="activitiesCtrl">
		<table>
			<tr>
				<th>Activity Name</th>
				<th>Date</th>
				<th>Description</th>
				<th>Remove</th>
			</tr>
			<tr ng-repeat="activity in activities_list">
				<td>{{ activity.name }}</td>
				<td>{{ activity.date }}</td>
				<td>{{ activity.description }}</td>
				<td><input type="checkbox" /></td>
			</tr>
		</table>
		<input id="remove-button" type="button" value="Remove Selected" />
	</div>

<!-- Popup window for new activity -->
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

<!-- Popup window for edit activity -->
    <div id="myImg" class="modal fade" role="dialog">
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
						<label>Activity Name: </label>
					</div>
					<div>
						<label>Activity Date: </label>
					</div>
					<div>
						<label>Activity Category: </label>
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
    var index = 0;
    var x;
    var y;
    // Find cooridinates and normalize it according to image
    jQuery("#image-activities").click(function (e) {
        var pageCoords = getCoords(this);
        x = ((e.clientX - pageCoords.left) * 100) / jQuery("#image-activities").width();
        y = ((e.clientY - pageCoords.top) * 100) / jQuery("#image-activities").height();
        jQuery("#location").html("X: " + x + " Y: " + y);
    });
    function getCoords(elem) {
        var r = elem.getBoundingClientRect();
        return { top: r.top, left: r.left };
    }
    // Set size of image
    var newwidth;
    jQuery(document).ready(function () {
        jQuery("#image-activities").width(newwidth);
    });
    // Zoom-In Button
    jQuery("#zoom-in").click(function (e) {
        var currentwidth = jQuery("#image-activities").width();
        var imgoffset = jQuery("#image-activities").offset().left;
        if (currentwidth < (screen.width - imgoffset) * 0.9) {
            newwidth = currentwidth * 1.1;
            jQuery("#image-activities").width(newwidth);
        }
    });
    //Zoom-Out Button
    jQuery("#zoom-out").click(function (e) {
        var currentwidth = jQuery("#image-activities").width();
        var imgoffset = jQuery("#image-activities").offset().left;
        if (currentwidth > screen.width * 0.4) {
            newwidth = currentwidth * 0.9;
            jQuery("#image-activities").width(newwidth);
        }
    });
    jQuery("#save-button").click(function (e) {
        // TODO validation of forms
        var m = "<img id='img-marker" + index + "' class='marker' src='/wp-content/plugins/Mapify/admin/images/marker.png' data-toggle='modal' data-target='#myImg'></img>";
        jQuery("#image-activities").after(m);
        var div = document.getElementById("image-activities");
        var rect = div.getBoundingClientRect();

        x_left = rect.left;
        y_top = rect.top;
        w_ = rect.right - rect.left;
        h_ = rect.bottom - rect.top;

        jQuery("#img-marker" + index).css({
            "top": (y / 100) * h_ - (25),
            "left": (x / 100) * w_ - (12.5)
        });
        index++;
    });

</script>