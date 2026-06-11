<div>
    @if ($paginator->hasPages())
        <nav class="d-flex flex-column flex-md-row justify-content-between align-items-center py-3">
            <div class="mb-3 mb-md-0">
                <p class="small text-muted mb-0">
                    Menampilkan 
                    <span class="font-weight-bold opacity-75">{{ ($paginator->currentPage() - 1) * $paginator->perPage() + 1 }}</span>
                    sampai 
                    <span class="font-weight-bold opacity-75">{{ min($paginator->currentPage() * $paginator->perPage(), $paginator->total()) }}</span>
                    dari 
                    <span class="font-weight-bold opacity-75">{{ $paginator->total() }}</span>
                    data
                </p>
            </div>

            <div>
                <ul class="pagination pagination-sm m-0 shadow-sm" style="border-radius: 8px; overflow: hidden;">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link border-0 bg-light text-gray-400 px-3 py-2">
                                <i class="bi bi-chevron-left small"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <button type="button" 
                               wire:click="previousPage('{{ $paginator->getPageName() }}')" 
                               wire:loading.attr="disabled"
                               class="page-link border-0 text-primary px-3 py-2 transition-all hover-bg-gray-100" 
                               rel="prev">
                                <i class="bi bi-chevron-left small"></i>
                            </button>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $key => $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true" wire:key="dots-{{ $key }}">
                                <span class="page-link border-0 bg-white text-gray-400 px-3 py-2">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page" wire:key="page-{{ $page }}">
                                        <span class="page-link border-0 shadow-sm px-3 py-2 font-weight-bold" 
                                              style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); z-index: 2;">
                                            {{ $page }}
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item" wire:key="page-{{ $page }}">
                                        <button type="button" 
                                           wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" 
                                           wire:loading.attr="disabled"
                                           class="page-link border-0 text-gray-700 px-3 py-2 hover-bg-gray-100 transition-all font-weight-500">
                                            {{ $page }}
                                        </button>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <button type="button" 
                               wire:click="nextPage('{{ $paginator->getPageName() }}')" 
                               wire:loading.attr="disabled"
                               class="page-link border-0 text-primary px-3 py-2 hover-bg-gray-100 transition-all" 
                               rel="next">
                                <i class="bi bi-chevron-right small"></i>
                            </button>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link border-0 bg-light text-gray-400 px-3 py-2">
                                <i class="bi bi-chevron-right small"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        <style>
            .transition-all {
                transition: all 0.2s ease-in-out;
            }
            .hover-bg-gray-100:hover {
                background-color: #f8f9fc !important;
                color: #224abe !important;
            }
            .page-link:focus {
                box-shadow: none !important;
            }
            .font-weight-500 {
                font-weight: 500;
            }
        </style>
    @endif
</div>
