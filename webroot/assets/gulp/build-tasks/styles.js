const gulp = require('gulp');
const config = require('../gulp-config')
const plugins = require('gulp-load-plugins')()
const compass = require('compass-importer')
const autoprefixer = require("autoprefixer")
const cssnano = require("cssnano")
const t2 = require('through2')
const pluginConfig = require('../plugin-config')
// const mainNodeFiles = require('gulp-main-node-files');
// const mainNodeCss = mainNodeFiles(pluginConfig.mainFilesConfig);

const includePaths = [
    '../gulp/node_modules/bootstrap/scss/',

];

const compileStyles = () => {

    let sassFiles = [config.paths.styles.src + '**/*.scss'];

    return gulp
        .src(sassFiles)
        // .pipe(plugins.debug({
        // 	minimal: false
        // }))
        // .pipe(plugins.sourcemaps.init())
        .pipe(plugins.sass({
            importer: compass,
            outputStyle: 'compressed',
            includePaths: includePaths
        }))
        // .pipe(plugins.sourcemaps.write('./sourcemaps'))
        .pipe(t2.obj((chunk, enc, cb) => { // Execute through2
            let date = new Date();
            chunk.stat.atime = date;
            chunk.stat.mtime = date;
            cb(null, chunk);
        }))
        .pipe(gulp.src(pluginConfig.pluginsCss), {
            passthrough: true
        })
        .pipe(plugins.concat('app.css'))
        .pipe(plugins.postcss([autoprefixer(), cssnano()]))

        // .on("error", plugins.sass.logError)
        .pipe(gulp.dest(config.paths.styles.dest));



}

module.exports = compileStyles;
