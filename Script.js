(function ($) {

  "use strict";

  var initPreloader = function () {
    $(document).ready(function ($) {
      var Body = $('body');
      Body.addClass('preloader-site');
    });
    $(window).on('load', function () {
      $('.preloader-wrapper').fadeOut();
      $('body').removeClass('preloader-site');
    });
  };

  
  var initScrollNav = function () {
    $(window).on('scroll', function () {
      var scroll = $(window).scrollTop();

      if (scroll >= 200) {
        $('.navbar.fixed-top').addClass("bg-light");
      } else {
        $('.navbar.fixed-top').removeClass("bg-light");
      }
    });
  };

  // Initialize Chocolat lightbox for gallery images
  var initChocolat = function () {
    if ($('.image-link').length) {
      Chocolat(document.querySelectorAll('.image-link'), {
        imageSize: 'contain',
        loop: true,
      });
    }
  };

  // Initialize product quantity increment/decrement
  var initProductQty = function () {
    $('.product-qty').each(function () {
      var $el_product = $(this);

      $el_product.find('.quantity-right-plus').click(function (e) {
        e.preventDefault();
        var quantity = parseInt($el_product.find('.quantity-input').val());
        $el_product.find('.quantity-input').val(quantity + 1);
      });

      $el_product.find('.quantity-left-minus').click(function (e) {
        e.preventDefault();
        var quantity = parseInt($el_product.find('.quantity-input').val());
        if (quantity > 0) {
          $el_product.find('.quantity-input').val(quantity - 1);
        }
      });
    });
  };

  // Initialize Swiper sliders
  var initSliders = function () {
    if ($('.product-thumbnail-slider').length && $('.product-large-slider').length) {
      var thumb_slider = new Swiper(".product-thumbnail-slider", {
        loop: true,
        slidesPerView: 3,
        autoplay: true,
        direction: "vertical",
        spaceBetween: 30,
      });

      new Swiper(".product-large-slider", {
        loop: true,
        slidesPerView: 1,
        autoplay: true,
        effect: 'fade',
        thumbs: {
          swiper: thumb_slider,
        },
      });
    }
  };

  // Initialize Isotope for masonry layout
  var initIsotope = function () {
    if ($('.entry-container').length) {
      var $grid = $('.entry-container').isotope({
        itemSelector: '.entry-item',
        layoutMode: 'masonry'
      });

      // Relayout Isotope on image load
      $grid.imagesLoaded().progress(function () {
        $grid.isotope('layout');
      });
    }
  };

  // Document ready
  $(document).ready(function () {
    initPreloader();
    initScrollNav();
    initChocolat();
    initProductQty();
    initSliders();
    initIsotope();
  });

})(jQuery);
