import angular from 'angular';
import GenreLiHTML from './html/genres_nav.html';

export default class GenresDirective {
    constructor($location) {
        this.$location = $location;
        
        this.replace = true;
        this.transclude = true;
        this.template = GenreLiHTML;
        this.restrict = 'E';
        this.controller = 'GenresNavController';
        this.controllerAs = 'vm';
        this.bindToController = true;
    }
    
    link($scope, element, attrs) {
        element.find('a').ripples();
    }
}

GenresDirective.$inject = ['$location'];