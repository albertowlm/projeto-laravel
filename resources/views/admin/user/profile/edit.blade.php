@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            @component('admin.user.tabs-component',['user' => $form->getModel()])

            <div class="col-md-12">
                <h1>Editar Perfil</h1>
                {!! form($form->add('edit','submit',[
                    'attr' => ['class' => 'btn btn-primary btn-block'],
                    'label' => Icon::floppyDisk()
                ]))
                !!}
                </div>
            @endcomponent
        </div>

    </div>



@endsection