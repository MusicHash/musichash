import LayoutMarkupHTML from './html/musichash.html';

export default class MarkupDirective {
    constructor() {
        this.template = LayoutMarkupHTML;
        this.restrict = 'E';
    }
}

MarkupDirective.$inject = [];