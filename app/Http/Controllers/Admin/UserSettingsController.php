<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\UserSettingsForm;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserSettingsController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $form = \FormBuilder::create( UserSettingsForm::class, [
            'url' => route('admin.user.settings.update'),
            'method' => 'PUT'
        ]);
        return view('admin.user.settings',compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $form = \FormBuilder::create( UserSettingsForm::class );

        if(!$form->isValid()){
            return redirect()->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $data['password'] = bcrypt($data['password']);
        \Auth::user()->update($data);
        $request->session()->flash('message','Senha alterada com sucesso');
        return redirect()->route('admin.user.settings.edit');

    }

}
