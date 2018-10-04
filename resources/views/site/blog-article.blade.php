@extends('layouts.site.app')

@section('meta')
<!--  Essential META Tags -->
<meta property="og:title" content="{{ $article->title }}">
<meta property="og:description" content="{{ $article->short_description }}">
<meta property="og:image" content="{{ $article->cover_image_url }}">
<meta property="og:url" content="{{ route('web.blog.show' ,$article->id) }}">
<meta name="twitter:card" content="summary_large_image">

<!--  Non-Essential, But Recommended -->
<meta property="og:site_name" content="Pinto | The World's Most Comfortable Underwears">
<meta name="twitter:image:alt" content="{{ $article->title }}">
@stop

@section('content')
<div class="main-container right-slidebar single-post v2">
	<div class="container">
		<div class="row">
			<div class="post-image col-xs-12 col-sm-12 col-md-12">
				<img src="{{ $article->cover_image_url }}" alt="" class="img-reponsive">
			</div>
			<div class="main-content col-xs-12 col-md-8">
				<div class="blog-post-container blog-page">
					<div class="blog-post-single blog-post-item">
						<div class="blog-post-info">
							<div class="post-date">
								{{ $article->created_at ? $article->created_at->toFormattedDateString() : '' }}
							</div>
							<h3 class="post-name ver2">
								<a>
									{{ $article->title }}
								</a>
							</h3>
						</div>
						<div class="post-metas ver2">
							<div class="categories">
								@foreach($article->categories as $category)
								<a href="{{ route('web.blog.index' ,['tag' => $category->name]) }}" rel="category tag">{{ $category->name }}</a> {{ $loop->last ? '' : ',' }}
								@endforeach
							</div>
						</div>
						<div class="post-content">
							{!! $article->body !!}
							<div class="post-share">
								<ul class="social-share">
									<li>
										<a rel="noopener noreferrer" target="_blank" href="https://pinterest.com/pin/create/button/?url={{ route('web.blog.show' ,$article->id) }}&media={{ $article->cover_image_url }}&description=<?=urlencode('Read our latest article ' . $article->title);?>">
											<i class="fa fa-pinterest-p"></i>
											PIN THE POST
										</a>
									</li>
									<li>
										<a rel="noopener noreferrer" target="_blank" href="https://twitter.com/intent/tweet?text=<?=urlencode('Read our latest article ' . $article->title);?>&url={{ route('web.blog.show' ,$article->id) }}&via=Pinto">
											<i class="fa fa-twitter"></i>
											Tweet the Post
										</a>
									</li>
									<li>
										<a rel="noopener noreferrer" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('web.blog.show' ,$article->id) }}">
											<i class="fa fa-facebook"></i>
											Share the post
										</a>
									</li>
								</ul>
							</div>
							<div class="post-link">
								<div class="nav-links">
									<?php if ($prev_id): ?>
										<div class="nav-previous">
											<a href="{{ route('web.blog.show' ,$prev_id) }}">
												Previous post
											</a>
										</div>
									<?php endif; ?>
									<?php if ($next_id): ?>
										<div class="nav-next">
											<a href="{{ route('web.blog.show' ,$next_id) }}">
												Next post
											</a>
										</div>
									<?php endif; ?>
								</div>
							</div>
							<div class="post-related">
								<h3 class="post-title widget-title">You Might Also Like</h3>
								<div class="post-related-slide">
									<div class="row">
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="blog-post-item post-item">
												<div class="blog-post-img">
													<a class="hover-images" href="#"><img src="{{ asset('assets/site/img/blog/5_sm.jpg') }}" alt="blog-img" class="img-reponsive"></a>
												</div>
												<div class="blog-post-info v2">
													<div class="post-date">September 22, 2018</div>
													<h3 class="post-name"><a href="#">A planner tool to help coordinate</a></h3>
												</div>
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 col-md-6">
											<div class="blog-post-item post-item">
												<div class="blog-post-img">
													<a class="hover-images" href="#"><img src="{{ asset('assets/site/img/blog/grid_7.jpg') }}" alt="blog-img" class="img-reponsive"></a>
												</div>
												<div class="blog-post-info v2">
													<div class="post-date">September 22, 2018</div>
													<h3 class="post-name"><a href="#">What a beautiful design!</a></h3>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php if (!$article->comments->isEmpty()): ?>
								<div class="post-comments">
									<h3 class="post-comments-title widget-title">Comments ({{ $article->comments->count() }})</h3>
									<ul class="commentlist">
										@foreach($article->comments as $comment)
										<li>
											<div class="comment">
												<div class="avatar">
													<a><img src="{{ $comment->client->profile_pic ? $comment->client->profile_pic_url : asset('assets/site/img/blog/about5.jpg') }}" alt="images" class="img-responsive"></a>
												</div>
												<div class="comment-box">
													<div class="first-box">
														<div class="comment-author-meta">
															<strong>{{ $comment->client->name }}</strong>
															<div class="date">{{ $comment->created_at->toFormattedDateString() }}</div>
														</div>
														<!-- <div class="comment-post-reply">
														<a href="#post-reply" class="comment-reply smoothScroll">Reply</a>
														</div> -->
													</div>
													<div class="comment-content">
														{{ $comment->comment }}
													</div>
												</div>
											</div>
										</li>
										@endforeach
										<!-- <li>
											<div class="comment">
												<div class="avatar">
													<a href="#"><img src="{{ asset('assets/site/img/blog/about5.jpg') }}" alt="images" class="img-responsive"></a>
												</div>
												<div class="comment-box">
													<div class="first-box">
														<div class="comment-author-meta">
															<strong>Darnell Patterson</strong>
															<div class="date">December 29, 2018</div>
														</div>
														<div class="comment-post-reply">
															<a href="#post-reply" class="comment-reply smoothScroll">Reply</a>
														</div>
													</div>
													<div class="comment-content">
														Competently leverage other's resource maximizing e-commerce and customer directed benefits. Progressively communicate progressive communities without value-added expertise. Distinctively pursue enterprise action.
													</div>
												</div>
											</div>
											<ul class="comment-child">
												<li>
													<div class="comment">
														<div class="avatar">
															<a href="#"><img src="{{ asset('assets/site/img/blog/about5.jpg') }}" alt="images" class="img-responsive"></a>
														</div>
														<div class="comment-box">
															<div class="first-box">
																<div class="comment-author-meta">
																	<strong>Darnell Patterson</strong>
																	<div class="date">December 29, 2018</div>
																</div>
																<div class="comment-post-reply">
																	<a href="#post-reply" class="comment-reply smoothScroll">Reply</a>
																</div>
															</div>
															<div class="comment-content">
																Competently leverage other's resource maximizing e-commerce and customer directed benefits. Progressively communicate progressive communities without value-added expertise. Distinctively pursue enterprise action.
															</div>
														</div>
													</div>
												</li>
											</ul>
										</li> -->
									</ul>
								</div>
							<?php endif; ?>

							<?php if (Auth::guard('client')->check()): ?>
								<div class="post-reply" id="post-reply">
									<h3 class="post-title widget-title">Leave a reply</h3>
									<form action="{{ route('web.blog.comment' ,$article->id) }}" method="POST" class="comment-form">
										{{ csrf_field() }}
										<div class="form-group">
											<div class="row">
												<div class="col-md-12">
													<label>Your comments</label>
													<textarea name="comment" tabindex="2" class="form-control" max="191" redirect></textarea>
												</div>
											</div>
										</div>
										<input type="hidden" name="blog_article_id" value="{{ $article->id }}">
										<button type="submit" class="btn btn-submit">Submit</button>
									</form>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="sidebar col-xs-12 col-md-4">

				@include('site.blog.parts.search')
				@include('site.blog.parts.social')
				@include('site.blog.parts.tags')
				@include('site.blog.parts.popular')
				@include('site.blog.parts.newsletter')

			</div>
		</div>
	</div>
</div>
@stop
