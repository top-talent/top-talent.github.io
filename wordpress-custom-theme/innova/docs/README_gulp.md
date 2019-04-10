# Workflow capabilities - Gulp

Our ```gulpfile.js``` is using:
- [browser-sync](https://www.npmjs.com/package/browser-sync)
- [del](https://www.npmjs.com/package/del)
- [gulp](https://gulpjs.com)
- [gulp-autoprefixer](https://www.npmjs.com/package/gulp-autoprefixer)
- [gulp-concat](https://www.npmjs.com/package/gulp-concat)
- [gulp-cssnano](https://www.npmjs.com/package/gulp-cssnano)
- [gulp-if](https://www.npmjs.com/package/gulp-if)
- [gulp-imagemin](https://github.com/vohof/gulp-livereload)
- [gulp-jshint](https://www.npmjs.com/package/gulp-jshint)
- [gulp-load-plugins](https://www.npmjs.com/package/gulp-load-plugins)
- [gulp-notify](https://www.npmjs.com/package/gulp-notify)
- [gulp-sass](https://www.npmjs.com/package/gulp-sass)
- [gulp-sourcemaps](https://www.npmjs.com/package/gulp-sourcemaps)
- [gulp-uglify](https://www.npmjs.com/package/gulp-uglify)
- [jshint](https://www.npmjs.com/package/jshint)
- [run-sequence](https://www.npmjs.com/package/run-sequence)
- [yargs](https://www.npmjs.com/package/yargs)

## Variables

PATHS var contain whole SASS and JS paths to bower plugins and workflow elements which in the Operations tasks will be compile, uglify, and minify to one JS and CSS file.

## Operations

### Sass

This task is concating all SASS files from PATHS.sass var and merging them with main SASS file from ```assets/styles/sass/style.scss```. Than whole is compiling and placing it in ```styles/```.

### Lint custom JS file

This task is validating main JS file placed in ```assets/scripts/custom/custom.js```.

### Scripts concat and minify

This task is concating all JS files from PATHS.javascript var  ```assets/scripts/``` to one file called ```scripts.js```, and placing it on ```scripts/```.

### Images optim

This task is compressing all of JPG, PNG, SVG and GIF files from ```assets/images/``` and placing compressed images in ```images/``` folder.

### Clean styles, scripts, and images

This task is deleting whole files

## Tasks

### $ gulp

This task is watching all of SCSS and JS files and compiles them to minified version on every change. Using operations:
- Sass
- Styles
- Scripts validation
- Scripts

### $ gulp images

This task is compressing all images files anc copying them to destination folder. Using opartions:
- Images optim

### $ gulp serve

This task is creating virtual server for your project.

### $ gulp build

This task is compiling, all of the files. Using operation:
- Clean
- Bower scripts
- Bower styles
- Sass
- Styles minified
- Scripts validation
- Scripts
- Images optim

### $ gulp build --production

This task is compiling, uglifing and minifing all of the files. Using operation:
- Clean
- Bower scripts
- Bower styles
- Sass
- Styles minified
- Scripts validation
- Scripts
- Images optim

ⓒ 2018 All rights reserved [WP Team](http://wpteam.com). WP Team is a division of Acclaim
