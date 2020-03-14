const gulp = require('gulp');
const config = require('../gulp-config')
const plugins = require('gulp-load-plugins')()
const pngquant = require('imagemin-pngquant');
const imageminZopfli = require('imagemin-zopfli');
const imageminMozjpeg = require('imagemin-mozjpeg');
const imageminGiflossy = require('imagemin-giflossy');
const pluginConfig = require('../plugin-config')

const images = (done) => {

	gulp.src([config.paths.images.src + '*.{gif,png,jpg,svg}'])
		.pipe(plugins.cache(plugins.imagemin([
			//png
			pngquant({
				speed: 1,
				quality: [0.95, 1] //lossy settings
			}),
			imageminZopfli({
				more: true
				// iterations: 50 // very slow but more effective
			}),
			//gif
			// imagemin.gifsicle({
			//     interlaced: true,
			//     optimizationLevel: 3
			// }),
			//gif very light lossy, use only one of gifsicle or Giflossy
			imageminGiflossy({
				optimizationLevel: 3,
				optimize: 3, //keep-empty: Preserve empty transparent frames
				lossy: 2
			}),
			//svg
			plugins.imagemin.svgo({
				plugins: [{
					removeViewBox: false
				}]
			}),
			//jpg lossless
			plugins.imagemin.jpegtran({
				progressive: true
			}),
			//jpg very light lossy, use vs jpegtran
			imageminMozjpeg({
				quality: 90
			})
		])))
		.pipe(gulp.dest(config.paths.images.dest));


	done();
}
module.exports = images;