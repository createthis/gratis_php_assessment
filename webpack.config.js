// PACKAGES
const path = require('path');

// HELPER
function build_by_entry_and_target(entry, target) {
  return {
    mode: 'development',
    entry,
    output: {
      path: path.join(__dirname, 'dist'),
      filename: target,
    },
    module: {
      rules: [
        {
          test: /\.(js|jsx)$/,
          exclude: /node_modules/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env'],
            },
          },
        },
        {
          test: /node_modules\/react-bootstrap\/dist\/react-bootstrap.min.js$/,
          use: 'babel-loader',
        },
        {
          test: /\.css$/,
          use: [
            {
              loader: 'style-loader',
            },
            {
              loader: 'css-loader',
              options: {
                esModule: false,
              },
            },
          ],
        },
        {
          test: /\.js$/,
          enforce: 'pre',
          use: ['source-map-loader'],
        },
      ]
    },
  }
}

export default [
  build_by_entry_and_target('./src/client/index.jsx', 'public/bundle.js'),
];
