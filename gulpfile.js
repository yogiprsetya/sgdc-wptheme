// Konfigurasi
var gulp  = require('gulp')
    sass = require('gulp-sass')
    browserSync = require('browser-sync').create()
    reload = browserSync.reload
    plumber = require('gulp-plumber')
    notify = require('gulp-notify')
    concat = require('gulp-concat')
    terser = require('gulp-terser')

gulp.task('sass', () => {
    var onError = function(err) {
        notify.onError({
            title: "Gulp",
            subtitle: "Failure!",
            message: "Error: <%= error.message %>",
            sound: "Beep"
        })(err);

      this.emit('end');
    };

    return gulp.src('./app/scss/**/*.scss')
        .pipe(plumber({errorHandler: onError}))
        .pipe(sass({ outputStyle: 'compressed' }))
        .pipe(concat('style.css'))
        .pipe(gulp.dest('./sgdc'))
        .pipe(notify({
            title: 'Gulp',
            subtitle: 'success',
            message: 'Sass task success'
        })
    );
});

// gulp.task('js', () => {
//     gulp.src('./app/js/*.js')
//     .pipe(concat('all.min.js'))
//     .pipe(terser())
//     .pipe(gulp.dest('./sgdc/js'));
// });

// Default Task. Local webserver dan sinkronisasi dengan browser.
gulp.task('default', () => {
    browserSync.init({
        proxy: "http://localhost/sgdc"
    });
    gulp.watch('./app/scss/**/*.scss', gulp.series(['sass']));
    // gulp.watch('./app/js/*.js', gulp.series(['js']));
    gulp.watch('./**/*').on('change', reload);
});
