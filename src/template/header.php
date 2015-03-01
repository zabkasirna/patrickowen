<?php
/**
 * @package sirna-po15
 * @subpackage header
 * @since 0.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <?php // force Internet Explorer to use the latest rendering engine available ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php wp_title(''); ?></title>

    <?php // mobile meta (hooray!) ?>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <?php // @todo Add all icons & favicons here ?>

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php // wordpress head functions ?>
    <?php wp_head(); ?>
    <?php // end of wordpress head ?>

    <?php // drop Google Analytics Here ?>
    <?php // end analytics ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <header class="header">
        <div class="header-inner">
            
            <div class="header-brand">
                <a href='index.php' rel=“nofollow”><img src='<?php echo get_template_directory_uri() . '/uploads/images/logo/logo.png' ?>'></a>
            </div>

        </div><!-- .header-inner -->
    </header><!-- .header -->
