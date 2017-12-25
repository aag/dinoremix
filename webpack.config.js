const ExtractTextPlugin = require('extract-text-webpack-plugin');
const path = require('path');

module.exports = function(env, argv) {
    return {
        entry: './public/assets/index.js',
        output: {
            filename: env.prod ? 'dino-[chunkhash:8].min.js' : 'dino.js',
            path: path.resolve(__dirname, 'public/assets/dist'),
            publicPath: '/assets/dist/'
        },
        module: {
            rules: [
                {
                    test: /\.css$/,
                    use: ExtractTextPlugin.extract({
                        fallback: 'style-loader',
                        use: [ 
                            {
                                loader: 'css-loader',
                                options: {
                                    minimize: env.prod,
                                    sourceMap: true
                                }
                            }
                        ]
                    })
                },
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    loader: 'babel-loader'
                }
            ]
        },
        plugins: [
            new ExtractTextPlugin({
                filename: env.prod ? 'dino-[chunkhash:8].min.css' : 'dino.css'
            })
        ]
    };
};
