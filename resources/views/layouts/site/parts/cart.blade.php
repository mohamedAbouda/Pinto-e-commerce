<div class="cart-list">
    <span class="close-left js-close">x</span>
    <h3 class="cart-title">Your Cart</h3>
    <?php if ($cart->count() <= 0): ?>
        <div class="nocart-list">
            <div class="empty-cart">
                <h4 class="nocart-title">No products in the cart.</h4>
                <a href="{{ route('web.products.shop') }}" class="btn-shop btn-arrow">Start shopping</a>
                <a href="{{ route('web.active.orders') }}" class="btn-shop" style="margin-top : 20px;">Active orders</a>
                <a href="{{ route('web.history.orders') }}" class="btn-shop" style="margin-top : 20px;">History orders</a>
            </div>
        </div>
    <?php else: ?>
        <ul class="list" style="max-height: 100%;overflow-y: hidden;">
            <?php foreach ($cart as $item): ?>
                <li>
                    <a href="#" title="" class="cart-product-image">
                        <img src="{{ $item->options->obj && $item->options->obj->cover_image ? $item->options->obj->cover_image_url : '' }}" alt="Product">
                    </a>
                    <div class="text">
                        <p class="product-name">{{ $item->options->obj && $item->options->obj->name ? $item->options->obj->name : '' }}</p>
                        <p class="product-price">${{ $item->options->obj && $item->options->obj->price ? $item->options->obj->price * $item->qty : '' }}</p>
                        <div class="quantity input-group">
                            <button type="button" class="quantity-left-minus btn btn-number cart-js-minus" data-type="minus" data-field="">
                                <span class="minus-icon">-</span>
                            </button>
                            <input type="text" name="number" value="{{ $item->qty }}" class="product_quantity_number cart-js-number">
                            <button type="button" class="quantity-right-plus btn btn-number cart-js-plus" data-type="plus" data-field="">
                                <span class="plus-icon">+</span>
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="cart-bottom" style="position: relative;">
        <?php if ($cart->count() > 0): ?>
            <p class="total"><span>Subtotal</span> ${{ Cart::subtotal() }}</p>
            <div class="cart-button">
                <a class="checkout" href="{{ route('web.cart.checkout') }}" title="">Check Out</a>
                <a class="edit-cart" href="{{ route('web.cart.index') }}" title="edit cart">View Cart</a>
            </div>
            <a href="{{ route('web.active.orders') }}" class="btn-shop" style="margin-top : 20px;">Active orders</a>
            <a href="{{ route('web.history.orders') }}" class="btn-shop" style="margin-top : 20px;margin-bottom: 20px;">History orders</a>
        <?php endif; ?>
        <a href="{{ route('web.shipping') }}" class="text">Our Shipping & Return Policy</a>
    </div>
    <!-- End cart bottom -->
</div>
