<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}

// دریافت لینک‌ها به‌صورت آرایه
$links = paginate_links( array(
	'base'      => $base,
	'format'    => $format,
	'add_args'  => false,
	'current'   => max( 1, $current ),
	'total'     => $total,
	'prev_text' => '<i class="icon-long-arrow-right"></i> قبلی',
	'next_text' => 'بعدی <i class="icon-long-arrow-left"></i>',
	'type'      => 'array',
	'end_size'  => 1,
	'mid_size'  => 2,
) );

if ( ! empty( $links ) ) : ?>
    <nav class="woocommerce-pagination" aria-label="<?php esc_attr_e( 'Product Pagination', 'woocommerce' ); ?>">
        <ul class="pagination justify-content-center">
			<?php foreach ( $links as $link ) :
				// بررسی وضعیت فعال یا غیرفعال
				$class = '';
				if ( strpos( $link, 'current' ) !== false ) {
					$class = 'active';
				} elseif ( strpos( $link, 'next' ) !== false || strpos( $link, 'prev' ) !== false ) {
					$class = '';
				}

				// بررسی غیرفعال بودن لینک قبلی
				if ( strpos( $link, 'prev page-numbers' ) !== false && $current === 1 ) {
					echo '<li class="page-item disabled"><span class="page-link">' . $link . '</span></li>';
				}
				// بررسی غیرفعال بودن لینک بعدی
                elseif ( strpos( $link, 'next page-numbers' ) !== false && $current == $total ) {
					echo '<li class="page-item disabled"><span class="page-link">' . $link . '</span></li>';
				}
				else {
					echo '<li class="page-item ' . esc_attr( $class ) . '">' . str_replace( 'page-numbers', 'page-link', $link ) . '</li>';
				}
			endforeach; ?>
        </ul>
    </nav>
<?php endif; ?>
