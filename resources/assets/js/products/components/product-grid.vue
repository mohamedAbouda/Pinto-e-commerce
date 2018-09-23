<template>
    <div class="col-xs-12 col-sm-6 col-md-4" v-if="product">
        <!-- .pro-text -->
        <div class="pro-text text-center">
            <!-- .pro-img -->
            <div class="pro-img">
                <img :src="product.cover_image_url" :alt="product.name">
                <sup class="sale-tag" v-if="product.discount">sale!</sup>
                <sup class="sale-tag" style="right: 5px;left:inherit;" v-if="product.featured == 1">
                    Hot!
                </sup>
                <!-- .hover-icon -->
                <div class="hover-icon">
                    <a @click.prevent="wishlist(product.id)">
                        <span class="icon icon-Heart"></span>
                    </a>
                    <a :href="url">
                        <span class="icon icon-Search"></span>
                    </a>
                    <a @click.prevent="addCompare(product.id)">
                        <span class="icon icon-Restart"></span>
                    </a>
                </div>
                <!-- /.hover-icon -->
            </div>
            <!-- /.pro-img -->
            <div class="pro-text-outer">
                <span>
                    {{ product.sub_category.name }}
                </span>
                <a :href="url">
                    <h4> {{ product.name }} </h4>
                </a>
                <p class="wk-price">${{ product.discount ? product.price - (product.discount.percentage * product.price / 100) : product.price }}</p>
            </div>
        </div>
        <!-- /.pro-text -->
    </div>
</template>

<script>
export default {
    props: ["product","product_url"],
    computed: {
        url: function () {
            return this.product_url.replace('zzz', this.product.id);
        }
    },
    methods: {
        wishlist: function(id){
            window.wishlist(id);
        },
        addCompare: function(id){
            window.addCompare(id);
        }
    }
}
</script>
