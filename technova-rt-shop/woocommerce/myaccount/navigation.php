<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="page-header text-center" style="background-image: url('<?php echo TNS_URL . '/assets/images/page-header-bg.jpg'; ?>')">
    <div class="container">
        <h1 class="page-title"><?php echo get_the_title(); ?></h1>
    </div>
</div>

<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
    <div class="container">
        <ol class="breadcrumb">
			<?php woocommerce_breadcrumb(); ?>
        </ol>
    </div>
</nav>

<div class="page-content">
    <div class="dashboard">
        <div class="container">
            <div class="row">
                <aside class="col-md-3 col-lg-3">
                    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
						<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo wc_is_current_account_menu_item( $endpoint ) ? 'active' : ''; ?>"
                                   href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"
									<?php echo wc_is_current_account_menu_item( $endpoint ) ? 'aria-current="page"' : ''; ?>>
									<?php echo esc_html( $label ); ?>
                                </a>
                            </li>
						<?php endforeach; ?>
                    </ul>
                </aside>

                <div class="col-md-9 col-lg-9">
                    <div class="tab-content">
                    <div class="woocommerce-MyAccount-content">
						<?php
						/**
						 * My Account content.
						 * This is the content for the currently active tab.
						 */
						do_action( 'woocommerce_account_content' );
						?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
