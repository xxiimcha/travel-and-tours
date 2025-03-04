@if ($paginator->hasPages())
    <div class="inline-flex items-center space-x-3"> <!-- Added space-x-3 for margin between buttons -->
        
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 text-sm text-white bg-blue-500 cursor-not-allowed rounded">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 text-sm text-white bg-blue-500 hover:bg-blue-600 rounded">Previous</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 text-sm text-white bg-blue-500 hover:bg-blue-600 rounded">Next</a>
        @else
            <span class="px-3 py-1 text-sm text-white bg-blue-500 cursor-not-allowed rounded">Next</span>
        @endif
    </div>
@endif
