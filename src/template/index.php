<?php
/**
 * @package sirna-po15
 * @subpackage index
 * @since 0.0.0
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <p><?php the_title(); ?></p>
            <section>
                <?php the_content(); ?>
            </section>

            <?php endwhile; ?>

        <?php else : ?>

            <p>no post</p>

        <?php endif; ?>

        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer(); ?>
