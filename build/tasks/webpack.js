module.exports = function(grunt, options) {
    var webpack = require('webpack'),
        __node_dir = options.build.paths.lib.node,
        __bower_dir = options.build.paths.lib.bower;

    return {
        options: {
            debug: true,
            
            resolve: {
                fallback: __bower_dir,
                
                extensions: ['', '.js'],
                
                modulesDirectories: [
                    options.build.paths.src.js,
                    __node_dir,
                    __bower_dir
                ],
                
                alias: {
                    //lodash: __bower_dir + '/lodash/lodash.js'
                }
            },
            
            devtool: 'cheap-source-map',
            
            stats: {
                timings: true,
                color: true,
                reasons: true
            },
            
            module: {
                loaders: [
                    {test: /jquery\.js$/, loader: 'expose?$'},
                    {test: /jquery\.js$/, loader: 'expose?jQuery'},
                    {test: /[\/]angular\.js$/, loader: 'exports?angular'},
                    {test: /\.css$/, loader: 'style!css'},
                    {test: /\.less$/, loader: 'style!css!less'},
                    {test: /\.js$/, exclude: /node_modules/, loader: 'babel-loader'},
                    {test: /\.html$/, exclude: /node_modules/, loader: 'html-loader'},
                    {test: /\.(png|woff|woff2|eot|ttf|svg)$/, loader: 'url-loader?limit=100000'}
                ]
            },
            
            progress: true,
            
            externals: {
                lodash: 'lodash'
            }
        },
        
        
        /**
         *
         */
        debug: {
            debug: true,
            
            entry: {
                app: [options.build.paths.src.js + '/bootstrap.js'],
                vendor: [
                    'jquery',
                    'angular',
                    'angular-route',
                    'angular-animate',
                    'angular-sanitize',
                    'angular-cookies',
                    'angular-local-storage',
                    'angular-loading-bar',
                    'bootstrap-material-design/dist/js/ripples'
                ]
            },
            
            output: {
                path: options.build.paths.build.js,
                filename: 'musichash.js',
                library: 'musichash',
                libraryTarget: 'umd',
                pathinfo: true
            },
            
            plugins: [
                new webpack.DefinePlugin({
                    __DEBUG__: true
                }),
                
                new webpack.optimize.CommonsChunkPlugin('vendor', 'vendor.bundle.js'),
                
                new webpack.ProvidePlugin({
                    $: "jquery",
                    jquery: "jquery",
                    "window.jQuery": "jquery",
                    _: "lodash"
                })
            ]
        },
        
        
        /**
         *
         */
        release: {
            entry: {
                app: [options.build.paths.src.js + '/bootstrap.js'],
                vendor: [
                    'jquery',
                    'angular',
                    'angular-route',
                    'angular-animate',
                    'angular-sanitize',
                    'angular-cookies',
                    'angular-local-storage',
                    'angular-loading-bar',
                    'bootstrap-material-design/dist/js/ripples'
                ]
            },
            
            output: {
                path: options.build.paths.build.js,
                filename: 'musichash.js',
                library: 'musichash',
                libraryTarget: 'umd',
                pathinfo: true
            },
            
            plugins: [
                new webpack.DefinePlugin({
                    __DEBUG__: false
                }),
                
                new webpack.optimize.CommonsChunkPlugin('vendor', 'vendor.bundle.js'),
                
                new webpack.DefinePlugin({'process.env.NODE_ENV': '"production"'}),
                new webpack.optimize.DedupePlugin(),
                new webpack.optimize.UglifyJsPlugin({sourceMap: false}),
                new webpack.optimize.OccurenceOrderPlugin(),
                new webpack.optimize.AggressiveMergingPlugin()
            ]
        }
    };
};