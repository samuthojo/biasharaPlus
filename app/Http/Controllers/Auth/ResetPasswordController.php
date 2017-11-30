<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/change_password';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
        $this->middleware('auth');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('change_password');
    }

    public function reset(Request $request)
    {

        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        $user = Auth::user();
        $username = $user->username;
        $password = $request->current_password;
        if(Auth::attempt()) {
          $this->resetPassword($user, $request->password);
        }
        else {
          return $this->sendResetFailedResponse($request);
        }

        return $this->sendResetResponse($request);
    }

    protected function rules() {

      return [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ];
    }

    protected function validationErrorMessages()
    {
        return [
          'password.required' => 'The new password field is required',
        ];
    }

    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
    }

    protected function sendResetResponse($response)
    {
        return redirect($this->redirectPath())
                            ->with('message', 'Password reset successfully');
    }

    protected function sendResetFailedResponse(Request $request)
    {
        return redirect()->back()
                    ->withInput($request->only('current_password'))
                    ->withErrors(['errors' => 'The current password entered is incorrect', ]);
    }

}
