<?php
defined( 'ABSPATH' ) || exit;
?>

<?php if ( WC()->cart && ! WC()->cart->is_empty() ) : ?>

	<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
		$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) :
			$product_name      = $_product->get_name();
			$product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
			$product_price     = WC()->cart->get_product_price( $_product );
			$thumbnail_url     = wp_get_attachment_image_url( $_product->get_image_id(), 'thumbnail' );
			?>
            <div class="cart-product">
                <div class="product">
                    <div class="product-cart-details">
                        <h4 class="product-title">
                            <a href="<?php echo esc_url( $product_permalink ); ?>">
								<?php echo esc_html( $product_name ); ?>
                            </a>
                        </h4>

                        <span class="cart-product-info">
                        <span class="cart-product-qty"><?php echo esc_html( $cart_item['quantity'] ); ?> x </span>
                        <?php echo wp_kses_post( $product_price ); ?>
                    </span>
                    </div><!-- End .product-cart-details -->

                    <figure class="product-image-container">
                        <a href="<?php echo esc_url( $product_permalink ); ?>" class="product-image">
                            <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $product_name ); ?>">
                        </a>
                    </figure>

                    <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>"
                       class="btn-remove"
                       title="<?php esc_attr_e( 'حذف محصول', 'woocommerce' ); ?>">
                        <i class="icon-close"></i>
                    </a>
                </div><!-- End .product -->
            </div><!-- End .cart-product -->
		<?php endif; endforeach; ?>

    <div class="dropdown-cart-total">
        <span>مجموع</span>
        <span class="cart-total-price"><?php echo WC()->cart->get_cart_total(); ?></span>
    </div><!-- End .dropdown-cart-total -->

    <div class="dropdown-cart-action">
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-primary">مشاهده سبد خرید</a>
        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-outline-primary-2">
            <span>پرداخت</span><i class="icon-long-arrow-left"></i>
        </a>
    </div><!-- End .dropdown-cart-action -->

<?php else : ?>

    <p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>
