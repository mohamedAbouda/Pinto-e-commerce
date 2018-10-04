@extends('layouts.site.app')

@section('content')
<div class="main-container right-slidebar">
    <div class="container">
        <div class="row">
            <div class="main-content col-xs-12 col-md-8">
                <div class="blog-post-container blog-page">
                    <?php $article = $articles->first();?>
                    <div class="blog-post-item">
                        <div class="blog-post-img">
                            <a class="hover-images" href="{{ route('web.blog.show' ,$article->id) }}">
                                <img src="{{ $article->cover_image_url }}" class="img-reponsive" alt="blog-img" style="width:100%;">
                            </a>
                        </div>
                        <div class="blog-post-info">
                            <div class="post-date">
                                {{ $article->created_at ? $article->created_at->toFormattedDateString() : '' }}
                            </div>
                            <h3 class="post-name">
                                <a href="{{ route('web.blog.show' ,$article->id) }}">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="post-desc">
                                {{ $article->short_description }}
                            </p>
                            <a href="{{ route('web.blog.show' ,$article->id) }}" class="readmore">Read more</a>
                        </div>
                        <div class="post-metas">
                            <div class="categories">
                                @foreach($article->categories as $category)
                                <a href="{{ route('web.blog.index' ,['tag' => $category->name]) }}" rel="category tag">{{ $category->name }}</a> {{ $loop->last ? '' : ',' }}
                                @endforeach
                            </div>
                            <?php if ($article->comments->count()): ?>
                                <span class="post-comments-number">{{ $article->comments->count() }}</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php $sub_articles = $articles->splice(1);?>
                    @foreach($sub_articles as $article)
                    <div class="blog-item-list">
                        <div class="blog-post-item post-item">
                            <div class="blog-post-img">
                                <a class="hover-images" href="{{ route('web.blog.show' ,$article->id) }}">
                                    <img src="{{ $article->cover_image_url }}" class="img-reponsive" alt="blog-img" style="width:100%;">
                                </a>
                            </div>
                            <div class="blog-post-info">
                                <div class="post-date">
                                    {{ $article->created_at ? $article->created_at->toFormattedDateString() : '' }}
                                </div>
                                <h3 class="post-name">
                                    <a href="{{ route('web.blog.show' ,$article->id) }}">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <p>
                                    {{ $article->short_description }}
                                </p>
                                <div class="post-metas">
                                    <div class="categories">
                                        @foreach($article->categories as $category)
                                        <a href="{{ route('web.blog.index' ,['tag' => $category->name]) }}" rel="category tag">{{ $category->name }}</a> {{ $loop->last ? '' : ',' }}
                                        @endforeach
                                    </div>
                                    <?php if ($article->comments->count()): ?>
                                        <span class="post-comments-number">{{ $article->comments->count() }}</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ $articles->links('vendor.pagination.site-blog-pagination') }}

            </div>
            <div class="sidebar col-xs-12 col-md-4">

                @include('site.blog.parts.search')
                @include('site.blog.parts.social')
                @include('site.blog.parts.tags')
                @include('site.blog.parts.popular')
                @include('site.blog.parts.newsletter')

                <!-- <aside class="widget widget_instagram">
                    <h3 class="widget-title">Instagrams</h3>
                    <div class="cosre-instagram">
                        <div class="item">
                            <a class="hover-images" href="blog-post.html"><img src="{{ asset('assets/site/img/blog/insta_1.jpg') }}" alt="" class="img-reponsive"></a>
                        </div>
                        <div class="item">
                            <a class="hover-images" href="blog-post.html"><img src="{{ asset('assets/site/img/blog/insta_2.jpg') }}" alt="" class="img-reponsive"></a>
                        </div>
                        <div class="item">
                            <a class="hover-images" href="blog-post.html"><img src="{{ asset('assets/site/img/blog/insta_3.jpg') }}" alt="" class="img-reponsive"></a>
                        </div>
                        <div class="item">
                            <a class="hover-images" href="blog-post.html"><img src="{{ asset('assets/site/img/blog/insta_4.jpg') }}" alt="" class="img-reponsive"></a>
                        </div>
                        <div class="item">
                            <a class="hover-images" href="blog-post.html"><img src="{{ asset('assets/site/img/blog/insta_5.jpg') }}" alt="" class="img-reponsive"></a>
                        </div>
                        <div class="item">
                            <a class="hover-images" href="blog-post.html"><img src="{{ asset('assets/site/img/blog/insta_6.jpg') }}" alt="" class="img-reponsive"></a>
                        </div>
                    </div>
                </aside> -->
                <!-- <aside class="widget widget_tags">
                    <h3 class="widget-title">Tags</h3>
                    <div class="content">
                        <a href="#" title="design" class="active">Design</a>
                        <a href="#" title="news">news</a>
                        <a href="#" title="lifestyle">life style</a>
                        <a href="#" title="fashion">Fashion</a>
                        <a href="#" title="blog">blog</a>
                    </div>
                </aside> -->
            </div>
        </div>
    </div>
</div>
@stop
