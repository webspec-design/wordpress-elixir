// Gulp
var gulp = require('gulp');

// Plugins
var autoprefix = require('gulp-autoprefixer');
var browserSync = require('browser-sync');
var concat = require('gulp-concat');
var cache = require('gulp-cache');
var del = require('del');
var imagemin = require('gulp-imagemin');
var jshint = require('gulp-jshint');
var minifyCSS = require('gulp-minify-css');
var notify = require('gulp-notify'); // requires Growl on Windows
var plumber = require('gulp-plumber');
var rename = require('gulp-rename');
var runSequence = require('run-sequence');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');

// Define our paths
var paths = {
	scripts: 'js/**/*.js',
	styles: 'sass/**/*.scss',
	fonts: 'sass/fonts/*',
	images: 'img/**/*.{png,jpg,jpeg,gif,svg}'
};

var destPaths = {
	scripts: 'build/js',
	styles: 'build/css',
	fonts: 'build/fonts',
	images: 'build/img/',
	html: 'build/validated'
};

// Error Handling
// Send error to notification center with gulp-notify
var handleErrors = function() {
	notify.onError({
		title: "Compile Error",
		message: "<%= error.message %>"
	}).apply(this, arguments);
	this.emit('end');
};

// Compile our Sass
gulp.task('styles', function() {
	return gulp.src(paths.styles)
		.pipe(plumber())
		.pipe(sass({errLogToConsole:true}))
		.pipe(autoprefix())
		.pipe(gulp.dest(destPaths.styles))
		.pipe(notify('Styles task complete!'));
});

// Compile our Sass
gulp.task('build-styles', function() {
	return gulp.src(paths.styles)
		.pipe(plumber())
		.pipe(sass({errLogToConsole:true}))
		.pipe(autoprefix({cascade:false}))
		.pipe(minifyCSS())
		//.pipe(rename('main.css'))
		.pipe(gulp.dest(destPaths.styles))
		.pipe(notify('Build styles task complete!'));
});


// Lint, minify, and concat our JS
gulp.task('scripts', function() {
	return gulp.src(paths.scripts)
		.pipe(plumber())
		.pipe(jshint())
		.pipe(jshint.reporter('default'))
		.pipe(uglify())
		.pipe(concat('main.min.js'))
		.pipe(gulp.dest(destPaths.scripts))
		.pipe(notify('Scripts tasks complete!'));
});

gulp.task('clean-images', function(cb) {
	del([destPaths.images], cb);
})

// Compress Images
gulp.task('images', ['clean-images'], function() {
	return gulp.src(paths.images)
		.pipe(plumber())
		.pipe(gulp.dest(destPaths.images))
		.pipe(notify('Image optimized!'));
});

// Compress Images for Build
gulp.task('build-images', function() {
	return gulp.src(paths.images)
		.pipe(plumber())
		.pipe(imagemin({
			progressive: true,
			interlaced: true
		}))
		.pipe(gulp.dest(destPaths.images))
		.pipe(notify('Image optimized!'));
});

// Watch for changes made to files
gulp.task('watch', function() {
	gulp.watch(paths.scripts, ['scripts']);
	gulp.watch(paths.styles, ['styles']);
	gulp.watch(paths.images, ['images']);
});

// Browser Sync - autoreload the browser
// Additional Settings: http://www.browsersync.io/docs/options/
gulp.task('browser-sync', function () {
	var files = [
		'**/*.html',
		'**/*.php',
		'build/css/main.css',
		'build/js/main.min.js',
		'build/img/**/*.{png,jpg,jpeg,gif}'
	];
	browserSync.init(files, {
		//server: {
			//baseDir: './'
		//},
		proxy: 'http://10.10.10.116/[site-name-here]', // Proxy for local dev sites
		// port: 5555, // Sets the port in which to serve the site
		// open: false // Stops BS from opening a new browser window
	});
});

gulp.task('clean', function(cb) {
	//return gulp.src('build').pipe(clean());
	del(['build'], cb);
});

gulp.task('clear-cache', function() {
	cache.clearAll();
});

gulp.task('move-fonts', function() {
	gulp.src(paths.fonts)
	.pipe(gulp.dest(destPaths.fonts));
});

// Default Task
gulp.task('default', function(cb) {
	runSequence('clean', 'clear-cache', 'images', 'scripts', 'styles', 'move-fonts', 'watch', cb);
});

// Build Task
gulp.task('build', function(cb) {
	runSequence('clean', 'clear-cache', 'build-images', 'scripts', 'build-styles', 'move-fonts', cb);
});
