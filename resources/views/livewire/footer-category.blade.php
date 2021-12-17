<ul>
    @forelse ($categorys as $c)
    <li><a href="{{ url('/productos/'.$c->nombre) }}">{{ $c->nombre }}</a></li>
    @empty
        <li><p class="text-center">{{ __('No se encontraron categorias, intentalo de nuevo mas tarde...') }}</p></li>
    @endforelse    
</ul>