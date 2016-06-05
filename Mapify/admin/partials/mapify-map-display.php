<div id="success"></div>

<div class="manage_caption">Manage Map</div>
<div class="note space">Enter an URL or upload an image for the banner.</div>
<div id="upload_main_img">
		<label id="upload_map_label" for="upload_image_main">Upload Main Image</label><br>
		<input id="upload_image_main" type="text" size="36"
			name="upload_image" placeholder="Upload an Image" />
	<input id="upload_image_button_main" type="button" value="Upload Image" />
	<input id="save_button_main" type="button" value="Save Image" />


</div>
<br>
<div id="upload_neighborhood_img">
	<label id="upload_map_label" for="upload_image_neighborhood">Upload
		neighborhood Image </label>
	<div class="note space">Enter an URL or upload an image for the banner.</div>
	<div class="space">
		<label for="neighborhood">Neighborhood:</label> <input
			id="neighborhood" type="text"
			placeholder="Insert Name of Neighborhood" required />
	</div>
	<input id="upload_image_neighborhood" type="text" size="36"
		name="upload_image_neighborhood" placeholder="Upload an Image" /> <input
		id="upload_image_button_neighborhood" type="button"
		value="Upload Image" /> <input id="save_button_neighborhood"
		type="button" value="Save Image" />

</div>


<div>
	<div>
		<label id="preview_label" class="page-header"></label>
	</div>
	<div>
		<img id="img_preview" class="img_preview"></img>
	</div>
</div>


<div>
	<div>
		<label id="preview_label_neighborhood" class="page-header"></label>
	</div>
	<div>
		<img id="img_preview_neighborhood" class="img_preview"></img>
	</div>
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
    				$("#success").html("<div class='notice notice-success is-dismissable'>Image Saved Successfully!</div>");
    			},
    			error: function(error) {
    				$("#success").html("<div class='notice notice-error is-dismissable'>ERROR: Image Did Not Save!</div>");
    			}
    		});
    	});
    });
</script>

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("#upload_image_button_neighborhood").click(function (e) {

            // check input value			
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
                $('#upload_image_neighborhood').val(image_url)
                var image_link = $('#upload_image_neighborhood').val();
                $("#preview_label").html("Preview:");
                $("#img_preview").attr("src", image_link);
            });
        });

        $("#save_button_neighborhood").click(function() {

			if($('#neighborhood').val().length  == 0 || $('#upload_image_neighborhood').val().length == 0 )
			{
				alert("Enter neighborhood name and URL image");
				return;
			}
            
    		img_url = jQuery("#upload_image_neighborhood").val();
    		img_neighborhood = jQuery("#neighborhood").val();
    		$.ajax({
    			url: "../wp-content/plugins/Mapify/DB/save-img.php",
    			type: "POST",
     			dataType: "json",
    			data: {
    				'img_url': img_url,
    				'neighborhood' : img_neighborhood
    			},
    			success: function(data) {
    				console.log(data);
    				$("#success").html("<div class='notice notice-success is-dismissable'>Neighborhood's Image Saved Successfully!</div>");
    			},
    			error: function(error) {
    				$("#success").html("<div class='notice notice-error is-dismissable'>ERROR: Neighborhood's Image Did Not Save!</div>");
    			}
    		});
    	});
    });
</script>


