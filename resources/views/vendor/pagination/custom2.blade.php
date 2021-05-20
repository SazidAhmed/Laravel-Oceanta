
@if ($paginator->hasPages())
<div class="pagination-style mt-30 text-center">
  <ul>
      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
          <li><a href="#"><i class="ti-angle-left"></i></a></li>
      @else
          <li class="active"><a href="{{ $paginator->previousPageUrl() }}"><i class="ti-angle-left"></i></a></li>
      @endif

      {{-- Pagination Elements --}}
      @foreach ($elements as $element)

          {{-- "Three Dots" Separator --}}
          @if (is_string($element))
              <li>{{ $element }}</li>
          @endif

          {{-- Array Of Links --}}
          @if (is_array($element))
              @foreach ($element as $page => $url)
                  @if ($page == $paginator->currentPage())
                      <li class="active">
                          <a>{{ $page }}</a>
                      </li>
                  @else
                      <li ><a href="{{ $url }}">{{ $page }}</a></li>
                  @endif
              @endforeach
          @endif

        @endforeach

      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
          <li class="active"><a href="{{ $paginator->nextPageUrl() }}"><i class="ti-angle-right"></i></a></li>
      @else
          <li><a href="{{ $paginator->nextPageUrl() }}"><i class="ti-angle-right"></i></a></li>
      @endif
  </ul>
  <br>
  <ul>
    <p class="text-sm text-gray-700 leading-5">
        {!! __('Showing') !!}
        <span class="font-medium">{{ $paginator->firstItem() }}</span>
        {!! __('to') !!}
        <span class="font-medium">{{ $paginator->lastItem() }}</span>
        {!! __('of') !!}
        <span class="font-medium">{{ $paginator->total() }}</span>
        {!! __('results') !!}
    </p>
  </ul>
</div>
@endif