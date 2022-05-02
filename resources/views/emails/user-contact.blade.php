@component('mail::message')
# Confirma la eliminación de tú cuenta

<p>
    Como {{ config('app.name') }} lamentamos que te vayas.
</p>

 
@component('mail::button', ['url' => $data['name']])
Confirmar
@endcomponent
 
No lo solicitaste, omite este email,<br>
{{ config('app.name') }}
@endcomponent