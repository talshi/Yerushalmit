<?PHP
	global $_HEIGHT;
	global $_WIDTH;
	global $_ZOOM;
	global $_LAT;
	global $_LNG;
	global $_DEFAULT_LAYER;
	global $_BASE_LAYERS;
	global $_DATA;
	global $_SHOW_SIDEBAR;
	global $_SHOW_MEASURE;
	global $_SHOW_SEARCH;
	global $_SHOW_MINIMAP;
	global $_SHOW_SVG;
	global $_SHOW_EXPORT;
	
	global $_IS_DRAW;
?>

<?PHP 
	if($_IS_DRAW) { echo '<div id="map_canvas" class="col-md-12" style="height: 500px;"></div>'; }
	else { 
		if(isset($_GET['height']) && isset($_GET['width'])) {
			echo '<div id="map_canvas" class="col-md-12" style="height: '.$_GET['height'].'; width: '.$_GET['width'].';"></div>';
		}
		else {
			echo '<div id="map_canvas" class="col-md-12" style="height: '.$_HEIGHT.'px; width: '.$_WIDTH.'px;"></div>';
		}
	}
?>

<style>
	body {
		padding: 0 !important;
		margin: 0 !important;
	}
	#sidebar-buttons {
		display: none; z-index: 999999; opacity: 0; left: -50px; margin-top: 4px;position: absolute;padding: 5px; min-width: 200px;height: auto; color: rgb(51, 51, 51); border-radius: 4px; background-color: rgb(255, 255, 255);border: 1px solid #CCC;
	}
	#sidebar-buttons ul.leaflet-sidebar li a{
		cursor:pointer;
		text-decoration: none;
		display: inline;
		outline:none;
		color:#000;
	}
	#sidebar-buttons ul.leaflet-sidebar{
		list-style: none;
		margin: 0;
	}
	#sidebar-buttons ul.leaflet-sidebar li input[type=checkbox]{
		outline:none;
	}
	#sidebar-buttons ul.leaflet-sidebar li{
		display: inline;
	}
	.clear{
		clear:both;
	}
	
	.pac-container {
		/*top: 295px !important;*/
		z-index: 1042;
	}
	.colpick {
		z-index : 1041;
	}
	.leaflet-popup img {
		max-width: 100%!important;
	}
	.leaflet-popup-close-button {
	  color: white !important;
	  border-radius: 50% !important;
	  background: black !important;
	  padding: 3px !important;
	  width: auto !important;
	  height: auto !important;
	  top: -10px !important;
	  right: -10px !important;
	  -webkit-box-shadow: 0px 0px 7px 1px #414141 !important;
	  -moz-box-shadow: 0px 0px 7px 1px #414141 !important;
	  box-shadow: 0px 0px 7px 1px #414141 !important;
	}
	
.bubble.static {
	z-index: 1005;
	overflow-y: auto;
	position: absolute;
	background: #fff;
	border-radius: 2px;
	color: #000;
	padding: 1em;
	max-height: 90%;
	max-width: 400px;
	left: 70px;
	top: 20px;
	opacity: .85;
}
.bubble.static.selected {
	opacity: .9;
}
.bubble.static.bound {
	display: block;
}
.bubble.static .title {
	display: inline;
	font-size: 2em;
	line-height: 1em;
}
.bubble.static .content {
	margin-top: .7em;
}
.leaflet-popup-content-wrapper {
	max-height: 280px;
	overflow-y: auto;
}
</style>

<div class="bubble static bound selected" id="static-popup" style="display: none;">
	<a name="close" class="close" id="static-popup-close" onClick="mapClosePopup();"><i class="fa fa-close"></i></a>
	<div class="content body" rv-html="record:body" rv-show="record:body" id="static-popup-content"></div>
