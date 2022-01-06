<div>
    @foreach($coments as $key => $p)

    <div class="row">
        <div class="col-lg-8 col-12 mx-auto mt-2">
            <div class="card text-center border-0">
                <div class="card-body">
                    {{ $p->name }}
                    <img class="img-thumbnail rounded float-start" src="{{ asset('frontend/assets/images/no-image-avatar.png') }}" alt="User image"
                        width="100px" height="100px">
                        @auth
                            @if (auth()->user()->id_tipo_usuario === 1)
                            <br>
                            {{ $p->email }}
                            <form method="POST" action="{{ route('review.delete', $p->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-outline-danger rounded-circle btn-sm"
                                    onclick="return confirm('¿Estas seguro que deseas eliminar el comentario?')"><i
                                        class="lni lni-trash-can"></i></button>
                            </form>
                            @endif
                        @endauth
                    <div class="row">
                        <div class="col">
                            <div class='card_right__rating'>
                                <div class='card_right__rating__stars'>
                                    <fieldset class='rating'>
                                        @if($p->rating == 0.5)
                                        <input type='radio' value='0.5' checked>
                                        <label class='half' title='0.5 estrellas'></label>
                                        @elseif($p->rating == 1.0)
                                        <input type='radio' value='1' checked>
                                        <label class='full' title='1 star'></label>
                                        @elseif($p->rating == 1.5)
                                        <input type='radio' value='1.5' checked>
                                        <label class='half' title='1.5 estrellas'></label>
                                        <input id='star1' name='rating' type='radio' value='1'>
                                        <label class='full' title='1 star'></label>
                                        <input id='starhalf' name='rating' type='radio' value='0.5'>
                                        <label class='half' title='0.5 estrellas'></label>
                                        @elseif($p->rating == 2.0)
                                        <input type='radio' value='2' checked>
                                        <label class='full' title='2 estrellas'></label>
                                        <input id='star1half' name='rating' type='radio' value='1.5'>
                                        <label class='half' title='1.5 estrellas'></label>
                                        <input id='star1' name='rating' type='radio' value='1'>
                                        <label class='full' title='1 star'></label>
                                        <input id='starhalf' name='rating' type='radio' value='0.5'>
                                        <label class='half' title='0.5 estrellas'></label>
                                        @elseif($p->rating == 2.5)
                                        <input type='radio' value='2.5' checked>
                                        <label class='half' title='2.5 estrellas'></label>
                                        <input id='star2' name='rating' type='radio' value='2'>
                                        <label class='full' title='2 estrellas'></label>
                                        <input id='star1half' name='rating' type='radio' value='1.5'>
                                        <label class='half' title='1.5 estrellas'></label>
                                        <input id='star1' name='rating' type='radio' value='1'>
                                        <label class='full' title='1 star'></label>
                                        <input id='starhalf' name='rating' type='radio' value='0.5'>
                                        <label class='half' title='0.5 estrellas'></label>
                                        @elseif($p->rating == 3.0)
                                        <input type='radio' value='3' checked>
                                        <label class='full' title='3 estrellas'></label>
                                        <input id='star2half' name='rating' type='radio' value='2.5'>
                                        <label class='half' title='2.5 estrellas'></label>
                                        <input id='star2' name='rating' type='radio' value='2'>
                                        <label class='full' title='2 estrellas'></label>
                                        <input id='star1half' name='rating' type='radio' value='1.5'>
                                        <label class='half' title='1.5 estrellas'></label>
                                        <input id='star1' name='rating' type='radio' value='1'>
                                        <label class='full' title='1 star'></label>
                                        <input id='starhalf' name='rating' type='radio' value='0.5'>
                                        <label class='half' title='0.5 estrellas'></label>
                                        @elseif($p->rating == 3.5)
                                        <input type='radio' value='3.5' checked>
                                        <label class='half' title='3.5 estrellas'></label>
                                        <input id='star3' name='rating' type='radio' value='3'>
                                        <label class='full' title='3 estrellas'></label>
                                        <input id='star2half' name='rating' type='radio' value='2.5'>
                                        <label class='half' title='2.5 estrellas'></label>
                                        <input id='star2' name='rating' type='radio' value='2'>
                                        <label class='full' title='2 estrellas'></label>
                                        <input id='star1half' name='rating' type='radio' value='1.5'>
                                        <label class='half' title='1.5 estrellas'></label>
                                        <input id='star1' name='rating' type='radio' value='1'>
                                        <label class='full' title='1 star'></label>
                                        <input id='starhalf' name='rating' type='radio' value='0.5'>
                                        <label class='half' title='0.5 estrellas'></label>
                                        @elseif($p->rating == 4.0)
                                        <input type='radio' value='4' checked>
                                        <label class='full' title='4 estrellas'></label>
                                        <input id='star3half' name='rating' type='radio' value='3.5'>
                                        <label class='half' title='3.5 estrellas'></label>
                                        <input id='star3' name='rating' type='radio' value='3'>
                                        <label class='full' title='3 estrellas'></label>
                                        <input id='star2half' name='rating' type='radio' value='2.5'>
                                        <label class='half' title='2.5 estrellas'></label>
                                        <input id='star2' name='rating' type='radio' value='2'>
                                        <label class='full' title='2 estrellas'></label>
                                        <input id='star1half' name='rating' type='radio' value='1.5'>
                                        <label class='half' title='1.5 estrellas'></label>
                                        <input id='star1' name='rating' type='radio' value='1'>
                                        <label class='full' title='1 star'></label>
                                        <input id='starhalf' name='rating' type='radio' value='0.5'>
                                        <label class='half' title='0.5 estrellas'></label>
                                        @elseif($p->rating == 4.5)
                                        <input type='radio' value='4.5' checked>
                                        <label class='half' title='4.5 estrellas'></label>
                                        <input id='star4' name='rating' type='radio' value='4'>
                                        <label class='full' title='4 estrellas'></label>
                                        <input id='star3half' name='rating' type='radio' value='3.5'>
                                        <label class='half' title='3.5 estrellas'></label>
                                        <input id='star3' name='rating' type='radio' value='3'>
                                        <label class='full' title='3 estrellas'></label>
                                        <input id='star2half' name='rating' type='radio' value='2.5'>
                                        <label class='half' title='2.5 estrellas'></label>
                                        <input id='star2' name='rating' type='radio' value='2'>
                                        <label class='full' title='2 estrellas'></label>
                                        <input id='star1half' name='rating' type='radio' value='1.5'>
                                        <label class='half' title='1.5 estrellas'></label>
                                        <input id='star1' name='rating' type='radio' value='1'>
                                        <label class='full' title='1 star'></label>
                                        <input id='starhalf' name='rating' type='radio' value='0.5'>
                                        <label class='half' title='0.5 estrellas'></label>
                                        @elseif($p->rating == 5.0)
                                        <input type='radio' value='5' checked>
                                        <label class='full' title='5 estrellas'></label>
                                        <input id='star4half' name='rating' type='radio' value='4.5'>
                                        <label class='half' title='4.5 estrellas'></label>
                                        <input id='star4' name='rating' type='radio' value='4'>
                                        <label class='full' title='4 estrellas'></label>
                                        <input id='star3half' name='rating' type='radio' value='3.5'>
                                        <label class='half' title='3.5 estrellas'></label>
                                        <input id='star3' name='rating' type='radio' value='3'>
                                        <label class='full' title='3 estrellas'></label>
                                        <input id='star2half' name='rating' type='radio' value='2.5'>
                                        <label class='half' title='2.5 estrellas'></label>
                                        <input id='star2' name='rating' type='radio' value='2'>
                                        <label class='full' title='2 estrellas'></label>
                                        <input id='star1half' name='rating' type='radio' value='1.5'>
                                        <label class='half' title='1.5 estrellas'></label>
                                        <input id='star1' name='rating' type='radio' value='1'>
                                        <label class='full' title='1 star'></label>
                                        <input id='starhalf' name='rating' type='radio' value='0.5'>
                                        <label class='half' title='0.5 estrellas'></label>
                                        @endif
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <p class="text-muted text-start">{{ date('d-m-Y', strtotime($p->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h6>{{ $p->title }}</h6>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col text-center">
                            <p class="card-text">{{ $p->descripcion }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach
    <div class="d-flex justify-content-center">
        {{-- $coments->links('vendor.pagination.pagination-custom-load-more') --}}

        @if($limitPerPage !== 5)
        <nav>
            <ul class="pagination">
                <li class="page-item btn btn-sm">
                    <button type="button" class="page-link" wire:click="$emit('load-less')"><span>Cargar menos opiniones...</span></button>
                </li>
            </ul>
        </nav>
        @endif

        {{ $coments->links('vendor.livewire.custom-paginate-simple') }}
    </div>
</div>
