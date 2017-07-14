module.exports = function(grunt, options) {
    return {
        src: {
            dir: './tests'
        },
        
        options: {
            bin: 'vendor/bin/phpunit',
            bootstrap: 'bootstrap/autoload.php',
            color: true
        }
    };
};