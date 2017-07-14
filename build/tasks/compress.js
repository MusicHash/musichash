module.exports = function(grunt, options) {
    return {
        release: {
            files: [{
                expand: true,
                
                src: [
                    '**',
                    '!<%= build.paths.build.assets %>/**',
                    '.env.example',
                    '.gitattributes',
                    '.gitignore',
                    '!storage/**',
                    '!bower_components/**',
                    '!node_modules/**',
                    '!vendor/**',
                    '!composer.lock',
                    '!releases/**'
                ],
                
                dest: '.'
            }]
        },
        
        
        options: {
            archive: 'releases/<%= pkg.name %>.<%= pkg.version %>.zip'
        }
    };
};