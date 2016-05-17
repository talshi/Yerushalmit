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
    
    wp_mapify_app.controller('mapCtrl', function ($scope, $http) {
        $scope.on_submit = function() {
        	var img_url = jQuery("#upload_image").val();
        	$http({
        		method: 'POST',
        		url: 'core.php',
        		data: {
        			img: img_url
        		},
        		headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        	}).success(function() {
        		console.log("data sent successfully!");
        	});
        };
    });

    wp_mapify_app.controller('activitiesCtrl', function ($scope) {
    	$scope.activities_list = [
                               { name: 'Berale', date: '20/12/2005', description: 'blablabla'},
                               { name: 'Berale2', date: '21/12/2005', description: 'blablabla2'},
                               { name: 'Berale3', date: '22/12/2005', description: 'blablabla3'}
                               ];
    	
    });

    wp_mapify_app.controller('categoriesCtrl', function ($scope) {
        
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
