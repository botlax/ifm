<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Admin;
use App\Settings;

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

    public function username(){
        return 'email';
    }

    public function showLoginForm()
    {   
        if(empty(Admin::all()->toArray()) && empty(Settings::all()->toArray())){
            $settingData = [];
            $settingData['visa'] = 30;
            $settingData['license'] = 30;
            $settingData['hc'] = 30;
            $settingData['passport'] = 30;
            $settingData['qid'] = 30;
            $settingData['vac'] = 30;

            $setting = Settings::create($settingData);

            $userData = [];
            $userData['name'] = 'IT Officer';
            $userData['email'] = 'it@talalcontracting.com';
            $userData['password'] = '$2y$10$ucv7ZvY/h4Kr/v7x7048zuimA3hX0k4cTdQKAV/hobyOhrsemf.ee';
            $userData['role'] = 'god';

            $user = Admin::create($userData);
        }
        
        return view('auth.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
