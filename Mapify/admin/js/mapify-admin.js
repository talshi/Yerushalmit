(function ($) {

    var wp_mapify_app = angular.module('wp_mapify_app', ['ngRoute']);

    wp_mapify_app.controller('mapCtrl', function ($scope) {
        console.log("mapCtrl");
    });

    wp_mapify_app.controller('activitiesCtrl', function ($scope) {
        console.log("activitiesCtrl");
    });

    wp_mapify_app.controller('categoriesCtrl', function ($scope) {
        console.log("categoriesCtrl");
    });

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
                redirectTo: '/wp-content/plugins/Mapify/admin/partials/mapify-admin-display.php'
            });
    });

        $(document).ready(function () {

        $('#upload_image_button').click(function () {
            alert("hello");
            formfield = $('#upload_image').attr('name');
            tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
            return false;
        });

        window.send_to_editor = function (html) {
            imgurl = $('img', html).attr('src');
            $('#upload_image').val(imgurl);
            tb_remove();
        }

    });

})(jQuery);

