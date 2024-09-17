const path = require('path');
const glob = require('glob');

module.exports = {
	entry: glob.sync(path.resolve(__dirname, './blocks/*/*.{js,jsx}')),
	output: {
		path: path.resolve(__dirname, 'build'),
		filename: 'index.js',
	},
	module: {
		rules: [
			{
				test: /\.jsx?$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
				},
			},
			{
				test: /\.css$/,
				use: ['style-loader', 'css-loader'],
			},
			{
				test: /\.(png|jpe?g|gif)$/i,
				use: ['file-loader'],
			},
		],
	},
	resolve: {
		extensions: ['.js', '.jsx'],
	},
};
