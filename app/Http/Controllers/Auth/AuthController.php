<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
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

    public function registrationProcess(Request $request) {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'phoneNumber' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $user = $this->create($data);

        Auth::login($user);

        return redirect('home')->withSuccess('Register Successful!');
    }

    public function loginProcess(Request $request) {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            return redirect()->intended('home')->withSuccess('Login Successful!');
        }

        return redirect('login')->withErrors('Invalid Credentials!');
    }

    public function logout():RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
