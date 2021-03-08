(function($) {
  'use strict';
  // Horizontal menu toggle fuction for mobile
  $(".navbar.horizontal-layout .navbar-menu-wrapper .navbar-toggler").on("click", function() {
    $(".navbar.horizontal-layout").toggleClass("header-toggled");
  });
})(jQuery);
