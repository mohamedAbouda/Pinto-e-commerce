<div class="row">
    <div class="col-md-3">
        <div class="deal-week deal-week2">
            <div class="title">
                <h2>Deals Of The Week</h2>
            </div>
            <div class="owl-demo-outer">
                <!-- #owl-demo -->
                <div id="owl-demo" class="deals-wk">
                    @foreach($section->objects['discounts'] as $product)
                    @if ($loop->first)
                    <div class="item">
                        <div class="col-md-12">
                            @endif
                            @include('site/parts/product-deal-timer')
                            @if ($loop->last)
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="title">
            <h2 class="red-category" style="border-color:#b11e22">
                {{ $section->name }}
            </h2>
            <ul class="nav nav-tabs etabs-red">
                <li class="active">
                    <a data-toggle="tab" href="#best-selling-{{ $section_index }}">Best Selling</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#trending-{{ $section_index }}">Trending</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#top-rated-{{ $section_index }}">Top Rated</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#new-arrivals-{{ $section_index }}">New Arrivals</a>
                </li>
            </ul>
        </div>
        <div class="electonics">
            <div class="col-md-12">
                <div class="row">
                    <!-- tab-content -->
                    <div class="tab-content grid-shop">
                        <!-- tab-pane -->
                        <div id="best-selling-{{ $section_index }}" class="tab-pane fade in active">
                            <div class="owl-demo-outer">
                                <!-- #owl-demo -->
                                <div id="owl-demo36" class="deals-wk2">
                                    @foreach($section->objects['best_selling'] as $product)
                                    @if ($loop->first || ($loop->iteration - 1) % 4 == 0)
                                    <div class="item">
                                        @endif
                                        <div class="col-xs-12 col-sm-3 col-md-3">
                                            @include('site/parts/product')
                                        </div>
                                        @if ($loop->last || $loop->iteration % 4 == 0)
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- /tab-pane -->
                        <!-- tab-pane -->
                        <div id="trending-{{ $section_index }}" class="tab-pane fade in">
                            <!-- #owl-demo -->
                            <div id="owl-demo36" class="deals-wk2">
                                @foreach($section->objects['most_seen'] as $product)
                                @if ($loop->first || ($loop->iteration - 1) % 4 == 0)
                                <div class="item">
                                    @endif
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        @include('site/parts/product')
                                    </div>
                                    @if ($loop->last || $loop->iteration % 4 == 0)
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <!-- /#owl-demo -->
                        </div>
                        <!-- /tab-pane -->
                        <!-- tab-pane -->
                        <div id="top-rated-{{ $section_index }}" class="tab-pane fade in">
                            <!-- #owl-demo -->
                            <div id="owl-demo37" class="deals-wk2">
                                @foreach($section->objects['top_rated'] as $product)
                                @if ($loop->first || ($loop->iteration - 1) % 4 == 0)
                                <div class="item">
                                    @endif
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        @include('site/parts/product')
                                    </div>
                                    @if ($loop->last || $loop->iteration % 4 == 0)
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <!-- /#owl-demo -->
                        </div>
                        <!-- /tab-pane -->
                        <!-- tab-pane -->
                        <div id="new-arrivals-{{ $section_index }}" class="tab-pane fade in">
                            <!-- #owl-demo -->
                            <div id="owl-demo38" class="deals-wk2">
                                @foreach($section->objects['new_products'] as $product)
                                @if ($loop->first || ($loop->iteration - 1) % 4 == 0)
                                <div class="item">
                                    @endif
                                    <div class="col-xs-12 col-sm-3 col-md-3">
                                        @include('site/parts/product')
                                    </div>
                                    @if ($loop->last || $loop->iteration % 4 == 0)
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <!-- /#owl-demo -->
                        </div>
                        <!-- /tab-pane -->
                    </div>
                    <!-- /tab-content -->
                </div>
            </div>
        </div>
    </div>
</div>
