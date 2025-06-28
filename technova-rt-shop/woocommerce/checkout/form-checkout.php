<?php
defined( 'ABSPATH' ) || exit;
?>

<div class="page-header text-center" style="background-image: url('<?php echo TNS_URL .'/images/page-header-bg.jpg'?>')">
    <div class="container">
        <h1 class="page-title"><?php echo get_the_title(); ?></h1>
    </div>
</div>

<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3 px-lg-5 px-md-5 px-5">
    <div class="container">
        <ol class="breadcrumb">
			<?php woocommerce_breadcrumb(); ?>
        </ol>
    </div>
</nav>

<?php
do_action( 'woocommerce_before_checkout_form', $checkout );

if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

    <div class="page-content mb-3 px-lg-5 px-md-5 px-5">
        <div class="checkout">
            <div class="container">
                <div class="checkout-discount mb-4">
					<?php wc_print_notices(); ?>
					<?php do_action( 'woocommerce_checkout_coupon_form' ); ?>
                </div>

                <div class="row">
                    <div class="col-lg-9">

						<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                        <div class="row" id="customer_details">
                            <div class="col-12">
								<?php do_action( 'woocommerce_checkout_billing' ); ?>
                            </div>

                            <div class="col-12 mt-4">
								<?php do_action( 'woocommerce_checkout_shipping' ); ?>
                            </div>
                        </div>

						<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>


                    </div>

                    <aside class="col-lg-3">
                        <div class="summary">
                            <h3 class="summary-title"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>

                            <div id="order_review" class="woocommerce-checkout-review-order">
								<?php do_action( 'woocommerce_checkout_order_review' ); ?>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
