const { src, dest, series, parallel, watch } = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const changed = require('gulp-changed');
const eslint = require('gulp-eslint');
const fs = require('fs');
const imagemin = require('gulp-imagemin');
const merge = require('merge2');
const sass = require('gulp-dart-sass');
const sassLint = require('gulp-sass-lint');
const sourcemaps = require('gulp-sourcemaps');
const packageJson = require('./package.json');

/**
 * ************************************
 * 1. Configs                         *
 *************************************
 */

// === Theme name === //
// Gets an array of all the theme names
const files = fs.readdirSync('custom/themes/');
const config = [];

// Removes hidden files and update the key value
// eslint-disable-next-line no-restricted-syntax
for (const value of files) {
	if (value.startsWith('.')) {
		// eslint-disable-next-line no-continue
		continue;
	}
	config.push({ themeName: value });
}

// === Custom === //
// overrides the dest path after the theme name
// ../docroot/wp-content/themes/themeName/customDest/*
const customDest = '';

/**
 * ************************************
 * 2. Build Tasks                     *
 *************************************
 */

function buildPhp() {
	const tasks = config.map((entry) =>
		src(`custom/themes/${entry.themeName}/**/*.php`).pipe(
			dest(`docroot/wp-content/themes/${entry.themeName}/${customDest}`)
		)
	);
	return merge(tasks);
}

function buildSass() {
	const tasks = config.map((entry) =>
		src(`custom/themes/${entry.themeName}/src/scss/**/*.scss`)
			.pipe(sourcemaps.init())
			.pipe(
				sass({
					noCache: true,
					outputStyle: 'compressed',
					lineNumbers: false,
					includePaths: [],
					sourceMap: true,
				})
			)
			.pipe(
				autoprefixer({
					overrideBrowsersList: packageJson.browserslist,
				})
			)
			.pipe(sourcemaps.write('./maps'))
			.pipe(
				dest(
					`docroot/wp-content/themes/${entry.themeName}/assets/${customDest}/css`
				)
			)
	);
	return merge(tasks);
}

function buildCss() {
	const tasks = config.map((entry) =>
		src(`custom/themes/${entry.themeName}/src/scss/**/*.scss`)
			.pipe(sourcemaps.init())
			.pipe(
				sass({
					noCache: true,
					outputStyle: 'compressed',
					lineNumbers: false,
					includePaths: [],
					sourceMap: true,
				})
			)
			.pipe(
				autoprefixer({
					overrideBrowsersList: packageJson.browserslist,
				})
			)
			.pipe(sourcemaps.write('./maps'))
			.pipe(
				dest(
					`docroot/wp-content/themes/${entry.themeName}/assets/${customDest}/css`
				)
			)
	);
	return merge(tasks);
}

function buildJavascript() {
	const tasks = config.map((entry) =>
		src(`custom/themes/${entry.themeName}/src/js/**/*.js`)
			.pipe(sourcemaps.init())
			.pipe(
				changed(
					`docroot/wp-content/themes/${entry.themeName}/assets/${customDest}/js`
				)
			)
			.pipe(sourcemaps.write('./maps'))
			.pipe(
				dest(
					`docroot/wp-content/themes/${entry.themeName}/assets/${customDest}/js`
				)
			)
	);

	return merge(tasks);
}

function buildImages() {
	const tasks = config.map((entry) =>
		src(`custom/themes/${entry.themeName}/src/images/**/*`)
			.pipe(
				changed(
					`docroot/wp-content/themes/${entry.themeName}/assets/${customDest}/images`
				)
			)
			// Errors out on new M! architecture. Need to fix.
			// .pipe( imagemin( { progressive: true } ) )
			.pipe(
				dest(
					`docroot/wp-content/themes/${entry.themeName}/assets/${customDest}/images`
				)
			)
	);

	return merge(tasks);
}

function buildFonts() {
	const tasks = config.map((entry) =>
		src(`custom/themes/${entry.themeName}/src/fonts/**/*`)
			.pipe(
				changed(
					`docroot/wp-content/themes/${entry.themeName}/assets/${customDest}/fonts`
				)
			)
			.pipe(
				dest(
					`docroot/wp-content/themes/${entry.themeName}/assets/${customDest}/fonts`
				)
			)
	);

	return merge(tasks);
}

/**
 * ************************************
 * 3. Testing Tasks                   *
 *************************************
 */

function testSassLint() {
	const tasks = config.map((entry) =>
		src(`custom/themes${entry.themeName}/src/scss/**/*.scss`)
			.pipe(sassLint({ sasslintConfig: '.sass-lint.yml' }))
			.pipe(sassLint.format())
			.pipe(sassLint.failOnError())
	);

	return merge(tasks);
}

function testJsLint() {
	const tasks = config.map((entry) =>
		src([
			`custom/themes/${entry.themeName}/src/js/*.js`,
			`!custom/themes/${entry.themeName}/src/js/lib/*.js`,
		])
			.pipe(eslint())
			.pipe(eslint.format())
			.pipe(eslint.failAfterError())
	);

	return merge(tasks);
}

/**
 * ************************************
 * 4. Watchers                        *
 *************************************
 */

function watchSass() {
	// eslint-disable-next-line array-callback-return
	config.map((entry) => {
		watch(
			`custom/themes${entry.themeName}/src/scss/**/*.scss`,
			{
				usePolling: true,
				interval: 1000,
			},
			series(buildSass, testSassLint)
		);
	});
}

function watchJavascript() {
	// eslint-disable-next-line array-callback-return
	config.map((entry) => {
		watch(
			`custom/themes/${entry.themeName}/src/js/**/*.js`,
			{
				usePolling: true,
				interval: 1000,
			},
			series(buildJavascript, testJsLint)
		);
	});
}

function watchImages() {
	// eslint-disable-next-line array-callback-return
	config.map((entry) => {
		watch(
			`themes/custom/${entry.themeName}/src/images/**/*`,
			{ usePolling: true, interval: 1000 },
			buildImages
		);
	});
}

function watchFonts() {
	// eslint-disable-next-line array-callback-return
	config.map((entry) => {
		watch(
			`themes/custom/${entry.themeName}/src/fonts/**/*`,
			{ usePolling: true, interval: 1000 },
			buildFonts
		);
	});
}

function watchPhp() {
	// eslint-disable-next-line array-callback-return
	config.map((entry) => {
		watch(
			`custom/themes/${entry.themeName}/**/*.php*`,
			{ usePolling: true, interval: 1000 },
			buildPhp
		);
	});
}

/**
 * ************************************
 * 5. Exports                         *
 *************************************
 */

// eslint-disable-next-line max-len
exports.default = series(
	buildPhp,
	buildFonts,
	buildImages,
	testJsLint,
	buildJavascript,
	testSassLint,
	buildSass
);
exports.test = series(testJsLint, testSassLint);
exports.watch = parallel(
	watchFonts,
	watchImages,
	watchJavascript,
	watchSass,
	watchPhp
);
