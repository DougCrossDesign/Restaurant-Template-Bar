# Restaurant Template Bar
---
This site uses grunt for minification and concatenation

###Install Node Modules After Downloading
- Open Terminal/Commandline
- Change directory (cd) to base-auto folder
- Enter `sudo npm install`  (npm install for windows)
- All modules are now added (sass, uglify, etc.)

### Setup Files / Modules
- Type `Grunt Setup` to setup frontend site files from base
- Copy each module from `/base/templates/modules` site to `/site/templates/modules/` for this project
- Edit `sitevars.php` and set (if not already) `$theme_dir` to 'site'
- Develop goes in to `SITE` folder; `BASE` is not for theme level editing.

###Sass Layout
- View `site / assets / sass`
- Base: Variables, Mixins, and styles for general items (elements, classes)
- Portions: Styles for sections of a page (header, footer, .etc)
- Pages: Unique styles for a particular page (gallery, etc.)
- Compatibility: Styles for IE, Print

### Modules Layouts `site/templates/modules/*`
- `layout#.js` - layout # init js
- `layout#.scss` - layout # SCSS
- `layout#.php` - layout # template
- `Plugin.js` - base plugin

###General Site Styles
- View `/template.php`
