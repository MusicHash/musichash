module.exports = function(grunt, options) {
    return {
        release: {
            src: [
                '<%= build.paths.build.js %>/**/*.js',
                '<%= build.paths.build.css %>/**/*.css',
            ]
        },
        
        
        options: {
            length: 20,
            algorithm: 'md5',
            encoding: 'utf8'
        }
    };
};