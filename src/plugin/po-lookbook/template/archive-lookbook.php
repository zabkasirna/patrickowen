<?php
/**
 * @package sirna-po15
 * @subpackage archive-lookbook
 * @since 0.0.0
 */

get_header(); ?>

    <div id="content" class="<?php echo get_post_type(); ?>">
        <div id="inner-content">
            <main id="main" role="main">

            <?php if ( have_posts() ) : ?>

                <div class="loop-outer">
                    <?php while ( have_posts() ) : the_post(); ?>

                    <?php // LOOP ?>
                    <div class="loop" data-id="<?php echo the_id(); ?>">
                        <section>
                            <?php the_content(); ?>
                        </section>
                    </div>

                    <?php // HEADLINE ?>
                    <a href="<?php the_permalink(); ?>" class="headline" data-id="<?php echo the_id(); ?>">
                        <div class="tax-outer">
                            <p class="tax">LOOKBOOKS</p>
                        </div>
                        <div class="title-outer">
                            <h1 class="title"><?php the_title(); ?></h1>
                        </div>
                    </a>
        
                    <?php endwhile; ?>
                </div>
        
            <?php endif; ?>
        
            </main><!-- #main -->
        </div><!-- #inner-content -->
    </div>

<?php get_footer(); ?>
