<?php
class Pagination {
	public static function paginate( $query = null ): string {
		global $wp_query;

		if ( ! $query || ! is_a( $query, 'WP_Query' ) ) {
			$query = $wp_query;
		}

		$paged = max( 1, get_query_var( 'paged', 1 ) );
		$max = $query->max_num_pages;

		if ( $max <= 1 ) {
			return '';
		}

		$big = 999999999; // Unique placeholder
		$base = ( is_category() )
			? str_replace( $big, '%#%', esc_url( get_category_link( get_queried_object_id() ) . 'page/%#%/' ) )
			: str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );

		$args = [
			'base'      => $base,
			'format'    => ( get_option('permalink_structure') ? 'page/%#%/' : '?paged=%#%' ),
			'current'   => $paged,
			'total'     => $max,
			'type'      => 'array',
			'end_size'  => 1,
			'mid_size'  => 1,
			'prev_text' => '',
			'next_text' => '',
		];

		$pages = paginate_links( $args );

		if ( ! is_array( $pages ) ) {
			return '';
		}

		$output = '<nav aria-label="Page navigation">';
		$output .= '<ul class="pagination">';

		// Prev Button
		if ( $paged > 1 ) {
			$output .= '<li class="page-item">';
			$output .= '<a class="page-link page-link-prev" href="' . esc_url( get_pagenum_link( $paged - 1 ) ) . '" aria-label="Previous">';
			$output .= '<span aria-hidden="true"><i class="icon-long-arrow-right"></i></span> قبلی';
			$output .= '</a>';
			$output .= '</li>';
		} else {
			$output .= '<li class="page-item disabled">';
			$output .= '<a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">';
			$output .= '<span aria-hidden="true"><i class="icon-long-arrow-right"></i></span> قبلی';
			$output .= '</a>';
			$output .= '</li>';
		}

		// Page Numbers
		foreach ( $pages as $page ) {
			if ( strpos( $page, 'current' ) !== false ) {
				$output .= '<li class="page-item active" aria-current="page">' . str_replace( 'page-numbers', 'page-link', $page ) . '</li>';
			} else {
				$output .= '<li class="page-item">' . str_replace( 'page-numbers', 'page-link', $page ) . '</li>';
			}
		}

		// Next Button
		if ( $paged < $max ) {
			$output .= '<li class="page-item">';
			$output .= '<a class="page-link page-link-next" href="' . esc_url( get_pagenum_link( $paged + 1 ) ) . '" aria-label="Next">';
			$output .= 'بعدی <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>';
			$output .= '</a>';
			$output .= '</li>';
		} else {
			$output .= '<li class="page-item disabled">';
			$output .= '<a class="page-link page-link-next" href="#" aria-label="Next" tabindex="-1" aria-disabled="true">';
			$output .= 'بعدی <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>';
			$output .= '</a>';
			$output .= '</li>';
		}

		$output .= '</ul>';
		$output .= '</nav>';

		return $output;
	}
}
?>
