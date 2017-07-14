export default function AnimateConfig($animateProvider) {
    $animateProvider.classNameFilter(/^(?:(?!ng-animate-disabled).)*$/);
}

AnimateConfig.$inject = ['$animateProvider'];