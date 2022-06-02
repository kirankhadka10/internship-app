<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        // return User::all();
        $users = User::paginate(15);
        return $users;
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');

    }

    public function updateUser($user, array $data)
    {
        // return User::whereId($userId)->update($newDetails);
        $user->update($data);
    }
}