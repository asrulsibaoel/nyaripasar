<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function createUserWithData(string $name, string $email, string $password, string $role, string $description)
    {
        $static = new static();
        $static->name = $name;
        $static->email = $email;
        $static->password = bcrypt($password);
        $static->role = $role;
        $static->description = $description;

        return $static;
    }
}
