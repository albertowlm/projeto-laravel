@php
    $tabs = [
        ['title' => 'Informações','link' => route('admin.user.edit',['user' => $user->id])],
        ['title' => 'Perfil','link' => route('admin.user.profile.edit',['user' => $user->id])],

    ]

@endphp

<h3>Gerenciar usuário</h3>
<div class="text-right">
    {!! Button::link('Listar Usuário')->asLinkTo(route('admin.user.index')) !!}
</div>
{!! \Navigation::tabs($tabs) !!}
<div>
    {!! $slot !!}
</div>