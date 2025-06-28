<?php
defined( 'ABSPATH' ) || exit;
?>

<table class="table table-summary">
    <thead>
    <tr>
        <th>محصول</th>
        <th class="text-left">جمع</th>
    </tr>
    </thead>

    <tbody>
	<?php
	$cart_total = 0;

	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
			$product_name = $_product->get_name();
			$product_url = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
			$product_price = WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] );
			$cart_total += $_product->get_price() * $cart_item['quantity'];
			?>
            <tr>
                <td><a href="<?php echo esc_url( $product_url ); ?>"><?php echo esc_html( $product_name ); ?></a></td>
                <td class="text-left"><?php echo wp_kses_post( $product_price ); ?></td>
            </tr>
			<?php
		}
	}
	?>

    <tr class="summary-subtotal">
        <td>جمع سبد خرید</td>
        <td class="text-left"><?php wc_cart_totals_subtotal_html(); ?></td>
    </tr>

	<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
        <tr class="shipping-method">
            <th>شیوه ارسال:</th>
            <td data-title="شیوه ارسال">
				<?php
				do_action( 'woocommerce_review_order_before_shipping' );
				wc_cart_totals_shipping_html();
				do_action( 'woocommerce_review_order_after_shipping' );
				?>
            </td>
        </tr>
	<?php endif; ?>

    <tr class="summary-total">
        <td>مبلغ قابل پرداخت :</td>
        <td class="text-left"><?php wc_cart_totals_order_total_html(); ?></td>
    </tr>
    </tbody>
</table>
