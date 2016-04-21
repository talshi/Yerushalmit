(function ($) {

    var wp_mapify_app = angular.module('wp_mapify_app', ['ngRoute']);
    
    wp_mapify_app.controller('', function($scope) {
        
    });

    wp_mapify_app.controller('', function($scope) {
        
    });

    wp_mapify_app.controller('', function($scope) {
    
    });

    wp_mapify_app.config(function($routeProvider) {
        $routeProvider
            .when('/map', {
                templateUrl : 'mapify-admin-display.php',
                controller  : 'adminCtrl',
                controllerAs: 'admin'
            })
            .when('/activities', {
                templateUrl : 'mapify-activities-display.php',
                controller  : 'activitiesCtrl',
                controllerAs: 'activities'
            })
            .when('/categories', {
                templateUrl : 'mapify-categories-display.php',
                controller  : 'categoriesCtrl',
                controllerAs: 'categories'
            });
    });
})(jQuery);
