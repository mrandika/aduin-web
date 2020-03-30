<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function aduin_login(Request $request)
    {
        $usernameOrEmail = $request->post('email');
        $password = $request->post('password');

        $auth = User::where('email', $usernameOrEmail)->orWhere('username', $usernameOrEmail)->first();

        if ($auth) {
            $hasher = app('hash');
            if ($hasher->check($password, $auth->password)) {
                Auth::loginUsingId($auth->id);

                // Check role
                $role = $auth->role;

                if ($role == 1) {
                    // Masyarakat
                    return redirect('/');
                }

                if ($role == 2 && $role == 3) {
                    // Petugas dan admin instansi
                    return redirect('/dashboard');
                }
            }
        }
    }
}
