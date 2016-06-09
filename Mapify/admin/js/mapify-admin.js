
(function ($) {

	var wp_mapify_app = angular.module('wp_mapify_app', ['ngRoute']);

	//	Global 
	var x = 0;
	var y = 0;

	(function ($) {

		/*
		 * ROUTING CONFIGURATIONS
		 */

		wp_mapify_app.config(function ($routeProvider) {
			$routeProvider
			.when('/map', {
				templateUrl: '/wp-content/plugins/Mapify/admin/partials/mapify-map-display.php',
				controller: 'mapCtrl',
				controllerAs: 'map'
			})
			.when('/activities', {
				templateUrl: '/wp-content/plugins/Mapify/admin/partials/mapify-activities-display.php',
				controller: 'activitiesCtrl',
				controllerAs: 'activities'
			})
			.when('/images', {
				templateUrl: '/wp-content/plugins/Mapify/admin/partials/mapify-images-display.php',
				controller: 'imagesCtrl',
				controllerAs: 'images'
			})
			.when('/categories', {
				templateUrl: '/wp-content/plugins/Mapify/admin/partials/mapify-categories-display.php',
				controller: 'categoriesCtrl',
				controllerAs: 'categories'
			})
			.when('/preview', {
				templateUrl: '/wp-content/plugins/Mapify/admin/partials/mapify-preview-display.php',
				controller: 'previewCtrl',
				controllerAs: 'preview'
			})
			.when('/publish', {
				templateUrl: '/wp-content/plugins/Mapify/admin/partials/mapify-publish-display.php',
				controller: 'publishCtrl',
				controllerAs: 'publish'
			})
			.otherwise({
				redirectTo: '/map'
			});
		});

		/*
		 * END ROUTING CONFIGURATIONS
		 */

		/*
		 * CONTROLLERS
		 */

	})(jQuery);

	wp_mapify_app.controller('adminCtrl', function($scope, $location, $window) {
		$scope.isActive = function (viewLocation) { 
			return viewLocation === $location.path();
		};
	});

	wp_mapify_app.controller('mapCtrl', function ($scope) {
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

				if( $('#upload_image_main').val().length < 2 || $('#upload_image_main').val() == undefined)
				{
					jQuery("#upload_image_main").val(' ');
					$("#success").html("<div class='notice notice-error is-dismissable'>ERROR: Image - Main - Did Not Save!</div>");
					return;
				}
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
						jQuery("#upload_image_main").val(' ');
						$("#success").html("<div class='notice notice-success is-dismissable'>Image - Main -Saved Successfully!</div>");

					},
					error: function(error) {
						jQuery("#upload_image_main").val(' ');
						$("#success").html("<div class='notice notice-error is-dismissable'>ERROR: Image - Main - Did Not Save!</div>");
					}
				});
			});
		});

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
			if($('#neighborhood').val().length  == 1 || $('#neighborhood').val().length  == 0 || $('#upload_image_neighborhood').val().length == 0 || jQuery("#upload_image_neighborhood").val().length == 0 || jQuery("#upload_image_neighborhood").val().length == 1 )
			{
				$('#neighborhood').val(' ');
				jQuery("#upload_image_neighborhood").val(' ');
				$("#success-neghborhood").html("<div class='notice notice-error is-dismissable'>ERROR: Neighborhood's Image Did Not Save!</div>");
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
					$('#neighborhood').val('');
					jQuery("#upload_image_neighborhood").val('');
					$("#success-neghborhood").html("<div class='notice notice-success is-dismissable'>Neighborhood's "+ img_neighborhood +" Image Saved Successfully!</div>");
				},
				error: function(error) {
					$('#neighborhood').val('');
					jQuery("#upload_image_neighborhood").val('');
					$("#success-neghborhood").html("<div class='notice notice-error is-dismissable'>ERROR: Neighborhood's "+img_neighborhood +" Image Did Not Save!</div>");
				}
			});
		});

	});

	wp_mapify_app.controller('activitiesCtrl', function ($scope, $route, $http) {

		var idGlobal = 0;
		$scope.sortBy = 'name';
		$scope.activities_list = [];

		$scope.saveEditFunction = function() {
			$http({
				method: "POST",
				url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
				data: $.param({
					action: 'update_activities_table_by_id',
					id: idGlobal,
					name : $scope.activityNameEdit,
					date: $scope.activityDateEdit,
					description: $scope.activityDesEdit,
					neighborhood: $scope.selectedNeighborhood.neighborhood,
					category : $scope.selectedCategory.name
				}),

				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(response) {
				$route.reload();
			}, function(error) {
				console.log(error);
			});
		}

		$scope.editFunction = function(id) {	

			idGlobal = id;

			$http({
				method: "POST",
				url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
				data: $.param({
					action: 'get_activity_list_by_id',
					id: id
				}),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(response) {

				//display data in model window

				$scope.edit_activity = response[0];
				$scope.activityNameEdit = $scope.edit_activity.name;
				$scope.activityDateEdit = $scope.edit_activity.date;
				$scope.activityDesEdit  = $scope.edit_activity.description;

				for(var i = 0; i < $scope.neighborhood_list.length ; i++){
					console.log($scope.edit_activity.neighborhood +"--"+$scope.neighborhood_list[i].neighborhood);
					if($scope.edit_activity.neighborhood.localeCompare($scope.neighborhood_list[i].neighborhood) == 0){
						console.log("FINISH1");
						break;
					}
				}

				$scope.selectedNeighborhood = $scope.neighborhood_list[i];

				for(var i = 0; i < $scope.categories_list.length ; i++){
					console.log($scope.edit_activity.category +"--"+$scope.categories_list[i].name);
					if($scope.edit_activity.category.localeCompare($scope.categories_list[i].name) == 0)
					{
						console.log("FINISH2");
						break;
					}
				}
				$scope.selectedCategory = $scope.categories_list[i];

			}, function(error) {
				console.log(error);
			});
		}

		$http({
			method: "POST",
			url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
			data: $.param({	action: 'get_main_map_url' }),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function(response) {
			$scope.img_url = response[0]['url'];
		}), function(error) {
			console.log(error);
		};

		$http({
			method: "POST",
			url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
			data: $.param({ action: 'get_activity_list' }),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function(response) {
			$scope.activities_list = response;
		}, function(error) {
			console.log(error);
		});


		$http({
			method: "POST",
			url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
			data: $.param({ action: 'get_category_list' }), 
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function(response) {
			$scope.categories_list = response; 
		}, function(error) {
			console.log(error);
		});



		$http({
			method: "POST",
			url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
			data: $.param({ action: 'get_neighborhoods' }), 
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function(response) {
			$scope.neighborhood_list = response;
		}, function(error) {
			console.log(error);
		});


		$scope.createCoords = function(event) {

			var r = document.getElementById("image-activities").getBoundingClientRect();

			var pageCoords_left = r.left;
			var pageCoords_top = r.top;

			var clickX = event.offsetX;
			var clickY = event.offsetY;


			console.log("Click x : " + clickX +" clickY :"+ clickY );
			console.log(jQuery("#image-activities").width() + " " + jQuery("#image-activities").height());


			x = (clickX * 100) / jQuery("#image-activities").width();
			y = (clickY * 100) / jQuery("#image-activities").height();


			jQuery("#locationX").html(x);
			jQuery("#locationY").html(y);

			$scope.locationX = x;
			$scope.locationY = y;

		}

		$scope.addActivity = function(event) {							
			// TODO validation of forms
//			if($scope.activityName == undefined)
//			{
//			alert("Insert Activity Name");
//			return false;
//			}
//			if($scope.activityDate == undefined)
//			{
//			alert("Insert Activity Date");
//			return false;    			

//			}
//			if($scope.activityCategory == ' ')
//			{
//			alert("Insert Activity Category");
//			return false;    			
//			}
//			if($scope.neighborhood == undefined)
//			{
//			alert("Error: Insert Neighbrhood");
//			return false;
//			}
//			if($scope.activityDescription == undefined)
//			{
//			alert("Error: Insert Neighbrhood");
//			return false;
//			}

			// add to DATA BASE

			var name = $scope.activityName;
			var date = $scope.activityDate;
			var neighborhood =  $scope.selectedNeighborhood.neighborhood;
			var description = $scope.activityDescription;
			var categoryName = $scope.selectedCategory.name;
			$http({
				method: "POST",
				url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
				data: $.param({	
					action: 'save_activity',
					name : name,
					date : date,
					description : description,
					neighborhood : neighborhood,
					//	'showOnMap' : "show",
					locationX : x,
					locationY : y,
					category : categoryName,
				}),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(response) {
				//console.log(response);
				//$scope.img_url = response[0]['url'];

				$scope.activities_list.push({ 	
					id: response[0]['id'], 
					name: name,
					date: date,
					neighborhood: neighborhood,
					category: categoryName,
					description: description });
				$route.reload();
				// add new marker on map
//				var m = "<img id=" + response[0]['id'] + " class='marker' src='/wp-content/plugins/Mapify/admin/images/map-marker-icon.png' data-toggle='modal' data-target='#myImg' ng-click='editFunction(" + response[0]['id'] + ")'></img>";
//				jQuery("#image-activities").after(m);

//				var point = getFinishPoint(x,y); // return the fix X & Y after validation

//				var newX = (point.x * 100) / point.w;
//				var newY = (point.y * 100) / point.h;

//				if(newX > 95)
//				newX = 95;

//				if(newY > 93)
//				newY = 95;

//				jQuery("#" + response[0]['id']).css({
//				"top": newY + '%',
//				"left": newX + '%'
//				});
			}), function(error) {
				console.log(error);
			};

//			$.ajax({
//			url: "../wp-content/plugins/Mapify/DB/save-activity.php",
//			type: "POST",
//			data: {
//			'name' : name,
//			'date' : date,
//			'description' : description,
//			'neighborhood' : neighborhood,
//			//	'showOnMap' : "show",
//			'locationX' : x,
//			'locationY' : y,
//			'category' : categoryName,
//			},
//			success: function(data) {
//			console.log(data[0]['id']); 
//			// after saving activity, add activity to html
//			/*
//			$scope.activities_list.push({ 	
//			id: data[0].id, //***
//			name: $scope.activityName,
//			date: $scope.activityDate,
//			neighborhood: $scope.selectedNeighborhood.neighborhood,
//			category: $scope.selectedCategory.name,
//			description: $scope.activityDescription });
//			*/

//			},
//			error: function(error) {
//			console.log(error);
//			}
//			});
//			$scope.activities_list.push({ 	
//			id: idGlobal, //***
//			name: $scope.activityName,
//			date: $scope.activityDate,
//			neighborhood: $scope.selectedNeighborhood.neighborhood,
//			category: $scope.selectedCategory.name,
//			description: $scope.activityDescription });

			$scope.activityName = '';
			$scope.activityDate = '';
			$scope.activityCategory = '';
			$scope.activityDescription = '';
			$scope.selectedNeighborhood.neighborhood = '';

//			// add marker on map
//			var m = "<img id='img-marker" + index + "' class='marker' src='/wp-content/plugins/Mapify/admin/images/map-marker-icon.png' data-toggle='modal' data-target='#myImg'></img>";
//			jQuery("#image-activities").after(m);

			// add activity to table

			// --



		};

//		$scope.initActivities = function(activities){

//		for(var i = 0 ; i < activities.length ; i++)
//		{
////		var func = "editFunction(" + activities[i]['id'] + ")";

//		var m = "<img id=" + activities[i]['id'] + " class='marker'" +
//		" src='/wp-content/plugins/Mapify/admin/images/map-marker-icon.png'" +
//		" data-toggle='modal' " +
//		"data-target='#myImg'></img>";
//		jQuery("#image-activities").after(m);

//		jQuery("#" + activities[i]['id']).css({
//		"top": activities[i].locationY + '%',
//		"left": activities[i].locationX + '%'
//		});

//		}
//		}

		jQuery(window).resize(function(){

			for(var i = 0 ; i < $scope.activities_list.length ; i++)
			{
				//		x = (clickX * 100) / jQuery("#image-activities").width();
				//		y = (clickY * 100) / jQuery("#image-activities").height();

				//console.log($scope.activities_list[i].x);
				//console.log($scope.activities_list[i].y);

//				var m = "<img id='img-marker" + index + "' class='marker'" +
//				" src='/wp-content/plugins/Mapify/admin/images/map-marker-icon.png'" +
//				" data-toggle='modal' data-target='#myImg'></img>";
//				jQuery("#image-activities").after(m);


//				jQuery("#img-marker" + index).css({
//				"top": $scope.activities_list[i].x,
//				"left": $scope.activities_list[i].y
//				});

			}	
		});

		$("#remove_selected_button").click(function() {
			$http({
				method: "POST",
				url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
				data: $.param({ action: 'get_activity_list' }),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(response) {
				$scope.activities_list = response;
				var activities = response;
				for(var i = 0; i < activities.length; i++) {
					var id = activities[i].id;
					console.log(id);
//					console.log($("#checked" + activities[0].id));
					if($("#checked" + activities[i].id).is(':checked')) {

						$http({
							method: "POST",
							url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
							data: $.param({ action: 'delete_activity_by_id', 
								id: id 
							}), 
							headers: {'Content-Type': 'application/x-www-form-urlencoded'}
						}).success(function(response) {
							console.log("removed!" + id);
//							console.log("activity" + activities[i].id + "removed");
						}, function(error) {
							console.log(error);
						});
					}
				}
			}, function(error) {
				console.log(error);
			});


		});

		$("#remove_all_button").click(function() {
			if(confirm("Are You Sure?")) {
				$http({
					method: "POST",
					url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
					data: $.param({ action: 'delete_all_activities' }), 
					headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				}).success(function(response) {
					alert("all activities deleted!");
				}, function(error) {
					console.log(error);
				});
			}
		});
	});

	wp_mapify_app.controller('imagesCtrl', function ($scope, $http) {

		$http({
			method: "POST",
			url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
			data: $.param({ action: 'get_activity_list' }),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function(response) {
			$scope.activity_list = response;
			console.log(response);
		}, function(error) {
			console.log(error);
		});


		$("#upload_image_button_neighborhood").click(function (e) {
			e.preventDefault();
			var image = wp.media({
				title: 'Upload Image',
				multiple: false
			}).open()
			.on('select', function (e) {
				var uploaded_image = image.state().get('selection').first();
				var image_url = uploaded_image.toJSON().url;
				$('#upload_image_neighborhood').val(image_url)
				var image_link = $('#upload_image_neighborhood').val();
				$("#preview_label").html("Preview:");
				$("#img_preview").attr("src", image_link);
			});
		});


		$("#save_button_upload").click(function() {

			if($scope.selectedNeighborhood.neighborhood == undefined || $scope.selectedNeighborhood.neighborhood.length == 0){
				$("#success_image").html("<div class='notice notice-error is-dismissable'>ERROR: Choose Neighborhood Before Clicking Save.<br>Image Activity Did Not Saved!</div>");
				$scope.selectedNeighborhood = ' ';	
				$('#upload_image_neighborhood').val(' ');
				return;
			}
			if($('#upload_image_neighborhood').val().length == 0 )
			{
				$scope.selectedNeighborhood = ' ';	
				$('#upload_image_neighborhood').val(' ');
				$("#success_image").html("<div class='notice notice-error is-dismissable'>ERROR: Fill URL Before Clicking Save.br Image Did Not Saved!</div>");
				return;
			}

			img_url = jQuery("#upload_image_neighborhood").val();
			alert("SSSSSS");
			var activity_name = "XXX";
			$.ajax({
				url: "../wp-content/plugins/Mapify/DB/save-activity-image.php",
				type: "POST",
				dataType: "json",
				data: {
					'activity_name' : activity_name,
					'img_url': img_url
				},
				success: function(data) {
					//console.log(data);
					$("#success_image").html("<div class='notice notice-success is-dismissable'>Image To "+ $scope.selectedNeighborhood.neighborhood + " neighborhood Saved Successfully!</div>");
				},
				error: function(error) {
					$("#success_image").html("<div class='notice notice-error is-dismissable'>ERROR: Image Image Activity Did Not Saved!</div>");
				}
			});
		});
	});

	wp_mapify_app.controller('categoriesCtrl', function ($scope, $http) {
//		jQuery(document).ready(function ($) {
//		$("#upload_image_button_category").click(function (e) {
//		e.preventDefault();
//		var image = wp.media({
//		title: 'Upload Image',
//		multiple: false
//		}).open()
//		.on('select', function (e) {
//		// This will return the selected image from the Media Uploader, the result is an object
//		var uploaded_image = image.state().get('selection').first();
//		// We convert uploaded_image to a JSON object to make accessing it easier
//		// Output to the console uploaded_image
//		//console.log(uploaded_image);
//		var image_url = uploaded_image.toJSON().url;
//		// Let's assign the url value to the input field
//		$('#upload_image_category').val(image_url)
//		var image_link = $('#upload_image_category').val();
//		});
//		});
//		});

		$scope.sortBy = 'name';

		$http({
			method: "POST",
			url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
			data: $.param({ action: 'get_category_list' }), 
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function(response) {
			$scope.categories_list = response; //??
		}, function(error) {
			console.log(error);
		});


		jQuery("#IDdeleteSelectedCategory").click(function(e){
			alert("remove selected function");
		});		

		jQuery("#IDdeleteAllCategory").click(function(e){
			if(confirm("Are You Sure?")) {
				$http({
					method: "POST",
					url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
					data: $.param({ action: 'delete_all_categories' }), 
					headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				}).success(function(response) {
					alert("All Categories Deleted!");
				}, function(error) {
					console.log(error);
				});
			}
		});		


		jQuery("#upload_image_button_category").click(function (e) {
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
				$('#upload_image_category').val(image_url)
				var image_link = $('#upload_image_category').val();
				//   $("#preview_label").html("Preview:");
				//  $("#img_preview").attr("src", image_link);
			});
		});		

		$scope.addCategory = function(){

			var id = ""; // last DB id
			var name = $scope.CategoryName;
			var description = $scope.CategoryDescription;
//			var URL = $scope.CategoryURL;
			var URL = $("#upload_image_category").val(); // TODO bug ng-model does not work
			console.log(URL);
			if($scope.CategoryName == undefined || $scope.CategoryName.length < 2)
			{
				$("#success").html("<div class='notice notice-error is-dismissable'>ERROR: Category Did Not Save! <br>\tFill Name Category</div>");
				$scope.CategoryName = '';
				$scope.CategoryDescription = '';
				$scope.CategoryURL = '';
				$("#upload_image_category").val('');
				return false;
			}

			if(description == undefined || description.length < 2) {
				desctiption = "null";
			}

			if(URL == undefined || URL.length < 2)  {
				$("#success").html("<div class='notice notice-error is-dismissable'>ERROR: Category Did Not Save!<br>Add Image Category</div>");
				$scope.CategoryName = '';
				$scope.CategoryDescription = '';
				$scope.CategoryURL = '';
				$("#upload_image_category").val('');
				return;
			}

			$.ajax({
				url: "../wp-content/plugins/Mapify/DB/save-category.php",
				type: "POST",
				data: {
					'logoUrl': URL,
					'name': name,
					'description': description
				},
				success: function(data) {
					$("#success").html("<div class='notice notice-success is-dismissable'>Category Saved Successfully!</div>");
				},
				error: function(error) {			
					$("#success").html("<div class='notice notice-error is-dismissable'>ERROR: Category Did Not Save!</div>");
				}
			});

			$scope.categories_list.push({ id: '0', name: name, description: description, url: URL });
			$scope.CategoryName = ''; 
			$scope.CategoryDescription = '';
			$("#upload_image_category").val('');
		};
	});

	wp_mapify_app.controller('previewCtrl', function ($scope) {

	});

	wp_mapify_app.controller('publishCtrl', function ($scope) {

	});


})(jQuery);

function getFinishPoint(x,y){
	var div = document.getElementById("image-activities");
	var rect = div.getBoundingClientRect();

	var x_left = rect.left;
	var y_top = rect.top;
	var w_ = rect.right - rect.left;
	var h_ = rect.bottom - rect.top;

	var x_finish;
	var y_finish;

	if( (y/100)*h_ < 25 )  // keep the marker in map from top!!
		y_finish = ((100)*(25))/(h_);			
	else
		y_finish = (y / 100) * h_ - (25);		

	if( (x/100)*w_ < 12.5 )  // keep the marker in map from left!!
	{	
		x_finish = ((100)*(12.5))/(w_);
	}
	else if ((w_ - (x*w_)/100 < 12.5)) // keep the marker in map from right!!
	{					
		x_finish = w_ - 25;
	}	
	else{
		x_finish = (x / 100) * w_  - 12.5;
	}	

	return {x: x_finish, y:y_finish , w:w_ , h:h_};
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////


