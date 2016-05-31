
(function ($) {
	
    var wp_mapify_app = angular.module('wp_mapify_app', ['ngRoute', 'ngAnimate']);
//Global 
var x = 0;
var y = 0;
var index = 0;


(function ($) {

	var wp_mapify_app = angular.module('wp_mapify_app', ['ngRoute']);

	/*
    v * ROUTING CONFIGURATIONS
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
    
    wp_mapify_app.controller('adminCtrl', function($scope, $location) {
        $scope.isActive = function (viewLocation) { 
            return viewLocation === $location.path();
        };
    });
    
    wp_mapify_app.controller('mapCtrl', function ($scope) {
        
    });
    
    wp_mapify_app.controller('activitiesCtrl', function ($scope) {
    	$scope.sortBy = 'name';
    	
    	$scope.activities_list = [
                               { id: '1', name: 'A', date: '1/12/2008',category:'A', description: 'blablabla'},
                               { id: '2', name: 'B', date: '21/12/2009',category:'B', description: 'blablabla2'},
                               { id: '3', name: 'C', date: '12/12/2010',category:'D', description: 'blablabla3'},
                               { id: '4', name: 'D', date: '13/12/2010',category:'C', description: 'blablabla3'},
                               { id: '5', name: 'E', date: '12/11/2010',category:'G', description: 'blablabla3'},
                               { id: '6', name: 'F', date: '13/12/2010',category:'E', description: 'blablabla3'},                              
                               { id: '7', name: 'G', date: '12/12/1996',category:'F', description: 'blablabla3'}
                               ];
    	$scope.categories_list = [
                                  { name: 'Berale', description: 'category1'},
                                  { name: 'BeraleBerale', description: 'category2'},
                                  { name: 'CCCCCCCCCCCCCC', description: 'category3'},
                                  { name: 'E', description: 'category4'},
                                  { name: 'D', description: 'category5'},
                                  { name: 'F', description: 'category6'},
                                  { name: 'G', description: 'category7'},
                                  { name: 'H', description: 'category8'}
                                  ];
     	
    	$scope.addActivity = function() {
    		
    		if($scope.activityName == undefined)
    		{
    			alert("Insert Activity Name");
    			return false;
    		}
    		if($scope.activityDate == undefined)
    		{
    			alert("Insert Activity Date");
    			return false;    			
    		}
//    		if($scope.activityCategory == undefined)
//    		{
//    			alert("Insert Activity Category");
//    			return false;    			
//    		}
       		
    		$scope.activities_list.push({ id: '0', name: $scope.activityName, date: $scope.activityDate, category: $scope.activityCategory ,description: $scope.activityDescription });
    		$scope.activityName = ' ';
    		$scope.activityDate = ' ';
    		$scope.activityCategory = ' ';
    		$scope.activityDescription = ' ';
    		$scope.$apply();
    		return true;
    	}    	
    });

    wp_mapify_app.controller('categoriesCtrl', function ($scope) {
    	$scope.sortBy = 'name';
    	$scope.categories_list = [
                                  { name: 'A', description: 'category1'},
                                  { name: 'B', description: 'category2'},
                                  { name: 'C', description: 'category3'},
                                  { name: 'E', description: 'category4'},
                                  { name: 'D', description: 'category5'},
                                  { name: 'F', description: 'category6'},
                                  { name: 'G', description: 'category7'},
                                  { name: 'H', description: 'category8'}
                                  ];
    	
    	$scope.addCategory = function(){
    		
    		alert($scope.CategoryName);
    		
    		if($scope.CategoryName == undefined)
    		{
    			alert("Insert Category Name");
    			return false;
    		}
    		
    		$scope.categories_list.push({ id: '0', name: $scope.CategoryName,description: $scope.CategoryDescription });
    		$scope.CategoryName = ' ';
       		$scope.CategoryDescription = ' ';
    		$scope.$apply();

    		return true;    			
    	};
    });
    
    wp_mapify_app.controller('previewCtrl', function ($scope) {
    	
    });
})(jQuery);

	wp_mapify_app.controller('activitiesCtrl', function ($scope) {
		$scope.sortBy = 'name';

		
		$scope.activities_list = [
		                          { id: '1', name: 'A', date: '1/12/2008',category:'A',neighborhood: 'p',  description: 'blablabla',x:'0',y:'0'},
		                          { id: '2', name: 'B', date: '21/12/2009',category:'B',neighborhood: 'p', description: 'blablabla2',x:'20',y:'20'},
		                          { id: '3', name: 'C', date: '12/12/2010',category:'D',neighborhood: 'p', description: 'blablabla3',x:'30',y:'30'},
		                          { id: '4', name: 'D', date: '13/12/2010',category:'C',neighborhood: 'p', description: 'blablabla3',x:'40',y:'40'},
		                          { id: '5', name: 'E', date: '12/11/2010',category:'G',neighborhood: 'p', description: 'blablabla3',x:'50',y:'50'},
		                          { id: '6', name: 'F', date: '13/12/2010',category:'E',neighborhood: 'p', description: 'blablabla3',x:'60',y:'60'},                              
{ id: '7', name: 'G', date: '12/12/1996',category:'F',neighborhood: 'p', description: 'blablabla3',x:'80',y:'80'}
		                          ];


		$scope.categories_list = [
		                          { name: 'Berale', description: 'category1'},
		                          { name: 'BeraleBerale', description: 'category2'},
		                          { name: 'CCCCCCCCCCCCCC', description: 'category3'},
		                          { name: 'E', description: 'category4'},
		                          { name: 'D', description: 'category5'},
		                          { name: 'F', description: 'category6'},
		                          { name: 'G', description: 'category7'},
		                          { name: 'H', description: 'category8'}
		                          ];



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
			//    		if($scope.activityName == ' ')
//			{
//			alert("Insert Activity Name");
//			return false;
//			}
//			if($scope.activityDate == ' ')
//			{
//			alert("Insert Activity Date");
//			return false;    			
//			}
//			if($scope.activityCategory == ' ')
//			{
//			alert("Insert Activity Category");
//			return false;    			
//			}
//			if($scope.neighborhood == ' ')
//			{
//			alert("Error: Insert Neighbrhood");
//			return false;
//			}

			
			$scope.activities_list.push({ id: '0', name: $scope.activityName, date: $scope.activityDate, neighborhood: $scope.neighborhood, category: $scope.activityCategory ,description: $scope.activityDescription });

			$scope.activityName = ' ';
			$scope.activityDate = ' ';
			$scope.activityCategory = ' ';
			$scope.activityDescription = ' ';
			$scope.neighborhood = ' ';

			//$scope.$apply();
		
			var m = "<img id='img-marker" + index + "' class='marker' src='/wp-content/plugins/Mapify/admin/images/map-marker-icon.png' data-toggle='modal' data-target='#myImg'></img>";
			jQuery("#image-activities").after(m);

			// add activity to table

			// --
			var point = getFinishPoint(x,y); // return the fix X & Y after validation
			
			var newX = (point.x * 100) / point.w;
			var newY = (point.y * 100) / point.h;
			
			alert(newX);
			if(newX > 95)
				newX = 95;
			
			if(newY > 93)
				newY = 95;
				
			jQuery("#img-marker" + index).css({
				"top": newY + '%',
				"left": newX + '%'
			});
			index++;
		};

		$scope.initActivities = function(){
			
			for(var i = 0 ; i < $scope.activities_list.length ; i++)
			{
				
				var m = "<img id='img-marker" + index + "' class='marker' src='/wp-content/plugins/Mapify/admin/images/map-marker-icon.png' data-toggle='modal' data-target='#myImg'></img>";
				jQuery("#image-activities").after(m);

				
				jQuery("#img-marker" + index).css({
					"top": $scope.activities_list[i].y + '%',
					"left": $scope.activities_list[i].x + '%'
				});
				
			}	
		}
		
		jQuery(window).resize(function(){

			for(var i = 0 ; i < $scope.activities_list.length ; i++)
			{
			//		x = (clickX * 100) / jQuery("#image-activities").width();
			//		y = (clickY * 100) / jQuery("#image-activities").height();
				
				//console.log($scope.activities_list[i].x);
				//console.log($scope.activities_list[i].y);
				
				var m = "<img id='img-marker" + index + "' class='marker' src='/wp-content/plugins/Mapify/admin/images/map-marker-icon.png' data-toggle='modal' data-target='#myImg'></img>";
				jQuery("#image-activities").after(m);

				
				jQuery("#img-marker" + index).css({
					"top": $scope.activities_list[i].x,
					"left": $scope.activities_list[i].y
				});
				
			}	

		});
	});

	wp_mapify_app.controller('categoriesCtrl', function ($scope) {
		$scope.sortBy = 'name';
		$scope.categories_list = [
		                          { name: 'A', description: 'category1'},
		                          { name: 'B', description: 'category2'},
		                          { name: 'C', description: 'category3'},
		                          { name: 'E', description: 'category4'},
		                          { name: 'D', description: 'category5'},
		                          { name: 'F', description: 'category6'},
		                          { name: 'G', description: 'category7'},
		                          { name: 'H', description: 'category8'}
		                          ];

		$scope.addCategory = function(){

			alert($scope.CategoryName);
			if($scope.CategoryName == undefined)
			{
				alert("Insert Category Name");
				return false;
			}

			$scope.categories_list.push({ id: '0', name: $scope.CategoryName,description: $scope.CategoryDescription });
			$scope.CategoryName = ' ';
			$scope.CategoryDescription = ' ';
			$scope.$apply();

			// need to insert data to DB - > COORDS!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

			return true;    			
		};
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
