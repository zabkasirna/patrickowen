    Structure:
        ├─□ Ethos
        │   ├─□ The Brand
        │   └─□ The Designer
        │   └─□ Stockists
        ├─□ Anthology
        │   ├─□ Campaigns
        │   ├─□ Lookbooks
        │   └─□ Catwalks
        ├─□ Heirloom
        │   └─□ Shop per seasons
        ├─□ Scarves
        ├─□ Exposé
        ├─□ Inspiration
        ├─□ Contact
        ├─□ TOC
        └─□ Newsletter

    Framework:
        ├─□ Wordpress
        └─□ Slim

    Folder Structure:
        └─□ /patrickowen
            ├─□ /wp-contents
            │   ├─□ /themes
            │   ├─□ /plugin 
            │   ├─□ /uploads 
            │   └─□ index.php
            └─□ /site
                └─□ wp source installed through composer

    Deployment:
        ├─□ deploy.io
        └─□ duplicator

     Environment:
        ├─□ localhost: dev.patrickowen.net
        ├─□ staging: staging.patrickowen.net
        └─□ production: patrickowen.net

    Dev Stack:
        └─□ Backend:
            └─□ PHP
                ├─□ Dependency Manager: composer
                └─□ Routing: SLim Framework
        └─□ Frontend:
            └─□ Build System: Gulp
                ├─□ Styling:
                │   ├─□ SASS ⟶ CSS
                │   └─□ prefixer
                ├─□ JS
                │   ├─□ core.js + vendors.js + plugins.js ⟶ main.js
                │   └─□ linting
                ├─□ HTML
                │   └─□ template engine: twig
                ├─□ live reloading
                └─□ Image Optimizer

    Special Requirement:
        ├─□ Home:
        │   ├─□ Contact Us Interaction
        │   ├─□ Headline Interaction
        │   └─□ Cart Panel
        ├─□ Campaign:
        │   └─□ Article Grouping
        ├─□ Scarve:
        │   └─□ Canvas ( Blowing Scarve )
        └─□ Detail Product:
            └─□ Image Map

__Plugin Candidates:__

*   __Image Mapping:__
    *   [Annotator Pro](http://codecanyon.net/item/annotator-pro-image-tooltips-zooming/9788132)
    *   [Visual Composer Add-on Image Hotspot with Tooltip](http://codecanyon.net/item/annotator-pro-image-tooltips-zooming/9788132)
    *   [HelloPins](http://codecanyon.net/item/hellopins/9563456)
    *   [Woo Product Viewer with Hotspot](http://codecanyon.net/item/woo-product-viewer-with-hotspot/8204639)
    *   [Lite Tooltip](http://codecanyon.net/item/lite-tooltip-responsive-wordpress-plugin/4165378)

*   __Ajax Stuff:__
    *   [Ajaxinate](https://github.com/synapticism/ajaxinate)
    *   [WP AJAX Page Loader](https://github.com/synapticism/wp-ajax-page-loader)