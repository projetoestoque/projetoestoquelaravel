<style>
.pagination li.active{
  height:50px;
  background: linear-gradient(to right, #56ccf2, #2f80ed);
}
</style>
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            @if ($paginator->onFirstPage())
            <li class="disabled"><a href="#"><i class="material-icons">chevron_left</i></a></li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="material-icons">chevron_left</i></a>
                </li>
            @endif

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="{{ $url }}">{{$page}}</a></li>
                        @else
                            <li><a href="{{$url}}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }} "class="waves-effect" rel="next"><i class="material-icons">chevron_right</i></a>
                </li>
            @else
                <li class="disabled">
                <i class="material-icons">chevron_right</i>
                </li>
            @endif
        </ul>
    </nav>
@endif
