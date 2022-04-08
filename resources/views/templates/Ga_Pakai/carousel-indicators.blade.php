@if ($paginator->hasPages())
<ol class="carousel-indicators">
    @foreach ($elements as $element)
        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li data-mdb-target="#introCarousel" data-mdb-slide-to="{{ $page }}" class="active"></li>
                @else
                    <li data-mdb-target="#introCarousel" data-mdb-slide-to="{{ $page }}"></li>
                @endif
            @endforeach
        @endif
    @endforeach
</ol>
@endif