let mix = require('laravel-mix').mix;

let publicPath  = './../backend/public/';

mix.setPublicPath(publicPath);
// mix
//     .js('src/core/base.js', publicPath + 'dist/js/base.js')
//     .extract([
//         'vue',
//     ], publicPath + 'dist/js/page/vendor.js')
//     .version()
//     .sourceMaps();
