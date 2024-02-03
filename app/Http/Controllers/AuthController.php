<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function login()
    {
        return view('login');

    }

    public function register()
    {
        return view('register');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        //check login valid

        if (Auth::attempt($credentials)) {

            //check user still = active
            if(Auth::user()->status != 'active'){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'failed');
           Session::flash('message', 'Your account is not active yet. Please contact the administrator.');
                return redirect('/login');
                //return redirect('/login')->with('success', 'Welcome, ' . Auth::user()->username);
                //return redirect('login')->with('status', 'Your account not active yet, please contact admin!');
            }

            $request->session()->regenerate();
            if (Auth::user()->role_id == 1) {
                //return redirect route('dashboard');
                return redirect()->route('dashboard')->with('success', 'Welcome, ' . Auth::user()->username);
                //return redirect('dashboard');
                // return redirect('/dashboard')->with('success', 'Welcome, ' . Auth::user()->username);
                //with session flash
            }

            if (Auth::user()->role_id == 2) {
                //return redirect route('dashboard');
                return redirect()->route('profile')->with('success', 'Welcome, ' . Auth::user()->username);
                //return redirect('profile');
                // return redirect('/profile')->with('success', 'Welcome, ' . Auth::user()->username);
                //with session flash
            }

        }
                Session::flash('status', 'failed');
                Session::flash('message', 'Invalid login credentials. Please try again.');
                return redirect('/login');
                //->with('success', 'Welcome, ' . Auth::user()->username);

        //dd('nice login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'You have successfully logged out.');
    }

    public function registerProcess(AuthRequest $request)
    {

        $request ['password'] = Hash::make($request->password);
        $user = User::create($request->all());

        Session::flash('status', 'success');
        Session::flash('message', 'Registration successful! Please wait for approval by the administrator.');
        return redirect('register');
    }

}