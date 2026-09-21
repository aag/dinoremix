const { merge } = require('rspack-merge');
const path = require('path');

const common = require('./rspack.common.js');

module.exports = merge(common, {
  mode: 'production',
  devtool: 'source-map',
  output: {
    cssFilename: '[name]-[contenthash:10].min.css',
    cssChunkFilename: '[id].[contenthash:10].css',
    filename: '[name]-[contenthash:10].min.js',
    path: path.resolve(__dirname, 'public/assets/dist'),
    publicPath: '/assets/dist/'
  }
});

