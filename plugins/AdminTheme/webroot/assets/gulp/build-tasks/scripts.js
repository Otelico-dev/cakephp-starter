const gulp = require('gulp');
const config = require('../gulp-config')
const plugins = require('gulp-load-plugins')()
const pluginConfig = require('../plugin-config')
const mainNodeFiles = require('gulp-main-node-files');
// const terser = require('gulp-terser');
const mainNodeJs = mainNodeFiles(pluginConfig.mainFilesConfig);

const scripts = () => {

    let pluginJs = pluginConfig.pluginsJs;
    let jsFiles = [config.paths.scripts.src + '**/*.js'];

    console.log(mainNodeJs);
    console.log(pluginJs);

    return gulp.src(mainNodeJs)
        .pipe(gulp.src(pluginJs), {
            passthrough: true
        })
        .pipe(gulp.src(jsFiles), {
            passthrough: true
        })
        .pipe(plugins.concat('app.js'))
        .pipe(plugins.terser())
        .pipe(gulp.dest(config.paths.scripts.dest));
}

module.exports = scripts;
