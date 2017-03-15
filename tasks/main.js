var env = require('./../env.json'),
    gulp = require('gulp'),
    elixir = require('laravel-elixir');

var gulplette = {
  hook_start: function(mix, args) {
  },
  hook_after_copy: function(mix, args) {
    //Use hooks to copy additional files or perform additional steps during your gulp workflow.
    // mix.copy('node_modules/slick-carousel/slick/ajax-loader.gif', 'build/css');
    // mix.copy('node_modules/slick-carousel/slick/fonts', 'build/css/fonts');
  },
  hook_end: function(mix, args) {
  },
};

var exports = module.exports = gulplette;
