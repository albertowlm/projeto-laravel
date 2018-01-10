<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\UserForm;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::paginate();
        return view('admin.user.index',compact('users'));


        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       $form = \FormBuilder::create( UserForm::class, [
            'url' => route('admin.user.store'),
            'method' => 'POST'
        ]);
        return view('admin.user.create',compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = \FormBuilder::create( UserForm::class );

        if(!$form->isValid()){
            return redirect()->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
       $data = $form->getFieldValues();

       User::createFully($data);
        $request->session()->flash('message','Usuário criado com sucesso');
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view( 'admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create( UserForm::class, [
            'url' => route('admin.user.update',['user' => $user->id]),
            'method' => 'PUT',
            'model' => $user
        ]);
        return view('admin.user.edit',compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $form = \FormBuilder::create( UserForm::class,
            ['data' => ['id' => $user->id]] );

        if(!$form->isValid()){
            return redirect()->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $user->update($data);
        session()->flash('message','Usuário editado com sucesso');
        return redirect()->route('admin.user.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('message','Usuário excluido com sucesso');
        return redirect()->route('admin.user.index');
    }
}
