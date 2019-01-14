const path = require('path');
const webpack = require('webpack');
const fs = require('fs');
const glob = require('glob');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

// if not available we must be local
let envPath = '/app/env/.env';

//if not available we must be local
if (!fs.existsSync(envPath)) {
    envPath = './env/.env';
}

// load in our .env file
const dotenv = require('dotenv').config({ path: envPath });

// temp overwrite for demo
const distPath = path.resolve(__dirname, `dist/wp-content/themes/${process.env.WP_THEME_NAME}/assets/dist`);
const srcPath = path.resolve(__dirname, `src/wp-content/themes/${process.env.WP_THEME_NAME}/assets`);
const blockPath = path.resolve(__dirname, `src/wp-content/themes/${process.env.WP_THEME_NAME}/lib/blocks`);

// create a new instance of this plugin to be use in our scss loader
const extractCSS = new ExtractTextPlugin({ filename: 'css/bundle.css' });

const config = {
    entry: [
        `${srcPath}/js/main.js`,
        `${srcPath}/scss/main.scss`,
        ...glob.sync(`${blockPath}/**/*/index.scss`),
        ...glob.sync(`${blockPath}/**/*/index.js`)
    ],
    output: {
        path: distPath,
        filename: 'js/bundle.js'
    },
    plugins: [
        extractCSS
    ],
    module: {
        loaders: [
            {
                test: /\.(js|jsx)$/,
                include: srcPath,
                loader: 'babel-loader'
            },
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                loader: 'eslint-loader'
            },
            {
                test: /\.scss$/,
                exclude: /node_modules/,
                use: extractCSS.extract(
                    ['css-loader', 'postcss-loader', 'sass-loader']
                )
            },
            {
                test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
                exclude: srcPath + '/img',
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: 'fonts/[name].[ext]',
                        publicPath: '../'
                    }
                }]
            },
            {
                test: /\.(jpe?g|png|gif|svg)$/i,
                exclude: /node_modules/,
                use: [{
                    loader: 'url-loader',
                    options: {
                        limit: 8192,
                        name: 'images/[name].[ext]',
                        publicPath: '../'
                    }
                }]
            },
        ]
    },
    resolve: {
        extensions: ['.jsx', '.js', '.json', '.scss']
    }
};

module.exports = config