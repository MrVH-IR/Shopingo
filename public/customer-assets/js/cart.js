$(document).ready(function() {
    bill();

    $('.cart-number').click(function() {
        bill();
    });
});

function bill() {
    let total_product_price = 0;
    let total_discount = 0;
    let total_price = 0;

    $('.number').each(function() {
        const product_price = parseFloat($(this).data('product-price'));
        const product_discount = parseFloat($(this).data('product-discount'));
        const numbers = parseFloat($(this).val());

        total_product_price += product_price * numbers;
        total_discount += product_discount * numbers;
    });

    total_price = total_product_price - total_discount;

    const utils = new Utils();

    $('#total_product_price').html(utils.toFarsiNumber(total_product_price));
    $('#total_discount').html(utils.toFarsiNumber(total_discount));
    $('#total_price').html(utils.toFarsiNumber(total_price));
}
