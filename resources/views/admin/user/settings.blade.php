@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <h1>Editar meu perfil de usuário</h1>
            {!! form($form->add('Insert','submit',[
                'attr' => ['class' => 'btn btn-primary btn-block'],
                'label' => Icon::floppyDisk()
            ]))!!}

        </div>

    </div>



@endsection