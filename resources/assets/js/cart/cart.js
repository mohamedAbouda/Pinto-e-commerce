window.Vue = require('vue');
window.Event = new Vue();
window.axios = require('axios');
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

Vue.component('checkout', require('./components/checkout.vue'));
Vue.component('cart', require('./components/cart.vue'));

const app = new Vue({
    el: '#app',
    data() {
        return {
            loading_screen : false,
        }
    },
    created() {
        var vm = this;
        Event.$on('show-loading-screen' , function() {
            vm.loading_screen = true;
        });
        Event.$on('hide-loading-screen' , function() {
            vm.loading_screen = false;
        });
    },
    methods : {
    }
});
