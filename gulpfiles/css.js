const paths = require("../.config.json").paths;
const gulp = require("gulp");
const sourcemaps = require("gulp-sourcemaps");
const autoprefixer = require("gulp-autoprefixer");
const sass = require("gulp-dart-sass");
const argv = require("yargs").argv;

gulp.task("css:clean", () => {
	const del = require("del");
	return del([paths.dist_css]);
});

gulp.task("css:watch", () => {
	gulp.watch(
		[paths.src_css + "/**/*.scss", paths.components + "/**/*.scss"],
		gulp.parallel("css:compile")
	);
});

gulp.task("css:compile", () => {
	return gulp
		.src(paths.src_css + "/**/*.{sass,scss}")
		.pipe(sourcemaps.init())
		.pipe(
			sass({
				outputStyle: argv.minify ? "compressed" : "expanded",
				includePaths: [
					"./node_modules",
					paths.src_css,
					paths.components_blocks,
				],
			}).on("error", sass.logError)
		)
		.pipe(autoprefixer())
		.pipe(sourcemaps.write("."))
		.pipe(gulp.dest(paths.dist_css));
});

gulp.task("css", gulp.series("css:clean", "css:compile"));
