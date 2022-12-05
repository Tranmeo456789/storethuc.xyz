@if ($paginator->hasPages())
    <div class="row justify-content-end">
        <div class="float-right">
            <ul class="pagination pagination-sm my-pagination float-right mb-0">
                {{-- Previous Page Link --}}
                @if ( $paginator->currentPage() == 1)
                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                @else
                    <li><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
                @endif
                @php
                    $start = $paginator->currentPage() - 2; // show 3 pagination links before current
                    $end = $paginator->currentPage() + 2; // show 3 pagination links after current
                    if($start < 1) {
                        $start = 1; // reset start to 1
                        $end += 1;
                    }
                    if($end >= $paginator->lastPage() ) $end = $paginator->lastPage(); // reset end to last page
                @endphp
                @if($start > 1)
                    <li><a class="page-link" href="{{$paginator->url('1')}}">1</a></li>
                    @if($paginator->currentPage() != 4)
                        {{-- "Three Dots" Separator --}}
                        <li class="page-item disabled"><span>...</span></li>
                    @endif
                @endif
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                    @endif
                @endfor
                @if($end < $paginator->lastPage())
                    @if($paginator->currentPage() + 3 != $paginator->lastPage())
                        {{-- "Three Dots" Separator --}}
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    <li >
                        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{$paginator->lastPage()}}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
                @else
                    <li class="page-item disabled"><span>&raquo;</span></li>
                @endif
            </ul>
        </div>
    </div>
@endif
