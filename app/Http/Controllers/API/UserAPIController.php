<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Interest;
use App\Models\Challenge;
use App\Models\Event;
use App\Models\UserInterest;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailDemo;
use App\Models\ResetCodePassword;
use DB;
use File;
use Illuminate\Support\Facades\Storage;
 

class UserAPIController extends BaseController

{

    public function getSubscriptionList(Request $request)
    {       
        $packageList = DB::table("packages")->get();
        if(!empty($packageList)){
            
        return $this->sendResponse($packageList, 'Subscriptionlist');

        }else{
              return $this->sendError('Unauthorised.', ['error'=>'Invalid Token']);
        }
    }

    public function getOccassionsList(Request $request)
    {       
        $packageList = DB::table("occassions")->get();
        if(!empty($packageList)){
            
        return $this->sendResponse($packageList, 'occassionsList');

        }else{
              return $this->sendError('Unauthorised.', ['error'=>'Invalid Token']);
        }
    } 


    public function getUserSubscription(Request $request)
    {      
        $inputData =   $request->all();
        if(empty($inputData)){
            return $this->sendError('Invalid Request.',$inputData); 
        }
         $validator = Validator::make($inputData, [           
            'token' => 'required'           
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()); 
        }
      
        $packageList = User::select("packages.*")->join('packages', 'packages.id', '=', 'users.package_id')->where('remember_token',$inputData['token'])->first();
        if(!empty($packageList)){
            
        return $this->sendResponse($packageList, 'UserSubscription');

        }else{
              return $this->sendError('Unauthorised.', ['error'=>'Invalid Subscription']);
        }
    }

    public function updateUserSubscription(Request $request)
    {      
        $inputData =   $request->all();
        if(empty($inputData)){
            return $this->sendError('Invalid Request.',$inputData); 
        }
         $validator = Validator::make($inputData, [           
            'token' => 'required',
            'package_id' => 'required',         
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()); 
        }
        $arrUpdate = array();
        $arrUpdate['package_id'] = $inputData['package_id'];
        $packageList = User::where('remember_token',$inputData['token'])->update($arrUpdate);
        if($packageList){            
        $success['success'] = true;          
            return $this->sendResponse($success, 'Subscription has been updated successfully.');

        }else{
              return $this->sendError('Unauthorised.', ['error'=>'Invalid token']);
        }
    }

    public function updateUserNotification(Request $request)
    {      
        $inputData =   $request->all();
        if(empty($inputData)){
            return $this->sendError('Invalid Request.',$inputData); 
        }
         $validator = Validator::make($inputData, [           
            'token' => 'required',
            'promotional_offer_notification' => 'required',
            'msg_notification' => 'required',
            'booking_notification' => 'required',         
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()); 
        }
        $arrUpdate = array();
        $arrUpdate['promotional_offer_notification'] = $inputData['promotional_offer_notification'];
        $arrUpdate['msg_notification'] = $inputData['msg_notification'];
        $arrUpdate['booking_notification'] = $inputData['booking_notification'];

        $packageList = User::where('remember_token',$inputData['token'])->update($arrUpdate);
        if($packageList){            
        $success['success'] = true;          
            return $this->sendResponse($success, 'Notification has been updated successfully.');

        }else{
              return $this->sendError('Unauthorised.', ['error'=>'Invalid token']);
        }
    }


