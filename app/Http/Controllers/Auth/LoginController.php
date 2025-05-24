<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 

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
    
    //  protected $redirectTo = '/home';
    protected function redirectTo()
    {
        if (auth()->user()->isAdmin('admin')) {
            return '/admin';
        }
        return '/user/dashboard';
    }

    protected function attemptLogin(Request $request)
    {
        Log::info('Login attempt', ['email' => $request->email]);
        $attempt = $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
        Log::info('Login result', ['success' => $attempt]);
        return $attempt;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
