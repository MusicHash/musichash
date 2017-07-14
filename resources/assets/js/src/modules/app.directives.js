let moduleName = 'app.directives';

import angular from 'angular';
import Factory from '../utils/factory';

//static layout markup
import MarkupDirective from './markup/markup_directive';
import TopNavDirective from './markup/top_nav_directive';
import PlayerControlsDirective from './markup/player_controls_directive';
import HeadingDirective from './markup/heading_directive';
import YoutubePlayerDirective from './markup/youtube_player_directive';
import GenresDirective from './markup/genres_directive';
import TrandingDirective from './markup/tranding_directive';
import FootingDirective from './markup/footing_directive';

angular.module(moduleName, [])
    //markup
    .directive('musicHash', Factory(MarkupDirective))
    .directive('topNav', Factory(TopNavDirective))
    .directive('playerControls', Factory(PlayerControlsDirective))
    .directive('youtubePlayer', Factory(YoutubePlayerDirective))
    .directive('heading', Factory(HeadingDirective))
    .directive('genres', Factory(GenresDirective))
    .directive('tranding', Factory(TrandingDirective))
    .directive('footing', Factory(FootingDirective))
;

export default moduleName;