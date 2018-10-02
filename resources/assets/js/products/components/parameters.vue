<template>
    <div>
        <div class="filter filter-price">
            <h3 class="filtertitle">
                By price.
            </h3>
            <div class="filter-content">
                <div class="price-range-holder">
                    <input type="text" id="parameters-price-slider" value="">
                </div>
                <span class="min-max">
                    Price: <!--$30 — $3450-->
                </span>
                <span class="filter-title">
                </span>
            </div>
        </div>
        <div class="filter filter-category">
            <h3 class="filtertitle">
                Categories.
            </h3>
            <ul class="filter-content js-filter-menu">
                <li v-for="(section ,index) in sections">
                    <a :style="[selected_section_index == index ? {'color': '#00abe7'} : {}]" @click.prevent="change({section : section.id});selected_section_index=index;">
                        {{ section.name }}
                    </a>
                    <span class="plus js-plus-icon" v-if="section.sub_categories" @click="expandSubCategories($event)"></span>
                    <ul class="filter-menu" v-if="section.sub_categories">
                        <li class="" v-for="(sub_category ,iteration) in section.sub_categories">
                            <a :style="[selected_section_index == index && selected_sub_category_index == iteration ? {'color': '#00abe7'} : {}]" @click.prevent="change({sub_category_id : sub_category.id});selected_section_index=index;selected_sub_category_index=iteration;">
                                {{ sub_category.name }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="filter filter-color">
            <h3 class="filtertitle">
                By color.
            </h3>
            <ul class="filter-content">
                <li>
                    <a :style="[selected_color_index == undefined ? {'color': '#00abe7'} : {}]" @click.prevent="selectColor()">
                        ALL
                    </a>
                </li>
                <li v-for="(color ,index) in colors">
                    <a :style="[selected_color_index == index ? {'color': '#00abe7'} : {}]" @click.prevent="selectColor(color ,index)">
                        {{ color.name }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="filter filter-size">
            <h3 class="filtertitle">
                By size
            </h3>
            <div class="filter-content">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                        {{ selected_size_name }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a @click.prevent="change({size : undefined});selected_size_name='ALL'">
                                ALL
                            </a>
                        </li>
                        <li v-for="(size ,index) in sizes">
                            <a @click.prevent="change({size : size.id});selected_size_index=index;selected_size_name=size.name">
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
            selected_sub_category_index : undefined,
            brands : [],
            selected_brand_index : undefined,
            colors : [],
            selected_color_index : undefined,
            sizes : [],
            selected_size_index : undefined,
            selected_size_name : "Choose any size...",
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
        new slider(".price-slider", slider_options);
        var vm = this;
        this.price_slider = new slider("#parameters-price-slider", slider_options).on('slideStop' ,function(){
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
