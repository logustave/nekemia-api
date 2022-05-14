@component('mail::message')
Mr {{ $full_name }},

Cliquez sur ce <a target="_blank" href="{{ $url }}">lien</a> pour vérifier votre adresse email.

Lien : {{$url}}

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
