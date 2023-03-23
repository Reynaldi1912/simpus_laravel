<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    public function login(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'id' => 'required',
            'password' => 'required',
        ]);
  
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'id';
        if(auth()->attempt(array($fieldType => $input['id'], 'password' => $input['password'])))
        {
            if ( Auth::user()->role === 'admin'){
                return redirect()->route('home')->with('success','Login Berhasil , Selamat Datang '.Auth::user()->nama_lengkap);
            }else{
                $request->session()->flush();
                return redirect()->route('login')->with('error','Halaman ini khusus untuk admin');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email Atau Password Salah');
        }
          
    }
}
