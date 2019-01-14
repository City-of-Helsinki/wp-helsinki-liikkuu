// our basic dependencies
const gulp = require('gulp');
const watch = require('gulp-watch');
const cache = require('gulp-cached');

// some utils
const del = require('del');
const wait = require('gulp-wait');
const fs = require("fs");

let envPath = '/app/env/.env';

// if not available we must be local
if (!fs.existsSync(envPath)) {
    envPath = './env/.env';
}

// load in our .env file
const dotenv = require('dotenv').config({ path: envPath });

// as we sometimes work on droplets, file saving may have latency so this is used as a delay to accomodate such behaviour
const gulpTaskTimeout = process.env.GULP_TASK_TIMEOUT;

/**
 * global build paths
 * under the custom index is where you want to any WP plugins, or any additional watch files, this way
 * stream is smaller and task is quicker
 */
const paths = {
    src: 'src/',
    dist: 'dist/',
    themePath: 'wp-content/themes/' + process.env.WP_THEME_NAME + '/',
    copy: ['vendor/wordpress/**/*', 'src/**/*'],
    acf: ['dist/wp-content/themes/' + process.env.WP_THEME_NAME + '/acf-json/*.json'],
    php: ['src/wp-content/themes/' + process.env.WP_THEME_NAME + '/**/*.php', 'src/wp-config.php', 'src/wp-content/plugins/woocommerce/**/*.php'],
    plugins: ['src/wp-content/plugins/**/*']
};

/**
 * clear the build
 */
gulp.task('cleanseBuild', function () {
    return del([
        paths.dist + '**/*',
        '!' + paths.dist + 'wp-content',
        '!' + paths.dist + 'wp-content/uploads',
        '!' + paths.dist + 'wp-content/uploads/**/*',
        '!' + paths.dist + 'wp-content/debug.log'
    ]);
});

/**
 * copy and our code in the build path
 */
gulp.task('copy', ['redis'], function () {
    return gulp.src(paths.copy, { read: true })
        .pipe(gulp.dest(paths.dist));
});

/**
 * copy php files to build path
 */
gulp.task('php', function () {
    return gulp.src(paths.php, { base: paths.src })
        .pipe(wait(gulpTaskTimeout))
        .pipe(cache('php'))
        .pipe(gulp.dest(paths.dist));
});

/**
 * copy plugin files to build path
 */
gulp.task('plugins', function(){
    return gulp.src(paths.plugins, { base: paths.src })
        .pipe(wait(gulpTaskTimeout))
        .pipe(cache('plugins'))
        .pipe(gulp.dest(paths.dist));
});


/**
 * copy our redis file over
 */
gulp.task('redis', ['cleanseBuild'], function() {
    return gulp.src(paths.src + 'wp-content/plugins/redis-cache/includes/object-cache.php')
        .pipe(gulp.dest(paths.dist + 'wp-content'));
});

/**
 * watch the ACF local json files from dist/ bring back to src/
 */
gulp.task('acf', function (done) {
    return gulp.src(paths.acf, { base: paths.dist })
        .pipe(wait(gulpTaskTimeout))
        .pipe(gulp.dest(paths.src));
});

/**
 * our watch tasks
 */
gulp.task('watch', ['copy'], function () {
    gulp.watch(paths.php, ['php']);
    gulp.watch(paths.acf, ['acf']);
    gulp.watch(paths.plugins, ['plugins']);
});

/**
 * the default gulp task used for development
 */
gulp.task('default', ['watch']);