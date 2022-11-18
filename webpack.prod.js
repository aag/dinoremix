const { merge } = require('webpack-merge');
const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

const common = require('./webpack.common.js');

module.exports = merge(common, {
  mode: 'production',
  devtool: 'source-map',
  optimization: {
    minimize: true,
    minimizer: [new CssMinimizerPlugin()],
  },
  output: {
    filename: '[name]-[contenthash:10].min.js',
    path: path.resolve(__dirname, 'public/assets/dist'),
    publicPath: '/assets/dist/'
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '[name]-[contenthash:10].min.css',
      chunkFilename: '[id].[contenthash:10].css',
    })
  ]
});

