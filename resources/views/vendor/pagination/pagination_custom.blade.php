<nav aria-label="Page navigation">
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
            </li>
        @endif

        @php
            $totalPages = $paginator->lastPage();
        @endphp

        {{-- Jika total halaman kurang dari 10, tampilkan normal --}}
        @if ($totalPages <= 10)
            @for ($i = 1; $i <= $totalPages; $i++)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $i }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor
        @else
            {{-- Jika lebih dari 10 halaman, tampilkan dengan elipsis --}}
            @php
                $start = max(1, $paginator->currentPage() - 2); // Halaman awal dari kelompok
                $end = min($totalPages, $paginator->currentPage() + 2); // Halaman akhir dari kelompok
            @endphp

            {{-- Tombol halaman pertama jika terlalu jauh dari kelompok --}}
            @if ($start > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                </li>
                @if ($start > 2)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
            @endif

            {{-- Loop halaman di sekitar halaman saat ini --}}
            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $i }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            {{-- Tombol halaman terakhir jika terlalu jauh dari kelompok --}}
            @if ($end < $totalPages)
                @if ($end < $totalPages - 1)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($totalPages) }}">{{ $totalPages }}</a>
                </li>
            @endif
        @endif

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        @endif
    </ul>
</nav>
