

let mix = require("laravel-mix");
const path = require("path");

mix.setPublicPath('assets/dist');
mix.setResourceRoot('/wp-content/plugins/wp-plugin-telegram-contact-form-main/assets/dist');

mix.alias({
    '~images': path.resolve(__dirname, './assets/src/images/')
});

mix.sass('assets/src/scss/admin.scss', 'assets/dist/css').version().sourceMaps(false, 'source-map');

mix.js('assets/src/js/admin.js', 'assets/dist/js').version().sourceMaps(false, 'source-map');
mix.js('assets/src/js/admin-bot.js', 'assets/dist/js').version().sourceMaps(false, 'source-map');
mix.js('assets/src/js/admin-integrations.js', 'assets/dist/js').version().sourceMaps(false, 'source-map');
mix.js('assets/src/js/admin-notifications.js', 'assets/dist/js').version().sourceMaps(false, 'source-map');