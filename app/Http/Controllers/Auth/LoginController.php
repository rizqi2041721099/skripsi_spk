<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function authenticated(Request $request, mixed $user)
    {
        if ($user->hasRole(['ADMIN', 'USER'])) {
            return redirect()->route('home');
        }
        return $next($request);
    }

    public function __construct()
    {
    //    dd(auth()->user());
        $this->middleware('guest')->except('logout');
    }

    protected function loggedOut(Request $request) {
         return Redirect::to('/');
    }

    public function username()
    {
        return 'name';
    }
}
