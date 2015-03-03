<?php
/**
 * @package sirna-po15
 * @subpackage archive-campaign
 * @since 0.0.0
 */

get_header(); ?>

    <div id="content">
        <div id="inner-content">
            <main id="main" role="main">
        
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
                <div class="fullheight-row">
                    <div class="headline">
                        <div class="headline-tax-outer">
                            <p class="headline-tax"><?php echo get_post_type(); ?></p>
                        </div>
                        <div class="title-outer">
                            <h1 class="title"><?php the_title(); ?></h1>
                        </div>
                    </div>
                    <section>
                        <?php the_content(); ?>
                    </section>
                </div>
        
                <?php endwhile; ?>
        
            <?php else : ?>
        
                <p>no campaign</p>
        
            <?php endif; ?>
        
            </main><!-- #main -->
        </div><!-- #inner-content -->
    </div>

<?php get_footer(); ?>
