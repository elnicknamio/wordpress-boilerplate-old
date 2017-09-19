const webpack = require('webpack')
const path = require('path')
const extractTextPlugin = require('extract-text-webpack-plugin')
//const offlinePlugin = require('offline-plugin'); // add Service Worker and AppCache support

const isProduction = process.env.NODE_ENV === 'production'
const processCss = isProduction ? '?minimize!postcss-loader' : '';

module.exports = {

	entry: "./assets/js/main.js",

	output: {
		path: path.resolve(__dirname, 'dist'),
		filename: "[name].js"
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
				include: path.join(__dirname, './assets')
			},
			{
				test: /\.woff($|\?)|\.woff2($|\?)|\.ttf($|\?)|\.eot($|\?)|\.svg($|\?)/,
				loader: 'url-loader',
				include: path.join(__dirname, './assets')
			}

		]
	},

	plugins: [

		/* add Service Worker and AppCache support */
		//new offlinePlugin(),

        new webpack.optimize.CommonsChunkPlugin({
            names: ['vendor']
        }),

		new extractTextPlugin({
			filename: '../style.css',
			allChunks: true,
			//disable: !isProduction // disbled in development env
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
