@if (\Session::has('message'))
    <div class="alert alert-primary" role="alert">
        {!! \Session::get('message') !!}
    </div>
@elseif(\Session::has('error'))
    <div class="alert alert-danger" role="alert">
        {!! \Session::get('error') !!}
    </div>
@endif