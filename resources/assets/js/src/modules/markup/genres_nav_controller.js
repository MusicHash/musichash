export default class GenresNavController {
    constructor($scope, BPGenresService) {
        this.BPGenresService = BPGenresService;
        this.$scope = $scope;
        
        this.initGenres();
    }
    
    
    initGenres() {
        this.BPGenresService.getGenres().then((genres) => {
            this.$scope.genres = genres;
        });
    }
}

GenresNavController.$inject = ['$scope', 'BPGenresService'];