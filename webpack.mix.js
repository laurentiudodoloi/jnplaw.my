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

mix
    .react('resources/js/react-app.js', 'public/js')
    .js('resources/js/vue-app.js', 'public/js')
    .js('resources/js/bootstrap.js', 'public/js')
    .js('resources/js/page-text-floats.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/floating-animations.scss', 'public/css')
    .sass('resources/sass/bootstrap.scss', 'public/css')
    .sass('resources/sass/about.scss', 'public/css')
    .sass('resources/sass/videos-page.scss', 'public/css')
    .sass('resources/sass/general.scss', 'public/css')
    .sass('resources/sass/landing-page.scss', 'public/css')
    .sass('resources/sass/admin/admin-general.scss', 'public/css')
    .sass('resources/sass/admin/sidebar.scss', 'public/css')
    .sass('resources/sass/admin/navbar.scss', 'public/css');
