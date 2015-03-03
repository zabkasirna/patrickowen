/** ------------------------------------------------------------------------- *\
 *  WATCHERS
 ** ------------------------------------------------------------------------- */

var gulp = require('gulp')
,   config = require('../configs/config')


gulp.task( 'watch', function() {
    gulp.watch(config.markup.template.src, ['markups']);
    gulp.watch(config.markup.plugin.src, ['markups']);
    gulp.watch(config.style.src+ '**/*.scss', ['styles']);

});
