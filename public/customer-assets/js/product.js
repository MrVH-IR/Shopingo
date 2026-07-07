$(document).ready(() => {
    bill();
    // input color
    $('input[name="color"]').change(function () {
        bill();
    });

    // Guarantee
    $('input[name="guarantee"]').change(function () {
        bill();
    });

    // Number of product
    $('.cart-number').click(function () {
        bill();
    });
});

function bill() {
    if ($('input[name="color"]:checked').length !== 0) {
        var selected_color = $('input[name="color"]:checked');
        $("#selected_color_name").html(selected_color.attr('data-color-name'));
    }

    // Price Computing
    var selected_color_price = 0;
    const selectedGuarantee = $('input[name="guarantee"]:checked');
    var number = 1;
    var product_discount_price = 0;
    var product_original_price = parseFloat($('#product_price').attr('data-product-original-price'));
    if ($('input[name="color"]:checked').length !== 0) {
        selected_color_price = parseFloat(selected_color.attr('data-color-price'));
    }
    if (selectedGuarantee.length) {
        selected_guarantee_price = parseFloat(
            selectedGuarantee.data('guarantee-price')
        ) || 0;
    }
    if ($('#number').val() > 0) {
        number = parseFloat($('#number').val());
    }

    if ($('#product-discount-price').length !== 0) {
        product_discount_price = parseFloat($('#product-discount-price').attr('data-product-discount-price'));
    }
    // Final Price

    let utils = new Utils();

    var product_price =
        product_original_price +
        selected_color_price +
        selected_guarantee_price;

    var final_price =
        number *
        (product_price - product_discount_price);

    $('#product_price')
        .html(utils.toFarsiNumber(product_price))
        .addClass('price-updated');

    $('#final_price')
        .html(utils.toFarsiNumber(final_price))
        .addClass('price-updated');

    setTimeout(() => {

        $('#product_price').removeClass('price-updated');
        $('#final_price').removeClass('price-updated');

    },250);
}

$(document).on('click', '.product-gallery-thumb', function () {

    const image = $(this).data('image');

    $('#mainProductImage')
        .fadeOut(120, function () {

            $(this)
                .attr('src', image)
                .fadeIn(120);

        });

    $('.product-gallery-thumb').removeClass('active');

    $(this).addClass('active');

});

//start product introduction, features and comment
$(document).ready(function() {
    var s = $("#introduction-features-comments");
    var pos = s.position();
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();

        if (windowpos >= pos.top) {
            s.addClass("stick");
        } else {
            s.removeClass("stick");
        }
    });
});
//end product introduction, features and comment
const mainImage = document.getElementById("mainProductImage");

const imageModal = document.getElementById("imageModal");

const modal = new bootstrap.Modal(imageModal);

document.getElementById("zoomImage").addEventListener("click", function () {

    document.getElementById("modalImage").src = mainImage.src;

    modal.show();

});
document.querySelectorAll('.gallery-thumb').forEach(function (button) {

    button.addEventListener('click', function () {

        document.querySelectorAll('.gallery-thumb').forEach(function (item) {

            item.classList.remove(
                'border-blue-500',
                'shadow-lg'
            );

            item.classList.add('border-transparent');

        });

        this.classList.remove('border-transparent');

        this.classList.add(
            'border-blue-500',
            'shadow-lg'
        );

        document.getElementById('mainProductImage').src =
            this.querySelector('img').dataset.image;

    });

});
