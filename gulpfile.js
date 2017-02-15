var gulp = require('gulp'),
    watch = require('gulp-watch'),
    elixir = require('laravel-elixir');

// Get and render all .haml files recursively
gulp.task('haml', function () {
    gulp.src('./src/haml/*.haml')
        .pipe(haml())
        .pipe(gulp.dest('./dist'));
});

gulp.task('watch', function() {
    gulp.watch('src/js/*.js', ['js']);
});

gulp.run('watch');

elixir.config.assetsPath	= 'assets';
elixir.config.publicPath	= '/';
elixir.config.js.outputFolder = 'js';

elixir(function(mix) {
    mix.scripts('optivo_support.js', 'assets/js/optivo_support.js', 'src/js')
});