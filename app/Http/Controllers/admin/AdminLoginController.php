<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailDemo;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\admin\Storage;



class AdminLoginController extends Controller
{
    
	public function index()
	{
		return view('admin.login');
	}


	public function authenticate(Request $request)
	 {
		$validator =  Validator::make($request->all(),[
			'email' => 'required|email',
			'password' => 'required'
		]);

        
		if($validator->passes() ){
			//Now authenticate the admin
			if(Auth::guard('admin')->attempt( ['email' => $request->email, 'password' => $request->password] ,$request->get('remember')) ){
				$otp = rand(1000,9999);			
				$user = Auth::guard('admin')->user();
				$user->otp = $otp;
				$user->save();
				
				if($user->role =='admin'){
			//Send email to user for OTP
					$email = $request->email;

					$mailData = [
						'title' => 'Account OTP Verification',
						'otp' => $otp
						
					];       
			      $mail = Mail::to($email)
			      			//->bcc(['pawan@flynaut.com','agst.vinay@gmail.com'])
			      			->send(new EmailDemo($mailData));			
			//send email to user for OTP
			       request()->session()->flash('success','We have sent an OTP on your registered email ID, Please check and verify your identity.');
			     // $request->session->flash('success','We have sent OTP on your registered email ');
					return redirect()->route('admin.otp');

				} else {
					//logout and sessionand send on  login page
					Auth::guard('admin')->logout();
					request()->session()->flash('error','Either email/password incorrect');
					return redirect()->route('admin.login');
				}
			} else {
			        request()->session()->flash('error', 'Either email/password incorrect');
					return redirect()->route('admin.login');
			}
					
		}
		else{
				//redirect with errors
			return back()->withInput($request->only('email'))->withErrors($validator);
		}
	}


	public function otpCode(){

		return view('admin.otp');
	}

    


	public function otpVerify(Request $request)
	{
		$user = Auth::guard('admin')->user();
		$db_otp = $user['otp'];
		$user_otp = $request->otp;

		if($db_otp == $user_otp) {
			//echo "verified";
			return redirect()->route('admin.dashboard');
		}
		else{
			return back()->with('fail','Please enter Correct OTP!');
		} 
	}



		public function resend()
		    {
		        $otp = rand(1000,9999);			
				$user = Auth::guard('admin')->user();
				$user->otp = $otp;
				$user->save();
				
				if($user->role =='admin'){
			//Send email to user for OTP
					$email = 'info@albumer.com';

					$mailData = [
						'title' => 'Account OTP Verification',
						'otp' => $otp
						
					];       
			      $mail = Mail::to($email)
			      		//	->bcc(['pawan@flynaut.com','agst.vinay@gmail.com'])
			      			->send(new EmailDemo($mailData));			
			//send email to user for OTP
			       request()->session()->flash('success','We have resent an OTP on your registered email ID, Please check again and verify your identity.');
			     // $request->session->flash('success','We have sent OTP on your registered email ');
					return redirect()->route('admin.otp');

				} else {
					//logout and sessionand send on  login page
					Auth::guard('admin')->logout();
					request()->session()->flash('error','Either email/password incorrect');
					return redirect()->route('admin.login');
				}
		    }




	public function logout(){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logout successfully');
        return redirect()->route('admin.login');
    }


public function dashboard(){

	 $profile = Auth::guard('admin')->user();
     return view('admin.dashboard',compact('profile'));
	}


	public function profile()
	{
     	 $profile = Auth::guard('admin')->user();
     	return view('admin.profile',compact('profile'));		
	}

	public function profileUpdate(Request $request,$id)
	{
        $user=User::findOrFail($id);
        $data=$request->all();
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Profile information updated successfully. ');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }
        return redirect()->back();
    }


	public function socialProfileUpdate(Request $request,$id)
		{
	        $user=User::findOrFail($id);
	        $data=$request->all();

	       // echo "<pre>";
	        //print_r($data);
	       //die;

	        $status=$user->fill($data)->save();
	        if($status){
	            request()->session()->flash('success','Social Profile  updated successfully. ');
	        }
	        else{
	            request()->session()->flash('error','Please try again!');
	        }
	        return redirect()->back();
	    }

     
     public function changPasswordStore(Request $request)
	    {
	        $request->validate([
	            'new_password' => ['required'],
	        ]);
	   
	        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
	        request()->session()->flash('success','Password updated successfully. ');

	   		 return redirect()->back();
	    }


 /*   public function upload(Request $request)
    {
        if($request->hasFile('image'))
        {
            $filename = $request->image->getClientOriginalName();
          
            $request->image->storeAs('storage/images',$filename,'public');
            Auth()->user()->update(['image'=>$filename]);
        }
        	request()->session()->flash('success','Profile image updated  successfully. ');
        	return redirect()->back();
    }*/
    
    public function upload(Request $request)
    {
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images',$filename,'public');
            Auth()->user()->update(['image'=>$filename]);
        }
        request()->session()->flash('success','Profile image updated  successfully. ');
        return redirect()->back();
    }





}



