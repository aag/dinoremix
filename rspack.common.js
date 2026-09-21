const { CleanWebpackPlugin } = require('clean-webpack-plugin');

module.exports = {
  entry: {
    dino: './public/assets/index.js'
  },
  plugins: [
    new CleanWebpackPlugin({
      cleanOnceBeforeBuildPatterns: ['**/*', '!.gitkeep'],
    }),
  ],
  module: {
    rules: [
      {
        test: /\.css$/i,
        type: 'css/auto',
      },
      {
        test: /\.(png|jpe?g|gif|svg|eot|ttf|woff|woff2)$/i,
        type: "asset",
      },
      {
        test: /\.(?:js|mjs|jsx|ts|tsx)$/,
        exclude: [/[\\/]node_modules[\\/]/],
        use: {
          loader: 'builtin:swc-loader',
          options: {
            detectSyntax: 'auto',
          },
        }
      }
    ]
  }
};
