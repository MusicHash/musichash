let moduleName = 'app.controllers';

import angular from 'angular';
import MainController from './markup/main_controller';
import TopChartController from './beatport/controller/top_chart_controller';
import GenresNavController from './markup/genres_nav_controller';
import PlayerControlsController from './markup/player_controls_controller';

angular.module(moduleName, [])
    .controller('MainController', MainController)
    .controller('TopChartController', TopChartController)
    .controller('PlayerControlsController', PlayerControlsController)
    .controller('GenresNavController', GenresNavController)
    
    ;

export default moduleName;