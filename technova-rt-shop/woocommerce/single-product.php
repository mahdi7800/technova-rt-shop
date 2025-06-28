<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<?php get_template_part('partials/nav/menu','menu'); ?>


<?php
/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action( 'woocommerce_before_main_content' );
?>
    <nav aria-label="breadcrumb" id="breadcrumb-id" class="breadcrumb-nav border-0 mb-3 px-lg-5 px-md-5 px-5">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <!-- بردکرامب راست‌چین -->
                <div class="col-md-6 text-right">
					<?php woocommerce_breadcrumb(); ?>
                </div>

                <!-- دکمه‌های قبلی و بعدی -->
                <div class="col-md-6 text-left">
                    <nav class="product-pager d-flex justify-content-end" aria-label="Product">
						<?php
						$prev_post = get_previous_post();
						$next_post = get_next_post();
						?>

						<?php if (!empty($prev_post)): ?>
                            <a class="product-pager-link product-pager-prev d-flex align-items-center ms-3" href="<?php echo get_permalink($prev_post->ID); ?>">
                                <i class="icon-angle-right ms-1"></i>
                                <span>قبلی</span>
                            </a>
						<?php endif; ?>

						<?php if (!empty($next_post)): ?>
                            <a class="product-pager-link product-pager-next d-flex align-items-center" href="<?php echo get_permalink($next_post->ID); ?>">
                                <span class="me-1">بعدی</span>
                                <i class="icon-angle-left"></i>
                            </a>
						<?php endif; ?>
                    </nav>
                </div>
            </div>
        </div>
    </nav>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>

	<?php wc_get_template_part( 'content', 'single-product' ); ?>

<?php endwhile; // end of the loop. ?>

<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
?>

<?php
/**
 * woocommerce_sidebar hook.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );
?>

<?php

get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
