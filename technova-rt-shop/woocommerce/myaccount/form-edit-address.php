<?php
defined('ABSPATH') || exit;

$page_title = ('billing' === $load_address) ? esc_html__('Billing address', 'woocommerce') : esc_html__('Shipping address', 'woocommerce');

do_action('woocommerce_before_edit_account_address_form');
?>

<?php if (!$load_address) : ?>
	<?php wc_get_template('myaccount/my-address.php'); ?>
<?php else : ?>

    <div class="tab-pane fade show active" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
        <p>آدرسی که اینجا ثبت می‌کنید به صورت پیش‌فرض برای ارسال محصولات به شما استفاده می‌شود.</p>

        <form method="post" class="woocommerce-EditAddressForm edit-address" novalidate>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-dashboard">
                        <div class="card-body">

                            <h3 class="card-title">
								<?php echo apply_filters('woocommerce_my_account_edit_address_title', $page_title, $load_address); ?>
                            </h3>

							<?php do_action("woocommerce_before_edit_address_form_{$load_address}"); ?>

                            <div class="row">
								<?php foreach ($address as $key => $field): ?>
                                    <div class="col-sm-6">
                                        <?php
										woocommerce_form_field($key, $field, wc_get_post_data_by_key($key, $field['value']));
										?>
                                    </div>
								<?php endforeach; ?>
                            </div><!-- End .row -->

                            <div class="form-group text-right mt-3">
                                <button type="submit" class="btn btn-outline-primary-2 float-right">
                                    <span>ذخیره آدرس</span>
                                    <i class="icon-long-arrow-left"></i>
                                </button>
                            </div>

							<?php wp_nonce_field('woocommerce-edit_address', 'woocommerce-edit-address-nonce'); ?>
                            <input type="hidden" name="action" value="edit_address" />

							<?php do_action("woocommerce_after_edit_address_form_{$load_address}"); ?>

                        </div><!-- End .card-body -->
                    </div><!-- End .card-dashboard -->
                </div><!-- End .col-lg-12 -->
            </div><!-- End .row -->

        </form>
    </div>

<?php endif; ?>

<?php do_action('woocommerce_after_edit_account_address_form'); ?>