import angular from 'angular';

import run from './config/run';
import route from './config/route';
import animate from './config/animate';
import exception from './config/exception';
import noSpace from './filters/nospace';

import appCore from './modules/app.core';
import appDefinitions from './modules/app.definitions';
import appServices from './modules/app.services';
import appControllers from './modules/app.controllers';
import appDirectives from './modules/app.directives';
import appFactories from './modules/app.factories';

let appMain = 'app';

export default angular
    .module(appMain, [
        /**
         * Definitions init, consts, version.
         */
        `${appMain}.definitions`,
        
        
        /**
         * Core componenets init
         */
        `${appMain}.core`,
        
        
        /**
         * Services componenets init
         */
        `${appMain}.services`,


        /**
         * Controllers componenets init
         */
        `${appMain}.controllers`,


        /**
         * Directives componenets init
         */
        `${appMain}.directives`,
        
        
        /**
         * Factories componenets init
         */
        `${appMain}.factories`,
    ])
    
    // Config elements
    .config(exception)
    .config(animate)
    .config(route)
    
    // filters
    .filter('nospace', noSpace)
    
    // RUNN!
    .run(run);