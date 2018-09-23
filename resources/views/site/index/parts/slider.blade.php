<!-- header-slider -->
<div class="header-slider3">
    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
        <!-- .home-slider -->
        <div class="carousel-inner">
            @foreach($slider_sheets as $sheet)
            <div class="item {{ $loop->first ? 'active' : '' }}" style="background-image: url('{{ $sheet->image_url }}');  background-repeat: no-repeat; background-position: top;">
                <div class="container">
                    <div class="home3-caption">
                        <div class="home3-caption-outer">
                            <div class="header-text">
                                @if($sheet->tag)
                                <sup class="bg-red">{{ $sheet->tag }}</sup>
                                @endif

                                @if($sheet->head1)
                                <h6>{{ $sheet->head1 }}</h6>
                                @endif

                                @if($sheet->head2)
                                <h2>{{ $sheet->head2 }}</h2>
                                @endif

                                <p>
                                    {{ $sheet->desc }}
                                </p>

                                <a href="{{ $sheet->url }}">
                                    {{ $sheet->action_text }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- indicators -->
        <ol class="carousel-indicators">
            @foreach($slider_sheets as $sheet)
            <li data-target="#home-slider" data-slide-to="{{ $loop->iteration-1 }}" class="{{ $loop->first ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        <!-- /indicators -->
        <!-- /.home-slider -->
    </div>
</div>
<!-- /header-slider end -->
