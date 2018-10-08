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
                            <div class="payment" style="width:100%;">
                                <template v-for="(shipping ,index) in shipping_methods">
                                    <input type="radio" name="shipping_method" :value="shipping.id" :id="'shipptinh-radio-' + index" checked>
                                    <label :for="'shipptinh-radio-' + index" @click="selected_shipping_method = shipping">
                                        {{ shipping.name }} <span class="number">${{ shipping.cost }}</span>
                                    </label>
                                </template>
                            </div>
                        </li>
                        <li><span class="text">Totals</span><span class="number">${{ total_cost }}</span></li>
                    </ul>
                </div>
                <div class="text-price box-payment">
                    <ul>
                        <li>
                            <div class="payment">
                                <input type="radio" name="payment_method" value="cash" id="payment_method" checked="checked">
                                <label for="payment_method">Cash</label>
                                <!-- <p class="no-checkbox">Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p> -->
                            </div>
                        </li>
                    </ul>
                </div>
                <a class="btn link-button hover-white btn-checkout" title="Proceed to checkout" @click="order();">Place order</a>
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
        shipping_methods: {
            default: []
        },
        checkout_url: {
            default: ''
        }
    },
    data() {
        return {
            cart_items : [],
            subtotal : 0,
            selected_shipping_method : undefined,
            total_cost : 0
        }
    },
    watch: {
        cart_items: function(){
            this.updateSubTotal();
        },
        selected_shipping_method: function(){
            this.updateTotalCost();
        },
        subtotal: function(){
            this.updateTotalCost();
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

        if (this.shipping_methods.length > 0 && !this.selected_shipping_method) {
            this.selected_shipping_method = this.shipping_methods[this.shipping_methods.length - 1];
            // this.updateTotalCost();
        }
    },
    methods : {
        updateSubTotal(){
            var subtotal = 0;
            for (var key in this.cart_items) {
                subtotal += this.cart_items[key].qty * this.cart_items[key].price;
            }
            this.subtotal = subtotal;
        },
        updateTotalCost(){
            this.total_cost = this.subtotal;

            if (this.selected_shipping_method) {
                var cost =  parseFloat(this.selected_shipping_method.cost);
                this.total_cost += cost;
            }
        },
        remove(key){
            this.cart_items.splice(key, 1);
        },
        order(){
            /**
            * Show loading screen
            */
            Event.$emit('show-loading-screen');
            var data = {
                cart: [],
                shipping_method: this.selected_shipping_method.id,
            };
            for (var cart_key in this.cart_items) {
                data.cart.push(this.cart_items[cart_key]);
            }
            var vm = this;
            axios({
                method: 'POST',
                params: data,
                url: vm.checkout_url
            }).then(function (response) {
                console.log(response);
                if (response.data.redirectTo != undefined) {
                    window.location = response.data.redirectTo;
                }
            });
        }
    }
}
</script>
