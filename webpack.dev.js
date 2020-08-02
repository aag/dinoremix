const { merge } = require('webpack-merge');
const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

const common = require('./webpack.common.js');

module.exports = merge(common, {
  mode: 'development',
  devtool: 'inline-source-map',
  output: {
    filename: '[name]-[contenthash:10].dev.js',
    path: path.resolve(__dirname, 'public/assets/dist'),
    publicPath: '/assets/dist/'
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name]-[contenthash:10].dev.css',
      chunkFilename: '[id]-[contenthash:10].dev.css',
    })
  ]
});

