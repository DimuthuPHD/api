<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected $redirectTo = '/';

    protected $loginRoute;

    public function __construct()
    {
        $this->middleware('guest:web')->except('logOut');
        $this->loginRoute = route('loginView');
    }
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    protected function logOut(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

        return redirect()->guest($this->loginRoute);
    }
}
