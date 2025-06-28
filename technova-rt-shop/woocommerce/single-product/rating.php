<?php
/**
 * Single Product Rating - Modified Version
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $product;

if (!wc_review_ratings_enabled()) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ($rating_count > 0) : ?>

    <div class="ratings-container">
        <div class="ratings">
            <div class="ratings-val" style="width: <?php echo esc_attr(($average / 5) * 100); ?>%;"></div><!-- End .ratings-val -->
        </div><!-- End .ratings -->
		<?php if (comments_open()) : ?>
            <a class="ratings-text" href="#product-review-link" id="review-link">
                ( <?php echo esc_html($review_count); ?> نظر )
            </a>
		<?php endif; ?>
    </div><!-- End .rating-container -->

<?php endif; ?>