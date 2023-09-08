<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $user = User::where('id', $id)->first();
        return view('profile', ['data' => $user]);
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $checkUser = User::where('status', '1')->where('id', '!=', $id)->get();
        $emailArr = array_column($checkUser->toArray(), 'email');
        if (in_array($request->get('email'), $emailArr)) {
            return redirect('profile')->with('error', 'Email already exist');
        } else {
            $user = User::find($id);
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->save();
            return redirect('profile')->with('success', 'User profile updated');
        }
    }
}
