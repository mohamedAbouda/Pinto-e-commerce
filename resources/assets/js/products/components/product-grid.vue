<template>
    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3 product-item" v-if="product">
        <div class="product-images">
            <a :href="url" class="hover-images effect">
                <img :src="product.cover_image_url" :alt="product.name" class="img-reponsive">
            </a>
            <!-- <div class="ribbon-new ver2"><span>new</span></div> -->
            <div class="ribbon-sale ver2" v-if="product.discount"><span>sale</span></div>
            <a class="btn-add-wishlist ver2" @click.prevent="wishlist(product.id)"><i class="icon-heart"></i></a>
            <a href="#" class="btn-quickview" data-toggle="modal" data-target="#quickview">QUICK VIEW</a>
        </div>
        <div class="product-info-ver2">
            <h3 class="product-title"><a href="single-product.html">{{ product.name }}</a></h3>
            <div class="product-after-switch">
                <div class="product-price">${{ product.discount ? product.price - (product.discount.percentage * product.price / 100) : product.price }}</div>
                <div class="product-after-button">
                    <a href="#" class="addcart">ADD TO CART</a>
                </div>
            </div>
            <div class="rating-star">
                <span class="star star-5" v-if="product.rate >= 1"></span>
                <span class="star star-4" v-if="product.rate >= 2"></span>
                <span class="star star-3" v-if="product.rate >= 3"></span>
                <span class="star star-2" v-if="product.rate >= 4"></span>
                <span class="star star-1" v-if="product.rate >= 5"></span>
            </div>
            <p class="product-desc">{{ product.short_description }}</p>
            <div class="product-price">${{ product.discount ? product.price - (product.discount.percentage * product.price / 100) : product.price }}</div>
            <div class="button-group">
                <a href="#" class="button add-to-cart">Add to cart</a>
                <a href="#" class="button add-to-wishlist" @click.prevent="wishlist(product.id)">Add to wishlist</a>
                <a href="#" class="button add-view">Quick view</a>
            </div>
        </div>
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
