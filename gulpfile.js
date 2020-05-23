
var gulp         = require( 'gulp' );

// CSS related plugins
var sass         = require( 'gulp-sass' );
var autoprefixer = require( 'gulp-autoprefixer' );
var minifycss    = require( 'gulp-uglifycss' );

// JS related plugins
var concat       = require( 'gulp-concat' );
var uglify       = require( 'gulp-uglify' );
var babelify     = require( 'babelify' );
var browserify   = require( 'browserify' );
var source       = require( 'vinyl-source-stream' );
var buffer       = require( 'vinyl-buffer' );
var stripDebug   = require( 'gulp-strip-debug' );

// Utility plugins
var rename       = require( 'gulp-rename' );
var sourcemaps   = require( 'gulp-sourcemaps' );
var notify       = require( 'gulp-notify' );
var plumber      = require( 'gulp-plumber' );
var options      = require( 'gulp-options' );
var gulpif       = require( 'gulp-if' );

// Browers related plugins
var browserSync  = require( 'browser-sync' ).create();
var reload       = browserSync.reload;

// Project related variables
var projectURL   = 'http://localhost/wordpress/wp-admin/admin.php?page=ronash_plugin';

var styleSRC     = './src/scss/mystyle.scss';
var styleURL     = './assets/';
var mapURL       = './';

var jsSRC        = './src/js/myscript.js';
var jsURL        = './assets/';

var styleWatch   = './src/scss/**/*.scss';
var jsWatch      = './src/js/**/*.js';
var phpWatch     = './**/*.php';

// Tasks
gulp.task( 'browser-sync', function(done) {
    browserSync.init({
       /* proxy: projectURL,
        injectChanges: true,*/
        notify:true,
        open: false,
        https:false
    });
    done();
});

gulp.task( 'styles', function(done) {
    gulp.src( styleSRC, { allowEmpty: true } )
        .pipe( sourcemaps.init() )
        .pipe( sass({
            errLogToConsole: true,
            outputStyle: 'compressed'
        }) )
        .on( 'error', console.error.bind( console ) )
        .pipe( autoprefixer({ browsers: [ 'last 2 versions', '> 5%', 'Firefox ESR' ] }) )
        .pipe( sourcemaps.write( mapURL ) )
        .pipe( gulp.dest( styleURL ) )
        .pipe( browserSync.stream() );
    done();
});

gulp.task( 'js', function() {
    return browserify({
        entries: [jsSRC]
    })
        .transform( babelify, { presets: [ 'env' ] } )
        .bundle()
        .pipe( source( 'myscript.js' ) )
        .pipe( buffer() )
        .pipe( gulpif( options.has( 'production' ), stripDebug() ) )
        .pipe( sourcemaps.init({ loadMaps: true }) )
        .pipe( uglify() )
        .pipe( sourcemaps.write( '.' ) )
        .pipe( gulp.dest( jsURL ) )
        .pipe( browserSync.stream() );

});

function triggerPlumber( src, url ) {
    return gulp.src( src, { allowEmpty: true } )
        .pipe( plumber() )
        .pipe( gulp.dest( url ) );
}

gulp.task( 'default',gulp.series( ['styles', 'js'], function(done) {
    gulp.src( jsURL + 'myscript.min.js', { allowEmpty: true } )
        .pipe( notify({ message: 'Assets Compiled!' }) );

    done();

}));

gulp.task( 'watch', gulp.series(['default', 'browser-sync'], function(done) {
    gulp.watch( phpWatch, gulp.series(reload) );
    gulp.watch( styleWatch, gulp.series([ 'styles' ]) );
    gulp.watch( jsWatch, gulp.series([ 'js', reload ] ));
    gulp.src( jsURL + 'myscript.min.js', { allowEmpty: true } )
        .pipe( notify({ message: 'Gulp is Watching, Happy Coding!' }) );
    done();
}));