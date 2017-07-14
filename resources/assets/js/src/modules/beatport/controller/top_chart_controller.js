import angular from 'angular';

export default class TopChartController {
    constructor($scope, $rootScope, $routeParams, BPChartService, YoutubeSDKService, YoutubeService) {
        this.$scope = $scope;
        this.$scope.idx = 0;
        this.$rootScope = $rootScope;
        this.$scope.category = $routeParams.category || 'psy-trance';
        this.BPChartService = BPChartService;
        this.YoutubeSDKService = YoutubeSDKService;
        this.YoutubeService = YoutubeService;
        
        this.YoutubeSDKService.onPlayerStateChange = function(event) {
            switch(event.data) {
                case YT.PlayerState.ENDED:
                    $rootScope.$broadcast('play:next');
                    
                    break;
                
                default:
                    console.log(event.data);
                    $rootScope.$broadcast('player:state', event.data);
                    break;
            }
        };
        
        $rootScope.$on('play:next', () => {
            this.$scope.playTrack(this.$scope.idx + 1);
        });
        
        $rootScope.$on('play:play', () => {
            this.$scope.playTrack(this.$scope.idx);
        });
        
        $rootScope.$on('play:pause', () => {
            this.YoutubeSDKService.stopVideo();
            $rootScope.$broadcast('player:state', YT.PlayerState.PAUSED);
        });
        
        
        $rootScope.$on('play:previous', () => {
            this.$scope.playTrack(this.$scope.idx - 1);
        });
        
        $rootScope.pageTitle = 'Top 100 ' + this.$scope.category.replace('-', ' ') + ' Tracks';
        
        // settings
        $scope.settings = {
            singular: 'Track',
            plural: 'Tracks',
            cmd: 'Play'
        };
        
        this.initTracks();
        
        $scope.checkAll = () => {
            angular.forEach($scope.tracks, (track) => {
                track.selected = !track.selected;
            });
        };
        
        $scope.playTrack = (idx) => {
            return this.play(idx);
        };
        
        $scope.$on('$destroy', () => {
            this.$scope.idx = 0;
            //this.hideForm();
        });
    }
    
    
    /**
     *
     */
    play(idx) {
        this.$scope.idx = idx;
        
        var track = this.getTrackByIndex(idx);
        
        if (track) {
            this.YoutubeService.search(track.artist + ' - '+ track.title).then((videoID) => {
                if (null === videoID) return;
                
                track.playing = true;
                this.$scope.track = track;
                this.$scope.settings.cmd = 'Playing';
                
                this.YoutubeSDKService.load(videoID);
            });
            
            return true;
        }
        
        console.log(['error, track not found', idx, track]);
    }
    
    
    /**
     *
     */
    getTrackByIndex(idx) {
        return this.$scope.tracks[idx];
    }
    
    
    /**
     *
     */
    getIcon(name) {
        return `<i class="zmdi zmdi-${name}"></i>`;
    }
    
    
    /**
     *
     */
    initTracks() {
        this.BPChartService.getList(this.$scope.category).then((tracks) => {
            this.$scope.tracks = tracks;
        });
    }
}

TopChartController.$inject = ['$scope', '$rootScope', '$routeParams', 'BPChartService', 'YoutubeSDKService', 'YoutubeService'];