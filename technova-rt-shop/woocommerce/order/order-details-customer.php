<?php
defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>

<section class="woocommerce-customer-details">

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-dashboard">
                <div class="card-body">
                    <div class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">

                        <!-- Billing Address -->
                        <div class="woocommerce-address-fields">
                            <h2 class="woocommerce-column__title"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h2>
                            <address>
								<?php echo wp_kses_post( $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>

								<?php if ( $order->get_billing_phone() ) : ?>
                                    <p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
								<?php endif; ?>

								<?php if ( $order->get_billing_email() ) : ?>
                                    <p class="woocommerce-customer-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></p>
								<?php endif; ?>

								<?php do_action( 'woocommerce_order_details_after_customer_address', 'billing', $order ); ?>
                            </address>
                        </div><!-- /.col-1 -->

						<?php if ( $show_shipping ) : ?>
                            <!-- Shipping Address -->
                            <div class="woocommerce-address-fields">
                                <h2 class="woocommerce-column__title"><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h2>
                                <address>
									<?php echo wp_kses_post( $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) ) ); ?>

									<?php if ( $order->get_shipping_phone() ) : ?>
                                        <p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_shipping_phone() ); ?></p>
									<?php endif; ?>

									<?php do_action( 'woocommerce_order_details_after_customer_address', 'shipping', $order ); ?>
                                </address>
                            </div><!-- /.col-2 -->
						<?php endif; ?>

                    </div><!-- /.addresses -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.col-lg-12 -->
    </div><!-- /.row -->

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</section>
