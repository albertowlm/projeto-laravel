@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <h1>Listagem de Usuários</h1>
            {!! Button::Primary(Icon::floppyDisk())->asLinkTo(route('admin.user.create')) !!}


        </div>
        <div class="row">
            {!! Table::withContents($users->items())
            ->callback('Ações', function($field,$model){
                $linkEdit = route('admin.user.edit',['user' => $model->id]);
                $linkShow = route('admin.user.show',['user' => $model->id]);
                $linkProfile = route('admin.user.profile.edit',['user' => $model->id]);
                return Button::link(Icon::pencil())->asLinkTo($linkEdit).'|'.
                    Button::link(Icon::folderOpen())->asLinkTo($linkShow).'|'.
                    Button::link(Icon::user())->asLinkTo($linkProfile)
                    ;
            })
             !!}
        </div>

        {!! $users->links() !!}
    </div>



@endsection