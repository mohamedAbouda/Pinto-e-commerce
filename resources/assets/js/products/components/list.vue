<template>
    <div>
        <product-list v-for="(product ,index) in products" :product="product" :product_url="product_url"></product-list>
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
	}
}
</script>
