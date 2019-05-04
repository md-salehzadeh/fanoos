const mix = require('laravel-mix');

require('laravel-mix-tailwind');
require('laravel-mix-purgecss');


/* Allow multiple Laravel Mix applications*/
require('laravel-mix-merge-manifest');
mix.mergeManifest();
/*----------------------------------------*/


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
   .postCss('resources/css/app.css', 'public/css')
   .tailwind()
   .purgeCss();

mix
	.sass('resources/assets/sass/admin/main.scss', 'public/css/admin')
	.sass('resources/assets/sass/admin/rtl.scss', 'public/css/admin');

if (mix.inProduction()) {
  mix.version();
}

// mix.webpackConfig({
//     plugins: [
//         new webpack.ProvidePlugin({
// 			$: "jquery",
// 			jQuery: "jquery"
// 		})
//     ],
//     // list of additional plugins
// });