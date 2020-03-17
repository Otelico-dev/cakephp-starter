const config = require('./gulp-config')
// config.vendorDir
const pluginsJs = [
    // config.vendorDir + '/@fancyapps/fancybox/dist/jquery.fancybox.min.js',
    // config.vendorDir + '/datatables.net/js/jquery.dataTables.min.js',
    // config.vendorDir + '/datatables.net-bs4/js/dataTables.bootstrap4.min.js'
];

const pluginsCss = [

    config.vendorDir + '/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
    config.vendorDir + '/@fancyapps/fancybox/dist/jquery.fancybox.min.css',
    config.vendorDir + '/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
    config.vendorDir + '/datedropper/datedropper.min.css'

];

module.exports = {
    pluginsJs: pluginsJs,
    pluginsCss: pluginsCss
}
