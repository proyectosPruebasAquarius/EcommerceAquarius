@component('mail::message')
# Confirma la eliminación de tú cuenta

<p>
    Como {{ config('app.name') }} lamentamos que te vayas.
</p>
{{ $user['title'] }}
 
@component('mail::button', ['url' => $user['url']])
Confirmar
@endcomponent
 
No lo solicitaste, omite este email,<br>
{{ config('app.name') }}
@endcomponent