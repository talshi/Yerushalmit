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
                               { id: '1', name: 'A', date: '1/12/2008', description: 'blablabla'},
                               { id: '2', name: 'B', date: '21/12/2009', description: 'blablabla2'},
                               { id: '3', name: 'C', date: '12/12/2010', description: 'blablabla3'},
                               { id: '4', name: 'D', date: '13/12/2010', description: 'blablabla3'},
                               { id: '5', name: 'E', date: '12/11/2010', description: 'blablabla3'},
                               { id: '6', name: 'F', date: '13/12/2010', description: 'blablabla3'},                              
                               { id: '7', name: 'G', date: '12/12/1996', description: 'blablabla3'}
                               ];
    	
    	$scope.addActivity = function(id, name, date, desc) {
    		$scope.activities_list.push({ id: id, name: name, date: date, description: desc});
    		alert("Item added!");
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

    /*
     * END CONTROLLERS
     */
    
    /*
     * MAPIFY-ACTIVITIES-DISPLAY SCRIPTS
     */
    
    // This code will recognize a click on the image and load the exact coordinates


    /*
     * END MAPIFY-ACTIVITIES-DISPLAY SCRIPTS
     */

    /*
     * TEST ZONE
     */
    
    
    /*
     * END TEST ZONE
     */
    
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
