<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
    protected $redirectTo = '/beranda';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        $user = User::where($this->username(), $credentials[$this->username()])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password) || $user->is_active !== 'true') {
            return false;
        }

        if ($user->is_active !== 'true') {
            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request, 'Your account is inactive. Please contact support for assistance.');
        }

        return $this->guard()->attempt(
            $credentials,
            $request->filled('remember')
        );
    }

    protected function sendFailedLoginResponse(Request $request, $message = 'These credentials do not match our records.')
    {
        $user = User::where($this->username(), $request->{$this->username()})->first();

        if ($user && $user->is_active == 'false') {
            $message = 'Your account is inactive. Please contact support for assistance.';
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                'status' => [$message],
            ]);
    }

    protected function redirectTo()
    {
        return '/beranda';
    }
}
