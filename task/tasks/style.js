/** ------------------------------------------------------------------------- *\
 *  STYLE
 ** ------------------------------------------------------------------------- */


var gulp         = require('gulp')
,   config       = require('../configs/config')
,   errors       = require('../utils/error-handler')
,   sass         = require('gulp-sass')
,   autoprefixer = require('gulp-autoprefixer')
,   size         = require('gulp-size')
,   gulpif       = require('gulp-if')
,   sourcemaps   = require('gulp-sourcemaps')
;

gulp.task('style', function() {

    var file = 'style';

    return gulp.src( config.style.src + file + '.scss' )
        .pipe(sourcemaps.init())
        .pipe(autoprefixer({
            browsers: 'last 2 versions',
        }))
        .pipe( sass() )
        .pipe(sourcemaps.write('./maps'))
        .on( 'error', errors )
        .pipe(gulp.dest( config.style.dest ))
        .pipe( size( { title: config.style.dest + file + '.css' } ) )
    ;
});
