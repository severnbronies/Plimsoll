const config = require("../.config.json");
const paths = config.paths;

const gulp = require("gulp");
const browserify = require("browserify");
const sourcemaps = require("gulp-sourcemaps");
const argv = require("yargs").argv;
const gulpif = require("gulp-if");
const vinylSource = require("vinyl-source-stream");
const vinylBuffer = require("vinyl-buffer");
const uglify = require("gulp-uglify");

gulp.task("js:clean", () => {
	const del = require("del");
	return del([paths.dist_js]);
});

gulp.task("js:watch", () => {
	gulp.watch(
		[paths.src_js + "/**/*.js", paths.components + "/**/*.js"],
		gulp.parallel("js:compile")
	);
});

gulp.task("js:compile", () => {
	const b = browserify({
		entries: [paths.src_js + "/all.js"],
		standalone: config.namespace,
	});
	return b
		.transform("babelify", { presets: ["@babel/preset-env"] })
		.bundle()
		.pipe(vinylSource("all.js"))
		.pipe(vinylBuffer())
		.pipe(sourcemaps.init({ loadMaps: true }))
		.pipe(gulpif(argv.minify, uglify()))
		.pipe(sourcemaps.write("."))
		.pipe(gulp.dest(paths.dist_js));
});

gulp.task("js", gulp.series("js:clean", "js:compile"));
