    Structure:
        ┣━► Ethos
        ┣━► Anthology
        ┃   ┣━► Campaigns
        ┃   ┣━► Lookbooks
        ┃   ┗━► Catwalks
        ┣━► Heirloom
        ┃   ┗━► Shop per seasons
        ┣━► Scarves
        ┣━► Exposé
        ┣━► Inspiration
        ┣━► Contact
        ┣━► TOC
        ┗━► Newsletter

    Framework:
        ┣━► Wordpress
        ┗━► Slim

    Folder Structure:
        ┗━► /Projek_PO
            ┣━► wp-config.php
            ┣━► contents
            ┃   ┣━► /themes
            ┃   ┣━► /plugin 
            ┃   ┣━► /uploads 
            ┃   ┗━► index.php
            ┗━► /wp
                ┗━► $ git submodule github.com/wordpress/wordpress
                ┗━► $ composer install worpress

    Deployment:
        ┣━► deploy.io
        ┗━► duplicator

     Environment:
        ┣━► localhost: localhost:1337
        ┣━► staging: dev.patrickowen.net ( cpanel / .htaccess )
        ┗━► production: patrickowen.net

    Dev Stack:
        ┗━► Backend:
            ┗━► PHP
                ┣━► Dependency Manager: composer
                ┗━► Routing: SLim Framework
        ┗━► Frontend:
            ┗━► Build System: Gulp
                ┣━► Styling:
                ┃   ┣━► SASS ⟶ CSS
                ┃   ┗━► prefixer
                ┣━► JS
                ┃   ┣━► core.js + vendors.js + plugins.js -> main.js
                ┃   ┗━► linting
                ┣━► HTML
                ┃   ┗━► template engine: twig
                ┣━► live reloading
                ┗━► Image Optimizer

    Special Requirement:
        ┣━► Home:
        ┃   ┣━► Contact Us Interaction
        ┃   ┣━► Headline Interaction
        ┃   ┗━► Cart Panel
        ┣━► Campaign:
        ┃   ┗━► Article Grouping
        ┣━► Detail Product:
        ┃   ┗━► Image Map
        ┗━► Detail Product:
            ┗━► Image Map