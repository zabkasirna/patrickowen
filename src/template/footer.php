<?php
/**
 * @package sirna-po15
 * @subpackage footer
 * @since 0.0.0
 */
?>

<nav class="footer-link-outer">
    <div class="footer-link-toggler-outer">
        <a href="#" class="footer-link-toggler">×</a>
    </div>
    <?php 
        $footer_link_defaults = array(
            'theme_location'  => 'footer-link',
            'container'       => 'div',
            'container_class' => 'footer-link',
            'menu_class'      => 'nav',
            'menu_id'         => 'footer-link-list'
        );

        wp_nav_menu ( $footer_link_defaults );
    ?>
</nav>

<p class="debugger-template">Current template: <a href="#"><?php get_current_template( true ); ?></a></p>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
