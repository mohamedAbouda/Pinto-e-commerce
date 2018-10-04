@if ($paginator->hasPages())
<div class="pagination-container pagination-blog">
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
            </li>
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
                            <li><a class="active">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" aria-label="Previous">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>
@endif
