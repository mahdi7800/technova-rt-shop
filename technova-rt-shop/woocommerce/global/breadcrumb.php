<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) : ?>
	<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
		<div class="container d-flex align-items-center justify-content-between">
			<ol class="breadcrumb">
				<?php foreach ( $breadcrumb as $key => $crumb ) : ?>
					<li class="breadcrumb-item<?php echo ( sizeof( $breadcrumb ) === $key + 1 ) ? ' active' : ''; ?>"<?php echo ( sizeof( $breadcrumb ) === $key + 1 ) ? ' aria-current="page"' : ''; ?>>
						<?php if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) : ?>
							<a href="<?php echo esc_url( $crumb[1] ); ?>"><?php echo esc_html( $crumb[0] ); ?></a>
						<?php else : ?>
							<?php echo esc_html( $crumb[0] ); ?>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</nav>
<?php endif; ?>