// Deep Breaths //
//////////////////

	// Gulp
	var gulp = require('gulp');

	// Sass/CSS stuff
	var sass = require('gulp-sass');
	var prefix = require('gulp-autoprefixer');
	var minifycss = require('gulp-minify-css');


	// Stats and Things
	var size = require('gulp-size');

//

	// compile all your Sass
		gulp.task('sass', function (){
			gulp.src(['./css/*.scss', '!./dev/sass/_variables.scss'])
				.pipe(sass({
					includePaths: ['./css'],
					outputStyle: 'expanded'
				}))
				.pipe(prefix(
					"last 1 version", "> 1%", "ie 8", "ie 7"
					))
				.pipe(gulp.dest('./css'))
				.pipe(minifycss())
				.pipe(gulp.dest('./css'));
		});


	// Stats and Things
		gulp.task('stats', function () {
			gulp.src('./prod/**/*')
			.pipe(size())
			.pipe(gulp.dest('./prod'));
		});

//

	gulp.task('default', function(){

		// watch me getting Sassy
		gulp.watch("*/**/*.scss", function(event){
			gulp.run('sass');
		});
	});