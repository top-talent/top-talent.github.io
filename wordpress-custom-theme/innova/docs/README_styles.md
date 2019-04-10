# Workflow capabilities - Styles

Main style file is located in ```assets/styles/sass/style.scss```, it's build with 5 parts:

## 1. Bower components

Bower components part loads SCSS files for bower components which won't be automatiacally implemented i.e.:
- Hamburgers CSS
- jQuery mmenu
- OWL Carousel
- Select2

## 2. Base
### 2.1 Bootstrap

This foldar contain whole Bootstrap 4 SASS elements

### 2.2. Fonts
In this file you should create ```@mixin```s for all fonts that will be used in project.
Mixin should contain one value for ```font-weight```.

For Google Fonts and Typekit:

```sh
@mixin primary-font($fontWeight) {
    @if $fontWeight == "normal" {
        font-weight: 300;
    } @elseif $fontWeighte == "medium" {
        font-weight: 400;
    } @elseif $fontWeight == "bold" {
        font-weight: 700;
    }
    font-family: 'Lato', sans-serif;
    font-style: normal;
}
```

For @font-face generated:

```sh
@mixin secondary-font($fontWeight) {
    @if $fontWeight == "regular" {
        font-family: 'gotham-lightgotham-light', sans-serif;
    } @elseif $fontWeight == "medium" {
        font-family: 'gotham-bookgotham-book', sans-serif;
    } @elseif $fontWeight == "bold" {
        font-family: 'gotham-boldgotham-bold', sans-serif;
    }
    font-weight: normal;
    font-style: normal;
}
```

### 2.3. Reset

It's reset for standard CSS rules, copied from [HTML5 Reset Styleshet](http://html5doctor.com/html-5-reset-stylesheet/). There are added few more styles for transitions to ```<a>```, and ```<button>``` tag.

## 3. Components

It's set of CSS clases which are using in some of the projects:

### 3.1. Bootstrap 4 Vertical Center Modal

Fix which allows you to vertical center standard [Bootstrap Modal](http://v4-alpha.getbootstrap.com/components/modal/).

Your html structure should look like here:

```sh
<div class="vertical-alignment-helper">
    [...]
    <div class="modal-dialog vertical-align-center" role="document">
        [...]
    </div>
    [...]
</div>
```

### 3.2. WP Admin Bar Fix

Fix for WP Admin Bar - which allows you show it correctly with our Wokflow.

## 4. Helpers

### 4.1. Variables

In this file are set all of variables. Here you should set colors for you projects, i.e.:

```sh
$primary-color: #XXXXXX;
$secondary-color: #YYYYYY;
```

### 4.2. Mixins

In this file are ```@mixin```s for current project.

```@mixin fluid-type```
This mixin set max and min ```font-size``` and ```line-height```. It needs 3 values, first: The smallest ```font-size``` of content, second: the biggest ```font-size```, and third: ```line-height```. Example:
```sh
@include fluid-type(28px, 42px, 1.4);
```

```@mixin letter-spacing```
This mixin set ```letter-spacing``` for RWD. It needs 1 value: number of ```letter-spacing```. Example:
```sh
@include letter-spacing(200);
```

```@mixin admin-sticky-fix```
This mixin moves fixed elements to make fully visible WordPress Admin Bar. It has one value: offset, but usually we're not using it. Example:
```sh
@include admin-sticky-fix();
```

```@mixin element-spacing```
This mixin is giving ability to add marings or paddings for ```div``` or ```section``` elements. It has 3 values, first: Multipler of the $element-space__* variables for each breakpoint, second: Position of margin or padding (both = top & bottom, top, bottom), third: type (margin or padding)  Example:
```sh
@include element-spacing(.75, 'top', 'margin');
```

### 4.3. Repeaters

In this file are set usefull classes to reusing them in project like section margins, section paddings, small margin from top for elements, background with cover option etc.

### 4.4. Content

This file contain styles for ```.content``` class which should wrap all content elements on website.

First element fix set ```margin-top: 0``` for first element in ```.content``` div to avoid errors with current section spacings. Div ```.first-element-fix``` is automatically added into ```.content``` div in ```assets/scripts/main.js``` file.

Class ```.content``` set margins for headlines, and styles for ```<p>```, ```<ul>```, and ```<ol>``` tags. Otherwise it handle styles for ```<img>``` tag, included WordPress classes for images added in Content Editor.

## 5. Layout

### 5.1. Pages -> Homepage, Header, Footer

Predfinied style file for Homepage, Header, and Footer

### 5.2 General

In this file are set styles for ```body```, headlines, italic content, bold content, and some elements which are different for each project like hamburger colour or to top button colour. This is file where you should set all global styles.

In ```body``` class you should set ```font-size``` and ```line-height``` for the paragraphs of content for all project.

In this file you should set global classes for buttons using on website. Example:

```sh
.asgard-button {
    @extend .element-medium-margin-top;
    @include primary-font('bold');
    @include fluid-type(14px, 15px);
    display: inline-block;
    border-radius: 100px;
    padding: 6.5px 20px;
    border: 2px solid transparent;

    &--wide-paddings {
        padding-left: 40px;
        padding-right: 40px;
    }

    &__full-background {
        &:hover,
        &:focus {
            background: transparent;
        }

        &--white-background {
            background: #fff;
            border-color: #fff;

            &:hover,
            &:focus {
                color: #fff;
            }
        }

        &--gray-color {
            color: $secondary-color;
        }

        &--green-background {
            background: $primary-color;
            border-color: $primary-color;

            &:hover,
            &:focus {
                color: $primary-color;
            }
        }

        &--white-color {
            color: #fff;
        }
    }

    &__outline {
        &--gray-border-and-color {
            border-color: $secondary-color;
            color: $secondary-color;
        }

        &--gray-background {
            &:hover,
            &:focus {
                background: $secondary-color;
                color: #fff;
            }
        }

        &--white-border-and-color {
            border-color: #fff;
            color: #fff;
        }

        &--white-background {
            &:hover,
            &:focus {
                background: #fff;
                color: $secondary-color;
            }
        }
        &--green-border-and-color {
            border-color: $primary-color;
            color: $primary-color;
        }

        &--green-background {
            &:hover,
            &:focus {
                background: $primary-color;
                color: #fff;
            }
        }
    }
}
```

Each part of the document should be preceded by comment with description. Example:

```sh
/* ~~~~~~~~~~ Here should go description ~~~~~~~~~~ */

.some-class {
}
```

ⓒ 2018 All rights reserved [WP Team](http://wpteam.com). WP Team is a division of Acclaim
