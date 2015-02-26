/** ------------------------------------------------------------------------- *\
 *  WATCHERS
 ** ------------------------------------------------------------------------- */

var gulp = require('gulp')
,   config = require('../configs/config')


gulp.task( 'watch', function() {
    gulp.watch(config.markup.src, ['markup']);
});