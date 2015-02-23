/** Original: https://github.com/whatwedo/gulp-wp-theme */

var fs   = require('fs')
,   gutil = require('gulp-util')
,   packageConfig = require('../../package.json');

var root = '.'
,   src = root + '/src'
,   dest = root + '/content/themes/' + packageConfig.name;

module.exports = {
    browserSync: {
        server: {
            baseDir: [dest]
        },
        open: false,
        files: [
            dest + "/**",
            // Exclude Map files
            "!" + dest + "/**.map"
        ]
    },

    images: {
        src: src + "/resources/images/**",
        dest: dest + "/uploads/images"
    },

    substituter: {
        enabled: true,
        cdn: '',
        js: '<script src="{cdn}/{file}"></script>',
        css: '<link rel="stylesheet" href="{cdn}/{file}">'
    },

    markup: {
        src: src + '/templates/**/*.php',
        dest: dest
    },

    copy: {
        // Meta files e.g. Screenshot for WordPress Theme Selector
        meta: {
            src: src + '/*.*',
            dest: dest
        }
    },

    browserify: {
        // Enable source maps
        debug: true,
    
        // Additional file extentions to make optional
        extensions: ['.coffee', '.hbs'],

        // A separate bundle will be generated for each
        // bundle config in the list below
        bundleConfigs: [{
            entries: src + '/resources/scipts/index.js',
            dest: dest,
            outputName: 'app.js'
        ]}
    }
};
