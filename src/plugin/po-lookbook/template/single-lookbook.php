<?php
/**
 * @package sirna-po15
 * @subpackage single-lookbook
 * @since 0.0.0
 */

get_header(); ?>

    <div id="content">
        <div id="inner-content">
            <main id="main" role="main">
        
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <section>
                    <?php the_content(); ?>
                </section>

                <?php // HEADLINE ?>
                <div class="headline">
                    <div class="tax-outer">
                        <p class="tax">LOOKBOOK</p>
                    </div>
                    <div class="title-outer">
                        <h1 class="title show"><?php the_title(); ?></h1>
                    </div>
                </div>
        
                <?php endwhile; ?>
        
            <?php else : ?>
        
                <p>no single lookbook</p>
        
            <?php endif; ?>
        
            </main><!-- #main -->
        </div><!-- #inner-content -->
    </div>

<?php get_footer(); ?>
