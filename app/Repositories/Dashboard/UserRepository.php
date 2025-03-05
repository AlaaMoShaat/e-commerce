<?php

namespace App\Repositories\Dashboard;

use App\Models\User;

class UserRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getUsers() {
        return User::get();
    }
    public function getUser($id) {
        return User::find($id);
    }

    public function createUser($data) {
        return User::create($data);
    }



}