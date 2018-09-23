<template>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <!-- .pro-text -->
        <div class="pro-text">
            <div class="col-xs-12 col-sm-5 col-md-5">
                <!-- .pro-img -->
                <div class="pro-img">
                    <img :src="product.cover_image_url" :alt="product.name">
                    <sup class="sale-tag" v-if="product.discount">sale!</sup>
                    <sup class="sale-tag" style="right: 5px;left:inherit;" v-if="product.featured == 1">
                        Hot!
                    </sup>
                    <!-- .hover-icon -->
                    <div class="hover-icon">
                        <a @click.prevent="wishlist(product.id)" >
                            <span class="icon icon-Heart"></span>
                        </a>
                        <a :href="url">
                            <span class="icon icon-Search"></span>
                        </a>
                        <a @click.prevent="addCompare(product.id)" >
                            <span class="icon icon-Restart"></span>
                        </a>
                    </div>
                    <!-- /.hover-icon -->
                </div>
                <!-- /.pro-img -->
            </div>
            <div class="col-xs-12 col-sm-7 col-md-7">
                <div class="pro-text-outer list-pro-text">
                    <span>
                        {{ product.sub_category.name }}
                    </span>
                    <a :href="url">
                        <h4>
                            {{ product.name }}
                        </h4>
                    </a>
                    <div class="star2">
                        <ul>
                            <li :class="{'yellow-color': product.reviews_avg >= 1}">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </li>
                            <li :class="{'yellow-color': product.reviews_avg >= 2}">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </li>
                            <li :class="{'yellow-color': product.reviews_avg >= 3}">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </li>
                            <li :class="{'yellow-color': product.reviews_avg >= 4}">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </li>
                            <li :class="{'yellow-color': product.reviews_avg >= 5}">
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </li>
                            <li>
                                <a href="#">{{ product.reviews.length }} review(s)</a>
                            </li>
                            <li>
                                <a href="#"> Add your review</a>
                            </li>
                        </ul>
                    </div>
                    <p class="wk-price">${{ product.discount ? product.price - (product.discount.percentage * product.price / 100) : product.price }} </p>
                    <p>
                        {{ product.short_description }}
                    </p>
                    <a @click.prevent="wishlist(product.id)" class="add-btn2">
                        <span class="icon icon-Heart"></span>
                    </a>
                    <a @click.prevent="addCompare(product.id)" class="add-btn2">
                        <span class="icon icon-Restart"></span>
                    </a>
                </div>
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
