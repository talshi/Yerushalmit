<?php

?>

<h1>Manage Activities</h1>
<div>
    <!-- TODO need to find dynamicly the correct src of the image -->
    <img id="image" data-toggle="modal" data-target="#myModal" src="http://localhost/wordpress/wp-content/uploads/2016/05/mapify-logo.png"></img>
    <div id="popup"></div>
    <div id="note">Click on the image to add an activity</div>
</div>
<div>
    <button>Add</button>
    <button>Remove</button>
    <table border="2" width="500px">
        <tr>
            <td><input type="checkbox">1</td>
            <td>2</td>
            <td>3</td>    
        </tr>
        <tr>
            <td><input type="checkbox">1</td>
            <td>2</td>
            <td>3</td>    
        </tr>
        <tr>
            <td><input type="checkbox">1</td>
            <td>2</td>
            <td>3</td>    
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
            <label>Location: </label>
            <span id="location"></span>
        </div>
        <div>
            <label>Activity Name: </label>
            <input type="text">
        </div>
        <div>
            <label>Activity Date: </label>
            <input type="text">
        </div>
        <div>
            <label>Activity Category: </label>
            <input type="text">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="save-button" type="button" class="btn btn-default">Save</button>
      </div>
    </div>

  </div>
</div>

<script>
    // This code will recognize a click on the image and load the exact coordinates
    jQuery("#image").click(function (e) {
        console.log("X: " + e.clientX + " Y: " + e.clientY);
        jQuery("#location").html("X: " + e.clientX + " Y: " + e.clientY);
        jQuery("#myModal").show();
    });

</script>