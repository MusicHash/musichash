let moduleName = 'app.core';

import angular from 'angular';
import ngRoute from 'angular-route';
import ngAnimate from 'angular-animate';
import ngSanitize from 'angular-sanitize';
import ngCookies from 'angular-cookies';
import LocalStorageModule from 'angular-local-storage';
import angularLoadingBar from 'angular-loading-bar';
import ngResource from 'angular-resource';
import ngIpsum from 'ng-ipsum/src/ipsum';
import angularStrap from 'angular-strap';
//import ngTable from 'ng-table';

export default angular
    .module(moduleName, [
        'ngRoute',
        'ngAnimate',
        'ngSanitize',
        'ngCookies',
        'LocalStorageModule',
        'angular-loading-bar',
        'ngResource',
        'ipsum',
        'mgcrea.ngStrap',
        //'ngTable',
    ]);