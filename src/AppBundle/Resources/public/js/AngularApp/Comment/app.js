"use strict";

define(function(require){

    //load dependencies
    var angular = require('angular');
    var loadingBar = require('loadingBar');
    var CommentController = require('Comment/Controllers/CommentController');

    //define main app
    var module=angular.module('edfa3lyApp',[
        'chieffancypants.loadingBar',
        CommentController.name,
    ]);

    module.config(['$interpolateProvider', function($interpolateProvider){
        $interpolateProvider.startSymbol("[[");
        $interpolateProvider.endSymbol("]]");
    }]);

    module.init=function(){
        angular.bootstrap(document, [module.name]);
    };

    return module;
});