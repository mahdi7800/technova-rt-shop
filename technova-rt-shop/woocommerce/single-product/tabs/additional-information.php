<?php
/**
 * Additional Information tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/additional-information.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional information', 'woocommerce' ) );

?>
<div class="tab-content mb-3 px-lg-5 px-md-5 px-5">
    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
         aria-labelledby="product-desc-link">
        <div class="product-desc-content">
<?php if ( $heading ) : ?>
	<h3><?php echo esc_html( $heading ); ?></h3>
<?php endif; ?>

<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
        </div>
    </div>
</div>
