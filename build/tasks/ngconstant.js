module.exports = function(grunt, options) {
    return {
        build: {
          constants: {
            APP: {
              version: '<%= pkg.version %>'
            }
          }
        },
        
        
        options: {
            dest: '<%= build.paths.src.js %>/modules/app.definitions.js',
            name: 'app.definitions',
        }
    };
};