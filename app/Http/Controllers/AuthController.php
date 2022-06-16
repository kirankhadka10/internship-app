<?php

namespace App\Http\Controllers;

use App\Jobs\VerifyUser;
use App\Mail\SendVerification;
use App\Mail\UserVerified;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
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

    public function home()
    {
        $users = User::all();
        return view('home',compact('users'));
    }

    public function login()
    {
        $users = User::all();
        return view('auth.login', compact('users'));
    }

    public function customLogin(Request $request)
    {
       
        $request->validate([
            'email' =>  ['required', 'email'],
            'password'  =>  ['required'],
        ]);

        $credentials = $request->only('email', 'password');
        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect()->route('home');

        }
        
        return redirect()->route('login')->with('error','Invalid Credentials !');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function customRegister(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' =>['required', 'email', 'unique:users,email'],
            'phone' =>  ['numeric', 'nullable'],
            'username'  =>  ['required', 'unique:users,username'],
            'password'  =>  ['required'],
            'role'      =>  ['nullable', Rule::in($this->roles)],
        ]);

        $data['password'] = bcrypt($data['password']);

       $user= User::create($data);

       Auth::loginUsingId($user->id);

       event(new Registered($user));
    //    Mail::to($user->email)->send(new SendVerification($user));

        // dd($user);
        return redirect()->route('verification.notice');
    }

// Email Verification Link
    public function verificationNotice()
    {
        return view('auth.verify-email');
    }

    public function verifyingEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        $user = $request->user();
        Mail::to($request->user())->queue(new UserVerified($user));
        // VerifyUser::dispatch($user);
        return redirect()->route('home');
    }

    public function resendVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        
        // return redirect()->route('auth.verify-email');
        return back()->with('message', 'Verification link sent!');
    }
// Resetting the Password
    public function forgotPassword(User $user): View
    {
    
        return view('auth.forgot-password',compact('user'));
    }

    public function verifyEmail(Request $request)
    {
        $request->validate(['email' => ['required','email']]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT ? back()->with(['status' => __($status)]) :
                            back()->withErrors(['email' => __($status)]);

        //  return redirect()->route('login');
    }

    public function passwordReset (Request $request, $token) 
    {
        
        return view('auth.resetPassword', compact('token'));
    }

    public function resetHandler(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        return redirect()->route('login');
        }

    public function logout(Request $request)
    {
        Auth::logout($request->user_id);

        return redirect()->route('home');
    }
}
