

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
     	
    	$scope.addActivity = function() {
    		
    		if($scope.activityName == undefined)
    		{
    			alert("Insert Activity Name");
    			return;
    		}
    		if($scope.activityDate == undefined)
    		{
    			alert("Insert Activity Date");
    			return;    			
    		}
    		if($scope.activityCategory == undefined)
    		{
    			alert("Insert Activity Category");
    			return;    			
    		}
       		
    		$scope.activities_list.push({ id: '0', name: $scope.activityName, date: $scope.activityDate, category: $scope.activityCategory ,description: $scope.activityDescription });
    		
    		alert($scope.activityName);
    		$scope.$apply();
    	}
    	
    });

    wp_mapify_app.controller('categoriesCtrl', function ($scope) {
    	$scope.categories_list = [
                                  { name: '1', description: 'category1', tag: 'bla'},
                                  { name: '2', description: 'category2', tag: 'blabla'},
                                  { name: '3', description: 'category3', tag: 'blablabla'}
                                  ];
    });
    
})(jQuery);


function sort(kind){
	if(kind == 0)
	{
		alert("activity-name - sort");
		var list = getActivitiyList();
	}
	if(kind == 1)
	{
		alert("id - sort");
	}
		
}