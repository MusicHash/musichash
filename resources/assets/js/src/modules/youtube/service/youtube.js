import angular from 'angular';

export default class YoutubeService {
    constructor($http) {
        this.$http = $http;
        this.baseUrl = '/api/youtube/search/';
    }
    
    
    search(query) {
        return this.$http.get(this.baseUrl + query).then(function(response) {
            return response.data;
        });
    }
}

YoutubeService.$inject = ['$http'];