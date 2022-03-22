<div class="container">
    <div class="row">
        <div class="col-lg-3 col-12">

            <div class="product-sidebar">

                <div class="single-widget search" style="padding: 22px !important">
                    {{-- <h3>Buscar Producto</h3> --}}
                    
                    <form action="/productos" method="GET">
                        <input type="text" placeholder="Buscar Producto..." wire:model="search"  >
                        {{-- <buttontype="submit"id="btnSearch"><iclass="lnilni-search-alt"></i></button> --}}
                    </form>
                </div>

                {{-- Comienza Acordion --}}
                <div class="accordion d-sm-block d-md-none d-xl-none" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">                                
                            Filtros
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @if ($categoriaFilt || $marca || $sub_categoria || $rango)
                            <div class="single-widget">
                                <div class="row g-2" >
                                    @if($categoriaFilt)
                                    <div class="col">
                                        @if(request()->session()->get('categoria'))
                                        <h6><span class="badge rounded-pill bg-light text-dark shadow-lg border border-dark"><a href="{{ route('productos') }}" class="btn btn-default btn-xs"><i class="lni lni-close"></i></a> {{ $categoriaFilt }}</span></h6>
                                        @else
                                        <h6><span class="badge rounded-pill bg-light text-dark shadow-lg border border-dark"><button class="btn btn-default btn-xs" wire:click="category('')"><i class="lni lni-close"></i></button> {{ $categoriaFilt }}</span></h6>    
                                        @endif
                                        
                                    </div>
                                    @endif
                                    @if($marca)
                                    <div class="col">
                                        <h6><span class="badge rounded-pill bg-light text-dark shadow-lg border border-dark"><button class="btn btn-default btn-xs" wire:click="brand('')"><i class="lni lni-close"></i></button> {{ $marca }}</span></h6>
                                    </div>
                                    @endif 
                                    @if($sub_categoria)
                                    <div class="col">
                                        @if(request()->session()->has('newSubCat'))
                                        <h6><span class="badge rounded-pill bg-light text-dark shadow-lg border border-dark"><button class="btn btn-default btn-xs" wire:click="subCategoriaRedirect()"><i class="lni lni-close"></i></button> {{ $sub_categoria }}</span></h6>
                                        @else
                                        <h6><span class="badge rounded-pill bg-light text-dark shadow-lg border border-dark"><button class="btn btn-default btn-xs" wire:click="subCategoria('')"><i class="lni lni-close"></i></button> {{ $sub_categoria }}</span></h6>
                                        @endif
                                    </div>
                                    @endif  
                                    @if($rango)
                                    <div class="col">
                                        <h6><span class="badge rounded-pill bg-light text-dark shadow-lg border border-dark"><button class="btn btn-default btn-xs" wire:click="resetFilters"><i class="lni lni-close"></i></button>Rango {{ json_encode($rango) }}</span></h6>
                                    </div>
                                    @endif                      
                                </div>
                            </div>
                            @endif
            
                            @if (!request()->session()->get('categoria'))
                                <div class="single-widget">
                                    <h3>Categorias</h3>
                                    <ul class="list">
                                        {{-- <li>
                                            <a href="product-grids.html">Computers & Accessories </a><span>(1138)</span>
                                        </li> --}}                            
                                        @forelse ($categorias as $cat)
                                            @php
                                                $totalCat = DB::table('productos')->where('id_categoria', $cat->id)->count();
                                            @endphp
                                            @if($categoriaFilt == $cat->nombre)
                                            <li>
                                                <a href="javascript:void(0)"  wire:click="category('{{ $cat->nombre }}')" style="color: #0167F3">{{ $cat->nombre }} </a><span>({{ $totalCat }})</span>
                                            </li> 
                                            @else
                                            <li>
                                                <a href="javascript:void(0)"  wire:click="category('{{ $cat->nombre }}')">{{ $cat->nombre }} </a><span>({{ $totalCat }})</span>
                                            </li> 
                                            @endif
                                            
                                        @empty
                                            {{ __('No se encontraron categorias') }}
                                        @endforelse                        
                                    </ul>
                                </div>
                            @endif
            
                            @if($categoriaFilt)
                            <div class="single-widget range">
                                <h3>Sub-Categorias</h3>
                                {{-- <input type="range" class="form-range" name="range" step="1" min="100" max="10000" value="10"
                                    onchange="rangePrimary.value=value">
                                <div class="range-inner">
                                    <label>$</label>
                                    <input type="text" id="rangePrimary" placeholder="100" />
                                </div> --}}
                                <ul class="list">
                                    @forelse ($subCategorias as $subCat)
                                        @php
                                            $totalSubCat = DB::table('productos')->where('id_subcat', $subCat->id)->count();
                                        @endphp
                                         @if($subCat->nombre == $sub_categoria)
                                        <li>                               
                                            <a wire:click="subCategoria('{{ $subCat->nombre }}')" style="color: #0167F3">{{ $subCat->nombre }} </a><span>({{ $totalSubCat }})</span>                                                                
                                        </li>
                                        @else
                                        <li> 
                                            <a wire:click="subCategoria('{{ $subCat->nombre }}')">{{ $subCat->nombre }} </a><span>({{ $totalSubCat }})</span>
                                        </li>
                                        @endif 
                                    @empty
                                        {{ __('No se encontraron categorias') }}
                                    @endforelse
                                </ul>    
                            </div>
                            @endif
            
                            <div class="single-widget condition">
                                <h3>Filtrar por Precio</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="[10-50]" id="flexCheckDefault0" wire:click="rango([10, 50])" name="range" onclick="selected(this)" {{ $rango == [10,50] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault0">
                                        $10 - $50 {{-- (208) --}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="[50-100]" id="flexCheckDefault1" wire:click="rango([50, 100])" name="range" onclick="selected(this)" {{ $rango == [50,100] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault1">
                                        $50 - $100 
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="[100, 500]" id="flexCheckDefault2" wire:click="rango([100, 500])" name="range" onclick="selected(this)" {{ $rango == [100,500] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault2">
                                        $100 - $500 
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="[500, 1000]" id="flexCheckDefault3" wire:click="rango([500, 1000])" name="range" onclick="selected(this)" {{ $rango == [500,1000] ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexCheckDefault3">
                                        $500 - $1,000 
                                    </label>
                                </div>
                            </div>
            
            
                            <div class="single-widget condition">
                                <h3>Marcas</h3>
                                @forelse ($brands as $key => $brand)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $brand->nombre }}" id="flexCheck{{ $key }}" wire:click="brand('{{ $brand->nombre }}')" name="brandch"  onclick="selected(this)"
                                    @if($marca == $brand->nombre)
                                        checked
                                    @endif
                                    >
                                    <label class="form-check-label" for="flexCheck{{ $key }}">
                                        @php
                                            $brandEachTotal = DB::table('productos')->where('id_marca', $brand->id)->count();
                                        @endphp
                                        {{ $brand->nombre }} ({{ $brandEachTotal }})
                                    </label>
                                </div>
                                @empty
                                    {{ __('No se encontraron marcas disponibles') }}
                                @endforelse
                                                    
                            </div>
                        </div>
                      </div>
                    </div>                    
                </div>
                {{-- Termina Acordion --}}

                @if ($categoriaFilt || $marca || $sub_categoria || $rango)
                <div class="single-widget d-none d-md-block">
                    <div class="row g-2" id="chipsContainer">
                        @if($categoriaFilt)
                        <div class="col">
                            @if(request()->session()->get('categoria'))
                            <h6><span class="badge rounded-pill bg-light text-dark shadow-lg border border-dark"><a href="{{ route('productos') }}" class="btn btn-default btn-xs"><i class="lni lni-close"></i></a> {{ $categoriaFilt }}</span></h6>
                            @else
                            <h6><span class="badge rounded-pill bg-light text-dark shadow-lg border border-dark"><button class="btn btn-default btn-xs" wire:click="category('')"><i class="lni lni-close"></i></button> {{ $categoriaFilt }}</span></h6>    
                            @endif
                            
                        </div>
                        @endif
                        @if($marca)
                        <div class="col">
                            <h6><span class="badge rounded-pill bg-light text-dark shadow-lg border border-dark"><button class="btn btn-default btn-xs" wire:click="brand('')"><i class="lni lni-close"></i></button> {{ $marca }}</span></h6>
                        </div>
                        @endif 
                        @if($sub_categoria)
                        <div class="col">
                            @if(request()->session()->has('newSubCat'))
                            <h6><span class="badge rounded-pill bg-light text-dark shadow-lg border border-dark"><button class="btn btn-default btn-xs" wire:click="subCategoriaRedirect()"><i class="lni lni-close"></i></button> {{ $sub_categoria }}</span></h6>
                            @else
                            <h6><span class="badge rounded-pill bg-light text-dark shadow-lg border border-dark"><button class="btn btn-default btn-xs" wire:click="subCategoria('')"><i class="lni lni-close"></i></button> {{ $sub_categoria }}</span></h6>
                            @endif
                        </div>
                        @endif  
                        @if($rango)
                        <div class="col">
                            <h6><span class="badge rounded-pill bg-light text-dark shadow-lg border border-dark"><button class="btn btn-default btn-xs" wire:click="resetFilters"><i class="lni lni-close"></i></button>Rango {{ json_encode($rango) }}</span></h6>
                        </div>
                        @endif                      
                    </div>
                </div>
                @endif

                @if (!request()->session()->get('categoria'))
                    <div class="single-widget d-none d-md-block">
                        <h3>Categorias</h3>
                        <ul class="list">
                            {{-- <li>
                                <a href="product-grids.html">Computers & Accessories </a><span>(1138)</span>
                            </li> --}}                            
                            @forelse ($categorias as $cat)
                                @php
                                    $totalCat = DB::table('productos')->where('id_categoria', $cat->id)->count();
                                @endphp
                                @if($categoriaFilt == $cat->nombre)
                                <li>
                                    <a href="javascript:void(0)"  wire:click="category('{{ $cat->nombre }}')" style="color: #0167F3">{{ $cat->nombre }} </a><span>({{ $totalCat }})</span>
                                </li> 
                                @else
                                <li>
                                    <a href="javascript:void(0)"  wire:click="category('{{ $cat->nombre }}')">{{ $cat->nombre }} </a><span>({{ $totalCat }})</span>
                                </li> 
                                @endif
                                
                            @empty
                                {{ __('No se encontraron categorias') }}
                            @endforelse                        
                        </ul>
                    </div>
                @endif

                {{-- FOUND --}}
                @if($categoriaFilt)
                <div class="single-widget range d-none d-md-block">
                    <h3>Sub-Categorias</h3>
                    {{-- <input type="range" class="form-range" name="range" step="1" min="100" max="10000" value="10"
                        onchange="rangePrimary.value=value">
                    <div class="range-inner">
                        <label>$</label>
                        <input type="text" id="rangePrimary" placeholder="100" />
                    </div> --}}
                    <ul class="list">
                        @forelse ($subCategorias as $subCat)
                            @php
                                $totalSubCat = DB::table('productos')->where('id_subcat', $subCat->id)->count();
                            @endphp
                             @if($subCat->nombre == $sub_categoria)
                            <li>                               
                                <a href="javascript:void(0)" wire:click="subCategoria('{{ $subCat->nombre }}')" style="color: #0167F3">{{ $subCat->nombre }} </a><span>({{ $totalSubCat }})</span>                                                                
                            </li>
                            @else
                            <li> 
                                <a href="javascript:void(0)" wire:click="subCategoria('{{ $subCat->nombre }}')">{{ $subCat->nombre }} </a><span>({{ $totalSubCat }})</span>
                            </li>
                            @endif 
                        @empty
                            {{ __('No se encontraron categorias') }}
                        @endforelse
                    </ul>    
                </div>
                @endif
                


                <div class="single-widget condition d-none d-md-block">
                    <h3>Filtrar por Precio</h3>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="[10-50]" id="flexCheckDefault0" wire:click="rango([10, 50])" name="range" onclick="selected(this)" {{ $rango == [10,50] ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault0">
                            $10 - $50 {{-- (208) --}}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="[50-100]" id="flexCheckDefault1" wire:click="rango([50, 100])" name="range" onclick="selected(this)" {{ $rango == [50,100] ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault1">
                            $50 - $100 
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="[100, 500]" id="flexCheckDefault2" wire:click="rango([100, 500])" name="range" onclick="selected(this)" {{ $rango == [100,500] ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault2">
                            $100 - $500 
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="[500, 1000]" id="flexCheckDefault3" wire:click="rango([500, 1000])" name="range" onclick="selected(this)" {{ $rango == [500,1000] ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexCheckDefault3">
                            $500 - $1,000 
                        </label>
                    </div>
                </div>


                <div class="single-widget condition d-none d-md-block">
                    <h3>Marcas</h3>
                    @forelse ($brands as $key => $brand)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $brand->nombre }}" id="flexCheck{{ $key }}" wire:click="brand('{{ $brand->nombre }}')" name="brandch"  onclick="selected(this)"
                            @if($marca == $brand->nombre)
                                checked
                            @endif
                        >
                        <label class="form-check-label" for="flexCheck{{ $key }}">
                            @php
                                $brandEachTotal = DB::table('productos')->where('id_marca', $brand->id)->count();
                            @endphp
                            {{ $brand->nombre }} ({{ $brandEachTotal }})
                        </label>
                    </div>
                    @empty
                        {{ __('No se encontraron marcas disponibles') }}
                    @endforelse
                                        
                </div>

            </div>

        </div>
        <div class="col-lg-9 col-12">
            <div class="product-grids-head">
                <div class="product-grid-topbar">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-md-8 col-12">
                            <div class="product-sorting">
                                @livewire('sort-by')
                                <h3 class="total-show-product">Mostrando: <span>{{ $filterC }} - {{ $filterA
                                }}</span></h3>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-4 d-none d-md-block">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link 
                                    @if (request()->session()->exists('listOrGrid'))
                                        @if(session('listOrGrid') == 'grid')
                                            active
                                        @endif
                                    @else
                                        active
                                    @endif
                                    " id="nav-grid-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-grid" type="button" role="tab" aria-controls="nav-grid"
                                        aria-selected="true" wire:click="listOrGrid('grid')"><i class="lni lni-grid-alt"></i></button>
                                    <button class="nav-link
                                    @if (request()->session()->exists('listOrGrid'))
                                        @if(session('listOrGrid') == 'list')
                                            active
                                        @endif
                                    @endif
                                    " id="nav-list-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-list" type="button" role="tab" aria-controls="nav-list"
                                        aria-selected="false" wire:click="listOrGrid('list')"><i class="lni lni-list"></i></button>
                                </div>
                            </nav>
                            
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade 
                    @if (request()->session()->exists('listOrGrid'))
                        @if(session('listOrGrid') == 'grid')
                            show
                            active
                        @endif
                    @else
                    show
                    active
                    @endif
                    " id="nav-grid" role="tabpanel"
                        aria-labelledby="nav-grid-tab">

                        <div class="row">                            
                            
                            @forelse ($productos as $p)
                                @php
                                    $opiniones = DB::table('opiniones')->where('id_producto', $p->id_producto);
                                    /* $total_rate = $opiniones->count();
                                    $fSum =  $total_rate*$opiniones->max('rating');
                                    $total = $opiniones->sum('rating');
                                    if ($total) {                                        
                                        $countOp = ($total*5) / $fSum;
                                    } else {
                                        $countOp = 0;
                                    } */

                                    $countOp = $opiniones->avg('rating');
                                    if (empty($countOp)) {
                                        $countOp = 0;
                                    }
                                    $ofertas;

                                    if ($p->id_oferta) {
                                        $ofertas = DB::table('ofertas')->join('tipos_ofertas', 'ofertas.id_tipo_oferta', '=', 'tipos_ofertas.id')
                                        ->where([
                                            ['ofertas.id', $p->id_oferta],
                                            ['ofertas.estado', '1'],
                                            ['tipos_ofertas.estado', '1']
                                        ])->select('ofertas.nombre as oferta', 'tipos_ofertas.nombre as type')->get();
                                    }
                                    
                                     if (!\Cart::isEmpty()) {
                                        $localCartU = \Cart::get($p->id);
                                        if ($localCartU) {
                                            $localCart[$loop->index] = \Cart::get($p->id)->toArray();
                                        }
                                    } 
                                @endphp
                            <div class="col-lg-4 col-md-6 col-12">
                            
                                <a href="{{ route('detalle', Crypt::encrypt($p->id_producto)) }}">
                                    <div class="single-product" style="cursor: pointer;" onclick="javascript:window.location.href='{{ route('detalle', Crypt::encrypt($p->id_producto)) }}'">
                                        <div class="product-image">
                                            {{-- \Debugbar::info(json_decode($p->imagen)[0]) --}}
                                            <img src="{{ asset($p->imagen_principal) }}" style="height: 288px; " alt="Product Image">
                                            @if($p->id_oferta && strtolower($ofertas[0]->type) == 'descuento' || $p->id_oferta && strtolower($ofertas[0]->type) == 'descuentos')
                                                <span class="sale-tag">{{ $ofertas[0]->oferta }}%</span>
                                            @endif
                                            {{-- <div class="button">
                                                @if(\Cart::isEmpty())
                                                    @if($p->stock > 0 /* && $localCart['quantity'] < $p->stock */)
                                                    <button class="btn" wire:click="addToCart({{ $p }})"><i class="lni lni-cart"></i> Agregar al Carrito</button>
                                                    @else
                                                    <button class="btn" style="cursor: not-allowed !important;" disabled><i class="fas fa-ban"></i> Agotado</button>
                                                    @endif
                                                @else
                                                    @if($p->stock > 0)
                                                        @if(isset($localCart[$loop->index]))
                                                            @if($localCart[$loop->index]['quantity'] < $p->stock)
                                                                <button class="btn" wire:click="addToCart({{ $p }})"><i class="lni lni-cart"></i> Agregar al Carrito</button> 
                                                            @else
                                                                <button class="btn" style="cursor: not-allowed !important;" disabled><i class="fas fa-ban"></i> Agotado</button>
                                                            @endif                                                    
                                                        @else
                                                            <button class="btn" wire:click="addToCart({{ $p }})"><i class="lni lni-cart"></i> Agregar al Carrito</button>
                                                        @endif
                                                    @else
                                                    <button class="btn" style="cursor: not-allowed !important;" disabled><i class="fas fa-ban"></i> Agotado</button>
                                                    @endif
                                                @endif
                                            </div> --}}
                                        </div>
                                        <div class="product-info">
                                            <span class="category">
                                                <span class="badge rounded-pill bg-light text-dark">{{ $p->id_categoria }}</span>
                                                <span class="badge rounded-pill text-dark" style="background: #fcde67">{{ $p->marca }}</span>
                                            </span>
                                            <h4 class="title">
                                                <a href="{{ route('detalle', Crypt::encrypt($p->id_producto)) }}">{{ $p->nombre }}</a>
                                            </h4>
                                            <ul class="review">
                                                @switch(round($countOp))
                                                    @case(1)
                                                    <li><i class="lni lni-star-filled"></i></li>
                                                    <li><i class="lni lni-star"></i></li>
                                                    <li><i class="lni lni-star"></i></li>
                                                    <li><i class="lni lni-star"></i></li>
                                                    <li><i class="lni lni-star"></i></li>
                                                        @break
                                                    @case(2)
                                                    <li><i class="lni lni-star-filled"></i></li>
                                                    <li><i class="lni lni-star-filled"></i></li>
                                                    <li><i class="lni lni-star"></i></li>
                                                    <li><i class="lni lni-star"></i></li>
                                                    <li><i class="lni lni-star"></i></li>
                                                        @break
                                                    @case(3)
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        @break
                                                    @case(4)
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        @break
                                                    @case(5)
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        @break

                                                    @default
                                                    <li><i class="lni lni-star"></i></li>
                                                    <li><i class="lni lni-star"></i></li>
                                                    <li><i class="lni lni-star"></i></li>
                                                    <li><i class="lni lni-star"></i></li>
                                                    <li><i class="lni lni-star"></i></li>
                                                @endswitch
                                                {{-- <li><i class="lni lni-star-filled"></i></li>
                                                <li><i class="lni lni-star-filled"></i></li>
                                                <li><i class="lni lni-star-filled"></i></li>
                                                <li><i class="lni lni-star-filled"></i></li>
                                                <li><i class="lni lni-star"></i></li> --}}
                                                <li><span>{{ round($countOp) }} Valoración(es)</span></li>
                                            </ul>
                                            <div class="price">
                                                @if($p->id_oferta && strtolower($ofertas[0]->type) == 'descuento' || $p->id_oferta && strtolower($ofertas[0]->type) == 'descuentos')
                                                <span>${{ number_format($p->precio_venta * (('100' - number_format($ofertas[0]->oferta)) / '100'), 2, '.', '') }}</span>
                                                <span class="discount-price">${{ $p->precio_venta }}</span>
                                                @else
                                                <span>${{ $p->precio_venta }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            
                            </div>
                            @empty
                            <p class="text-center">{{ __('No se encontraron productos en el inventario, por favor intentalo mas tarde...') }}</p>
                            @endforelse
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    {{$productos->onEachSide(1)->links()}}
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-12">

                                {{--<div class="pagination left">
                                    <ul class="pagination-list">
                                        <li><a href="javascript:void(0)">1</a></li>
                                        <li class="active"><a href="javascript:void(0)">2</a></li>
                                        <li><a href="javascript:void(0)">3</a></li>
                                        <li><a href="javascript:void(0)">4</a></li>
                                        <li><a href="javascript:void(0)"><i class="lni lni-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>--}}

                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade
                    @if (request()->session()->exists('listOrGrid'))
                        @if(session('listOrGrid') == 'list')
                            show
                            active
                        @endif
                    @endif
                    " id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                        <div class="row">
                            {{-- Editar --}}
                            @forelse ($productos as $p)
                                @php
                                    $opiniones = DB::table('opiniones')->where('id_producto', $p->id_producto);
                                    /* $total_rate = $opiniones->count();
                                    $fSum =  $total_rate*$opiniones->max('rating');
                                    $total = $opiniones->sum('rating');
                                    if ($total) {                                        
                                        $countOp = ($total*5) / $fSum;
                                    } else {
                                        $countOp = 0;
                                    } */

                                    $countOp = $opiniones->avg('rating');
                                    if (empty($countOp)) {
                                        $countOp = 0;
                                    }
                                    
                                    if ($p->id_oferta) {
                                        $ofertas = DB::table('ofertas')->join('tipos_ofertas', 'ofertas.id_tipo_oferta', '=', 'tipos_ofertas.id')
                                        ->where([
                                            ['ofertas.id', $p->id_oferta],
                                            ['ofertas.estado', '1'],
                                            ['tipos_ofertas.estado', '1']
                                        ])->select('ofertas.nombre as oferta', 'tipos_ofertas.nombre as type')->get();
                                    }

                                    if (!\Cart::isEmpty()) {
                                        $localCartU = \Cart::get($p->id);
                                        if ($localCartU) {
                                            $localCart[$loop->index] = \Cart::get($p->id)->toArray();
                                        }
                                    } 
                                @endphp
                            <div class="col-lg-12 col-md-12 col-12">

                                <div class="single-product" style="cursor: pointer;" onclick="javascript:window.location.href='{{ route('detalle', Crypt::encrypt($p->id_producto)) }}'">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="product-image">
                                                <img src="{{ json_decode($p->imagen)[0] }}" alt="#">
                                                @if($p->id_oferta && strtolower($ofertas[0]->type) == 'descuento' || $p->id_oferta && strtolower($ofertas[0]->type) == 'descuentos')
                                                    <span class="sale-tag">{{ $ofertas[0]->oferta }}%</span>
                                                @endif
                                                {{-- <div class="button">
                                                    @if(\Cart::isEmpty())
                                                        @if($p->stock > 0 /* && $localCart['quantity'] < $p->stock */)
                                                        <button class="btn" wire:click="addToCart({{ $p }})"><i class="lni lni-cart"></i> Agregar al Carrito</button>
                                                        @else
                                                        <button class="btn" style="cursor: not-allowed !important;" disabled><i class="fas fa-ban"></i> Agotado</button>
                                                        @endif
                                                        @else
                                                        @if($p->stock > 0)
                                                            @if(isset($localCart[$loop->index]))
                                                                @if($localCart[$loop->index]['quantity'] < $p->stock)
                                                                    <button class="btn" wire:click="addToCart({{ $p }})"><i class="lni lni-cart"></i> Agregar al Carrito</button> 
                                                                @else
                                                                    <button class="btn" style="cursor: not-allowed !important;" disabled><i class="fas fa-ban"></i> Agotado</button>
                                                                @endif                                                    
                                                            @else
                                                                <button class="btn" wire:click="addToCart({{ $p }})"><i class="lni lni-cart"></i> Agregar al Carrito</button>
                                                            @endif
                                                        @else
                                                        <button class="btn" style="cursor: not-allowed !important;" disabled><i class="fas fa-ban"></i> Agotado</button>
                                                        @endif
                                                    @endif
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-12">
                                            <div class="product-info">
                                                <span class="category">
                                                    <span class="badge rounded-pill bg-light text-dark">{{ $p->id_categoria }}</span>
                                                    <span class="badge rounded-pill text-dark" style="background: #fcde67">{{ $p->marca }}</span>
                                                </span>
                                                <h4 class="title">
                                                    <a href="{{ route('detalle', Crypt::encrypt($p->id)) }}">{{ $p->nombre }}</a>
                                                </h4>
                                                <ul class="review">
                                                    @switch(round($countOp))
                                                        @case(1)
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                            @break
                                                        @case(2)
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star-filled"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                            @break
                                                        @case(3)
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                            <li><i class="lni lni-star"></i></li>
                                                            <li><i class="lni lni-star"></i></li>
                                                            @break
                                                        @case(4)
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                            <li><i class="lni lni-star"></i></li>
                                                            @break
                                                        @case(5)
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                            <li><i class="lni lni-star-filled"></i></li>
                                                            @break

                                                        @default
                                                        <li><i class="lni lni-star"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                        <li><i class="lni lni-star"></i></li>
                                                    @endswitch
                                                    {{-- <li><i class="lni lni-star-filled"></i></li>
                                                    <li><i class="lni lni-star-filled"></i></li>
                                                    <li><i class="lni lni-star-filled"></i></li>
                                                    <li><i class="lni lni-star-filled"></i></li>
                                                    <li><i class="lni lni-star"></i></li> --}}
                                                    <li><span>{{ round($countOp) }} Valoración(es)</span></li>
                                                </ul>
                                                <div class="price">
                                                    @if($p->id_oferta && strtolower($ofertas[0]->type) == 'descuento' || $p->id_oferta && strtolower($ofertas[0]->type) == 'descuentos')
                                                    <span>${{ number_format($p->precio_venta * (('100' - number_format($ofertas[0]->oferta)) / '100'), 2, '.', '') }}</span>
                                                    <span class="discount-price">${{ $p->precio_venta }}</span>
                                                    @else
                                                    <span>${{ $p->precio_venta }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @empty
                            <p class="text-center">{{ __('No se encontraron productos en el inventario, por favor intentalo mas tarde...') }}</p>
                            @endforelse
                            {{-- end --}}
                        </div>
                        <div class="row">
                            <div class="col-12">

                                <div class="pagination left">
                                    {{$productos->onEachSide(1)->links()}}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function selected(checkbox) {
            var checkboxes = document.getElementsByName(checkbox.name)
            checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked =  false
            })
        }

        let screenIsSmall = () => {
            /* console.log(screen.width); */
            if (screen.width <= 768) {
                /* Livewire.emit('smRefresh'); */
                console.log('nyahallo');
                /* setTimeout(() => {
                    location.reload(); 
                }, 1000); */
            }
        };
    </script>
@endpush


