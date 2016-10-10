var gulp = require('gulp');
var gutil = require('gulp-util');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sourcemaps = require('gulp-sourcemaps');
var less = require('gulp-less');
var cleanCSS = require('gulp-clean-css');

gulp.task('default', ['scripts']);

var src = 'app/Resources/assets';

// Concatenate & Minify JS
gulp.task('scripts', function () {
  return gulp.src(src + '/js/*.js')
    .pipe(sourcemaps.init())
    .pipe(concat('combined.js'))
    .pipe(gutil.env.type === 'prod' ? uglify() : gutil.noop())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('web/js'));
});

// Compile less.
gulp.task('less', function () {
  return gulp.src(src + '/less/style.less')
    .pipe(less())
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(gulp.dest('web/css'));
});
