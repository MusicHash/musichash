import TopNavHTML from './html/top_nav.html';

export default class TopNavDirective {
    constructor() {
        this.template = TopNavHTML;
        this.restrict = 'A';
    }
}

TopNavDirective.$inject = [];