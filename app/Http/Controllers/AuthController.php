<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function ShowRegisterForm(Request $request){
        return view('auth.register');
    }
    public function Register(Request $request){
        try{
            // dd($request);
            $request -> validate([
                'name' => 'required|string|max:225',
                'email'=> 'required|string|max:225|unique:users',
                'password'=>'required|string|min:8',
            ]);
            User::create([
                'name'=>$request->name,
                'email'=>$request ->email,
                'password'=>Hash::make( $request->password ),
            ]);
            return redirect(route('login'))->with('success','Registration successful!');
        }
        catch(\Exception $e){
            // dump($e->getMessage());
            // return back() -> with('error','error occured please check input ');
        }
    }

    public function ShowLoginForm(Request $request){
        return view('auth.login');
    }

    public function Logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session() ->regenerateToken();
        return redirect()->name('login');
    }
    public function Login(Request $request)
    {
    try {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect(route('welcome'))->with('success', 'Login successful');
        } else {
            // Login failed
            return redirect(route('login'))->withErrors(['login' => 'Login failed, credentials not found. Please try again!']);
        }
    } catch (\Exception $e) {
        // Handle exception and dump the message
        dump($e->getMessage());
    }
}
}
