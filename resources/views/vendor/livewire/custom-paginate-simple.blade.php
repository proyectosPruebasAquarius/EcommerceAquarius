<div>
    @if ($paginator->hasPages())
        <nav>
            <ul class="pagination">               
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item btn btn-sm">
                        <button type="button" class="page-link" wire:click="$emit('load-more')" wire:loading.attr="disabled" rel="next">Cargar más opiniones...</button>
                    </li>
                @else
                    <li class="page-item btn btn-sm disabled" aria-disabled="true">
                        <span class="page-link">Cargar más opiniones...</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