    public function changePassword(Request $request)
    {
           
        $inputData =   $request->all();
        if(empty($inputData)){
            return $this->sendError('Invalid Request.',$inputData); 
        }
         $validator = Validator::make($inputData, [           
            'token' => 'required',
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',         
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors()); 
        }

         $checkUser = User::where('remember_token',$inputData['token'])->first();
         if(empty($checkUser)){
            return $this->sendError('Unauthorised.', ['error'=>'Invalid token']);
         }
        
        try {
            if ((\Hash::check(request('old_password'),$checkUser->password)) == false) {
              return $this->sendError('Unauthorised.', ['error'=>'Check your old password']);


            } else if ((\Hash::check(request('new_password'), $checkUser->password)) == true) {
            
                return $this->sendError('Unauthorised.', ['error'=>'Please enter a password which is not similar then current password.']);

            } else {
                User::where('remember_token', $inputData['token'])->update(['password' => Hash::make($input['new_password'])]);
            
                  $success['success'] = true;          
            return $this->sendResponse($success, 'Password updated successfully.');
            }
        } catch (\Exception $ex) {
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            } else {
                $msg = $ex->getMessage();
            }
           return $this->sendError('Unauthorised.', ['error'=>$msg]);
        }
        
    }



    public function createRack(Request $request)
                {
                     $inputData =   $request->all();
                     $validator = Validator::make($request->all(), 
                      [ 
                        'token' => 'required',
                        'description' => 'required',
                        'location' => 'required',
                        'theft'    => 'required',
                        'saf_rating'   => 'required'
  
                     ]); 

                    if ($validator->fails()) {          
                    return $this->sendError('Validation Error.', $validator->errors());                        
                    }  

                    $checkUser = User::where('remember_token',$inputData['token'])->first();
                     if(empty($checkUser)){
                        return $this->sendError('Unauthorised.', ['error'=>'Invalid token']);
                     }

                       $insertData = array();
                        $insertData['user_id'] = $checkUser->id;
                        $insertData['description'] = $request->get('description');
                        $insertData['location'] = $request->get('location');
                       $insertData['saf_rating'] = $request->get('saf_rating');
                        $insertData['theft'] = $request->get('theft');
                        $rackID= DB::table('racks')->insertGetId($insertData);

                        $files = $request->file('image'); 

                        if(!empty($rackID)){   

                             if(!empty($files)){

                            foreach($files as $postImg){
                                $uploadFolder = 'album';
                                $imageName1 = time() . '.' . $postImg->extension(); 
                                $postImg->move(public_path('album'), $imageName1);

                                $dta = array();
                                $dta['user_id'] = $checkUser->id; 
                                $dta['rack_id'] = $rackID; 
                                $dta['images'] = $imageName1; 
                                DB::table('rack_images')->insertGetId($dta);
                            }
                        }

                            $success['token'] = $inputData['token'];          
                            return $this->sendResponse($success, 'Rack created successfully.');
                        }
                        else
                        {
                          return $this->sendError('Unauthorised.', ['error'=>'Something went wrong']);
                        }
                }


        public function createTrack(Request $request)
                {
                     $inputData =   $request->all();
                     $validator = Validator::make($request->all(), 
                      [ 
                        'token' => 'required',
                        'description' => 'required',
                        'location' => 'required',
                        'track_category'    => 'required',
                        'safety'   => 'required'
  
                     ]); 

                    if ($validator->fails()) {          
                    return $this->sendError('Validation Error.', $validator->errors());                        
                    }  

                    $checkUser = User::where('remember_token',$inputData['token'])->first();
                     if(empty($checkUser)){
                        return $this->sendError('Unauthorised.', ['error'=>'Invalid token']);
                     }

                       $insertData = array();
                        $insertData['user_id'] = $checkUser->id;
                        $insertData['description'] = $request->get('description');
                        $insertData['location'] = $request->get('location');
                       $insertData['track_category'] = $request->get('track_category');
                        $insertData['safety'] = $request->get('safety');
                        $trackID= DB::table('tracks')->insertGetId($insertData);

                        $files = $request->file('image'); 

                        if(!empty($trackID)){   

                             if(!empty($files)){

                            foreach($files as $postImg){
                                $uploadFolder = 'album';
                                $imageName1 = time() . '.' . $postImg->extension(); 
                                $postImg->move(public_path('album'), $imageName1);

                                $dta = array();
                                $dta['user_id'] = $checkUser->id; 
                                $dta['track_id'] = $trackID; 
                                $dta['images'] = $imageName1; 
                                DB::table('track_images')->insertGetId($dta);
                            }
                        }

                            $success['token'] = $inputData['token'];          
                            return $this->sendResponse($success, 'Track created successfully.');
                        }
                        else
                        {
                          return $this->sendError('Unauthorised.', ['error'=>'Something went wrong']);
                        }
                }




            public function createGroup(Request $request)
                {
                     $inputData =   $request->all();
                     $validator = Validator::make($request->all(), 
                      [ 
                        'token' => 'required',
                        'group_name' => 'required',
                        'group_description' => 'required',
                        'image'    => 'required'
                      
  
                     ]); 

                    if ($validator->fails()) {          
                    return $this->sendError('Validation Error.', $validator->errors());                        
                    }  

                    $checkUser = User::where('remember_token',$inputData['token'])->first();
                     if(empty($checkUser)){
                        return $this->sendError('Unauthorised.', ['error'=>'Invalid token']);
                     }

                       $insertData = array();
                        $insertData['created_by'] = $checkUser->id;
                        $insertData['group_description'] = $request->get('group_description');
                        $insertData['group_name'] = $request->get('group_name');
                     
                        $rackID= DB::table('groups')->insertGetId($insertData);

                        $files = $request->file('image'); 

                        $members = $request->file('members'); 

                        /*print_r($members);
                        die;*/

                        if(!empty($rackID)){   

                           if(!empty($files))
                            {
                                foreach($files as $postImg)
                                {
                                    $uploadFolder = 'album';
                                    $imageName1 = time() . '.' . $postImg->extension(); 
                                    $postImg->move(public_path('album'), $imageName1);

                                    $dta = array();
                                    //$dta['user_id'] = $checkUser->id; 
                                   // $dta['group_id']= $rackID;
                                
                                    $dta['image'] = $imageName1; 
                                    DB::table('groups')->insertGetId($dta);
                                }
                             }

                            if(!empty($members))
                                {
                                    foreach($members as $member)
                                    {
                                        /*$uploadFolder = 'album';
                                        $imageName1 = time() . '.' . $postImg->extension(); 
                                        $postImg->move(public_path('album'), $imageName1);*/

                                        $dta = array();
                                        $dta['user_id'] = $checkUser->id; 
                                        $dta['member_id'] = $member->members; 
                                    
                                        DB::table('group_members')->insertGetId($dta);
                                    }
                                 }

                            $success['token'] = $inputData['token'];          
                            return $this->sendResponse($success, 'Group and members created successfully.');
                        }
                        else
                        {
                          return $this->sendError('Unauthorised.', ['error'=>'Something went wrong']);
                        }
                }





    public function challenge()
     {

        $challenge = DB::table("challenges")->get()->where('status','Active');
        if(!empty($challenge)){
            
        return $this->sendResponse($challenge, 'ChallengeList');

        }else{
              return $this->sendError('Unauthorised.', ['error'=>'Invalid Token']);
        }
    }      


    public function levelsByChallenge(Request $request)
        {
                  $inputData =   $request->all();                  
                  $categoryID =  $inputData['category'];
                  $albumsList = DB::table("levels")->where('challenge_id',$categoryID)->get();
                if(!empty($albumsList)){
                    
                return $this->sendResponse($albumsList, 'albumsList');

                }else{
                      return $this->sendError('Unauthorised.', ['error'=>'Invalid Token']);
                }
        }



        public function faq()
             {

                $faq = DB::table("faqs")->get()->where('status','Active');
                if(!empty($faq)){
                    
                return $this->sendResponse($faq, 'FAQList');

                }else{
                      return $this->sendError('Unauthorised.', ['error'=>'Invalid Token']);
                }
            }      


             public function storeUserInterest(Request $request)
                {    
                     
                     $inputData =   $request->all();
                     $validator = Validator::make($request->all(), 
                      [ 
                      'token' => 'required',
                            'interest_id' => 'required'
                
                     ]); 
                    if ($validator->fails()) {          
                    return $this->sendError('Validation Error.', $validator->errors());                        
                    }  
                    $checkUser = User::where('remember_token',$inputData['token'])->first();
                     if(empty($checkUser)){
                        return $this->sendError('Unauthorised.', ['error'=>'Invalid token']);
                     }

                    $insertData['user_id'] = $checkUser->id;

                    $allInterestID  = $request->get('interest_id');

                /*Looping*/
                        foreach($allInterestID as $allID){
                        
                            $dta = array();
                            $dta['user_id'] = $checkUser->id; 
                            $dta['interests'] = $allID; 
                         
                            //DB::table('album_images')->insertGetId($dta);
                             $album_id = DB::table('user_interests')->insertGetId($dta);
                        }             

                 /*Looping*/             
                    if(!empty($album_id)){              
                        $success['token'] = $inputData['token'];          
                        return $this->sendResponse($success, 'User Interest updated successfully.');
                    }else{
                          return $this->sendError('Unauthorised.', ['error'=>'Something went wrong']);
                    }
                }


            public function storeUserPost(Request $request)
                {
                     $inputData =   $request->all();
                     
                     $validator = Validator::make($request->all(), 
                      [ 
                        
                        'token' => 'required',
                        'description' => 'required',
                        'published_as' => 'required'
                
                     ]); 

                    if ($validator->fails()) {          
                    return $this->sendError('Validation Error.', $validator->errors());                        
                    }  

                    $checkUser = User::where('remember_token',$inputData['token'])->first();
                     if(empty($checkUser)){
                        return $this->sendError('Unauthorised.', ['error'=>'Invalid token']);
                     }

                       $insertData = array();
                        $insertData['user_id'] = $checkUser->id;
                        $insertData['description'] = $request->get('description');
                        $insertData['published_as'] = $request->get('published_as');
                      
                        $album_id = DB::table('user_posts')->insertGetId($insertData);

                        $files = $request->file('image'); 



                        if(!empty($album_id)){   

                             if(!empty($files)){

                            foreach($files as $postImg){
                                $uploadFolder = 'album';
                                $imageName1 = time() . '.' . $postImg->extension(); 
                                $postImg->move(public_path('album'), $imageName1);

                                $dta = array();
                                $dta['user_id'] = $checkUser->id; 
                                $dta['post_id'] = $album_id; 
                                $dta['image'] = $imageName1; 
                                DB::table('post_images')->insertGetId($dta);
                            }
                        }



                            $success['token'] = $inputData['token'];          
                            return $this->sendResponse($success, 'Post created successfully.');
                        }else{
                              return $this->sendError('Unauthorised.', ['error'=>'Something went wrong']);
                        }

                }

                public function storeUserEvent(Request $request)
                {
                     $inputData =   $request->all();
                     
                     $validator = Validator::make($request->all(), 
                      [ 
                        'token' => 'required',
                        'description' => 'required',
                        'event_name' => 'required',
                        'event_date' => 'required',
                        'start_time'  =>  'required',
                        'end_time'   => 'required',
                        'entry_fee'   => 'required',
                         'location'   =>  'required',
                         'event_type'  => 'required'
                 
                     ]); 

                    if ($validator->fails()) {          
                    return $this->sendError('Validation Error.', $validator->errors());                        
                    }  

                    $checkUser = User::where('remember_token',$inputData['token'])->first();
                     if(empty($checkUser)){
                        return $this->sendError('Unauthorised.', ['error'=>'Invalid token']);
                     }

                        $insertData = array();
                        $insertData['user_id'] = $checkUser->id;
                        $insertData['description']  = $request->get('description');
                        $insertData['event_name']   =  $request->get('event_name');
                        $insertData['event_date']   =  $request->get('event_date');
                        $insertData['start_time']   =  $request->get('start_time');
                        $insertData['end_time']     =  $request->get('end_time');
                        $insertData['entry_fee']    =  $request->get('entry_fee');
                        $insertData['location']     =  $request->get('location');
                        $insertData['event_type']     =  $request->get('event_type');
                      
                        $event_id = DB::table('events')->insertGetId($insertData);

                        $files = $request->file('image'); 

                        if(!empty($event_id)){   

                        if(!empty($files)){

                            foreach($files as $postImg){
                                $uploadFolder = 'album';
                                $imageName1 = time() . '.' . $postImg->extension(); 
                                $postImg->move(public_path('album'), $imageName1);

                                $dta = array();
                                $dta['user_id'] = $checkUser->id; 
                                $dta['event_id'] = $event_id; 
                                $dta['image'] = $imageName1; 
                                DB::table('event_images')->insertGetId($dta);
                            }
                        }

                            $success['token'] = $inputData['token'];          
                            return $this->sendResponse($success, 'Event created successfully.');
                        }else{
                              return $this->sendError('Unauthorised.', ['error'=>'Something went wrong']);
                        }

                }


                 public function showAllEvents()
                     {

                        $events = Event::all();
                        if(!empty($events)){
                            
                        return $this->sendResponse($events, 'EventList');

                        }else{
                              return $this->sendError('Unauthorised.', ['error'=>'Invalid Token']);
                        }
                    }


                public function userEvents(Request $request)
                        {      

                            $inputData =   $request->all();

                            if(empty($inputData)){
                                return $this->sendError('Invalid Request.',$inputData); 
                            }

                             $validator = Validator::make($inputData, [           
                                'token' => 'required'           
                            ]);

                            if($validator->fails()){
                                return $this->sendError('Validation Error.', $validator->errors()); 
                            }

                              $checkUser = User::where('remember_token',$inputData['token'])->first();

                                 if(empty($checkUser)){
                                    return $this->sendError('Unauthorised.', ['error'=>'Invalid token']);
                                 }
                          
                           // $eventList = Event::all()->where('user_id',$inputData['token']);
                                 $eventList  = DB::table('events')
                                               ->where('user_id',$checkUser->id)
                                               ->get();

                                               echo $eventList;

                                             

                            if(!empty($eventList)){
                                
                            return $this->sendResponse($eventList, 'EventList');

                            }else{
                                  return $this->sendError('Unauthorised.', ['error'=>'Invalid Subscription']);
                            }
                        } 


        public function storeFeedback(Request $request)
                {    
                    $inputData =   $request->all();

                    $validator = Validator::make($request->all(), 
                      [ 
                      'token' => 'required',
                      'feeling' => 'required',
                      'feedback_message' => 'required'
                     ]); 

                    if ($validator->fails()) {          
                    return $this->sendError('Validation Error.', $validator->errors());                        
                    }  

                    $checkUser = User::where('remember_token',$inputData['token'])->first();
                     if(empty($checkUser)){
                        return $this->sendError('Unauthorised.', ['error'=>'Invalid token']);
                     }


                       $insertData = array();
                        $insertData['user_id'] = $checkUser->id;
                        $insertData['feeling'] = $request->get('feeling');
                        $insertData['feedback_message'] = $request->get('feedback_message'); 

                      $feedback_id = DB::table('feedbacks')->insertGetId($insertData);

                   

                          
                    if(!empty($feedback_id)){              
                        $success['token'] = $inputData['token'];          
                        return $this->sendResponse($success, 'User feedback submitted successfully.');
                    }else{
                          return $this->sendError('Unauthorised.', ['error'=>'Something went wrong']);
                    }
                } 


public function updateProfile(Request $request)
    {

        
                $validator = Validator::make($request->all(),[
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'dob' => 'required',
                    // 'mobile' => 'required',
                    'gender' => 'required',
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

                $user_id = Auth::user()->id;

                $user = User::find($user_id);

                if(isset($user)){

                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->dob = $request->dob;
                    // $user->mobile = $request->mobile;
                    $user->gender = $request->gender;
                    $user->save();


                    return response()->json([
                        'success' => true,
                        'message' => 'User Profile Update.',
                        ]);

                }else{
                    return response()->json([
                        'success' => false,
                        'message' => 'User Not Exist.',
                        ]);
                }

    }



    //getprofile 


    public function getprofile(Request $request){
        // echo 'Hello';exit;
               
        $user_id = Auth::user()->id;
        $user = User::select('first_name','last_name','email','contact','dob','role','image')->where('id',$user_id)->first();

        if(isset($user)){

            return response()->json([
                'success' => true,
                'message' => 'User List.',
                'data' => $user
                ]);

        }else{
                     return response()->json([
                        'success' => false,
                        'message' => 'User Not Found.',
                        ]);
        }


    }
                
                
        
        

}