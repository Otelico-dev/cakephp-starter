const config = require('./gulp-config')
// config.vendorDir
const pluginsJs = [
    // config.vendorDir + '/@fancyapps/fancybox/dist/jquery.fancybox.min.js',
    // config.vendorDir + '/datatables.net/js/jquery.dataTables.min.js',
    // config.vendorDir + '/datatables.net-bs4/js/dataTables.bootstrap4.min.js'
];

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

const pluginsCss = [

    config.vendorDir + '/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
    config.vendorDir + '/@fancyapps/fancybox/dist/jquery.fancybox.min.css',
    config.vendorDir + '/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
    config.vendorDir + '/pickadate/lib/themes/default.css',
    config.vendorDir + '/pickadate/lib/themes/default.date.css',
    config.vendorDir + '/pickadate/lib/themes/default.time.css',
    config.vendorDir + '/selectize/dist/css/selectize.css',
    config.vendorDir + '/selectize/dist/css/selectize.bootstrap3.css'


];

module.exports = {
    pluginsJs: pluginsJs,
    mainFilesConfig: mainFilesConfig,
    pluginsCss: pluginsCss
}
