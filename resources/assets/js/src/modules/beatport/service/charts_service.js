import Xhr from '../../../utils/xhr';

export default class ChartService {
    constructor($q, $http, localStorageService) {
        this.$q = $q;
        this.$http = $http;
        this.localStorageService = localStorageService;
        
        this.settings = {
            baseUrl: '/api/beatport/chart',
            ttl: 60 * 60 * 24 * 12
        };
    }
    
    
    getList(category) {
        return (new Xhr(this.$q, this.$http, this.localStorageService))
            .setTTL(this.settings.ttl)
            .setBaseUrl(this.settings.baseUrl)
            .get(category);
    }
}

ChartService.$inject = ['$q', '$http', 'localStorageService'];