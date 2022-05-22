const paths = require("../.config.json").paths;
const gulp = require("gulp");
const gulplog = require("gulplog");
const newer = require("gulp-newer");
const imagemin = require("gulp-imagemin");

gulp.task("images:clean", () => {
	const del = require("del");
	return del([paths.dist_images]);
});

gulp.task("images:watch", () => {
	gulp.watch(paths.src_images + "/**/*", gulp.parallel("images"));
});

gulp.task("images:copy-logo", () => {
	return gulp
		.src(paths.src_images + "/logo.svg")
		.pipe(gulp.dest(paths.dist_images));
});

gulp.task(
	"images:minify",
	gulp.parallel("images:copy-logo", () => {
		return gulp
			.src([paths.src_images + "/**/*", "!" + paths.src_images + "/logo.svg"])
			.pipe(newer(paths.dist_images))
			.pipe(
				imagemin([
					imagemin.mozjpeg({
						progressive: true,
					}),
					imagemin.optipng({
						optimizationLevel: 5,
					}),
					imagemin.gifsicle({
						interlaced: true,
					}),
					imagemin.svgo({
						multipass: true,
						plugins: [
							{ convertShapeToPath: false },
							{ removeViewBox: false },
							{ removeDimensions: true },
							{ cleanupIDs: false },
						],
					}),
				])
			)
			.on("error", (ex) => {
				gulplog.error(ex);
				this.emit("end");
			})
			.pipe(gulp.dest(paths.dist_images));
	})
);

gulp.task("images", gulp.series("images:clean", "images:minify"));
