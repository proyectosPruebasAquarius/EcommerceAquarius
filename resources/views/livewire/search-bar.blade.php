<div>
    <div class="main-menu-search">
    
        <form action="{{ route('bySearch', $fill) }}" id="search-form-global">
            <div class="navbar-search search-style-5">
                {{-- <div class="search-select">
                    <div class="select-position">
                        <select id="select1">
                            <option selected>All</option>
                            <option value="1">option 01</option>
                            <option value="2">option 02</option>
                            <option value="3">option 03</option>
                            <option value="4">option 04</option>
                            <option value="5">option 05</option>
                        </select>
                    </div>
                </div> --}}
                <div class="search-input">
                    <input type="text" placeholder="Buscar..." wire:model="fill" id="global-search">
                </div>
                <div class="search-btn">
                    <button type="submit" class="btn btn-primary" style="height: 45px;" id="global-btn-search"><i class="lni lni-search-alt" style="margin-top: 8px"></i></button>
                </div>
            </div>
        </form>

    </div>
</div>

@push('scripts')
    <script>
        /* document.getElementById('global-search').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                if (e.target.value != '' && e.target.value != null)
                document.getElementById('global-btn-search').click();
            }
        }) */
        document.getElementById('search-form-global').addEventListener('submit', (e) => {
            if (document.getElementById('global-search').value == '' || document.getElementById('global-search').value == null) 
            e.preventDefault();
        })
    </script>
@endpush
