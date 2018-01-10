<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class)->create([
           'email' => 'admin@user.com',
           'enrolment' => 100000,
        ])->each(function(\App\Models\User $user){
            \App\Models\User::assingRole($user,\App\Models\User::ROLE_ADMIN);
            $user->save();
        });
    }
}
