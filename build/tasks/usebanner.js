module.exports = function(grunt, options) {
    return {
        release: {
            files: {
                src: [
                      '<%= build.paths.build.dir %>/*.css',
                      '<%= build.paths.build.dir %>/*.js'
                ]
            },
            
            
            options: {
                position: 'top',
                banner: '/*! <%=  grunt.template.today("dd-mm-yyyy hh:MM:ss")  %> */',
                linebreak: true
            }
        }
    };
};