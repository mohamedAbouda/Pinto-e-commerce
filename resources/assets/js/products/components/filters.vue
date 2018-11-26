<template>
    <form action="#" method="get" class="form-filter-product js-filter-open">
        <span class="close-left js-close"><i class="icon-close f-20"></i></span>
        <div class="product-filter-wrapper">
            <div class="product-filter-inner text-left">
                <div class="product-filter">
                    <div class="form-group">
                        <span class="title-filter">Category</span>
                        <button class="dropdown-toggle form-control" type="button" data-toggle="dropdown">
                            {{ selected_section_name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li @click.prevent="change({section : undefined});selected_section_index=index;selected_section_name='Select a category'">
                                Select a category
                            </li>
                            <li v-for="(section ,index) in sections" @click.prevent="change({section : section.id});selected_section_index=index;selected_section_name=section.name">
                                {{ section.name }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="product-filter">
                    <div class="form-group">
                        <span class="title-filter">Color</span>
                        <button class="dropdown-toggle form-control" type="button" data-toggle="dropdown">
                            {{ selected_color_name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li @click.prevent="change({color : undefined});selected_color_index=index;selected_color_name='Choose color'">
                                Choose color
                            </li>
                            <li v-for="(color ,index) in colors" @click.prevent="change({color : color.id});selected_color_index=index;selected_color_name=color.name">
                                {{ color.name }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="product-filter">
                    <div class="form-group">
                        <span class="title-filter">Size</span>
                        <button class="dropdown-toggle form-control" type="button" data-toggle="dropdown">
                            {{ selected_size_name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li @click.prevent="change({size : undefined});selected_size_index=index;selected_size_name='Choose size'">
                                Choose size
                            </li>
                            <li v-for="(size ,index) in sizes" @click.prevent="change({size : size.id});selected_size_index=index;selected_size_name=size.name">
                                {{ size.name }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="product-filter">
                    <div class="form-group">
                        <span class="title-filter">Price</span>
                        <div class="filter-content">
                            <div class="price-range-holder">
                                <input type="text" class="price-slider" value="">
                            </div>
                            <span class="min-max">
                                <!-- Price: $30 — $3450 -->
                            </span>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="product-filter-button-group clearfix">
                <div class="product-filter-button">
                    <a href="" class="btn-submit" @click.prevent="change({});">Fillter</a>
                </div>
                <div class="product-filter-button">
                    <a href="" class="btn-submit js-close">Clear</a>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    props: {
        url: {
            default: ''
        }
    },
    data(){
        return {
            sections : [],
            selected_section_index : undefined,
            selected_section_name : "Select a category",
            selected_sub_category_index : undefined,
            brands : [],
            selected_brand_index : undefined,
            colors : [],
            selected_color_index : undefined,
            selected_color_name : "Choose color",
            sizes : [],
            selected_size_index : undefined,
            selected_size_name : "Choose size",
            price_slider : undefined,
            search_params : {}
        };
    },
    mounted() {
        var slider_options = {
            min: 0,
            max: 1000,
            step: 5,
            value: [10, 1000],
        };
        // new slider(".price-slider", slider_options);
        var vm = this;
        this.price_slider = new slider(".price-slider", slider_options).on('slideStop' ,function(){
            vm.change({});
        });
    },
    created() {
        /**
        * Show loading screen
        */
        Event.$emit('show-loading-screen');
        var vm = this;
        axios({
            method: 'get',
            url: vm.url
        }).then(function (response) {
            vm.sections = response.data.sections;
            vm.brands = response.data.brands;
            vm.colors = response.data.colors;
            vm.sizes = response.data.sizes;
            /**
            * Hide loading screen
            */
            Event.$emit('hide-loading-screen');
        });
    },
    methods : {
        change(args){
            if("section" in args){
                this.search_params.section_id = args.section;
            }
            if("brand" in args){
                if(args.brand != undefined){
                    this.search_params.brand_id = args.brand;
                }else{
                    delete this.search_params.brand_id;
                }
            }
            if("color" in args){
                if(args.color != undefined){
                    this.search_params.color_id = args.color;
                }else{
                    delete this.search_params.color_id;
                }
            }
            if("size" in args){
                if(args.size != undefined){
                    this.search_params.size_id = args.size;
                }else{
                    delete this.search_params.size_id;
                }
            }
            if (this.price_slider) {
                var price_range = this.price_slider.getValue();
                this.search_params.price_from = price_range[0];
                this.search_params.price_to = price_range[1];
            }
            /**
            * Go and search
            */
            Event.$emit('search-parameters-change' ,this.search_params);
        },
        selectColor(color ,index) {
            if(color == undefined || this.selected_color_index == index){
                this.selected_color_index = undefined;
                this.change({color : undefined});
            }else{
                this.selected_color_index = index;
                this.change({color : color.id});
            }
        },
        expandSubCategories(event){
            window.toggleExpansion(event.target);
        }
    }
}
</script>
