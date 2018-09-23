<div class="container">
    <div class="row">
        @foreach($banners_under_slider as $banner)
        <div class="col-xs-12 col-sm-4 col-md-4">
            <!-- banner-img -->
            <a href="{{ $banner->url }}" class="banner-img" style="background: rgba(0, 0, 0, 0) url('{{ $banner->image_url }}') no-repeat scroll 0 0 / cover;">
                <!-- banner-text -->
                <div class="banner-text">
                    @if($banner->tag)
                    <span class="hot-text">
                        {{ $banner->tag }}
                    </span>
                    @endif
                    <h5>
                        {{ $banner->title }}
                    </h5>
                    <p>
                        {{ $banner->body }}
                    </p>
                    <span class="price"><span>Price:</span> ${{ $banner->price }}</span>
                </div>
                <!-- /banner-text -->
            </a>
            <!-- /banner-img -->
        </div>
        @endforeach
    </div>
</div>
