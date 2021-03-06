
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

	wp_mapify_app.controller('mapCtrl', function ($scope, $http, $route) {
		
		$http({
			method: "POST",
			url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
			data: $.param({ action: 'get_neighborhood_list' }), 
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function(response) {
			$scope.neighbothood_list = response;
		}, function(error) {
			console.log(error);
		});
		
		$("#remove_all_images_button").click(function() {
		if(confirm("Are You Sure?")) {
			$http({
				method: "POST",
				url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
				data: $.param({ action: 'delete_all_neigborhood' }), 
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(response) {
				console.log(response);
				$route.reload();
			}, function(error) {
				console.log(error);
			});
		}
	});
	
	$("#remove_selected_images_button").click(function() {
		$http({
			method: "POST",
			url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
			data: $.param({ action: 'get_neighborhood_list' }),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function(response) {
			$scope.activities_image_list = response;
			var images = response;
			console.log(response);
			for(var i = 0; i < images.length; i++) {
				var id = images[i].id;
				if($("#checked" + images[i].id).is(':checked')) {
					$http({
						method: "POST",
						url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
						data: $.param({ action: 'delete_neiborhood_by_id', 
							id: id 
						}), 
						headers: {'Content-Type': 'application/x-www-form-urlencoded'}
					}).success(function(response) {
//						console.log(response);
						console.log("removed!" + id);
						$route.reload();
					}, function(error) {
						console.log(error);
					});
				}
			}
			$route.reload();
		}, function(error) {
			console.log(error);
		});
	});

		
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
					$("#preview_label").html("");
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
						$("#img_preview").attr("src","")
						$("#success").html("<div class='notice notice-success is-dismissable'>Image - Main -Saved Successfully!</div>");
						$route.reload();
					},
					error: function(error) {
						jQuery("#upload_image_main").val(' ');
						$("#img_preview").attr("src","")
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
					$("#preview_label").html("");
					$("#img_preview").attr("src", image_link);
			});
		});

		$("#save_button_neighborhood").click(function() {
			if($('#neighborhood').val().length  == 1 || $('#neighborhood').val().length  == 0 || $('#upload_image_neighborhood').val().length == 0 || jQuery("#upload_image_neighborhood").val().length == 0 || jQuery("#upload_image_neighborhood").val().length == 1 )
			{
				$('#neighborhood').val('');
				jQuery("#upload_image_neighborhood").val('');
				$("#success").html("<div class='notice notice-error is-dismissable'>ERROR: Neighborhood's Image Did Not Save!</div>");
				$("#img_preview").attr("src", '');
				alert("Please ensure you enter name and URL.");
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
					$("#img_preview").attr("src", '')
					$("#success").html("<div class='notice notice-success is-dismissable'>Neighborhood's "+ img_neighborhood +" Image Saved Successfully!</div>");
					$route.reload();
				},
				error: function(error) {
					console.log(error);
					$('#neighborhood').val('');
					jQuery("#upload_image_neighborhood").val('');
					$("#img_preview").attr("src","");
					$("#success").html("<div class='notice notice-error is-dismissable'>ERROR: Neighborhood's "+img_neighborhood +" Image Did Not Save!</div>");
				}
			});
		});

	});

	wp_mapify_app.controller('activitiesCtrl', function ($scope, $route, $http) {

		var idGlobal = 0;
		$scope.sortBy = 'name';
		$scope.activities_list = [];

		

		$scope.saveEditFunction = function() {
			var formated_date = new Date($scope.activityDateEdit).toLocaleDateString();
			$http({
				method: "POST",
				url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
				data: $.param({
					action: 'update_activities_table_by_id',
					id: idGlobal,
					name : $scope.activityNameEdit,
					date: formated_date,
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
				console.log(response);
				//display data in model window

				$scope.edit_activity = response[0];
				$scope.activityNameEdit = $scope.edit_activity.name;
				$scope.activityDateEdit = new Date($scope.edit_activity.date);
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

			// clean fields
			$scope.activityName = '';
			$scope.activityDate = '';
			$scope.activityCategory = '';
			$scope.activityDescription = '';
			$scope.selectedNeighborhood = '';
			$scope.selectedCategory = '';


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

			// add to DATA BASE
			var name = '';
			var neighborhood = '';
			var description = '';
			var categoryName = '';

			if($scope.activityName)
				name = $scope.activityName;
			else {
				alert("Insert Activity Name.");
				return false;
			}
			var date;
			if($scope.activityDate)
				date = new Date($scope.activityDate);
			else {
				alert("Insert Activity Date.");
				return false;
			}
			var formated_date = date.toLocaleDateString();
			if($scope.selectedNeighborhood.neighborhood)
				neighborhood =  $scope.selectedNeighborhood.neighborhood;
			else {
				alert("Insert Activity Neighborhood.");
				return false;
			}
			if($scope.selectedCategory.name)
				categoryName = $scope.selectedCategory.name;
			else {
				alert("Insert Activity Category.");
				return false;
			}
			description = $scope.activityDescription;
			
			$http({
				method: "POST",
				url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
				data: $.param({	
					action: 'save_activity',
					name : name,
					date : formated_date,
					description : description,
					neighborhood : neighborhood,
					//	'showOnMap' : "show",
					locationX : x,
					locationY : y,
					category : categoryName,
				}),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(response) {
				$scope.activities_list.push({ 	
					id: response[0]['id'], 
					name: name,
					date: formated_date,
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
//			$scope.activityDate = '';
			$scope.activityCategory = '';
			$scope.activityDescription = '';
			if($scope.selectedNeighborhood)
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

				var m = "<img id='" + $scope.activities_list[i] + "' class='marker'" +
				" src='/wp-content/plugins/Mapify/admin/images/map-marker-icon.png'" +
				" data-toggle='modal' data-target='#myImg' onclick='myFunction()'></img>";
				jQuery("#image-activities").after(m);

				jQuery("#" + $scope.activities_list[i]).css({
					"top": $scope.activities_list[i].x,
					"left": $scope.activities_list[i].y
				});
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
						}, function(error) {
							console.log(error);
						});
					}
				}
				$route.reload();
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
					$route.reload();
				}, function(error) {
					console.log(error);
				});
			}
		});
	});

	wp_mapify_app.controller('imagesCtrl', function ($scope, $http, $route) {

		$http({
			method: "POST",
			url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
			data: $.param({ action: 'get_activity_list' }),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function(response) {
			$scope.activity_list = response;
//			console.log(response);
		}, function(error) {
			console.log(error);
		});
		
		$http({
			method: "POST",
			url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
			data: $.param({ action: 'get_activities_images' }),
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
		}).success(function(response) {
			$scope.images_list = response;
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
				$("#preview_label").html("");
				$("#img_preview").attr("src", image_link);
			});
		});

		$("#remove_all_images_button").click(function() {
			if(confirm("Are You Sure?")) {
				$http({
					method: "POST",
					url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
					data: $.param({ action: 'delete_all_images' }), 
					headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				}).success(function(response) {
					$route.reload();
				}, function(error) {
					console.log(error);
				});
			}
		});
		
		$("#remove_selected_images_button").click(function() {
			$http({
				method: "POST",
				url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
				data: $.param({ action: 'get_activities_images' }),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(response) {
				$scope.activities_image_list = response;
				var images = response;
				for(var i = 0; i < images.length; i++) {
					var id = images[i].id;
					if($("#checked" + images[i].id).is(':checked')) {
						$http({
							method: "POST",
							url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
							data: $.param({ action: 'delete_image_by_id', 
								id: id 
							}), 
							headers: {'Content-Type': 'application/x-www-form-urlencoded'}
						}).success(function(response) {
							console.log("removed!" + id);
							$route.reload();
						}, function(error) {
							console.log(error);
						});
					}
				}
				$route.reload();
			}, function(error) {
				console.log(error);
			});
		});
		
		$("#save_button_upload").click(function() {

			if($scope.selectedActivity == undefined){
				$("#success_image").html("<div class='notice notice-error is-dismissable'>ERROR: Choose Neighborhood Before Clicking Save.<br>Image Activity Did Not Saved!</div>");
				$('#upload_image_neighborhood').val('');
				return;
			}

			if($('#upload_image_neighborhood').val().length == 0 )
			{
				$("#success_image").html("<div class='notice notice-error is-dismissable'>ERROR: Fill URL Before Clicking Save.br Image Did Not Saved!</div>");
				return;
			}

			var img_url = jQuery("#upload_image_neighborhood").val();
			var activity_name = $scope.selectedActivity.name;

			$.ajax({
				url: "../wp-content/plugins/Mapify/DB/save-activity-image.php",
				type: "POST",
				dataType: "json",
				data: {
					'activity_name' : activity_name,
					'img_url': img_url
				},
				success: function(data) {
					$("#success_image").html("<div class='notice notice-success is-dismissable'>Image for "+ activity_name.name + " activity Saved Successfully! </div>");
					$route.reload();
				},
				error: function(error) {
					$("#success_image").html("<div class='notice notice-error is-dismissable'>ERROR: Image Activity Did Not Saved!</div>");
				}
			});
			$scope.$apply();
		});
	});

	wp_mapify_app.controller('categoriesCtrl', function ($scope, $http, $route) {

		$scope.sortBy = 'name';

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

		jQuery("#IDdeleteAllCategory").click(function(e){
			if(confirm("Are You Sure?")) {
				$http({
					method: "POST",
					url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
					data: $.param({ action: 'delete_all_categories' }), 
					headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				}).success(function(response) {
					$route.reload();
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
//			var URL = $scope.CategoryURL; // TODO bug ng-model does not work
			var URL = $("#upload_image_category").val(); 
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
					$route.reload();
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

		$("#IDdeleteSelectedCategory").click(function() {
			$http({
				method: "POST",
				url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
				data: $.param({ action: 'get_category_list' }),
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).success(function(response) {
				$scope.categories_list = response;
				var categories = response;
				for(var i = 0; i < categories.length; i++) {
					var id = categories[i].id;
					if($("#categorychecked" + categories[i].id).is(':checked')) {
						$http({
							method: "POST",
							url: "../wp-content/plugins/Mapify/DB/DB_functions.php",
							data: $.param({ action: 'delete_category_by_id', id: id }), 
							headers: {'Content-Type': 'application/x-www-form-urlencoded'}
						}).success(function(response) {
							console.log("removed!" + id);
						}, function(error) {
							console.log(error);
						});
					}
				}
				$route.reload();
			}, function(error) {
				console.log(error);
			});

		});

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


