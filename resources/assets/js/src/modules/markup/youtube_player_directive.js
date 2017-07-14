import YoutubePlayerHTML from './html/youtube_player.html';

export default class YoutubePlayerDirective {
    constructor() {
        this.template = YoutubePlayerHTML;
        this.restrict = 'E';
    }
}

YoutubePlayerDirective.$inject = [];