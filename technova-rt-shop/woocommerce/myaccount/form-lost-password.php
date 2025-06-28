<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit; ?>

    <nav aria-label="breadcrumb mb-3 px-lg-5 px-md-5 px-5" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
				<?php woocommerce_breadcrumb() ?>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

<?php
do_action( 'woocommerce_before_lost_password_form' );
?>
    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
         style="background-image: url(<?php echo  TNS_URL . '/assets/images/backgrounds/login-bg.jpg'?>)">
        <div class="container">
            <div class="form-box">
                <div class="row m-0">
                    <div class="col-12 p-0">
                        <form method="post" class="woocommerce-ResetPassword lost_reset_password">

                            <h4 class="mb-4 mt-3 text-center"><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></h4><?php // @codingStandardsIgnoreLine ?>

                            <div class="form-group">
                                <label for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span
                                            class="required" aria-hidden="true">*</span><span
                                            class="screen-reader-text"><?php esc_html_e( 'Required', 'woocommerce' ); ?></span></label>
                                <input class="form-control" type="text"
                                       name="user_login" placeholder="کلمه کاربری یا ایمیل...." id="user_login" autocomplete="username" required
                                       aria-required="true"/>
                            </div>

                            <div class="clear"></div>

							<?php do_action( 'woocommerce_lostpassword_form' ); ?>

                            <div class="form-group mt-3">
                                <input type="hidden" name="wc_reset_password" value="true"/>
                                <button type="submit"
                                        class="btn btn-outline-primary-2 btn-block woocommerce-Button <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"
                                        value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
                            </div>

							<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
do_action( 'woocommerce_after_lost_password_form' );
