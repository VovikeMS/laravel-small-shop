const mix = require('laravel-mix');

mix.setResourceRoot(path.normalize('resources'));
mix.setPublicPath(path.normalize('public'));

mix.extract([
    'vue',
    'lodash',
    'axios',
    'jquery',
    'vue-template-compiler',
]);

mix.js('resources/js/app.js', 'public/dist').sourceMaps().version();
mix.sass('resources/sass/app.scss', 'public/dist').sourceMaps().version();
