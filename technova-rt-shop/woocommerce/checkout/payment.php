<?php
/**
 * Checkout Payment Section - Customized for accordion style
 */
if (!defined('ABSPATH')) {
	exit;
}

if (!wp_doing_ajax()) {
	do_action('woocommerce_review_order_before_payment');
}
?>

    <div id="payment" class="woocommerce-checkout-payment">
		<?php if (WC()->cart->needs_payment()) : ?>
            <div class="accordion-summary" id="accordion-payment">
				<?php if (!empty($available_gateways)) : ?>
					<?php foreach ($available_gateways as $gateway) : ?>
                        <div class="card">
                            <div class="card-header" id="heading-<?php echo esc_attr($gateway->id); ?>">
                                <h2 class="card-title">
                                    <a class="<?php echo $gateway->chosen ? '' : 'collapsed'; ?>"
                                       role="button"
                                       data-toggle="collapse"
                                       href="#collapse-<?php echo esc_attr($gateway->id); ?>"
                                       aria-expanded="<?php echo $gateway->chosen ? 'true' : 'false'; ?>"
                                       aria-controls="collapse-<?php echo esc_attr($gateway->id); ?>">
										<?php echo esc_html($gateway->get_title()); ?>
										<?php if ($gateway->get_icon()) : ?>
                                            <small class="float-left payment-icon"><?php echo $gateway->get_icon(); ?></small>
										<?php endif; ?>
                                    </a>
                                </h2>
                            </div><!-- End .card-header -->

                            <div id="collapse-<?php echo esc_attr($gateway->id); ?>"
                                 class="collapse <?php echo $gateway->chosen ? 'show' : ''; ?>"
                                 aria-labelledby="heading-<?php echo esc_attr($gateway->id); ?>"
                                 data-parent="#accordion-payment">
                                <div class="card-body">
									<?php if ($gateway->has_fields() || $gateway->get_description()) : ?>
                                        <div class="payment-method-description">
											<?php $gateway->payment_fields(); ?>
                                        </div>
									<?php endif; ?>
                                </div><!-- End .card-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .card -->
					<?php endforeach; ?>
				<?php else : ?>
                    <div class="alert alert-info">
						<?php
						echo apply_filters(
							'woocommerce_no_available_payment_methods_message',
							WC()->customer->get_billing_country()
								? esc_html__('Sorry, no payment methods are available.', 'woocommerce')
								: esc_html__('Please enter your details to see payment methods.', 'woocommerce')
						);
						?>
                    </div>
				<?php endif; ?>
            </div><!-- End .accordion-summary -->
		<?php endif; ?>

        <div class="form-row place-order">
            <noscript>
				<?php
				printf(
					esc_html__('JavaScript is disabled in your browser. Please enable it or click the %1$sUpdate Totals%2$s button.', 'woocommerce'),
					'<em>',
					'</em>'
				);
				?>
                <br/>
                <button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>">
					<?php esc_html_e('Update totals', 'woocommerce'); ?>
                </button>
            </noscript>

			<?php wc_get_template('checkout/terms.php'); ?>

			<?php do_action('woocommerce_review_order_before_submit'); ?>

            <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block" id="place_order" name="woocommerce_checkout_place_order">
                <span class="btn-text"><?php esc_html_e('Place order', 'woocommerce'); ?></span>
                <span class="btn-hover-text"><?php esc_html_e('Pay now', 'woocommerce'); ?></span>
            </button>

			<?php do_action('woocommerce_review_order_after_submit'); ?>

			<?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
        </div>
    </div>

<?php
if (!wp_doing_ajax()) {
	do_action('woocommerce_review_order_after_payment');
}