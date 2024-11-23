<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Lawyer;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login() {
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }

    public function loginLawyer()
    {
        return view('auth.login-lawyer');
    }

    public function registerLawyer()
    {
        return view('auth.register-lawyer');
    }

    public function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'phoneNumber' => $data['phoneNumber'],
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'password' => Hash::make($data['password'])
          ]);
    }

    public function registerProcess(Request $request) {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'phoneNumber' => 'required',
            'gender' => 'required|in:male,female',
            'dob' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $user = $this->create($data);

        Auth::login($user);

        return redirect('/')->withSuccess('Register Successful!');
    }

    public function createLawyer(array $data) {
        return Lawyer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phoneNumber' => $data['phoneNumber'],
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'password' => Hash::make($data['password']),
            'education' => $data['education'],
            'address' => $data['address'],
            'experience' => $data['experience'],
            'rate' => $data['rate'],
        ]);
    }

    public function registerProcessLawyer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:lawyers,email',
            'phoneNumber' => 'required',
            'gender' => 'required|in:male,female',
            'dob' => 'required',
            'password' => 'required|min:6',
            'education' => 'required',
            'address' => 'required',
            'experience' => 'required',
            'rate' => 'required',
        ]);

        $data = $request->all();
        $lawyer = $this->createLawyer($data);

        Auth::guard('lawyer')->login($lawyer);

        return redirect('/')->with('success', 'Registration Successful!');
    }

    public function loginProcess(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')->with('success', 'Login Successful!');
        }

        return redirect('login')->with('error', 'Invalid Credentials!');
    }

    public function loginProcessLawyer(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::guard('lawyer')->attempt($credentials)) {
            return redirect()->intended('/')->with('success', 'Login Successful!');
        }

        return redirect()->route('lawyer.login')->with('error', 'Invalid Credentials!');
    }

    public function logout(): RedirectResponse {
        if (Auth::guard('lawyer')->check()) {
            Auth::guard('lawyer')->logout();
            Session::flush();

            return redirect()->route('lawyer.login')->with('success', 'Logged out successfully!');
        }

        Auth::guard('web')->logout();
        Session::flush();

        return redirect('login')->with('success', 'Logged out successfully!');
    }
}
