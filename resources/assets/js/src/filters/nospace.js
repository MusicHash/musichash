export default function NoSpaceFilter() {
    return function(value) {
         return (!value) ? '' : value.replace(/ /g, '');
    };
}

NoSpaceFilter.$inject = [];