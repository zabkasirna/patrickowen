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

            <p>Test</p>

            <?php
            // Start the loop.
            while ( have_posts() ) : the_post();

                // page content template.
                the_content();

            // End the loop.
            endwhile;
            ?>
        
            </main><!-- #main -->
        </div><!-- #inner-content -->
    </div>

<?php get_footer(); ?>