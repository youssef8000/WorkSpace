<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use App\Models\User;

class AuthController extends Controller
{
    public function showChangePlanForm()
    {
        return view('frontend.plan.change_plan');
    }
 
    public function updatePlan(Request $request)
    {
        $user = Auth::user();
        $newPlan = $request->input('plan');
        $user->plan = $newPlan;
        $user->save();

        return redirect('/Profile')->with('success', 'Plan updated successfully');
    }
    function index()
    {
        return view('auth.login');
    }
    function registration()
    {
        return view('auth.register');
    }
    function registration_client()
    {
        return view('auth.register_client');
    }
    function registration_freelancer()
    {
        return view('auth.register_freelancer');
    }
    function registration_client_plan()
    {
        return view('auth.register_client_plan');
    }
    function registration_freelancer_plan()
    {
        return view('auth.register_freelancer_plan');
    }
    function validate_registration_client(Request $request)
    {
        $request->validate([
            'name'         =>   'required',
            'username'         =>   'required',
            'type'    =>   'required',
            'email'        =>   'required|email|unique:users',
            'password'     =>   'required|min:6',
            'phone'        =>   'required',
            'gender'        =>   'required',
            'plan'        =>   'required',
        ]);

        $data = $request->all();

        User::create([
            'name'  =>  $data['name'],
            'username' =>  $data['username'],
            'email' =>  $data['email'],
            'type' =>  $data['type'],
            'password' => Hash::make($data['password']),
            'phone' =>  $data['phone'],
            'gender' =>  $data['gender'],
            'plan' =>  $data['plan'],
            'portfolio' =>  null,
            'skills' =>  null

        ]);

        return redirect('home')->with('success', 'Registration Completed, now you can login');
    }
    function validate_registration_freelancer(Request $request)
    {
        $request->validate([
            'name'         =>   'required',
            'username'         =>   'required',
            'type'    =>   'required',
            'email'        =>   'required|email|unique:users',
            'password'     =>   'required|min:6',
            'phone'        =>   'required',
            'gender'        =>   'required',
            'plan'        =>   'required',
            'portfolio' =>  'required',
            'skills' =>  'required',
        ]);

        $data = $request->all();

        User::create([
            'name'  =>  $data['name'],
            'username' =>  $data['username'],
            'email' =>  $data['email'],
            'type' =>  $data['type'],
            'password' => Hash::make($data['password']),
            'phone' =>  $data['phone'],
            'gender' =>  $data['gender'],
            'plan' =>  $data['plan'],
            'portfolio' =>  $data['portfolio'],
            'skills' =>  $data['skills'],

        ]);

        return redirect('home')->with('success', 'Registration Completed, now you can login');
    }
    function validate_login(Request $request)
    {
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            return redirect('home');
        }

        return redirect('login')->with('success', 'Login details are not valid');
    }

    function dashboard()
    {
        if(Auth::check())
        {
            return view("frontend.welcome");
        }

        return redirect('home')->with('success', 'you are not allowed to access');
    }

    function logout()
    {
        Session::flush();

        Auth::logout();

        return Redirect('home');
    }

}
