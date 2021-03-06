/**
 * @file
 * Task: Test: CSS.
 */

module.exports = function (gulp, plugins, options) {
  'use strict';
  gulp.task('test:css', function () {
    return gulp.src(options.css.file)
      .pipe(plugins.plumber())
      .pipe(plugins.parker());
  });
};
