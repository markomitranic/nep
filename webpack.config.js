const webpack = require('webpack'),
  path = require('path'),
  ExtractTextPlugin = require('extract-text-webpack-plugin'),
  Autoprefixer = require('autoprefixer');

module.exports = {
  entry: {
    app: [
      './scripts/app.js',
      './scss/style.scss'
    ]
  },
  output: {
    path: path.resolve(__dirname, './public/wp-content/themes/Nep/js'),
    filename: '[name].js'
  },
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/,
        use: ExtractTextPlugin.extract({
          use: [
            'css-loader',
            'postcss-loader',
            'sass-loader'
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
    new ExtractTextPlugin('../css/style.css'),
    new webpack.LoaderOptionsPlugin({
      minimize: false,
      debug: true,
      options: {
        context: __dirname
      }
    }),
    new webpack.LoaderOptionsPlugin({
      options: {
        postcss: [
          Autoprefixer()
        ]
      }
    })
  ]
};
