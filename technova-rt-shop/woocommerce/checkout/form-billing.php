<?php
defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-billing-fields">
    <h2 class="checkout-title">جزئیات صورت حساب</h2><!-- End .checkout-title -->

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

    <div class="row">
        <div class="col-sm-6">
            <label for="billing_first_name">نام *</label>
            <input type="text" class="form-control" id="billing_first_name" name="billing_first_name" value="<?php echo esc_attr( $checkout->get_value( 'billing_first_name' ) ); ?>" required>
        </div><!-- End .col-sm-6 -->

        <div class="col-sm-6">
            <label for="billing_last_name">نام خانوادگی *</label>
            <input type="text" class="form-control" id="billing_last_name" name="billing_last_name" value="<?php echo esc_attr( $checkout->get_value( 'billing_last_name' ) ); ?>" required>
        </div><!-- End .col-sm-6 -->
    </div><!-- End .row -->

    <div class="row">
        <div class="col-sm-6">
            <label for="billing_phone">شماره تماس *</label>
            <input type="tel" class="form-control" id="billing_phone" name="billing_phone" value="<?php echo esc_attr( $checkout->get_value( 'billing_phone' ) ); ?>" required>
        </div>

        <div class="col-sm-6">
            <label for="billing_email">ایمیل *</label>
            <input type="email" class="form-control" id="billing_email" name="billing_email" value="<?php echo esc_attr( $checkout->get_value( 'billing_email' ) ); ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <label for="billing_address_1">آدرس *</label>
            <input type="text" class="form-control" id="billing_address_1" name="billing_address_1" value="<?php echo esc_attr( $checkout->get_value( 'billing_address_1' ) ); ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <label for="billing_city">شهر *</label>
            <input type="text" class="form-control" id="billing_city" name="billing_city" value="<?php echo esc_attr( $checkout->get_value( 'billing_city' ) ); ?>" required>
        </div>

        <div class="col-sm-6">
            <label for="billing_postcode">کد پستی *</label>
            <input type="text" class="form-control" id="billing_postcode" name="billing_postcode" value="<?php echo esc_attr( $checkout->get_value( 'billing_postcode' ) ); ?>" required>
        </div>
    </div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
    <div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>
            <div class="row">
                <div class="col-sm-6">
                    <p class="form-row form-row-wide create-account">
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" />
                            <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
                        </label>
                    </p>
                </div>
            </div>
		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>
            <div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
                <div class="clear"></div>
            </div>
		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
    </div>
<?php endif; ?>
