<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Models\Clients;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
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
        return view('auth.signup');
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
        return view('auth.forgot');
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
				return response()->json([
                    'success' => true,
                    'message' => 'If this email exists, a reset link has been sent.'
                ]);
            } 
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ]);
        }
      
    }


    public function showResetForm(Request $request, $token){
        return view('auth.passwordreset')->with(
                ['token' => $token, 'email' => $request->email]
            );
    }



    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'min:6',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).+$/',
            ],
            'password_confirmation' => 'required|same:password'
        ], [
            'password_confirmation.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'password_confirmation.required' => 'Confirm Password is required.',
            'password_confirmation.same' => 'Password confirmation does not match.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successful']);
        }

        return response()->json(['error' => __($status)], 400);
    }


    public function logout(Request $request){
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        return redirect()->route('login'); 
    }

    public function dashboard(){
        return view('dashboard.dashboard');
    }

    public function get_client(){

       $clients = \App\Models\Clients::paginate(10);

       return Inertia::render('Clients',[
        'clients' => $clients
       ]);
    }
}
