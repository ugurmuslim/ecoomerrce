const {mix} = require('laravel-mix');
const CleanWebpackPlugin = require('clean-webpack-plugin');

// paths to clean
var pathsToClean = [
    'public/assets/app/js',
    'public/assets/app/css',
    'public/assets/admin/js',
    'public/assets/admin/css',
    'public/assets/auth/css',
];

// the clean options to use
var cleanOptions = {};

mix.webpackConfig({
    plugins: [
        new CleanWebpackPlugin(pathsToClean, cleanOptions),
    /*    new webpack.ProvidePlugin({
        '$': 'jquery',
        'jQuery': 'jquery',
        'window.jQuery': 'jquery',
    }),*/
    ]
});

mix.js([
 'node_modules/bootstrap/dist/js/bootstrap.js',
 'resources/assets/web/js/web.js',
], 'public/assets/web/js/web.js').version();

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

/*
 |--------------------------------------------------------------------------
 | Core
 |--------------------------------------------------------------------------
 |
 */

 mix.scripts([
     'node_modules/jquery/dist/jquery.js',
     'node_modules/pace-progress/pace.js',

 ], 'public/assets/app/js/app.js').version();

 mix.styles([
     'node_modules/font-awesome/css/font-awesome.css',
     'node_modules/pace-progress/themes/blue/pace-theme-minimal.css',
 ], 'public/assets/app/css/app.css').version();

 mix.copy([
     'node_modules/font-awesome/fonts/',
 ], 'public/assets/app/fonts');

 /*
  |--------------------------------------------------------------------------
  | Auth
  |--------------------------------------------------------------------------
  |
  */

 mix.styles('resources/assets/auth/css/login.css', 'public/assets/auth/css/login.css').version();
 mix.styles('resources/assets/auth/css/register.css', 'public/assets/auth/css/register.css').version();
 mix.styles('resources/assets/auth/css/passwords.css', 'public/assets/auth/css/passwords.css').version();

 mix.styles([
     'node_modules/bootstrap/dist/css/bootstrap.css',
     'node_modules/gentelella/vendors/animate.css/animate.css',
     'node_modules/gentelella/build/css/custom.css',
 ], 'public/assets/auth/css/auth.css').version();

 /*
  |--------------------------------------------------------------------------
  | Admin
  |--------------------------------------------------------------------------
  |
  */

 mix.scripts([
     'node_modules/bootstrap/dist/js/bootstrap.js',
     'node_modules/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
     'node_modules/gentelella/build/js/custom.js',
 ], 'public/assets/admin/js/admin.js').version();

 mix.styles([
     'node_modules/bootstrap/dist/css/bootstrap.css',
     'node_modules/gentelella/vendors/animate.css/animate.css',
     'node_modules/gentelella/build/css/custom.css',
 ], 'public/assets/admin/css/admin.css').version();

 mix.styles([
   'resources/assets/common/css/parsley.css',
 ], 'public/assets/common/css/parsley.css');

 mix.styles([
   'resources/assets/admin/css/dropzone.css',
 ], 'public/assets/admin/css/dropzone.css');



 mix.styles([
   'resources/assets/common/css/select2.min.css',
 ], 'public/assets/common/css/select2.min.css');

 mix.styles([
   'resources/assets/common/css/styles.css',
 ], 'public/assets/common/css/styles.css');


 mix.copy([
     'node_modules/gentelella/vendors/bootstrap/dist/fonts',
 ], 'public/assets/admin/fonts');


 mix.scripts([
     'node_modules/select2/dist/js/select2.full.js',
     'resources/assets/admin/js/users/edit.js',
 ], 'public/assets/admin/js/users/edit.js').version();

 mix.scripts([
   'resources/assets/common/js/parsley.min.js',
 ], 'public/assets/common/js/parsley.min.js');

 mix.scripts([
   'resources/assets/common/js/parsley-tr.js',
 ], 'public/assets/common/js/i18n/parsley-tr.js');


 mix.scripts([
   'resources/assets/common/js/select2.min.js',
 ], 'public/assets/common/js/select2.min.js');

 mix.scripts([
   'resources/assets/admin/js/dropzone.js',
 ], 'public/assets/admin/js/dropzone.js').version();



 mix.styles([
     'node_modules/select2/dist/css/select2.css',
 ], 'public/assets/admin/css/users/edit.css').version();

 mix.scripts([
     'node_modules/gentelella/vendors/Flot/jquery.flot.js',
     'node_modules/gentelella/vendors/Flot/jquery.flot.time.js',
     'node_modules/gentelella/vendors/Flot/jquery.flot.pie.js',
     'node_modules/gentelella/vendors/Flot/jquery.flot.stack.js',
     'node_modules/gentelella/vendors/Flot/jquery.flot.resize.js',

     'node_modules/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js',
     'node_modules/gentelella/vendors/DateJS/build/date.js',
     'node_modules/gentelella/vendors/flot.curvedlines/curvedLines.js',
     'node_modules/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js',

     'node_modules/gentelella/production/js/moment/moment.min.js',
     'node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js',


     'node_modules/gentelella/vendors/Chart.js/dist/Chart.js',
     'node_modules/jcarousel/dist/jquery.jcarousel.min.js',

     'resources/assets/admin/js/dashboard.js',
 ], 'public/assets/admin/js/dashboard.js').version();

 mix.styles([
     'node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css',
     'resources/assets/admin/css/dashboard.css',
 ], 'public/assets/admin/css/dashboard.css').version();


 /*
  |--------------------------------------------------------------------------
  | Frontend
  |--------------------------------------------------------------------------
  |
  */
