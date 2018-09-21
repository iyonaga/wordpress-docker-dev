const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const src = path.join(__dirname, './assets/src');
const dist = './assets/dist';

const isProduction =
  process.argv[process.argv.indexOf('--mode') + 1] === 'production';

module.exports = {
  entry: {
    app: ['@babel/polyfill', `${src}/js/app.js`]
  },

  output: {
    path: path.join(__dirname, dist),
    filename: './js/[name].js'
  },

  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            cacheDirectory: true
          }
        }
      },

      {
        test: /\.s?css$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              importLoaders: 2,
              url: false
            }
          },
          'postcss-loader',
          'sass-loader'
        ]
      }
    ]
  },

  plugins: [
    new MiniCssExtractPlugin({
      filename: './css/style.css'
    }),
    new CopyWebpackPlugin(
      [{ from: './img', to: './img' }, { from: './fonts', to: './fonts' }],
      {
        context: src,
        ignore: ['_*', '.DS_Store', '.gitignore', '.gitkeep', 'bak/*']
      }
    ),
    new BrowserSyncPlugin(
      {
        https: true,
        host: 'localhost',
        port: 8888,
        proxy: 'https://localhost',
        files: [
          'theme/assets/dist/css/**/.css',
          'theme/assets/src/js/**/*.js',
          'theme/**/*.php'
        ],
        ui: false,
        injectCss: true
      },
      {
        reload: false
      }
    )
  ],

  optimization: {
    splitChunks: {
      name: 'vendor',
      chunks: 'initial'
    },
    minimizer: [
      new TerserPlugin({
        parallel: true,
        terserOptions: {
          compress: {
            drop_console: true
          }
        }
      })
    ]
  }
};

if (isProduction) {
  module.exports.plugins.push(new CleanWebpackPlugin([dist]));
}
