@extends('app')

@section('title')

@section('breadcrumb')
    
@endsection

@section('content')
    <section>
        <div class="container pt-3 pb-3">
            @livewire('trash-user', ['email' => request('email')])
            {{-- request('email') --}}
        </div>
    </section>
@endsection