let mix = require('laravel-mix').mix;

let publicPath = './../backend/public/';

mix.setPublicPath(publicPath);
mix
    .js('src/page/auth/login.js', publicPath + 'dist/js/page/login.js')
    .js('src/page/auth/register.js', publicPath + 'dist/js/page/register.js')
    .js('src/page/main.js', publicPath + 'dist/js/page/main.js')
    .js('src/page/main-authorized.js', publicPath + 'dist/js/page/main-authorized.js')
    .extract([
        'vue',
    ], publicPath + 'dist/js/page/vendor.js')
    .version()
    .sourceMaps();
