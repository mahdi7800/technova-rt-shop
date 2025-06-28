<?php
/**
 * Login Form - Customized version
 */
if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_customer_login_form');
?>


        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
					<?php woocommerce_breadcrumb(); ?>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
             style="background-image: url('<?php echo esc_url(TNS_URL . '/assets/images/backgrounds/login-bg.jpg'); ?>')">
            <div class="container">
                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?php echo ('yes' !== get_option('woocommerce_enable_myaccount_registration')) ? 'active' : ''; ?>"
                                   id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab"
                                   aria-controls="signin-2" aria-selected="true"><?php esc_html_e('Login', 'woocommerce'); ?></a>
                            </li>
							<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo ('yes' === get_option('woocommerce_enable_myaccount_registration')) ? 'active' : ''; ?>"
                                       id="register-tab-2" data-toggle="tab" href="#register-2" role="tab"
                                       aria-controls="register-2" aria-selected="false"><?php esc_html_e('Register', 'woocommerce'); ?></a>
                                </li>
							<?php endif; ?>
                        </ul>

                        <div class="tab-content">
                            <!-- تب ورود -->
                            <div class="tab-pane fade <?php echo ('yes' !== get_option('woocommerce_enable_myaccount_registration')) ? 'show active' : ''; ?>"
                                 id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                                <form class="woocommerce-form woocommerce-form-login login" method="post">
									<?php do_action('woocommerce_login_form_start'); ?>

                                    <div class="form-group">
                                        <label for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?> *</label>
                                        <input type="text" class="form-control" name="username" id="username"
                                               autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="password"><?php esc_html_e('Password', 'woocommerce'); ?> *</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                               autocomplete="current-password" required />
                                    </div>

									<?php do_action('woocommerce_login_form'); ?>

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2 woocommerce-button button"
                                                name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>">
                                            <span><?php esc_html_e('Log in', 'woocommerce'); ?></span>
                                            <i class="icon-long-arrow-left"></i>
                                        </button>

                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="rememberme" type="checkbox"
                                                   id="rememberme" value="forever" />
                                            <label class="custom-control-label" for="rememberme">
												<?php esc_html_e('Remember me', 'woocommerce'); ?>
                                            </label>
                                        </div>

                                        <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="forgot-link">
											<?php esc_html_e('Lost your password?', 'woocommerce'); ?>
                                        </a>
                                    </div>

									<?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
									<?php do_action('woocommerce_login_form_end'); ?>
                                </form>

								<?php if (has_action('woocommerce_login_form_social')) : ?>
                                    <div class="form-choice">
                                        <p class="text-center"><?php esc_html_e('Or login with', 'woocommerce'); ?></p>
                                        <div class="row">
											<?php do_action('woocommerce_login_form_social'); ?>
                                        </div>
                                    </div>
								<?php endif; ?>
                            </div><!-- .End .tab-pane -->

							<?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
                                <!-- تب ثبت‌نام -->
                                <div class="tab-pane fade <?php echo ('yes' === get_option('woocommerce_enable_myaccount_registration')) ? 'show active' : ''; ?>"
                                     id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                                    <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>
										<?php do_action('woocommerce_register_form_start'); ?>

										<?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
                                            <div class="form-group">
                                                <label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?> *</label>
                                                <input type="text" class="form-control" name="username" id="reg_username"
                                                       autocomplete="username" value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" required />
                                            </div>
										<?php endif; ?>

                                        <div class="form-group">
                                            <label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?> *</label>
                                            <input type="email" class="form-control" name="email" id="reg_email"
                                                   autocomplete="email" value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" required />
                                        </div>

										<?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                                            <div class="form-group">
                                                <label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?> *</label>
                                                <input type="password" class="form-control" name="password" id="reg_password"
                                                       autocomplete="new-password" required />
                                            </div>
										<?php else : ?>
                                            <p><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>
										<?php endif; ?>

										<?php do_action('woocommerce_register_form'); ?>

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2 woocommerce-button button"
                                                    name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>">
                                                <span><?php esc_html_e('Register', 'woocommerce'); ?></span>
                                                <i class="icon-long-arrow-left"></i>
                                            </button>

											<?php if (wc_terms_and_conditions_checkbox_enabled()) : ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="register-policy-2" name="terms" required />
                                                    <label class="custom-control-label" for="register-policy-2">
														<?php printf(__('I agree to the <a href="%s" target="_blank">terms and conditions</a>', 'woocommerce'), esc_url(wc_get_page_permalink('terms'))); ?> *
                                                    </label>
                                                </div>
											<?php endif; ?>
                                        </div>

										<?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
										<?php do_action('woocommerce_register_form_end'); ?>
                                    </form>

									<?php if (has_action('woocommerce_register_form_social')) : ?>
                                        <div class="form-choice">
                                            <p class="text-center"><?php esc_html_e('Or register with', 'woocommerce'); ?></p>
                                            <div class="row">
												<?php do_action('woocommerce_register_form_social'); ?>
                                            </div>
                                        </div>
									<?php endif; ?>
                                </div><!-- .End .tab-pane -->
							<?php endif; ?>
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .container -->
        </div><!-- End .login-page section-bg -->


<?php do_action('woocommerce_after_customer_login_form'); ?>