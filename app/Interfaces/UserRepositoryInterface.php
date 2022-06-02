<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getAllUsers();
    // public function getUserById($userId);
    public function deleteUser(User $user);
    // public function createUser(array $userDetails);
    public function updateUser($userId, array $newDetails);
}