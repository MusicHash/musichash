import PlayerControlsHTML from './html/player_controls.html';

export default class PlayerControlsDirective {
    constructor() {
        this.template = PlayerControlsHTML;
        this.restrict = 'E';
        this.controller = 'PlayerControlsController';
    }
}

PlayerControlsDirective.$inject = [];