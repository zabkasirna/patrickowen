/** ------------------------------------------------------------------------- *\
 *  STYLE
 ** ------------------------------------------------------------------------- */


var gulp         = require('gulp')
,   c            = require('../configs/config')
,   errors       = require('../utils/error-handler')
,   sass         = require('gulp-sass')
,   autoprefixer = require('gulp-autoprefixer')
,   size         = require('gulp-size')
,   gulpif       = require('gulp-if')
,   sourcemaps   = require('gulp-sourcemaps')
;

gulp.task('styles', function() {

    var main = 'po';

    return gulp.src(c.indir + c.styledir + main + '.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write('./maps'))
        .on('error', errors)
        // .pipe(autoprefixer("last 2 versions", "> 1%", "ie 8"))
        .pipe(gulp.dest(c.outdir + c.styledir))
        .pipe(size({ title: c.outdir + c.styledir + main + '.css' }))
    ;
});
