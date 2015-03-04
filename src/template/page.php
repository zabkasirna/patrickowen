<?php
/**
 * @package sirna-po15
 * @subpackage page
 * @since 0.0.0
 */

get_header(); ?>

    <div id="content">
        <div id="inner-content">
            <main id="main" role="main">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                // page content template.
                the_content();

            // End the loop.
            <?php endwhile; else : ?>
            <?php endif; ?>
                <p>no post found</p>
            </main><!-- #main -->
        </div><!-- #inner-content -->
    </div>

<?php get_footer(); ?>
