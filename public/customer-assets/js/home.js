$('.brands').owlCarousel({

    rtl: true,
    loop: true,
    margin: 18,
    nav: true,
    dots: false,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    smartSpeed: 700,

    onInitialized: function () {

        $('.brands .owl-prev span').html('<i class="fas fa-chevron-right"></i>');
        $('.brands .owl-next span').html('<i class="fas fa-chevron-left"></i>');

    },

    responsive:{
        0:{ items:2 },
        576:{ items:3 },
        768:{ items:4 },
        992:{ items:5 },
        1200:{ items:6 }
    }

});
