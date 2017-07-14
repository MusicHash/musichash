export default class Xhr {
    /**
     *
     */
    static EXPIRED() {
        return 'EXPIRED';
    }
    
    
    /**
     *
     */
    constructor($q, $http, localStorageService) {
        this.$q = $q;
        this.$http = $http;
        this.localStorageService = localStorageService;
        
        this.settings = {
            baseUrl: '',
            ttl: 60 * 60 //1h
        };
    }
    
    
    /**
     *
     */
    setTTL(ttl) {
        this.settings.ttl = ttl;
        
        return this;
    }
    
    
    /**
     *
     */
    setBaseUrl(baseUrl) {
        this.settings.baseUrl = baseUrl;
        
        return this;
    }
    
    
    /**
     *
     */
    get(service) {
        var deferred = this.$q.defer(),
            url = this.settings.baseUrl + '/' + service;
        
        var cachedData = this.readCache(url);
        if (this.EXPIRED !== cachedData) {
            
            deferred.resolve(cachedData);
            
            return deferred.promise;
        }
        
        var promise = this.$http.get(url).then((response) => {
            var responseData = response.data;
            this.storeCache(url, responseData);
            
            deferred.resolve(responseData);
            
            return deferred.promise;
        }, this.error);
        
        return promise;
    }
    
    
    /**
     *
     */
    storeCache(key, data) {
        var time = new Date();
        
        var store = {
            data: data,
            expires: Math.round((time.setSeconds(time.getSeconds() + this.settings.ttl)) / 1000)
        };
        
        this.localStorageService.set(key, store);
        
        return this;
    }
    
    
    /**
     *
     */
    readCache(key) {
        var time = new Date();
        var now = Math.round(+time / 1000),
            cached = this.localStorageService.get(key);
        
        var expires = ('undefined' !== typeof(cached) && null !== cached && 'undefined' !== typeof(cached.expires) && null !== cached.expires) ? cached.expires : 0; 
        
        if (expires < now) {
            //cache is invalid
            return this.EXPIRED;
        }
        
        return cached.data;
    }
    
    
    error(text) {
        console.log('error fired');
        console.log(text);
    }
}

Xhr.$inject = ['$q', '$http', 'localStorageService'];