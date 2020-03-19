const gulp = require('gulp');
const config = require('../gulp-config')
const plugins = require('gulp-load-plugins')()
const pluginConfig = require('../plugin-config')
const mainNodeFiles = require('gulp-main-node-files');
// const terser = require('gulp-terser');
const pluginJs = mainNodeFiles(pluginConfig.mainFilesConfig);

const scripts = () => {

    let jsFiles = [config.paths.scripts.src + '**/*.js'];

    console.log(pluginJs);

    return gulp.src(pluginJs)
        .pipe(gulp.src(jsFiles), {
            passthrough: true
        })
        .pipe(plugins.concat('app.js'))
        .pipe(plugins.terser())
        .pipe(gulp.dest(config.paths.scripts.dest));
}

module.exports = scripts;
