<?php
/**
 * @author      Sirna
 * @package     sirna-po15/templates/woocommerce
 * @version     0.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post, $product;

?>

<?php
    /**
     * woocommerce_before_single_product hook
     *
     * @hooked wc_print_notices - 10
     */
     do_action( 'woocommerce_before_single_product' );

     if ( post_password_required() ) {
        echo get_the_password_form();
        return;
     }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="heirloom" <?php post_class(); ?>>
    
    <?php if ( powc_cat_is( 'heirloom' ) ):  ?>
        <div class="heirloom-product-outer">
            <ul class="heirloom-product">

            <?php $attachment_ids = $product->get_gallery_attachment_ids(); ?>

            <?php foreach( $attachment_ids as $attachment_id ): $attachment_link = wp_get_attachment_url( $attachment_id );?>
                <li class="heirloom-product-item">
                    <img class="heirloom-product-image" src="<?php echo $attachment_link; ?>">
                </li>
            <?php endforeach; ?>

            </ul>
        </div>
        <div class="heirloom-product-control">
            <a href="#" class="hpc-prev">←</a>
            <a href="#" class="hpc-next">→</a>
            <a href="#" class="hpc-zoom"><i class="fa fa-search-plus"></i></a>
        </div>
    <?php else: ?>            
        <?php
            /**
             * woocommerce_before_single_product_summary hook
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            do_action( 'woocommerce_before_single_product_summary' );
        ?>
    <?php endif; ?>

    <div class="summary entry-summary">

        <?php
            /**
             * woocommerce_single_product_summary hook
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_rating - 10
             * @hooked woocommerce_template_single_price - 10
             * @hooked woocommerce_template_single_excerpt - 20
             * @hooked woocommerce_template_single_add_to_cart - 30
             * @hooked woocommerce_template_single_meta - 40
             * @hooked woocommerce_template_single_sharing - 50
             */
            do_action( 'woocommerce_single_product_summary' );
        ?>

    </div><!-- .summary -->

    <?php
        /**
         * woocommerce_after_single_product_summary hook
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
    ?>

    <meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
