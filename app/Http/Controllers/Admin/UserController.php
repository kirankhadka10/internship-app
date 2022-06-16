<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    protected $roles = [
        'User',
        'Admin',
    ];

    public function index()
    {
        // $users = User::paginate(15);
        
        $users=  $this->userRepository->getAllUsers();
        return view('admin.users.index',compact('users'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit(User $user):View
    {
        $roles = $this->roles;
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' =>   ['required'],
            'email' =>  ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' =>  ['required',],
            'username'  =>  ['required', 'unique:users,username,' . $user->id],
            'password'  =>  ['nullable'],
            'role'      =>  ['nullable', Rule::in($this->roles)],
        ]);

        if (!empty($request->password)) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $this->userRepository->updateUser($user, $data);
    //    $user->update($data);
        
        return redirect()->route('admin.users.index');
    }

    public function destroy(Request $request, User $user)
    {
        // $userId = $request->route('id');
        // $user->delete();
       $this->userRepository->deleteUser($user);
       
        // // $user->delete();
        return redirect()->route('admin.users.index');
        // return ;
    }
}
