/* global __dirname, require, module*/

const webpack           = require('webpack');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const path              = require('path');
const env               = require('yargs').argv.env; // use --env with webpack 2

let libraryName       = 'ClientModules';
let outputFileName    = 'client-modules';
let outputFile;

let plugins = [
    new ExtractTextPlugin({ filename: 'client-modules.min.css', disable: false, allChunks: false})
];

if (env === 'build')
{
  outputFile = outputFileName + '.min.js';
}
else
{
  outputFile = outputFileName + '.js';
}

const config = {
  entry     : __dirname + '/src/index.js',
  devtool   : 'source-map',
  output: {
    path            : __dirname + '/build',
    filename        : outputFile,
    library         : libraryName,
    libraryTarget   : 'umd',
    umdNamedDefine  : true
  },
  externals: {
    "jquery": "jQuery",
    "bootstrap": "bootstrap"
  },
  module: {
    rules: [
      {
        test      : /(\.jsx|\.js)$/,
        loader    : 'babel-loader',
        exclude   : /(node_modules|bower_components)/
      },
      {
          test: /\.css$/,
          loader: "style-loader!css-loader",
          loader: ExtractTextPlugin.extract({ fallback: 'style-loader', use: 'css-loader' })
      },
      // {
      //   test    : /(\.jsx|\.js)$/,
      //   loader  : 'eslint-loader',
      //   exclude : /node_modules/
      // }
    ]
  },
  resolve: {
    modules: [path.resolve('./src'), '../node_modules'],
    extensions: ['.json', '.js', '.css']
  },
  plugins: plugins
};

module.exports = config;