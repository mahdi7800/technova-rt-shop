<?php
defined( 'ABSPATH' ) || exit;
global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

?>
<div class="col-6 col-md-4 col-lg-4 col-xl-3 col-xxl-2">
    <div <?php wc_product_class( 'product', $product ); ?>>
        <figure class="product-media">
	        <?php if (!$product->is_in_stock()) : ?>
                <span class="product-label label-primary">ناموجود</span>
	        <?php endif; ?>
			<?php if ( Utility::tns_calculateDiscountPercentage($product->get_regular_price(),$product->get_sale_price()) > 0 ) : ?>
                <span class="product-label label-circle label-sale"> تخفیف   <?php echo Utility::tns_calculateDiscountPercentage($product->get_regular_price(),$product->get_sale_price()); ?> % </span>
             <?php elseif ( $product->is_on_sale()): ?>
                <span class="product-label label-sale">فروش ویژه</span>
			<?php endif; ?>

            <a href="<?php the_permalink(); ?>">
				<?php echo $product->get_image( 'woocommerce_thumbnail', [ 'class' => 'product-image' ] ); ?>
            </a>

            <div class="product-action-vertical">

            </div>

            <div class="product-action action-icon-top">
                <a href="?add-to-cart=<?php echo esc_attr( $product->get_id() ); ?>" class="btn-product btn-cart ajax_add_to_cart" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" aria-label="افزودن به سبد">
                    <span>افزودن به سبد</span>
                </a>
                <a href="<?php echo $product->get_permalink(); ?>"
                   class="btn-product btn-view-product" title="مشاهده محصول"
                   data-product-id="<?php echo $product->get_id(); ?>">
                    <i class="icon-eye"></i>
                    <span>مشاهده محصول</span>
                </a>
            </div>
        </figure>

        <div class="product-body">
            <div class="product-cat">
				<?php echo wc_get_product_category_list( $product->get_id() ); ?>
            </div>

            <h3 class="product-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <div class="product-price">
				<?php echo $product->get_price_html(); ?>
            </div>

            <div class="ratings-container">
                <div class="ratings">
                    <div class="ratings-val" style="width: <?php echo ( ( $product->get_average_rating() / 5 ) * 100 ); ?>%;"></div>
                </div>
                <span class="ratings-text">( <?php echo esc_html( $product->get_review_count() ); ?> دیدگاه )</span>
            </div>

			<?php
			// نمایش رنگ‌ها (با فرض اینکه ویژگی pa_color وجود دارد)
			$colors = wc_get_product_terms( $product->get_id(), 'pa_color', array( 'fields' => 'all' ) );
			if ( ! empty( $colors ) ) :
				?>
                <div class="product-nav product-nav-dots">
					<?php foreach ( $colors as $color ) :
					if (!empty($var['attributes']['attribute_pa_color'])) : ?>
						$color_value = get_term_meta( $color->term_id, 'color_value', true ); // فرض: رنگ ذخیره‌شده در متا
						?>
                        <a href="#" style="background: <?php echo esc_attr( $color_value ); ?>"><span class="sr-only"><?php echo esc_html( $color->name ); ?></span></a>
                    <?php endif; ?>
					<?php endforeach; ?>
                </div>
			<?php endif; ?>
        </div>
    </div>
</div>
