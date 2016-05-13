var elixir = require('laravel-elixir');
require('elixir-tinypng');
var env = require('./env.json');
var gulplette = require('./tasks/main.js');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.browserify('main.js');

    mix.sass('main.scss');

    mix.tinypng({
      key:env.tinyPngApiKey,
      sigFile:'.tinypng-sigs',
      log:true,
      summarize:true
    });

    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'build/fonts');
    mix.copy('node_modules/font-awesome/fonts', 'build/fonts');
    //Copy all non compressible images to build
    mix.copy('img/*.!(png|jpg)', 'build/img');

    gulplette(mix);

    mix.browserSync({
      proxy: env.bsProxy,
      files: [
        '**/*.php',
        'build/**/*'
      ]
    });
});
