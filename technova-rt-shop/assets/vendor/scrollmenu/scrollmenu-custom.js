jQuery(document).ready(function () {
  // jquery.serialscrolling initialisation
  jQuery('[data-serialscrolling]').serialscrolling();




  var pageHeaderheight = jQuery(".sticky-header").height();
  window.addEventListener("scroll", function () {
    if (window.pageYOffset > 200) {
        jQuery(".navbar-product").css(
                "top",
                pageHeaderheight - 39
            );
    }
});
});