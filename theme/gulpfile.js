const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const webpack = require('webpack-stream');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');

gulp.task('js', function() {
	return gulp.src('./assets/scripts/main.js')
		.pipe(webpack({
			mode: 'production',
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
			output: {
				filename: 'main.js'
			}
		}))
		.pipe(uglify())
		.pipe(gulp.dest('./'));
});

function style() {
	return gulp.src(['./assets/styles/main.scss', './blocks/**/style.scss'])
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(concat('main.css'))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./'));
}

function watch() {
	gulp.watch('./assets/styles/**/*.scss', style);
	gulp.watch('./blocks/**/*.scss', style);
	gulp.watch('./assets/scripts/*.js', gulp.series('js'));
}

exports.style = style;
exports.watch = watch;
exports.build = gulp.parallel(style, 'js');
