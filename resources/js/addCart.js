
$('.add-to-cart').click(function() {
    var productId = $(this).data('product-id');
    var quantity = $('#quantity-' + productId).val();

    var cart = JSON.parse(localStorage.getItem('cart')) || {};
    cart[productId] = (cart[productId] || 0) + 1;

    localStorage.setItem('cart', JSON.stringify(cart));
});