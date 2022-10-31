const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const AssetsPlugin = require('assets-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');

module.exports = (env, argv) => ({
	entry: {
		main: './js/main.js',
		admin: './js/admin.js',
	},
	output: {
		path: path.resolve(__dirname, 'public'),
		filename: 'js/[name].[contenthash:6].js',
		publicPath: '',
	},
	context: path.resolve(__dirname, 'assets'),
	module: {
		rules: [
		{
			test: /\.scss$/i,
			use: [
				argv.mode !== 'production' ? 'style-loader' : MiniCssExtractPlugin.loader,
				"css-loader",
				"postcss-loader",
				"sass-loader"
			]
		},
		{
		  test: /\.css$/i,
		  use: [
			MiniCssExtractPlugin.loader, 
			"css-loader",
			"postcss-loader",
		  ],
		},
		{
			test: /\.(jpg|png|gif|svg)$/,
			use: [
			{
				loader: 'file-loader',
				options: {
					name: "./images/[name].[ext]",
					publicPath: argv.mode === 'production' ? '../' : ''
				},
			},
			{
				loader: 'image-webpack-loader',
				options: {
					disable: argv.mode !== 'production',
				},
			}
			]
		},
		{
			test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
			exclude: [/images/],
			use: [{
				loader: 'file-loader',
				options: {
					name: '[name].[ext]',
					outputPath: 'fonts/'
				}
			}]
		}
		]
	},
	optimization: {
		minimizer: argv.mode === 'production' ? [ new CssMinimizerPlugin(), new TerserPlugin() ] : [],
	},
	plugins: [
	new MiniCssExtractPlugin(),
	new AssetsPlugin({
		path: path.join(__dirname, 'public'),
		filename: 'assets.json',
		prettyPrint: true,
		includeAllFileTypes: false,
		fileTypes: ['js', 'css']
	}),
	new BrowserSyncPlugin({
		port: 3000,
		proxy: 'https://de-ingang.local',
	}),
	new StyleLintPlugin({
		failOnError: argv.mode === 'production' ? true : false,
	}),
	],
	externals: {
		jquery: 'jQuery'
	}
});
