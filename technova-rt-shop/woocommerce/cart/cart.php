<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit; ?>



    <div class="page-header text-center" style="background-image: url('<?php echo  TNS_URL.'/assets/images/page-header-bg.jpg'?>)">
        <div class="container">
            <h1 class="page-title"><?php echo get_the_title(); ?></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3 px-lg-5 px-md-5 px-5">
        <div class="container">
            <ol class="breadcrumb">
          <?php woocommerce_breadcrumb(); ?>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->


<?php do_action( 'woocommerce_before_cart' ); ?>
    <div class="page-content mb-3 px-lg-5 px-md-5 px-5">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			                <?php do_action( 'woocommerce_before_cart_table' ); ?>

                            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents table table-cart table-mobile" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>محصول</th>
                                    <th>قیمت</th>
                                    <th>تعداد</th>
                                    <th>مجموع</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
				                <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
					                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) :
						                $product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
						                ?>
                                        <tr>
                                            <td class="product-col">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="<?php echo esc_url( $product_permalink ); ?>">
											                <?php echo $_product->get_image(); ?>
                                                        </a>
                                                    </figure>
                                                    <h3 class="product-title">
                                                        <a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo $_product->get_name(); ?></a>
                                                    </h3>
                                                </div>
                                            </td>
                                            <td class="price-col"><?php echo WC()->cart->get_product_price( $_product ); ?></td>
                                            <td class="quantity-col">
                                                <div class="cart-product-quantity">
									                <?php
									                if ( $_product->is_sold_individually() ) {
										                echo '1';
									                } else {
										                echo woocommerce_quantity_input( array(
											                'input_name'  => "cart[{$cart_item_key}][qty]",
											                'input_value' => $cart_item['quantity'],
											                'max_value'   => $_product->get_max_purchase_quantity(),
											                'min_value'   => '1',
											                'input_attrs' => array(
												                'class' => 'form-control',
												                'step'  => '1',
												                'data-decimals' => '0',
												                'required' => 'required',
											                ),
										                ), $_product, false );
									                }
									                ?>
                                                </div>
                                            </td>
                                            <td class="total-col"><?php echo WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ); ?></td>
                                            <td class="remove-col">
                                                <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" class="btn-remove">
                                                    <i class="icon-close"></i>
                                                </a>
                                            </td>
                                        </tr>
					                <?php endif; endforeach; ?>
				                <?php do_action( 'woocommerce_cart_contents' ); ?>
                                </tbody>
                            </table>

                            <div class="cart-bottom">
                                <div class="cart-discount">
					                <?php if ( wc_coupons_enabled() ) { ?>
                                        <div class="coupon">
                                            <div class="input-group">
                                                <input type="text" name="coupon_code" class="form-control" placeholder="کد تخفیف" id="coupon_code" value="" />
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-outline-primary-2" name="apply_coupon">
                                                        <i class="icon-long-arrow-left"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
					                <?php } ?>
                                </div>

                                <button type="submit" class="btn btn-outline-dark-2" name="update_cart">
                                    <span>به‌روزرسانی سبد خرید</span><i class="icon-refresh"></i>
                                </button>

				                <?php do_action( 'woocommerce_cart_actions' ); ?>
				                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                            </div>

			                <?php do_action( 'woocommerce_after_cart_table' ); ?>
                        </form>
                    </div>
                    <aside class="col-lg-3">
	                    <?php defined( 'ABSPATH' ) || exit; ?>

                        <div class="summary summary-cart">
                            <h3 class="summary-title">جمع سبد خرید</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                <tr class="summary-subtotal">
                                    <td>جمع کل سبد خرید :</td>
                                    <td class="text-left"><?php wc_cart_totals_subtotal_html(); ?></td>
                                </tr>

			                    <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                                    <tr class="summary-shipping">
                                        <td>شیوه ارسال :</td>
                                        <td></td>
                                    </tr>

				                    <?php wc_cart_totals_shipping_html(); ?>
			                    <?php endif; ?>

			                    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                                    <tr class="summary-coupon">
                                        <td><?php echo wc_cart_totals_coupon_label( $coupon ); ?></td>
                                        <td class="text-left"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                                    </tr>
			                    <?php endforeach; ?>

			                    <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
				                    <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
					                    <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                                            <tr class="summary-tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                                                <td><?php echo esc_html( $tax->label ); ?></td>
                                                <td class="text-left"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                                            </tr>
					                    <?php endforeach; ?>
				                    <?php else : ?>
                                        <tr class="summary-tax-total">
                                            <td><?php esc_html_e( 'مالیات', 'woocommerce' ); ?></td>
                                            <td class="text-left"><?php wc_cart_totals_taxes_total_html(); ?></td>
                                        </tr>
				                    <?php endif; ?>
			                    <?php endif; ?>

                                <tr class="summary-total">
                                    <td>مبلغ قابل پرداخت :</td>
                                    <td class="text-left"><?php wc_cart_totals_order_total_html(); ?></td>
                                </tr>
                                </tbody>
                            </table><!-- End .table-summary -->

                            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-outline-primary-2 btn-order btn-block">
                                رفتن به صفحه پرداخت
                            </a>
                        </div>

                    </aside>

<?php do_action( 'woocommerce_after_cart' ); ?>
                </div>
            </div>
        </div>
    </div>
