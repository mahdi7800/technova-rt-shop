<?php
defined( 'ABSPATH' ) || exit;
global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' )
	? wc_esc_json( $variations_json )
	: _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' );
?>
<form class="variations_form cart" method="post" enctype="multipart/form-data"
      data-product_id="<?php echo absint( $product->get_id() ); ?>"
      data-product_variations="<?php echo $variations_attr; ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
        <p class="stock out-of-stock"><?php esc_html_e( 'این محصول در حال حاضر موجود نیست.', 'woocommerce' ); ?></p>
	<?php else : ?>
    <table class="variations" cellspacing="0">
        <tbody>
		<?php foreach ( $attributes as $attribute_name => $options ) : ?>
            <tr>
                <th class="label">
                    <label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
						<?php echo esc_html( wc_attribute_label( $attribute_name ) ); ?> :
                    </label>
                </th>
                <td class="value">
					<?php
					$sanitized_name = sanitize_title( $attribute_name );
					$selected       = isset( $_REQUEST[ 'attribute_' . $sanitized_name ] )
						? wc_clean( wp_unslash( $_REQUEST[ 'attribute_' . $sanitized_name ] ) )
						: $product->get_variation_default_attribute( $attribute_name );

					// بررسی ویژگی رنگ pa_color
					if ( $sanitized_name === 'pa_color' ) {
						echo '<div class="details-filter-row details-row-size">';
						echo '<div class="product-nav product-nav-dots">';

						$selected_color = $selected;

						foreach ( wc_get_product_terms( $product->get_id(), 'pa_color', [ 'fields' => 'all' ] ) as $term ) {
							if ( in_array( $term->slug, $options, true ) ) {
								$color  = get_term_meta( $term->term_id, 'color', true );
								$active = ( $term->slug === $selected_color ) ? 'active' : '';

								echo '<a href="#" class="' . esc_attr( $active ) . '" data-value="' . esc_attr( $term->slug ) . '" style="background: ' . esc_attr( $term->slug ) . ';">';
								echo '<span class="sr-only">' . esc_html( $term->name ) . '</span>';
								echo '</a>';
							}
						}

						echo '</div></div>';
						echo '<input type="hidden" name="attribute_pa_color" value="' . esc_attr( $selected_color ) . '" />';
					} else {
						// نمایش سایر ویژگی‌ها (مثلاً سایز)
						echo '<div class="details-filter-row details-row-size"><div class="select-custom">';
						wc_dropdown_variation_attribute_options( [
							'options'   => $options,
							'attribute' => $attribute_name,
							'product'   => $product,
							'selected'  => $selected,
							'class'     => 'form-control',
						] );
						echo '</div></div>';
					}

					// دکمه پاک‌سازی
					if ( end( $attribute_keys ) === $attribute_name ) {
						echo '<a class="reset_variations" href="#">' . esc_html__( 'پاک کردن', 'woocommerce' ) . '</a>';
					}
					?>
                </td>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>


	<?php do_action( 'woocommerce_after_variations_table' ); ?>

    <div class="single_variation_wrap">
		<?php
		do_action( 'woocommerce_before_single_variation' );
		?>
        <div class="woocommerce-variation single_variation"></div>
        <div class="woocommerce-variation-add-to-cart variations_button">
            <div class="details-filter-row details-row-size">
                <label for="qty">تعداد : </label>
				<?php
				woocommerce_quantity_input( [
					'min_value'   => $product->get_min_purchase_quantity(),
					'max_value'   => $product->get_max_purchase_quantity(),
					'input_value' => 1,
					'classes'     => 'form-control'
				] );
				?>
            </div>
            <div class="product-details-action">
                <button type="submit" class="btn-product btn-cart">
                    <span><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span>
                </button>
	            <?php
	            $active_wishlist = get_option('_tns_settings_set_general',);
	            if ($active_wishlist['wishlist_enable'] === 'yes') : ?>
                <div class="details-action-wrapper">
                    <a href="#"
                       class="btn-product btn-wishlist bookmark-product <?php echo tns_user_bookmark_product(get_current_user_id(), $product->get_id()) ? 'liked' : ''; ?>"
                       data-pid="<?php echo $product->get_id(); ?>"
                       title="لیست علاقه مندی">
   <span>
افزودن به لیست علاقه‌مند
   </span>
                    </a>
                    <?php endif;?>
                </div><!-- End .details-action-wrapper -->
                <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>"/>
                <input type="hidden" name="product_id" value="<?php echo esc_attr( $product->get_id() ); ?>"/>
                <input type="hidden" name="variation_id" class="variation_id" value="0"/>
            </div>

			<?php do_action( 'woocommerce_after_single_variation' ); ?>
        </div>

		<?php endif; ?>
		<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>
<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
