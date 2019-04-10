# Crunch

[![N|Solid](https://cldup.com/k_YU_-fvII.png)](http://wpteam.com)

Crunch is a WordPress starter theme based on Bootstrap 4 created by [WP Team](http://wpteam.com).

## Workflow capabilities

To learn more about possiblities of our workflow please take a look at [Workflow capabilities](docs/README_docs.md).

## Step by step workflow implementation

See WP Team rules of [Step by step workflow implementation](docs/README_implementation.md).

## Quick Installation

Clone this repository to your ```wp-content/themes/``` folder.
```sh
$ git clone https://github.com/weareacclaim/crunch.git
```
Install ```npm``` modules
```sh
$ npm install
```
Install ```bower``` components
```sh
$ bower install
```
Enjoy!

## What's included?

Workflow is currently based on [Bootstrap 4](https://getbootstrap.com). Structure of files is based on mobile-first coding. [Sass](http://sass-lang.com) is created using [BEM](http://getbem.com/introduction/) ideology. Repository is fully automated by [Gulp](http://gulpjs.com) tasks. Workflow includes [Bower](https://bower.io), so you can very easy include new plugins - thanks to Gulp all of JS and CSS files of Bower plugins are automatically included into main scripts and styles files.

## Gulp

If you want to know more about how is working our `gulpfile.js` please go to: [How's working our Gulp File](docs/README_gulp.md)

### Gulp features

1. Ultra-fast compiling SCSS to CSS
2. Concating and uglifing all CSS files (included Bower files) to one minify file
3. Concating and uglifing all JS files (included Bower files) to one minify file
4. Compressing all images
5. Watching your files

### Gulp tasks

The following tasks are available:

- `$ gulp build` is compiling all of files
- `$ gulp build --production` is compiling, uglifing and minifing all of files
- `$ gulp images` is compressing all images files anc copying them to destination folder
- `$ gulp serve` is creating virtual server for your project
- `$ gulp` is a default task, is watching all of SCSS and JS files and compiles them every file change

## Bower compontents

Plugins preinstalled on this repo:

1. [Bootstrap 4](https://getbootstrap.com)
2. [Hamburgers](https://jonsuh.com/hamburgers/)
3. [jQuery](https://jquery.com)
4. [jQuery Easing](https://jqueryui.com/easing/)
5. [jQuery Lazy](http://jquery.eisbehr.de/lazy/)
6. [mmenu](http://mmenu.frebsite.nl)
7. [matchHeight](http://brm.io/jquery-match-height/)
8. [OWL Carousel](https://owlcarousel2.github.io/OwlCarousel2/)
7. [Select2](https://select2.github.io)
9. [Retina JS](http://imulus.github.io/retinajs/)

ⓒ 2018 All rights reserved [WP Team](http://wpteam.com). WP Team is a division of Acclaim