<?php
defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}
?>

<p>آدرسی که اینجا ثبت می‌کنید به صورت پیش‌فرض برای ارسال محصولات به شما استفاده می‌شود.</p>

<div class="row">
	<?php foreach ( $get_addresses as $name => $address_title ) :
		$address = wc_get_account_formatted_address( $name );
		?>
        <div class="col-lg-12">
            <div class="card card-dashboard">
                <div class="card-body">
                    <h3 class="card-title"><?php echo esc_html( $address_title ); ?></h3>

                    <p>
						<?php
						if ( $address ) {
							echo wp_kses_post( $address );
						} else {
							esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' );
						}
						?>
                        <br>
                        <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>">
                            ویرایش <i class="icon-edit"></i>
                        </a>
                    </p>

					<?php do_action( 'woocommerce_my_account_after_my_address', $name ); ?>
                </div><!-- .card-body -->
            </div><!-- .card -->
        </div><!-- .col-lg-12 -->
	<?php endforeach; ?>
</div><!-- .row -->
