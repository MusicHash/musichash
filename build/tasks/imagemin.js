module.exports = function(grunt, options) {
    var imagesSrcDir = '<%= build.paths.src.images %>',
        filesPattern = '**/*.{png,jpg,gif,svg,xml,json,ico}';
    
    return {
        build: {
            dynamic: {
                files: [{
                    cwd: imagesSrcDir,
                    src: [filesPattern],
                    dest: '<%= build.paths.build.images %>',
                    expand: true
                }]
            }
        }
    };
};