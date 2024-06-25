const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .react()
    .sass('resources/sass/app.scss', 'public/css');

    const mix = require('laravel-mix');

    mix.js('resources/js/app.js', 'public/js')
       .postCss('resources/css/app.css', 'public/css', [
           //
       ])
       .autoload({
           jquery: ['$', 'window.jQuery'], // Ajoutez cette ligne pour charger automatiquement jQuery
       });

      