export default class MainController {
    constructor($scope, $animate, localStorageService, $timeout, $rootScope, $alert, APP) {
        $scope.theme_colors = [
          'pink','red','black'
        ];
        
        $scope.fillinContent = () => {
            $scope.htmlContent = 'content content';
        };
        
        // theme changing
        $scope.changeColorTheme = (cls) => {
            $rootScope.$broadcast('theme:change', 'Choose template');//@grep debug
            $scope.theme.color = cls;
        };
        
        $scope.changeTemplateTheme = (cls) => {
            $rootScope.$broadcast('theme:change', 'Choose color');//@grep debug
            $scope.theme.template = cls;
        };
        
        if (!localStorageService.get('theme')) {
          var theme = {
            color: 'theme-black',
            template: 'theme-template-light'
          };
          
          localStorageService.set('theme', theme);
        }
        
        localStorageService.bind($scope, 'theme');
        
        console.log(APP);
        
        /*
        var introductionAlert = $alert({
            title: 'Welcome',
            content: '',
            placement: 'top-right',
            type: 'theme',
            container: '.alert-container-top-right',
            show: false,
            template: 'assets/html/layout/alert-introduction.html',
            animation: 'mat-grow-top-right'
        });
        
        
        if (!localStorageService.get('alert-introduction')) {
            $timeout(() => {
                $scope.showNotification();
                localStorageService.set('alert-introduction', 1);
            }, 2500);
        }
        
        $scope.showNotification = () => {
            introductionAlert.show();
        };
        */
    }
}

MainController.$inject = ['$scope', '$animate', 'localStorageService', '$timeout', '$rootScope', '$alert', 'APP'];