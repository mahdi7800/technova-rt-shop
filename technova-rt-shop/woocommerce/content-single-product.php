<?php
/**
 * The template for displaying product content in the single-product.php template
 */
defined( 'ABSPATH' ) || exit;

global $product , $post;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
        <div class="page-content">
            <div class="container">
                <div class="product-details-top mb-2 mb-3 px-lg-5 px-md-5 px-5">
                    <div class="row">
                        <!-- گالری تصاویر محصول -->
                        <div class="col-md-6">
                            <div class="product-gallery">
                                <figure class="product-main-image">
	                                <?php if ( Utility::tns_calculateDiscountPercentage($product->get_regular_price(),$product->get_sale_price()) > 0 ) : ?>
                                        <span class="product-label label-circle label-sale"> تخفیف   <?php echo Utility::tns_calculateDiscountPercentage($product->get_regular_price(),$product->get_sale_price()); ?> % </span>
	                                <?php elseif ( $product->is_on_sale()): ?>
                                        <span class="product-label label-sale">فروش ویژه</span>
	                                <?php endif; ?>
									<?php
									$main_image_id = $product->get_image_id();
									if ( $main_image_id ) {
										$main_image = wp_get_attachment_image_url( $main_image_id, 'full' );
										$main_image_zoom = wp_get_attachment_image_url( $main_image_id, 'full' );
										?>
                                        <img id="product-zoom" src="<?php echo esc_url( $main_image ); ?>"
                                             data-zoom-image="<?php echo esc_url( $main_image_zoom ); ?>"
                                             alt="<?php echo esc_attr( get_post_meta( $main_image_id, '_wp_attachment_image_alt', true ) ); ?>">
									<?php } else {
										echo wc_placeholder_img( 'full' );
									} ?>

                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure><!-- End .product-main-image -->

                                <div id="product-zoom-gallery" class="product-image-gallery">
									<?php
									$attachment_ids = $product->get_gallery_image_ids();
									if ( $attachment_ids ) {
										foreach ( array_slice( $attachment_ids, 0, 4 ) as $index => $attachment_id ) {
											$full_img = wp_get_attachment_image_url( $attachment_id, 'full' );
											$zoom_img = wp_get_attachment_image_url( $attachment_id, 'full' );
											$thumb_img = wp_get_attachment_image_url( $attachment_id, 'thumbnail' );
											$alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
											?>
                                            <a class="product-gallery-item <?php echo $index === 0 ? 'active' : ''; ?>" href="#"
                                               data-image="<?php echo esc_url( $full_img ); ?>"
                                               data-zoom-image="<?php echo esc_url( $zoom_img ); ?>">
                                                <img src="<?php echo esc_url( $thumb_img ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
                                            </a>
											<?php
										}
									} else {
										if ( $main_image_id ) {
											$thumb_img = wp_get_attachment_image_url( $main_image_id, 'thumbnail' );
											$alt = get_post_meta( $main_image_id, '_wp_attachment_image_alt', true );
											?>
                                            <a class="product-gallery-item active" href="#"
                                               data-image="<?php echo esc_url( $main_image ); ?>"
                                               data-zoom-image="<?php echo esc_url( $main_image_zoom ); ?>">
                                                <img src="<?php echo esc_url( $thumb_img ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
                                            </a>
											<?php
										}
									}
									?>
                                </div><!-- End .product-image-gallery -->
                            </div><!-- End .product-gallery -->
                        </div>

						<?php do_action( 'woocommerce_before_single_product_summary' ); ?>

                        <!-- جزئیات محصول -->
                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title"><?php the_title(); ?></h1>

								<?php
								if (!defined('ABSPATH')) {
									exit;
								}

								global $product;

								if (wc_review_ratings_enabled()) {
									$rating_count = $product->get_rating_count();
									$review_count = $product->get_review_count();
									$average      = $product->get_average_rating();

									if ($rating_count > 0) : ?>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: <?php echo esc_attr(($average / 5) * 100); ?>%;"></div>
                                            </div>
											<?php if (comments_open()) : ?>
                                                <a class="ratings-text" href="#product-review-link" id="review-link">
                                                    ( <?php echo esc_html($review_count); ?> نظر )
                                                </a>
											<?php endif; ?>
                                        </div>
									<?php endif;
								}
								?>

                                <div class="product-price">
	                                <?php if ($product->is_type('variable')) : ?>
		                                <?php echo $product->get_price_html(); ?>
	                                <?php elseif($product->is_on_sale()) : ?>
                                        <span class="new-price"><?php echo $product->get_sale_price(); ?> تومان</span>
                                        <span class="old-price"><?php echo $product->get_regular_price(); ?> تومان</span>
	                                <?php else : ?>
                                        <span class="new-price"><?php echo $product->get_price(); ?> تومان</span>
	                                <?php endif; ?>
                                </div>
                                 <?php if ($product->is_type('variable')) : ?>
                                <div class="product-content"><?php the_excerpt(); ?></div>
                                  <?php elseif($product->is_on_sale()) : ?>
                                       <div class="product-content"><?php the_excerpt(); ?></div>
<?php else : ?>
    <div class="product-content"><?php the_excerpt(); ?></div>
<?php endif; ?>
								<?php do_action( 'woocommerce_single_product_summary' ); ?>

                                <div class="product-details-footer">
                                    <div class="product-cat text-center">
                                        <span>دسته بندی : </span>
										<?php echo wc_get_product_category_list( $product->get_id(), ', ', '', '' ); ?>
                                    </div>

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">اشتراک گذاری : </span>
                                        <a href="#" class="social-icons-2" title="فیسبوک"><i class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icons-2" title="توییتر"><i class="icon-twitter"></i></a>
                                        <a href="#" class="social-icons-2" title="اینستاگرام"><i class="icon-instagram"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End .row -->
                </div><!-- End .product-details-top -->

				<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </div><!-- End #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>