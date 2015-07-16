({
    baseUrl: "../",
    name: "Comment/main",
    out: "main-built.js",
    paths: {
        angular: 'bower_components/angular/angular.min',
        loadingBar: 'bower_components/angular-loading-bar/build/loading-bar.min'
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
})