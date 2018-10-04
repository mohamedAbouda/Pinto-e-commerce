<aside class="widget widget_popular_posts">
    <h3 class="widget-title">Popular Posts</h3>
    <div class="post-item-list">
        @foreach($popular_articles as $article)
        <div class="post-item">
            <div class="post-item-img">
                <a href="{{ route('web.blog.show' ,$article->id) }}">
                    <img src="{{ $article->cover_image_url }}" alt="blog-img" class="img-reponsive" style="width:98px;height:98px;">
                </a>
            </div>
            <div class="post-item-text">
                <div class="post-date">{{ $article->created_at ? $article->created_at->toFormattedDateString() : '' }}</div>
                <h3>
                    <a href="{{ route('web.blog.show' ,$article->id) }}">
                        The Must Have Neutral Layers for Spring
                    </a>
                </h3>
            </div>
        </div>
        @endforeach
    </div>
</aside>
