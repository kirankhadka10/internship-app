<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    protected $roles = [
        'User',
        'Admin',
    ];
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user):View
    {
        $roles = $this->roles;
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' =>   ['required'],
            'email' =>  ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' =>  ['required', 'digits:10'],
            'username'  =>  ['required', 'unique:users,username,' . $user->id],
            'password'  =>  ['nullable'],
            'role'      =>  ['nullable', Rule::in($this->roles)],
        ]);

        if(!empty($request->password)){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }


       $user->update($data);
        
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
