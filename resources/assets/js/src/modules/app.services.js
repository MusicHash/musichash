let moduleName = 'app.services';

import angular from 'angular';
import SkinService from '../utils/skin';
import BPChartService from './beatport/service/charts_service';
import BPGenresService from './beatport/service/genres_service';
import YoutubeSDKService from './youtube/service/youtube_sdk';
import YoutubeService from './youtube/service/youtube';


angular.module(moduleName, [])
    .service('SkinService', SkinService)
    .service('BPChartService', BPChartService)
    .service('BPGenresService', BPGenresService)
    .service('YoutubeSDKService', YoutubeSDKService)
    .service('YoutubeService', YoutubeService)
    
    ;

export default moduleName;