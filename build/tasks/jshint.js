module.exports = function(grunt, options) {
    return {
        src: {
            src: [
                '<%= build.paths.src.js %>/**/*.js'
                //'specs/**/*Spec.js'
            ]
        },
        
        
        tasks: {
            src: [
                'Gruntfile.js',
                'grunt/**/*.js'
            ]
        },
        
        
        options: {
            jshintrc: 'build/.jshintrc.json'
        }
    };
};