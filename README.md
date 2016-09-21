Wordpress Elixir
====================

A base WordPress theme prepped for Laravel Elixir and npm. If you design and develop custom WordPress themes and hate the cruft logic included in most "base" themes, this is the theme for you. Take it, use it, love it, fork it, make pull requests in the spirit of the theme.

## Quick Start
- Drop the theme into `wp-content/themes`
- Run `npm install`
- Run `gulp`

## About
This theme is designed to wrap all the goodness of [Laravel's Elixir](https://laravel.com/docs/5.3/elixir), which is a an abstraction of the [Gulp task runner](http://gulpjs.com/), into a WordPress theme. This allows us to cut down on requests and automate optimization.

## What this isn't
This theme has no opinions on design (though comes with Bootstrap and Font Awesome for example's/convenience's sake). Its opinions lie in an efficient and performant development pattern. For that reason, it's intended to be directly forked as a new theme. This theme works great _as_ a child theme, but you will not be able to use Elixir if you make a child from it.

If you do want to maintain drop-in updatability, consider not altering your `gulpfile.js` or `elixir.json`. If the theme is updated, you can drop in those two files to keep up. All other files should be specific to your theme, as what is included here should be simply a jumping-off point.

## Requirements
- Node/npm
- PHP 5.4 - while WordPress core is comfortable supporting insecure, end-of-life versions of PHP, this theme is not, and the syntax used reflects that.

## Comes With
- Bootstrap
- Font Awesome

Either of these can be replaced or removed entirely. See your `package.json` and edit `main.scss` accordingly.

## Setup
- Drop the theme into `wp-content/themes`
- Run `npm install`

### Installation with Composer
This theme makes use of [`composer/installers`](https://github.com/composer/installers) and its defined WordPress spec. The theme can therefore be installed using `composer require webspec-design/wordpress-elixir` and it will make its way to `wp-content/themes`. However, the theme should be forked following this, or a `composer update` will overwrite your changes. Either remove it from your `composer.json` and `composer.lock` or rename the theme's directory to avoid this.

## Usage
Use `gulp` to run the gulpfile once, or `gulp watch` to run relevant tasks when changes are detected.

### Sass compilation
The gulpfile is designed to compile your sass and any dependencies into one file at `build/css/main.css`, which is already enqueued in the functions file. The theme comes with Bootstrap and a navigation bar to go with it, but you can just as easily swap that out for Foundation or your favorite CSS framework.

#### Importing other sass libraries
- Install: `npm install juice --save`
  - You could just as easily grab a library using `bower`, or even copy and paste one into a directory
- Import in `main.scss`: `@import 'node_modules/juice/sass/style.scss'`

#### Importing less
To use a library built on less, you have two options:

1. Tinker with the gulpfile and `elixir.json` to compile sass, then compile less, and then concatenate the resulting files using `mix.styles()`.
2. Make creative use of the included [`gulplettes`](#Custom Gulp Tasks) to accomplish #1.

See the [Elixir documentation](https://laravel.com/docs/5.3/elixir#plain-css) for more information on Elixir's capabilities.

#### Using vanilla CSS
To import a vanilla CSS library, you could simply write `@import node_modules/animate.css/animate.css`. However, this is directly translated to a CSS import rather than appended to your styles, so if you haven't successfully run `npm install` server-side, the import will result in a 404. Consider using the `before_copy` [gulplette](#Custom Gulp Tasks) to [copy such files](https://laravel.com/docs/5.3/elixir#copying-files-and-directories) into something like `sass/libs` as an scss file, and then import it like you would any other scss file.

### Browserify
The gulpfile is designed to compile your own Javascript and npm modules into one file using [Browserify](http://browserify.org/). Scripts are compiled to `build/js/main.js`, which is already enqueued in the functions file.

#### Install and use a new module
- Install: `npm install scrollmagic --save`
- Use in `main.js`: `var ScrollMagic = require('scrollmagic')`

#### Modularize your own JavaScript
If you like to break your own Javascript into multiple files, you can include them all into your main one by using relative paths:

`require('./maps.js')`

#### A note about jQuery libraries/extensions
If you want to use a jQuery library or extension like [slick](http://kenwheeler.github.io/slick/), you'll need to enqueue it independently from a CDN or otherwise. For compatibility's sake, we want our theme to still depend on WordPress's bundled jQuery, and we haven't figured out how to shim jQuery libraries and extensions bundled via Browserify onto the global jQuery. If you figure that out, a PR would be appreciated.

If that library also has Sass/CSS to it, you can still import those into your own styles as described above.

### Images
The gulpfile is designed to send your files through [TinyPNG](https://tinypng.com/) to make sure they're nice and optimized. Your [TinyPNG API key](https://tinypng.com/developers) should be placed in `env.json`, as this is sensitive information. Each image will have its MD5 hash placed in a file before being optimized. Comparison against this file prevents images that haven't been altered from being sent back through to TinyPNG, running up your bill. If your `env.json` file doesn't contain a TinyPNG key, the images will simply be copied to the `build` folder.

### BrowserSync
Running `gulp watch` will begin BrowserSync, assuming you've successfully set `bsProxy` in your `env.json` file. This will open a new window in your browser, proxied on port 3000. When the system detects changes to `build/css/main.css`, the styles will be injected into the page. If it detects changes to other file types, the page should refresh automatically.

## Config
If you want to configure some of Elixir's default behavior, see `elixir.json`. There isn't a lot of great documentation on this, so best of luck.

If you want to make configurations specific to your development environment or have a place to store sensitive information, consider `env.json` (which should be gitignored, as is the default).

## Custom Gulp Tasks
In an effort to maintain the drop-in updatability of the theme, custom gulp tasks can be executed using what we've termed `gulplettes`.

At various times during the running of the built-in gulp tasks, gulp will look to `tasks/main.js` for specifically named hooks in which custom gulp tasks can be written, exposing the `mix` object and various arguments available at that time.

This is a great place to use some of [Elixir's other functionality](https://laravel.com/docs/master/elixir). It's also a great place to [extend Elixir](https://scotch.io/tutorials/run-gulp-tasks-in-laravel-easily-with-elixir#custom-tasks-and-extensions) and have it run plain old gulp tasks for things it doesn't come with - perhaps spritesheet generation?

The table below contains the currently configured hooks in the order in which they occur:

| Hook name  | Available args  | Notes
|---|---|---|
| hook_start | {} | Runs before all other gulp tasks |
| hook_after_copy | {} | Runs after Bootstrap and Font Awesome fonts have been copied  |
| hook_end | {} | Runs after all other gulp tasks |

## The `functions.php` file
The functions file is wrapped in a singleton class to avoid polluting the global namespace.

For example's/convenience's sake, the functions file:
  - Defines a navigation menu
  - Defines an image size
  - Declares theme support for title tags and post thumbnails
  - Requires a [custom, Bootstrap-style Walker_Nav_Menu](https://github.com/twittem/wp-bootstrap-navwalker). This is used in `header.php`, so if you remove it here, remove it there
  - Defines a couple convenient constants. They are used elsewhere in the functions file and in `header.php`. If you choose to remove or alter them, do so across the entire theme.
  - Defines a helper function for images. Use this and other static functions you define in this class across your theme like so: `WordPressElixirTheme::image($id, $size='', $icon='', $attr=[]);`.
  - Enqueues jQuery and the scripts and styles generated by Elixir

And _that's it_. Feel free to remove any of it, as this theme is _designed to be forked_ at the outset of development.
