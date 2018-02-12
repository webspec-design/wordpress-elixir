const env = require('./env.json');

const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

//This path is relative to the output path (build/js)
const extractSass = new ExtractTextPlugin('../css/main.css');

module.exports = {
  entry: './js/main.js',
  //`output` is for JavaScript files
  output: {
    path: path.resolve(__dirname, 'build/js'),
    filename: 'main.js'
  },
  //Anything that's not a JS file requires a plugin
  module: {
    rules: [{
      test: /\.scss$/,
      use: extractSass.extract({
        use: [{
          loader: 'css-loader',
          options: {
            importLoaders: 2
          }
        }, {
          //Postcss must come after css-loader but before sass-loader
          loader: 'postcss-loader',
          options: {
            ident: 'postcss',
            plugins: (loader) => [
              require('autoprefixer')(),
            ]
          }
        }, {
          loader: 'sass-loader',
          options: {
            outputStyle: 'compressed'
          }
        }]
      })
    }, {
      test: /\.woff2?$|\.ttf$|\.eot$|\.otf$/,
      use: [{
        loader: 'file-loader',
        options: {
          outputPath: '../fonts/',
          name: '[name].[ext]'
        }
      }]
    }, {
      test: /\.svg$/,
      use: [{
        loader: 'file-loader',
        options: {
          outputPath: '../svg/',
          name: '[name].[ext]'
        }
      }]
    }, {
      test: /\.png$|\.jpg$|\.gif$/,
      use: [{
        loader: 'file-loader',
        options: {
          outputPath: '../img/',
          name: '[name].[ext]'
        }
      }]
    }]
  },
  plugins: [
    extractSass,
    new BrowserSyncPlugin({
        host: 'localhost',
        port: 3000,
        proxy: env.bsProxy
    })
  ],
  externals: {
    jquery: 'jQuery'
  }
};
