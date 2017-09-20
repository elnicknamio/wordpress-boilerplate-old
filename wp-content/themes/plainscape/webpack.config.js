const webpack = require('webpack')
const path = require('path')
const extractTextPlugin = require('extract-text-webpack-plugin')
const browserSyncPlugin = require('browser-sync-webpack-plugin')
// const offlinePlugin = require('offline-plugin'); // add Service Worker and AppCache support

const isProduction = process.env.NODE_ENV === 'production'
const processCss = isProduction ? '?minimize!postcss-loader' : '';
const themeDirectory = path.resolve(__dirname + '/../../../').split(path.sep).pop();

module.exports = {

	entry: path.resolve(__dirname, "assets/js/main.js"),

	output: {
		path: path.resolve(__dirname, 'dist'),
		filename: "[name].js"
	},

	stats: {
		children: false
	},

	watchOptions: {
		ignored: /node_modules/
	},

	module: {
		rules: [
			{
				test: /\.html$/,
				loader: 'raw-loader',
				include: path.join(__dirname, './assets')
			},
			{
				test: /\.js$/,
				loader: 'babel-loader',
				include: path.join(__dirname, './assets'),
			},
			{
				test: /\.(css|scss|sass)$/,
				loader: extractTextPlugin.extract({
					fallback: 'style-loader',
					use: `css-loader${processCss}!sass-loader`,
				}),
				include: path.join(__dirname, './assets')
			},
			{
				test: /\.(jpe?g|png|gif|svg)$/,
				use: [
					{
						loader: 'file-loader',
						options: {
							name: '[name].[ext]?[hash]'
						}
					},
					'img-loader'
				],
				include: path.join(__dirname, './assets/img')
			},
			{
				test: /\.woff($|\?)|\.woff2($|\?)|\.ttf($|\?)|\.eot($|\?)|\.svg($|\?)/,
				loader: 'url-loader',
				include: path.join(__dirname, './assets/fonts')
			}

		]
	},

	plugins: [

		// add Service Worker and AppCache support
		// new offlinePlugin(),

		// creating chunk files */
        // new webpack.optimize.CommonsChunkPlugin({
        //     name: 'vendor'
        // }),

		new extractTextPlugin({
			filename: '../style.css',
			allChunks: true,
			//disable: !isProduction // disbled in development env
		}),

		new browserSyncPlugin({
			host: 'localhost',
			port: 3000,
			proxy: `http://localhost/${themeDirectory}/`,
			files: "./**/*.php"
		})

    ],

	devServer: {
		contentBase: path.join(__dirname, '/'),
		inline: true,
		hot: true,
		historyApiFallback: true,
	}

}

if (isProduction) {

    module.exports.plugins.push(

        new webpack.optimize.UglifyJsPlugin()

    );
}
