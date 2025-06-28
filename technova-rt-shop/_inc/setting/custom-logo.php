<?php
function tns_replace_wp_login_logo() {
    ?>
    <style type="text/css">
        /* حذف کامل لوگوی پیشفرض وردپرس */
        .login h1 {
            position: relative;
            height: auto !important;
        }

        .login h1 a {
            display: block;
            background: none !important;
            width: auto !important;
            height: auto !important;
            text-indent: 0 !important;
            font-size: 20px;
            color: #2271b1;
            padding: 0;
        }

        /* استایل لوگوی سفارشی شما */
        .login h1 a::before {
            content: "";
            display: block;
            background-image: url('<?php echo !empty(get_site_icon_url()) ? get_site_icon_url(150) : TNS_URL . '/assets/images/demos/demo-10/logo.png'; ?>');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 200px;
            height: 80px;
            margin: 0 auto;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'tns_replace_wp_login_logo');

function tns_change_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'tns_change_login_logo_url');

function tns_change_login_logo_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'tns_change_login_logo_title');

function tns_remove_wp_logo($wp_admin_bar) {
	$wp_admin_bar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'tns_remove_wp_logo', 999);