<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $page = 'dashboard';
        return view('home',compact('page'));
    }

    public function profile()
    {
        $page = 'profile';
        $data = User::where('id',auth()->user()->id)->first();
        return view('pages.profile.index', compact('page','data'));
    }
}
