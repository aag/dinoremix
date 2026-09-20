const { merge } = require('webpack-merge');
const path = require('path');

const common = require('./webpack.common.js');

module.exports = merge(common, {
  mode: 'development',
  devtool: 'inline-source-map',
  output: {
    cssFilename: '[name]-[contenthash:10].dev.css',
    cssChunkFilename: '[id]-[contenthash:10].dev.css',
    filename: '[name]-[contenthash:10].dev.js',
    path: path.resolve(__dirname, 'public/assets/dist'),
    publicPath: '/assets/dist/'
  }
});

