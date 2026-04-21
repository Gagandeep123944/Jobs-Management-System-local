<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function login(){
        return view('login.login');
    }

    public function loginsave(Request $request){

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            
            if(Auth::attempt(['email' => $request->email , 'password' => $request->password])){
                $request->session()->regenerate();
			    return redirect()->intended('dashboard');
            }

            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        
    }

    public function signup(){
        return view('login.signup');
    }

    public function signsave(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'mobile_no' => 'required|numeric|digits:10',
            'password' => [
                'required',
                'min:6',
                'regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-zA-Z]).+$/',
            ],
            'c_password' => 'required|same:password',
        ], [ 
            'password.regex' => 'The password must be alphanumeric with at least one uppercase letter and one number.',
            'c_password.required' => 'Confirm Password is required.',
            'c_password.same' => 'The password confirmation does not match the password.',
			'email.unique' => 'The email address has already been taken.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

		$user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;
        $user->password = $request->password;
        $saveResult = $user->save();

		if ($saveResult) {
			$request->session()->flash('success', 'Successfully signed up! Now, you can login.');

			return response()->json(['status' => 'success','message' => 'Successfully signed up! Now, you can login.']);
		} else {
			return response()->json(['status' => 'error','message' => 'An error occurred while saving your data. Please try again later.'], 500);
		}
    }

    public function forgotPassword(){
        return view('login.forgot');
    }

    public function sendmail(Request $request){

        $request->validate([
           'email' => 'required|email:rfc,dns',
        ]); 
		
		$data = $request->input();
        $email = $data['email'];
        
        $user_exists = User::where('email', $email)->first();
        
        if ($user_exists) {
            $status = Password::sendResetLink($request->only('email'));
            // return $status;
            if ($status === Password::RESET_LINK_SENT) {
				return "true";
                // return redirect('forget/password')->with('success', 'Password reset email sent successfully. Please check your email.');
            } else {
				return "false";
                // return redirect('forget/password')->with('fail', 'Something went wrong!!. Please try after some time.');
            } 
        } else {
            return "no user";
            // return redirect('forget/password')->with('fail', "No User Found With $email");
        }
      
    }


    public function showResetForm(Request $request, $token){
        return view('login.passwordreset')->with(
                ['token' => $token, 'email' => $request->email]
            );
    }

    public function resetPassword(Request $request){
         $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => [
                'required',
                'min:6',
                'regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-zA-Z]).+$/',
            ],
            'c_password' => 'required|same:password',
        ], [ 
            'password.regex' => 'The password must be alphanumeric with at least one uppercase letter and one number.',
            'c_password.required' => 'Confirm Password is required.',
            'c_password.same' => 'The password confirmation does not match the password.'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user_exists = User::where('email', $request->email)->first();

        if($user_exists){
            echo "yes its exists";
        }
        die();


        
    }

    public function dashboard(){
        return view('dashboard');
    }
}
