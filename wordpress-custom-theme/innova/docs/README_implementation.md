# Step by step workflow implementation

## 1. Clone the repo

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

## 2. Add gitignore file

Create ```.gitignore``` file with following code inside:

```sh
.idea
.sass-cache/
node_modules/
bower_components/
```

## 3. Screenshot

Edit ```screenshot.png``` to match current project design

## 4. Theme details

Go to ```style.css``` file and edit current project details.

## 5. Favicon

Generate favicon by [Favicon & App Icon Generator](http://www.favicon-generator.org) and paste downloaded icons pack to current theme folder and to main root folder.

## 6. Fonts

### 6.1. Generate fonts

Add fonts from Google Font or TypeKit to ```<head>``` tag in ```partials/header/header.php``` or create ```@font-face``` on [@font-face generator](https://www.fontsquirrel.com/tools/webfont-generator) and place generated CSS in ```assets/styles/sass/base/_fonts.scss```.

### 6.2. Create mixins

Create ```@mixin``` to use the fonts in current project. To see how it should working go [here](README_styles.md#21-fonts).

### 6.3. Set global font adjusts for current project.

In ```assets/styles/sass/layout/_general.scss``` you should set [fluid type mixin](README_styles.md#42-mixins) for whole document body. It should be the ```font-size```, ```line-height```, ```font-family```, and ```font-weight``` for paragraphs from PSD. Example:

```sh
body {
    background: #fff;
    @include primary-font('regular');
    @include fluid-type(16px, 18px, 1.4);
}
```

### 6.4. Set font adjusts for headlines

Set ```font-size```, ```line-height```, ```font-family```, and ```font-weight``` for headlines. Example:

```sh
h1,
h2,
h3,
h4 {
    @include primary-font('bold');
}

h1 {
    @include fluid-type(42px, 62px);
}

h2 {
    @include fluid-type(36px, 48px);
}

h3 {
    @include fluid-type(28px, 38px);
}

h4 {
    @include fluid-type(24px, 32px);
}
```

### 6.5. Set font adjusts for italic and bold content

Example:

```sh
b,
strong {
    @include primary-font('bold');
}

em {
    font-style: italic;
}
```

## 7. Variables

Set variables which will be reused in the project. Firstly you should [set primary and secondary colour](README_styles.md#41-variables). Then you can edit spacing for ```.element-margins``` and ```.element-paddings``` classes.

## 8. Buttons

Set [classes for buttons](README_styles.md#52-general) for whole project.

## 9. WordPress settings

### 9.1. Permalinks

Settings -> Permalinks. Set Custom structure and input ```/%postname%```.

### 9.2. Set homepage

Create new page for homepage, go to Settings -> Reading, and choose Front page displays: A static page and choose homepage.

### 9.3. Set Project Subtitle

Appearance -> Customize -> Site Identity, and in Tagline field write the company slogan or main Homepage headline.

### 9.4. Update services

Paste following services to Update services:

```sh
http://rpc.pingomatic.com
http://rpc.twingly.com
http://api.feedster.com/ping
http://api.moreover.com/RPC2
http://api.moreover.com/ping
http://www.blogdigger.com/RPC2
http://www.blogshares.com/rpc.php
http://www.blogsnow.com/ping
http://www.blogstreet.com/xrbin/xmlrpc.cgi
http://bulkfeeds.net/rpc
http://www.newsisfree.com/xmlrpctest.php
http://ping.blo.gs/
http://ping.feedburner.com
http://ping.syndic8.com/xmlrpc.php
http://ping.weblogalot.com/rpc.php
http://rpc.blogrolling.com/pinger/
http://rpc.technorati.com/rpc/ping
http://rpc.weblogs.com/RPC2
http://www.feedsubmitter.com
http://blo.gs/ping.php
http://www.pingerati.net
http://www.pingmyblog.com
http://geourl.org/ping
http://ipings.com
http://www.weblogalot.com/ping
```

## 10. Now you can start coding!

## 11. Set browser caching (not in all cases!)

After finished project install [WP htaccess Control](https://srd.wordpress.org/plugins/wp-htaccess-control/) and in Custom htaccess tab input following code:

```sh
<IfModule mod_headers.c>
    <FilesMatch "\.(flv|ico|pdf|avi|mov|ppt|doc|mp3|wmv|wav)$">
        Header set Cache-Control "max-age=29030400, public"
    </FilesMatch>

    <FilesMatch "\.(jpg|jpeg|png|gif|swf|svg)$">
        Header set Cache-Control "max-age=29030400, public"
    </FilesMatch>

    <FilesMatch "\.(txt|xml|js|css)$">
        Header set Cache-Control "max-age=29030400"
    </FilesMatch>

    <FilesMatch "\.(html|htm|php|cgi|pl)$">
        Header set Cache-Control "max-age=0, private, no-store, no-cache, must-revalidate"
    </FilesMatch>
</IfModule>

<IfModule mod_filter.c>
    AddOutputFilterByType DEFLATE "application/atom+xml" \
                                  "application/javascript" \
                                  "application/json" \
                                  "application/ld+json" \
                                  "application/manifest+json" \
                                  "application/rdf+xml" \
                                  "application/rss+xml" \
                                  "application/schema+json" \
                                  "application/vnd.geo+json" \
                                  "application/vnd.ms-fontobject" \
                                  "application/x-font-ttf" \
                                  "application/x-javascript" \
                                  "application/x-web-app-manifest+json" \
                                  "application/xhtml+xml" \
                                  "application/xml" \
                                  "font/eot" \
                                  "font/opentype" \
                                  "image/bmp" \
                                  "image/svg+xml" \
                                  "image/vnd.microsoft.icon" \
                                  "image/x-icon" \
                                  "text/cache-manifest" \
                                  "text/css" \
                                  "text/html" \
                                  "text/javascript" \
                                  "text/plain" \
                                  "text/vcard" \
                                  "text/vnd.rim.location.xloc" \
                                  "text/vtt" \
                                  "text/x-component" \
                                  "text/x-cross-domain-policy" \
                                  "text/xml"

</IfModule>
```

ⓒ 2018 All rights reserved [WP Team](http://wpteam.com). WP Team is a division of Acclaim
