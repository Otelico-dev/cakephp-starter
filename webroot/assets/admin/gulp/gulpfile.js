"use strict";

const gulp = require('gulp');
const config = require('./gulp-config')
const plugins = require('./plugin-config')
const del = require('del');
const styles = require("./build-tasks/styles")
const scripts = require("./build-tasks/scripts")
const images = require("./build-tasks/images")
const browserSync = require("browser-sync").create();

const browserSyncReload = (done) => {

    browserSync.reload();
    done();

}

const sync = (done) => {

    browserSync.init({
        browser: config.browser,
        proxy: config.proxy,
    });

    done();

}

const clean = () => {
    return del(["../dist/**"], {
        force: true
    });
}

const build = (done) => {

    gulp.series(
            clean,
            gulp.parallel(
                styles,
                scripts,
                images
            ))
        (done);

}

const watch = () => {

    return gulp.watch(
        [
            config.paths.styles.src + '**/*.scss',
            config.paths.scripts.src + '**/*.js',
            config.paths.images.src + '**/*',
            '../../../src/Template/**/*.ctp',
            '../../src/Controller/**/*.php'
        ],
        gulp.series(
            build,
            browserSyncReload
        )
    );

}

const run = gulp.series(
    build,
    sync,
    watch
);

exports.build = build;
module.exports.default = run;
