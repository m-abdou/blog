"use strict";

(function(){

    var ANGULAR_APP_PATH='/bundles/app/js/AngularApp/';

    requirejs.config({

        baseUrl: ANGULAR_APP_PATH,

        paths: {
            angular: ANGULAR_APP_PATH + 'bower_components/angular/angular.min',
            loadingBar: ANGULAR_APP_PATH + 'bower_components/angular-loading-bar/build/loading-bar.min'
        },

        shim: {
            angular: {
                exports: 'angular'
            },
            loadingBar: {
                exports: 'loadingBar',
                deps:['angular']
            }
        }
    });

    require(['Comment/app'], function(app){
        app.init();
    });

})();