<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Forms\UserForm;
use App\Forms\UserProfileForm;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserProfileController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $form = \FormBuilder::create( UserProfileForm::class, [
            'url' => route('admin.user.profile.update',['user' => $user->id]),
            'method' => 'PUT',
            'model' => $user->profile,
            'data' => ['user' => $user]
        ]);
        return view('admin.user.profile.edit',compact('form'));
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
        $form = \FormBuilder::create( UserProfileForm::class );

        if(!$form->isValid()){
            return redirect()->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }
        $data = $form->getFieldValues();
        $user->profile->address?$user->profile->update($data):$user->profile()->create($data);

        session()->flash('message','Perfil alterado com sucesso');
        return redirect()->route('admin.user.profile.update',['user' => $user->id]);

    }


}
