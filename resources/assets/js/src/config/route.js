export default function RouteConfig($routeProvider, $locationProvider) {
    $locationProvider.html5Mode(true);
    
    $routeProvider
        .when('/', {
            templateUrl: 'assets/html/ui/top_chart.html'
        })
        
        .when('/bp/:category', {
            templateUrl: 'assets/html/ui/top_chart.html'
        })
        
        .when('/:folder/:tpl', {
            templateUrl: attr => 'assets/html/ui/' + attr.folder + '/' + attr.tpl + '.html'
        })
        
        .when('/:tpl', {
            templateUrl: attr => 'assets/html/ui/' + attr.tpl + '.html'
        })
        
        .otherwise({
            redirectTo: '/'
        });
}

RouteConfig.$inject = ['$routeProvider', '$locationProvider'];