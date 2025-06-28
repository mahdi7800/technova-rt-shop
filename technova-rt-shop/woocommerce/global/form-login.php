<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php if ( is_user_logged_in() ) return; ?>

<form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo $hidden ? 'style="display:none;"' : ''; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

    <div class="form-group">
        <label for="username"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?> <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="username" id="username" autocomplete="username" required />
    </div>

    <div class="form-group">
        <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="text-danger">*</span></label>
        <input type="password" class="form-control" name="password" id="password" autocomplete="current-password" required />
    </div>

	<?php do_action( 'woocommerce_login_form' ); ?>

    <div class="custom-control custom-checkbox mb-3">
        <input type="checkbox" class="custom-control-input" name="rememberme" id="rememberme" value="forever" />
        <label class="custom-control-label" for="rememberme">
			<?php esc_html_e( 'Remember me', 'woocommerce' ); ?>
        </label>
    </div>

    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
    <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ); ?>" />

    <div class="form-footer mb-3">
        <button type="submit" class="btn btn-primary woocommerce-button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>">
			<?php esc_html_e( 'Login', 'woocommerce' ); ?> <i class="icon-long-arrow-left"></i>
        </button>
    </div>

    <p class="lost_password">
        <a class="forgot-link" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
    </p>

	<?php do_action( 'woocommerce_login_form_end' ); ?>
</form>
