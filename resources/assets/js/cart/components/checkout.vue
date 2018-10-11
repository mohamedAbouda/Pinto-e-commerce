<template>
    <div class="container">
        <form method="post" class="checkout" :action="checkout_url">
            <div class="cart-box-container-ver2">
                <div class="row">
                    <div class="col-md-8">
                        <h3>Billing Details</h3>
                        <div class="row form-customer">
                            <div class="form-group col-md-12">
                                <label for="name" class=" control-label">Full name *</label>
                                <input type="text" name="name" id="name" class="form-control form-account" v-model="client.name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class=" control-label">Email Address</label>
                                <input type="email" name="email" id="email" v-model="client.email" class="form-control form-account">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class=" control-label">Phone</label>
                                <input type="text" name="phone" id="phone" v-model="client.phone" class="form-control form-account">
                            </div>
                        </div>
                        <h3>Shipping Details</h3>
                        <div class="row form-customer">
                            <div class="form-group col-md-12">
                                <label for="address_id" class="control-label">Address</label>
                                <select name="address_id" id="address_id" class="country form-control form-account" :disabled="new_address">
                                    <option selected>Select address</option>
                                    <option v-for="address in addresses" :value="address.id">
                                        {{ address.country }} - {{ address.city }} - {{ address.address }}
                                    </option>
                                </select>
                            </div>

                            <div class="form-check col-md-12">
                                <label class="form-check-label ver2">
                                    <input type="checkbox" class="form-check-input" name="new_address" value="1" v-model="new_address">
                                    <span>Ship to a different address?</span>
                                </label>
                            </div>
                            <div v-show="new_address">
                                <div class="form-group col-md-6">
                                    <label for="country" class="control-label">Country</label>
                                    <select name="country" class="country form-control form-account">
                                        <option selected>Select country</option>
                                        <option v-for="country in countries" :value="country.id">
                                            {{ country.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="city" class="control-label">Town / City</label>
                                    <input type="text" name="city" id="city" class="form-control form-account">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="address" class=" control-label">Address</label>
                                    <input type="text" name="address" id="address" class="form-control form-account">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="postal_code" class=" control-label">Postcode / ZIP</label>
                                <input type="text" name="postal_code" id="postal_code" class="form-control form-account">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="note" class=" control-label">Order Notes</label>
                                <textarea name="note" rows="5" id="note" class="form-control form-note" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h3>Your order</h3>
                        <div class="cart-list">
                            <ul class="list">
                                <li class="flex" v-for="(item ,key) in cart_items">
                                    <a class="cart-product-image">
                                        <img :src="item.options.obj.cover_image_url" alt="Product">
                                    </a>
                                    <div class="text">
                                        <p class="product-name">{{ item.name }}</p>
                                        <div class="quantity">x{{ item.qty }}</div>
                                        <p class="product-price">${{ item.price * item.qty }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3>Cart Totals</h3>
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

                        <input type="hidden" name="subtotal" v-model="subtotal">
                        <input type="hidden" name="total_cost" v-model="total_cost">
                        <input type="hidden" name="_token" :value="csrfToken">
                        <button type="submit" class="btn link-button hover-white btn-checkout"title="Proceed to checkout">
                            Proceed to checkout
                        </button>
                    </div>
                </div>
            </div>
        </form>
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
        addresses: {
            default: []
        },
        countries: {
            default: []
        },
        client: {
            default: {}
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
            total_cost : 0,
            new_address : false,
            csrfToken : window.Laravel.csrfToken
        }
    },
    watch: {
        selected_shipping_method: function(){
            this.updateTotalCost();
        },
        subtotal: function(){
            this.updateTotalCost();
        }
    },
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
        }
    },
    methods : {
        updateTotalCost(){
            this.total_cost = this.subtotal;

            if (this.selected_shipping_method) {
                var cost =  parseFloat(this.selected_shipping_method.cost);
                this.total_cost += cost;
            }
        }
    }
}
</script>
