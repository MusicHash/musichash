 /*jslint node: true */
 module.exports = function(grunt) {

    var path = require('path'),
        cwd = process.cwd(),
        dirs = {
            src: 'resources/assets',
            build: 'public/assets'
        };
    
    // Print the execution time for the tasks
    require('time-grunt')(grunt);
    
    // loads npm
    require('load-grunt-tasks')(grunt);
    
    // init grunt
    require('load-grunt-config')(grunt, {
        configPath: path.join(cwd, 'build/tasks'),
        
        config: {
            pkg: grunt.file.readJSON('package.json'),
            
            build: {
                paths: {
                    src: {
                        root: cwd,
                        dir: path.join(cwd, dirs.src),
                        js: path.join(cwd, dirs.src, 'js', 'src'),
                        css: path.join(dirs.src, 'css'),
                        images: path.join(dirs.src, 'images')
                    },
                    
                    build: {
                        dir: path.join(dirs.build, '../'),
                        assets: path.join(dirs.build),
                        js: path.join(dirs.build, 'js'),
                        css: path.join(dirs.build, 'css'),
                        images: path.join(dirs.build, 'images'),
                        fonts: path.join(dirs.build, 'fonts')
                    },
                    
                    lib: {
                        node: path.join(cwd, 'node_modules'),
                        bower: path.join(cwd, 'bower_components'),
                        composer: path.join(cwd, 'vendor')
                    }
                },
                
                banner: require('fs').readFileSync(path.join(cwd, 'build/banner.txt'), 'utf8')
            }
        }
    });
    
    // Default task
    grunt.registerTask('default', 'debug');
    
    // Common task
    grunt.registerTask('common', [
        'ngconstant',
        'copy',
        //'filerev',
        'imagemin',
        'usebanner'
    ]);
    
    
    // Common task
    grunt.registerTask('debug', [
        'common',
        'sass:debug',
        'webpack:debug',
        'clean:afterBuild'
    ]);
};