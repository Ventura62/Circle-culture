<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    protected function authenticated(Request $request, $user)
    {
        if(auth()->user()->type == "admin"){

            return redirect()->to('/dashboard');
        }else {
            // Check if answers exist in session
//            $answers = Session::get('answers');
//
//            if ($answers) {
//                Submission::updateOrCreate(
//                    [
//                        'user_id'        => auth()->user()->id,
//                    ],[
//                        'answers_arr'   => $answers
//                    ]);
//
//                Session::forget('answers');
//
//                $user->has_submitted = 1;
//                $user->save();
//            }

            return redirect()->route('group');

        }
    }
}
