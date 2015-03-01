<?php
/**
 * @package sirna-po15
 * @subpackage archive-expose
 * @since 0.0.0
 */

get_header(); ?>

    <div id="content">
        <div id="inner-content">
            <main id="main" role="main">
        
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
                <p><?php the_title(); ?></p>
                <section>
                    <?php the_content(); ?>
                </section>
        
                <?php endwhile; ?>
        
            <?php else : ?>
        
                <p>no expose</p>
        
            <?php endif; ?>
        
            </main><!-- #main -->
        </div><!-- #inner-content -->
    </div>

<?php get_footer(); ?>
