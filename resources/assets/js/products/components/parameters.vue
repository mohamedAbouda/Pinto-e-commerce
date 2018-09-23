<template>
    <div>
        <div class="weight">
            <div class="title">
                <h2>Sections</h2>
            </div>
            <div class="product-categories">
                <ul>
                    <li v-for="(section ,index) in sections">
                        <a href="#" :class="{ active: selected_section_index == index }" @click.prevent="change({section : section.id});selected_section_index=index;">
                            {{ section.name }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="weight">
            <div class="title">
                <h2>filter by price</h2>
            </div>
            <div class="filter-outer">
                <h3>Price</h3>
                <!-- Bootstrap Pricing Slider by ZsharE -->
                <div class="button-slider">
                    <div class="btn-group">
                        <div class="btn btn-default">
                            <p>
                                Range:
                                <strong>
                                    $<span id="sliderValue">100.0</span>
                                </strong> -
                                <strong>
                                    $<span id="sliderValue2">1.700.00</span>
                                </strong>
                            </p>
                            <input id="bootstrap-slider" type="text">
                            <input type="hidden" name="price_from" style="" :value="price_from">
                            <input type="hidden" name="price_to" style="" :value="price_to">
                            <button class="valueLabelblck" @click.prevent="change({});">Filter</button>
                        </div>
                    </div>
                </div>
                <!-- End of Bootstrap Pricing Slider by ZsharE -->
                <div class="brands">
                    <h3>Brands</h3>
                    <ul>
                        <li>
                            <a href="#" :class="{ active: selected_brand_index == undefined }" @click.prevent="change({brand : undefined});selected_brand_index=undefined;">
                                All
                            </a>
                        </li>
                        <li v-for="(brand ,index) in brands">
                            <a href="#" :class="{ active: selected_brand_index == index }" @click.prevent="change({brand : brand.id});selected_brand_index=index;">
                                {{ brand.name }}  <span>({{ brand.products_count }})</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="color">
                    <h3>Color</h3>
                    <ul>
                        <li v-for="(color ,index) in colors">
                            <a href="#"  :class="['color-1' ,{ active: selected_color_index == index }]" @click.prevent="selectColor(color ,index)">
                                <span :style="{ 'background-color':color.code }"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="size">
                    <h3>Size</h3>
                    <ul>
                        <li>
                            <a href="#" :class="{ active: selected_size_index == undefined }" @click.prevent="change({size : undefined});selected_size_index=undefined;">
                                ALL
                            </a>
                        </li>
                        <li v-for="(size ,index) in sizes">
                            <a href="#" :class="{ active: selected_size_index == index }" @click.prevent="change({size : size.id});selected_size_index=index;">
                                {{ size.name }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
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
            brands : [],
            selected_brand_index : undefined,
            colors : [],
            selected_color_index : undefined,
            sizes : [],
            selected_size_index : undefined,
            price_from : 0,
            price_to : 10000,
            search_params : {}
        };
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
            this.search_params.price_from = document.querySelector('input[name=price_from]').value;
            this.search_params.price_to = document.querySelector('input[name=price_to]').value;
            /**
             * Go and search
             */
            Event.$emit('search-parameters-change' ,this.search_params);
        },
        selectColor(color ,index) {
            if(this.selected_color_index != undefined){
                this.selected_color_index = undefined;
                this.change({color : undefined});
            }else{
                this.selected_color_index = index;
                this.change({color : color.id});
            }
        }
    }
}
</script>
