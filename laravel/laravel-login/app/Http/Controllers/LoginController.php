<?php

namespace App\Http\Controllers;

use App\Models\UsuarioModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest')->except([
        //     'logout', 'dashboard'
        // ]);
        $this->middleware('web');
    }
    
    public function register()
    {
        return view('register');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|min:3|max:250',
            'username' => 'required|string|min:5|max:25',
            'email' => 'required|email|max:250|unique:users',
            'passwords' => 'required|min:8|confirmed'
        ]);

        UsuarioModel::create([
            'nombres' => $request->name,
            'username' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
        ->withSuccess('You have successfully registered & logged in!');
    }


    public function login()
    {
        return view('login');
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    } 
    
 
    public function dashboard()
    {
        if(Auth::check())
        {
            return view('secret');
        }
        
        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    } 
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }    

}
