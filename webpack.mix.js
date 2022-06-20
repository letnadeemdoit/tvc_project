const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .sass('resources/sass/app.scss', 'public/css/bootstrap.css')
    .sass('resources/sass/front-dashboard-v2/theme.scss', 'public/css')
    .sass('resources/sass/front-dashboard-v2/theme-dark.scss', 'public/css')
    .sourceMaps();

if (mix.inProduction()) {
    mix.version();
}
