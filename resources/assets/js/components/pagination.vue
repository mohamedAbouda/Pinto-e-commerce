<template>
	<div class="pagination-container pagination-blog button-v v2">
		<nav>
			<ul class="pagination" v-if="data.total > data.per_page">
				<li v-if="data.prev_page_url">
					<a href="#" aria-label="Next" @click.prevent="selectPage(--data.current_page)">
						<i class="fa fa-angle-left" aria-hidden="true"></i>
					</a>
				</li>
				<li v-for="page in getPages()" :class="{ active: page == data.current_page }">
					<a @click.prevent="selectPage(page)">{{ page }}</a>
				</li>
				<li v-if="data.next_page_url">
					<a href="#" aria-label="Next" @click.prevent="selectPage(++data.current_page)">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</a>
				</li>
			</ul>
		</nav>
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
