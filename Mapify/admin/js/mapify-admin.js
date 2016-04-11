(function ($) {

    var wp_mapify_app = angular.module('wp_mapify_app', ['ngRoute']);
    
    wp_mapify_app.config(function ($routeProvider) {
        $routeProvider
        .when('/', {
            templateUrl: 'mapify-admin-display.php',
            controller: 'adminCtrl',
            controllerAs: 'admin'
        })
        .when('/manageActities', {
            templateUrl: 'mapify-manageactivities-display.php',
            controller: 'activitiesCtrl',
            controllerAs: 'activity'
        })
        .when('/manageCategories', {
            templateUrl: 'mapify-managecategories-display.php',
            controller: 'categoriesCtrl',
            controllerAs: 'categories'
        })
        .when('/manageMap', {
            templateUrl: 'mapify-managemap-display.php',
            controller: 'managemapCtrl',
            controllerAs: 'manageMap'
        })
    });

    wp_mapify_app.controller('adminCtrl', function () {

    });
    wp_mapify_app.controller('activitiesCtrl', function () {

    });
    wp_mapify_app.controller('categoriesCtrl', function () {

    });
    wp_mapify_app.controller('managemapCtrl', function () {

    });

    
})(jQuery);
