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
    .postCss('resources/css/material-dashboard.css', 'public/css', [
        //
    ])  
    // .postCss('resources/css/admin.css', 'public/css')
    // .js('resources/js/admin/admin.js', 'public/js');

    mix
    .js(["resources/js/admin/admin.js"], "public/js")
    .sass("resources/sass/admin/admin.scss", "public/css")
    .vue();

if (mix.inProduction()) {
  mix.version();
}