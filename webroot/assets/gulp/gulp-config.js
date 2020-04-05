const config = {
    vendorDir: './node_modules',
    proxy: 'alt-loc.local',
    browser: '/opt/firefox_dev/firefox',
    paths: {
        styles: {
            src: '../src/sass/',
            dest: '../dist/css/'
        },
        scripts: {
            src: '../src/js/',
            dest: '../dist/js/'
        },
        images: {
            src: '../src/img/',
            dest: '../dist/img/'
        }
    }
};

// export default config
module.exports = config;
