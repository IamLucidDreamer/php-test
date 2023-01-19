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
use Illuminate\Support\Facades\Hash;
use DB;
use File;
use Illuminate\Support\Facades\Storage;

class RegisterController extends BaseController

{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'input' => 'required', 
        ]);
    

    if($validator->fails())
    {
            $message = []; 
            foreach($validator->errors()->getMessages() as $keys=>$vals){   
                foreach($vals as $k=>$v){
                    $message[] =  $v;
                }
            }
            return response()->json([
                'success' => false,
                'message' => $message[0]
                ]);
    }

   

            //   $otp = rand(9999,1111); 
            $otp = 1234;

            $mailData = [
                'title' => 'New regiatration OTP',
                'otp' => $otp   
            ];

      if(is_int($request->input)){
        
        //check mobile exist or not   
        $check_user = User::where('contact',(string)$request->input)->first();
        // print_r($check_user);exit;
        if(isset($check_user)){
            return response()->json([
                'success' => false,
                'message' => "Your Mobile Number Already Exist.",
            ]);

        }

        $user =new User;
        $user->contact = $request->input;
        $user->otp =$otp; 
        $user->save();
  
        return response()->json([
          'success' => true,
          'message' => "otp Send Successfully.",
      ]);

      }
      else{

        $check_user = User::where('email',$request->input)->first();
            if(isset($check_user)){
                return response()->json([
                    'success' => false,
                    'message' => "Email Already Exist.",
                ]);
            }
            $user_email = $request->input;

            //  $message='Your registration OTP is'.$otp;
               
            $user =new User;
            $user->email = $request->input;

            // Mail::raw($message, function ($message) use($user_email){
            //     $message->from('cyclertrek@gmail.com', 'Cycle Trek');
            //     $message->to($user_email);
            //     $message->subject('Cycle Trek Registration Otp');
            // });
            $message='';
              $message .='<br> Thank you for signing up for CycleTrack and welcome to the community! <br><br>';
                $message .='To get started, we recommend checking out our guide that’ll walk you through the basics ,step-by-step. <br><br>';
                $message .='And if you’re ready to start you can log in below!<br><br>';
                $message .='Regards<br><br>';
                $message .='Team CycleTrack<br><br>';
                
                
            $this->EmailSend($user_email,$message);

            $user->otp =$otp; 
            $user->save();
      
            return response()->json([
              'success' => true,
              'message' => "otp Send Successfully.",
          ]);
          
      }

   
    //   $token =  $user->createToken('MyApp')->plainTextToken;
    //   $user->remember_token = $token;
     
 

        // exit;
        // $input = $requestData; 
        // $otp = rand(9999,1111); 
        // $remember_token = rand(9999999999,1111111111);
        // $input['remember_token'] = $remember_token; 
        // $input['otp'] = $otp; 

        // $user = User::insertGetId($input);

        // if($user){
        //         $email = $request->email; 
		    
		// 	$mailData = [
        //                 'title' => 'New regiatration OTP',
        //                 'otp' => $otp   
        //             ]; 
        //         $mail = Mail::to($email)
        //                 ->bcc(['pawan@flynaut.com'])
        //                 ->send(new EmailDemo($mailData));
        // }
        
        // $success['token'] = $remember_token;
          
        // return $this->sendResponse($success, 'User registered successfully.');
    }



      public function setPassword(Request $request)
        {
            $validator = Validator::make($request->all(),[
                'input' => 'required',
                'password'  => 'required'  
            ]);
        
    
            if($validator->fails())
            {
                    $message = []; 
                    foreach($validator->errors()->getMessages() as $keys=>$vals){   
                        foreach($vals as $k=>$v){
                            $message[] =  $v;
                        }
                    }
                    return response()->json([
                        'success' => false,
                        'message' => $message[0]
                        ]);
            }


            if(is_int($request->input)){

                $user = User::where('contact',$request->input)->first();

            }else{
                $user = User::where('email',$request->input)->first();
            }


                $insertData = array();
                $insertData['password'] = bcrypt($request->get('password'));
                $passwordnew = bcrypt($request->get('password'));

                //$insertData  =   bcrypt($insertData['password']);     

                // $user = User::where('email',$request->post('email'))->first();

                if(!empty($user)){
                    
                    $user->password = $passwordnew;
                    $user->save();
                    
                    // $update = User::where('email',$request->post('email'))->update($insertData);
                    $success['token'] = $user->remember_token;          
                    return $this->sendResponse($success, 'Password created successfully.');

                }else{
                    return $this->sendError('User Not exist.', ['error'=>'User Not exist']);
                }
        }


   /* public function register2(Request $request)
    {
      
        $inputData =   $request->all();
 
        if(empty($inputData)){
            return $this->sendError('Invalid Request.',$inputData); 
        }

         $validator = Validator::make($inputData, [
            'token' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'contact' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()); 
        }  

        $checkUser = User::where('remember_token',$inputData['token'])->first();
             if(empty($checkUser)){
                return $this->sendError('Unauthorised.', ['error'=>'Invalid token']);
             }

             $insertData = array();
             //$insertData['user_id'] = $checkUser->id;
             $insertData['first_name'] = $request->get('first_name');
             $insertData['last_name'] = $request->get('last_name'); 
             $insertData['gender'] = $request->get('gender'); 
             $insertData['dob'] = $request->get('dob'); 
             $insertData['contact'] = $request->get('contact'); 
		
		     $files = $request->file('image');
		
			if(!empty($files)){
				$uploadFolder = 'album';
				$imageName1 = time() . '.' . $files->extension(); 
				$files->move(public_path('album'), $imageName1);
			}
		
		  $insertData['image'] = $imageName1;

            $profile_id = DB::table('users')->update($insertData);
		
	//	$profile_id = User::where('email',$request->post email'))->update($inputData);
     
                    if(!empty($profile_id)){              
                        $success['token'] = $inputData['token'];          
                        return $this->sendResponse($success, 'User profile updated successfully.');
                    }else{
                          return $this->sendError('Unauthorised.', ['error'=>'Something went wrong']);
                    }


    }*/
   
    public function login(Request $request){
            
                        // echo 'hello';exit;

                        $validator = Validator::make($request->all(),[
                            'input' => 'required', 
                            'password' => 'required', 
                        ]);
                    
                
                    if($validator->fails())
                    {
                            $message = []; 
                            foreach($validator->errors()->getMessages() as $keys=>$vals){   
                                foreach($vals as $k=>$v){
                                    $message[] =  $v;
                                }
                            }
                            return response()->json([
                                'success' => false,
                                'message' => $message[0],
                                'data'=>[]
                                ]);
                    }
                        


            if(is_int($request->input)){

               $user = User::where('contact',(string)$request->input)->first();

            }else{
                $user = User::where('email',$request->input)->first();

            }
              

            if(isset($user)){ 

                if (Hash::check($request->password,$user->password)) {
                   

                    $token =  $user->createToken('MyApp')->plainTextToken;
                    $user->remember_token = $token ;
                    $user->save();

                    $user->token = $token;
                    return response()->json([
                        'success' => true,
                        'message' => "Login Successfully.",
                        'data' => $user,
                    ]);

                }else{

                    return response()->json([
                        'success' => false,
                        'message' => "Password Not Match.",
                        'data' => [],
                    ]);

                }

            }else{
                return response()->json([
                    'success' => false,
                    'message' => "User not found.",
                    'data' => [],
                ]);

            }
    
        }
        
        public function otpVerify(Request $request)
        {
            
            $validator = Validator::make($request->all(), [
            'input' => 'required',
            'otp' => 'required'
            ]);

            
    if($validator->fails())
    {
            $message = []; 
            foreach($validator->errors()->getMessages() as $keys=>$vals){   
                foreach($vals as $k=>$v){
                    $message[] =  $v;
                }
            }
            return response()->json([
                'success' => false,
                'message' => $message[0],
                'data' => []
                ]);
    }

            if(is_int($request->input)){
               
                $user = User::where('contact',(string)$request->input)->where('otp',$request->otp)->first();

            }else{
                $user = User::where('email',$request->input)->where('otp',$request->otp)->first();
            }

            
    		if(!empty($user)) {
                $token =  $user->createToken('MyApp')->plainTextToken;
                $user->remember_token = $token;
                $user->otp ='';
                $user->save();
                $user->token = $token;

                return response()->json([
                    'success' => true,
                    'message' => "OTP code verified successfully.",
                    'data' => $user,
                ]);
    	
    		}
    		else{
                return response()->json([
                    'success' => false,
                    'message' => "OTP did not match.",
                    'data' => [],
                ]);
    		} 
            
        }
        
        
        public function resendOTP(Request $request)
        {
                        $validator = Validator::make($request->all(),[
                            'input' => 'required', 
                        ]);
                    
                
                    if($validator->fails())
                    {
                            $message = []; 
                            foreach($validator->errors()->getMessages() as $keys=>$vals){   
                                foreach($vals as $k=>$v){
                                    $message[] =  $v;
                                }
                            }
                            return response()->json([
                                'success' => false,
                                'message' => $message[0]
                                ]);
                    }

                if(is_int($request->input)){

                $user = User::where('contact',(string)$request->input)->first();

                }else{
                    $user = User::where('email',$request->input)->first();

                }
                // $otp = rand(1111,9999);
                $otp=1234;

                if(isset($user)){

                    $user->otp = 1234;
                    $user->save();

                    return response()->json([
                        'success' => true,
                        'message' => 'Otp Send Successfully.',

                        ]);

                }else{

                    return response()->json([
                        'success' => false,
                        'message' => 'User Not exist',

                        ]);
                }
            
        //     $user = User::where('remember_token',$request->get('token'))->first();
        //     if(!empty($user)) {
        //         User::where('remember_token',$request->get('token'))->update(['otp'=>$otp]);
    	// 	    $email = $user->email ; 
    	// 		$mailData = [
    	// 			'title' => 'Resend OTP',
    	// 			'otp' => $otp	
    	// 		]; 
    	// 	$mail = Mail::to($email)
        //   			->bcc(['pawan@flynaut.com','agst.vinay@gmail.com'])
        //   			->send(new EmailDemo($mailData));	
        //         $success['token'] =  $user->remember_token; 
        //      return $this->sendResponse($success, 'OTP code resent successfully.');   
         
        // }else{
        //     return $this->sendError('Unauthorised.', ['error'=>'Invalid Token']);
        // }

    }
        
        
     public function logout() 
        {
            auth()->user()->token()->delete();
            return $this->sendResponse('Logout successfully.');
        }



   public function profile()
	{
     	 $profile = Auth::guard('admin')->user();
     	return view('admin.profile',compact('profile'));		
	}

    public function forgotPassword(Request $request){

                    $validator = Validator::make($request->all(),[
                        'input' => 'required', 
                    ]);

                    if($validator->fails())
                    {
                            $message = []; 
                            foreach($validator->errors()->getMessages() as $keys=>$vals){   
                                foreach($vals as $k=>$v){
                                    $message[] =  $v;
                                }
                            }
                                return response()->json([
                                    'success' => false,
                                    'message' => $message[0],
                                    ]);
                    }
                        


                if(is_int($request->input)){

                $user = User::where('contact',(string)$request->input)->first();

                }else{

                  $user = User::where('email',$request->input)->first();

                }


                if(isset($user)){   
                    //   $otp = rand(9999,1111); 
                    $otp = 1234;
                    //   $token =  $user->createToken('MyApp')->plainTextToken;
                    //   $user->remember_token = $token;
                    $user->otp =$otp; 
                    $user->save();

                    return response()->json([
                        'success' => true,
                        'message' => "otp Send Successfully.",
                    ]);


                }else{

                    return response()->json([
                        'success' => false,
                        'message' => 'User Not Exist.',
                        ]);

                }
                            
        }

    


        //email send function 

        public function EmailSend($email="",$message ="",$subject=""){
             
            
                ini_set("sendmail_from", "cyclertrek@gmail.com");
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From:cyclertrek@gmail.com'."\r\n".'Reply-To:cyclertrek@gmail.com'."\r\n" .'X-Mailer: PHP/' . phpversion();
                
                     $sendMail= mail($email, "CYCLERTRACK", $message, $headers);

                        if($sendMail)
                        {
                        $message_data ="Success";
                        }
                        else

                        {
                            $message_data ="Error";
                        }

                return $message_data;

            //     Mail::raw($message, function ($message) {
            //         $message->from('cyclertrek@gmail.com', 'Cycle Trek');
            //         $message->to('vikas@flynaut.com');
            //         $message->subject('Learning Laravel test email');
            //     });

            //     if (Mail::failures()){
            //         // return response showing failed emails
            //       $message_body = "error";
            //     }else{
            //         $message_body = "success";
            //     }

            // return $message_body;

        }

        /*else{
              return $this->sendError('Unauthorised.', ['error'=>'Invalid Token']);
        }
*/
      

}