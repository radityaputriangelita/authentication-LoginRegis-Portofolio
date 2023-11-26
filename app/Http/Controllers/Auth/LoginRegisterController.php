<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendMailJob;

class LoginRegisterController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    //display regist form

    public function register()
    {
        return view('auth.register');
    }

    //store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // $data = User::updateOrCreate(
        //     ['name' => $request->name],
        //     ['email' =>$request->email, 'password' =>Hash::make($request->password)]
        // );
        $data = [
            'name' =>$request->name,
            'email'=>$request->email,
            'subject' =>"Regis Sukses Web Raditya Angelita",
            'body'=>"Anda sudah bergabung pada web milik Raditya Angelita. Sekarang Anda bisa mengakses segala informasi yang disediakan."
        ];

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();

        dispatch(new SendMailJob($data));
        
        return redirect()->route('dashboard') ->withSuccess('You have successfully registered & logged in');
    }

    //display login form
    public function login()
    {
        return view('auth.login');
    }

    //authenticate the user
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' =>'required',
        ]);
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard') ->withSuccess('You have successfully logged in');
        }
        return back()->withErrors([
            'email' =>'Your Provided credentials do not match in our record',
        ])->onlyInput('email');
    }

    //display dashboard authenticated users
    public function dashboard()
    {
        if(Auth::check()){
            return view('auth.dashboard');
        }
        return redirect()->route('login') ->withErrors([
            'email' => 'Please login to access the dashboard',
        ])->onlyInput('email');
    }

    //logout user from application
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
        ->withSuccess('You have logged out successfully');;
    }
    // public function logout(Request $request){
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect()->route('login') ->withSuccess('You have logged out successfully');
    // }
}
