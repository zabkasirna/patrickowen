var gulp       = require('gulp')
,   changed    = require('gulp-changed')
,   imagemin   = require('gulp-imagemin')
,   config     = require( '../configs/config' );

gulp.task('image', function() {
  return gulp.src(config.images.src)
    .pipe(changed(config.images.dest)) // Ignore unchanged files
    // .pipe(imagemin()) // Optimize
    .pipe(gulp.dest(config.images.dest));
});