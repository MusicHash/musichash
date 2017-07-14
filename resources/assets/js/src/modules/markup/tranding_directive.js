import TrandingHTML from './html/tranding.html';

export default class TrandingDirective {
    constructor() {
        this.template = TrandingHTML;
        this.restrict = 'A';
    }
}

TrandingDirective.$inject = [];