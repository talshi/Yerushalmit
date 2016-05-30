

(function ($) {

    var wp_mapify_app = angular.module('wp_mapify_app', ['ngRoute', 'ngAnimate']);

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
    
})(jQuery);
