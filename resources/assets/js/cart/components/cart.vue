<template>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 ">
                <div>
                    <div class="text-center">
                        <h3>Shopping Cart</h3>
                    </div>

                    <div class="table-responsive space-padding-tb-60">
                        <table class="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Qty</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item ,key) in cart_items">
                                    <td>
                                        <img :src="item.options.obj.cover_image_url" class="img-responsive" width="80" height="80">
                                    </td>
                                    <td>
                                        {{ item.name }}
                                    </td>
                                    <td>
                                        {{ item.price * item.qty }}
                                    </td>
                                    <td>
                                        {{ item.options.size }}
                                    </td>
                                    <td>
                                        {{ item.options.color }}
                                    </td>
                                    <td class="cart-list">
                                        <div class="quantity input-group">
                                            <button type="button" class="quantity-left-minus btn btn-number" @click="item.qty = item.qty <= 0 ? 0 : item.qty - 1;updateSubTotal();">
                                                <span class="minus-icon">-</span>
                                            </button>
                                            <input type="text" name="number" v-model="item.qty" class="product_quantity_number">
                                            <button type="button" class="quantity-right-plus btn btn-number" @click="++item.qty;updateSubTotal();">
                                                <span class="plus-icon">+</span>
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn" style="background-color: transparent;outline:none;" @click="remove(key)"><i class="icon-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h3 style="margin-bottom: 30px;">Cart Totals</h3>
                <div class="text-price">
                    <ul>
                        <li>
                            <span class="text">Subtotal</span>
                            <span class="number">${{ subtotal }}</span>
                        </li>
                        <li>
                            <span class="text">Shipping</span>
                            <div class="payment">
                                <input type="radio" name="gender" value="Flat" id="radio1" checked="checked">
                                <label for="radio1">Free Shipping</label>
                                <input type="radio" name="gender" value="Free" id="radio2">
                                <label for="radio2">Standard <span class="number">$20.00</span></label>
                                <input type="radio" name="gender" value="Delivery" id="radio3">
                                <label for="radio3">Local Pickup</label>

                            </div>
                        </li>
                        <li><span class="text calculate">Calculate shipping</span>
                            <div class="zipcode">
                                <input type="text" class="form-control form-account input-cart" placeholder="Zipcode">
                            </div>
                        </li>
                        <li><span class="text">Totals</span><span class="number">$89.00</span></li>
                    </ul>
                </div>
                <div class="text-price box-payment">
                    <ul>
                        <li>
                            <div class="payment">
                                <input type="radio" name="gender" value="Flat" id="radio4" checked="checked">
                                <label for="radio4">Check Payments</label>
                                <p class="no-checkbox">Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                <input type="radio" name="gender" value="Free" id="radio5">
                                <label for="radio5">Paypal <img src="img/cart/paypal-icon.jpg" alt=""></label>
                            </div>
                        </li>
                    </ul>
                </div>
                <a class="btn link-button hover-white btn-checkout" href="#" title="Proceed to checkout">Place order</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        cart: {
            default: []
        },
    },
    data() {
        return {
            cart_items : [],
            subtotal : 0,
        }
    },
    watch: {
        cart_items: function(){
            this.updateSubTotal();
        }
    },
    // updated: function () {
    //     var subtotal = 0;
    //     for (var key in this.cart_items) {
    //         subtotal += this.cart_items[key].qty * this.cart_items[key].price;
    //     }
    //     this.subtotal = subtotal;
    // },
    // computed: {
    //     subtotal: function () {
    //         var subtotal = 0;
    //         for (var item in cart) {
    //             subtotal += item.qty * item.price;
    //         }
    //         return subtotal;
    //     }
    // },
    created() {
        for (var key in this.cart) {
            this.cart_items.push(this.cart[key]);
        }
        var subtotal = 0;
        for (var key in this.cart_items) {
            subtotal += this.cart_items[key].qty * this.cart_items[key].price;
        }
        this.subtotal = subtotal;
    },
    methods : {
        updateSubTotal(){
            var subtotal = 0;
            for (var key in this.cart_items) {
                subtotal += this.cart_items[key].qty * this.cart_items[key].price;
            }
            this.subtotal = subtotal;
        },
        remove(key){
            this.cart_items.splice(key, 1);
        }
    }
}
</script>
