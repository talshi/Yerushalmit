
<div ng-app="wp_mapify_app" class="space">
	<h1>Manage Activities</h1>

	<div class="note">Click on the image to add an activity.</div>

	<div id="map">
		<!-- TODO need to find dynamicly the correct src of the image -->
		<img id="image-activities" data-toggle="modal" data-target="#myModal"
			src="http://localhost/wordpress/wp-content/uploads/2016/05/map.jpg"></img>
        <span id="popup"></span>
	</div>


	<div class="activities-table" ng-controller="activitiesCtrl">
		<table>
			<tr>
				<th>#</th>
				<th id = "IDactivity-name" onClick = "sort(0)">Activity Name</th>
				<th id="IDDate" onclick = "sort(1)">Date</th>
				<th>Description</th>
				<th>Edit</th>
			</tr>
			<tr ng-repeat="activity in activities_list">
				<td><input type="checkbox" /></td>
				<td>{{ activity.name }}</td>
				<td>{{ activity.date }}</td>
				<td>{{ activity.description }}</td>
				<td>{{ activity.edit }}</td>
			</tr>
		</table>
		<input type="button" value="Remove Selected" />
		<input type="button" value="Delete All" />
		
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
					<div id="upload_image_admin">
					<div id="upload_note">Enter an URL or upload an image </div>
						<div id="upload_image_container">
						    <label id="upload_map_label" for="upload_image">Upload Image</label>
						    <input id="upload_image" type="text" size="36" name="upload_image" value="" />
						    <input id="upload_image_button" type="button" value="Upload Image" />
						    <input id="save_button" type="button" value="Save Image" />
						    <br />
						</div>
						
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button id="save-button" type="button" class="btn btn-default">Save</button>
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
        var clickX = e.clientX;
        var clickY = e.clientY;


	    x = ((clickX - pageCoords.left) * 100) / jQuery("#image-activities").width();
        y = ((clickY - pageCoords.top) * 100) / jQuery("#image-activities").height();
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

    jQuery("#save-button").click(function (e) {
        // TODO validation of forms
        var m = "<img id='img-marker" + index + "' class='marker' src='/wp-content/plugins/Mapify/admin/images/map-marker-icon.png' data-toggle='modal' data-target='#myImg'></img>";
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

