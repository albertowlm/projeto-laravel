<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Models\User;

class UserSettingsForm extends Form
{
    public function buildForm()
    {
        $id = $this->getData('id');
        $this
            ->add('password', 'password', [
                'rules' => 'required|min:6|max:16|confirmed'
            ])
            ->add('password_confirmation', 'password');
    }


}
