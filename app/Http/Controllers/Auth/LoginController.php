<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:lecturer')->except('logout');
    }
    public function showAdminLoginForm() {
        return view('auth.login', ['url' => 'admin']);
    }
    public function adminLogin(Request $request) {
        // validate form data
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
        // attempt to log user in 
        if (Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->get('remember'))) {
            // successful, redirect to home page
            return redirect()->intended('/admin');
            // return view('admin.index');
        }
        // unsuccessful, redirect to form, with data
        return redirect()->back()->withInput($request->only('email','remember'));
    }
    public function showLecturerLoginForm() {
        return view('auth.login', ['url' => 'lecturer']);
    }
    public function lecturerLogin(Request $request) {
        // validate form data
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
        // attempt to log user in 
        if (Auth::guard('lecturer')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->get('remember'))) {
            // successful, redirect to home page
            return redirect()->intended('/lecturer');
            // return view('admin.index');
        }
        // unsuccessful, redirect to form, with data
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
