const path = require('path');
const glob = require('glob');
const TerserPlugin = require('terser-webpack-plugin');

const entryArray = glob.sync('./assets/scripts/src/*.js');
const mode = process.env.NODE_ENV || 'development';

const entryObject = entryArray.reduce((acc, item) => {
  let name = path.basename(item, path.extname(item));
  acc[name] = './' + item;
  return acc;
}, {});



module.exports = {
  mode: mode,
  entry: entryObject,
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'assets/scripts/dist')
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env']
          }
        }
      }
    ]
  },
  optimization: {
    minimize: true,
    minimizer: [new TerserPlugin({extractComments: false,})],
  }
};
