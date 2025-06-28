<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $total <= 0 ) {
	return;
}

$first = ( $per_page * $current ) - $per_page + 1;
$last  = min( $total, $per_page * $current );
?>

<div class="toolbox-center">
    <div class="toolbox-info">
		<?php if ( 1 === intval( $total ) ) : ?>
            نمایش <span>1</span> محصول
		<?php else : ?>
            نمایش <span><?php echo esc_html( $last ); ?> از <?php echo esc_html( $total ); ?></span> محصول
		<?php endif; ?>
    </div><!-- End .toolbox-info -->
</div><!-- End .toolbox-center -->
