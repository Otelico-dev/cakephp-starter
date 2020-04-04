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
            'lib/picker.date.js'
        ],
        'selectize': [
            'dist/js/standalone/selectize.min.js'
        ]
    }
};


const pluginsJs = [
    config.vendorDir + '/bootstrap/js/dist/util.js',
    config.vendorDir + '/bootstrap/js/dist/tab.js',
    config.vendorDir + '/bootstrap/js/dist/collapse.js',

];


const pluginsCss = [


    config.vendorDir + '/@fancyapps/fancybox/dist/jquery.fancybox.min.css',
    config.vendorDir + '/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
    config.vendorDir + '/pickadate/lib/themes/default.css',
    config.vendorDir + '/pickadate/lib/themes/default.date.css',
    config.vendorDir + '/pickadate/lib/themes/default.time.css',
    config.vendorDir + '/selectize/dist/css/selectize.css',
    config.vendorDir + '/selectize/dist/css/selectize.bootstrap3.css',
    config.vendorDir + '/bootstrap4-toggle/css/bootstrap4-toggle.min.css'


];

module.exports = {
    pluginsJs: pluginsJs,
    mainFilesConfig: mainFilesConfig,
    pluginsCss: pluginsCss
}
