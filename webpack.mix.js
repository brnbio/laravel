const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js');
mix.sass('resources/sass/app.scss', 'public/css');

mix.sourceMaps(false);
if (mix.inProduction()) {
    mix.version();
}