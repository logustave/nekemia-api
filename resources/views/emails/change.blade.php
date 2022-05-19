@component('mail::message')
    {{ $admin->full_name }},

    Vos informations <br>
    <strong>Nom complet: {{ $admin->full_name }}</strong><br>
    <strong>Email: {{ $admin->email }}</strong><br>

    Cliquez sur ce <a target="_blank" href="{{ $url }}">lien</a> pour vérifier votre adresse email.

    Lien : {{$url}}
@endcomponent
