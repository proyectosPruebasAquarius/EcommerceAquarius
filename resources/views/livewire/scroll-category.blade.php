
    <div class="d-none" id="dropdown-scroll">
        <div class="dropdown d-inline d-none d-md-block" >
            <button class="navbar-toggler mobile-menu-btn" type="button" id="menuScroll" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
            </button>
            <h3 class="d-inline d-none" id="titleScroll">Mi Tiendita</h3>
            <ul class="dropdown-menu" aria-labelledby="menuScroll" style="font-size: 14px;">
                <li>
                    <a href="{{ url('/productos')}}" class="dropdown-item" style="background-color: #f9f9f9 !important;">Todos los Productos</a>
                </li>

                @forelse ($categorias as $categoria)


                <li><a href="{{ url('/productos/'.$categoria->nombre) }}" class="dropdown-item" @if (request('categoria')==$categoria->nombre) style="color: #0167F3" @endif>{{ $categoria->nombre }}</a>
                    @php
                    $subs = \DB::table('sub_categorias')->where('id_categoria', $categoria->id)->get(['id', 'nombre']);
                    @endphp
                    @if(count($subs) > 0)
                    <ul class="submenu dropdown-menu" style="font-size: 14px;">
                        @forelse ($subs as $sub)
                        <li><a type="button" class="dropdown-item" wire:click="redirectNewRender('{{ $sub->nombre }}', '{{ $categoria->nombre }}')" @if(request()->session()->has('newSubCat'))
                                @if(session('newSubCat') == $sub->nombre)
                                style="color: #0167F3"
                                @endif
                                @endif>{{ $sub->nombre }}</a></li>
                        @empty

                        @endforelse
                    </ul>
                    @endif
                </li>

                @empty

                @endforelse
            </ul>
        </div>

        <nav class="navbar  d-sm-block d-md-none  d-lg-none d-xl-none">

            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScrollCollapse" aria-controls="navbarScrollCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
            </button>

            <h3 class="d-inline fs-3 me-3" id="titleScroll">Mi Tiendita</h3>

            <div class="collapse navbar-collapse sub-menu-bar w-auto" id="navbarScrollCollapse">

                <ul id="nav" class="navbar-nav ms-auto">
                    <li><a href="{{ url('/productos')}}" class="dropdown-item" style="background-color: #f9f9f9 !important;">Todos los Productos</a></li>

                    @forelse ($categorias as $categoria)
                    <li class="nav-item">
                        <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#submenu-1-{{ $loop->index }}" aria-controls="navbarScrollCollapse" aria-expanded="false" aria-label="Toggle navigation">{{ $categoria->nombre }}</a>
                        <ul class="sub-menu collapse" id="submenu-1-{{ $loop->index }}">
                            <li class="nav-item"><a href="{{ url('/productos/'.$categoria->nombre) }}">{{ $categoria->nombre }}</a></li>
                            @php
                            $subs = \DB::table('sub_categorias')->where('id_categoria', $categoria->id)->get(['id', 'nombre']);
                            @endphp
                            @if(count($subs) > 0)
                            @forelse ($subs as $sub)
                            <li class="nav-item"><a type="button" class="dropdown-item" wire:click="redirectNewRender('{{ $sub->nombre }}', '{{ $categoria->nombre }}')" {{-- @if(request()->session()->has('newSubCat')) 
                                            @if(session('newSubCat') == $sub->nombre)
                                                style="color: #0167F3" 
                                            @endif
                                            @endif --}}>{{ $sub->nombre }}</a></li>
                            @empty
                            @endforelse
                            @endif
                        </ul>
                    </li>
                    @empty
                    @endforelse

                </ul>
            </div>
        </nav>
    </div>

@push('scripts')
    <script>
        /* document.addEventListener('click', (e) => {
            let menu = document.getElementById('menuScroll');

            if (menu.classList.contains('active')) {
                if (e.target !== menu) {
                    menu.classList.remove('active', 'show');
                }
            }
        }) */
    </script>
@endpush