</div>
<div class="modal fade" style="display:none;z-index:1041;" id="mapfig_myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title">Add/Edit Properties And Styles</h4>
      </div>
      <div class="modal-body">
            
            <div role="tabpanel">

              <!-- Nav tabs -->
              <ul class="nav nav-tabs nav-justified" role="tablist" style="padding: 1px;">
                <li role="presentation" class="active"><a href="#properties" aria-controls="properties" role="tab" data-toggle="tab">Properties</a></li>
                <li role="presentation"><a href="#advanced" aria-controls="advanced" role="tab" data-toggle="tab">Advanced</a></li>
                <li role="presentation"><a href="#style" aria-controls="style" role="tab" data-toggle="tab">Styles</a></li>
                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content" style="padding: 10px 20px; border-style: solid; border-width: 0 1px 1px 1px; border-color: #dde6e9;">
                <div role="tabpanel" class="tab-pane active" id="properties"> 
                                     
                    <table style="border:0" id="menuBasic" class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <td><label for="">Location</label></td>
                                <td><input type="text" id="autoFillAddress" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label for="">Description</label></td>
                                <td><textarea id="description"></textarea></td>
                            </tr>   
                        </tbody>                                             
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="advanced">

                    <table id="menuCustomProperties" class="table table-striped table-bordered table-hover"><tbody></tbody></table>
                </div>
                <div role="tabpanel" class="tab-pane" id="style">
                    <table id="menuStyle" class="table table-striped table-bordered table-hover"><tbody></tbody></table>
                </div>         

              </div>

            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit_modal">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
	var featureGroup = L.featureGroup();
	var show_sidebar = <?=$_SHOW_SIDEBAR?>;
	var show_search  = <?=$_SHOW_SEARCH?>;
	var show_measure = <?=$_SHOW_MEASURE?>;
	var show_minimap = <?=$_SHOW_MINIMAP?>;
	var show_export  = <?=$_SHOW_EXPORT?>;
	var show_svg = <?=$_SHOW_SVG?>;
	var mbAttribution = ' contributors | <a href="https://www.<?=MF_MAIN_DOMAIN?>" target="_blank"><?=MF_PLUGIN_NAME_FORMATED?></a>';
	var defaultLayer = <?=$_DEFAULT_LAYER?>;
	var defaultLayerMiniMap = <?=$_DEFAULT_LAYER?>;
	
	var editMode = false;
	
	var baseLayers = <?=$_BASE_LAYERS?>;
	var overlays = {
		"Map Points": featureGroup
	};
	var layerSelector = L.control.layers(baseLayers, overlays);
	var map = null;
	
	$(document).ready(function() {
		map = L.map('map_canvas', { dragging: true, touchZoom: true, scrollWheelZoom: true, doubleClickZoom: true, boxzoom: true, trackResize: true, worldCopyJump: false, closePopupOnClick: true, keyboard: true, keyboardPanOffset: 80, keyboardZoomOffset: 1, inertia: true, inertiaDeceleration: 3000, inertiaMaxSpeed: 1500, zoomControl: true, crs: L.CRS.EPSG3857, fullscreenControl: true, layers: [defaultLayer, featureGroup] });
		map.setView([<?=$_LAT?>,<?=$_LNG?>], <?=$_ZOOM?>);
		
		L.control.locate({
			position: 'bottomright', 
			drawCircle: true,
			follow: true,
			setView: true,
			keepCurrentZoomLevel: true,
			remainActive: false,
			circleStyle: {},
			markerStyle: {},
			followCircleStyle: {},
			followMarkerStyle: {},
			icon: 'icon-cross-hairs',
			circlePadding: [0,0],
			metric: true,
			showPopup: true,
			strings: {
				title: 'I am Here',
				popup: 'You are within {distance} {unit} from this point',
				outsideMapBoundsMsg: 'You seem located outside the boundaries of the map'
			},
			locateOptions: { watch: true }
		}).addTo(map);
		L.control.scale({position:'bottomleft', maxWidth: 100, metric: true, imperial: true, updateWhenIdle: false}).addTo(map);
		map.addControl(L.control.search());
		new L.Control.MiniMap(defaultLayerMiniMap, {toggleDisplay: true}).addTo(map)._minimize(true);
		map.addControl(L.exportControl({ codeid: '?action=ajax_mapExport', position: 'topleft', endpoint: '<?=admin_url('admin-ajax.php')?>', getFormatFrom: '?action=ajax_getFormats', mapid: <?=$_POST['mid']?> }));
		
		
		jQuery('#map_canvas .leaflet-top.leaflet-left').append('<div id="sidebarhideshow" class="leaflet-control-sidebar leaflet-bar leaflet-control" style="z-index:10;">' + '<a class="leaflet-control-sidebar-button leaflet-bar-part" id="sidebar-button-reorder" href="#" onClick="return false;" title="Sidebar Toggle"><i class="fa fa-reorder"></i></a>' + '<div id="sidebar-buttons" class="sidebar-buttons" style="max-height: 300px; overflow: auto;">' + '<ul class="list-unstyled leaflet-sidebar">' + '</ul>' + '</div>' + '</div>');
		
		<?PHP if($_IS_DRAW) { ?>
		  var drawControl = new L.Control.Draw({
			draw : {        
				circle : false
			},
			edit: {
			  featureGroup: featureGroup
			}
		  }).addTo(map);
		<?PHP } ?>
		
		var data = JSON.parse("<?=$_DATA?>");
		jsonData.addData(data); 
	});
	
	var jsonData = L.geoJson(null, {

			style: function (feature) {
				return {color: "#f06eaa",  "weight": 4, "opacity": 0.5, "fillOpacity": 0.2};
			},
			onEachFeature: function (feature, layer) {
				featureGroup.addLayer(layer);
				
				layer.on("click", function(){
					if(editMode) {
						showModal("edit", layer);
						setTimeout(function(){
							map.closePopup();
						},50);
					}
					else {
						if(show_svg) {
							map.closePopup();
							if(layer instanceof L.Marker) {
								map.panTo(layer.getLatLng());
							}
							else {
								map.fitBounds(new L.featureGroup([layer]).getBounds());
							}
							setTimeout(function() {
								openPopup(layer);
							}, 300);
						}
						else {
							openPopup(layer);
						}
					}
				});            

				properties1 = feature.properties;
				var properties = new Array();
				for(var i=0; i<properties1.length; i++){
					row = {};
					row['name']  = properties1[i].name;
					row['value'] = properties1[i].value;
					row['defaultProperty'] = properties1[i].defaultProperty;
					properties.push(row);
				}
				
				layerProperties.push(new Array(layer, properties));
				
				var style = feature.style;
				var cp    = feature.customProperties;

				if(style) {
					if(layer instanceof L.Marker) {
						if(style.markerColor) {
							layer.setIcon(L.AwesomeMarkers.icon(style));
						}
					}
					else {
						layer.setStyle(style);
					}
				}

				shapeStyles.push(style); //styles is JSON Object
				shapeCustomProperties.push(cp);
				bindPopup(layer);

				renderSideBar(layer);
			}
		})

	function updateSidebar() {
		if (show_sidebar)
			$('#sidebarhideshow').show();
		else {
			$('#sidebarhideshow').hide();
		}
	}
	function updateSearch() {
		if (show_search)
			$('.leaflet-control-search').show();
		else {
			$('.leaflet-control-search').hide();
		}
	}
	function updateMeasure() {
		if (show_measure)
			$('.leaflet-control-draw-measure').show();
		else {
			$('.leaflet-control-draw-measure').hide();
		}
	}
	function updateMinimap() {
		if (show_minimap)
			$('.leaflet-control-minimap').show();
		else {
			$('.leaflet-control-minimap').hide();
		}
	}
	function updateExport() {
		if (show_export)
			$('.leaflet-control-export').show();
		else {
			$('.leaflet-control-export').hide();
		}
	}
	function updateSVG() {
		if (show_svg) {
			$("body").append('\
				<style id="svg-style">\
					path {\
						fill-opacity: .2;\
					}\
					path:hover {\
						fill-opacity: .4;\
					}\
					\
					.travelMarker {\
						fill: yellow;\
						opacity: 0.75;\
					}\
					.waypoints {\
						fill: black;\
						opacity: 0;\
					}\
					.drinks {\
						stroke: black;\
						fill: red;\
					}\
					.lineConnect {\
						fill: none;\
						stroke: black;\
						opacity: 1;\
					}\
					.locnames {\
						fill: black;\
						text-shadow: 1px 1px 1px #FFF, 3px 3px 5px #000;\
						font-weight: bold;\
						font-size: 13px;\
					}\
				</style>\
			');
		}
		else {
			$('#svg-style').remove();
		}
	}
	
	jQuery(document).ready(function($) {
		$ = jQuery;
		$('.leaflet-control-minimap .leaflet-control-sidebar').remove();
		
		$("body").append('\<style id="svg-style">path {fill-opacity: .2;}path:hover {fill-opacity: .4;}.travelMarker {fill: yellow;opacity: 0.75;}.waypoints {fill: black;opacity: 0;}.drinks {stroke: black;fill: red;}.lineConnect {fill: none;stroke: black;opacity: 1;}.locnames {fill: black;text-shadow: 1px 1px 1px #FFF, 3px 3px 5px #000;font-weight: bold;font-size: 13px;}</style>');
		setTimeout(function(){
			$("#label_show_sidebar, #label_show_sidebar ins").click(function(){
				show_sidebar = !show_sidebar;
				updateSidebar();
			});
			$("#label_show_search, #label_show_search ins").click(function(){
				show_search = !show_search;
				updateSearch();
			});
			$("#label_show_measure, #label_show_measure ins").click(function(){
				show_measure = !show_measure;
				updateMeasure();
			});
			$("#label_show_minimap, #label_show_minimap ins").click(function(){
				show_minimap = !show_minimap;
				updateMinimap();
			});
			$("#label_show_svg, #label_show_svg ins").click(function(){
				show_svg = !show_svg;
				updateSVG();
			});
			$("#label_show_export, #label_show_export ins").click(function(){
				show_export = !show_export;
				updateExport();
			});
		}, 1000);
		
		jQuery('#geo_json').click(function(){
			var type = jQuery(this).attr("data-type");
			jQuery('#mapfig_type').val(type);

			var finalShapeData = new Array();
					
			var shapes = getShapes(featureGroup);
			
			jQuery.each(shapes, function(index, shape) {
				properties = getPropertiesByLayer(shape);

				var index = getLayerIndex(shape);
				shpJson = shape.toGeoJSON();
				shpJson.properties = properties;
				shpJson.customProperties = shapeCustomProperties[index];
				shpJson.style = shapeStyles[index];
				finalShapeData.push(shpJson);
			});

			finalShapeData = JSON.stringify(finalShapeData);
			
			jQuery("#lat").val(map.getCenter().lat);
			jQuery("#lng").val(map.getCenter().lng);
			jQuery("#geo_json_str").val(finalShapeData);
			jQuery('#save_map_form').submit();       
		
		})

		jQuery('#submit_modal').click(function(){

			properties = new Array();
			var name = jQuery('#autoFillAddress').val();
			var description = tinyMCE.get('description').getContent();
			
			row = {};
			row['name']            = "Name";
			row['value']           = name;
			row['defaultProperty'] = true;
			
			properties.push(row);

			row = {};
			row['name']     = "Description";
			row['value']    = description;
			row['defaultProperty'] = true;
			
			properties.push(row);


			stl = {};
			jQuery('#menuStyle tbody tr input, #menuStyle tbody tr select').each(function(){
				name  = $(this).attr('id');
				value = $(this).val();
				
				stl[name]  = value;
			});
			
			cp = {};
			jQuery('#menuCustomProperties tbody tr input[type=checkbox]').each(function(){
				name  = $(this).attr('id');
				value = $(this).is(':checked');
				
				cp[name]  = value;
			});

			for(i=0; i<layerProperties.length; i++) {
				if(layerProperties[i][0] == currentLayer) {
					layerProperties[i][1] = properties;
					shapeStyles[i] = stl;
					shapeCustomProperties[i] = cp;
					break;
				}
			}
			bindPopup(currentLayer);
			reRenderShapeStylesOnMap(currentLayer);
			renderSideBar(currentLayer);
			jQuery('#mapfig_myModal').modal("hide");
		})   
	   
		 var animating = false;
		jQuery('#sidebar-button-reorder').click(function() {
			if (animating) return;
			var element = jQuery('#sidebar-buttons');
			animating = true;
			if (element.css('left') == '-50px') {
				element.show();
				element.animate({
					opacity: '1',
					left: '0px'
				}, 400, function() {
					animating = false;
				});
			} else {
				element.animate({
					opacity: '0',
					left: '-50px'
				}, 400, function() {
					animating = false;
					element.hide();
				});
			}
		});
	});
	
	function renderSideBar(layer) {
			target = jQuery('#sidebar-buttons ul.leaflet-sidebar');
			currentIndex = getLayerIndex(layer);
		 //   console.log(layerProperties[currentIndex]);
			lable = layerProperties[currentIndex][1][0].value;
			//alert(lable);
			if (lable == "") {
				lable = "No Location";
			}
			target.append('<li><input type="checkbox" data-index="' + currentIndex + '" onClick="changeAddressCheckbox(this)" checked><a data-index="' + currentIndex + '" onClick="clickOnSidebarAddress(this)">' + lable + '</a><div class="clear"></div></li>');
		}

		function changeAddressCheckbox(obj) {
			var layers = getLayers();
			
			index = jQuery(obj).attr("data-index");
			
			if (jQuery(obj).is(':checked')) {
				featureGroup.addLayer(layers[index]);
			} else {
				featureGroup.removeLayer(layers[index]);
			}
		}

	function clickOnSidebarAddress(obj) {
		var layers = getLayers();
		index = jQuery(obj).attr("data-index");
		setTimeout(function() {
			//openPopup(layers[index]);
			//layers[index].openPopup();
			layers[index].fire("click");
		}, 50);
	}
	</script>
	
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			layerSelector.addTo(map);
			map.addControl(L.Control.measureControl({position:'topright'}));
			jQuery('#map_canvas .leaflet-control-layers form.leaflet-control-layers-list input[type=radio]').click(function(){
				map.removeLayer(defaultLayer);
			});
			
			updateSidebar();
			updateSearch();
			updateMeasure();
			updateMinimap();
			updateExport();
			updateSVG();
		});
	</script>
	<?PHP if($_IS_DRAW) { ?>
	<script type="text/javascript">
		function layers_id_ajax(id) {
			var data = {
				'action': 'ajax_getLayer',
				'id': id
			};
			$.ajax({
				  url:     '<?=admin_url('admin-ajax.php')?>',
				  type:    'POST',
				  data:    data,
				  success: function(data){
					map.removeLayer(defaultLayer);
					data = jQuery.parseJSON(data);
					
					defaultLayer = new L.TileLayer(data.url, {'id' : data.lkey, 'token' : data.accesstoken, maxZoom: 18, attribution: data.attribution+mbAttribution});
					
					map.addLayer(defaultLayer);
				  }
			});
		}
		
		function groups_id_ajax(id) {
			var data = {
				'action': 'ajax_getLayersByGroupId',
				'id': id
			};
			$.ajax({
				  url:     '<?=admin_url('admin-ajax.php')?>',
				  type:    'POST',
				  data:    data,
				  success: function(data){
					map.removeControl(layerSelector);
					data = jQuery.parseJSON(data);
					
					baseLayers = {}
					$.each(data, function(idx, obj) {
						baseLayers[obj.name] = new L.TileLayer(obj.url, {maxZoom: 18, id: obj.lkey, token: obj.accesstoken, attribution: obj.attribution+mbAttribution});
					});
					
					layerSelector = L.control.layers(baseLayers, overlays)
					map.addControl(layerSelector);
					
					setTimeout(function(){
						$('.leaflet-control-layers form.leaflet-control-layers-list input[type=radio]').click(function(){
							map.removeLayer(defaultLayer);
						});
					},200);
				  }
			});
		}
		
		jQuery(document).ready(function($) {
			$ = jQuery;
			setTimeout(function(){
				$('.leaflet-control-layers form.leaflet-control-layers-list input[type=radio]').click(function(){
					map.removeLayer(defaultLayer);
				});
			},200);
			
			$("#layers_id").change(function(){
				layers_id_ajax($(this).val());
				return false;
			});
			
			$("#groups_id").change(function(){
				groups_id_ajax($(this).val());
				return false;
			});
			
			$("#layers_id, #groups_id").change();
		});
	</script>
	<?PHP } ?>