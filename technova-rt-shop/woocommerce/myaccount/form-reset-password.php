<?php
/**
 * Lost password reset form.
 */
defined('ABSPATH') || exit;
?>

    <nav aria-label="breadcrumb mb-3 px-lg-5 px-md-5 px-5" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
				<?php woocommerce_breadcrumb(); ?>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

<?php do_action('woocommerce_before_reset_password_form'); ?>

    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('<?php echo esc_url(TNS_URL . '/assets/images/backgrounds/login-bg.jpg'); ?>')">
        <div class="container">
            <div class="form-box">
                <div class="row m-0">
                    <div class="col-12 p-0">
                        <form method="post" class="woocommerce-ResetPassword lost_reset_password">

                            <h4 class="mb-4 mt-3 text-center">
								<?php echo apply_filters('woocommerce_reset_password_message', esc_html__('Enter a new password below.', 'woocommerce')); ?>
                            </h4>

                            <div class="form-group">
                                <label for="password_1">
									<?php esc_html_e('New password', 'woocommerce'); ?>
                                    <span class="required">*</span>
                                </label>
                                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                       name="password_1" id="password_1" autocomplete="new-password" required
                                       placeholder="*********" />
                            </div>

                            <div class="form-group">
                                <label for="password_2">
									<?php esc_html_e('Re-enter new password', 'woocommerce'); ?>
                                    <span class="required">*</span>
                                </label>
                                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control"
                                       name="password_2" id="password_2" autocomplete="new-password" required
                                       placeholder="*********" />
                            </div>

                            <input type="hidden" name="reset_key" value="<?php echo esc_attr($args['key']); ?>" />
                            <input type="hidden" name="reset_login" value="<?php echo esc_attr($args['login']); ?>" />

							<?php do_action('woocommerce_resetpassword_form'); ?>

                            <div class="form-group mt-3">
                                <input type="hidden" name="wc_reset_password" value="true" />
                                <button type="submit" class="woocommerce-Button btn btn-outline-primary-2 btn-block button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"
                                        value="<?php esc_attr_e('Save', 'woocommerce'); ?>">
									<?php esc_html_e('Save', 'woocommerce'); ?>
                                </button>
                            </div>

							<?php wp_nonce_field('reset_password', 'woocommerce-reset-password-nonce'); ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php do_action('woocommerce_after_reset_password_form'); ?>