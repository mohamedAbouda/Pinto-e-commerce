@if ($paginator->hasPages())
<div class="contact-list-view-col-categ col-md-1 col-xs-12 hidden-xs pull-right">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <a href="#" class="btn navigation-btn margin-top5 disabled">
            <i class="fa fa-caret-left"></i>
        </a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn navigation-btn margin-top5">
            <i class="fa fa-caret-left"></i>
        </a>
    @endif
    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="btn navigation-btn margin-top5">
            <i class="fa fa-caret-right"></i>
        </a>
    @else
        <a href="#" class="btn navigation-btn margin-top5 disabled">
            <i class="fa fa-caret-right"></i>
        </a>
    @endif
</div>
@endif

@if (false && $paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&laquo;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span>&raquo;</span></li>
        @endif
    </ul>
@endif
