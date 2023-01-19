<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailDemo;
use App\Models\ResetCodePassword;
use App\Mail\SendCodeResetPassword;

class ForgotPasswordController extends BaseController
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        // Delete all old code that user send before.
        ResetCodePassword::where('email', $request->email)->delete();

        // Generate random code
        $data['code'] = mt_rand(1000, 9999);
		$remember_token = rand(9999999999,1111111111);

        // Create a new code
        $codeData = ResetCodePassword::create($data);

        // Send email to user
        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));

       // return response(['message' => trans('passwords.sent')], 200);

       // $success['success'] = true;
		$success['token'] = $remember_token;
            return $this->sendResponse($success, 'Email Reset code has been sent your email.');

    }

    public function passwordReset(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        // find user's email 
        $user = User::firstWhere('email', $passwordReset->email);

        // update user password
        $user->update($request->only('password'));

        // delete current code 
        $passwordReset->delete();

        return response(['message' =>'password has been successfully reset'], 200);
    }
	
	
	// Reset code verify 
	
	public function otpVerify(Request $request)
        {
            $inputData =   $request->all();

            if(empty($inputData )){
                return $this->sendError('Invalid Request.',$inputData); 
            }

            $validator = Validator::make($inputData, [
            //'email' => 'required|email',
            'otp' => 'required'
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors()); 
            }

            $user = ResetCodePassword::where('email',$request->get('email'))->where('code',$request->get('otp'))->first();
    		if(!empty($user)) {
    			$success['token'] =  $user->remember_token;
               // $success['user_id'] =  $user->id;		
               // $success['last_name'] =  $user->last_name;
               // $success['gender'] =  $user->gender;
               // $success['dob'] =  $user->dob;
				//$success['email'] =  $user->email;
              //  $success['mobile_no'] =  $user->mobile_no;
				//$success['user_id'] =  $user->id;				
    			return $this->sendResponse($success,'OTP code verified successfully.');
    		}
    		else{
    			return $this->sendError('Unauthorised.', ['error'=>'OTP did not match. ']);
    		} 
            
        }
	
	
	
	
}