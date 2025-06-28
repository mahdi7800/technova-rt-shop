<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

    <div class="container">
		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );
		if ( $heading ) : ?>
            <h2 class="title text-center mb-4"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
             data-owl-options='{
					"nav": false,
					"dots": true,
					"margin": 20,
					"loop": false,
					"rtl": true,
					"responsive": {
						"0": {"items":1},
						"480": {"items":2},
						"768": {"items":3},
						"992": {"items":4},
						"1200": {"items":4, "nav": true, "dots": false}
					}
				}'>

			<?php foreach ( $related_products as $related_product ) : ?>
				<?php
				$post_object = get_post( $related_product->get_id() );
				setup_postdata( $GLOBALS['post'] =& $post_object );
				$product = wc_get_product( $related_product->get_id() );
				?>

                <div <?php wc_product_class( 'product product-7 text-center', $product ); ?>>
                    <figure class="product-media">
						<?php if ( ! $product->is_in_stock() ) : ?>
                            <span class="product-label label-out">ناموجود</span>
                        <?php endif; ?>
                        <?php if( Utility::tns_calculateDiscountPercentage($product->get_regular_price(),$product->get_sale_price()) > 0): ?>
                            <span class="product-label label-circle label-sale"> تخفیف    <?php echo Utility::tns_calculateDiscountPercentage($product->get_regular_price(),$product->get_sale_price()); ?> % </span>
                        <?php elseif ( $product->is_on_sale() ) : ?>
                            <span class="product-label label-circle label-sale">فروش ویژه</span>
						<?php endif; ?>

                        <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
							<?php echo $product->get_image( 'woocommerce_thumbnail', ['class' => 'product-image'] ); ?>

							<?php
							$attachment_ids = $product->get_gallery_image_ids();
							if ( ! empty( $attachment_ids ) ) :
								$first_image_url = wp_get_attachment_image_url( $attachment_ids[0], 'woocommerce_thumbnail' );
								?>
                                <img src="<?php echo esc_url( $first_image_url ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" class="product-image-hover">
							<?php endif; ?>
                        </a>

                        <div class="product-action-vertical">

                            <a href="<?php echo $product->get_permalink(); ?>" class="btn-product-icon btn-view-product" title="مشاهده سریع"  data-product-id="<?php echo $product->get_id(); ?>">
                                <i class="icon-eye"></i>
                                <span>مشاهده سریع</span>
                            </a>

                        </div>

                    </figure>

                    <div class="product-body">
                        <div class="product-cat text-center">
							<?php echo wc_get_product_category_list( $product->get_id(), ', ' ); ?>
                        </div>
                        <h3 class="product-title text-center">
                            <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
								<?php echo esc_html( $product->get_name() ); ?>
                            </a>
                        </h3>

                        <div class="product-price">
							<?php echo $product->get_price_html(); ?>
                        </div>

                        <div class="ratings-container">
							<?php
							$average = $product->get_average_rating();
							$rating_count = $product->get_rating_count();
							?>
                            <div class="ratings">
                                <div class="ratings-val" style="width: <?php echo ( $average / 5 ) * 100; ?>%;"></div>
                            </div>
                            <span class="ratings-text">( <?php echo $rating_count; ?> دیدگاه )</span>
                        </div>
                    </div>
                </div>
			<?php endforeach; ?>

        </div> <!-- End .owl-carousel -->
    </div> <!-- End .container -->

	<?php wp_reset_postdata(); ?>

<?php endif; ?>
