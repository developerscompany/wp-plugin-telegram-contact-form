

let mix = require("laravel-mix");
const path = require("path");

var LiveReloadPlugin = require('webpack-livereload-plugin');
mix.webpackConfig({
    plugins: [new LiveReloadPlugin()]
});

mix.setPublicPath('assets/dist');
mix.setResourceRoot('/wp-content/plugins/wp-plugin-telegram-contact-form/assets/dist');

mix.alias({
    '~src': path.resolve(__dirname, './assets/src'),
    '~scss': path.resolve(__dirname, './assets/src/scss'),
    '~images': path.resolve(__dirname, './assets/src/images/'),
    '~fonts': path.resolve(__dirname, './assets/src/fonts/')
});

mix.sass('assets/src/scss/admin.scss', 'assets/dist/css').version().sourceMaps(false, 'source-map');

mix.js('assets/src/js/admin.js', 'assets/dist/js')
    .version()
    .vue({version: 2, extractStyles: true})
    .sourceMaps(false, 'source-map');
