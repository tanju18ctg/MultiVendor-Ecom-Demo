const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/seller/seller.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/seller.scss', 'public/css');

    // mix.js('resources/js/admin.js', 'public/js')
    // .js('resources/js/app.js', 'public/js')
    // .sass('resources/sass/app.scss', 'public/css')
    // .sass('resources/sass/admin.scss', 'public/css');
