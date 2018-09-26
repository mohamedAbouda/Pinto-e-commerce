<template>
    <div class="row">
        <product-grid v-for="(product ,index) in products" :product="product" :product_url="product_url"></product-grid>
    </div>
</template>

<script>
export default {
    props: {
		url: {
			default: ''
		},
        product_url: {
			default: ''
		},
        products: {
			default: () => []
		},
        pagination: {
			default: () => {}
		}
	},
    created() {
        var vm = this;
        Event.$emit('load-resources-first-patch', vm.url);
    }
}
</script>
