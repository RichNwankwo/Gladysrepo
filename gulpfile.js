var elixir = require('laravel-elixir');
    gulp = require('gulp'),
    jade = require('gulp-jade-php'),
    util = require('gulp-util');

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
    mix.sass('app.scss');
    gulp.task('jade', function(){
        gulp.src('resources/assets/jade/**/*.jade')
            .pipe(jade({
                pretty: !util.env.production
            }))
            .pipe(gulp.dest('resources/views/'));
    })
    mix.phpUnit();
    mix.coffee();
    mix.task('jade', 'resources/assets/jade/**/*.jade');
});
