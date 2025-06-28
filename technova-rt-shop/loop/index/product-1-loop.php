<div class="heading heading-center mb-3">
	<h2 class="title-lg">محصولات جدید</h2>

	<ul class="nav nav-pills justify-content-center" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="new-all-link" data-toggle="tab" href="#new-all-tab"
			   role="tab" aria-controls="new-all-tab" aria-selected="true">همه</a>
		</li>
		<?php
		$setting_data = get_option('_tns_settings_set_general');
		$args_cat = [
			'taxonomy'   => 'product_cat',
			'hide_empty' => false,
			'exclude'    => $setting_data['exclude_category_id'],
			'parent'     => 0,
			'orderby'    => 'id',
			'order'      => 'ASC'
		];
		$cat_products = get_categories($args_cat);
		foreach ($cat_products as $cat_product) : ?>
			<li class="nav-item">
				<a class="nav-link" id="cat-<?php echo esc_attr($cat_product->slug); ?>-link"
				   data-toggle="tab"
				   href="#cat-<?php echo esc_attr($cat_product->slug); ?>-tab"
				   role="tab"
				   aria-controls="cat-<?php echo esc_attr($cat_product->slug); ?>-tab"
				   aria-selected="false">
					<?php echo esc_html($cat_product->name); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

<div class="tab-content tab-content-carousel">
	<div class="tab-pane tab-pane-shadow p-0 fade show active" id="new-all-tab" role="tabpanel" aria-labelledby="new-all-link">
		<div class="owl-carousel owl-simple carousel-equal-height" data-toggle="owl"
		     data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 0,
                        "loop": false,
                        "rtl": true,
                        "responsive": {
                            "0": {"items":2},
                            "480": {"items":2},
                            "768": {"items":3},
                            "992": {"items":4},
                            "1200": {"items":4,"nav":true}
                        }
                     }'>
			<?php
			$args_all = ['limit' => 8, 'status' => 'publish', 'orderby' => 'date', 'order' => 'DESC'];
			$product_allies = wc_get_products($args_all);
			foreach ($product_allies as $product_ally) :
				$regular = $product_ally->get_regular_price();
				$sale = $product_ally->get_sale_price();
				$discount = Utility::tns_calculateDiscountPercentage($regular, $sale);
				?>
				<div class="product product-3 text-center">
					<figure class="product-media">
						<?php if (!$product_ally->is_in_stock()) : ?>
							<span class="product-label label-primary">ناموجود</span>
						<?php endif; ?>

						<?php if ($discount > 0) : ?>
							<span class="product-label label-circle label-sale">تخفیف  <?php echo $discount; ?>%</span>
						<?php elseif ($product_ally->is_on_sale()) : ?>
							<span class="product-label label-sale">فروش ویژه</span>
						<?php endif; ?>

						<a href="<?php echo esc_url($product_ally->get_permalink()); ?>">
							<img src="<?php echo esc_url(get_the_post_thumbnail_url($product_ally->get_id())); ?>"
							     alt="<?php echo esc_attr($product_ally->get_name()); ?>"
							     class="product-image">
						</a>
					</figure>

					<div class="product-body">
						<div class="product-cat text-center">
							<?php
							$terms = get_the_terms($product_ally->get_id(), 'product_cat');
							if (!is_wp_error($terms) && !empty($terms)) :
								echo implode(', ', array_map(function($term) {
									return '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
								}, $terms));
							endif;
							?>
						</div>

						<h3 class="product-title text-center">
							<a href="<?php echo esc_url($product_ally->get_permalink()); ?>">
								<?php echo esc_html($product_ally->get_name()); ?>
							</a>
						</h3>

						<div class="product-price">
							<?php if ($product_ally->is_type('variable')) :
								$prices = $product_ally->get_variation_prices(true);
								$min_price = current($prices['price']);
								$max_price = end($prices['price']);
								?>
								<span class="new-price"><?php echo wc_price($min_price); ?></span>
								<?php if ($min_price !== $max_price) : ?>
								<span class="new-price"><?php echo wc_price($max_price); ?></span>
							<?php endif; ?>
							<?php elseif ($product_ally->is_on_sale()) : ?>
								<span class="new-price"><?php echo wc_price($sale); ?></span>
								<span class="old-price"><?php echo wc_price($regular); ?></span>
							<?php else : ?>
								<span class="new-price"><?php echo wc_price($product_ally->get_price()); ?></span>
							<?php endif; ?>
						</div>
					</div>

					<div class="product-footer">
						<div class="ratings-container">
							<?php
							$avg = $product_ally->get_average_rating();
							$count = $product_ally->get_rating_count();
							?>
							<div class="ratings">
								<div class="ratings-val" style="width: <?php echo ($avg / 5) * 100; ?>%;"></div>
							</div>
							<span class="ratings-text">(<?php echo esc_html($count); ?> دیدگاه)</span>
						</div>

						<?php if ($product_ally->is_type('variable')) :
							$variations = $product_ally->get_available_variations(); ?>
							<div class="product-nav product-nav-dots">
								<?php foreach ($variations as $i => $var) :
									if (!empty($var['attributes']['attribute_pa_color'])) : ?>
										<a href="#" class="<?php echo $i === 0 ? 'active' : ''; ?>"
										   style="background: <?php echo esc_attr($var['attributes']['attribute_pa_color']); ?>">
											<span class="sr-only">نام رنگ</span>
										</a>
									<?php endif;
								endforeach; ?>
							</div>
						<?php endif; ?>

						<div class="product-action">
							<a href="<?php echo esc_url($product_ally->add_to_cart_url()); ?>"
							   class="btn-product btn-cart">
								<span>افزودن به سبد خرید</span>
							</a>
							<a href="<?php echo esc_url($product_ally->get_permalink()); ?>"
							   class="btn-product btn-view-product" title="مشاهده محصول">
								<i class="icon-eye"></i>
								<span>مشاهده محصول</span>
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<?php foreach ($cat_products as $cat_product) : ?>
		<?php
		$args_cat_loop = [
			'limit' => 8,
			'status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',
			'category' => [$cat_product->slug],
		];
		$product_cats = wc_get_products($args_cat_loop);
		?>
		<div class="tab-pane tab-pane-shadow p-0 fade"
		     id="cat-<?php echo esc_attr($cat_product->slug); ?>-tab"
		     role="tabpanel"
		     aria-labelledby="cat-<?php echo esc_attr($cat_product->slug); ?>-link">
			<div class="owl-carousel owl-simple carousel-equal-height" data-toggle="owl"
			     data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "margin": 0,
                            "loop": false,
                            "rtl": true,
                            "responsive": {
                                "0": {"items":2},
                                "480": {"items":2},
                                "768": {"items":3},
                                "992": {"items":4},
                                "1200": {"items":4,"nav":true}
                            }
                         }'>
				<?php foreach ($product_cats as $product_cat) :
					$regular = $product_cat->get_regular_price();
					$sale = $product_cat->get_sale_price();
					$discount = $regular && $sale ? round((($regular - $sale) / $regular) * 100) : 0;
					?>
					<div class="product product-3 text-center">
						<figure class="product-media">
							<?php if (!$product_cat->is_in_stock()) : ?>
								<span class="product-label label-primary">ناموجود</span>
							<?php endif; ?>

							<?php if ($discount > 0) : ?>
								<span class="product-label label-circle label-sale">تخفیف  <?php echo $discount; ?>%</span>
							<?php elseif ($product_cat->is_on_sale()) : ?>
								<span class="product-label label-sale">فروش ویژه</span>
							<?php endif; ?>

							<a href="<?php echo esc_url($product_cat->get_permalink()); ?>">
								<img src="<?php echo esc_url(get_the_post_thumbnail_url($product_cat->get_id())); ?>"
								     alt="<?php echo esc_attr($product_cat->get_name()); ?>"
								     class="product-image">
							</a>
						</figure>

						<div class="product-body">
							<div class="product-cat text-center">
								<?php
								$terms = get_the_terms($product_cat->get_id(), 'product_cat');
								if (!is_wp_error($terms) && !empty($terms)) :
									echo implode(', ', array_map(function($term) {
										return '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
									}, $terms));
								endif;
								?>
							</div>

							<h3 class="product-title text-center">
								<a href="<?php echo esc_url($product_cat->get_permalink()); ?>">
									<?php echo esc_html($product_cat->get_name()); ?>
								</a>
							</h3>

							<div class="product-price">
								<?php if ($product_cat->is_type('variable')) :
									$prices = $product_cat->get_variation_prices(true);
									$min_price = current($prices['price']);
									$max_price = end($prices['price']);
									?>
									<span class="new-price"><?php echo wc_price($min_price); ?></span>
									<?php if ($min_price !== $max_price) : ?>
									<span class="new-price"><?php echo wc_price($max_price); ?></span>
								<?php endif; ?>
								<?php elseif ($product_cat->is_on_sale()) : ?>
									<span class="new-price"><?php echo wc_price($sale); ?></span>
									<span class="old-price"><?php echo wc_price($regular); ?></span>
								<?php else : ?>
									<span class="new-price"><?php echo wc_price($product_cat->get_price()); ?></span>
								<?php endif; ?>
							</div>
						</div>

						<div class="product-footer">
							<div class="ratings-container">
								<?php
								$avg = $product_cat->get_average_rating();
								$count = $product_cat->get_rating_count();
								?>
								<div class="ratings">
									<div class="ratings-val" style="width: <?php echo ($avg / 5) * 100; ?>%;"></div>
								</div>
								<span class="ratings-text">(<?php echo esc_html($count); ?> دیدگاه)</span>
							</div>

							<?php if ($product_cat->is_type('variable')) :
								$variations = $product_cat->get_available_variations(); ?>
								<div class="product-nav product-nav-dots">
									<?php foreach ($variations as $i => $var) :
										if (!empty($var['attributes']['attribute_pa_color'])) : ?>
											<a href="#" class="<?php echo $i === 0 ? 'active' : ''; ?>"
											   style="background: <?php echo esc_attr($var['attributes']['attribute_pa_color']); ?>">
												<span class="sr-only">نام رنگ</span>
											</a>
										<?php endif;
									endforeach; ?>
								</div>
							<?php endif; ?>

							<div class="product-action">
								<a href="<?php echo esc_url($product_cat->add_to_cart_url()); ?>"
								   class="btn-product btn-cart">
									<span>افزودن به سبد خرید</span>
								</a>
								<a href="<?php echo esc_url($product_cat->get_permalink()); ?>"
								   class="btn-product btn-view-product" title="مشاهده محصول">
									<i class="icon-eye"></i>
									<span>مشاهده محصول</span>
								</a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>