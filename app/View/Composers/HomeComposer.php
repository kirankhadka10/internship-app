<?php

namespace App\View\Composers;

use App\Models\User;
use Illuminate\View\View;
use App\Repositories\UserRepository;

class HomeComposer
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users =User::paginate(15);
    }

    public function compose(View $view)
    {
        $view->with('users', $this->users);
    }
}