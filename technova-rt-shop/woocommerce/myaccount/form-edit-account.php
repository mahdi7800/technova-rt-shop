<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' );
?>

<div class="tab-pane fade show active" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
    <form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >
        <div class="row">
			<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

            <div class="col-sm-6">
                <label for="account_first_name">نام *</label>
                <input type="text" class="form-control" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" required />
            </div>

            <div class="col-sm-6">
                <label for="account_last_name">نام خانوادگی *</label>
                <input type="text" class="form-control" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" required />
            </div>
        </div><!-- End .row -->

        <label for="account_display_name">نام نمایشی *</label>
        <input type="text" class="form-control" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" required />
        <small class="form-text">این نام در قسمت بازدیدها، نظرات و حساب کاربری شما نمایش داده می‌شود.</small>

        <label for="account_email">ایمیل *</label>
        <input type="email" class="form-control" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" required />

		<?php do_action( 'woocommerce_edit_account_form_fields' ); ?>

        <label for="password_current">پسورد فعلی</label>
        <input type="password" class="form-control" name="password_current" id="password_current" autocomplete="off" />

        <label for="password_1">پسورد جدید</label>
        <input type="password" class="form-control" name="password_1" id="password_1" autocomplete="off" />

        <label for="password_2">تکرار پسورد جدید</label>
        <input type="password" class="form-control mb-2" name="password_2" id="password_2" autocomplete="off" />

		<?php do_action( 'woocommerce_edit_account_form' ); ?>

        <button type="submit" class="btn btn-outline-primary-2 float-right">
            <span>ذخیره تغییرات</span>
            <i class="icon-long-arrow-left"></i>
        </button>

		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
        <input type="hidden" name="action" value="save_account_details" />
    </form>
</div>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
