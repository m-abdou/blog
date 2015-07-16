"use strict";

define(['angular'], function(angular){

    var module=angular.module('CommentControllerModule', []);

    module.controller('CommentController', ['$scope', '$http', '$rootScope', '$timeout',
        function($scope, $http, $rootScope, $timeout){

            $scope.init = function(){
                console.log('sdfsdfsdf');
            };

        }]);

    return module;
});