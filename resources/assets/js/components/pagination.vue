<template>
	<div>
		<!-- .pagetions -->
		<div class="col-xs-12 col-sm-6 col-md-6 text-left">
			<ul class="pagination" v-if="data.total > data.per_page">
				<li v-if="data.prev_page_url">
					<a href="#" aria-label="Previous" @click.prevent="selectPage(--data.current_page)">
						&laquo;
					</a>
				</li>
				<li v-for="page in getPages()" :class="{ active: page == data.current_page }">
					<a href="#" @click.prevent="selectPage(page)">{{ page }}</a>
				</li>
				<li v-if="data.next_page_url">
					<a href="#" aria-label="Next" @click.prevent="selectPage(++data.current_page)">
						&raquo;
					</a>
				</li>
			</ul>
		</div>
		<!-- /.pagetions -->
		<!-- .Showing -->
		<div class="col-xs-12 col-sm-6 col-md-6 text-right">
			<strong>Showing {{ data.from }}-{{ data.to }} <span>of {{ data.total }} relults</span></strong>
		</div>
		<!-- /.Showing -->
	</div>
</template>

<script type="text/javascript">
export default {
	props: {
		limit: {
			type: Number,
			default: 0
		}
	},
	data(){
		return {
			data : {}
		};
	},
	created() {
		var vi = this;
		/**
		* Listen for when the resources are ready.
		*/
		Event.$on('resources-ajax-fetch' , function(resources) {
			vi.data = resources;
			vi.getPages();
		});
	},
	methods: {
		selectPage: function(page) {
			if (page === '...') {
				return;
			}
			/**
			* Let the other component know that a page is selected
			*/
			Event.$emit('pagination-change-page', page);
		},
		getPages: function() {
			if (this.limit === -1) {
				return 0;
			}

			if (this.limit === 0) {
				return this.data.last_page;
			}

			var current = this.data.current_page,
			last = this.data.last_page,
			delta = this.limit,
			left = current - delta,
			right = current + delta + 1,
			range = [],
			pages = [],
			l;

			for (var i = 1; i <= last; i++) {
				if (i == 1 || i == last || (i >= left && i < right)) {
					range.push(i);
				}
			}

			range.forEach(function (i) {
				if (l) {
					if (i - l === 2) {
						pages.push(l + 1);
					} else if (i - l !== 1) {
						pages.push('...');
					}
				}
				pages.push(i);
				l = i;
			});

			return pages;
		}
	}
};
</script>
