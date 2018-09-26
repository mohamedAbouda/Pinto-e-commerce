window.Vue = require('vue');
window.Event = new Vue();
window.axios = require('axios');
window.slider = require('bootstrap-slider');
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

Vue.component('search-parameters', require('./components/parameters.vue'));
Vue.component('product-grid', require('./components/product-grid.vue'));
Vue.component('grid', require('./components/grid.vue'));
Vue.component('pagination', require('../components/pagination.vue'));

const app = new Vue({
    el: '#app',
    data() {
        return {
            loading_screen : false,
            products : [],
            pagination : {},
            page : 1,
            page_offset : 0,
            search_params : {},
            resources_url : "",
            grid_style : true,
            sort_by_placeholder_text : "newest"
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

        /**
        * Load the first patch of resources.
        */
        Event.$on('load-resources-first-patch' , function(url) {
            vm.resources_url = url;
            vm.load(1 ,{});
        });
        /**
        * Listen for when the pagination page is selected.
        */
        Event.$on('pagination-change-page' , function(index) {
            vm.page = index ? index : page;
            vm.load(vm.page);
        });
        /**
        * Listen for when the pagination page is selected.
        */
        Event.$on('search-parameters-change' , function(params) {
            vm.page = 1;
            vm.search_params = params;
            vm.load(vm.page ,params);
        });
    },
    methods : {
        load(page ,search_params = {}) {
            var vm = this;

            /**
            * Show loading screen
            */
            vm.loading_screen = true;

            vm.search_params.page = page;

            if("sort" in search_params){
                vm.search_params.sort = search_params.sort;
            }

            axios({
                method: 'post',
                url: vm.resources_url,
                params: vm.search_params
            }).then(function (response) {
                vm.pagination = response.data;
                vm.page_offset = vm.pagination.per_page * vm.page - vm.pagination.per_page;
                vm.products = vm.pagination.data;
                /**
                * Each time you load some resources go update the pagination
                * with the new pagination info
                */
                Event.$emit('resources-ajax-fetch', vm.pagination);
                /**
                * Hide loading screen
                */
                vm.loading_screen = false;
            });
        }
    }
});
