@foreach($products as $product)
    <form action="{{route('cart.add')}}" method="post">
        @csrf

        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <div id="quantity-controls-{{ $product->id }}" style="display: none;" data-product-id="{{ $product->id }}" data-quantity="{{ $cart[$product->id] ?? 0 }}">
                        <button type="button" onclick="changeQuantity('quantity-{{ $product->id }}', '{{ $product->id }}', 'reduce')">-</button>
                        <input type="number" name="quantity" id="quantity-{{ $product->id }}" value="{{$cart[$product->id] ?? 1 }}" >
                        <button type="button" onclick="changeQuantity('quantity-{{ $product->id }}', '{{ $product->id }}', 'add')">+</button>
                    </div>
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <button id="add-to-cart-{{ $product->id }}" class="btn btn-primary add-to-cart" type="submit" onclick="showQuantityControls('{{ $product->id }}')">Add to Cart</button>
                </div>
            </div>
        </div>
    </form>
@endforeach

<script>
window.onload = function() {
    // Get all the quantity controls
    var quantityControls = document.querySelectorAll('[id^="quantity-controls-"]');

    // Loop through the quantity controls
    for (var i = 0; i < quantityControls.length; i++) {
        // Get the product ID and quantity from the data attributes
        var productId = quantityControls[i].getAttribute('data-product-id');
        var quantity = parseInt(quantityControls[i].getAttribute('data-quantity'));

        // Check the initial quantity of each product
        if (quantity > 0) {
            showQuantityControls(productId);
        }
    }
};

function changeQuantity(id, productId, action) {
    var value = parseInt(document.getElementById(id).value, 10);
    value = isNaN(value) ? 0 : value;
    if (action === 'add') {
        value++;
    } else if (action === 'reduce') {
        value < 1 ? value = 1 : '';
        value--;
    }
    document.getElementById(id).value = value;

    // Determine the URL based on the action
    var url = action === 'add' ? '/add' : '/reduce';

    // Send an AJAX request to the server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    xhr.send('product_id=' + productId + '&quantity=' + value);

    if (value === 0) {
        document.getElementById('quantity-controls-' + productId).style.display = 'none';
        document.getElementById('add-to-cart-' + productId).style.display = 'block';
    }
}

function showQuantityControls(productId) {
    document.getElementById('quantity-controls-' + productId).style.display = 'block';
    document.getElementById('add-to-cart-' + productId).style.display = 'none';
}
</script>
