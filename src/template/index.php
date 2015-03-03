<?php
/**
 * @package sirna-po15
 * @subpackage index
 * @since 0.0.0
 */

get_header(); ?>

<nav>
    <?php wp_nav_menu (array('theme_location' => 'main-navi','menu_class' => 'nav'));?>
</nav>

<div>
    <?php the_content();?>
</div>
<?php get_footer(); ?>
