import Xhr from '../../../utils/xhr';

export default class GenresService {
    constructor($q, $http, localStorageService) {
        this.$q = $q;
        this.$http = $http;
        this.localStorageService = localStorageService;
        
        this.settings = {
            baseUrl: '/api/beatport',
            ttl: 60 * 60 * 24 * 15
        };
    }
    
    
    getGenres() {
        return (new Xhr(this.$q, this.$http, this.localStorageService))
            .setTTL(this.settings.ttl)
            .setBaseUrl(this.settings.baseUrl)
            .get('genres');
    }
}

GenresService.$inject = ['$q', '$http', 'localStorageService'];