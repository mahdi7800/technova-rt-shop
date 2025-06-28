<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
get_template_part('partials/nav/menu', 'menu');

if ( is_search() ) {
	$page_title = 'نتایج جستجو برای: "' . get_search_query() . '"';
} elseif ( is_product_category() ) {
	$page_title = 'دسته‌بندی: ' . single_cat_title('', false);
} elseif ( is_product_tag() ) {
	$page_title = 'برچسب: ' . single_tag_title('', false);
} else {
	$page_title = 'فروشگاه';
}
?>

    <div class="page-header text-center" style="background-image: url('<?php echo TNS_URL . '/assets/images/page-header-bg.jpg' ?>')">
        <div class="container-fluid">
            <h1 class="page-title"><?php echo $page_title; ?></h1>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container-fluid">
            <ol class="breadcrumb">
				<?php woocommerce_breadcrumb(); ?>
            </ol>
        </div>
    </nav>

<?php do_action( 'woocommerce_before_main_content' ); ?>

    <div class="page-content">
        <div class="container-fluid">

			<?php do_action( 'woocommerce_shop_loop_header' ); ?>

			<?php if ( woocommerce_product_loop() ) : ?>

                <div class="toolbox">
                    <div class="toolbox-left">
<!--                        <a href="#" class="sidebar-toggler"><i class="icon-bars"></i>فیلتر ها</a>-->
                    </div>
					<?php do_action( 'woocommerce_before_shop_loop' ); ?>
                </div>

                <div class="products">
                    <div class="row">
						<?php
						woocommerce_product_loop_start();

						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();

								do_action( 'woocommerce_shop_loop' );

								wc_get_template_part( 'content', 'product' );
							}
						}

						woocommerce_product_loop_end();
						?>
                    </div><!-- .row -->
                </div><!-- .products -->

				<?php do_action( 'woocommerce_after_shop_loop' ); ?>

			<?php else : ?>

				<?php do_action( 'woocommerce_no_products_found' ); ?>

			<?php endif; ?>
        </div><!-- .container-fluid -->
    </div><!-- .page-content -->

<?php
do_action( 'woocommerce_after_main_content' );
do_action( 'woocommerce_sidebar' );
get_footer( 'shop' );
