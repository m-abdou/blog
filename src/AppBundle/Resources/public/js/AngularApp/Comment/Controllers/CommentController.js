"use strict";

define(['angular'], function(angular){

    var module=angular.module('CommentControllerModule', []);

    module.controller('CommentController', ['$scope', '$http', '$rootScope', '$timeout',
        function($scope, $http, $rootScope, $timeout){

            $scope.init = function(id){
                $scope.articalId = id;
                getArticleComment();
            };

            $scope.commentValue = '';
            function getArticleComment(){
                $http({
                        method: 'GET',
                        url:'/api/comment?id='+encodeURIComponent($scope.articalId)
                    }
                ).success(function(data)
                    {
                        if(data.error.status == false){
                            $scope.comments = data.data.comments;
                        }

                    });
            }
            function AddArticleComment(){
                $http({
                        method: 'POST',
                        url: '/api/comment/adds',
                        data: {
                            comment : $scope.commentValue,
                            id      : $scope.articalId
                        }
                    }
                ).success(function(data)
                    {
                        if(data.error.status == false){
                            $scope.comments = data.data.comments;
                        }

                    });
            }

            $scope.addCommentClicked = function (){
                var valid = $scope.form.$valid;
                if(valid){
                    $scope.form.$setPristine();
                    AddArticleComment();
                    $scope.commentValue = '';
                }
            };

        }]);

    return module;
});