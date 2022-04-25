@component('mail::message')
# Restablecer Contraseña
{{ $details['title'] }}
 
@component('mail::button', ['url' => $details['body']])
Cambiar Contraseña
@endcomponent
 
No lo solicitaste, omite este email,<br>
{{ config('app.name') }}
@endcomponent