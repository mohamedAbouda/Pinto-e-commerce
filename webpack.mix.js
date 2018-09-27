const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/products/search.js', '../assets/site/js/products');
mix.js('resources/assets/js/cart/cart.js', '../assets/site/js/cart');
