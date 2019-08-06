var gulp = require( "gulp" );
var sass = require( "gulp-sass" );
var prefixer = require( "gulp-autoprefixer" );
var pxtorem  = require( "gulp-pxtorem" );

gulp.task( "sass", function() {
  return gulp.src( "app/css/main.scss" )
    .pipe( sass().on( "error", sass.logError ) )
    .pipe( prefixer( "last 2 versions" ) )
    .pipe( pxtorem( {
      rootValue:16,
      propList: ['font', 'font-size', 'line-height', 'letter-spacing','padding', 'padding-top', 'padding-right', 'padding-bottom', 'padding-left', 'margin', 'margin-top', 'margin-right', 'margin-bottom', 'margin-left', 'width', 'height','border','border-radius', 'max-width', 'min-width', 'left', 'top', 'bottom', 'right'],
    } ) )
    .pipe( gulp.dest( "app/css" ) )
} );

gulp.task( "watch", function(){
	gulp.watch( "app/css/**/*.scss", gulp.series( "sass" ) );
} );