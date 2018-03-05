var dir, elixir = require('laravel-elixir');

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

dir = {
  asset: {
    css: 'public/css',
    img: 'public/img',
    js: 'public/js'
  },
  vendor: 'vendor/bower_components'
};

elixir(function(mix) {
  mix.scripts([
    'libs/jquery.min.js',
    'libs/jquery-ui.min.js',
    'libs/bootstrap.min.js',
    'libs/dropzone.min.js',
    'libs/moment.min.js',
    'libs/sweetalert.min.js',
    'libs/bootstrap-editable.min.js',
    'libs/bootstrap-markdown.js',
    'libs/bootstrap-toggle.min.js',
    'libs/bootstrap-datetimepicker.min.js',
    'libs/markdown.js',
    'libs/to-markdown.js',
    'libs/select2.min.js',
    'libs/bootstrap-show-password.min.js',
    'libs/show-password.min.js',
    'libs/speakingurl.min.js',
    'libs/jquery.lazyload.min.js',
    'libs/jstree.min.js',
    'app.js'
  ]).styles([
        'libs/bootstrap.min.css',
        'libs/jquery-ui.min.css',
        'libs/dropzone.min.css',
        'libs/font-awesome.min.css',
        'libs/sweetalert.css',
        'libs/bootstrap-editable.css',
        'libs/bootstrap-markdown.min.css',
        'libs/bootstrap-toggle.min.css',
        'libs/select2.css',
        'libs/select2-bootstrap.css',
        'libs/bootstrap-datetimepicker.min.css',
        'libs/jstree.min.css',
        'app.css'
      ])
      .copy('resources/assets/fonts/libs/font-awesome/', 'public/fonts')
      .copy('resources/assets/fonts/libs/bootstrap/', 'public/fonts')
      .copy('resources/assets/img/libs/', 'public/css')
      .copy('resources/assets/js/libs/html5.js', 'public/js');
});
