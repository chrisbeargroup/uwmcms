/**
 * @file
 * Task: Clean:CSS.
 */

module.exports = function (gulp, plugins, options) {
  'use strict';
  // Clean CSS files.
  gulp.task('clean:css', function () {
    plugins.del.sync([
      options.css.files
    ]);
  });
};
