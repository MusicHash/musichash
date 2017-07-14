module.exports = function(grunt, options) {
    return {
        afterBuild: {
            src: [
                '.sass-cache'
            ]
        }
    };
};