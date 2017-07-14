import angular from 'angular';

export default class YoutubeSDKService {
    
    /**
     *
     */
    constructor() {
        this.done = true;
        this.el = null;
        this.player = null;
        
        window.onYouTubeIframeAPIReady = () => {
            this._initPlayer(); //YT events init.
        };
        
        this.init();
    }
    
    
    /**
     *
     */
    init() {
        var tag = document.createElement('script'),
            firstScriptTag = document.getElementsByTagName('script')[0];
        
        tag.src = 'https://www.youtube.com/iframe_api';
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }
    
    
    /**
     *
     */
    _initPlayer() {
        this.player = new YT.Player(document.getElementById('player'), {
            width: 145,
            height: 70,
            
            events: {
                onReady: this.onPlayerReady,
                onStateChange: this.onPlayerStateChange
            },
            
            playerVars: {
                enablejsapi: 1,
                controls: 2,
                showinfo: 0,
                disablekb: 1,
                fs: 0,
                iv_load_policy: 3,
                modestbranding: 1,
                loop: 0,
                playinline: 1,
                theme: 'light',
                rel: 0
            }
        });
    }
    
    
    /**
     *
     */
    onPlayerReady(event) {
        event.target.playVideo();
    }
    
    
    /**
     *
     */
    onPlayerStateChange(event) {}
    
    
    /**
     *
     */
    stopVideo() {
        this.player.stopVideo();
    }
    
    
    /**
     *
     */
    load(videoID) {
        this.player.loadVideoById({
            videoId: videoID,
            startSeconds: 0,
            suggestedQuality: 'large'
        });
    }
}

YoutubeSDKService.$inject = [];