const { src, dest, watch, series } = require("gulp");

// Paths
const file = {
	phpPath: 'src/**/*.php'
}

// Tasks for copying a php file 
function php() {
    return src(file.phpPath)
        .pipe(dest('public')); 
}

// watch task
function watchTask()
{
    watch(file.phpPath,
          php
    );
}
// Gulp basic task
exports.default = series(
    php,
    watchTask
    );
