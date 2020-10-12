<?php

namespace App\Traits;

trait RegisterUser
{
    public function registerUser($fields)
    {
        $user = \App\User::create([
            'name'      => $fields->name,
            'email'     => $fields->email,
            'username' => $fields->username,
            'password'  => $fields->password
        ]);
        return $user;
    }
}