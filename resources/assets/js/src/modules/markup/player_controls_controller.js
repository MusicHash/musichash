export default class PlayerControlsController {
    constructor($scope, $rootScope) {
        this.$scope = $scope;
        this.$rootScope = $rootScope;
        
        this.$rootScope.$on('player:state', (event, state) => {
            switch(state) {
                case YT.PlayerState.PLAYING:
                case YT.PlayerState.BUFFERING:
                    //hide stop, show play.
                    this.$scope.playing = true;
                    break;
                
                default:
                    //show stop, hide play.
                    this.$scope.playing = false;
                    break;
            }
        });
        
        
        $scope.previous = () => {
            this.notify('previous');
        };
        
        $scope.toggle = () => {
            if (!this.$scope.playing)
                this.notify('play');
            else
                this.notify('pause');
        };
        
        $scope.next = () => {
            this.notify('next');
        };
        
        
    }
    
    notify(eventName) {
        return this.$rootScope.$broadcast('play:'+eventName);
    }
}

PlayerControlsController.$inject = ['$scope', '$rootScope'];