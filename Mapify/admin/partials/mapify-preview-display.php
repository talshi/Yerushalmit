
<div ng-controller="previewCtrl">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
	
<div id="upload_neighborhood_img">  
<h2>Upload images to neighborhood </h2>


<div id="upload_note">Enter an URL or upload an image for the banner.</div>

  <table class="table table-condensed">
    <tbody>
      <tr>
        <td>neighborhood :</td>
		<td><input type ="text" id = "neighborhoodSelctor" /></td>
        <td></td>
      </tr>
      <tr>
        <td>URL:</td>
        <td><input id="upload_image_neighborhood" type="text" size="36" name="upload_image_neighborhood" value="" /></td>
        <td></td>
      </tr>
      <tr>
        <td>Upload</td>
        <td>Save</td>
        <td>delete</td>
      </tr>
    </tbody>
  </table>
</div>

   	
	

    <input id="upload_image_button_neighborhood" type="button" value="Upload Image" />
    <input id="save_button_neighborhood" type="button" value="Save Image" />
    
    <br>
	    neighborhood: <input id="neighborhood" type ="text">
    <br>
    	
 </div>

<div>
    <div><label id="preview_label" class="page-header"></label></div>
    <div><img id="img_preview" class="img_preview"></img></div>
</div>

 
<div>
    <div><label id="preview_label_neighborhood" class="page-header"></label></div>
    <div><img id="img_preview_neighborhood" class="img_preview"></img></div>
</div>



<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("#upload_image_button_main").click(function (e) {
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
                $('#upload_image_main').val(image_url)
                var image_link = $('#upload_image_main').val();
                $("#preview_label").html("Preview:");
                $("#img_preview").attr("src", image_link);
            });
        });

        $("#save_button_main").click(function() {
    		img_url = jQuery("#upload_image_main").val();
    		$.ajax({
    			url: "../wp-content/plugins/Mapify/DB/save-img.php",
    			type: "POST",
    			dataType: "json",
    			data: {
    				'img_url': img_url,
    				//TODO fix neighborhood data
    				'neighborhood' : "main"
    			},
    			success: function(data) {
    				//console.log(data);
    				$("#success").html("SUCCESS!!!!!!!!!!!!");
    			},
    			error: function(error) {
    				console.log(error);
    			}
    		});
    	});
    });
</script>
