<style>
    .pagination > .button.active, .pagination > .button.disabled{
        background-color: transparent;
        color: black;
    }
</style>
@if ($paginator->hasPages())
    <div class="pagination" style="width: 100%;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="page-item disabled button"><span class="page-link">&laquo;</span></a>
        @else
            <a class="page-item button" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="page-item disabled button"><span class="page-link">{{ $element }}</span></a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="page-item active button"><span class="page-link">{{ $page }}</span></a>
                    @else
                        <a class="page-item button" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="page-item button" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
        @else
            <a class="page-item disabled button"><span class="page-link">&raquo;</span></a>
        @endif
    </div>
@endif
