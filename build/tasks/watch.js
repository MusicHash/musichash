module.exports = function(grunt, options) {
    return {
        js: {
            files: [
                'Gruntfile.js',
                '<%= build.paths.src.js %>/**/*.js'
            ],
            
            tasks: ['webpack:debug']
        },
        
        css: {
            files: [
                '<%= build.paths.src.css %>/**/*.scss'
            ],
            
            tasks: ['sass'],
        },
        
        options: {
            livereload: true
        }
    };
};