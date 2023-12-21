<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $this->validate($request, [
            'nip'   => 'required',
            'password' => 'required|min:6'
        ]);

        if (auth()->attempt(['nip_dosen' => $request->nip, 'password' => $request->password], $request->get('remember'))) {
            if (auth()->user()->status == 1 || auth()->user()->status == 0) {
                return redirect()->route('jurusan.home')->with('success', 'Sign In Success!');
            }else if(auth()->user()->status == 2){
                return redirect()->route('gkm.home')->with('success', 'Sign In Success!');
            }else if(auth()->user()->status == 3){ 
                return redirect()->route('dosen.home')->with('success', 'Sign In Success!');
            }
        }
        return back()->withInput($request->only('nip', 'remember'));
    }
}
