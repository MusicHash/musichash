module.exports = function(grunt, options) {
    
    return {
        fonts: {
            files: [
                {expand: true, src: '**', cwd: '<%= build.paths.lib.node %>/font-awesome/fonts', dest: '<%= build.paths.build.fonts %>'},
                {expand: true, src: '**', cwd: '<%= build.paths.lib.node %>/material-design-iconic-font/dist/fonts', dest: '<%= build.paths.build.fonts %>'},
                {expand: true, src: '**', cwd: '<%= build.paths.lib.node %>/roboto-fontface/fonts', dest: '<%= build.paths.build.fonts %>'},
                {expand: true, src: '**', cwd: '<%= build.paths.lib.node %>/weather-icons/font', dest: '<%= build.paths.build.fonts %>'},
                {expand: true, src: '**', cwd: '<%= build.paths.lib.node %>/bootstrap-sass/assets/fonts/bootstrap', dest: '<%= build.paths.build.fonts %>'}
            ]
        },
        
        
        staticAssets: {
            files: [
                {expand: true, src: '**/*', cwd: '<%= build.paths.src.dir %>/html', dest: '<%= build.paths.build.assets %>/html'},
                {expand: true, src: '**/*', cwd: '<%= build.paths.src.dir %>/images', dest: '<%= build.paths.build.assets %>/images'},
                {src: '<%= build.paths.lib.bower %>/ng-file-upload/FileAPI.flash.swf', dest: '<%= build.paths.build.assets %>/FileAPI.flash.swf'},
                {src: '<%= build.paths.lib.bower %>/ng-file-upload/FileAPI.min.js', dest: '<%= build.paths.build.assets %>/FileAPI.min.js'}
            ]
        }
    };
};