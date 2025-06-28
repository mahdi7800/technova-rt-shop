<?php
/**
 * Display single product reviews (comments)
 */
defined('ABSPATH') || exit;

global $product;

if (!comments_open()) {
	return;
}

// تابع callback سفارشی برای نمایش نظرات
function custom_woocommerce_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	?>
    <div class="review" id="comment-<?php comment_ID(); ?>">
        <div class="row no-gutters">
            <div class="col-auto">
                <h4><a href="<?php echo esc_url(get_comment_author_url()); ?>"><?php comment_author(); ?></a></h4>
				<?php if ($rating = get_comment_meta(get_comment_ID(), 'rating', true)) : ?>
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: <?php echo esc_attr($rating * 20); ?>%;"></div>
                        </div>
                    </div>
				<?php endif; ?>
                <span class="review-date"><?php printf(esc_html__('%s ago', 'woocommerce'), human_time_diff(get_comment_time('U'), current_time('timestamp'))); ?></span>
            </div>
            <div class="col-12">


                <div class="review-content">
					<?php comment_text(); ?>
                </div>

                <div class="review-action">

                </div>
            </div>
        </div>
    </div>
	<?php
}
?>

<div id="reviews" class="woocommerce-Reviews">
    <div id="comments">
        <div class="tab-content">
            <div class="tab-pane fade show active mb-3 px-lg-5 px-md-5 px-5" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                <div class="reviews">
                    <h3 class="woocommerce-Reviews-title">
						<?php
						$count = $product->get_review_count();
						if ($count && wc_review_ratings_enabled()) {
							$reviews_title = sprintf(esc_html(_n('%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce')), esc_html($count), '<span>' . get_the_title() . '</span>');
							echo apply_filters('woocommerce_reviews_title', $reviews_title, $count, $product);
						} else {
							esc_html_e('Reviews', 'woocommerce');
						}
						?>
                    </h3>

					<?php if (have_comments()) : ?>
                        <div class="commentlist">
							<?php
							wp_list_comments(apply_filters('woocommerce_product_review_list_args', array(
								'callback' => 'custom_woocommerce_comments',
								'style' => 'div',
								'short_ping' => true,
							)));
							?>
                        </div>

						<?php
						if (get_comment_pages_count() > 1 && get_option('page_comments')) :
							echo '<nav class="woocommerce-pagination">';
							paginate_comments_links(
								apply_filters(
									'woocommerce_comment_pagination_args',
									array(
										'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
										'next_text' => is_rtl() ? '&larr;' : '&rarr;',
										'type'      => 'list',
									)
								)
							);
							echo '</nav>';
						endif;
						?>
					<?php else : ?>
                        <p class="woocommerce-noreviews"><?php esc_html_e('There are no reviews yet.', 'woocommerce'); ?></p>
					<?php endif; ?>
<div class="reviews">
    <div class="tab-pane fade show active mb-3 px-lg-5 px-md-5 px-5">
	                <?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>
                        <div id="review_form_wrapper">
                            <div id="review_form">

				                <?php
				                $commenter = wp_get_current_commenter();
				                $comment_form = array(
					                'title_reply'          => have_comments() ? esc_html__('Add a review', 'woocommerce') : sprintf(esc_html__('Be the first to review &ldquo;%s&rdquo;', 'woocommerce'), get_the_title()),
					                'title_reply_to'       => esc_html__('Leave a Reply to %s', 'woocommerce'),
					                'title_reply_before'   => '<h3>',
					                'title_reply_after'    => '</h3>',
					                'comment_notes_after'  => '',
					                'label_submit'         => esc_html__('Submit', 'woocommerce'),
					                'logged_in_as'         => '',
					                'class_submit'         => 'btn btn-primary',
					                'comment_field'        => '',
				                );

				                $name_email_required = (bool) get_option('require_name_email', 1);

				                $fields = array(
					                'author' => '<div class="form-group col-md-6 mb-3">
                                <label for="author">' . esc_html__('Name', 'woocommerce') . ($name_email_required ? ' <span class="required">*</span>' : '') . '</label>
                                <input id="author" name="author" type="text" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" ' . ($name_email_required ? 'required' : '') . ' />
                            </div>',
					                'email' => '<div class="form-group col-md-6 mb-3">
                                <label for="email">' . esc_html__('Email', 'woocommerce') . ($name_email_required ? ' <span class="required">*</span>' : '') . '</label>
                                <input id="email" name="email" type="email" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '" ' . ($name_email_required ? 'required' : '') . ' />
                            </div>',
				                );

				                $comment_form['fields'] = $fields;

				                if (wc_review_ratings_enabled()) {
					                $comment_form['comment_field'] .= '<div class="form-group mb-3">
        <label for="rating">امتیاز شما <span class="required">*</span></label>
        <select name="rating" id="rating" class="form-control" required>
            <option value="">امتیاز بدهید…</option>
            <option value="5">عالی (۵ از ۵)</option>
            <option value="4">خوب (۴ از ۵)</option>
            <option value="3">متوسط (۳ از ۵)</option>
            <option value="2">ضعیف (۲ از ۵)</option>
            <option value="1">خیلی ضعیف (۱ از ۵)</option>
        </select>
    </div>';
				                }

				                $comment_form['comment_field'] .= '<div class="form-group mb-3">
                <label for="comment">' . esc_html__('Your review', 'woocommerce') . ' <span class="required">*</span></label>
                <textarea id="comment" name="comment" class="form-control" rows="5" required></textarea>
            </div>';

				                // بسته‌بندی فرم در .row برای ساختار شبکه‌ای
				                add_filter('comment_form_defaults', function ($defaults) {
					                $defaults['fields'] = '<div class="row">' . implode('', $defaults['fields']) . '</div>';
					                return $defaults;
				                });

				                comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
				                ?>
                            </div>
                        </div>
	                <?php else : ?>
                        <p class="woocommerce-verification-required alert alert-warning mt-3"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'woocommerce'); ?></p>
	                <?php endif; ?>
                </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>