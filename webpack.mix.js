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

mix.react('resources/js/app.js', 'public/js')
    .copyDirectory('resources/img', 'public/img')
    .copyDirectory('resources/js/ckeditor', 'public/js/ckeditor')
    .sass('resources/sass/app.scss', 'public/css');

// mix.browserSync('generator.local');

if (mix.inProduction()) {
    mix.version();
}
