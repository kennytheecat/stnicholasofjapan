"use strict";

/* 
 * Toggles side mobile menu on or off
 */
jQuery(document).ready(function ($) {
  $(".mobile-menu").click(function () {
    // Calling a function in case you want to expand upon this.
    toggleNav();
  });

  function toggleNav() {
    if ($('.site-wrapper').hasClass('show-nav')) {
      // Do things on Nav Close
      $('.site-wrapper').removeClass('show-nav');
    } else {
      // Do things on Nav Open
      $('.site-wrapper').addClass('show-nav');
    } //$('#site-wrapper').toggleClass('show-nav');

  }
});

/* 
 * Trying to toggle sub menus
 */

jQuery(document).ready(function ($) {
  $(".menu-item-has-children span").click(function () {
    // Calling a function in case you want to expand upon this.
    $(this).toggleClass('mobile-button-button mobile-button-opened');
  });
});
jQuery(document).ready(function ($) {
  $(".current-menu-ancestor > span").toggleClass('mobile-button-button mobile-button-opened');
}); // new javascript function becasue Jeb wasnts them menu to be click based

/* 
 * Toggles search on and off
 */

jQuery(document).ready(function ($) {
  $(".search-mobile").click(function () {
    $("#search-container").slideToggle('slow', function () {
      $('.search-mobile').toggleClass('active');
    }); // Optional return false to avoid the page "jumping" when clicked

    return false;
  });
  $(".search-not-mobile").click(function () {
    $("#search-container").slideToggle('slow', function () {
      $('.search-not-mobile').toggleClass('active');
    }); // Optional return false to avoid the page "jumping" when clicked

    return false;
  });
});