var gulp = require('gulp');
var gutil = require('gulp-util');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sourcemaps = require('gulp-sourcemaps');

gulp.task('default', ['scripts']);

// Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src('web/js/*.js')
        .pipe(sourcemaps.init())
        	.pipe(concat('combined.js'))
        	//only uglify if gulp is ran with '--type prod'
        	.pipe(gutil.env.type === 'prod' ? uglify() : gutil.noop())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('web/js'));
});