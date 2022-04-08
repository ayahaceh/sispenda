@if ($paginator->hasPages())
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <a class="carousel-control-prev" href="{{ $paginator->url(1) }}" role="button" data-mdb-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
    @else
      <a class="carousel-control-prev" href="{{ $paginator->previousPageUrl() }}" role="button" data-mdb-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <a class="carousel-control-next" href="{{ $paginator->nextPageUrl() }}" role="button" data-mdb-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    @else
      <a class="carousel-control-next" href="{{ $paginator->url(1) }}" role="button" data-mdb-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    @endif
@endif