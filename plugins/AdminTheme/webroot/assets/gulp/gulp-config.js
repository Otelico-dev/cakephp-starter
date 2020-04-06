const config = {
    vendorDir: './node_modules',
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
    },
    browser: '/opt/firefox_dev/firefox',
    proxy: 'cakephp-starter.local'
};

// export default config
module.exports = config;
