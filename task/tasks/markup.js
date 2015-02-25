var gulp = require( 'gulp' )
,   changed = require( 'gulp-changed' )
,   config = require( '../configs/config' )

gulp.task( 'markup', function() {
    return gulp.src( config.markup.src )
        .pipe( changed( config.markup.dest ) )
        .pipe( gulp.dest( config.markup.dest ) );
});