import HeadingHTML from './html/heading.html';

export default class HeadingDirective {
    constructor() {
        this.template = HeadingHTML;
        this.restrict = 'A';
    }
}

HeadingDirective.$inject = [];