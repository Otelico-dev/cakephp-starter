const config = require('./gulp-config')
const mainFilesConfig = {
    order: {
        'jquery': 1
    },
    overrides: {
        'bootstrap': [
            // "dist/js/bootstrap.js"
        ],
        'pickadate': [
            'lib/picker.js',
            'lib/picker.date.js',
            'lib/picker.time.js'
        ],
        'selectize': [
            'dist/js/standalone/selectize.min.js'
        ],
        'multi-step-bootstrap-form-with-animations': [
            'dist/script.js'
        ]
    }
};

const pluginsJs = [


];

const pluginsCss = [

    config.vendorDir + '/@fancyapps/fancybox/dist/jquery.fancybox.min.css',
    config.vendorDir + '/pickadate/lib/themes/default.css',
    config.vendorDir + '/pickadate/lib/themes/default.date.css',
    config.vendorDir + '/pickadate/lib/themes/default.time.css',
    config.vendorDir + '/owl.carousel/dist/assets/owl.carousel.min.css',
    config.vendorDir + '/owl.carousel/dist/assets/owl.theme.default.min.css'

];

module.exports = {
    pluginsJs: pluginsJs,
    mainFilesConfig: mainFilesConfig,
    pluginsCss: pluginsCss
}
