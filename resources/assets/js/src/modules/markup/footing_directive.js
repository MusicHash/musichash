import FootingHTML from './html/footing.html';

export default class FootingDirective {
    constructor() {
        this.template = FootingHTML;
        this.restrict = 'A';
    }
}

FootingDirective.$inject = [];