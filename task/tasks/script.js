/** ------------------------------------------------------------------------- *\
 * SCRIPTS
 ** ------------------------------------------------------------------------- */

var browserify = require('browserify')
,   watchify   = require('watchify')
,   c          = require('../configs/config')
,   errors     = require('../util/error-handler')
,   logger     = require('../util/bundle-logger')
,   gulp       = require('gulp')
,   source     = require('vinyl-source-stream')
,   stringify  = require('stringify')
,   size       = require('gulp-size')
;

gulp.task('scripts', ['lint'], function() {
    var file = 'app';

    var browserifyOptions = {
            entries    : [ c.indir + c.scriptdir + file ],
            extensions : [ '.js' ],
            debug      : true
        };

    var bundleStream = browserify( browserifyOptions ).transform( stringify(['.html']) );

    var bundle = function() {
        logger.start();

        return bundleStream.bundle()
            .on( 'error', errors )
            .pipe( source( file + '.js' ) )
            .pipe( gulp.dest( c.outdir + c.scriptdir ) )
            .on( 'update', bundle )
            .on( 'end', logger.end )
        ;
    }

    return bundle();
});

// var browserifyThis = function( callback, devmode ) {

//     var bundleStream = browserify( c.browserifyOptions )
//         .transform(stringify([ '.html' ]));

//     var reportDone = function() {
//         logger.end( devmode );
//     };

//     var bundle = function() {
//         logger.start( devmode );

//         return bundleStream
//             .bundle()
//             .on('error', errors)
//             .pipe(source('app.js'))
//             .pipe(gulp.dest(c.outdir + c.scriptdir))
//             .on('end', reportDone )
//         ;
//     };

//     if ( devmode ) {
//         bundleStream = watchify( bundleStream );

//         bundleStream.on('update', bundle);
//         logger.watch();
//     }

//     return bundle();
// }

// gulp.task('scripts', ['lint', 'templates'], browserifyThis);

// module.exports = browserifyThis;
