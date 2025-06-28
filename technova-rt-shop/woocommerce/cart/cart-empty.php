<?php
defined('ABSPATH') || exit;

// نمایش پیام خالی بودن سبد خرید (هوک ووکامرس)
do_action('woocommerce_cart_is_empty');
?>

<main class="main">
    <div class="page-header text-center" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title"><?php echo get_the_title(); ?></h1>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
             <?php woocommerce_breadcrumb(); ?>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="page404-bg text-center">
                    <div class="page404-text">
                        <div class="empty-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/empty3.png" alt="سبد خرید خالی">
                        </div>
                        <div class="empty-text display-3">سبد خرید شما خالی است!</div>

                        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-outline-primary-2 btn-order mt-3">
                            <span>رفتن به فروشگاه و شروع خرید</span><i class="icon-long-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
